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
$tb_vendor_view = new tb_vendor_view();

// Run the page
$tb_vendor_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_vendor_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_vendor->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftb_vendorview = currentForm = new ew.Form("ftb_vendorview", "view");

// Form_CustomValidate event
ftb_vendorview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_vendorview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_vendor->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tb_vendor_view->ExportOptions->render("body") ?>
<?php $tb_vendor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tb_vendor_view->showPageHeader(); ?>
<?php
$tb_vendor_view->showMessage();
?>
<form name="ftb_vendorview" id="ftb_vendorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_vendor_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_vendor_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_vendor">
<input type="hidden" name="modal" value="<?php echo (int)$tb_vendor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tb_vendor->kd_vendor->Visible) { // kd_vendor ?>
	<tr id="r_kd_vendor">
		<td class="<?php echo $tb_vendor_view->TableLeftColumnClass ?>"><span id="elh_tb_vendor_kd_vendor"><?php echo $tb_vendor->kd_vendor->caption() ?></span></td>
		<td data-name="kd_vendor"<?php echo $tb_vendor->kd_vendor->cellAttributes() ?>>
<span id="el_tb_vendor_kd_vendor">
<span<?php echo $tb_vendor->kd_vendor->viewAttributes() ?>>
<?php echo $tb_vendor->kd_vendor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_vendor->nama_vendor->Visible) { // nama_vendor ?>
	<tr id="r_nama_vendor">
		<td class="<?php echo $tb_vendor_view->TableLeftColumnClass ?>"><span id="elh_tb_vendor_nama_vendor"><?php echo $tb_vendor->nama_vendor->caption() ?></span></td>
		<td data-name="nama_vendor"<?php echo $tb_vendor->nama_vendor->cellAttributes() ?>>
<span id="el_tb_vendor_nama_vendor">
<span<?php echo $tb_vendor->nama_vendor->viewAttributes() ?>>
<?php echo $tb_vendor->nama_vendor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_vendor->alamat->Visible) { // alamat ?>
	<tr id="r_alamat">
		<td class="<?php echo $tb_vendor_view->TableLeftColumnClass ?>"><span id="elh_tb_vendor_alamat"><?php echo $tb_vendor->alamat->caption() ?></span></td>
		<td data-name="alamat"<?php echo $tb_vendor->alamat->cellAttributes() ?>>
<span id="el_tb_vendor_alamat">
<span<?php echo $tb_vendor->alamat->viewAttributes() ?>>
<?php echo $tb_vendor->alamat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_vendor->telp->Visible) { // telp ?>
	<tr id="r_telp">
		<td class="<?php echo $tb_vendor_view->TableLeftColumnClass ?>"><span id="elh_tb_vendor_telp"><?php echo $tb_vendor->telp->caption() ?></span></td>
		<td data-name="telp"<?php echo $tb_vendor->telp->cellAttributes() ?>>
<span id="el_tb_vendor_telp">
<span<?php echo $tb_vendor->telp->viewAttributes() ?>>
<?php echo $tb_vendor->telp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tb_vendor_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_vendor->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_vendor_view->terminate();
?>