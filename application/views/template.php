
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Galaxy Seven - Crypto Minner for our future" />
	<meta property="og:title" content="Galaxy Seven - Crypto Minner for our future" />
	<meta property="og:description" content="Galaxy Seven - Crypto Minner for our future" />
	<meta property="og:image" content="../../social-image.png" />
	<meta name="format-detection" content="telephone=no">
    <title><?=$title ?> - Galaxy Seven </title>
    <!-- Favicon icon -->
	
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url() ?>assets/icon.png">
	<link href="<?=base_url() ?>assets/css/toastr.min.css?=<?=time() ?>" rel="stylesheet">
	 <link href="<?=base_url('') ?>assets/vendor/chartist/css/chartist.min.css?=<?=time() ?>" rel="stylesheet" type="text/css"/>
	 <link href="<?=base_url('') ?>assets/vendor/owl-carousel/owl.carousel.css?=<?=time() ?>" rel="stylesheet" type="text/css"/>
	 <link href="<?=base_url('') ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css?=<?=time() ?>" rel="stylesheet" type="text/css"/>	
	 <link href="<?=base_url('') ?>assets/css/style.css?=<?=time() ?>" rel="stylesheet" type="text/css"/>
	 <link href="<?=base_url('') ?>assets/vendor/datatables/css/jquery.dataTables.min.css?=<?=time() ?>" rel="stylesheet" type="text/css"/>		
		
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
	
	<!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        

		<!--**********************************
	Nav header start
***********************************-->
<div class="nav-header">
	<a href="<?=base_url() ?>" class="brand-logo">
		<img src="<?=base_url('assets/logo_sidebar.png') ?>" width="90%">
	</a>

	<div class="nav-control">
		<div class="hamburger">
			<span class="line"></span><span class="line"></span><span class="line"></span>
		</div>
	</div>
</div>
<!--**********************************
	Nav header end
***********************************-->		
<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
					<div class="input-group search-area right d-lg-inline-flex d-none">
						<input type="text" class="form-control" placeholder="Search here...">
						<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
					</div>
                </div>
                <ul class="navbar-nav header-right main-notification">
					
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                        	<?php if ($user->position == 0) { ?>
                            <img src="<?=base_url('') ?>assets/images/avatar/1.png" width="20" alt=""/>
                        <?php } else{                        	
                        	$position= $this->db->get_where('peringkat',['id'=>$user->position])->row();
                        	echo '<img src="'.base_url('').'assets/position/'.$position->name.'.png" width="20" alt=""/>';
                        } ?>
							<div class="header-info">
								<span><?=$user->name ?></span>
								<small><?=$user->username ?></small>
							</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="<?=base_url('profile') ?>" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="ms-2">Profile </span>
                            </a>
                            
                            <a href="<?=base_url('sign-out') ?>" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ms-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
		
	</div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->        
<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
		<div class="main-profile">
			<div class="image-bx">
				<?php if ($user->position == 0) { ?>
                            <img src="<?=base_url('') ?>assets/images/avatar/1.png" width="100" alt=""/>
                        <?php } else{                        	
                        	$position= $this->db->get_where('peringkat',['id'=>$user->position])->row();
                        	echo '<img src="'.base_url('').'assets/position/'.$position->name.'.png" width="20" alt=""/>';
                        } ?>
				<a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
			</div>
			<h5 class="name"><span class="font-w400">Hello,</span> <?=$user->name ?></h5>
			<p class="email"><?=$user->email ?></p>
		</div>
		<ul class="metismenu" id="menu">
			<li class="nav-label first">Main Menu</li>
            <li><a href="<?=base_url('') ?>">
	                <i class="flaticon-381-home"></i>
	                <span class="nav-text">Dashboard</span>
	            </a>
	        </li>
	        <li><a href="<?=base_url('infak') ?>">
	                <i class="flaticon-381-diamond"></i>
	                <span class="nav-text">Infaq</span>
	            </a>
	        </li>
            <li><a href="<?=base_url('package') ?>">
	                <i class="flaticon-381-diamond"></i>
	                <span class="nav-text">Package</span>
	            </a>
	        </li>
	        <li><a href="<?=base_url('downline') ?>">
	                <i class="flaticon-381-networking-1"></i>
	                <span class="nav-text">Downline</span>
	            </a>
	        </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-network"></i>
					<span class="nav-text">Transaction</span>
				</a>
                <ul aria-expanded="false">
                    <li><a href="<?=base_url('transaction/daily') ?>">Daily Income</a></li>
                    <li><a href="<?=base_url('transaction/referral') ?>">Referral Earnings</a></li>
                    <li><a href="<?=base_url('transaction/reward') ?>">Reward</a></li>
                    <!-- <li><a href="<?=base_url('transaction/deposit-usdt') ?>">Deposit USDT</a></li> -->
                    <li><a href="<?=base_url('transaction/withdrawal') ?>">Withdrawal</a></li>
                </ul>
            </li>
            <li><a href="<?=base_url('ticket') ?>">
	                <i class="flaticon-381-price-tag"></i>
	                <span class="nav-text">My Ticket</span>
	            </a>
	        </li>
	        <li><a href="<?=base_url('bot') ?>">
	                <i class="flaticon-381-database"></i>
	                <span class="nav-text">Bit Bot</span>
	            </a>
	        </li>
        </ul>
		<div class="copyright">
			<p><strong>Galaxy 7</strong> &copy; <?=date('Y') ?> All Rights Reserved</p>
		</div>
	</div>
</div>
<!--**********************************
    Sidebar end
***********************************-->        
<!--**********************************
	Content body start
***********************************-->
<div class="content-body">
	<div class="container-fluid">
		<?=$contents ?>
	</div>
</div>	 	
<!--**********************************
	Content body end
***********************************-->
        <!--**********************************
    Footer start
***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; Designed &amp; Developed by <a href="">Galaxy 7</a> <?=date("Y") ?></p>
    </div>
</div>
<!--**********************************
    Footer end
***********************************-->        
		
	</div>
	<script src="<?=base_url() ?>assets/js/jquery.min.js?=<?=time() ?>"></script>
	<script src="<?=base_url('') ?>assets/vendor/global/global.min.js?=<?=time() ?>"></script>
	<script src="<?=base_url('') ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js?=<?=time() ?>"></script>
    <script src="<?=base_url('') ?>assets/vendor/chart.js/Chart.bundle.min.js?=<?=time() ?>"></script>
    <script src="<?=base_url('') ?>assets/vendor/peity/jquery.peity.min.js?=<?=time() ?>"></script>
    <script src="<?=base_url('') ?>assets/vendor/apexchart/apexchart.js?=<?=time() ?>"></script>
    <script src="<?=base_url('') ?>assets/vendor/owl-carousel/owl.carousel.js?=<?=time() ?>"></script>
    <script src="<?=base_url('') ?>assets/js/dashboard/dashboard-1.js?=<?=time() ?>"></script>

	<script src="<?=base_url('') ?>assets/js/custom.js?=<?=time() ?>"></script>
	<script src="<?=base_url('') ?>assets/js/deznav-init.js?=<?=time() ?>"></script>
	<script src="<?=base_url() ?>assets/js/toastr.min.js?=<?=time() ?>"></script>
	<script src="<?=base_url() ?>assets/vendor/datatables/js/jquery.dataTables.min.js?=<?=time() ?>"></script>
    <script src="<?=base_url() ?>assets/js/plugins-init/datatables.init.js?=<?=time() ?>"></script>
	<script src="<?=base_url() ?>assets/js/delta.js?=<?=time() ?>"></script>
    <!--**********************************
        Main wrapper end
    ***********************************-->
</body>

<!-- Mirrored from zenix.dexignzone.com/codeigniter/demo/admin/index_2 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Aug 2023 10:17:19 GMT -->
</html>