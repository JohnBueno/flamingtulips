<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bands extends MY_Controller {
	
	public function index(){	
		
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = "The Tulip";
		
		$this->keywords = "arny, arnodo";
		
		$this->_render('pages/home');
	}
	
	public function bandquery($query=null){
		
		$query = $this->input->get('term');
		
		$this->load->model('band_model');
		
		$bands = $this->band_model->get_all();
		
		$return_array = array();
			
		foreach($bands as $band):
			
			$row_array['id'] = $band->id;
			$row_array['value'] = $band->name;
			$row_array['label'] = $band->name;
		
			array_push($return_array, $row_array);	
		endforeach;

		echo json_encode($return_array);
		
	}
	
}