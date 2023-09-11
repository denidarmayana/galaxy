<?php
/**
 * 
 */
class BonusModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function roi()
	{
		$data = $this->db->order_by('id','desc')->get_where("subcribe",['members'=>$this->session->userdata("username")])->row();
		if ($data) {
			// code...
		}else{
			echo "<span class='text-success'>0.00000000</span>";
		}
	}
}