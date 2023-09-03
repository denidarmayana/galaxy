<?php
if (isset($_GET['id'])) {
	$this->db->update("usdt",['status'=>1],['id'=>$_GET['id']]);
	redirect("control/ticket");
}
if (isset($_GET['del'])) {
	$this->db->delete("usdt",['id'=>$_GET['del']]);
	redirect("control/ticket");
}
?>
<div class="row">
	<div class="col-sm-12 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Deposit USDT</h3>
			</div>
			<div class="card-body table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Members</th>
							<th>Amount</th>
							<th>Hash</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0;
						foreach ($deposit as $key) { $no++;
							if ($key->status == 0) {
								$btn = '<a href="?id='.$key->id.'" class="btn btn-xxs btn-primary">Accept</a> <a href="?del='.$key->id.'" class="btn btn-xxs btn-danger">reject</a>';
							}else{
								$btn = '<a href="" class="btn btn-xxs btn-outline-success">Success</a>';
							}
							echo "<tr>
							<td>".$no."</td>
							<td>".$key->name."</td>
							<td>".$key->amount." USDT</td>
							<td>".$key->hash."</td>
							<td>".($key->status == 1 ? "Done" : "Pending")."</td>
							<td>".$btn."</td>
							</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>