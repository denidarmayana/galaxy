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
?>
<div class="row">
	<div class="col-sm-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">History Withdrawal</h4>
			</div>
			<div class="card-body table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Status</th>
					</tr>
					<?php $wd_hst = $this->db->get_where('widthdrawal',['members'=>$this->session->userdata("username")])->result();
					$no=0;
					foreach ($wd_hst as $key) { $no++;
						echo "<tr><td>".$no."</td><td>".$key->created_at."</td><td>".$key->amount."</td><td>".($key->status == 0 ? "PENDING" : "SUCCESS")."</td></tr>";
					} ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-12">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">
					Current Daily Bonuses
					<?php 
					$subcribe = $this->db->order_by('id','desc')->get_where("subcribe",['members'=>$user->username,'status'=>1])->row();
					if ($subcribe) {
						$pkt = $this->db->get_where("paket",['id'=>$subcribe->paket])->row();
						$harian = $pkt->amount*(1/100);
						$bns_hari = $harian/24;
						$menitan = $bns_hari/60;
						$detik = $menitan/60;
						$cek_roi = $this->db->get_where("roi",['members'=>$user->username,'paket'=>$subcribe->paket])->num_rows();
						if ($cek_roi == 0) {
							$today = selisih_waktu($subcribe->updated_at);
						}else{
							$date_roi = date('Y-m-d H:i:s', strtotime('+'.$cek_roi.' days', strtotime($subcribe->updated_at)));
							$today = selisih_waktu($date_roi);
						}
						$bns_now = ($bns_hari*$today->h)+($menitan*$today->i)+($detik*$today->s);
						?>
						<input type="hidden" value="<?=$detik ?>" id="bns_detik">
						<span id="roi" class="float-end text-success"><?=number_format($bns_now,8,'.',',') ?> MBIT</span>
						
					<?php }else{ ?>
						<input type="hidden" value="0" id="bns_detik">
						<span id="roi" class="float-end text-success"><?=number_format(0.00000000,8,'.',',') ?> MBIT</span>
					<?php } ?>
				</h3>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Terms and Conditions</h3>
			</div>
			<div class="card-body">
				<p class="text-black m-0">1. The fee for each withdrawal is 10% of the total withdrawal</p>
				<p class="text-black m-0">2. Maximum withdrawal of <?=($paket ? $paket->max : 0) ?>% of your subscription package</p>
				<p class="text-black mt-4 mb-0">Active Pakcage <?=($paket ? $paket->name : "No Active Package") ?></p>
				<p class="text-black m-0">Maximum withdrawal <?=number($max) ?> MBIT</p>

				<p class="text-success mt-4 mb-0">Overall Bonuses</p>
				<p class="text-warning m-0">Daily Bonuses : <?=number($roi->amount) ?> MBIT</p>
				<p class="text-info m-0">Bonus Level : <?=number($bonus_level->amount) ?> MBIT</p>
				<p class="text-primary m-0">Reward : <?=number($reward->amount) ?> MBIT</p>
				<p class="text-danger m-0 font-w600" >Total : <?=number($total_bonus) ?> MBIT</p>
				<p class="text-black m-0">Total Withdrawal : <?=number($wd->amount) ?> MBIT</p>
				<p class="text-success m-0">Remaining Bonuses : <?=number($total_bonus-$wd->amount) ?> MBIT</p>
				<input type="hidden" id="total_bonus" value="<?=$total_bonus-$wd->amount ?>">
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Withdrawal Form</h3>
			</div>
			<div class="card-body">
				<?php if (isset($_GET['ticket'])) { 
					$cek = $this->db->get_where("code_ticket",['ticket'=>$_GET['ticket'],"members"=>$this->session->userdata("username"),'send'=>0,'status'=>0])->num_rows();
					if ($cek == 0) {
						echo "Salah";
					}
						
				?>
					<div class="form">
						<?php if ($wd_today->num_rows() == 0) { ?>
						<input type="hidden" id="max_wd" value="<?=$max ?>">
						<input type="hidden" id="min_wd" value="<?=$min ?>">
						<input type="hidden" id="ticket" value="<?=$_GET['ticket'] ?>">
						<div class="form-group">
							<label class="mb-1"><strong>Amount</strong></label>
							<input type="text" id="amount" class="form-control" placeholder="0">
						</div>
						<div class="form-group">
							<label class="mb-1"><strong>Fee Transaction</strong></label>
							<input type="text" id="fee" readonly class="form-control" placeholder="0">
						</div>
						<div class="form-group">
							<label class="mb-1"><strong>Net Amount</strong></label>
							<input type="text" id="net" readonly class="form-control" placeholder="0">
						</div>
						<div class="text-center">
							<button type="button" disabled id="act_wd" class="btn btn-primary btn-block">Submit</button>
						</div>
						<?php } ?>
					</div>
					<?php } else{ 
						?>
						<form method="get">
						<div class="form-group">
							<label class="mb-1"><strong>Ticket Withdrawal</strong></label>
							<input type="text" name="ticket" class="form-control" placeholder="Insert your ticket">
						</div>
						<div class="text-center">
							<button type="submit" id="act_wd" class="btn btn-primary btn-block">Submit</button>
						</div>
						</form>
					<?php } ?>
				
			</div>
		</div>
	</div>
</div>