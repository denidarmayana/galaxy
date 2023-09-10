<div class="row page-titles mx-0">
	<div class="col-sm-6 col-12 p-md-0">
		<div class="welcome-text">
			<h4>Hi, <?=$user->name ?></h4>
			<span><?=$user->email ?></span>
		</div>
	</div>
	<div class="col-sm-6 col-12 p-md-0 ">
		<div class="welcome-text">
			<h4>Link Referral</h4>
			<?php if ($subcribe > 0) { ?>
				<span class="link_ref" style="cursor: pointer;"><?=base_url('reff/').$user->username ?></span>
			<?php } ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-4 col-lg-6 col-sm-6">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div class="text-center">
					<div class="profile-photo">
						<?php if ($user->position == 0) { ?>
                            <img src="<?=base_url('') ?>assets/images/avatar/1.png" width="100" alt=""/>
                        <?php } else{                        	
                        	$position= $this->db->get_where('peringkat',['id'=>$user->position])->row();
                        	echo '<img src="'.base_url('').'assets/position/'.$position->name.'.png" width="100" alt=""/>';
                        } ?>
					</div>
					<h3 class="mt-4 mb-1"><?=$user->name ?></h3>
					<p class="text-success m-0">
						<?php 
						if ($user->position == 0) {
							echo "No Position";
						}else{
							$p = $this->db->get_where("peringkat",['id'=>$user->position])->row();
							echo $p->name;
						}
						?>
					</p>
					<a class="btn btn-outline-info btn-block mt-3 px-5" href="javascript:void(0)">
						<?php 
						$subcribe = $this->db->order_by('id','desc')->get_where("subcribe",['members'=>$user->username,'status'=>1])->row();
						if ($subcribe) {
							$pkt = $this->db->get_where("paket",['id'=>$subcribe->paket])->row();
							$harian = $pkt->amount*(1/100);
							$bns_hari = $harian/24;
							$menitan = $bns_hari/60;
							$detik = $menitan/60;
							$cek_roi = $this->db->get_where("roi",['members'=>$user->username,'paket'=>$subcribe->paket])->num_rows();
							if ($cek_roi == 0) {
								$today = selisih_waktu($subcribe->updated_at);
							}else{
								$date_roi = date('Y-m-d H:i:s', strtotime('+'.$cek_roi.' days', strtotime($subcribe->updated_at)));
								$today = selisih_waktu($date_roi);
							}
							$bns_now = ($bns_hari*$today->h)+($menitan*$today->i)+($detik*$today->s);
							?>
							<input type="hidden" value="<?=$detik ?>" id="bns_detik">
							<span id="roi"><?=number_format($bns_now,8,'.',',') ?> MBIT</span>
							
						<?php }else{ ?>
							<input type="hidden" value="0" id="bns_detik">
							<span id="roi"><?=number_format(0.00000000,8,'.',',') ?> MBIT</span>
						<?php } ?>
					</a>
					<a class="btn btn-outline-warning btn-block mt-3 px-5" href="javascript:void(0)">
						<?php 
						$subcribe = $this->db->order_by('id','desc')->get_where("subcribe",['members'=>$user->username,'status'=>1])->row();
						if ($subcribe) {
							$pkt = $this->db->get_where("paket",['id'=>$subcribe->paket])->row();
							echo $pkt->name;
						}else{
							echo "No Active Packages";
						} ?>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-6 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h4 class="card-title">Downline Today</h4>
			</div>
			<div class="card-body pb-0">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll height370">
					<ul class="timeline">
						<?php foreach ($downline as $d) { ?>
						<li>
							<div class="timeline-panel">
								<div class="media me-3">
									<i class="fa fa-user"></i>
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=$d->name ?></h5>
									<small class="d-block"><?=$d->created_at ?></small>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-6 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h4 class="card-title">Members Today</h4>
			</div>
			<div class="card-body pb-0">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll height370">
					<ul class="timeline">
						<?php foreach ($member as $m) { ?>
						<li>
							<div class="timeline-panel">
								<div class="media me-3">
									<i class="fa fa-user"></i>
								</div>
								<div class="media-body">
									<h5 class="mb-1"><?=$m->name ?></h5>
									<small class="d-block"><?=$m->created_at ?></small>
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