<?php
/**
 * 
 */
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("model_app",'app');
		$this->app->cekSession();
		$this->app->cekPaket();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'member'=>$this->db->like('created_at',date("Y-m-d"))->get("members")->result(),
			'downline'=>$this->db->like('created_at',date("Y-m-d"))->get_where("members",['upline'=>$this->session->userdata('username')])->result(),
			'subcribe'=>$this->db->get_where('subcribe',['members'=>$this->session->userdata('username'),'status'=>1])->num_rows(),
		];
		$this->template->load("template",'home',$data);
	}
	public function hitung()
	{
		$paket = $this->db->select('paket.amount,subcribe.created_at')->join('paket','paket.id=subcribe.paket')->order_by('subcribe.id','desc')->get_where("subcribe",['members'=>$this->session->userdata('username')])->row();
		$roi = $paket->amount*(1/100);
		echo $roi;
	}
	public function ticket()
	{
		$data = [
			'title'=>"Ticket",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'balance'=>$this->db->select_sum('amount')->get_where('usdt',['members'=>$this->session->userdata('username'),'status'=>1])->row(),
			'ticket'=>$this->db->get_where("code_ticket",['members'=>$this->session->userdata('username'),'status'=>0])->result(),
			'usdt'=>$this->db->get_where("usdt",['members'=>$this->session->userdata('username'),'status'=>0])->row(),
			'buy'=>$this->db->select_sum('total')->get_where("ticket",['members'=>$this->session->userdata('username')])->row(),
		];
		$this->template->load("template",'ticket',$data);
	}
	public function not_found()
	{
		$data = [
			'title'=>"404 Not Found",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'member'=>$this->db->like('created_at',date("Y-m-d"))->get("members")->result(),
		];
		$this->template->load("template",'not_found',$data);
	}
	public function profile()
	{
		$data = [
			'title'=>"404 Not Found",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'member'=>$this->db->like('created_at',date("Y-m-d"))->get("members")->result(),
		];
		$this->template->load("template",'profile',$data);
	}
	public function deposit()
	{
		jsons();
		$save = $this->db->insert("usdt",['amount'=>$this->input->post('amount'),'members'=>$this->session->userdata("username")]);
		if ($save) {
			json_success("Deposit USDT is successful",null);
		}else{
			json_error("Deposit USDT failed",null);
		}
	}
	public function conf_deposit()
	{
		jsons();
		$save = $this->db->update("usdt",['hash'=>$this->input->post('hash')],['id'=>$this->input->post('id')]);
		if ($save) {
			json_success("Deposit USDT is successful",null);
		}else{
			json_error("Deposit USDT failed",null);
		}
	}
	function getRandomStr($n) {
	  //$n = jumlah karakter
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $n; $i++) {
	        $index = rand(0, strlen($characters) - 1);
	        $randomString .= $characters[$index];
	    }
	    return $randomString;
	}
	public function buy_ticket()
	{
		jsons();
		$username = $this->session->userdata("username");
		$user = $this->db->get_where("members",['username'=>$this->session->userdata('username')])->row();
		switch ($user->position) {
			case 0:
				$usdt = 7;
				break;
			case 1:
				$usdt = 6;
				break;
			case 2:
				$usdt = 5;
				break;
			case 3:
				$usdt = 4;
				break;
			case 4:
				$usdt = 3;
				break;
			case 5:
				$usdt = 2;
				break;
			case 6:
				$usdt = 1;
				break;
			
		}
		$saldo = $this->db->select_sum("amount")->get_where('usdt',['members'=>$username,'status'=>1])->row();
		$harga = $this->input->post('amount')*$usdt;
		if ($saldo->amount > $harga) {
			$save = $this->db->insert("ticket",[
				'count'=>$this->input->post('amount'),
				'members'=>$username,
				'price'=>$usdt,
				'total'=>$usdt*$this->input->post('amount'),
				'status'=>1
			]);
			$cek_tiket_upline = $this->db->join('members','members.username=code_ticket.members')->get_where("code_ticket",['code_ticket.members'=>$user->upline,'members.position'=>1])->row();
			$count_cek_tiket_upline = $this->db->get_where("code_ticket",['members'=>$user->upline])->num_rows();
			if ($cek_tiket_upline) {
				if ($count_cek_tiket_upline > $this->input->post('amount')) {
					$sisa = 0;
					for ($i=0; $i < $this->input->post('amount') ; $i++) { 
						$this->db->update('code_ticket',['receiver'=>$username,'send'=>1],['members'=>$user->upline,'send'=>0]);
					}
				}else if ($count_cek_tiket_upline == $this->input->post('amount')){
					$sisa = 0;
					for ($i=0; $i < $this->input->post('amount') ; $i++) { 
						$this->db->update('code_ticket',['receiver'=>$username,'send'=>1],['members'=>$user->upline,'send'=>0]);
					}
				}else{
					$sisa = $this->input->post('amount') - $count_cek_tiket_upline;
					for ($i=0; $i < $count_cek_tiket_upline ; $i++) { 
						$this->db->update('code_ticket',['receiver'=>$username,'send'=>1],['members'=>$user->upline,'send'=>0]);
					}
				}
			}else{
				$sisa = $this->input->post('amount');
			}
			
				if ($save) {
					for ($i=0; $i < $sisa ; $i++) { 
						$this->db->insert('code_ticket',[
							'members'=>$username,
							'ticket'=>$this->getRandomStr(9)
						]);
					}
					json_success("Buy Ticket is successful",null);
				}else{
					json_error("Buy Ticket failed",null);
				}
		}else{
			json_error("Your balance not enought ".$usdt,null);
		}
		
	}
	public function update_profile()
	{
		jsons();
		$data = $this->input->post();
		$username = $this->session->userdata("username");
		if ($data['password'] == "") {
			$this->db->update("members",['wallet'=>$data['wallet']],['username'=>$username]);
		}else{
			$this->db->update("members",['wallet'=>$data['wallet'],'password'=>password_hash($data['password'], PASSWORD_DEFAULT)],['username'=>$username]);
		}
		json_success("Update Profile is successful",null);
	}
	public function transfer()
	{
		jsons();
		$data = $this->input->post();
		$cekuser = $this->db->get_where("members",['username'=>$data['username']])->num_rows();
		if ($cekuser == 0) {
			json_error("Username not registered ",null);
		}else{
			$total_tiket = $this->db->get_where("code_ticket",['members'=>$this->session->userdata("username")])->num_rows();
			if ($total_tiket < $data['amount']) {
				json_error("Your have not enoughr ticket ",null);
			}else{
				$result = $this->db->get_where("code_ticket",['members'=>$this->session->userdata("username"),'send'=>0,'status'=>0,'receiver'=>""],$data['amount'])->result();
				$count = 0;
				foreach ($result as $key) {
					$count++;
					$this->db->update("code_ticket",['send'=>1,'receiver'=>$data['username'],'status'=>1],['ticket'=>$key->ticket]);
					$this->db->insert("code_ticket",['members'=>$data['username'],'ticket'=>$key->ticket]);
				}
				if ($count == $data['amount']) {
					json_success("Transfer Ticket successful",null);
				}
			}
		}
	}
	public function transfer_engine()
	{
		jsons();
		$data = $this->input->post();
		$cekuser = $this->db->get_where("members",['username'=>$data['username']])->num_rows();
		if ($cekuser == 0) {
			json_error("Username not registered ",null);
		}else{
			$total_tiket = $this->db->get_where("engine",['members'=>$this->session->userdata("username")])->num_rows();
			if ($total_tiket < $data['amount']) {
				json_error("Your have not enoughr engine ",null);
			}else{
				$result = $this->db->get_where("engine",['members'=>$this->session->userdata("username"),'send'=>0,'status'=>0,'receiver'=>""],$data['amount'])->result();
				$count = 0;
				foreach ($result as $key) {
					$count++;
					$this->db->update("engine",['send'=>1,'receiver'=>$data['username'],'status'=>1],['code'=>$key->code]);
					$this->db->insert("engine",['members'=>$data['username'],'code'=>$key->code]);
				}
				if ($count == $data['amount']) {
					json_success("Transfer Engine successful",null);
				}
			}
		}
	}
	public function genrate($id)
	{
		jsons();
		for ($i=0; $i < $id; $i++) { 
			$this->db->insert('code_ticket',[ 'members'=>$_GET['username'],'ticket'=>$this->getRandomStr(9)]);
		}
		echo json_encode(["code"=>200,"message"=>"success"]);
	}
	public function infak()
	{
		jsons();
		$data = $this->input->post();
		$insert= [
			'amount'=>$data['amount'],
			'members'=>$this->session->userdata("username")
		];
		$this->db->insert("infaq",$insert);
		json_success("Transaction Infak successful",null);
	}
	public function start_engine()
	{
		jsons();
		$data = $this->input->post();
		$cekuser = $this->db->get_where("engine",['code'=>$data['engine'],'status'=>0,'send'=>0,'receiver'=>""]);
		if ($cekuser->num_rows() == 0) {
			json_error("Engine not registered ",null);
		}else{
			$row = $cekuser->row();
			if ($row->members != $this->session->userdata("username")) {
				json_error("Engine Not Allowed",null);
			}else if ($row->status != 0) {
				json_error("Engine Not Available",null);
			}else{
				$this->db->update("engine",['status'=>1],['members'=>$this->session->userdata("username")]);
				json_success("Engine is startted",null);
			}
		}
	}
}