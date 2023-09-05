<?php
/**
 * 
 */
class Control extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("model_app",'app');
		$this->app->cekControl();
	}
	public function index()
	{
		$users = [
			'name'=>'Administrator',
			'email'=>'admin@galaxy7.tech'
		];
		$data = [
			'title'=>"Dashboard Panel",
			'user'=>$users,
			'members_today'=>$this->db->like('created_at',date("Y-m-d"))->get("members")->num_rows(),
			'members'=>$this->db->like('created_at',date("Y-m-d"))->get("members")->result(),
			'all_members'=>$this->db->get("members")->num_rows(),
			'omset'=>$this->db->select_sum("amount")->get_where("subcribe",['status'=>1])->row(),
			'subcribe'=>$this->db->order_by('subcribe.id','desc')->join('members','members.username=subcribe.members')->like("subcribe.created_at",date("Y-m-d"))->get("subcribe")->result(),
		];
		$this->template->load("admin",'admin/home',$data);
	}
	public function members()
	{
		$users = [
			'name'=>'Administrator',
			'email'=>'admin@galaxy7.tech'
		];
		$data = [
			'title'=>"Members",
			'user'=>$users,
			'members'=>$this->db->order_by('id','desc')->get("members")->result(),
		];
		$this->template->load("admin",'admin/members',$data);
	}
	public function subcribe()
	{
		$users = [
			'name'=>'Administrator',
			'email'=>'admin@galaxy7.tech'
		];
		$data = [
			'title'=>"Members",
			'user'=>$users,
			'subcribe'=>$this->db->select('members.name,subcribe.*')->join('members','members.username=subcribe.members')->order_by('subcribe.id','desc')->get("subcribe")->result(),
		];
		$this->template->load("admin",'admin/subcribe',$data);
	}
	
	public function withdrawal()
	{
		$users = [
			'name'=>'Administrator',
			'email'=>'admin@galaxy7.tech'
		];
		$data = [
			'title'=>"Widthdrawal",
			'user'=>$users,
			'widthdrawal'=>$this->db->select('members.name,widthdrawal.*')->join('members','members.username=widthdrawal.members')->order_by('widthdrawal.id','desc')->get("widthdrawal")->result(),
		];
		$this->template->load("admin",'admin/widthdrawal',$data);
	}
	public function ticket()
	{
		$users = [
			'name'=>'Administrator',
			'email'=>'admin@galaxy7.tech'
		];
		$data = [
			'title'=>"Widthdrawal",
			'user'=>$users,
			'deposit'=>$this->db->select('members.name,usdt.*')->order_by('usdt.id','desc')->join('members','members.username=usdt.members')->get("usdt")->result(),
		];
		$this->template->load("admin",'admin/ticket',$data);
	}
	
	public function genrate()
	{
		for ($i=0; $i < 100; $i++) { 
			$this->db->insert('ticket',[
				'owner'=>'galaxy',
				'code'=>$this->getRandomStr(9),
				'created_at'=>date("Y-m-d")
			]);
		}
	}
	public function update_profile()
	{
		jsons();
		$data = $this->input->post();
		if ($data['password'] == "") {
			$this->db->update("members",['wallet'=>$data['wallet']],['id'=>$data['id']]);
		}else{
			$this->db->update("members",['wallet'=>$data['wallet'],'password'=>password_hash($data['password'], PASSWORD_DEFAULT)],['id'=>$data['id']]);
		}
		json_success("Update Profile is successful",null);
	}
	public function sumary()
	{
		$users = [
			'name'=>'Administrator',
			'email'=>'admin@galaxy7.tech'
		];
		$data = [
			'title'=>"Sumary",
			'user'=>$users,
		];
		$this->template->load("admin",'admin/sumary',$data);
	}
}