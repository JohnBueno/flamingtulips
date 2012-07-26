<?php 
class Show extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_by_venue_id($id)
    {
    	//$show = $this->db->get_where('shows', array('venue_id' => $id));
    	$this->db->select('*');
    	$this->db->from('shows');
    	$this->db->join('bands', 'bands.id = shows.band_id');
    	$this->db->where('shows.venue_id', $id);
    	$show = $this->db->get();
    	
    	return $show->result();
    }
    
    function get_all()
    {
      
    }
    
    function add($show)
    {
    	$this->db->insert('shows', $show);
    	return $this->db->affected_rows() ? true : false;
    }
    
    function delete()
    {
    
    }
    
    function update()
    {
    
    }
}
?>