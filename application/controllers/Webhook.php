<?php
/**
 * 
 */
class Webhook extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function daily()
	{
		$sub = $this->db->select('members.username,paket.amount,subcribe.updated_at')->join('members','members.username=subcribe.members')->join('paket','subcribe.paket=paket.id')->get_where("subcribe",['subcribe.status'=>1])->result();
		
		foreach ($sub as $key) {

			$harian = $key->amount*(1/100);
			$waktu = explode(" ", $key->updated_at);
			$menit = explode(":", $waktu[1]);
			$waktu_save = $menit[0].":".$menit[1];
			echo date("H:i")." - ".$waktu_save;
			if (date("H:i") == $waktu_save ) {
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