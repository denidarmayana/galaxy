<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">History Engine</h4>
			</div>
			<div class="card-body table-responsive">
				<table id="example" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Date</th>
							<th>Engine</th>
							<th>Status</th>
						</tr>
					</thead>
					<?php $wd_hst = $this->db->get_where('engine',['members'=>$this->session->userdata("username")])->result();
					$no=0;
					foreach ($wd_hst as $key) { $no++;
						switch ($key->status) {
							case 0:
								$status = "Available";
								break;
							case 1:
								$status = "Active";
								break;
							case 2:
								$status = "Not Active";
								break;
						}
						echo "<tr><td>".$no."</td><td>".$key->created_at."</td><td>".$key->code."</td><td>".$status."</td></tr>";
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
					
				for one ticket, and is valid for one time use</p>
			</div>
			
		</div>
	</div>
	<?php if ($user->position > 0) { ?>
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Transfer Engine</h3>
			</div>
			<div class="card-body">
				<?php 
				$tiket = $this->db->get_where("engine",['members'=>$this->session->userdata("username")])->num_rows(); 
				if ($tiket != 0) {
				?>
					<div class="form-group">
						<label class="mb-1"><strong>Amount</strong></label>
						<input type="text" id="amount_engine" class="form-control" placeholder="0">
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Username</strong></label>
						<input type="text" id="username_engine"  class="form-control" placeholder="user_id">
					</div>
					<div class="text-center">
							<button type="button"  id="transfer_engine" class="btn btn-primary btn-block">Submit</button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title">Engine</h6>
				<span class="text-success float-end">
					<?php $eng = $this->db->get_where("engine",['members'=>$this->session->userdata("username"),'status'=>0])->num_rows(); echo "Count Engine : ".$eng; ?>
				</span>
			</div>
			<div class="card-body">
				<ul>
				<?php
				foreach ($engine as $key) {
					echo '<li>'.$key->code.'</li>';
				}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>