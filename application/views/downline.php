<div class="row">
	<div class="col-sm-12 col-12 p-md-0">
		<div class="card">
			<div class="card-body">
				<table id="example" class="display" style="width: 100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Join</th>
							<th>Subcribe</th>
							<th>Position</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0; foreach ($downline as $key) {$no++;
							$s = $this->db->select('name')->join('paket','paket.id=subcribe.paket')->get_where("subcribe",['members'=>$key->username])->row();
							$jb = $this->db->get_where("peringkat",['id'=>$key->position])->row();
							echo "<tr>
							<td>".$no."</td>
							<td>".$key->name."</td>
							<td>".$key->created_at."</td>
							<td>".($s ? $s->name:"No Active Packages")."</td>
							<td>".($key->position == 1 ? $jb->name:"No Position")."</td>
							</tr>";
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>