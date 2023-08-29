<div class="row">
	<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
		<div class="widget-stat card">
			<div class="card-body p-4">
				<div class="media ai-icon">
					<span class="me-3 bgl-primary text-primary">
						<!-- <i class="ti-user"></i> -->
						<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
							<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
							<circle cx="12" cy="7" r="4"></circle>
						</svg>
					</span>
					<div class="media-body">
						<p class="mb-1">Members Today</p>
						<h4 class="mb-0"><?=number($members_today) ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
		<div class="widget-stat card">
			<div class="card-body p-4">
				<div class="media ai-icon">
					<span class="me-3 bgl-primary text-primary">
						<!-- <i class="ti-user"></i> -->
						<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
							<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
							<circle cx="12" cy="7" r="4"></circle>
						</svg>
					</span>
					<div class="media-body">
						<p class="mb-1">Total Members</p>
						<h4 class="mb-0"><?=number($all_members) ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
		<div class="widget-stat card">
			<div class="card-body p-4">
				<div class="media ai-icon">
					<span class="me-3 bgl-success text-success">
						<!-- <i class="ti-user"></i> -->
						<svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
									<line x1="12" y1="1" x2="12" y2="23"></line>
									<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
								</svg>
					</span>
					<div class="media-body">
						<p class="mb-1">Omset Today</p>
						<h4 class="mb-0"><?=($omset ? number($omset->amount) : 0) ?> MBIT</h4>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Members Today</h3>
			</div>
			<div class="card-body">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					<ul class="timeline">
						<?php foreach ($members as $key) { ?>
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=$key->name ?> </h5>
									<small class="d-block"><?=$key->created_at ?> / <?=($key->status == 0 ? "Pending" : "Active" ) ?></small>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Subcribe Today</h3>
			</div>
			<div class="card-body">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					<ul class="timeline">
						<?php foreach ($subcribe as $sub) { ?>
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=$sub->name ?> </h5>
									<small class="d-block"><?=number($sub->amount) ?> MBIT/ <?=($key->status == 0 ? "Pending" : "Active" ) ?></small>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>