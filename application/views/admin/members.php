<?php 
if (isset($_GET['id'])) {
	if ($_GET['act'] == "block") {
		$this->db->update("members",['band'=>1],['id'=>$_GET['id']]);
	}else{
		$this->db->update("members",['band'=>0],['id'=>$_GET['id']]);
	}
	redirect("control/members");
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
							<th>Username</th>
							<th>Email</th>
							<th>Status</th>
							<th>Suspand</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0;
						foreach ($members as $key) { $no++;
							$block = '<a href="?id='.$key->id.'&act=block" class="btn btn-danger btn-xxs">BLOCK</a>';
							$unblock = '<a href="?id='.$key->id.'&act=unblock" class="btn btn-success btn-xxs">UNBLOCK</a>';
							echo "<tr>
							<td>".$no."</td>
							<td>".$key->name."</td>
							<td>".$key->username."</td>
							<td>".$key->email."</td>
							<td>".($key->status == 1 ? "Active" : "Pending")."</td>
							<td>".($key->band == 1 ? 'TRUE' : "FALSE")."</td>
							<td>".($key->band == 1 ? $unblock : $block)."</td>
							</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>