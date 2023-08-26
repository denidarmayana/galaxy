<?php
/**
 * 
 */
class Webhook extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function daily()
	{
		$sub = $this->db->select('members.username,paket.amount,subcribe.updated_at')->join('members','members.username=subcribe.members')->join('paket','subcribe.paket=paket.id')->get("subcribe")->result();
		echo json_encode($sub);
		foreach ($sub as $key) {
			$harian = $key->amount*(1/100);
			$waktu = explode(" ", $key->updated_at);
			if (date("H:i:s") == $waktu[1] ) {
				$this->db->insert("roi",[
					'members'=>$key->username,
					'amount'=>$harian,
					'created_at'=>date("Y-m-d H:i:s"),
					'updated_at'=>date("Y-m-d H:i:s")
				]);
			}
		}
	}
}