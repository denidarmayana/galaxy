<?php
if (isset($_GET['id'])) {
	$this->db->update("widthdrawal",['status'=>1],['id'=>$_GET['id']]);
	redirect("control/withdrawal");
} ?>
<div class="row">
	<div class="col-sm-12 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Members</h3>
			</div>
			<div class="card-body table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Amount</th>
							<th>Fee</th>
							<th>Net</th>
							<th>Status</th>
							<th>Wallet Rerecved</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0;
						foreach ($widthdrawal as $key) { $no++;
							$m = $this->db->get_where("members",['username'=>$key->members])->row();
							$block = '<a href="?id='.$key->id.'" class="btn btn-info btn-xxs">Accept</a>';
							echo "<tr>
							<td>".$no."</td>
							<td>".$key->name."</td>
							<td>".number($key->amount)." MBIT</td>
							<td>".number($key->fee)." MBIT</td>
							<td>".number($key->net)." MBIT</td>
							<td>".($key->status == 1 ? "Success" : "Pending")."</td>
							<td>".$m->wallet."</td>
							<td>".($key->status == 1 ? "" : $block)."</td>
							</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>