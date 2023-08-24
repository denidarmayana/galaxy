<?php
/**
 * 
 */
class Model_app extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function cekSession()
	{
		if ($this->session->userdata("login") == TRUE) {
			return TRUE;
		}else{
			redirect("auth");
		}
	}
	public function username_sucribe($id)
	{
		$row = $this->db->select('paket.amount,members.username')->join('paket','paket.id=subcribe.paket')->join('members','members.username=subcribe.members')->get_where("subcribe",['subcribe.id'=>$id])->row();
		return $row;
	}
	public function level($username)
	{
		$row = $this->db->get_where("members",['username'=>$username])->row();
		return $row;
	}
	public function bonus_level($members,$upline,$amount,$level)
	{
		$bns = $this->db->get("fee_level")->row();
		switch ($level) {
			case 1:
				$jumlah = $amount*($bns->level_1/100);
				break;
			case 2:
				$jumlah = $amount*($bns->level_2/100);
				break;
			case 3:
				$jumlah = $amount*($bns->level_3/100);
				break;
			case 4:
				$jumlah = $amount*($bns->level_4/100);
				break;
			case 5:
				$jumlah = $amount*($bns->level_5/100);
				break;
			case 6:
				$jumlah = $amount*($bns->level_6/100);
				break;
			case 7:
				$jumlah = $amount*($bns->level_7/100);
				break;
			case 8:
				$jumlah = $amount*($bns->level_8/100);
				break;
			case 9:
				$jumlah = $amount*($bns->level_9/100);
				break;
			case 10:
				$jumlah = $amount*($bns->level_10/100);
				break;
		}
		return $this->db->insert("bsn_reff",[
			'from'=>$members,
			'receive'=>$upline,
			'amount'=>$jumlah
		]);
	}
}