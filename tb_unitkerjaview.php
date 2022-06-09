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
$tb_unitkerja_view = new tb_unitkerja_view();

// Run the page
$tb_unitkerja_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_unitkerja_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_unitkerja->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftb_unitkerjaview = currentForm = new ew.Form("ftb_unitkerjaview", "view");

// Form_CustomValidate event
ftb_unitkerjaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_unitkerjaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_unitkerja->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tb_unitkerja_view->ExportOptions->render("body") ?>
<?php $tb_unitkerja_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tb_unitkerja_view->showPageHeader(); ?>
<?php
$tb_unitkerja_view->showMessage();
?>
<form name="ftb_unitkerjaview" id="ftb_unitkerjaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_unitkerja_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_unitkerja_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_unitkerja">
<input type="hidden" name="modal" value="<?php echo (int)$tb_unitkerja_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tb_unitkerja->kd_unit->Visible) { // kd_unit ?>
	<tr id="r_kd_unit">
		<td class="<?php echo $tb_unitkerja_view->TableLeftColumnClass ?>"><span id="elh_tb_unitkerja_kd_unit"><?php echo $tb_unitkerja->kd_unit->caption() ?></span></td>
		<td data-name="kd_unit"<?php echo $tb_unitkerja->kd_unit->cellAttributes() ?>>
<span id="el_tb_unitkerja_kd_unit">
<span<?php echo $tb_unitkerja->kd_unit->viewAttributes() ?>>
<?php echo $tb_unitkerja->kd_unit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_unitkerja->nama_unit->Visible) { // nama_unit ?>
	<tr id="r_nama_unit">
		<td class="<?php echo $tb_unitkerja_view->TableLeftColumnClass ?>"><span id="elh_tb_unitkerja_nama_unit"><?php echo $tb_unitkerja->nama_unit->caption() ?></span></td>
		<td data-name="nama_unit"<?php echo $tb_unitkerja->nama_unit->cellAttributes() ?>>
<span id="el_tb_unitkerja_nama_unit">
<span<?php echo $tb_unitkerja->nama_unit->viewAttributes() ?>>
<?php echo $tb_unitkerja->nama_unit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tb_unitkerja_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_unitkerja->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_unitkerja_view->terminate();
?>