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
$tb_unitkerja_delete = new tb_unitkerja_delete();

// Run the page
$tb_unitkerja_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_unitkerja_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftb_unitkerjadelete = currentForm = new ew.Form("ftb_unitkerjadelete", "delete");

// Form_CustomValidate event
ftb_unitkerjadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_unitkerjadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_unitkerja_delete->showPageHeader(); ?>
<?php
$tb_unitkerja_delete->showMessage();
?>
<form name="ftb_unitkerjadelete" id="ftb_unitkerjadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_unitkerja_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_unitkerja_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_unitkerja">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tb_unitkerja_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tb_unitkerja->nama_unit->Visible) { // nama_unit ?>
		<th class="<?php echo $tb_unitkerja->nama_unit->headerCellClass() ?>"><span id="elh_tb_unitkerja_nama_unit" class="tb_unitkerja_nama_unit"><?php echo $tb_unitkerja->nama_unit->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tb_unitkerja_delete->RecCnt = 0;
$i = 0;
while (!$tb_unitkerja_delete->Recordset->EOF) {
	$tb_unitkerja_delete->RecCnt++;
	$tb_unitkerja_delete->RowCnt++;

	// Set row properties
	$tb_unitkerja->resetAttributes();
	$tb_unitkerja->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tb_unitkerja_delete->loadRowValues($tb_unitkerja_delete->Recordset);

	// Render row
	$tb_unitkerja_delete->renderRow();
?>
	<tr<?php echo $tb_unitkerja->rowAttributes() ?>>
<?php if ($tb_unitkerja->nama_unit->Visible) { // nama_unit ?>
		<td<?php echo $tb_unitkerja->nama_unit->cellAttributes() ?>>
<span id="el<?php echo $tb_unitkerja_delete->RowCnt ?>_tb_unitkerja_nama_unit" class="tb_unitkerja_nama_unit">
<span<?php echo $tb_unitkerja->nama_unit->viewAttributes() ?>>
<?php echo $tb_unitkerja->nama_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tb_unitkerja_delete->Recordset->moveNext();
}
$tb_unitkerja_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_unitkerja_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tb_unitkerja_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_unitkerja_delete->terminate();
?>