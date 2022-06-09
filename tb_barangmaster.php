<?php
namespace PHPMaker2019\project4;
?>
<?php if ($tb_barang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tb_barangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
		<tr id="r_kode_barang">
			<td class="<?php echo $tb_barang->TableLeftColumnClass ?>"><?php echo $tb_barang->kode_barang->caption() ?></td>
			<td<?php echo $tb_barang->kode_barang->cellAttributes() ?>>
<span id="el_tb_barang_kode_barang">
<span<?php echo $tb_barang->kode_barang->viewAttributes() ?>>
<?php echo $tb_barang->kode_barang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
		<tr id="r_nama_barang">
			<td class="<?php echo $tb_barang->TableLeftColumnClass ?>"><?php echo $tb_barang->nama_barang->caption() ?></td>
			<td<?php echo $tb_barang->nama_barang->cellAttributes() ?>>
<span id="el_tb_barang_nama_barang">
<span<?php echo $tb_barang->nama_barang->viewAttributes() ?>>
<?php echo $tb_barang->nama_barang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
		<tr id="r_kd_kategori">
			<td class="<?php echo $tb_barang->TableLeftColumnClass ?>"><?php echo $tb_barang->kd_kategori->caption() ?></td>
			<td<?php echo $tb_barang->kd_kategori->cellAttributes() ?>>
<span id="el_tb_barang_kd_kategori">
<span<?php echo $tb_barang->kd_kategori->viewAttributes() ?>>
<?php echo $tb_barang->kd_kategori->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
		<tr id="r_kd_satuan">
			<td class="<?php echo $tb_barang->TableLeftColumnClass ?>"><?php echo $tb_barang->kd_satuan->caption() ?></td>
			<td<?php echo $tb_barang->kd_satuan->cellAttributes() ?>>
<span id="el_tb_barang_kd_satuan">
<span<?php echo $tb_barang->kd_satuan->viewAttributes() ?>>
<?php echo $tb_barang->kd_satuan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
		<tr id="r_stok_awal">
			<td class="<?php echo $tb_barang->TableLeftColumnClass ?>"><?php echo $tb_barang->stok_awal->caption() ?></td>
			<td<?php echo $tb_barang->stok_awal->cellAttributes() ?>>
<span id="el_tb_barang_stok_awal">
<span<?php echo $tb_barang->stok_awal->viewAttributes() ?>>
<?php echo $tb_barang->stok_awal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tb_barang->stok_akhir->Visible) { // stok_akhir ?>
		<tr id="r_stok_akhir">
			<td class="<?php echo $tb_barang->TableLeftColumnClass ?>"><?php echo $tb_barang->stok_akhir->caption() ?></td>
			<td<?php echo $tb_barang->stok_akhir->cellAttributes() ?>>
<span id="el_tb_barang_stok_akhir">
<span<?php echo $tb_barang->stok_akhir->viewAttributes() ?>>
<?php echo $tb_barang->stok_akhir->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>