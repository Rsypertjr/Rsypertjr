<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\SocialAccount;
use Validator;
use Auth;
//use Socialize;
use Laravel\Socialite\Contracts\Factory as Socialite;

use App\SocialAccountService as Service;
 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;


use Laravel\Socialite\Contracts\User as ProviderUser;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/contacts';
    private $socialite;
    private $auth;
    private $provider;
    private $users;
    private $socialAccount;
    private $request;
    

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Socialite $socialite, Router $route, Guard $auth, SocialAccount $socialaccount,Request $request)
    {
       $this->socialite = $socialite;
       $this->auth = $auth;
       $this->socialAccount = $socialaccount;
       $this->request = $request;
       //$this->provider = '';
       $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
       (string)$this->provider = $route->current()->getParameter('provider');
       
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
 
    public function redirectToProvider(Request $request)
    {    
        
                if($this->provider == 'facebook')
                    return $this->socialite->with('facebook')->redirect();
                elseif($this->provider == 'github')
                    return $this->socialite->with('github')->redirect();
        
    }
    
    
    public function preLogin(Request $request)
    { 
          $this->auth->logout();
          $loginEmail = $request->input('email');
          $whichButton = $request->input('whichButton');
          
          if($loginEmail != '')
          {
              if($whichButton == 'facebook'){
                  
                   $isFacebook = SocialAccount::select('facebook')
                                ->where('email',$loginEmail)
                                ->first();
                                
                   if($isFacebook->facebook == 'yes')
                        return redirect('/auth/facebook');            
                   else
                        return redirect('/login');             
                    }
               elseif($whichButton == 'github'){             
                   $isGitHub = SocialAccount::select('github')
                                ->where('email',$loginEmail)
                                ->first();
                    
                    if($isGitHub->github == 'yes')
                        return redirect('/auth/github');  
                    else
                        return redirect('/login'); 
                    }
             
          }
           else
                  return redirect('/login');
    }
    
    
    public function login(Request $request)
    {  
        
        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );
        
        $user = User::where('email',$request->input('email'))  // Match input with Database
                    ->first();
        if(($user != '') && ($user->count() > 0)){
                $this->auth->login($user);
        return redirect('/contacts');
               // if ($this->auth->attempt($credentials)) {
                    
                //}
        }
        else {
            return redirect('/login')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);
        }
        
        
      
                
    }
    
    
    
    
    
    public function handleProviderCallback(Socialite $socialite)
    {
        $service = new Service();
        if((string)$this->provider == 'facebook')
            $user = $service->createOrGetUser($this->socialite->driver('facebook')->user(),(string)$this->provider);
            
        elseif((string)$this->provider == 'github')
            $user = $service->createOrGetUser($this->socialite->driver('github')->user(),(string)$this->provider);
       
       
       $this->auth->login($user,true);
       return redirect('/login');
    }
        
}
