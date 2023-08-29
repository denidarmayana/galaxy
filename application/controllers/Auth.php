<?php
/**
 * 
 */



class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
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
		$active_paket = $this->db->select('members.upline,subcribe.*')->join('members','members.username=subcribe.members')->order_by('subcribe.id','desc')->get_where("subcribe",['subcribe.id'=>$_GET['id']])->row();
		if ($active_paket->paket == 2) {
			$manager = $this->db->get_where("qualified",['members'=>$active_paket->upline,'position'=>1]);
			if ($manager->num_rows() == 0) {
				$this->db->insert('qualified',[
					'members'=>$active_paket->upline,
					'position'=>1,
					'count'=>1,
					'created_at'=>date("Y-m-d H:i:s")
				]);
			}else{
				$row_manager = $manager->row();
				$new_count = $row_manager->count+1;
				$this->db->update("qualified",['count'=>$new_count],['members'=>$active_paket->upline,'position'=>1]);
				if ($manager->num_rows() == 5) {
					$cek_manager = $this->db->get_where("subcribe",['members'=>$active_paket->upline,'paket'=>2])->row();
					if ($cek_manager) {
						$this->db->update("members",['position'=>1],['username'=>$active_paket->upline]);
					}	
				}
			}
		}
		//qualufued manager
		if ($active_paket->paket == 3) {
			$shapire = $this->db->get_where("qualified",['members'=>$active_paket->upline,'position'=>2]);
			if ($shapire->num_rows() == 0) {
				$this->db->insert('qualified',[
					'members'=>$active_paket->upline,
					'position'=>2,
					'count'=>1,
					'created_at'=>date("Y-m-d H:i:s")
				]);
			}else{
				$row_shapire = $shapire->row();
				$new_count = $row_shapire->count+1;
				$this->db->update("qualified",['count'=>$new_count],['members'=>$active_paket->upline,'position'=>2]);
				if ($shapire->num_rows() == 5) {
					$cek_shapire = $this->db->get_where("subcribe",['members'=>$active_paket->upline,'paket'=>3])->row();
					if ($cek_shapire) {
						$this->db->update("members",['position'=>2],['username'=>$active_paket->upline]);
					}	
				}
			}
		}
		//qualufued shapire
		if ($active_paket->paket == 4) {
			$ruby = $this->db->get_where("qualified",['members'=>$active_paket->upline,'position'=>3]);
			if ($ruby->num_rows() == 0) {
				$this->db->insert('qualified',[
					'members'=>$active_paket->upline,
					'position'=>3,
					'count'=>1,
					'created_at'=>date("Y-m-d H:i:s")
				]);
			}else{
				$row_ruby = $ruby->row();
				$new_count = $row_ruby->count+1;
				$this->db->update("qualified",['count'=>$new_count],['members'=>$active_paket->upline,'position'=>3]);
				if ($ruby->num_rows() == 5) {
					$cek_ruby = $this->db->get_where("subcribe",['members'=>$active_paket->upline,'paket'=>4])->row();
					if ($cek_ruby) {
						$this->db->update("members",['position'=>3],['username'=>$active_paket->upline]);
					}		
				}
			}
		}
		//qualufued shapire
		$this->db->update("subcribe",['status'=>1,'updated_at'=>date("Y-m-d H:i:s")],['id'=>$_GET['id']]);
		$this->db->update("members",['status'=>1],['username'=>$subcribe->username]);
		redirect("control/subcribe");
	}
}