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
$tb_satuan_delete = new tb_satuan_delete();

// Run the page
$tb_satuan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_satuan_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftb_satuandelete = currentForm = new ew.Form("ftb_satuandelete", "delete");

// Form_CustomValidate event
ftb_satuandelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_satuandelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_satuan_delete->showPageHeader(); ?>
<?php
$tb_satuan_delete->showMessage();
?>
<form name="ftb_satuandelete" id="ftb_satuandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_satuan_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_satuan_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_satuan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tb_satuan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tb_satuan->nama_satuan->Visible) { // nama_satuan ?>
		<th class="<?php echo $tb_satuan->nama_satuan->headerCellClass() ?>"><span id="elh_tb_satuan_nama_satuan" class="tb_satuan_nama_satuan"><?php echo $tb_satuan->nama_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tb_satuan_delete->RecCnt = 0;
$i = 0;
while (!$tb_satuan_delete->Recordset->EOF) {
	$tb_satuan_delete->RecCnt++;
	$tb_satuan_delete->RowCnt++;

	// Set row properties
	$tb_satuan->resetAttributes();
	$tb_satuan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tb_satuan_delete->loadRowValues($tb_satuan_delete->Recordset);

	// Render row
	$tb_satuan_delete->renderRow();
?>
	<tr<?php echo $tb_satuan->rowAttributes() ?>>
<?php if ($tb_satuan->nama_satuan->Visible) { // nama_satuan ?>
		<td<?php echo $tb_satuan->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $tb_satuan_delete->RowCnt ?>_tb_satuan_nama_satuan" class="tb_satuan_nama_satuan">
<span<?php echo $tb_satuan->nama_satuan->viewAttributes() ?>>
<?php echo $tb_satuan->nama_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tb_satuan_delete->Recordset->moveNext();
}
$tb_satuan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_satuan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tb_satuan_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_satuan_delete->terminate();
?>