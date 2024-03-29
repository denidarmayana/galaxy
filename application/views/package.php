<?php if ($subcribe) { ?>
	<div class="row">
		<div class="col-sm-6">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">History Subcribed</h4>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-bordered table-striped">
						<tr>
							<th>No</th>
							<th>Date</th>
							<th>Name</th>
							<th>Status</th>
						</tr>
					<?php
				
					$data = $this->db->select('paket.name, subcribe.*')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['subcribe.members'=>$user->username])->result();
					$no=0;
					foreach ($data as $key) { $no++;
						echo "<tr><td>".$no."</td><td>".$key->created_at."</td><td>".$key->name."</td><td>".($key->status == 1 ? "ACTIVE" : "PENDING") ."</td></tr>";
					}
					?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-3">
			<div class="card">
				<div class="card-body text-center">
					<img src="<?=base_url('assets/images/'.strtolower($subcribe->name).".png") ?>" width="160" class="mb-4">
					<h2 class="text-black mb-2 font-w600"><?=$subcribe->name ?></h2>
					<p class="text-black mb-0">
						<?=number($subcribe->amount) ?> MBIT
					</p>
					<h4 class="card-title mt-2 <?=($subcribe->status == 0 ? "bg-warning" : "bg-success") ?>" style="padding: 7px;border-radius: 7px;">
						<?=($subcribe->status == 0 ? "Pending" : "Active") ?>
					</h4>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-3">
			<div class="card">
				<div class="card-body">
					<center>
						<img src="<?=base_url('assets/logo.png') ?>" width="160" class="mb-4">
					</center>
					<?php if ($subcribe->status == 0) { ?>
						<h2 class="text-black mb-2 font-w600">Insrtruction</h2>
						<p class="text-black mb-0">
							Please make a payment to the wallet address of<br>
							<!-- <span id="wallet" class="text-success" style="cursor: pointer;width: 100%;">0x3f7Daa26CEA77793805c7A133f214007E058Ef8E</span><br> -->
							<span id="wallet" class="text-success" style="cursor: pointer;width: 100%;">0x1d599c6a04Ab91dCF20Dc39a22EB7B7539f0D013</span><br>
							with a nominal value of <span class="font-w600"><?=number($subcribe->amount) ?> MBIT
						</p>
						<?php if ($subcribe->hash == "") { ?>
							<div class="form-group mt-4">
								<label class="mb-1"><strong>Confirmation</strong></label>
								<input type="text" id="hash" class="form-control" placeholder="Hash Transaction">
							</div>
							<div class="text-center">
								<button type="button" id="btn_conf" class="btn btn-success btn-block">Submit</button>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>

<?php } ?>

<div class="row">
	<?php foreach ($paket as $key) { ?>
		<div class="col-xl-3 col-sm-6 m-t35">
			<div class="card card-coin">
				<div class="card-body text-center">
					<img src="<?=base_url('assets/images/'.strtolower($key->name).".png") ?>" width="160" class="mb-4">
					<h2 class="text-black mb-2 font-w600"><?=$key->name ?></h2>
					<p class="text-black mb-0">
						<?=number($key->amount) ?> MBIT
					</p>
					<p class="text-success mb-0">
						5% Per Day
					</p>
					<input type="hidden" class="paket<?=$key->id ?>" value="<?=$key->id ?>">
					<?php if ($subcribe) { ?>
						<?php if ($subcribe->paket < $key->id) { ?>
						<button class="btn btn-primary btn-block mt-3 subcribe<?=$key->id ?>">Upgrade</button>
						<?php }else { ?>
							<button class="btn btn-primary btn-block mt-3 subcribe<?=$key->id ?>" disabled >Subcribed</button>
						<?php } ?>
					<?php }else { ?>
						<button class="btn btn-primary btn-block mt-3 subcribe<?=$key->id ?>" >Subcribed</button>
					<?php } ?>
					
					
				</div>
			</div>
		</div>
	<?php } ?>
</div>