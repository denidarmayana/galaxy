<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">History Ticket</h4>
			</div>
			<div class="card-body">
				<table id="example" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Date</th>
							<th>ticket</th>
							<th>Receiver</th>
							<th>Send</th>
							<th>Status</th>
						</tr>
					</thead>
					<?php $wd_hst = $this->db->get_where('code_ticket',['members'=>$this->session->userdata("username")])->result();
					$no=0;
					foreach ($wd_hst as $key) { $no++;
						echo "<tr><td>".$no."</td><td>".$key->created_at."</td><td>".$key->ticket."</td><td>".$key->receiver."</td><td>".($key->send ==1 ? "SENDING":"")."</td><td>".($key->status == 0 ? "AVAILABLE" : "SUCCESS")."</td></tr>";
					} ?>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">term and Condition</h3>
			</div>
			<div class="card-body">
				<p>To be able to make a bonus withdrawal, you must have a ticket for bonus withdrawals</p>
				<p>To get a bonus drawing ticket, you must buy it at a price of 
					<?php 
					switch ($user->position) {
						case 0:
							echo '<span class="font-w600 text-success">7 USDT</span>';
							break;
						case 1:
							echo '<span class="font-w600 text-success">6 USDT</span>';
							break;
						case 2:
							echo '<span class="font-w600 text-success">5 USDT</span>';
							break;
						case 3:
							echo '<span class="font-w600 text-success">4 USDT</span>';
							break;
						case 4:
							echo '<span class="font-w600 text-success">3 USDT</span>';
							break;
					}
					 ?>
				for one ticket, and is valid for one time use</p>
			</div>
			<div class="card-footer">
				<h4 class="card-title">Balance <span class="float-end text-success"><?=number($balance->amount-($buy ? $buy->total : 0) ) ?> USDT</span> </h4>
			</div>
		</div>
	</div>
	<?php if ($user->position > 0) { ?>
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Transfer Ticket</h3>
			</div>
			<div class="card-body">
				<?php 
				$tiket = $this->db->get_where("code_ticket",['members'=>$this->session->userdata("username")])->num_rows(); 
				if ($tiket != 0) {
				?>
					<div class="form-group">
						<label class="mb-1"><strong>Amount</strong></label>
						<input type="text" id="amount_tf" class="form-control" placeholder="0">
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Username</strong></label>
						<input type="text" id="username_tf"  class="form-control" placeholder="user_id">
					</div>
					<div class="text-center">
							<button type="button"  id="transfer_tiket" class="btn btn-primary btn-block">Submit</button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<?php $jml_tiket = $this->db->get_where("code_ticket",['members'=>$this->session->userdata("username"),'status'=>0])->num_rows(); ?>
					<div class="col-sm-7">
						<h6 class="card-title">My Ticket</h6>
					</div>
					<div class="col-sm-5">
						<span class="text-warning"><?=$jml_tiket ?> Ticket</span>		
					</div>
				</div>
			</div>
			<div class="card-body">
				<ul>
				<?php
				foreach ($ticket as $key) {
					echo '<li>'.$key->ticket.'</li>';
				}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>