<div class="row">
	<div class="col-sm-12 col-12 p-md-0">
		<div class="card">
			<div class="card-body">
				<table id="example" class="display" style="width: 100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Date</th>
							<th>From</th>
							<th>Amount</th>
							
						</tr>
					</thead>
					<tbody>
						<?php $no=0; foreach ($roi as $key) {$no++;
							echo "<tr>
							<td>".$no."</td>
							<td>".$key->created_at."</td>
							<td>".$key->from."</td>
							<td>".$key->amount."</td>
							</tr>";
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>