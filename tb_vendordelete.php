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
$tb_vendor_delete = new tb_vendor_delete();

// Run the page
$tb_vendor_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_vendor_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftb_vendordelete = currentForm = new ew.Form("ftb_vendordelete", "delete");

// Form_CustomValidate event
ftb_vendordelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_vendordelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_vendor_delete->showPageHeader(); ?>
<?php
$tb_vendor_delete->showMessage();
?>
<form name="ftb_vendordelete" id="ftb_vendordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_vendor_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_vendor_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_vendor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tb_vendor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tb_vendor->nama_vendor->Visible) { // nama_vendor ?>
		<th class="<?php echo $tb_vendor->nama_vendor->headerCellClass() ?>"><span id="elh_tb_vendor_nama_vendor" class="tb_vendor_nama_vendor"><?php echo $tb_vendor->nama_vendor->caption() ?></span></th>
<?php } ?>
<?php if ($tb_vendor->alamat->Visible) { // alamat ?>
		<th class="<?php echo $tb_vendor->alamat->headerCellClass() ?>"><span id="elh_tb_vendor_alamat" class="tb_vendor_alamat"><?php echo $tb_vendor->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($tb_vendor->telp->Visible) { // telp ?>
		<th class="<?php echo $tb_vendor->telp->headerCellClass() ?>"><span id="elh_tb_vendor_telp" class="tb_vendor_telp"><?php echo $tb_vendor->telp->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tb_vendor_delete->RecCnt = 0;
$i = 0;
while (!$tb_vendor_delete->Recordset->EOF) {
	$tb_vendor_delete->RecCnt++;
	$tb_vendor_delete->RowCnt++;

	// Set row properties
	$tb_vendor->resetAttributes();
	$tb_vendor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tb_vendor_delete->loadRowValues($tb_vendor_delete->Recordset);

	// Render row
	$tb_vendor_delete->renderRow();
?>
	<tr<?php echo $tb_vendor->rowAttributes() ?>>
<?php if ($tb_vendor->nama_vendor->Visible) { // nama_vendor ?>
		<td<?php echo $tb_vendor->nama_vendor->cellAttributes() ?>>
<span id="el<?php echo $tb_vendor_delete->RowCnt ?>_tb_vendor_nama_vendor" class="tb_vendor_nama_vendor">
<span<?php echo $tb_vendor->nama_vendor->viewAttributes() ?>>
<?php echo $tb_vendor->nama_vendor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_vendor->alamat->Visible) { // alamat ?>
		<td<?php echo $tb_vendor->alamat->cellAttributes() ?>>
<span id="el<?php echo $tb_vendor_delete->RowCnt ?>_tb_vendor_alamat" class="tb_vendor_alamat">
<span<?php echo $tb_vendor->alamat->viewAttributes() ?>>
<?php echo $tb_vendor->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_vendor->telp->Visible) { // telp ?>
		<td<?php echo $tb_vendor->telp->cellAttributes() ?>>
<span id="el<?php echo $tb_vendor_delete->RowCnt ?>_tb_vendor_telp" class="tb_vendor_telp">
<span<?php echo $tb_vendor->telp->viewAttributes() ?>>
<?php echo $tb_vendor->telp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tb_vendor_delete->Recordset->moveNext();
}
$tb_vendor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_vendor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tb_vendor_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_vendor_delete->terminate();
?>