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
}
?>