<?php
namespace PHPMaker2019\project4;
?>
<?php if ($trx_penerimaan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_trx_penerimaanmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
		<tr id="r_kd_penerimaan">
			<td class="<?php echo $trx_penerimaan->TableLeftColumnClass ?>"><?php echo $trx_penerimaan->kd_penerimaan->caption() ?></td>
			<td<?php echo $trx_penerimaan->kd_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_penerimaan">
<span<?php echo $trx_penerimaan->kd_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerimaan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
		<tr id="r_tgl_penerimaan">
			<td class="<?php echo $trx_penerimaan->TableLeftColumnClass ?>"><?php echo $trx_penerimaan->tgl_penerimaan->caption() ?></td>
			<td<?php echo $trx_penerimaan->tgl_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_tgl_penerimaan">
<span<?php echo $trx_penerimaan->tgl_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->tgl_penerimaan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
		<tr id="r_kd_penerima">
			<td class="<?php echo $trx_penerimaan->TableLeftColumnClass ?>"><?php echo $trx_penerimaan->kd_penerima->caption() ?></td>
			<td<?php echo $trx_penerimaan->kd_penerima->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_penerima">
<span<?php echo $trx_penerimaan->kd_penerima->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerima->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
		<tr id="r_kd_unit">
			<td class="<?php echo $trx_penerimaan->TableLeftColumnClass ?>"><?php echo $trx_penerimaan->kd_unit->caption() ?></td>
			<td<?php echo $trx_penerimaan->kd_unit->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_unit">
<span<?php echo $trx_penerimaan->kd_unit->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_unit->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>