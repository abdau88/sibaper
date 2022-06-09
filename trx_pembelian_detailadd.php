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
$trx_pembelian_detail_add = new trx_pembelian_detail_add();

// Run the page
$trx_pembelian_detail_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_detail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftrx_pembelian_detailadd = currentForm = new ew.Form("ftrx_pembelian_detailadd", "add");

// Validate form
ftrx_pembelian_detailadd.validate = function() {
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
		<?php if ($trx_pembelian_detail_add->kode_pembelian->Required) { ?>
			elm = this.getElements("x" + infix + "_kode_pembelian");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian_detail->kode_pembelian->caption(), $trx_pembelian_detail->kode_pembelian->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_kode_pembelian");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_pembelian_detail->kode_pembelian->errorMessage()) ?>");
		<?php if ($trx_pembelian_detail_add->nama_barang->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_barang");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian_detail->nama_barang->caption(), $trx_pembelian_detail->nama_barang->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trx_pembelian_detail_add->qty->Required) { ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian_detail->qty->caption(), $trx_pembelian_detail->qty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_pembelian_detail->qty->errorMessage()) ?>");
		<?php if ($trx_pembelian_detail_add->kd_satuan->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_satuan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian_detail->kd_satuan->caption(), $trx_pembelian_detail->kd_satuan->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_kd_satuan");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_pembelian_detail->kd_satuan->errorMessage()) ?>");

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
ftrx_pembelian_detailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembelian_detailadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembelian_detailadd.lists["x_nama_barang"] = <?php echo $trx_pembelian_detail_add->nama_barang->Lookup->toClientList() ?>;
ftrx_pembelian_detailadd.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_pembelian_detail_add->nama_barang->lookupOptions()) ?>;
ftrx_pembelian_detailadd.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_pembelian_detailadd.lists["x_kd_satuan"] = <?php echo $trx_pembelian_detail_add->kd_satuan->Lookup->toClientList() ?>;
ftrx_pembelian_detailadd.lists["x_kd_satuan"].options = <?php echo JsonEncode($trx_pembelian_detail_add->kd_satuan->lookupOptions()) ?>;
ftrx_pembelian_detailadd.autoSuggests["x_kd_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_pembelian_detail_add->showPageHeader(); ?>
<?php
$trx_pembelian_detail_add->showMessage();
?>
<form name="ftrx_pembelian_detailadd" id="ftrx_pembelian_detailadd" class="<?php echo $trx_pembelian_detail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_pembelian_detail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_pembelian_detail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_pembelian_detail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$trx_pembelian_detail_add->IsModal ?>">
<?php if ($trx_pembelian_detail->getCurrentMasterTable() == "trx_pembelian") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="trx_pembelian">
<input type="hidden" name="fk_kode_pembelian" value="<?php echo $trx_pembelian_detail->kode_pembelian->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($trx_pembelian_detail->kode_pembelian->Visible) { // kode_pembelian ?>
	<div id="r_kode_pembelian" class="form-group row">
		<label id="elh_trx_pembelian_detail_kode_pembelian" for="x_kode_pembelian" class="<?php echo $trx_pembelian_detail_add->LeftColumnClass ?>"><?php echo $trx_pembelian_detail->kode_pembelian->caption() ?><?php echo ($trx_pembelian_detail->kode_pembelian->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_pembelian_detail_add->RightColumnClass ?>"><div<?php echo $trx_pembelian_detail->kode_pembelian->cellAttributes() ?>>
<?php if ($trx_pembelian_detail->kode_pembelian->getSessionValue() <> "") { ?>
<span id="el_trx_pembelian_detail_kode_pembelian">
<span<?php echo $trx_pembelian_detail->kode_pembelian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trx_pembelian_detail->kode_pembelian->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_kode_pembelian" name="x_kode_pembelian" value="<?php echo HtmlEncode($trx_pembelian_detail->kode_pembelian->CurrentValue) ?>">
<?php } else { ?>
<span id="el_trx_pembelian_detail_kode_pembelian">
<input type="text" data-table="trx_pembelian_detail" data-field="x_kode_pembelian" name="x_kode_pembelian" id="x_kode_pembelian" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kode_pembelian->getPlaceHolder()) ?>" value="<?php echo $trx_pembelian_detail->kode_pembelian->EditValue ?>"<?php echo $trx_pembelian_detail->kode_pembelian->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $trx_pembelian_detail->kode_pembelian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_pembelian_detail->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_trx_pembelian_detail_nama_barang" class="<?php echo $trx_pembelian_detail_add->LeftColumnClass ?>"><?php echo $trx_pembelian_detail->nama_barang->caption() ?><?php echo ($trx_pembelian_detail->nama_barang->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_pembelian_detail_add->RightColumnClass ?>"><div<?php echo $trx_pembelian_detail->nama_barang->cellAttributes() ?>>
<span id="el_trx_pembelian_detail_nama_barang">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->nama_barang->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_nama_barang" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_nama_barang" id="sv_x_nama_barang" value="<?php echo RemoveHtml($trx_pembelian_detail->nama_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" data-value-separator="<?php echo $trx_pembelian_detail->nama_barang->displayValueSeparatorAttribute() ?>" name="x_nama_barang" id="x_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailadd.createAutoSuggest({"id":"x_nama_barang","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->nama_barang->Lookup->getParamTag("p_x_nama_barang") ?>
</span>
<?php echo $trx_pembelian_detail->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_pembelian_detail->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_trx_pembelian_detail_qty" for="x_qty" class="<?php echo $trx_pembelian_detail_add->LeftColumnClass ?>"><?php echo $trx_pembelian_detail->qty->caption() ?><?php echo ($trx_pembelian_detail->qty->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_pembelian_detail_add->RightColumnClass ?>"><div<?php echo $trx_pembelian_detail->qty->cellAttributes() ?>>
<span id="el_trx_pembelian_detail_qty">
<input type="text" data-table="trx_pembelian_detail" data-field="x_qty" name="x_qty" id="x_qty" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->qty->getPlaceHolder()) ?>" value="<?php echo $trx_pembelian_detail->qty->EditValue ?>"<?php echo $trx_pembelian_detail->qty->editAttributes() ?>>
</span>
<?php echo $trx_pembelian_detail->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_pembelian_detail->kd_satuan->Visible) { // kd_satuan ?>
	<div id="r_kd_satuan" class="form-group row">
		<label id="elh_trx_pembelian_detail_kd_satuan" class="<?php echo $trx_pembelian_detail_add->LeftColumnClass ?>"><?php echo $trx_pembelian_detail->kd_satuan->caption() ?><?php echo ($trx_pembelian_detail->kd_satuan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_pembelian_detail_add->RightColumnClass ?>"><div<?php echo $trx_pembelian_detail->kd_satuan->cellAttributes() ?>>
<span id="el_trx_pembelian_detail_kd_satuan">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_kd_satuan" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_kd_satuan" id="sv_x_kd_satuan" value="<?php echo RemoveHtml($trx_pembelian_detail->kd_satuan->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->kd_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" data-value-separator="<?php echo $trx_pembelian_detail->kd_satuan->displayValueSeparatorAttribute() ?>" name="x_kd_satuan" id="x_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailadd.createAutoSuggest({"id":"x_kd_satuan","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->kd_satuan->Lookup->getParamTag("p_x_kd_satuan") ?>
</span>
<?php echo $trx_pembelian_detail->kd_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$trx_pembelian_detail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trx_pembelian_detail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_pembelian_detail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trx_pembelian_detail_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_pembelian_detail_add->terminate();
?>