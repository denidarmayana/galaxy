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

			$harian = $key->amount*(5/100);
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
		//ROI

		$dates = date("Y-m-d");
		$omset = $this->db->like('updated_at',$dates)->get("subcribe")->result();
		$amount_omset=0;
		foreach ($omset as $om) {
			$p = $this->db->get_where("paket",['id'=>$om->paket])->row();
			$amount_omset +=$p->amount;
		}
		
		$count_manager = $this->db->get_where("members",['position'=>1])->num_rows();
		$reward_manager = $amount_omset*(0.25/100);
		$amount_manager = $reward_manager/$count_manager;
		$manager = $this->db->get_where("members",['position'=>1])->result();
		foreach ($manager as $m) {
			$cek = $this->db->like('created_at',$dates)->get_where("reward",['members'=>$m->username])->num_rows();
			if ($cek == 0) {
				if (date("H:i:s") == "23:59:00") {
					$this->db->insert("reward",[
						'members'=>$m->username,
						'amount'=>$amount_manager,
						'created_at'=>$dates." 23:59:00",
						'updated_at'=>$dates." 23:59:00"
					]);
				}
			}
			
		}
		//manager
	}
}