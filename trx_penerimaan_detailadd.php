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
$trx_penerimaan_detail_add = new trx_penerimaan_detail_add();

// Run the page
$trx_penerimaan_detail_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_detail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftrx_penerimaan_detailadd = currentForm = new ew.Form("ftrx_penerimaan_detailadd", "add");

// Validate form
ftrx_penerimaan_detailadd.validate = function() {
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
		<?php if ($trx_penerimaan_detail_add->nama_barang->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_barang");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->nama_barang->caption(), $trx_penerimaan_detail->nama_barang->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trx_penerimaan_detail_add->qty->Required) { ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_penerimaan_detail->qty->caption(), $trx_penerimaan_detail->qty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_penerimaan_detail->qty->errorMessage()) ?>");

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
ftrx_penerimaan_detailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaan_detailadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaan_detailadd.lists["x_nama_barang"] = <?php echo $trx_penerimaan_detail_add->nama_barang->Lookup->toClientList() ?>;
ftrx_penerimaan_detailadd.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_penerimaan_detail_add->nama_barang->lookupOptions()) ?>;
ftrx_penerimaan_detailadd.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trx_penerimaan_detail_add->showPageHeader(); ?>
<?php
$trx_penerimaan_detail_add->showMessage();
?>
<form name="ftrx_penerimaan_detailadd" id="ftrx_penerimaan_detailadd" class="<?php echo $trx_penerimaan_detail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_detail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_detail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan_detail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$trx_penerimaan_detail_add->IsModal ?>">
<?php if ($trx_penerimaan_detail->getCurrentMasterTable() == "trx_penerimaan") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="trx_penerimaan">
<input type="hidden" name="fk_kd_penerimaan" value="<?php echo $trx_penerimaan_detail->kd_penerimaan->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($trx_penerimaan_detail->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_trx_penerimaan_detail_nama_barang" class="<?php echo $trx_penerimaan_detail_add->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->nama_barang->caption() ?><?php echo ($trx_penerimaan_detail->nama_barang->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_add->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->nama_barang->cellAttributes() ?>>
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
ftrx_penerimaan_detailadd.createAutoSuggest({"id":"x_nama_barang","forceSelect":false});
</script>
<?php echo $trx_penerimaan_detail->nama_barang->Lookup->getParamTag("p_x_nama_barang") ?>
</span>
<?php echo $trx_penerimaan_detail->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trx_penerimaan_detail->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_trx_penerimaan_detail_qty" for="x_qty" class="<?php echo $trx_penerimaan_detail_add->LeftColumnClass ?>"><?php echo $trx_penerimaan_detail->qty->caption() ?><?php echo ($trx_penerimaan_detail->qty->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trx_penerimaan_detail_add->RightColumnClass ?>"><div<?php echo $trx_penerimaan_detail->qty->cellAttributes() ?>>
<span id="el_trx_penerimaan_detail_qty">
<input type="text" data-table="trx_penerimaan_detail" data-field="x_qty" name="x_qty" id="x_qty" size="30" placeholder="<?php echo HtmlEncode($trx_penerimaan_detail->qty->getPlaceHolder()) ?>" value="<?php echo $trx_penerimaan_detail->qty->EditValue ?>"<?php echo $trx_penerimaan_detail->qty->editAttributes() ?>>
</span>
<?php echo $trx_penerimaan_detail->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($trx_penerimaan_detail->kd_penerimaan->getSessionValue()) <> "") { ?>
	<input type="hidden" name="x_kd_penerimaan" id="x_kd_penerimaan" value="<?php echo HtmlEncode(strval($trx_penerimaan_detail->kd_penerimaan->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$trx_penerimaan_detail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trx_penerimaan_detail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trx_penerimaan_detail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trx_penerimaan_detail_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_detail_add->terminate();
?>