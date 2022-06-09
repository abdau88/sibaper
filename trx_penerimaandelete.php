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
$trx_penerimaan_delete = new trx_penerimaan_delete();

// Run the page
$trx_penerimaan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftrx_penerimaandelete = currentForm = new ew.Form("ftrx_penerimaandelete", "delete");

// Form_CustomValidate event
ftrx_penerimaandelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaandelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaandelete.lists["x_kd_penerima"] = <?php echo $trx_penerimaan_delete->kd_penerima->Lookup->toClientList() ?>;
ftrx_penerimaandelete.lists["x_kd_penerima"].options = <?php echo JsonEncode($trx_penerimaan_delete->kd_penerima->lookupOptions()) ?>;
ftrx_penerimaandelete.autoSuggests["x_kd_penerima"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_penerimaandelete.lists["x_kd_unit"] = <?php echo $trx_penerimaan_delete->kd_unit->Lookup->toClientList() ?>;
ftrx_penerimaandelete.lists["x_kd_unit"].options = <?php echo JsonEncode($trx_penerimaan_delete->kd_unit->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_penerimaan_delete->showPageHeader(); ?>
<?php
$trx_penerimaan_delete->showMessage();
?>
<form name="ftrx_penerimaandelete" id="ftrx_penerimaandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($trx_penerimaan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
		<th class="<?php echo $trx_penerimaan->kd_penerimaan->headerCellClass() ?>"><span id="elh_trx_penerimaan_kd_penerimaan" class="trx_penerimaan_kd_penerimaan"><?php echo $trx_penerimaan->kd_penerimaan->caption() ?></span></th>
<?php } ?>
<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
		<th class="<?php echo $trx_penerimaan->tgl_penerimaan->headerCellClass() ?>"><span id="elh_trx_penerimaan_tgl_penerimaan" class="trx_penerimaan_tgl_penerimaan"><?php echo $trx_penerimaan->tgl_penerimaan->caption() ?></span></th>
<?php } ?>
<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
		<th class="<?php echo $trx_penerimaan->kd_penerima->headerCellClass() ?>"><span id="elh_trx_penerimaan_kd_penerima" class="trx_penerimaan_kd_penerima"><?php echo $trx_penerimaan->kd_penerima->caption() ?></span></th>
<?php } ?>
<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
		<th class="<?php echo $trx_penerimaan->kd_unit->headerCellClass() ?>"><span id="elh_trx_penerimaan_kd_unit" class="trx_penerimaan_kd_unit"><?php echo $trx_penerimaan->kd_unit->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$trx_penerimaan_delete->RecCnt = 0;
$i = 0;
while (!$trx_penerimaan_delete->Recordset->EOF) {
	$trx_penerimaan_delete->RecCnt++;
	$trx_penerimaan_delete->RowCnt++;

	// Set row properties
	$trx_penerimaan->resetAttributes();
	$trx_penerimaan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$trx_penerimaan_delete->loadRowValues($trx_penerimaan_delete->Recordset);

	// Render row
	$trx_penerimaan_delete->renderRow();
?>
	<tr<?php echo $trx_penerimaan->rowAttributes() ?>>
<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
		<td<?php echo $trx_penerimaan->kd_penerimaan->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_delete->RowCnt ?>_trx_penerimaan_kd_penerimaan" class="trx_penerimaan_kd_penerimaan">
<span<?php echo $trx_penerimaan->kd_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerimaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
		<td<?php echo $trx_penerimaan->tgl_penerimaan->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_delete->RowCnt ?>_trx_penerimaan_tgl_penerimaan" class="trx_penerimaan_tgl_penerimaan">
<span<?php echo $trx_penerimaan->tgl_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->tgl_penerimaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
		<td<?php echo $trx_penerimaan->kd_penerima->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_delete->RowCnt ?>_trx_penerimaan_kd_penerima" class="trx_penerimaan_kd_penerima">
<span<?php echo $trx_penerimaan->kd_penerima->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
		<td<?php echo $trx_penerimaan->kd_unit->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_delete->RowCnt ?>_trx_penerimaan_kd_unit" class="trx_penerimaan_kd_unit">
<span<?php echo $trx_penerimaan->kd_unit->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$trx_penerimaan_delete->Recordset->moveNext();
}
$trx_penerimaan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_penerimaan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$trx_penerimaan_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_delete->terminate();
?>