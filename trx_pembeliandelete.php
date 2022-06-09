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
$trx_pembelian_delete = new trx_pembelian_delete();

// Run the page
$trx_pembelian_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftrx_pembeliandelete = currentForm = new ew.Form("ftrx_pembeliandelete", "delete");

// Form_CustomValidate event
ftrx_pembeliandelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembeliandelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembeliandelete.lists["x_kd_vendor"] = <?php echo $trx_pembelian_delete->kd_vendor->Lookup->toClientList() ?>;
ftrx_pembeliandelete.lists["x_kd_vendor"].options = <?php echo JsonEncode($trx_pembelian_delete->kd_vendor->lookupOptions()) ?>;
ftrx_pembeliandelete.autoSuggests["x_kd_vendor"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_pembelian_delete->showPageHeader(); ?>
<?php
$trx_pembelian_delete->showMessage();
?>
<form name="ftrx_pembeliandelete" id="ftrx_pembeliandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_pembelian_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_pembelian_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_pembelian">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($trx_pembelian_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<th class="<?php echo $trx_pembelian->tgl_pembelian->headerCellClass() ?>"><span id="elh_trx_pembelian_tgl_pembelian" class="trx_pembelian_tgl_pembelian"><?php echo $trx_pembelian->tgl_pembelian->caption() ?></span></th>
<?php } ?>
<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
		<th class="<?php echo $trx_pembelian->kd_vendor->headerCellClass() ?>"><span id="elh_trx_pembelian_kd_vendor" class="trx_pembelian_kd_vendor"><?php echo $trx_pembelian->kd_vendor->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$trx_pembelian_delete->RecCnt = 0;
$i = 0;
while (!$trx_pembelian_delete->Recordset->EOF) {
	$trx_pembelian_delete->RecCnt++;
	$trx_pembelian_delete->RowCnt++;

	// Set row properties
	$trx_pembelian->resetAttributes();
	$trx_pembelian->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$trx_pembelian_delete->loadRowValues($trx_pembelian_delete->Recordset);

	// Render row
	$trx_pembelian_delete->renderRow();
?>
	<tr<?php echo $trx_pembelian->rowAttributes() ?>>
<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<td<?php echo $trx_pembelian->tgl_pembelian->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_delete->RowCnt ?>_trx_pembelian_tgl_pembelian" class="trx_pembelian_tgl_pembelian">
<span<?php echo $trx_pembelian->tgl_pembelian->viewAttributes() ?>>
<?php echo $trx_pembelian->tgl_pembelian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
		<td<?php echo $trx_pembelian->kd_vendor->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_delete->RowCnt ?>_trx_pembelian_kd_vendor" class="trx_pembelian_kd_vendor">
<span<?php echo $trx_pembelian->kd_vendor->viewAttributes() ?>>
<?php echo $trx_pembelian->kd_vendor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$trx_pembelian_delete->Recordset->moveNext();
}
$trx_pembelian_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_pembelian_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$trx_pembelian_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_pembelian_delete->terminate();
?>