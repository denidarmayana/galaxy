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
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Balance</h4>
			</div>
			<div class="card-body">
				<h5 class="text-black">Balance : <span class="text-success"> <?=number_format($saldo_akhir,0,',','.') ?> MBIT</span></h5>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Infak</h4>
			</div>
			<div class="card-body">
				<input type="hidden" id="saldo" value="<?=$saldo_akhir ?>">
				<div class="form-group">
					<label class="mb-1"><strong>Amount Infak</strong></label>
					<input type="text" id="amount_infak" class="form-control" placeholder="0">
				</div>
				<div class="text-center">
					<button type="submit" id="act_infak" class="btn btn-primary btn-block">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header table-responsive">
				<h4 class="card-title">History</h4>
			</div>
			<div class="card-body">
				<table id="example" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Date</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php $results = $this->db->get_where("infaq",['members'=>$this->session->userdata("username")])->result();
						$no=0;
						foreach ($results as $key) { $no++;
							echo "<tr ><td class='text-black'>".$no."</td><td class='text-black'>".$key->created_at."</td><td class='text-black'>".$key->amount."</td></tr>";
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>