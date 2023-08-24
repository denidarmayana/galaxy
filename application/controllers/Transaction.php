<?php
/**
 * 
 */
class Transaction extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("model_app",'app');
		$this->app->cekSession();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function daily()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'roi'=>$this->db->get_where("roi",['members'=>$this->session->userdata('username')])->result(),
			
		];
		$this->template->load("template",'daily',$data);
	}
	public function referral()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'roi'=>$this->db->get_where("bsn_reff",['receive'=>$this->session->userdata('username')])->result(),
			
		];
		$this->template->load("template",'level',$data);
	}
	public function reward()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'roi'=>$this->db->get_where("bsn_reff",['receive'=>$this->session->userdata('username')])->result(),
			
		];
		$this->template->load("template",'reward',$data);
	}
	public function withdrawal()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'roi'=>$this->db->get_where("bsn_reff",['receive'=>$this->session->userdata('username')])->result(),
			
		];
		$this->template->load("template",'withdrawal',$data);
	}
}