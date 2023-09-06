<div class="row">
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Deposit USDT</h3>
			</div>
			<div class="card-body">
				
				<?php if (isset($_GET['hash'])) { ?>
					<p class="text-black">For usdt deposits, please send your coins to the wallet address below<br>
						<span class="text-success font-w600 text-center m-0">0x3f7Daa26CEA77793805c7A133f214007E058Ef8E</span><br>
						<span class="text-success font-w600 text-center m-0">BEP20</span></p>
					<div class="col-depo-usdt">
						<input type="hidden" id="id_usdt_hash" class="form-control" value="<?=$this->encryption->decrypt($_GET['hash']) ?>" placeholder="0" >
						<div class="form-group">
							<label class="mb-1"><strong>Hash Transaction</strong></label>
							<input type="text" id="amount_usdt_hash" class="form-control" placeholder="0" >
						</div>
						<div class="text-center">
							<button type="button" id="btn_usdt_hash" class="btn btn-primary btn-block">Submit</button>
						</div>
					</div>
				<?php } else{ ?>
					<div class="col-depo-usdt">
						
						<div class="form-group">
							<label class="mb-1"><strong>Amount</strong></label>
							<input type="text" id="amount_usdt" class="form-control" placeholder="0" >
						</div>
						<div class="text-center">
							<button type="button" id="btn_usdt" class="btn btn-primary btn-block">Submit</button>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-sm-8 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">History Deposit USDT</h3>
			</div>
			<div class="card-body table-responsive">
				<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Date</th>
								<th>Amount</th>
								<th>Hash</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=0;
							foreach ($usdt as $key) { $no++;
								if ($key->hash == "") {
									$btn = '<a href="?hash='.$this->encryption->encrypt($key->id).'" class="btn btn-info btn-xxs" data-toggle="modal" data-target="#myModal">Input Hash</a>';
								}else{
									$btn = "";
								}
								echo "<tr>
								<td class='text-black'>".$no."</td>
								<td class='text-black'>".$key->created_at."</td>
								<td class='text-black'>".$key->amount."</td>
								<td class='text-black'>".$key->hash."</td>
								<td class='text-black'>".($key->status == 1 ? "Active" : "Pending")."</td>
								<td class='text-black'>".$btn."</td>
								</tr>";
							}
							?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>