<?php 
if (!isset($_GET['users'])) {
	$liset_downline = $downline;
}else{
	$liset_downline = $this->db->get_where("members",['upline'=>$_GET['users']])->result();
}
$total_omset = 0;
foreach ($liset_downline as $keys) {
	$omsets = $this->db->select('paket.amount')->order_by('subcribe.id','desc')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['members'=>$keys->username])->row();
	if ($omsets) {
		$total_omset += $omsets->amount;
	}else{
		$total_omset += 0;
	}
	
}
?>
<div class="row">
	<div class="col-sm-12 col-12 p-md-0">
		<div class="card">
			<div class="card-header">
				<H4 class="card-title">
					List Downline

					
				</H4>
				<span class="float-end text-warning"></span>
			</div>
			<div class="card-body">
				<div id="DZ_W_Todo1" class="widget-media dz-scroll">
					
					<ul class="timeline">
						<?php $no=0; 
						$omset_downline=0;
						foreach ($liset_downline as $key) {$no++;
							$s = $this->db->select('paket.name')->order_by('subcribe.id','desc')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['members'=>$key->username])->row();
							$jb = $this->db->get_where("peringkat",['id'=>$key->position])->row();
							$lev = $this->db->get_where("members",['upline'=>$key->username])->num_rows();
							if ($lev > 0) {
								$btn = '<a href="?users='.$key->username.'" class="btn btn-xs btn-success">'.$lev.' Users</a>';
							}else{
								$btn = $lev." Users";
							}
							$o_l1 = $this->db->get_where("members",['upline'=>$key->username])->result();
							$omst = 0;
							foreach ($o_l1 as $l1) {
								$om_1 = $this->db->select('paket.amount')->order_by('subcribe.id','desc')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['members'=>$l1->username])->row();
								$omst += ($om_1 ? $om_1->amount : 0 );
								
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
						<?php $omset_downline +=$omst; } ?>
					</ul>
				</div>
			</div>
			
		</div>
	</div>
</div>