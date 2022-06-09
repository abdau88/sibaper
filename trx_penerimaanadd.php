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
$trx_penerimaan_add = new trx_penerimaan_add();

// Run the page
$trx_penerimaan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftrx_penerimaanadd = currentForm = new ew.Form("ftrx_penerimaanadd", "add");

// Validate form
ftrx_penerimaanadd.validate = function() {
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
		<?php if ($trx_penerimaan_add->kd_penerimaan->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_penerimaan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan->kd_penerimaan->caption(), $trx_penerimaan->kd_penerimaan->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_kd_penerimaan");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_penerimaan->kd_penerimaan->errorMessage()) ?>");
		<?php if ($trx_penerimaan_add->tgl_penerimaan->Required) { ?>
			elm = this.getElements("x" + infix + "_tgl_penerimaan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan->tgl_penerimaan->caption(), $trx_penerimaan->tgl_penerimaan->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tgl_penerimaan");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_penerimaan->tgl_penerimaan->errorMessage()) ?>");
		<?php if ($trx_penerimaan_add->kd_penerima->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_penerima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan->kd_penerima->caption(), $trx_penerimaan->kd_penerima->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_kd_penerima");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_penerimaan->kd_penerima->errorMessage()) ?>");
		<?php if ($trx_penerimaan_add->kd_unit->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_unit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan->kd_unit->caption(), $trx_penerimaan->kd_unit->RequiredErrorMessage)) ?>");
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
ftrx_penerimaanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaanadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaanadd.lists["x_kd_penerima"] = <?php echo $trx_penerimaan_add->kd_penerima->Lookup->toClientList() ?>;
ftrx_penerimaanadd.lists["x_kd_penerima"].options = <?php echo JsonEncode($trx_penerimaan_add->kd_penerima->lookupOptions()) ?>;
ftrx_penerimaanadd.autoSuggests["x_kd_penerima"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_penerimaanadd.lists["x_kd_unit"] = <?php echo $trx_penerimaan_add->kd_unit->Lookup->toClientList() ?>;
ftrx_penerimaanadd.lists["x_kd_unit"].options = <?php echo JsonEncode($trx_penerimaan_add->kd_unit->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_penerimaan_add->showPageHeader(); ?>
<?php
$trx_penerimaan_add->showMessage();
?>
<form name="ftrx_penerimaanadd" id="ftrx_penerimaanadd" class="<?php echo $trx_penerimaan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$trx_penerimaan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
	<div id="r_kd_penerimaan" class="form-group row">
		<label id="elh_trx_penerimaan_kd_penerimaan" for="x_kd_penerimaan" class="<?php echo $trx_penerimaan_add->LeftColumnClass ?>"><?php echo $trx_penerimaan->kd_penerimaan->caption() ?><?php echo ($trx_penerimaan->kd_penerimaan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_add->RightColumnClass ?>"><div<?php echo $trx_penerimaan->kd_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_penerimaan">
<input type="text" data-table="trx_penerimaan" data-field="x_kd_penerimaan" name="x_kd_penerimaan" id="x_kd_penerimaan" placeholder="<?php echo HtmlEncode($trx_penerimaan->kd_penerimaan->getPlaceHolder()) ?>" value="<?php echo $trx_penerimaan->kd_penerimaan->EditValue ?>"<?php echo $trx_penerimaan->kd_penerimaan->editAttributes() ?>>
</span>
<?php echo $trx_penerimaan->kd_penerimaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
	<div id="r_tgl_penerimaan" class="form-group row">
		<label id="elh_trx_penerimaan_tgl_penerimaan" for="x_tgl_penerimaan" class="<?php echo $trx_penerimaan_add->LeftColumnClass ?>"><?php echo $trx_penerimaan->tgl_penerimaan->caption() ?><?php echo ($trx_penerimaan->tgl_penerimaan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_add->RightColumnClass ?>"><div<?php echo $trx_penerimaan->tgl_penerimaan->cellAttributes() ?>>
<span id="el_trx_penerimaan_tgl_penerimaan">
<input type="text" data-table="trx_penerimaan" data-field="x_tgl_penerimaan" data-format="5" name="x_tgl_penerimaan" id="x_tgl_penerimaan" placeholder="<?php echo HtmlEncode($trx_penerimaan->tgl_penerimaan->getPlaceHolder()) ?>" value="<?php echo $trx_penerimaan->tgl_penerimaan->EditValue ?>"<?php echo $trx_penerimaan->tgl_penerimaan->editAttributes() ?>>
<?php if (!$trx_penerimaan->tgl_penerimaan->ReadOnly && !$trx_penerimaan->tgl_penerimaan->Disabled && !isset($trx_penerimaan->tgl_penerimaan->EditAttrs["readonly"]) && !isset($trx_penerimaan->tgl_penerimaan->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrx_penerimaanadd", "x_tgl_penerimaan", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php echo $trx_penerimaan->tgl_penerimaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
	<div id="r_kd_penerima" class="form-group row">
		<label id="elh_trx_penerimaan_kd_penerima" class="<?php echo $trx_penerimaan_add->LeftColumnClass ?>"><?php echo $trx_penerimaan->kd_penerima->caption() ?><?php echo ($trx_penerimaan->kd_penerima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_add->RightColumnClass ?>"><div<?php echo $trx_penerimaan->kd_penerima->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_penerima">
<?php
$wrkonchange = "" . trim(@$trx_penerimaan->kd_penerima->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_penerimaan->kd_penerima->EditAttrs["onchange"] = "";
?>
<span id="as_x_kd_penerima" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_kd_penerima" id="sv_x_kd_penerima" value="<?php echo RemoveHtml($trx_penerimaan->kd_penerima->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trx_penerimaan->kd_penerima->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_penerimaan->kd_penerima->getPlaceHolder()) ?>"<?php echo $trx_penerimaan->kd_penerima->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_penerimaan" data-field="x_kd_penerima" data-value-separator="<?php echo $trx_penerimaan->kd_penerima->displayValueSeparatorAttribute() ?>" name="x_kd_penerima" id="x_kd_penerima" value="<?php echo HtmlEncode($trx_penerimaan->kd_penerima->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_penerimaanadd.createAutoSuggest({"id":"x_kd_penerima","forceSelect":false});
</script>
<?php echo $trx_penerimaan->kd_penerima->Lookup->getParamTag("p_x_kd_penerima") ?>
</span>
<?php echo $trx_penerimaan->kd_penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
	<div id="r_kd_unit" class="form-group row">
		<label id="elh_trx_penerimaan_kd_unit" for="x_kd_unit" class="<?php echo $trx_penerimaan_add->LeftColumnClass ?>"><?php echo $trx_penerimaan->kd_unit->caption() ?><?php echo ($trx_penerimaan->kd_unit->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_add->RightColumnClass ?>"><div<?php echo $trx_penerimaan->kd_unit->cellAttributes() ?>>
<span id="el_trx_penerimaan_kd_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="trx_penerimaan" data-field="x_kd_unit" data-value-separator="<?php echo $trx_penerimaan->kd_unit->displayValueSeparatorAttribute() ?>" id="x_kd_unit" name="x_kd_unit"<?php echo $trx_penerimaan->kd_unit->editAttributes() ?>>
		<?php echo $trx_penerimaan->kd_unit->selectOptionListHtml("x_kd_unit") ?>
	</select>
</div>
<?php echo $trx_penerimaan->kd_unit->Lookup->getParamTag("p_x_kd_unit") ?>
</span>
<?php echo $trx_penerimaan->kd_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("trx_penerimaan_detail", explode(",", $trx_penerimaan->getCurrentDetailTable())) && $trx_penerimaan_detail->DetailAdd) {
?>
<?php if ($trx_penerimaan->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("trx_penerimaan_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "trx_penerimaan_detailgrid.php" ?>
<?php } ?>
<?php if (!$trx_penerimaan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trx_penerimaan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Simpan") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_penerimaan_add->getReturnUrl() ?>"><?php echo $Language->phrase("Batal") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trx_penerimaan_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_add->terminate();
?>