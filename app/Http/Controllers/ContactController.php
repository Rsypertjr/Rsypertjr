<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;

use App\ActiveCampaignService as Service;

use Illuminate\Routing\Router;
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
      
	    if($request->user() != '')
	        $contacts = $theContacts->forUser($request->user());	
        $this->newservice = new Service;
        $ac = $this->newservice->getActiveC();
       
        if($contacts != '' && $contacts->count() == 0){
	       
                    $user_id = $request->user()->id;
                    $name = $request->user()->name;
                     // User List
                    $list = array(
                        "name"           => "Contact List for ".$request->user()->name,
                        "sender_name"    => "Richard L. Sypert Jr.",
                		"sender_addr1"   => "8612 Shady Pines",
                		"sender_city"    => "Las Vegas",
                		"sender_zip"     => "89143",
                		"sender_country" => "USA",
                	    "id"             => $user_id,
                		"user_name"      => $name,
                	);
            
                    $list_add = $ac->api("list/add", $list);
            
                	if (($list_add != '') && !(int)$list_add->success) {
                		// request failed
                		echo "<p>Adding list failed. Error returned: " . $list_add->error . "</p>";
                		exit();
                	}
                    else if(($list_add != '') && (int)$list_add->success) {   
                    // successful request
                    $list_id = (int)$list_add->id;
                    echo '<p class="acMessage" style="position:absolute;margin:10em 0 0 7em;color:blue;opacity:0.5;padding:2em;font-size:2em;border-style:solid;border-width:medium;z-index:25;text-align:center">
                    Active Campaign<br>List added successfully (ID {'.$list_id.'})!</p>';
       // {{!! $text !!}}
                    //echo "<p>List added successfully (ID {$list_id})!</p>";  
                    //echo $list_id;
                    
                    $new_data = array('activeCampaignListId' => $list_id,);
                    $user = User::whereId($user_id)->update($new_data);
                    }

	             }
       else if($contacts != '' && $contacts->count() > 0){
           
                   $numContacts = $contacts->count();
                   $i = 0;
	               foreach($contacts as $aContact){
                        $i++;
	                   	$contact = array(
                    	   	"email"              => $aContact->email,
                    		"first_name"         => $aContact->firstname,
                    		"last_name"          => $aContact->lastname,
                    		"phone"              => $aContact->phone,
                    		"extraDetail1"       => $aContact->extraDetail1,
                    		"extraDetail2"       => $aContact->extraDetail2,
                    		"extraDetail3"       => $aContact->extraDetail3,
                    		"extraDetail4"       => $aContact->extraDetail4,
                    		"extraDetail5"       => $aContact->extraDetail5,
                    		"p[{$aContact->activeCampaignListId}]"      => $aContact->activeCampaignListId,
                    		"status[{$aContact->activeCampaignListId}]" => 1, // "Active" status
                    	);
                    	$contact_sync = $ac->api("contact/sync", $contact);
                    	if (!(int)$contact_sync->success) {
                    		// request failed
                    		echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
                    		exit();
                    	}
                    	
                    
                    	
                    	 // successful request
                        $contact_id = (int)$contact_sync->subscriber_id;
                        if($i == $numContacts){
                            echo '<p class="acMessage" style="position:absolute;margin:10em 0 0 7em;color:blue;background-color:white;opacity:1.0;padding:2em;font-size:2em;border-style:solid;border-width:medium;z-index:25;text-align:center">
                            Active Campaign<br>Contact synced successfully for '.$aContact->firstname.'!</p>';
                            //echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
                        }
                            
                        if($aContact->extraDetail1 != ''){  // Generate Active Campaign Note
                            if($aContact->exDet1NoteId == 0){ // Create Note
                                $data = array(
                                      "id" => $contact_id,
                                      "listid" => $aContact->activeCampaignListId,
                                      "note" => $aContact->extraDetail1,
                                    );
                                    
                            
                                // Store ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/add", $data);
                                $noteId = $response->id;
                                //echo $noteId;
                                
                                $new_data = array('exDet1NoteId' => $noteId);
                                $user = Contact::whereEmail($aContact->email)->update($new_data);
                            }
                        }
                        else if($aContact->extraDetail1 == ''){
                             if($aContact->exDet1NoteId != 0){  //Update Note
                                //echo $aContact->extraDetail1;
                                $data = array(
                                      "noteid" => $aContact->exDet1NoteId,
                                      "listid" => $aContact->activeCampaignListId,
                                      "subscriberid"    =>  $contact_id,
                                      "note" => $aContact->extraDetail1,
                                    );
                           
                               
                                // Update/Edit ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/edit", $data);
                                    
                           }
                        }
                        
                        if($aContact->extraDetail2 != ''){
                            if($aContact->exDet2NoteId == 0){ // Create Note
                                $data = array(
                                      "id" => $contact_id,
                                      "listid" => $aContact->activeCampaignListId,
                                      "note" => $aContact->extraDetail2,
                                    );
                                    
                                // Store ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/add", $data);
                                $noteId = $response->id;
                                echo $noteId;
                                
                                $new_data = array('exDet2NoteId' => $noteId);
                                $user = Contact::whereEmail($aContact->email)->update($new_data);
                            }
                         }
                        else if($aContact->extraDetail2 == ''){
                             if($aContact->exDet2NoteId != 0){  //Update Note
                                //echo $aContact->extraDetail1;
                                $data = array(
                                      "noteid" => $aContact->exDet2NoteId,
                                      "listid" => $aContact->activeCampaignListId,
                                      "subscriberid"    =>  $contact_id,
                                      "note" => $aContact->extraDetail2,
                                    );
                           
                               
                                // Update/Edit ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/edit", $data);
                           }
                           
                        }
                        
                        if($aContact->extraDetail3 !=''){
                            if($aContact->exDet3NoteId == 0){ // Create Note
                                $data = array(
                                      "id" => $contact_id,
                                      "listid" => $aContact->activeCampaignListId,
                                      "note" => $aContact->extraDetail3,
                                    );
                                    
                                    // Store ActiveCampaign Note Id in Contact  
                                    $response = $ac->api("contact/note/add", $data);
                                    $noteId = $response->id;
                                    echo $noteId;
                                    
                                    $new_data = array('exDet3NoteId' => $noteId);
                                    $user = Contact::whereEmail($aContact->email)->update($new_data);
                            }
                          }
                         else if($aContact->extraDetail3 ==''){
                            if($aContact->exDet3NoteId != 0){  //Update Note
                                //echo $aContact->extraDetail1;
                                $data = array(
                                      "noteid" => $aContact->exDet3NoteId,
                                      "listid" => $aContact->activeCampaignListId,
                                      "subscriberid"    =>  $contact_id,
                                      "note" => $aContact->extraDetail3,
                                    );
                           
                               
                                // Update/Edit ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/edit", $data);
                           }
                                    
                         }
                        
                        if($aContact->extraDetail4 != ''){
                            if($aContact->exDet4NoteId == 0){ // Create Note
                                $data = array(
                                      "id" => $contact_id,
                                      "listid" => $aContact->activeCampaignListId,
                                      "note" => $aContact->extraDetail4,
                                    );
                                    
                                    // Store ActiveCampaign Note Id in Contact  
                                    $response = $ac->api("contact/note/add", $data);
                                    $noteId = $response->id;
                                    echo $noteId;
                                    
                                    $new_data = array('exDet4NoteId' => $noteId);
                                    $user = Contact::whereEmail($aContact->email)->update($new_data);
                            }
                                
                        }
                        else if($aContact->extraDetail4 == ''){ 
                             if($aContact->exDet4NoteId != 0){  //Update Note
                                //echo $aContact->extraDetail1;
                                $data = array(
                                      "noteid" => $aContact->exDet4NoteId,
                                      "listid" => $aContact->activeCampaignListId,
                                      "subscriberid"    =>  $contact_id,
                                      "note" => $aContact->extraDetail4,
                                    );
                           
                               
                                // Update/Edit ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/edit", $data);
                           }
                         }
                        
                        if($aContact->extraDetail5 != ''){
                            if($aContact->exDet5NoteId == 0){ // Create Note
                                $data = array(
                                      "id" => $contact_id,
                                      "listid" => $aContact->activeCampaignListId,
                                      "note" => $aContact->extraDetail5,
                                    );
                                    
                                    // Store ActiveCampaign Note Id in Contact  
                                    $response = $ac->api("contact/note/add", $data);
                                    $noteId = $response->id;
                                    echo $noteId;
                                    
                                    $new_data = array('exDet5NoteId' => $noteId);
                                    $user = Contact::whereEmail($aContact->email)->update($new_data);
                            }
                        }
                         else if($aContact->extraDetail5 == ''){
                             if($aContact->exDet5NoteId != 0){  //Update Note
                                //echo $aContact->extraDetail1;
                                $data = array(
                                      "noteid" => $aContact->exDet5NoteId,
                                      "listid" => $aContact->activeCampaignListId,
                                      "subscriberid"    =>  $contact_id,
                                      "note" => $aContact->extraDetail5,
                                    );
                           
                               
                                // Update/Edit ActiveCampaign Note Id in Contact  
                                $response = $ac->api("contact/note/edit", $data);
                           }
                        }
                                  	
	          		
                	}  // end foreach
                       
	               
	           }  // end else if  
													
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
		
		
		
        // Set up Contact for Active Campaign
        
          $listId = $request->user()->select('activeCampaignListId')
                                    ->where('id',$request->user()->id)
                                    ->first();
          //$lId = ['listId' => $listId];
          //echo $listId;
		
          $contact = $request->user()->contacts()->create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'user_id'   => $request->user()->id,
                    'activeCampaignListId' => $listId->activeCampaignListId,
                    'extraDetail1' => $request->extraDetail1,
                    'extraDetail2' => $request->extraDetail2,
                    'extraDetail3' => $request->extraDetail3,
                    'extraDetail4' => $request->extraDetail4,
                    'extraDetail5' => $request->extraDetail5,
                    'exDet1NoteId' => '',
                    'exDet2NoteId' => '',
                    'exDet3NoteId' => '',
                    'exDet4NoteId' => '',
                    'exDet5NoteId' => '',
        			'noExtraDetails' => $request->noExtraDetails
                 ]); 
         
         
              $new_data = array('activeCampaignListId' => $listId->activeCampaignListId,);
              $contact = Contact::whereEmail($request->input('email'))->update($new_data);
         
         return redirect('/contacts')->with(['type' => 'firstname']); 
    }
    
    public function destroy(Request $request,Router $route,$contact){
       //$contactId = $route->current()->getParameter('contact');
       $request->user()->contacts()
                        ->where('id',$contact)->delete();
        //$this->authorize('destroy', $request->user()->contacts($contact));
      
       
        
        return redirect('/contacts');
    }
   
  public function edit(Request $request,Contact $contact){
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
