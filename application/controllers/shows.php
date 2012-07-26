<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shows extends MY_Controller {
	
	public function index(){	
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = "Yaaaaa";
		$this->keywords = "arny, arnodo";
		$this->_render('pages/home');
	}
	
	public function by_venue($id) 
	{
		
		$this->load->model('Show');
		$shows = $this->Show->get_by_venue_id($id);
		$data['shows'] = $shows;
		
		$this->load->model('Band');
		$bands = $this->Band->get_band_ids();
		$data['bands'] = $bands;
		
		
		$this->_render('pages/venue', $data);	
		
	}
	
	public function add_show()
	{
		$this->load->model('Show');
		
		// build an array of the data to load into the database from the passed form
		$insert = array();
		$insert['date'] = $this->input->post('date');
		$insert['band_id'] = $this->input->post('band_id');
		$insert['venue_id'] = $this->input->post('venue_id');
		
		// if the add is successful...
		if( $this->Show->add($insert) )
		{
			echo "success";
		} else {
			echo "failure";
		}
	}
	
}