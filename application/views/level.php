<div class="row">
	<div class="col-sm-12 col-12 p-md-0">
		<div class="card">
			<div class="card-body">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					<ul class="timeline">
						<?php $no=0; foreach ($roi as $key) {$no++;
							
						?>
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=number($key->amount) ?> MBIT</h5>
									<small class="d-block">From : <?=$key->from ?>, at : <?=$key->created_at ?></small>
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