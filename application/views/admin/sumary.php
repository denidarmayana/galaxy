<?php 
$omset = $this->db->select_sum('paket.amount')->join("paket",'subcribe.paket=paket.id')->get_where('subcribe',['subcribe.status'=>1])->row();
$all_omset = $this->db->select_sum('amount')->get_where('subcribe',['status'=>1])->row();
$unik_omset = $all_omset->amount-$omset->amount;
$wd = $this->db->select_sum('fee')->get_where('widthdrawal',['status'=>1])->row();
$net = $this->db->select_sum('net')->get_where('widthdrawal',['status'=>1])->row();
$infaq = $this->db->select_sum('amount')->get('infaq')->row();
?>
<div class="row">
	<div class="col-sm-12 col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Sumary</h3>
			</div>
			<div class="card-body">
				<p class="text-black m-0">Total Omset : <?=number($all_omset->amount) ?> MBIT</p>
				<p class="text-black m-0">Total Kode Unik Omset : <?=number($unik_omset) ?> MBIT</p>
				<p class="text-black m-0">Total Net Omset : <?=number($omset->amount) ?> MBIT</p>
				<p class="text-black m-0">Total fee WD : <?=number($wd->fee) ?> MBIT</p>
				<p class="text-black m-0">Total WD : <?=number($net->net) ?> MBIT</p>
				<p class="text-black m-0">Total Infaq : <?=number($infaq->amount) ?> MBIT</p>
			</div>
		</div>
	</div>
</div>