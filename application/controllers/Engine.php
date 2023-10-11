<?php
/**
 * 
 */
class Engine extends CI_Controller
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
			'engine'=>$this->db->get_where("engine",['members'=>$this->session->userdata('username'),'status'=>0])->result(),
		];
		$this->template->load("template",'engine',$data);
	}
}