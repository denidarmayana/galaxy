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
				<?php if (isset($_GET['edit'])) { 
					$user = $this->db->get_where("members",['id'=>$_GET['edit']])->row();
					?>
					<input type="hidden" value="<?=$user->id ?>" id="id_profiles">
					<div class="form-group">
						<label class="mb-1"><strong>Username</strong></label>
						<input type="text" id="username_control" class="form-control" readonly value="<?=$user->username ?>" >
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Email</strong></label>
						<input type="text" id="email_control" class="form-control" readonly value="<?=$user->email ?>" >
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Wallet Address</strong></label>
						<input type="text" id="wallets_control" class="form-control" placeholder="Your Wallet Address" value="<?=$user->wallet ?>" >
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Update Password</strong></label>
						<input type="password" id="password_control" class="form-control" placeholder="New Password" >
					</div>
					<div class="text-center">
						<button type="button" id="btn_profile_control" class="btn btn-primary btn-block">Update Profile</button>
					</div>
				<?php }else { ?>
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
								<td>".($key->band == 1 ? $unblock : $block)." <a href='?edit=".$key->id."' class='btn btn-primary btn-xxs'>Edit</a></td>
								</tr>";
							}
							?>
						</tbody>
					</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>