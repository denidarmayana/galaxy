<?php 
if (isset($_GET['del'])) {
	$save = $this->db->delete("subcribe",['id'=>$_GET['del']]);
	redirect("control/subcribe");
} 
?>
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
							<th>Hash</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0;
						foreach ($subcribe as $key) { $no++;
							$block = '<a href="'.base_url('activation?id='.$key->id).'" class="btn btn-info btn-xxs">Accept</a>&nbsp;&nbsp; <a href="?del='.$key->id.'" class="btn btn-danger btn-xxs">Cancle</a>';
							echo "<tr>
							<td>".$no."</td>
							<td>".$key->name."</td>
							<td>".number($key->amount)." MBIT</td>
							<td>".$key->hash."</td>
							<td>".($key->status == 1 ? "Success" : "Pending")."</td>
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