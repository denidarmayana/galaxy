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
	function cekControl()
	{
		if ($this->session->userdata("is_admin") == TRUE) {
			return TRUE;
		}else{
			redirect("login");
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
	public function cekPaket()
	{
		$sub = $this->db->select('paket.amount')->order_by('subcribe.id','desc')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['subcribe.members'=>$this->session->userdata("username")])->row();
		$limit = $sub->amount * (300/100);
		$bns_level = $this->db->select_sum("amount")->get_where("bsn_reff",['receive'=>$this->session->userdata("username")])->row();
		$roi = $this->db->select_sum("amount")->get_where("roi",['members'=>$this->session->userdata("username")])->row();
		$penerimaan = $bns_level->amount+$roi->amount;
		if ($penerimaan >= $limit ) {
			if($this->session->userdata("username") != "Pejuangtangguh"){
				redirect("package");
			}
			
		}else{
			return TRUE;
		}
	}
}