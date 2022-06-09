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
$tb_satuan_edit = new tb_satuan_edit();

// Run the page
$tb_satuan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_satuan_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftb_satuanedit = currentForm = new ew.Form("ftb_satuanedit", "edit");

// Validate form
ftb_satuanedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tb_satuan_edit->kd_satuan->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_satuan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_satuan->kd_satuan->caption(), $tb_satuan->kd_satuan->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_satuan_edit->nama_satuan->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_satuan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_satuan->nama_satuan->caption(), $tb_satuan->nama_satuan->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftb_satuanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_satuanedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_satuan_edit->showPageHeader(); ?>
<?php
$tb_satuan_edit->showMessage();
?>
<form name="ftb_satuanedit" id="ftb_satuanedit" class="<?php echo $tb_satuan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_satuan_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_satuan_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_satuan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tb_satuan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tb_satuan->kd_satuan->Visible) { // kd_satuan ?>
	<div id="r_kd_satuan" class="form-group row">
		<label id="elh_tb_satuan_kd_satuan" class="<?php echo $tb_satuan_edit->LeftColumnClass ?>"><?php echo $tb_satuan->kd_satuan->caption() ?><?php echo ($tb_satuan->kd_satuan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_satuan_edit->RightColumnClass ?>"><div<?php echo $tb_satuan->kd_satuan->cellAttributes() ?>>
<span id="el_tb_satuan_kd_satuan">
<span<?php echo $tb_satuan->kd_satuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tb_satuan->kd_satuan->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tb_satuan" data-field="x_kd_satuan" name="x_kd_satuan" id="x_kd_satuan" value="<?php echo HtmlEncode($tb_satuan->kd_satuan->CurrentValue) ?>">
<?php echo $tb_satuan->kd_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_satuan->nama_satuan->Visible) { // nama_satuan ?>
	<div id="r_nama_satuan" class="form-group row">
		<label id="elh_tb_satuan_nama_satuan" for="x_nama_satuan" class="<?php echo $tb_satuan_edit->LeftColumnClass ?>"><?php echo $tb_satuan->nama_satuan->caption() ?><?php echo ($tb_satuan->nama_satuan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_satuan_edit->RightColumnClass ?>"><div<?php echo $tb_satuan->nama_satuan->cellAttributes() ?>>
<span id="el_tb_satuan_nama_satuan">
<input type="text" data-table="tb_satuan" data-field="x_nama_satuan" name="x_nama_satuan" id="x_nama_satuan" size="30" maxlength="35" placeholder="<?php echo HtmlEncode($tb_satuan->nama_satuan->getPlaceHolder()) ?>" value="<?php echo $tb_satuan->nama_satuan->EditValue ?>"<?php echo $tb_satuan->nama_satuan->editAttributes() ?>>
</span>
<?php echo $tb_satuan->nama_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tb_satuan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tb_satuan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_satuan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tb_satuan_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_satuan_edit->terminate();
?>