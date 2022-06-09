<?php
namespace PHPMaker2019\project4;
?>
<?php if ($trx_pembelian->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_trx_pembelianmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<tr id="r_tgl_pembelian">
			<td class="<?php echo $trx_pembelian->TableLeftColumnClass ?>"><?php echo $trx_pembelian->tgl_pembelian->caption() ?></td>
			<td<?php echo $trx_pembelian->tgl_pembelian->cellAttributes() ?>>
<span id="el_trx_pembelian_tgl_pembelian">
<span<?php echo $trx_pembelian->tgl_pembelian->viewAttributes() ?>>
<?php echo $trx_pembelian->tgl_pembelian->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
		<tr id="r_kd_vendor">
			<td class="<?php echo $trx_pembelian->TableLeftColumnClass ?>"><?php echo $trx_pembelian->kd_vendor->caption() ?></td>
			<td<?php echo $trx_pembelian->kd_vendor->cellAttributes() ?>>
<span id="el_trx_pembelian_kd_vendor">
<span<?php echo $trx_pembelian->kd_vendor->viewAttributes() ?>>
<?php echo $trx_pembelian->kd_vendor->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>