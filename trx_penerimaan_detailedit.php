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
$trx_penerimaan_detail_edit = new trx_penerimaan_detail_edit();

// Run the page
$trx_penerimaan_detail_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_detail_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftrx_penerimaan_detailedit = currentForm = new ew.Form("ftrx_penerimaan_detailedit", "edit");

// Validate form
ftrx_penerimaan_detailedit.validate = function() {
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
		<?php if ($trx_penerimaan_detail_edit->no->Required) { ?>
			elm = this.getElements("x" + infix + "_no");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->no->caption(), $trx_penerimaan_detail->no->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trx_penerimaan_detail_edit->kd_penerimaan->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_penerimaan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->kd_penerimaan->caption(), $trx_penerimaan_detail->kd_penerimaan->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_kd_penerimaan");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_penerimaan_detail->kd_penerimaan->errorMessage()) ?>");
		<?php if ($trx_penerimaan_detail_edit->nama_barang->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_barang");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->nama_barang->caption(), $trx_penerimaan_detail->nama_barang->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trx_penerimaan_detail_edit->qty->Required) { ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->qty->caption(), $trx_penerimaan_detail->qty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_penerimaan_detail->qty->errorMessage()) ?>");
		<?php if ($trx_penerimaan_detail_edit->paraf->Required) { ?>
			elm = this.getElements("x" + infix + "_paraf");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->paraf->caption(), $trx_penerimaan_detail->paraf->RequiredErrorMessage)) ?>");
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
ftrx_penerimaan_detailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaan_detailedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaan_detailedit.lists["x_nama_barang"] = <?php echo $trx_penerimaan_detail_edit->nama_barang->Lookup->toClientList() ?>;
ftrx_penerimaan_detailedit.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_penerimaan_detail_edit->nama_barang->lookupOptions()) ?>;
ftrx_penerimaan_detailedit.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_penerimaan_detail_edit->showPageHeader(); ?>
<?php
$trx_penerimaan_detail_edit->showMessage();
?>
<form name="ftrx_penerimaan_detailedit" id="ftrx_penerimaan_detailedit" class="<?php echo $trx_penerimaan_detail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_detail_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_detail_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan_detail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$trx_penerimaan_detail_edit->IsModal ?>">
<?php if ($trx_penerimaan_detail->getCurrentMasterTable() == "trx_penerimaan") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="trx_penerimaan">
<input type="hidden" name="fk_kd_penerimaan" value="<?php echo $trx_penerimaan_detail->kd_penerimaan->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($trx_penerimaan_detail->no->Visible) { // no ?>
	<div id="r_no" class="form-group row">
		<label id="elh_trx_penerimaan_detail_no" class="<?php echo $trx_penerimaan_detail_edit->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->no->caption() ?><?php echo ($trx_penerimaan_detail->no->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_edit->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->no->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_no">
<span<?php echo $trx_penerimaan_detail->no->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trx_penerimaan_detail->no->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="trx_penerimaan_detail" data-field="x_no" name="x_no" id="x_no" value="<?php echo HtmlEncode($trx_penerimaan_detail->no->CurrentValue) ?>">
<?php echo $trx_penerimaan_detail->no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan_detail->kd_penerimaan->Visible) { // kd_penerimaan ?>
	<div id="r_kd_penerimaan" class="form-group row">
		<label id="elh_trx_penerimaan_detail_kd_penerimaan" for="x_kd_penerimaan" class="<?php echo $trx_penerimaan_detail_edit->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->kd_penerimaan->caption() ?><?php echo ($trx_penerimaan_detail->kd_penerimaan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_edit->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->kd_penerimaan->cellAttributes() ?>>
<?php if ($trx_penerimaan_detail->kd_penerimaan->getSessionValue() <> "") { ?>
<span id="el_trx_penerimaan_detail_kd_penerimaan">
<span<?php echo $trx_penerimaan_detail->kd_penerimaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trx_penerimaan_detail->kd_penerimaan->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_kd_penerimaan" name="x_kd_penerimaan" value="<?php echo HtmlEncode($trx_penerimaan_detail->kd_penerimaan->CurrentValue) ?>">
<?php } else { ?>
<span id="el_trx_penerimaan_detail_kd_penerimaan">
<input type="text" data-table="trx_penerimaan_detail" data-field="x_kd_penerimaan" name="x_kd_penerimaan" id="x_kd_penerimaan" size="30" placeholder="<?php echo HtmlEncode($trx_penerimaan_detail->kd_penerimaan->getPlaceHolder()) ?>" value="<?php echo $trx_penerimaan_detail->kd_penerimaan->EditValue ?>"<?php echo $trx_penerimaan_detail->kd_penerimaan->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $trx_penerimaan_detail->kd_penerimaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan_detail->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_trx_penerimaan_detail_nama_barang" class="<?php echo $trx_penerimaan_detail_edit->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->nama_barang->caption() ?><?php echo ($trx_penerimaan_detail->nama_barang->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_edit->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->nama_barang->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_nama_barang">
<?php
$wrkonchange = "" . trim(@$trx_penerimaan_detail->nama_barang->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_penerimaan_detail->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_nama_barang" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_nama_barang" id="sv_x_nama_barang" value="<?php echo RemoveHtml($trx_penerimaan_detail->nama_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($trx_penerimaan_detail->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_penerimaan_detail->nama_barang->getPlaceHolder()) ?>"<?php echo $trx_penerimaan_detail->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_penerimaan_detail" data-field="x_nama_barang" data-value-separator="<?php echo $trx_penerimaan_detail->nama_barang->displayValueSeparatorAttribute() ?>" name="x_nama_barang" id="x_nama_barang" value="<?php echo HtmlEncode($trx_penerimaan_detail->nama_barang->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_penerimaan_detailedit.createAutoSuggest({"id":"x_nama_barang","forceSelect":false});
</script>
<?php echo $trx_penerimaan_detail->nama_barang->Lookup->getParamTag("p_x_nama_barang") ?>
</span>
<?php echo $trx_penerimaan_detail->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan_detail->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_trx_penerimaan_detail_qty" for="x_qty" class="<?php echo $trx_penerimaan_detail_edit->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->qty->caption() ?><?php echo ($trx_penerimaan_detail->qty->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_edit->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->qty->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_qty">
<input type="text" data-table="trx_penerimaan_detail" data-field="x_qty" name="x_qty" id="x_qty" size="30" placeholder="<?php echo HtmlEncode($trx_penerimaan_detail->qty->getPlaceHolder()) ?>" value="<?php echo $trx_penerimaan_detail->qty->EditValue ?>"<?php echo $trx_penerimaan_detail->qty->editAttributes() ?>>
</span>
<?php echo $trx_penerimaan_detail->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan_detail->paraf->Visible) { // paraf ?>
	<div id="r_paraf" class="form-group row">
		<label id="elh_trx_penerimaan_detail_paraf" for="x_paraf" class="<?php echo $trx_penerimaan_detail_edit->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->paraf->caption() ?><?php echo ($trx_penerimaan_detail->paraf->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_edit->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->paraf->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_paraf">
<input type="text" data-table="trx_penerimaan_detail" data-field="x_paraf" name="x_paraf" id="x_paraf" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($trx_penerimaan_detail->paraf->getPlaceHolder()) ?>" value="<?php echo $trx_penerimaan_detail->paraf->EditValue ?>"<?php echo $trx_penerimaan_detail->paraf->editAttributes() ?>>
</span>
<?php echo $trx_penerimaan_detail->paraf->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$trx_penerimaan_detail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trx_penerimaan_detail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_penerimaan_detail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trx_penerimaan_detail_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_detail_edit->terminate();
?>