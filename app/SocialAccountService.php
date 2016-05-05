<?php

namespace App;
use App\SocialAccount;
use Illuminate\Http\Request;

use Laravel\Socialite\Contracts\User as ProviderUser;
class SocialAccountService
{
    
    
    private $socialaccount;
    
    public function _construct()
    {
        
        $this->socialaccount = new SocialAccount;
        
        
    }
    
    public function createOrGetUser(ProviderUser $providerUser,$provider){
        
        if((string)$provider == 'facebook'){
              $account = SocialAccount::where('facebook','yes')
                    ->where('facebook_provider_user_id',$providerUser->getId())
                    ->first();
         
                    
        }
        elseif((string)$provider == 'github'){
             $account = SocialAccount::where('github','yes')
                    ->where('github_provider_user_id',$providerUser->getId())
                    ->first();
        }
      
                
        if($account){
            return $account->user;
        } else {  
                 if((string)$provider == 'facebook'){  
                  
                      $account = new SocialAccount;
                      $account->facebook_provider_user_id = $providerUser->getId();
                      $account->github_provider_user_id = '';
                      $account->email = $providerUser->getEmail();
                      $account->facebook = 'yes';
                      $account->github = 'no';
                     // $account->save();
                 }
                elseif((string)$provider == 'github'){
                                
                      $account = new SocialAccount;
                      $account->github_provider_user_id = $providerUser->getId();
                      $account->facebook_provider_user_id = ''; 
                      $account->email = $providerUser->getEmail();
                      $account->github = 'yes';
                      $account->facebook = 'no';
                     // $account->save();      
                                
                 }
                
            $user = User::where('email',$providerUser->getEmail())->first();
            
            if(!$user){  
                $user = User::create([ 
                        'email' => $providerUser->getEmail(),
                        'name' => $providerUser->getName(),
                        ]);
                        
                
            }
            
            $account->user()->associate($user);  
            $account->save();  //Save the Social Account
            
            return $user;   // Return User with same email as Social Provider
        }
       
    }
}
