<?php
/**
 * 
 */
class Downline extends CI_Controller
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
			'downline'=>$this->db->get_where("members",['upline'=>$this->session->userdata('username')])->result(),
		];
		$this->template->load("template",'downline',$data);
	}
}