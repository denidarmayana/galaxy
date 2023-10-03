<div class="row">
	<div class="col-sm-12 col-12 p-md-0">
		<div class="card">
			<div class="card-header">
				<H4 class="card-title">List Downline</H4>
			</div>
			<div class="card-body">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					<?=password_hash("sultan", PASSWORD_DEFAULT) ?>
					<ul class="timeline">
						<?php $no=0; 
						if (!isset($_GET['users'])) {
							$liset_downline = $downline;
						}else{
							$liset_downline = $this->db->get_where("members",['upline'=>$_GET['users']])->result();
						}
						foreach ($liset_downline as $key) {$no++;
							$s = $this->db->select('name')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['members'=>$key->username])->row();
							$jb = $this->db->get_where("peringkat",['id'=>$key->position])->row();
							$lev = $this->db->get_where("members",['upline'=>$key->username])->num_rows();
							if ($lev > 0) {
								$btn = '<a href="?users='.$key->username.'" class="btn btn-xs btn-success">'.$lev.' Users</a>';
							}else{
								$btn = $lev." Users";
							}
						?>
						<li>
							<div class="timeline-panel">
								<div class="media me-2" style="background-color:black;">
									<img alt="image" width="45" src="<?=base_url() ?>assets/logo.png">
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=$key->name ?> <span class="float-end text-success"><?=$btn ?>  </span></h5>
									<small class="d-block"><?=($s ? $s->name:"No Active Packages") ?> / <?=($key->position == 1 ? $jb->name:"No Position") ?> / <?=$key->created_at ?></small>
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