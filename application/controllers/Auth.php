<?php
/**
 * 
 */



class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("model_app",'app');
	}
	public function cek_token($id)
	{
		jsons();
		$data = json_decode(verify_jwt($id));
		$time = time();
		$berakhir = $data->exp;
		if ($berakhir <= $time) {
			$this->session->sess_destroy();
			redirect("home");
		}
		
	}
	public function index()
	{
		$this->load->view("auth");
	}
	public function register()
	{
		$data = [
			'reff'=>($this->session->flashdata("upline") ? $this->session->flashdata("upline") : "galaxy")
		];
		$this->load->view("register",$data);
	}
	public function act_register()
	{
		jsons();
		$data = $this->input->post();
		$cek = $this->db->get_where("members",['username'=>$data['username']])->num_rows();
		if ($cek == 1) {
			json_error("Username already in use, please use another username",null);
		}else{
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$save =  $this->db->insert("members",$data);
			if ($save) {
				json_success("Member registration is successful",null);
			}else{
				json_error("Member registration failed",null);
			}
		}
	}
	public function act_auth()
	{
		jsons();
		$data = $this->input->post();
		$cek = $this->db->get_where("members",['username'=>$data['username']]);
		if ($cek->num_rows() == 1) {
			$row = $cek->row();
			if(password_verify($data['password'], $row->password)){
				$this->session->set_userdata([
					'login'=>TRUE,
					'username'=>$data['username']
				]);
				json_success("You have successfully logged in",generate_jwt($data['username']));
			}else{
				json_error("The password you entered does not match",null);
			}
		}else{
			json_error("The username you entered is not registered",null);
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
	public function reff()
	{
		$this->session->set_flashdata("upline",$this->uri->segment(2));
		redirect('register');
	}
	public function activation()
	{
		$subcribe = $this->app->username_sucribe($_GET['id']);
		$level_1 = $this->app->level($subcribe->username);
		if ($level_1) {
			$this->app->bonus_level($level_1->username,$level_1->upline,$subcribe->amount,1);
			$level_2 = $this->app->level($level_1->upline);
			if ($level_2) {
				$this->app->bonus_level($level_1->username,$level_2->upline,$subcribe->amount,2);
				$level_3 = $this->app->level($level_2->upline);
				if ($level_3) {
					$this->app->bonus_level($level_1->username,$level_3->upline,$subcribe->amount,3);
					$level_4 = $this->app->level($level_3->upline);
					if ($level_4) {
						$this->app->bonus_level($level_1->username,$level_4->upline,$subcribe->amount,4);
						$level_5 = $this->app->level($level_4->upline);
						if ($level_5) {
							$this->app->bonus_level($level_1->username,$level_5->upline,$subcribe->amount,5);
							$level_6 = $this->app->level($level_5->upline);
							if ($level_6) {
								$this->app->bonus_level($level_1->username,$level_6->upline,$subcribe->amount,6);
								$level_7 = $this->app->level($level_6->upline);
								if ($level_7) {
									$this->app->bonus_level($level_1->username,$level_7->upline,$subcribe->amount,7);
									$level_8 = $this->app->level($level_7->upline);
									if ($level_8) {
										$this->app->bonus_level($level_1->username,$level_8->upline,$subcribe->amount,8);
										$level_9 = $this->app->level($level_8->upline);
										if ($level_9) {
											$this->app->bonus_level($level_1->username,$level_9->upline,$subcribe->amount,9);
											$level_10 = $this->app->level($level_9->upline);
											if ($level_10) {
												$this->app->bonus_level($level_1->username,$level_10->upline,$subcribe->amount,10);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		//Bonus Level
		$this->db->update("subcribe",['status'=>1],['id'=>$_GET['id']]);
	}
}