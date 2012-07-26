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
	
	public function bandquery($key){
	
		$this->load->model('Band');
		
		$bands = $this->Band->find_band($key);
		
		echo json_encode($bands);
		
	}
	
}