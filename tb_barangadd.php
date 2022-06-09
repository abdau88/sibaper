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
$tb_barang_add = new tb_barang_add();

// Run the page
$tb_barang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_barang_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftb_barangadd = currentForm = new ew.Form("ftb_barangadd", "add");

// Validate form
ftb_barangadd.validate = function() {
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
		<?php if ($tb_barang_add->kode_barang->Required) { ?>
			elm = this.getElements("x" + infix + "_kode_barang");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_barang->kode_barang->caption(), $tb_barang->kode_barang->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_barang_add->nama_barang->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_barang");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_barang->nama_barang->caption(), $tb_barang->nama_barang->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_barang_add->kd_kategori->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_kategori");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_barang->kd_kategori->caption(), $tb_barang->kd_kategori->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_barang_add->kd_satuan->Required) { ?>
			elm = this.getElements("x" + infix + "_kd_satuan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_barang->kd_satuan->caption(), $tb_barang->kd_satuan->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_barang_add->stok_awal->Required) { ?>
			elm = this.getElements("x" + infix + "_stok_awal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_barang->stok_awal->caption(), $tb_barang->stok_awal->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_stok_awal");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tb_barang->stok_awal->errorMessage()) ?>");
		<?php if ($tb_barang_add->stok_akhir->Required) { ?>
			elm = this.getElements("x" + infix + "_stok_akhir");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_barang->stok_akhir->caption(), $tb_barang->stok_akhir->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_stok_akhir");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tb_barang->stok_akhir->errorMessage()) ?>");

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
ftb_barangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_barangadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftb_barangadd.lists["x_kd_kategori"] = <?php echo $tb_barang_add->kd_kategori->Lookup->toClientList() ?>;
ftb_barangadd.lists["x_kd_kategori"].options = <?php echo JsonEncode($tb_barang_add->kd_kategori->lookupOptions()) ?>;
ftb_barangadd.lists["x_kd_satuan"] = <?php echo $tb_barang_add->kd_satuan->Lookup->toClientList() ?>;
ftb_barangadd.lists["x_kd_satuan"].options = <?php echo JsonEncode($tb_barang_add->kd_satuan->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_barang_add->showPageHeader(); ?>
<?php
$tb_barang_add->showMessage();
?>
<form name="ftb_barangadd" id="ftb_barangadd" class="<?php echo $tb_barang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_barang_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_barang_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_barang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tb_barang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
	<div id="r_kode_barang" class="form-group row">
		<label id="elh_tb_barang_kode_barang" for="x_kode_barang" class="<?php echo $tb_barang_add->LeftColumnClass ?>"><?php echo $tb_barang->kode_barang->caption() ?><?php echo ($tb_barang->kode_barang->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_barang_add->RightColumnClass ?>"><div<?php echo $tb_barang->kode_barang->cellAttributes() ?>>
<span id="el_tb_barang_kode_barang">
<input type="text" data-table="tb_barang" data-field="x_kode_barang" name="x_kode_barang" id="x_kode_barang" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($tb_barang->kode_barang->getPlaceHolder()) ?>" value="<?php echo $tb_barang->kode_barang->EditValue ?>"<?php echo $tb_barang->kode_barang->editAttributes() ?>>
</span>
<?php echo $tb_barang->kode_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_tb_barang_nama_barang" for="x_nama_barang" class="<?php echo $tb_barang_add->LeftColumnClass ?>"><?php echo $tb_barang->nama_barang->caption() ?><?php echo ($tb_barang->nama_barang->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_barang_add->RightColumnClass ?>"><div<?php echo $tb_barang->nama_barang->cellAttributes() ?>>
<span id="el_tb_barang_nama_barang">
<input type="text" data-table="tb_barang" data-field="x_nama_barang" name="x_nama_barang" id="x_nama_barang" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tb_barang->nama_barang->getPlaceHolder()) ?>" value="<?php echo $tb_barang->nama_barang->EditValue ?>"<?php echo $tb_barang->nama_barang->editAttributes() ?>>
</span>
<?php echo $tb_barang->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
	<div id="r_kd_kategori" class="form-group row">
		<label id="elh_tb_barang_kd_kategori" for="x_kd_kategori" class="<?php echo $tb_barang_add->LeftColumnClass ?>"><?php echo $tb_barang->kd_kategori->caption() ?><?php echo ($tb_barang->kd_kategori->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_barang_add->RightColumnClass ?>"><div<?php echo $tb_barang->kd_kategori->cellAttributes() ?>>
<span id="el_tb_barang_kd_kategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tb_barang" data-field="x_kd_kategori" data-value-separator="<?php echo $tb_barang->kd_kategori->displayValueSeparatorAttribute() ?>" id="x_kd_kategori" name="x_kd_kategori"<?php echo $tb_barang->kd_kategori->editAttributes() ?>>
		<?php echo $tb_barang->kd_kategori->selectOptionListHtml("x_kd_kategori") ?>
	</select>
</div>
<?php echo $tb_barang->kd_kategori->Lookup->getParamTag("p_x_kd_kategori") ?>
</span>
<?php echo $tb_barang->kd_kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
	<div id="r_kd_satuan" class="form-group row">
		<label id="elh_tb_barang_kd_satuan" for="x_kd_satuan" class="<?php echo $tb_barang_add->LeftColumnClass ?>"><?php echo $tb_barang->kd_satuan->caption() ?><?php echo ($tb_barang->kd_satuan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_barang_add->RightColumnClass ?>"><div<?php echo $tb_barang->kd_satuan->cellAttributes() ?>>
<span id="el_tb_barang_kd_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tb_barang" data-field="x_kd_satuan" data-value-separator="<?php echo $tb_barang->kd_satuan->displayValueSeparatorAttribute() ?>" id="x_kd_satuan" name="x_kd_satuan"<?php echo $tb_barang->kd_satuan->editAttributes() ?>>
		<?php echo $tb_barang->kd_satuan->selectOptionListHtml("x_kd_satuan") ?>
	</select>
</div>
<?php echo $tb_barang->kd_satuan->Lookup->getParamTag("p_x_kd_satuan") ?>
</span>
<?php echo $tb_barang->kd_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
	<div id="r_stok_awal" class="form-group row">
		<label id="elh_tb_barang_stok_awal" for="x_stok_awal" class="<?php echo $tb_barang_add->LeftColumnClass ?>"><?php echo $tb_barang->stok_awal->caption() ?><?php echo ($tb_barang->stok_awal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_barang_add->RightColumnClass ?>"><div<?php echo $tb_barang->stok_awal->cellAttributes() ?>>
<span id="el_tb_barang_stok_awal">
<input type="text" data-table="tb_barang" data-field="x_stok_awal" name="x_stok_awal" id="x_stok_awal" size="30" placeholder="<?php echo HtmlEncode($tb_barang->stok_awal->getPlaceHolder()) ?>" value="<?php echo $tb_barang->stok_awal->EditValue ?>"<?php echo $tb_barang->stok_awal->editAttributes() ?>>
</span>
<?php echo $tb_barang->stok_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_barang->stok_akhir->Visible) { // stok_akhir ?>
	<div id="r_stok_akhir" class="form-group row">
		<label id="elh_tb_barang_stok_akhir" for="x_stok_akhir" class="<?php echo $tb_barang_add->LeftColumnClass ?>"><?php echo $tb_barang->stok_akhir->caption() ?><?php echo ($tb_barang->stok_akhir->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_barang_add->RightColumnClass ?>"><div<?php echo $tb_barang->stok_akhir->cellAttributes() ?>>
<span id="el_tb_barang_stok_akhir">
<input type="text" data-table="tb_barang" data-field="x_stok_akhir" name="x_stok_akhir" id="x_stok_akhir" size="30" placeholder="<?php echo HtmlEncode($tb_barang->stok_akhir->getPlaceHolder()) ?>" value="<?php echo $tb_barang->stok_akhir->EditValue ?>"<?php echo $tb_barang->stok_akhir->editAttributes() ?>>
</span>
<?php echo $tb_barang->stok_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tb_barang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tb_barang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Simpan") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_barang_add->getReturnUrl() ?>"><?php echo $Language->phrase("Batal") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tb_barang_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_barang_add->terminate();
?>