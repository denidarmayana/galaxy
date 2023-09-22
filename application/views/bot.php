<?php
$paket = $this->db->select("paket.*")->order_by('subcribe.id','desc')->join('paket','subcribe.paket=paket.id')->get_where("subcribe",['subcribe.members'=>$this->session->userdata("username")])->row();
$bonus_level = $this->db->select_sum("amount")->get_where('bsn_reff',['receive'=>$this->session->userdata("username")])->row();
$roi = $this->db->select_sum("amount")->get_where('roi',['members'=>$this->session->userdata("username")])->row();
$reward = $this->db->select_sum("amount")->get_where('reward',['members'=>$this->session->userdata("username")])->row();
$wd = $this->db->select_sum("amount")->get_where('widthdrawal',['members'=>$this->session->userdata("username")])->row();
$wd_today = $this->db->like('created_at',date("Y-m-d"))->get_where('widthdrawal',['members'=>$this->session->userdata("username")]);
$total_bonus = ($roi->amount+$bonus_level->amount+$reward->amount);
$max = ($paket ? $paket->amount : 0 )*(($paket ? $paket->max : 0)/100);
$min = ($paket ? $paket->amount: 0 )*(10/100);
$infaq = $this->db->select_sum("amount")->get_where('infaq',['members'=>$this->session->userdata("username")])->row();
$saldo_akhir = $total_bonus-($wd->amount+$infaq->amount);
?>
<div class="row">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Bit Bot</h3>
			<span class="float-right text-success">Timer</span>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3 text-center">
					<p class="text-black">Your Bakance <span class="text-warning"><b><?=number_format($saldo_akhir,0,',','.') ?> MBIT</b></span> </p>
					<p class="m-0">Base Trade</p>
					<input type="number" readonly id="base_trade" value="1000" class="form-control">
				</div>
				<div class="col-md-9">
					
				</div>
			</div>
		</div>
	</div>
</div>