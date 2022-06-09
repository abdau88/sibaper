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
$trx_penerimaan_view = new trx_penerimaan_view();

// Run the page
$trx_penerimaan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftrx_penerimaanview = currentForm = new ew.Form("ftrx_penerimaanview", "view");

// Form_CustomValidate event
ftrx_penerimaanview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaanview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaanview.lists["x_kd_penerima"] = <?php echo $trx_penerimaan_view->kd_penerima->Lookup->toClientList() ?>;
ftrx_penerimaanview.lists["x_kd_penerima"].options = <?php echo JsonEncode($trx_penerimaan_view->kd_penerima->lookupOptions()) ?>;
ftrx_penerimaanview.autoSuggests["x_kd_penerima"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_penerimaanview.lists["x_kd_unit"] = <?php echo $trx_penerimaan_view->kd_unit->Lookup->toClientList() ?>;
ftrx_penerimaanview.lists["x_kd_unit"].options = <?php echo JsonEncode($trx_penerimaan_view->kd_unit->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $trx_penerimaan_view->ExportOptions->render("body") ?>
<?php $trx_penerimaan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $trx_penerimaan_view->showPageHeader(); ?>
<?php
$trx_penerimaan_view->showMessage();
?>
<form name="ftrx_penerimaanview" id="ftrx_penerimaanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan">
<input type="hidden" name="modal" value="<?php echo (int)$trx_penerimaan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
	<tr id="r_kd_penerimaan">
		<td class="<?php echo $trx_penerimaan_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_kd_penerimaan"><?php echo $trx_penerimaan->kd_penerimaan->caption() ?></span></td>
		<td data-name="kd_penerimaan"<?php echo $trx_penerimaan->kd_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_penerimaan">
<span<?php echo $trx_penerimaan->kd_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerimaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
	<tr id="r_tgl_penerimaan">
		<td class="<?php echo $trx_penerimaan_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_tgl_penerimaan"><?php echo $trx_penerimaan->tgl_penerimaan->caption() ?></span></td>
		<td data-name="tgl_penerimaan"<?php echo $trx_penerimaan->tgl_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_tgl_penerimaan">
<span<?php echo $trx_penerimaan->tgl_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->tgl_penerimaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
	<tr id="r_kd_penerima">
		<td class="<?php echo $trx_penerimaan_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_kd_penerima"><?php echo $trx_penerimaan->kd_penerima->caption() ?></span></td>
		<td data-name="kd_penerima"<?php echo $trx_penerimaan->kd_penerima->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_penerima">
<span<?php echo $trx_penerimaan->kd_penerima->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
	<tr id="r_kd_unit">
		<td class="<?php echo $trx_penerimaan_view->TableLeftColumnClass ?>"><span id="elh_trx_penerimaan_kd_unit"><?php echo $trx_penerimaan->kd_unit->caption() ?></span></td>
		<td data-name="kd_unit"<?php echo $trx_penerimaan->kd_unit->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_unit">
<span<?php echo $trx_penerimaan->kd_unit->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_unit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("trx_penerimaan_detail", explode(",", $trx_penerimaan->getCurrentDetailTable())) && $trx_penerimaan_detail->DetailView) {
?>
<?php if ($trx_penerimaan->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("trx_penerimaan_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "trx_penerimaan_detailgrid.php" ?>
<?php } ?>
</form>
<?php
$trx_penerimaan_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_view->terminate();
?>