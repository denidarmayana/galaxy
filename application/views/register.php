'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="" />
	<meta name="author" content="galaxy7.tech" />
	<meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Galaxy Seven - Crypto Minner for our future" />
	<meta property="og:title" content="Galaxy Seven - Crypto Minner for our future" />
	<meta property="og:description" content="Galaxy Seven - Crypto Minner for our future" />
	<meta property="og:image" content="<?=base_url() ?>icon.png" />
	<meta name="format-detection" content="telephone=no">
    <title>Register - Galaxy </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url() ?>assets/icon.png">
    <link href="<?=base_url() ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css?=<?=time() ?>" rel="stylesheet">
    <link href="<?=base_url() ?>assets/css/style.css?=<?=time() ?>" rel="stylesheet">
	<link href="<?=base_url() ?>assets/css/toastr.min.css?=<?=time() ?>" rel="stylesheet">
</head>

<body class="vh-100">
	<div class="authincation h-100">
		<div class="container h-100">
			<div class="row justify-content-center h-100 align-items-center">
				<div class="col-md-6">
					<div class="authincation-content">
						<div class="row no-gutters">
							<div class="col-xl-12">
								<div class="auth-form">
									<div class="text-center mb-3">
										<img src="<?=base_url() ?>assets/logo.png" alt="" width="60%">
									</div>
									<h4 class="text-center mb-4">Sign up your account</h4>
									<div id="loading" style="display: none;">
										<center>
											<i class="fa fa-redo fa-spin fa-5x text-warning"></i>
										</center>
									</div>
									<div class="col-reg">
										<div class="form-group">
											<label class="mb-1"><strong>Username</strong></label>
											<input type="text" id="username" class="form-control" placeholder="user_galaxy7">
										</div>
										<div class="form-group">
											<label class="mb-1"><strong>Email</strong></label>
											<input type="email" id="email" class="form-control" placeholder="user@galaxy7.tech">
										</div>
										<div class="form-group">
											<label class="mb-1"><strong>Full Name</strong></label>
											<input type="text" id="name" class="form-control" placeholder="Full Name">
										</div>
										<div class="form-group">
											<label class="mb-1"><strong>Password</strong></label>
											<input type="password" id="password" class="form-control" placeholder="Full Name">
										</div>
										<div class="form-group">
											<label class="mb-1"><strong>Referral</strong></label>
											<input type="text" id="upline" value="<?=$reff ?>" readonly class="form-control" placeholder="Password">
										</div>
										<div class="form-row d-flex justify-content-between mt-4 mb-2">
											<div class="form-group">
											   <div class="custom-control custom-checkbox ms-1">
													<input type="checkbox" class="form-check-input" id="remember">
													<label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
											</div>
											
										</div>
										<div class="text-center">
											<button type="button" id="signup" class="btn btn-primary btn-block">Sign Me Up</button>
										</div>

										<div class="new-account mt-3">
											<p>Don't have an account? <a class="text-primary" href="<?=base_url('auth') ?>">Sign in</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="<?=base_url() ?>assets/js/jquery.min.js?=<?=time() ?>"></script>
<script src="<?=base_url() ?>assets/vendor/global/global.min.js?=<?=time() ?>"></script>
<script src="<?=base_url() ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js?=<?=time() ?>"></script>
<script src="<?=base_url() ?>assets/js/deznav-init.js?=<?=time() ?>"></script>
<script src="<?=base_url() ?>assets/js/toastr.min.js?=<?=time() ?>"></script>
<script src="<?=base_url() ?>assets/js/auth.js?=<?=time() ?>"></script>
<script>
	
</script>
</body>

<!-- Mirrored from zenix.dexignzone.com/codeigniter/demo/admin/page_login by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Aug 2023 10:17:19 GMT -->
</html>'