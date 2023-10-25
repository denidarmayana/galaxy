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
		$this->app->cekPaket();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function daily()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'roi'=>$this->db->order_by('created_at','asc')->get_where("roi",['members'=>$this->session->userdata('username')])->result(),
			
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
			'peringkat'=>$this->db->get("peringkat")->result(),
			
		];
		$this->template->load("template",'reward',$data);
	}
	public function withdrawal()
	{
		$data = [
			'title'=>"Dashboard",
			'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
			'roi'=>$this->db->get_where("bsn_reff",['receive'=>$this->session->userdata('username')])->result(),
			'invoice'=>$this->app->inv_wd(),
			
		];
		$this->template->load("template",'withdrawal',$data);
	}
	public function deposit_usdt()
	{
		// $data = [
		// 	'title'=>"Dashboard",
		// 	'user'=>$this->db->get_where("members",['username'=>$this->session->userdata('username')])->row(),
		// 	'usdt'=>$this->db->get_where("usdt",['members'=>$this->session->userdata('username')])->result(),
			
		// ];
		// $this->template->load("template",'deposit_usdt',$data);
		reridect("home");
	}
	function getRandomStr($n) {
	  //$n = jumlah karakter
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $n; $i++) {
	        $index = rand(0, strlen($characters) - 1);
	        $randomString .= $characters[$index];
	    }
	    return $randomString;
	}
	public function send_email($email,$pesan) {
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.zoho.com', // Ganti dengan alamat SMTP Anda
            'smtp_port' => 465, // Ganti dengan port SMTP Anda
            'smtp_user' => 'tecnical.support@galaxy7.tech', // Ganti dengan alamat email Anda
            'smtp_pass' => 'Galaxy@2023', // Ganti dengan kata sandi email Anda
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );

        $this->email->initialize($config);

        // Set pengirim email
        $this->email->from('tecnical.support@galaxy7.tech', 'OTP Galaxy Seven');

        // Set penerima email
        $this->email->to($email);

        // Set subjek email
        $this->email->subject('OTP Withdrawal Galaxy Seven');

        // Set isi pesan email
        $this->email->message($pesan);

        // Kirim email
        return $this->email->send();
    }
	public function act_wd()
	{
		jsons();
		$user = $this->db->get_where("members",['username'=>$this->session->userdata('username')])->row();
		if ($user->wallet == "") {
			json_error("Pleace insert your wallet address",null);
		}else{
			$save = $this->db->insert("widthdrawal",[
				'members'=>$this->session->userdata("username"),
				'amount'=>$this->input->post("amount"),
				'fee'=>$this->input->post("fee"),
				'invoice'=>$this->input->post("invoice"),
				'net'=>$this->input->post("net"),
				'created_at'=>date("Y-m-d H:i:s")
			]);
			if ($save) {
				$cekotp = $this->db->get_where("otp_wd",['members'=>$this->session->userdata("username"),'invoice'=>$this->input->post("invoice"),'status'=>0])->num_rows();
				if ($cekotp == 0) {
					$this->db->insert("otp_wd",['code'=>$this->getRandomStr(6),'members'=>$this->session->userdata("username"),"invoice"=>$this->input->post("invoice")]);
				}
				
				$users = $this->db->get_where("members",['username'=>$this->session->userdata("username")])->row();
				$otp = $this->db->get_where("otp_wd",['members'=>$this->session->userdata("username"),'invoice'=>$this->input->post("invoice")])->row();
				$pesan ="<p>Yth, Bapak/Ibu ".$users->name."</p>";
				$pesan.="<p>anda akan melakukan penarikan dengan data dibawahini :</p>";
				$pesan.="<p>Jumlah : ".$this->input->post("amount")."<br>Invoice : ".$this->input->post("invoice")."<br>";
				$pesan.="Wallet : ".$users->wallet."</p>";
				$pesan.="<p>untuk melanjutkan transaksi ini, silahkan masukan kode berikut </p>";
				$pesan.="<p><b>".$otp->code."</b></p>";
				$pesan.="<p>Jaga kerahasiaan kode OTP Penarikan anda</p>";
				$this->send_email($users->email,$pesan);
				$this->db->update("engine",['status'=>2],['members'=>$this->session->userdata("username"),'status'=>1]);
				$this->db->update("code_ticket",['status'=>1],['ticket'=>$this->input->post("tiket")]);
				json_success("Withdrawal data successfully entered the queue",null);
			}else{
				json_error("Withdrawal data failed to enter the queue",null);
			}
		}
		
	}
}