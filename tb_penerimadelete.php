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
$tb_penerima_delete = new tb_penerima_delete();

// Run the page
$tb_penerima_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_penerima_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftb_penerimadelete = currentForm = new ew.Form("ftb_penerimadelete", "delete");

// Form_CustomValidate event
ftb_penerimadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_penerimadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_penerima_delete->showPageHeader(); ?>
<?php
$tb_penerima_delete->showMessage();
?>
<form name="ftb_penerimadelete" id="ftb_penerimadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_penerima_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_penerima_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_penerima">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tb_penerima_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tb_penerima->kd_penerima->Visible) { // kd_penerima ?>
		<th class="<?php echo $tb_penerima->kd_penerima->headerCellClass() ?>"><span id="elh_tb_penerima_kd_penerima" class="tb_penerima_kd_penerima"><?php echo $tb_penerima->kd_penerima->caption() ?></span></th>
<?php } ?>
<?php if ($tb_penerima->nama_penerima->Visible) { // nama_penerima ?>
		<th class="<?php echo $tb_penerima->nama_penerima->headerCellClass() ?>"><span id="elh_tb_penerima_nama_penerima" class="tb_penerima_nama_penerima"><?php echo $tb_penerima->nama_penerima->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tb_penerima_delete->RecCnt = 0;
$i = 0;
while (!$tb_penerima_delete->Recordset->EOF) {
	$tb_penerima_delete->RecCnt++;
	$tb_penerima_delete->RowCnt++;

	// Set row properties
	$tb_penerima->resetAttributes();
	$tb_penerima->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tb_penerima_delete->loadRowValues($tb_penerima_delete->Recordset);

	// Render row
	$tb_penerima_delete->renderRow();
?>
	<tr<?php echo $tb_penerima->rowAttributes() ?>>
<?php if ($tb_penerima->kd_penerima->Visible) { // kd_penerima ?>
		<td<?php echo $tb_penerima->kd_penerima->cellAttributes() ?>>
<span id="el<?php echo $tb_penerima_delete->RowCnt ?>_tb_penerima_kd_penerima" class="tb_penerima_kd_penerima">
<span<?php echo $tb_penerima->kd_penerima->viewAttributes() ?>>
<?php echo $tb_penerima->kd_penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_penerima->nama_penerima->Visible) { // nama_penerima ?>
		<td<?php echo $tb_penerima->nama_penerima->cellAttributes() ?>>
<span id="el<?php echo $tb_penerima_delete->RowCnt ?>_tb_penerima_nama_penerima" class="tb_penerima_nama_penerima">
<span<?php echo $tb_penerima->nama_penerima->viewAttributes() ?>>
<?php echo $tb_penerima->nama_penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tb_penerima_delete->Recordset->moveNext();
}
$tb_penerima_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_penerima_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tb_penerima_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_penerima_delete->terminate();
?>