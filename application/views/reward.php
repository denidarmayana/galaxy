<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Qualified</h3>
			</div>
			<div class="card-body">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					<ul class="timeline">
						<?php foreach ($peringkat as $p) {
							$q = $this->db->get_where("qualified",['members'=>$this->session->userdata("username"),'position'=>$p->id])->row();
						?>
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=$p->name ?></h5>
									<small class="d-block"><?=($q ? $q->count : "0") ?> / 5</small>
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
				<h3 class="card-title">Omset Global</h3>
			</div>
			<div class="card-body">
				<?php 
				$today = $this->db->select_sum("paket.amount")->join('paket','subcribe.paket=paket.id')->like('subcribe.created_at',date("Y-m-d"))->get("subcribe")->row();
				$total = $this->db->select_sum("paket.amount")->join('paket','subcribe.paket=paket.id')->get("subcribe")->row(); ?>
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					<ul class="timeline">
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1">Total Omset</h5>
									<small class="d-block"><?=number($total->amount) ?> MBIT</small>
								</div>
							</div>
						</li>
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1">Omset Today</h5>
									<small class="d-block"><?=number($today->amount) ?> MBIT</small>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>