<?php 
class Show_review_model extends MY_Model{
	public $before_create = array( 'created_at', 'updated_at' );
	public $before_update = array( 'updated_at' );
	public $belongs_to = array('show');
 }
?>