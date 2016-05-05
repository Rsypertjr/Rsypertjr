<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use Artisan;

class ContactController extends Controller
{
   
    protected $contacts;
	
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    
	
	 /**
     * The contact repository instance.
     * 
     * @var ContactRepository
     */
    public function _construct(ContactRepository $contacts)
    {
        $this->middleware('auth');
        $this->contacts = $contacts;
		
        
    }
    
      
    public function index(Request $request)
    {
		
       $theContacts = new ContactRepository();
       return view('contacts.index',['contacts' => $theContacts->forUser($request->user()),
													'type' => 'firstname']);
    }
    
    /**
     * Create a new contact
     * 
     * @param Request $request
     * @return Response
     */
    
    public function store(Request $request)
    {
		 $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255',
            'phone'      => 'required|regex:/^\+?[^a-zA-Z]{5,}$/',
            'extraDetail1' => 'max:255',
            'extraDetail2' => 'max:255',
            'extraDetail3' => 'max:255',
            'extraDetail4' => 'max:255',
            'extraDetail5' => 'max:255',
			'noExtraDetails' => 'max:255'
            
        ]);
		
		
		
        $request->user()->contacts()->create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'extraDetail1' => $request->extraDetail1,
                'extraDetail2' => $request->extraDetail2,
                'extraDetail3' => $request->extraDetail3,
                'extraDetail4' => $request->extraDetail4,
                'extraDetail5' => $request->extraDetail5,
				'noExtraDetails' => $request->noExtraDetails
                
        ]);
         return redirect('/contacts')->with(['type' => 'firstname']); 
    }
    
    public function destroy(Request $request, Contact $contact){
        
        $this->authorize('destroy', $contact);
        
        $contact->delete();
        
        return redirect('/contacts');
    }
   
  public function edit(Request $request, Contact $contact){
	    $this->validate($request, [
			'firstname' => 'required|max:255',
			'lastname' => 'required|max:255',
			'email' => 'required|max:255',
			'phone'      => 'required|regex:/^\+?[^a-zA-Z]{5,}$/',
			'extraDetail1' => 'max:255',
			'extraDetail2' => 'max:255',
			'extraDetail3' => 'max:255',
			'extraDetail4' => 'max:255',
			'extraDetail5' => 'max:255',
			'noExtraDetails' => 'max:255'
			
		]);		
		
	    $contacts = new ContactRepository();
		$request->user()->contacts()
				->where('user_id',$contact->user_id)
				->where('id',$contact->id)
				->update(['firstname' => $request->firstname,
						   'lastname' => $request->lastname,		
						   'email' => $request->email,
						   'phone' => $request->phone,
						   'extraDetail1' => $request->extraDetail1,
						   'extraDetail2' => $request->extraDetail2,
						   'extraDetail3' => $request->extraDetail3,
						   'extraDetail4' => $request->extraDetail4,
						   'extraDetail5' => $request->extraDetail5,
						   'noExtraDetails' => $request->noExtraDetails]);

         return redirect('/contacts'); 
    }
	

public function search(Request $request){	

    $searchType = $request->input('searchKind');
	$sortType = $request->input('sortKind');
	
	if($searchType == 'email')
		$searchItem = $request->input('email');
	else if($searchType == 'lastname')
		$searchItem = $request->input('lastname');
	else if($searchType == 'phone')
		$searchItem = $request->input('phone');
	else;
	
	$contacts = new ContactRepository();
	
	if($request->input('searchItem') != 'Type In Search Item')
		{
			$theContacts = $request->user()->contacts()
						 ->where($searchType,$request->searchItem)
						 ->where('user_id',$request->user()->id)
						 ->orderBy($searchType,$sortType)
						 ->get();
		}
	else
		{
			$theContacts = $request->user()->contacts()
							 ->where('user_id',$request->user()->id)
							 ->orderBy($searchType,$sortType)
							 ->get();
			
		}
	$theType = $request->user()->contacts()
				->select($searchType)
				->where($searchType,$request->searchItem)
				->where('user_id',$request->user()->id)
				->orderBy($searchType,$sortType)
				->get();
				
   return view('contacts.index')->with(['contacts' => $theContacts,'type' => $searchType]);
}	

            
} 
