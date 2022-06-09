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
$tb_user_add = new tb_user_add();

// Run the page
$tb_user_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_user_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftb_useradd = currentForm = new ew.Form("ftb_useradd", "add");

// Validate form
ftb_useradd.validate = function() {
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
		<?php if ($tb_user_add->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_user->username->caption(), $tb_user->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tb_user_add->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tb_user->password->caption(), $tb_user->password->RequiredErrorMessage)) ?>");
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
ftb_useradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_useradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tb_user_add->showPageHeader(); ?>
<?php
$tb_user_add->showMessage();
?>
<form name="ftb_useradd" id="ftb_useradd" class="<?php echo $tb_user_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_user_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_user_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_user">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tb_user_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tb_user->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_tb_user_username" for="x_username" class="<?php echo $tb_user_add->LeftColumnClass ?>"><?php echo $tb_user->username->caption() ?><?php echo ($tb_user->username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_user_add->RightColumnClass ?>"><div<?php echo $tb_user->username->cellAttributes() ?>>
<span id="el_tb_user_username">
<input type="text" data-table="tb_user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tb_user->username->getPlaceHolder()) ?>" value="<?php echo $tb_user->username->EditValue ?>"<?php echo $tb_user->username->editAttributes() ?>>
</span>
<?php echo $tb_user->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tb_user->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_tb_user_password" for="x_password" class="<?php echo $tb_user_add->LeftColumnClass ?>"><?php echo $tb_user->password->caption() ?><?php echo ($tb_user->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tb_user_add->RightColumnClass ?>"><div<?php echo $tb_user->password->cellAttributes() ?>>
<span id="el_tb_user_password">
<input type="text" data-table="tb_user" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tb_user->password->getPlaceHolder()) ?>" value="<?php echo $tb_user->password->EditValue ?>"<?php echo $tb_user->password->editAttributes() ?>>
</span>
<?php echo $tb_user->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tb_user_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tb_user_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tb_user_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tb_user_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tb_user_add->terminate();
?>