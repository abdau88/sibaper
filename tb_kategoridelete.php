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
$tb_kategori_delete = new tb_kategori_delete();

// Run the page
$tb_kategori_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_kategori_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftb_kategoridelete = currentForm = new ew.Form("ftb_kategoridelete", "delete");

// Form_CustomValidate event
ftb_kategoridelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_kategoridelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_kategori_delete->showPageHeader(); ?>
<?php
$tb_kategori_delete->showMessage();
?>
<form name="ftb_kategoridelete" id="ftb_kategoridelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_kategori_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_kategori_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_kategori">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tb_kategori_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tb_kategori->nama_kategori->Visible) { // nama_kategori ?>
		<th class="<?php echo $tb_kategori->nama_kategori->headerCellClass() ?>"><span id="elh_tb_kategori_nama_kategori" class="tb_kategori_nama_kategori"><?php echo $tb_kategori->nama_kategori->caption() ?></span></th>
<?php } ?>
<?php if ($tb_kategori->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $tb_kategori->keterangan->headerCellClass() ?>"><span id="elh_tb_kategori_keterangan" class="tb_kategori_keterangan"><?php echo $tb_kategori->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tb_kategori_delete->RecCnt = 0;
$i = 0;
while (!$tb_kategori_delete->Recordset->EOF) {
	$tb_kategori_delete->RecCnt++;
	$tb_kategori_delete->RowCnt++;

	// Set row properties
	$tb_kategori->resetAttributes();
	$tb_kategori->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tb_kategori_delete->loadRowValues($tb_kategori_delete->Recordset);

	// Render row
	$tb_kategori_delete->renderRow();
?>
	<tr<?php echo $tb_kategori->rowAttributes() ?>>
<?php if ($tb_kategori->nama_kategori->Visible) { // nama_kategori ?>
		<td<?php echo $tb_kategori->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $tb_kategori_delete->RowCnt ?>_tb_kategori_nama_kategori" class="tb_kategori_nama_kategori">
<span<?php echo $tb_kategori->nama_kategori->viewAttributes() ?>>
<?php echo $tb_kategori->nama_kategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tb_kategori->keterangan->Visible) { // keterangan ?>
		<td<?php echo $tb_kategori->keterangan->cellAttributes() ?>>
<span id="el<?php echo $tb_kategori_delete->RowCnt ?>_tb_kategori_keterangan" class="tb_kategori_keterangan">
<span<?php echo $tb_kategori->keterangan->viewAttributes() ?>>
<?php echo $tb_kategori->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tb_kategori_delete->Recordset->moveNext();
}
$tb_kategori_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_kategori_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tb_kategori_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_kategori_delete->terminate();
?>