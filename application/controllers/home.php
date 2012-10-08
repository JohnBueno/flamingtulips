<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public function index(){	
		
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = "Tulip Operation";
		
		$this->javascript = array('venue_grabber.js');
		
		// Load the library
		$this->load->library('googlemaps');
		
		$congfig = array(
			'center' => '39.969002 -75.134188',
			
		);
		
		// Initialize our map. Here you can also pass in additional 
		//parameters for customising the map (see below)
		$this->googlemaps->initialize($congfig);
		
		// Create the map. This will return the Javascript to be included in 
		//our pages <head></head> section and the HTML code to be 
		// placed where we want the map to appear.
		
		$data['map'] = $this->googlemaps->create_map();
		
		// Load our view, passing the map data that has just been created
		$this->_render('pages/home', $data);
	}
	
	public function setMapCenter(){
	
	}
	
}