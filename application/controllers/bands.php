<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bands extends MY_Controller {
	
	public function index(){	
		
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = "Yaaaaa";
		
		$this->keywords = "arny, arnodo";
		
		$this->_render('pages/home');
	}
	
	public function bandquery(){
	
		$this->load->model('Band');
		
		$bands = $this->Band->find_band();
		$return_array = array();
	
		foreach($bands as $band):
			
			$row_array['id'] = $band->id;
			$row_array['value'] = $band->band_name;
			$row_array['label'] = $band->band_name;
		
			array_push($return_array, $row_array);	
		endforeach;

		echo json_encode($return_array);
		
	}
	
}