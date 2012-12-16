<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venues extends MY_Controller {
	
	public function index(){
	
	}
	
	public function get_local()
	{
		/*https://api.foursquare.com/v2/venues/search?ll=0,0&categoryId=4bf58dd8d48988d1e5931735 &client_id=SW42LYFQ2CPI4R5OFP1R2CVO1DOGDHGK5QV52EOB2O3WRWUO&client_secret=KF4UIOQTZ00R0ZOI4IEV24LFSEBZNUU4DCSHHG1OWIPYFNKD&v=20120627*/
		
		$lat = $this->input->post('lat');
		$lon = $this->input->post('lon');
		
		$this->load->library('session');
				
		//if ( ! $venues = $this->session->userdata('venues'))
		//{
		     
		     $service_url = "https://api.foursquare.com/v2/venues/search?ll=".$lat.",".$lon."&categoryId=5032792091d4c4b30a586d5c,4bf58dd8d48988d1e5931735&client_id=SW42LYFQ2CPI4R5OFP1R2CVO1DOGDHGK5QV52EOB2O3WRWUO&client_secret=KF4UIOQTZ00R0ZOI4IEV24LFSEBZNUU4DCSHHG1OWIPYFNKD&v=20120627";
		     $curl = curl_init();
		    // echo $service_url;
		     curl_setopt($curl,CURLOPT_URL,$service_url);
		     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		     
		     $curl_response = curl_exec($curl);
		     
		     curl_close($curl);
		     
		     //$venues = json_encode($curl_response);
		     $venues = json_decode($curl_response);
		     $this->load->model('show_model');
		     $this->load->model('venue_model');
		     
		     // loop response venue array
		     foreach($venues->response->venues as $venue){
		     	// get foursquare id for venue
		     	$id = $venue->id;
		     	
		     	// set the venue shows to empty array in case this venue is not in our system
		     	$venue->shows = array();
		     	$venue->future_shows = array();
		     	
		     	// get our venue entry from the database
		     	$v = $this->venue_model->get_by_foursquare($id);
		     	
		     	// if it exists, get the shows for it 
		     	if($v){
			     	$shows = $this->show_model->get_for_venue($v->id);
			     	if(count($shows) > 0){
			     	
			   			$venue->shows = $shows;
			     		$venue->future_shows = $shows;
			     	} 
		     	}
		     }
		  	
		     
		     //$this->session->set_userdata('venues', $venues);
			//$venues = 'test';
		     // Save into the cache for 5 minutes
		     //$this->cache->file->save('venues', $venues, 300);
		//}
		//print_r($venues);
		echo json_encode($venues);
		
	}
	
}