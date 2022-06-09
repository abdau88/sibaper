<?php
namespace PHPMaker2019\project4;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tb_barang_delete = new tb_barang_delete();

// Run the page
$tb_barang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_barang_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftb_barangdelete = currentForm = new ew.Form("ftb_barangdelete", "delete");

// Form_CustomValidate event
ftb_barangdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_barangdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftb_barangdelete.lists["x_kd_kategori"] = <?php echo $tb_barang_delete->kd_kategori->Lookup->toClientList() ?>;
ftb_barangdelete.lists["x_kd_kategori"].options = <?php echo JsonEncode($tb_barang_delete->kd_kategori->lookupOptions()) ?>;
ftb_barangdelete.lists["x_kd_satuan"] = <?php echo $tb_barang_delete->kd_satuan->Lookup->toClientList() ?>;
ftb_barangdelete.lists["x_kd_satuan"].options = <?php echo JsonEncode($tb_barang_delete->kd_satuan->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_barang_delete->showPageHeader(); ?>
<?php
$tb_barang_delete->showMessage();
?>
<form name="ftb_barangdelete" id="ftb_barangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_barang_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_barang_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tb_barang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
		<th class="<?php echo $tb_barang->kode_barang->headerCellClass() ?>"><span id="elh_tb_barang_kode_barang" class="tb_barang_kode_barang"><?php echo $tb_barang->kode_barang->caption() ?></span></th>
<?php } ?>
<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
		<th class="<?php echo $tb_barang->nama_barang->headerCellClass() ?>"><span id="elh_tb_barang_nama_barang" class="tb_barang_nama_barang"><?php echo $tb_barang->nama_barang->caption() ?></span></th>
<?php } ?>
<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
		<th class="<?php echo $tb_barang->kd_kategori->headerCellClass() ?>"><span id="elh_tb_barang_kd_kategori" class="tb_barang_kd_kategori"><?php echo $tb_barang->kd_kategori->caption() ?></span></th>
<?php } ?>
<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
		<th class="<?php echo $tb_barang->kd_satuan->headerCellClass() ?>"><span id="elh_tb_barang_kd_satuan" class="tb_barang_kd_satuan"><?php echo $tb_barang->kd_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
		<th class="<?php echo $tb_barang->stok_awal->headerCellClass() ?>"><span id="elh_tb_barang_stok_awal" class="tb_barang_stok_awal"><?php echo $tb_barang->stok_awal->caption() ?></span></th>
<?php } ?>
<?php if ($tb_barang->stok_akhir->Visible) { // stok_akhir ?>
		<th class="<?php echo $tb_barang->stok_akhir->headerCellClass() ?>"><span id="elh_tb_barang_stok_akhir" class="tb_barang_stok_akhir"><?php echo $tb_barang->stok_akhir->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tb_barang_delete->RecCnt = 0;
$i = 0;
while (!$tb_barang_delete->Recordset->EOF) {
	$tb_barang_delete->RecCnt++;
	$tb_barang_delete->RowCnt++;

	// Set row properties
	$tb_barang->resetAttributes();
	$tb_barang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tb_barang_delete->loadRowValues($tb_barang_delete->Recordset);

	// Render row
	$tb_barang_delete->renderRow();
?>
	<tr<?php echo $tb_barang->rowAttributes() ?>>
<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
		<td<?php echo $tb_barang->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_delete->RowCnt ?>_tb_barang_kode_barang" class="tb_barang_kode_barang">
<span<?php echo $tb_barang->kode_barang->viewAttributes() ?>>
<?php echo $tb_barang->kode_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
		<td<?php echo $tb_barang->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_delete->RowCnt ?>_tb_barang_nama_barang" class="tb_barang_nama_barang">
<span<?php echo $tb_barang->nama_barang->viewAttributes() ?>>
<?php echo $tb_barang->nama_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
		<td<?php echo $tb_barang->kd_kategori->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_delete->RowCnt ?>_tb_barang_kd_kategori" class="tb_barang_kd_kategori">
<span<?php echo $tb_barang->kd_kategori->viewAttributes() ?>>
<?php echo $tb_barang->kd_kategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
		<td<?php echo $tb_barang->kd_satuan->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_delete->RowCnt ?>_tb_barang_kd_satuan" class="tb_barang_kd_satuan">
<span<?php echo $tb_barang->kd_satuan->viewAttributes() ?>>
<?php echo $tb_barang->kd_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
		<td<?php echo $tb_barang->stok_awal->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_delete->RowCnt ?>_tb_barang_stok_awal" class="tb_barang_stok_awal">
<span<?php echo $tb_barang->stok_awal->viewAttributes() ?>>
<?php echo $tb_barang->stok_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_barang->stok_akhir->Visible) { // stok_akhir ?>
		<td<?php echo $tb_barang->stok_akhir->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_delete->RowCnt ?>_tb_barang_stok_akhir" class="tb_barang_stok_akhir">
<span<?php echo $tb_barang->stok_akhir->viewAttributes() ?>>
<?php echo $tb_barang->stok_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tb_barang_delete->Recordset->moveNext();
}
$tb_barang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_barang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tb_barang_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_barang_delete->terminate();
?>