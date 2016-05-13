<?php
namespace App;
use Illuminate\Http\Request;
define("ACTIVECAMPAIGN_URL", "https://richardlsypertjrhome.api-us1.com");
define("ACTIVECAMPAIGN_API_KEY", "6fc3942960eab07cf7b111a1fd82e2dd453ef216bd9b9d28c71b219227062d857f98832b");
require($_SERVER["DOCUMENT_ROOT"]."/../vendor/activecampaign/includes/ActiveCampaign.class.php");
use Illuminate\Database\Eloquent\Model;
class ActiveCampaignService extends Model
{
    private $ac;
    private $request;
    public function _construct()
    {
        
    }
 
      
    public function accountCmd($ac,$cmd)
    {
        
         if($cmd == 'test'){
              
            	if (!(int)$ac->credentials_test()) {
            		echo "<p>Access denied: Invalid credentials (URL and/or API key).</p>";
            		exit();
    	            }
                        echo "<p>Credentials valid! Proceeding...</p>";
                }
    }
    
    public function addList($name,$userId){
    
          $this->ac = new \ActiveCampaign(ACTIVECAMPAIGN_URL,ACTIVECAMPAIGN_API_KEY);
    
         
    
    
         // User List
        $list = array(
            "name"           => "Contact List for ".$name->name,
            "sender_name"    => "Richard L. Sypert Jr.",
    		"sender_addr1"   => "8612 Shady Pines",
    		"sender_city"    => "Las Vegas",
    		"sender_zip"     => "89143",
    		"sender_country" => "USA",
    	    "id"             => $userId,
    		"user_name"      => $name->name,
    	);
        $list_add = $this->ac->api("list/add", $list);
    	if (!(int)$list_add->success) {
    		// request failed
    		echo "<p>Adding list failed. Error returned: " . $list_add->error . "</p>";
    		exit();
    	}
            
        // successful request
        $list_id = (int)$list_add->id;
        echo "<p>List added successfully (ID {$list_id})!</p>";  
        return $list_id;
        // ADD LIST ID TO USER TABLE
 
        	/*
	 * ADD OR EDIT CONTACT (TO THE NEW LIST CREATED ABOVE).
	 */
  }
public function addContact($cnt,$inAC){
    
    print_r($cnt);
    exit();
    
        //$contact_id = $request->user()->contacts()->select('id')
                                    //->where('email',$request->input('email'));
        
        
    if($inAc == '')  
        $ac = $this->getAC(); // = new \ActiveCampaign(ACTIVECAMPAIGN_URL,ACTIVECAMPAIGN_API_KEY);
    else
        $ac = $inAC;
	$contact = array(
	   	"email"              => $cnt,
		"first_name"         => $cnt->firstname,
		"last_name"          => $cnt->lastname,
		"phone"              => $cnt->phone,
		"extraDetail1"       => $cnt->extraDetail1,
		"extraDetail2"       => $cnt->extraDetail2,
		"extraDetail3"       => $cnt->extraDetail3,
		"extraDetail4"       => $cnt->extraDetail4,
		"extraDetail5"       => $cnt->extraDetail5,
		"p[{$cnt->activeCampaignListId}]"      => $cnt->activeCampaignListId,
		"status[{$cnt->activeCampaignListId}]" => 1, // "Active" status
	);
	$contact_sync = $ac->api("contact/sync", $contact);
	if (!(int)$contact_sync->success) {
		// request failed
		echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
		exit();
	}
        
    // successful request
    $contact_id = (int)$contact_sync->subscriber_id;
    echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
    
  	
	// VIEW ALL CONTACTS IN A LIST (RETURNS ID AND EMAIL).
	 
	//$this->ac->version(2);
	//$contacts_view = $this->ac->api("contact/list?listid=14&limit=500");
	//$this->ac->version(1);
	
   
   	return redirect('/contacts');  
}
  
public function viewCampaign($ac){
	/*
	 * VIEW CAMPAIGN REPORTS (FOR THE CAMPAIGN CREATED ABOVE).
	 */
	$campaign_report_totals = $ac->api("campaign/report/totals?campaignid={$campaign_id}");
	echo "<p>Reports:</p>";
	echo "<pre>";
	print_r($campaign_report_totals);
	echo "</pre>";
      
  }  
    
 public function getActiveC(){
     
     return $this->ac = new \ActiveCampaign(ACTIVECAMPAIGN_URL,ACTIVECAMPAIGN_API_KEY);
   
 }  
    
    
                
}
