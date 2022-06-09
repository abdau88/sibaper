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
$tb_penerima_edit = new tb_penerima_edit();

// Run the page
$tb_penerima_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_penerima_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftb_penerimaedit = currentForm = new ew.Form("ftb_penerimaedit", "edit");

// Validate form
ftb_penerimaedit.validate = function() {
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
		<?php if ($tb_penerima_edit->kd_penerima->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_penerima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_penerima->kd_penerima->caption(), $tb_penerima->kd_penerima->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_penerima_edit->nama_penerima->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_penerima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_penerima->nama_penerima->caption(), $tb_penerima->nama_penerima->RequiredErrorMessage)) ?>");
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
ftb_penerimaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_penerimaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_penerima_edit->showPageHeader(); ?>
<?php
$tb_penerima_edit->showMessage();
?>
<form name="ftb_penerimaedit" id="ftb_penerimaedit" class="<?php echo $tb_penerima_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_penerima_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_penerima_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_penerima">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tb_penerima_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tb_penerima->kd_penerima->Visible) { // kd_penerima ?>
	<div id="r_kd_penerima" class="form-group row">
		<label id="elh_tb_penerima_kd_penerima" class="<?php echo $tb_penerima_edit->LeftColumnClass ?>"><?php echo $tb_penerima->kd_penerima->caption() ?><?php echo ($tb_penerima->kd_penerima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_penerima_edit->RightColumnClass ?>"><div<?php echo $tb_penerima->kd_penerima->cellAttributes() ?>>
<span id="el_tb_penerima_kd_penerima">
<span<?php echo $tb_penerima->kd_penerima->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tb_penerima->kd_penerima->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tb_penerima" data-field="x_kd_penerima" name="x_kd_penerima" id="x_kd_penerima" value="<?php echo HtmlEncode($tb_penerima->kd_penerima->CurrentValue) ?>">
<?php echo $tb_penerima->kd_penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_penerima->nama_penerima->Visible) { // nama_penerima ?>
	<div id="r_nama_penerima" class="form-group row">
		<label id="elh_tb_penerima_nama_penerima" for="x_nama_penerima" class="<?php echo $tb_penerima_edit->LeftColumnClass ?>"><?php echo $tb_penerima->nama_penerima->caption() ?><?php echo ($tb_penerima->nama_penerima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_penerima_edit->RightColumnClass ?>"><div<?php echo $tb_penerima->nama_penerima->cellAttributes() ?>>
<span id="el_tb_penerima_nama_penerima">
<input type="text" data-table="tb_penerima" data-field="x_nama_penerima" name="x_nama_penerima" id="x_nama_penerima" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tb_penerima->nama_penerima->getPlaceHolder()) ?>" value="<?php echo $tb_penerima->nama_penerima->EditValue ?>"<?php echo $tb_penerima->nama_penerima->editAttributes() ?>>
</span>
<?php echo $tb_penerima->nama_penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tb_penerima_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tb_penerima_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_penerima_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tb_penerima_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_penerima_edit->terminate();
?>