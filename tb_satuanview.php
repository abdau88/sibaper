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
$tb_satuan_view = new tb_satuan_view();

// Run the page
$tb_satuan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_satuan_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_satuan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftb_satuanview = currentForm = new ew.Form("ftb_satuanview", "view");

// Form_CustomValidate event
ftb_satuanview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_satuanview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_satuan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tb_satuan_view->ExportOptions->render("body") ?>
<?php $tb_satuan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tb_satuan_view->showPageHeader(); ?>
<?php
$tb_satuan_view->showMessage();
?>
<form name="ftb_satuanview" id="ftb_satuanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_satuan_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_satuan_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_satuan">
<input type="hidden" name="modal" value="<?php echo (int)$tb_satuan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tb_satuan->kd_satuan->Visible) { // kd_satuan ?>
	<tr id="r_kd_satuan">
		<td class="<?php echo $tb_satuan_view->TableLeftColumnClass ?>"><span id="elh_tb_satuan_kd_satuan"><?php echo $tb_satuan->kd_satuan->caption() ?></span></td>
		<td data-name="kd_satuan"<?php echo $tb_satuan->kd_satuan->cellAttributes() ?>>
<span id="el_tb_satuan_kd_satuan">
<span<?php echo $tb_satuan->kd_satuan->viewAttributes() ?>>
<?php echo $tb_satuan->kd_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_satuan->nama_satuan->Visible) { // nama_satuan ?>
	<tr id="r_nama_satuan">
		<td class="<?php echo $tb_satuan_view->TableLeftColumnClass ?>"><span id="elh_tb_satuan_nama_satuan"><?php echo $tb_satuan->nama_satuan->caption() ?></span></td>
		<td data-name="nama_satuan"<?php echo $tb_satuan->nama_satuan->cellAttributes() ?>>
<span id="el_tb_satuan_nama_satuan">
<span<?php echo $tb_satuan->nama_satuan->viewAttributes() ?>>
<?php echo $tb_satuan->nama_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tb_satuan_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_satuan->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_satuan_view->terminate();
?>