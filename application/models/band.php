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
    
    function find_band($term = null){
    	$this->db->select('id, band_name');
    	if($term){
    		$this->db->like('band_name', $term);
    	}
    	$this->db->from('bands');
    	$bands = $this->db->get();
    	return $bands->result();
    	//return $query;
    }
    
    function band_exists($band_name)
    {
    	$this->db->select('band_name');
    	$this->db->from('bands');
    	$this->db->like('band_name', $band_name);
    	$query = $this->db->get();
    	if($query->num_rows() > 0){
    		return $query->row('band_id');
    	} else {
    		return false;
    	}
    }
    
    function add_band($band)
    {
    	$this->db->insert('bands', $band);
    	
    	if($this->db->affected_rows() > 0){
    		return $this->db->insert_id();
    	} else {
    		return false;
    	}
    }
}
?>