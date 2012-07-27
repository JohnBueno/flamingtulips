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
		     
		     $service_url = "https://api.foursquare.com/v2/venues/search?ll=".$lat.",".$lon."&categoryId=4bf58dd8d48988d1e5931735&client_id=SW42LYFQ2CPI4R5OFP1R2CVO1DOGDHGK5QV52EOB2O3WRWUO&client_secret=KF4UIOQTZ00R0ZOI4IEV24LFSEBZNUU4DCSHHG1OWIPYFNKD&v=20120627";
		     $curl = curl_init();
		    // echo $service_url;
		     curl_setopt($curl,CURLOPT_URL,$service_url);
		     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		     
		     $curl_response = curl_exec($curl);
		     
		     curl_close($curl);
		     
		     $venues = json_encode($curl_response);
		     //$this->session->set_userdata('venues', $venues);
			//$venues = 'test';
		     // Save into the cache for 5 minutes
		     //$this->cache->file->save('venues', $venues, 300);
		//}
		
		echo $venues;
		
	}
	
}