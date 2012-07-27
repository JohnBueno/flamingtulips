<?php 
class Band extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	function get_band_ids()
    {
    	$bands = $this->db->get('bands');
    	return $bands->result();
    }
    
    function find_band($query){
    	$this->db->select('id, band_name');
    	//$this->db->like('band_name', $query);
    	$this->db->from('bands');
    	$bands = $this->db->get();
    	return $bands->result();
    	//return $query;
    }
}
?>