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
			'member'=>$this->db->like('created_at',date("Y-m-d"))->get("members")->result(),
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
}