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
$tb_barang_view = new tb_barang_view();

// Run the page
$tb_barang_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_barang_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_barang->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftb_barangview = currentForm = new ew.Form("ftb_barangview", "view");

// Form_CustomValidate event
ftb_barangview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_barangview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftb_barangview.lists["x_kd_kategori"] = <?php echo $tb_barang_view->kd_kategori->Lookup->toClientList() ?>;
ftb_barangview.lists["x_kd_kategori"].options = <?php echo JsonEncode($tb_barang_view->kd_kategori->lookupOptions()) ?>;
ftb_barangview.lists["x_kd_satuan"] = <?php echo $tb_barang_view->kd_satuan->Lookup->toClientList() ?>;
ftb_barangview.lists["x_kd_satuan"].options = <?php echo JsonEncode($tb_barang_view->kd_satuan->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_barang->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tb_barang_view->ExportOptions->render("body") ?>
<?php $tb_barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tb_barang_view->showPageHeader(); ?>
<?php
$tb_barang_view->showMessage();
?>
<form name="ftb_barangview" id="ftb_barangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_barang_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_barang_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_barang">
<input type="hidden" name="modal" value="<?php echo (int)$tb_barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
	<tr id="r_kode_barang">
		<td class="<?php echo $tb_barang_view->TableLeftColumnClass ?>"><span id="elh_tb_barang_kode_barang"><?php echo $tb_barang->kode_barang->caption() ?></span></td>
		<td data-name="kode_barang"<?php echo $tb_barang->kode_barang->cellAttributes() ?>>
<span id="el_tb_barang_kode_barang">
<span<?php echo $tb_barang->kode_barang->viewAttributes() ?>>
<?php echo $tb_barang->kode_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
	<tr id="r_nama_barang">
		<td class="<?php echo $tb_barang_view->TableLeftColumnClass ?>"><span id="elh_tb_barang_nama_barang"><?php echo $tb_barang->nama_barang->caption() ?></span></td>
		<td data-name="nama_barang"<?php echo $tb_barang->nama_barang->cellAttributes() ?>>
<span id="el_tb_barang_nama_barang">
<span<?php echo $tb_barang->nama_barang->viewAttributes() ?>>
<?php echo $tb_barang->nama_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
	<tr id="r_kd_kategori">
		<td class="<?php echo $tb_barang_view->TableLeftColumnClass ?>"><span id="elh_tb_barang_kd_kategori"><?php echo $tb_barang->kd_kategori->caption() ?></span></td>
		<td data-name="kd_kategori"<?php echo $tb_barang->kd_kategori->cellAttributes() ?>>
<span id="el_tb_barang_kd_kategori">
<span<?php echo $tb_barang->kd_kategori->viewAttributes() ?>>
<?php echo $tb_barang->kd_kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
	<tr id="r_kd_satuan">
		<td class="<?php echo $tb_barang_view->TableLeftColumnClass ?>"><span id="elh_tb_barang_kd_satuan"><?php echo $tb_barang->kd_satuan->caption() ?></span></td>
		<td data-name="kd_satuan"<?php echo $tb_barang->kd_satuan->cellAttributes() ?>>
<span id="el_tb_barang_kd_satuan">
<span<?php echo $tb_barang->kd_satuan->viewAttributes() ?>>
<?php echo $tb_barang->kd_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
	<tr id="r_stok_awal">
		<td class="<?php echo $tb_barang_view->TableLeftColumnClass ?>"><span id="elh_tb_barang_stok_awal"><?php echo $tb_barang->stok_awal->caption() ?></span></td>
		<td data-name="stok_awal"<?php echo $tb_barang->stok_awal->cellAttributes() ?>>
<span id="el_tb_barang_stok_awal">
<span<?php echo $tb_barang->stok_awal->viewAttributes() ?>>
<?php echo $tb_barang->stok_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tb_barang_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_barang->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_barang_view->terminate();
?>