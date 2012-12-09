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
		$this->load->model('show_model');
		$this->load->model('band_model');
		$this->load->model('venue_model');
		$venue = $this->venue_model->get_by_foursquare($id);
		if($venue){
			$data['shows'] = $this->show_model->get_for_venue($venue->id);
		} else {
			$data['shows'] = array();
			$insert['foursquare_id'] = $id;
			$this->venue_model->insert($insert);
			$venue = $this->venue_model->get_by_foursquare($id);
		}
		$data['bands'] = array();
		$data['venue_id'] = $venue->id;
		$data['foursquare'] = $venue->foursquare_id;
		$data['rating'] = $venue->rating;
		$this->_render('pages/venue', $data);
	}
	
	public function rate_show()
	{
		$rating = $this->input->post('rating');
		$show_id = $this->input->post('show_id');
		$band_id = $this->input->post('band_id');
		$venue_id = $this->input->post('venue_id');
		$this->load->model('show_review_model');
		$insert['rating'] = $rating;
		$insert['show_id'] = $show_id;
		$insert['band_id'] = $band_id;
		$insert['venue_id'] = $venue_id;
		$this->show_review_model->insert($insert);
		echo "success";
	}
	
	public function add_show()
	{
		$this->load->model('show_model');
		$this->load->model('band_model');
		$this->load->model('venue_model');
		
		// check if the band exists
		$band = $this->band_model->get_by('name', $this->input->post('band_name'));
		
		// if not,create it.
		if(!$band){
			$this->band_model->insert(array(
				'name'=>$this->input->post('band_name')
			));
			$band = $this->band_model->get_by('name', $this->input->post('band_name'));
		}
		
		// assign id to the existing or newly created band.
		$band_id = $band->id;
		
		// check if the venue exists
		$venue = $this->venue_model->get_by('foursquare_id', $this->input->post('venue_id'));
		
		// if not,create it.
		if(!$venue){
			$this->venue_model->insert(array(
				'foursquare_id'=>$this->input->post('venue_id')
			));
			$venue = $this->venue_model->get_by('foursquare_id', $this->input->post('venue_id'));
		}
		
		// assign id to the existing or newly created venue.
		$venue_id = $venue->id;
		
		$insert = array();
		$insert['date'] = $this->input->post('date');
		$insert['band_id'] = $band_id;
		$insert['venue_id'] = $venue_id;
		
		// if the add is successful...
		if( $this->show_model->insert($insert) )
		{
			echo "success";
		} else {
			echo "failure";
		}
	}
}
?>