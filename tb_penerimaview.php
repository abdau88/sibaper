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
$tb_penerima_view = new tb_penerima_view();

// Run the page
$tb_penerima_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_penerima_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_penerima->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftb_penerimaview = currentForm = new ew.Form("ftb_penerimaview", "view");

// Form_CustomValidate event
ftb_penerimaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_penerimaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_penerima->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tb_penerima_view->ExportOptions->render("body") ?>
<?php $tb_penerima_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tb_penerima_view->showPageHeader(); ?>
<?php
$tb_penerima_view->showMessage();
?>
<form name="ftb_penerimaview" id="ftb_penerimaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_penerima_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_penerima_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_penerima">
<input type="hidden" name="modal" value="<?php echo (int)$tb_penerima_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tb_penerima->kd_penerima->Visible) { // kd_penerima ?>
	<tr id="r_kd_penerima">
		<td class="<?php echo $tb_penerima_view->TableLeftColumnClass ?>"><span id="elh_tb_penerima_kd_penerima"><?php echo $tb_penerima->kd_penerima->caption() ?></span></td>
		<td data-name="kd_penerima"<?php echo $tb_penerima->kd_penerima->cellAttributes() ?>>
<span id="el_tb_penerima_kd_penerima">
<span<?php echo $tb_penerima->kd_penerima->viewAttributes() ?>>
<?php echo $tb_penerima->kd_penerima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_penerima->nama_penerima->Visible) { // nama_penerima ?>
	<tr id="r_nama_penerima">
		<td class="<?php echo $tb_penerima_view->TableLeftColumnClass ?>"><span id="elh_tb_penerima_nama_penerima"><?php echo $tb_penerima->nama_penerima->caption() ?></span></td>
		<td data-name="nama_penerima"<?php echo $tb_penerima->nama_penerima->cellAttributes() ?>>
<span id="el_tb_penerima_nama_penerima">
<span<?php echo $tb_penerima->nama_penerima->viewAttributes() ?>>
<?php echo $tb_penerima->nama_penerima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tb_penerima_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_penerima->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_penerima_view->terminate();
?>