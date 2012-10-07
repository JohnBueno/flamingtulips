<?php 
class Show_model extends MY_Model {
	public $before_create = array( 'created_at', 'updated_at' );
	public $before_update = array( 'updated_at' );
	
	/**
     * Fetch an array of records based on an arbitrary WHERE call.
     */
    public function get_for_venue($venue_id)
    {
        $this->db->select("`shows`.`date`, `shows`.`id` AS show_id, `bands`.`name`, `bands`.`id` AS band_id, 
        	(
        	SELECT ROUND(AVG(`show_reviews`.`rating`))
        	FROM show_reviews
        	WHERE show_reviews.show_id = shows.id
        	) AS rating
        FROM (`shows`)
        JOIN `bands` ON `bands`.`id` = `shows`.`band_id`
        JOIN `venues` ON `venues`.`id` = `shows`.`venue_id`
        WHERE `shows`.`venue_id` =  '$venue_id'
        ORDER BY `shows`.`date` desc");
        $query = $this->db->get();
        return $query->result();
    }
 }
?>