<?php if ($subcribe) { 
	?>
	<div class="row page-titles mx-0 <?=($subcribe->status == 0 ? "bg-warning" : "") ?>">
		<div class="col-sm-6 col-12 p-md-0 mb-4">
			<div class="welcome-text">
				<h4><?=$subcribe->name ?></h4>
				<span><?=($subcribe->status == 0 ? "Pending" : "Active") ?></span>
			</div>
		</div>
		<div class="col-sm-6 col-12 p-md-0">
			<h3 class="card-title">Insrtruction</h3>
			<p class="text-black m-0">Please make a payment to the wallet address of</p>
			<p class="text-danger m-0 font-w600" id="wallet" style="cursor: pointer;">0x3f7Daa26CEA77793805c7A133f214007E058Ef8E</p>
			<p class="text-black m-0">with a nominal value of <span class="font-w600"><?=number($subcribe->amount) ?> MBIT</span></p>
		</div>
	</div>
<?php } ?>
<div class="row">
	<?php foreach ($paket as $key) { ?>
		<div class="col-xl-4 col-sm-6 m-t35">
			<div class="card card-coin">
				<div class="card-body text-center">
					<img src="<?=base_url('assets/images/'.strtolower($key->name).".png") ?>" width="160" class="mb-4">
					<h2 class="text-black mb-2 font-w600"><?=$key->name ?></h2>
					<p class="text-black mb-0">
						<?=number($key->amount) ?> MBIT
					</p>
					<p class="text-success mb-0">
						1% Per Day
					</p>
					<input type="hidden" class="paket<?=$key->id ?>" value="<?=$key->id ?>">
					<button class="btn btn-primary btn-block mt-3 subcribe<?=$key->id ?>">Subcribe</button>
				</div>
			</div>
		</div>
	<?php } ?>
</div>