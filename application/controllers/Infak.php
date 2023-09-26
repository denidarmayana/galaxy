<?php
/**
 * 
 */
class Infak extends CI_Controller
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
			'title'=>"Infak",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
		];
		$this->template->load("template",'infak',$data);
	}
}