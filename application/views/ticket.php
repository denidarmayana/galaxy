<div class="row">
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">term and Condition</h3>
			</div>
			<div class="card-body">
				<p>To be able to make a bonus withdrawal, you must have a ticket for bonus withdrawals</p>
				<p>To get a bonus drawing ticket, you must buy it at a price of 
					<?php 
					switch ($user->position) {
						case 0:
							echo '<span class="font-w600 text-success">7 USDT</span>';
							break;
						case 1:
							echo '<span class="font-w600 text-success">6 USDT</span>';
							break;
						case 2:
							echo '<span class="font-w600 text-success">5 USDT</span>';
							break;
						case 3:
							echo '<span class="font-w600 text-success">4 USDT</span>';
							break;
						case 4:
							echo '<span class="font-w600 text-success">3 USDT</span>';
							break;
					}
					 ?>
				for one ticket, and is valid for one time use</p>
			</div>
			<div class="card-footer">
				<h4 class="card-title">Balance <span class="float-end text-success"><?=number($balance->amount-($buy ? $buy->total : 0) ) ?> USDT</span> </h4>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Buy Ticket</h3>
			</div>
			<div class="card-body">
				<?php if ($balance->amount >= 7) { ?>
					<div class="form-group">
						<label class="mb-1"><strong>Amount</strong></label>
						<input type="text" id="amount_ticket" class="form-control" placeholder="0" >
					</div>
					<div class="text-center">
						<button type="button" id="btn_buy_ticket" class="btn btn-info btn-block">Buy</button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">My Ticket</h3>
			</div>
			<div class="card-body">
				<ul>
				<?php
				foreach ($ticket as $key) {
					echo '<li>'.$key->ticket.'</li>';
				}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>