<?php
/**
 * 
 */
class Package extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("model_app",'app');
		$this->app->cekSession();
	}
	public function index()
	{
		$data = [
			'title'=>"Package",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'paket'=>$this->db->get("paket")->result(),
			'subcribe'=>$this->db->select('paket.name,subcribe.status,paket.amount')->join('paket','paket.id=subcribe.paket')->order_by('subcribe.id','desc')->get_where("subcribe",['members'=>$this->session->userdata('username')])->row()
			
		];
		$this->template->load("template",'package',$data);
	}
	public function subcribe()
	{
		jsons();
		$header = $this->input->get_request_header('Authorization', TRUE);
		if ($header == "") {
			redirect('forbiden');
		}else{
			$head = json_decode(verify_jwt($header));
			$save = $this->db->insert("subcribe",[
				'members'=>$head->user_id,
				'paket'=>$this->input->post("paket")
			]);
			if ($save) {
				json_success("You have successfully subscribed to our package",null);
			}else{
				json_error("You failed to subscribe to our package",null);
			}
		}
	}
}