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
$tb_kategori_view = new tb_kategori_view();

// Run the page
$tb_kategori_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_kategori_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_kategori->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftb_kategoriview = currentForm = new ew.Form("ftb_kategoriview", "view");

// Form_CustomValidate event
ftb_kategoriview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_kategoriview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_kategori->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tb_kategori_view->ExportOptions->render("body") ?>
<?php $tb_kategori_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tb_kategori_view->showPageHeader(); ?>
<?php
$tb_kategori_view->showMessage();
?>
<form name="ftb_kategoriview" id="ftb_kategoriview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_kategori_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_kategori_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_kategori">
<input type="hidden" name="modal" value="<?php echo (int)$tb_kategori_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tb_kategori->kd_kategori->Visible) { // kd_kategori ?>
	<tr id="r_kd_kategori">
		<td class="<?php echo $tb_kategori_view->TableLeftColumnClass ?>"><span id="elh_tb_kategori_kd_kategori"><?php echo $tb_kategori->kd_kategori->caption() ?></span></td>
		<td data-name="kd_kategori"<?php echo $tb_kategori->kd_kategori->cellAttributes() ?>>
<span id="el_tb_kategori_kd_kategori">
<span<?php echo $tb_kategori->kd_kategori->viewAttributes() ?>>
<?php echo $tb_kategori->kd_kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_kategori->nama_kategori->Visible) { // nama_kategori ?>
	<tr id="r_nama_kategori">
		<td class="<?php echo $tb_kategori_view->TableLeftColumnClass ?>"><span id="elh_tb_kategori_nama_kategori"><?php echo $tb_kategori->nama_kategori->caption() ?></span></td>
		<td data-name="nama_kategori"<?php echo $tb_kategori->nama_kategori->cellAttributes() ?>>
<span id="el_tb_kategori_nama_kategori">
<span<?php echo $tb_kategori->nama_kategori->viewAttributes() ?>>
<?php echo $tb_kategori->nama_kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tb_kategori->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $tb_kategori_view->TableLeftColumnClass ?>"><span id="elh_tb_kategori_keterangan"><?php echo $tb_kategori->keterangan->caption() ?></span></td>
		<td data-name="keterangan"<?php echo $tb_kategori->keterangan->cellAttributes() ?>>
<span id="el_tb_kategori_keterangan">
<span<?php echo $tb_kategori->keterangan->viewAttributes() ?>>
<?php echo $tb_kategori->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tb_kategori_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_kategori->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_kategori_view->terminate();
?>