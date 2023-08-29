<?php
/**
 * 
 */
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data = [
			'title'=>"Auth Panel",
		];
		$this->load->view('admin/auth');
	}
	public function action()
	{
		jsons();
		$data = $this->input->post();
		$username = "galaxy";
		$password = md5("galaxy@2023");
		if ($data['username'] == $username) {
			if(md5($data['password']) == $password){
				$this->session->set_userdata([
					'is_admin'=>TRUE,
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
}