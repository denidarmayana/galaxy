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
		$usdt = $this->input->post("amount")*7;
		$saldo = $this->db->select_sum('amount')->get_where("usdt",['members'=>$username,'status'=>1])->row();
		$sisa_saldo = $saldo->amount-$usdt;
		$this->db->update('usdt',['amount'=>$sisa_saldo],['members'=>$username]);
		$save = $this->db->insert("ticket",['count'=>$this->input->post('amount'),'members'=>$username,'status'=>1]);
		if ($save) {
			for ($i=0; $i < $this->input->post('amount') ; $i++) { 
				$this->db->insert('code_ticket',[
					'members'=>$username,
					'ticket'=>$this->getRandomStr(9)
				]);
			}
			json_success("Buy Ticket is successful",null);
		}else{
			json_error("Buy Ticket failed",null);
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
}