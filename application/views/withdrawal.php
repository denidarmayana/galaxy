<?php
$paket = $this->db->select("paket.*")->join('paket','subcribe.paket=paket.id')->get_where("subcribe",['subcribe.members'=>$this->session->userdata("username")])->row();
$bonus_level = $this->db->select_sum("amount")->get_where('bsn_reff',['receive'=>$this->session->userdata("username")])->row();
$roi = $this->db->select_sum("amount")->get_where('roi',['members'=>$this->session->userdata("username")])->row();
$reward = $this->db->select_sum("amount")->get_where('reward',['members'=>$this->session->userdata("username")])->row();
$wd = $this->db->select_sum("amount")->get_where('widthdrawal',['members'=>$this->session->userdata("username")])->row();
$wd_today = $this->db->like('created_at',date("Y-m-d"))->get_where('widthdrawal',['members'=>$this->session->userdata("username")]);
$total_bonus = ($roi->amount+$bonus_level->amount+$reward->amount);
$max = $paket->amount*(20/100);
$min = $paket->amount*(10/100);
?>
<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Terms and Conditions</h3>
			</div>
			<div class="card-body">
				<p class="text-black m-0">1. The fee for each withdrawal is 10% of the total withdrawal</p>
				<p class="text-black m-0">2. Minimum withdrawal of 10% of your subscription package</p>
				<p class="text-black m-0">3. Maximum withdrawal of 20% of your subscription package</p>
				<p class="text-black mt-4 mb-0">Active Pakcage <?=$paket->name ?></p>
				<p class="text-black m-0">Maximum withdrawal <?=number($max) ?> MBIT</p>
				<p class="text-black m-0">Minimum withdrawal <?=number($min) ?> MBIT</p>

				<p class="text-success mt-4 mb-0">Overall Bonuses</p>
				<p class="text-warning m-0">Daily Bonuses : <?=number($roi->amount) ?> MBIT</p>
				<p class="text-info m-0">Bonus Level : <?=number($bonus_level->amount) ?> MBIT</p>
				<p class="text-primary m-0">Reward : <?=number($reward->amount) ?> MBIT</p>
				<p class="text-danger m-0 font-w600" >Total : <?=number($total_bonus) ?> MBIT</p>
				<p class="text-black m-0">Total Withdrawal : <?=number($wd->amount) ?> MBIT</p>
				<p class="text-success m-0">Remaining Bonuses : <?=number($total_bonus-$wd->amount) ?> MBIT</p>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Withdrawal Form</h3>
			</div>
			<div class="card-body">
				<?php if ($wd_today->num_rows() == 0) { ?>
				<input type="hidden" id="max_wd" value="<?=$max ?>">
				<input type="hidden" id="min_wd" value="<?=$min ?>">
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
		</div>
	</div>
</div>