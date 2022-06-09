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
$trx_penerimaan_detail_view = new trx_penerimaan_detail_view();

// Run the page
$trx_penerimaan_detail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_detail_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftrx_penerimaan_detailview = currentForm = new ew.Form("ftrx_penerimaan_detailview", "view");

// Form_CustomValidate event
ftrx_penerimaan_detailview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaan_detailview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaan_detailview.lists["x_nama_barang"] = <?php echo $trx_penerimaan_detail_view->nama_barang->Lookup->toClientList() ?>;
ftrx_penerimaan_detailview.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_penerimaan_detail_view->nama_barang->lookupOptions()) ?>;
ftrx_penerimaan_detailview.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $trx_penerimaan_detail_view->ExportOptions->render("body") ?>
<?php $trx_penerimaan_detail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $trx_penerimaan_detail_view->showPageHeader(); ?>
<?php
$trx_penerimaan_detail_view->showMessage();
?>
<form name="ftrx_penerimaan_detailview" id="ftrx_penerimaan_detailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_detail_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_detail_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan_detail">
<input type="hidden" name="modal" value="<?php echo (int)$trx_penerimaan_detail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($trx_penerimaan_detail->no->Visible) { // no ?>
	<tr id="r_no">
		<td class="<?php echo $trx_penerimaan_detail_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_detail_no"><?php echo $trx_penerimaan_detail->no->caption() ?></span></td>
		<td data-name="no"<?php echo $trx_penerimaan_detail->no->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_no">
<span<?php echo $trx_penerimaan_detail->no->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan_detail->kd_penerimaan->Visible) { // kd_penerimaan ?>
	<tr id="r_kd_penerimaan">
		<td class="<?php echo $trx_penerimaan_detail_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_detail_kd_penerimaan"><?php echo $trx_penerimaan_detail->kd_penerimaan->caption() ?></span></td>
		<td data-name="kd_penerimaan"<?php echo $trx_penerimaan_detail->kd_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_kd_penerimaan">
<span<?php echo $trx_penerimaan_detail->kd_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->kd_penerimaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan_detail->nama_barang->Visible) { // nama_barang ?>
	<tr id="r_nama_barang">
		<td class="<?php echo $trx_penerimaan_detail_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_detail_nama_barang"><?php echo $trx_penerimaan_detail->nama_barang->caption() ?></span></td>
		<td data-name="nama_barang"<?php echo $trx_penerimaan_detail->nama_barang->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_nama_barang">
<span<?php echo $trx_penerimaan_detail->nama_barang->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->nama_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan_detail->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $trx_penerimaan_detail_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_detail_qty"><?php echo $trx_penerimaan_detail->qty->caption() ?></span></td>
		<td data-name="qty"<?php echo $trx_penerimaan_detail->qty->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_qty">
<span<?php echo $trx_penerimaan_detail->qty->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan_detail->paraf->Visible) { // paraf ?>
	<tr id="r_paraf">
		<td class="<?php echo $trx_penerimaan_detail_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_detail_paraf"><?php echo $trx_penerimaan_detail->paraf->caption() ?></span></td>
		<td data-name="paraf"<?php echo $trx_penerimaan_detail->paraf->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_paraf">
<span<?php echo $trx_penerimaan_detail->paraf->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->paraf->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$trx_penerimaan_detail_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_detail_view->terminate();
?>