<div class="row">
	<div class="col-sm-12 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Prile Details </h3>
			</div>
			<div class="card-body">
				<div id="loading" style="display: none;">
					<center>
						<i class="fa fa-redo fa-spin fa-5x text-warning"></i>
					</center>
				</div>
				<div class="col-profile">
					<div class="form-group">
						<label class="mb-1"><strong>Username</strong></label>
						<input type="text" id="username" class="form-control" readonly value="<?=$user->username ?>" >
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Email</strong></label>
						<input type="text" id="email" class="form-control" readonly value="<?=$user->email ?>" >
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Wallet Address</strong></label>
						<input type="text" id="wallets" class="form-control" placeholder="Your Wallet Address" value="<?=$user->wallet ?>" >
					</div>
					<div class="form-group">
						<label class="mb-1"><strong>Update Password</strong></label>
						<input type="password" id="password" class="form-control" placeholder="New Password" >
					</div>
					<div class="text-center">
						<button type="button" id="btn_profile" class="btn btn-primary btn-block">Update Profile</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>