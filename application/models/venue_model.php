<?php 
class Venue_model extends MY_Model{
	public $before_create = array( 'created_at', 'updated_at' );
	public $before_update = array( 'updated_at' );
	
	/**
	 * Fetch an array of records based on an arbitrary WHERE call.
	 */
	public function get_by_foursquare($venue_id)
	{
	    $this->db->select("`venues`.`id`, `venues`.`foursquare_id`,
						    (	SELECT ROUND(AVG(show_reviews.rating)) AS rating 
						    	FROM show_reviews 
						    	WHERE show_reviews.venue_id = venues.id
						    ) AS rating
						    FROM (venues)
						    WHERE foursquare_id =  '$venue_id' LIMIT 1");
	    $query = $this->db->get();
	    return $query->row();
	}
 }
?>