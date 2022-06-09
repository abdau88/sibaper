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
$trx_pembelian_view = new trx_pembelian_view();

// Run the page
$trx_pembelian_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trx_pembelian->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftrx_pembelianview = currentForm = new ew.Form("ftrx_pembelianview", "view");

// Form_CustomValidate event
ftrx_pembelianview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembelianview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembelianview.lists["x_kd_vendor"] = <?php echo $trx_pembelian_view->kd_vendor->Lookup->toClientList() ?>;
ftrx_pembelianview.lists["x_kd_vendor"].options = <?php echo JsonEncode($trx_pembelian_view->kd_vendor->lookupOptions()) ?>;
ftrx_pembelianview.autoSuggests["x_kd_vendor"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trx_pembelian->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $trx_pembelian_view->ExportOptions->render("body") ?>
<?php $trx_pembelian_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $trx_pembelian_view->showPageHeader(); ?>
<?php
$trx_pembelian_view->showMessage();
?>
<form name="ftrx_pembelianview" id="ftrx_pembelianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_pembelian_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_pembelian_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_pembelian">
<input type="hidden" name="modal" value="<?php echo (int)$trx_pembelian_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($trx_pembelian->kode_pembelian->Visible) { // kode_pembelian ?>
	<tr id="r_kode_pembelian">
		<td class="<?php echo $trx_pembelian_view->TableLeftColumnClass ?>"><span id="elh_trx_pembelian_kode_pembelian"><?php echo $trx_pembelian->kode_pembelian->caption() ?></span></td>
		<td data-name="kode_pembelian"<?php echo $trx_pembelian->kode_pembelian->cellAttributes() ?>>
<span id="el_trx_pembelian_kode_pembelian">
<span<?php echo $trx_pembelian->kode_pembelian->viewAttributes() ?>>
<?php echo $trx_pembelian->kode_pembelian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
	<tr id="r_tgl_pembelian">
		<td class="<?php echo $trx_pembelian_view->TableLeftColumnClass ?>"><span id="elh_trx_pembelian_tgl_pembelian"><?php echo $trx_pembelian->tgl_pembelian->caption() ?></span></td>
		<td data-name="tgl_pembelian"<?php echo $trx_pembelian->tgl_pembelian->cellAttributes() ?>>
<span id="el_trx_pembelian_tgl_pembelian">
<span<?php echo $trx_pembelian->tgl_pembelian->viewAttributes() ?>>
<?php echo $trx_pembelian->tgl_pembelian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
	<tr id="r_kd_vendor">
		<td class="<?php echo $trx_pembelian_view->TableLeftColumnClass ?>"><span id="elh_trx_pembelian_kd_vendor"><?php echo $trx_pembelian->kd_vendor->caption() ?></span></td>
		<td data-name="kd_vendor"<?php echo $trx_pembelian->kd_vendor->cellAttributes() ?>>
<span id="el_trx_pembelian_kd_vendor">
<span<?php echo $trx_pembelian->kd_vendor->viewAttributes() ?>>
<?php echo $trx_pembelian->kd_vendor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("trx_pembelian_detail", explode(",", $trx_pembelian->getCurrentDetailTable())) && $trx_pembelian_detail->DetailView) {
?>
<?php if ($trx_pembelian->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("trx_pembelian_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "trx_pembelian_detailgrid.php" ?>
<?php } ?>
</form>
<?php
$trx_pembelian_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trx_pembelian->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trx_pembelian_view->terminate();
?>