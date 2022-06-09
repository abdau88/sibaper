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
$trx_pembelian_detail_delete = new trx_pembelian_detail_delete();

// Run the page
$trx_pembelian_detail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_detail_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftrx_pembelian_detaildelete = currentForm = new ew.Form("ftrx_pembelian_detaildelete", "delete");

// Form_CustomValidate event
ftrx_pembelian_detaildelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembelian_detaildelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembelian_detaildelete.lists["x_nama_barang"] = <?php echo $trx_pembelian_detail_delete->nama_barang->Lookup->toClientList() ?>;
ftrx_pembelian_detaildelete.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_pembelian_detail_delete->nama_barang->lookupOptions()) ?>;
ftrx_pembelian_detaildelete.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_pembelian_detaildelete.lists["x_kd_satuan"] = <?php echo $trx_pembelian_detail_delete->kd_satuan->Lookup->toClientList() ?>;
ftrx_pembelian_detaildelete.lists["x_kd_satuan"].options = <?php echo JsonEncode($trx_pembelian_detail_delete->kd_satuan->lookupOptions()) ?>;
ftrx_pembelian_detaildelete.autoSuggests["x_kd_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_pembelian_detail_delete->showPageHeader(); ?>
<?php
$trx_pembelian_detail_delete->showMessage();
?>
<form name="ftrx_pembelian_detaildelete" id="ftrx_pembelian_detaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_pembelian_detail_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_pembelian_detail_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_pembelian_detail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($trx_pembelian_detail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($trx_pembelian_detail->nama_barang->Visible) { // nama_barang ?>
		<th class="<?php echo $trx_pembelian_detail->nama_barang->headerCellClass() ?>"><span id="elh_trx_pembelian_detail_nama_barang" class="trx_pembelian_detail_nama_barang"><?php echo $trx_pembelian_detail->nama_barang->caption() ?></span></th>
<?php } ?>
<?php if ($trx_pembelian_detail->qty->Visible) { // qty ?>
		<th class="<?php echo $trx_pembelian_detail->qty->headerCellClass() ?>"><span id="elh_trx_pembelian_detail_qty" class="trx_pembelian_detail_qty"><?php echo $trx_pembelian_detail->qty->caption() ?></span></th>
<?php } ?>
<?php if ($trx_pembelian_detail->kd_satuan->Visible) { // kd_satuan ?>
		<th class="<?php echo $trx_pembelian_detail->kd_satuan->headerCellClass() ?>"><span id="elh_trx_pembelian_detail_kd_satuan" class="trx_pembelian_detail_kd_satuan"><?php echo $trx_pembelian_detail->kd_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$trx_pembelian_detail_delete->RecCnt = 0;
$i = 0;
while (!$trx_pembelian_detail_delete->Recordset->EOF) {
	$trx_pembelian_detail_delete->RecCnt++;
	$trx_pembelian_detail_delete->RowCnt++;

	// Set row properties
	$trx_pembelian_detail->resetAttributes();
	$trx_pembelian_detail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$trx_pembelian_detail_delete->loadRowValues($trx_pembelian_detail_delete->Recordset);

	// Render row
	$trx_pembelian_detail_delete->renderRow();
?>
	<tr<?php echo $trx_pembelian_detail->rowAttributes() ?>>
<?php if ($trx_pembelian_detail->nama_barang->Visible) { // nama_barang ?>
		<td<?php echo $trx_pembelian_detail->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_detail_delete->RowCnt ?>_trx_pembelian_detail_nama_barang" class="trx_pembelian_detail_nama_barang">
<span<?php echo $trx_pembelian_detail->nama_barang->viewAttributes() ?>>
<?php echo $trx_pembelian_detail->nama_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trx_pembelian_detail->qty->Visible) { // qty ?>
		<td<?php echo $trx_pembelian_detail->qty->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_detail_delete->RowCnt ?>_trx_pembelian_detail_qty" class="trx_pembelian_detail_qty">
<span<?php echo $trx_pembelian_detail->qty->viewAttributes() ?>>
<?php echo $trx_pembelian_detail->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trx_pembelian_detail->kd_satuan->Visible) { // kd_satuan ?>
		<td<?php echo $trx_pembelian_detail->kd_satuan->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_detail_delete->RowCnt ?>_trx_pembelian_detail_kd_satuan" class="trx_pembelian_detail_kd_satuan">
<span<?php echo $trx_pembelian_detail->kd_satuan->viewAttributes() ?>>
<?php echo $trx_pembelian_detail->kd_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$trx_pembelian_detail_delete->Recordset->moveNext();
}
$trx_pembelian_detail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_pembelian_detail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$trx_pembelian_detail_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_pembelian_detail_delete->terminate();
?>