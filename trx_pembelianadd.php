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
$trx_pembelian_add = new trx_pembelian_add();

// Run the page
$trx_pembelian_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftrx_pembelianadd = currentForm = new ew.Form("ftrx_pembelianadd", "add");

// Validate form
ftrx_pembelianadd.validate = function() {
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
		<?php if ($trx_pembelian_add->tgl_pembelian->Required) { ?>
			elm = this.getElements("x" + infix + "_tgl_pembelian");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian->tgl_pembelian->caption(), $trx_pembelian->tgl_pembelian->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tgl_pembelian");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_pembelian->tgl_pembelian->errorMessage()) ?>");
		<?php if ($trx_pembelian_add->kd_vendor->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_vendor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian->kd_vendor->caption(), $trx_pembelian->kd_vendor->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_kd_vendor");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_pembelian->kd_vendor->errorMessage()) ?>");

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
ftrx_pembelianadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembelianadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembelianadd.lists["x_kd_vendor"] = <?php echo $trx_pembelian_add->kd_vendor->Lookup->toClientList() ?>;
ftrx_pembelianadd.lists["x_kd_vendor"].options = <?php echo JsonEncode($trx_pembelian_add->kd_vendor->lookupOptions()) ?>;
ftrx_pembelianadd.autoSuggests["x_kd_vendor"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_pembelian_add->showPageHeader(); ?>
<?php
$trx_pembelian_add->showMessage();
?>
<form name="ftrx_pembelianadd" id="ftrx_pembelianadd" class="<?php echo $trx_pembelian_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_pembelian_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_pembelian_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_pembelian">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$trx_pembelian_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
	<div id="r_tgl_pembelian" class="form-group row">
		<label id="elh_trx_pembelian_tgl_pembelian" for="x_tgl_pembelian" class="<?php echo $trx_pembelian_add->LeftColumnClass ?>"><?php echo $trx_pembelian->tgl_pembelian->caption() ?><?php echo ($trx_pembelian->tgl_pembelian->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_pembelian_add->RightColumnClass ?>"><div<?php echo $trx_pembelian->tgl_pembelian->cellAttributes() ?>>
<span id="el_trx_pembelian_tgl_pembelian">
<input type="text" data-table="trx_pembelian" data-field="x_tgl_pembelian" data-format="5" name="x_tgl_pembelian" id="x_tgl_pembelian" placeholder="<?php echo HtmlEncode($trx_pembelian->tgl_pembelian->getPlaceHolder()) ?>" value="<?php echo $trx_pembelian->tgl_pembelian->EditValue ?>"<?php echo $trx_pembelian->tgl_pembelian->editAttributes() ?>>
<?php if (!$trx_pembelian->tgl_pembelian->ReadOnly && !$trx_pembelian->tgl_pembelian->Disabled && !isset($trx_pembelian->tgl_pembelian->EditAttrs["readonly"]) && !isset($trx_pembelian->tgl_pembelian->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrx_pembelianadd", "x_tgl_pembelian", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php echo $trx_pembelian->tgl_pembelian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
	<div id="r_kd_vendor" class="form-group row">
		<label id="elh_trx_pembelian_kd_vendor" class="<?php echo $trx_pembelian_add->LeftColumnClass ?>"><?php echo $trx_pembelian->kd_vendor->caption() ?><?php echo ($trx_pembelian->kd_vendor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_pembelian_add->RightColumnClass ?>"><div<?php echo $trx_pembelian->kd_vendor->cellAttributes() ?>>
<span id="el_trx_pembelian_kd_vendor">
<?php
$wrkonchange = "" . trim(@$trx_pembelian->kd_vendor->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian->kd_vendor->EditAttrs["onchange"] = "";
?>
<span id="as_x_kd_vendor" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_kd_vendor" id="sv_x_kd_vendor" value="<?php echo RemoveHtml($trx_pembelian->kd_vendor->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian->kd_vendor->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian->kd_vendor->getPlaceHolder()) ?>"<?php echo $trx_pembelian->kd_vendor->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian" data-field="x_kd_vendor" data-value-separator="<?php echo $trx_pembelian->kd_vendor->displayValueSeparatorAttribute() ?>" name="x_kd_vendor" id="x_kd_vendor" value="<?php echo HtmlEncode($trx_pembelian->kd_vendor->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelianadd.createAutoSuggest({"id":"x_kd_vendor","forceSelect":false});
</script>
<?php echo $trx_pembelian->kd_vendor->Lookup->getParamTag("p_x_kd_vendor") ?>
</span>
<?php echo $trx_pembelian->kd_vendor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("trx_pembelian_detail", explode(",", $trx_pembelian->getCurrentDetailTable())) && $trx_pembelian_detail->DetailAdd) {
?>
<?php if ($trx_pembelian->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("trx_pembelian_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "trx_pembelian_detailgrid.php" ?>
<?php } ?>
<?php if (!$trx_pembelian_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trx_pembelian_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_pembelian_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trx_pembelian_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_pembelian_add->terminate();
?>