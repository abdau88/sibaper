<?php
namespace PHPMaker2019\project4;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($trx_pembelian_detail_grid))
	$trx_pembelian_detail_grid = new trx_pembelian_detail_grid();

// Run the page
$trx_pembelian_detail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_detail_grid->Page_Render();
?>
<?php if (!$trx_pembelian_detail->isExport()) { ?>
<script>

// Form object
var ftrx_pembelian_detailgrid = new ew.Form("ftrx_pembelian_detailgrid", "grid");
ftrx_pembelian_detailgrid.formKeyCountName = '<?php echo $trx_pembelian_detail_grid->FormKeyCountName ?>';

// Validate form
ftrx_pembelian_detailgrid.validate = function() {
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
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($trx_pembelian_detail_grid->nama_barang->Required) { ?>
			elm = this.getElements("x" + infix + "_nama_barang");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian_detail->nama_barang->caption(), $trx_pembelian_detail->nama_barang->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trx_pembelian_detail_grid->qty->Required) { ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trx_pembelian_detail->qty->caption(), $trx_pembelian_detail->qty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_qty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trx_pembelian_detail->qty->errorMessage()) ?>");
		<?php if ($trx_pembelian_detail_grid->kd_satuan->Required) { ?>
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
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftrx_pembelian_detailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "nama_barang", false)) return false;
	if (ew.valueChanged(fobj, infix, "qty", false)) return false;
	if (ew.valueChanged(fobj, infix, "kd_satuan", false)) return false;
	return true;
}

// Form_CustomValidate event
ftrx_pembelian_detailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembelian_detailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembelian_detailgrid.lists["x_nama_barang"] = <?php echo $trx_pembelian_detail_grid->nama_barang->Lookup->toClientList() ?>;
ftrx_pembelian_detailgrid.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_pembelian_detail_grid->nama_barang->lookupOptions()) ?>;
ftrx_pembelian_detailgrid.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_pembelian_detailgrid.lists["x_kd_satuan"] = <?php echo $trx_pembelian_detail_grid->kd_satuan->Lookup->toClientList() ?>;
ftrx_pembelian_detailgrid.lists["x_kd_satuan"].options = <?php echo JsonEncode($trx_pembelian_detail_grid->kd_satuan->lookupOptions()) ?>;
ftrx_pembelian_detailgrid.autoSuggests["x_kd_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$trx_pembelian_detail_grid->renderOtherOptions();
?>
<?php $trx_pembelian_detail_grid->showPageHeader(); ?>
<?php
$trx_pembelian_detail_grid->showMessage();
?>
<?php if ($trx_pembelian_detail_grid->TotalRecs > 0 || $trx_pembelian_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trx_pembelian_detail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trx_pembelian_detail">
<div id="ftrx_pembelian_detailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_trx_pembelian_detail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_trx_pembelian_detailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trx_pembelian_detail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$trx_pembelian_detail_grid->renderListOptions();

// Render list options (header, left)
$trx_pembelian_detail_grid->ListOptions->render("header", "left");
?>
<?php if ($trx_pembelian_detail->nama_barang->Visible) { // nama_barang ?>
	<?php if ($trx_pembelian_detail->sortUrl($trx_pembelian_detail->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $trx_pembelian_detail->nama_barang->headerCellClass() ?>"><div id="elh_trx_pembelian_detail_nama_barang" class="trx_pembelian_detail_nama_barang"><div class="ew-table-header-caption"><?php echo $trx_pembelian_detail->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $trx_pembelian_detail->nama_barang->headerCellClass() ?>"><div><div id="elh_trx_pembelian_detail_nama_barang" class="trx_pembelian_detail_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_pembelian_detail->nama_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_pembelian_detail->nama_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_pembelian_detail->nama_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_pembelian_detail->qty->Visible) { // qty ?>
	<?php if ($trx_pembelian_detail->sortUrl($trx_pembelian_detail->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $trx_pembelian_detail->qty->headerCellClass() ?>"><div id="elh_trx_pembelian_detail_qty" class="trx_pembelian_detail_qty"><div class="ew-table-header-caption"><?php echo $trx_pembelian_detail->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $trx_pembelian_detail->qty->headerCellClass() ?>"><div><div id="elh_trx_pembelian_detail_qty" class="trx_pembelian_detail_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_pembelian_detail->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_pembelian_detail->qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_pembelian_detail->qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_pembelian_detail->kd_satuan->Visible) { // kd_satuan ?>
	<?php if ($trx_pembelian_detail->sortUrl($trx_pembelian_detail->kd_satuan) == "") { ?>
		<th data-name="kd_satuan" class="<?php echo $trx_pembelian_detail->kd_satuan->headerCellClass() ?>"><div id="elh_trx_pembelian_detail_kd_satuan" class="trx_pembelian_detail_kd_satuan"><div class="ew-table-header-caption"><?php echo $trx_pembelian_detail->kd_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_satuan" class="<?php echo $trx_pembelian_detail->kd_satuan->headerCellClass() ?>"><div><div id="elh_trx_pembelian_detail_kd_satuan" class="trx_pembelian_detail_kd_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_pembelian_detail->kd_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_pembelian_detail->kd_satuan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_pembelian_detail->kd_satuan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trx_pembelian_detail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$trx_pembelian_detail_grid->StartRec = 1;
$trx_pembelian_detail_grid->StopRec = $trx_pembelian_detail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $trx_pembelian_detail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($trx_pembelian_detail_grid->FormKeyCountName) && ($trx_pembelian_detail->isGridAdd() || $trx_pembelian_detail->isGridEdit() || $trx_pembelian_detail->isConfirm())) {
		$trx_pembelian_detail_grid->KeyCount = $CurrentForm->getValue($trx_pembelian_detail_grid->FormKeyCountName);
		$trx_pembelian_detail_grid->StopRec = $trx_pembelian_detail_grid->StartRec + $trx_pembelian_detail_grid->KeyCount - 1;
	}
}
$trx_pembelian_detail_grid->RecCnt = $trx_pembelian_detail_grid->StartRec - 1;
if ($trx_pembelian_detail_grid->Recordset && !$trx_pembelian_detail_grid->Recordset->EOF) {
	$trx_pembelian_detail_grid->Recordset->moveFirst();
	$selectLimit = $trx_pembelian_detail_grid->UseSelectLimit;
	if (!$selectLimit && $trx_pembelian_detail_grid->StartRec > 1)
		$trx_pembelian_detail_grid->Recordset->move($trx_pembelian_detail_grid->StartRec - 1);
} elseif (!$trx_pembelian_detail->AllowAddDeleteRow && $trx_pembelian_detail_grid->StopRec == 0) {
	$trx_pembelian_detail_grid->StopRec = $trx_pembelian_detail->GridAddRowCount;
}

// Initialize aggregate
$trx_pembelian_detail->RowType = ROWTYPE_AGGREGATEINIT;
$trx_pembelian_detail->resetAttributes();
$trx_pembelian_detail_grid->renderRow();
if ($trx_pembelian_detail->isGridAdd())
	$trx_pembelian_detail_grid->RowIndex = 0;
if ($trx_pembelian_detail->isGridEdit())
	$trx_pembelian_detail_grid->RowIndex = 0;
while ($trx_pembelian_detail_grid->RecCnt < $trx_pembelian_detail_grid->StopRec) {
	$trx_pembelian_detail_grid->RecCnt++;
	if ($trx_pembelian_detail_grid->RecCnt >= $trx_pembelian_detail_grid->StartRec) {
		$trx_pembelian_detail_grid->RowCnt++;
		if ($trx_pembelian_detail->isGridAdd() || $trx_pembelian_detail->isGridEdit() || $trx_pembelian_detail->isConfirm()) {
			$trx_pembelian_detail_grid->RowIndex++;
			$CurrentForm->Index = $trx_pembelian_detail_grid->RowIndex;
			if ($CurrentForm->hasValue($trx_pembelian_detail_grid->FormActionName) && $trx_pembelian_detail_grid->EventCancelled)
				$trx_pembelian_detail_grid->RowAction = strval($CurrentForm->getValue($trx_pembelian_detail_grid->FormActionName));
			elseif ($trx_pembelian_detail->isGridAdd())
				$trx_pembelian_detail_grid->RowAction = "insert";
			else
				$trx_pembelian_detail_grid->RowAction = "";
		}

		// Set up key count
		$trx_pembelian_detail_grid->KeyCount = $trx_pembelian_detail_grid->RowIndex;

		// Init row class and style
		$trx_pembelian_detail->resetAttributes();
		$trx_pembelian_detail->CssClass = "";
		if ($trx_pembelian_detail->isGridAdd()) {
			if ($trx_pembelian_detail->CurrentMode == "copy") {
				$trx_pembelian_detail_grid->loadRowValues($trx_pembelian_detail_grid->Recordset); // Load row values
				$trx_pembelian_detail_grid->setRecordKey($trx_pembelian_detail_grid->RowOldKey, $trx_pembelian_detail_grid->Recordset); // Set old record key
			} else {
				$trx_pembelian_detail_grid->loadRowValues(); // Load default values
				$trx_pembelian_detail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$trx_pembelian_detail_grid->loadRowValues($trx_pembelian_detail_grid->Recordset); // Load row values
		}
		$trx_pembelian_detail->RowType = ROWTYPE_VIEW; // Render view
		if ($trx_pembelian_detail->isGridAdd()) // Grid add
			$trx_pembelian_detail->RowType = ROWTYPE_ADD; // Render add
		if ($trx_pembelian_detail->isGridAdd() && $trx_pembelian_detail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$trx_pembelian_detail_grid->restoreCurrentRowFormValues($trx_pembelian_detail_grid->RowIndex); // Restore form values
		if ($trx_pembelian_detail->isGridEdit()) { // Grid edit
			if ($trx_pembelian_detail->EventCancelled)
				$trx_pembelian_detail_grid->restoreCurrentRowFormValues($trx_pembelian_detail_grid->RowIndex); // Restore form values
			if ($trx_pembelian_detail_grid->RowAction == "insert")
				$trx_pembelian_detail->RowType = ROWTYPE_ADD; // Render add
			else
				$trx_pembelian_detail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($trx_pembelian_detail->isGridEdit() && ($trx_pembelian_detail->RowType == ROWTYPE_EDIT || $trx_pembelian_detail->RowType == ROWTYPE_ADD) && $trx_pembelian_detail->EventCancelled) // Update failed
			$trx_pembelian_detail_grid->restoreCurrentRowFormValues($trx_pembelian_detail_grid->RowIndex); // Restore form values
		if ($trx_pembelian_detail->RowType == ROWTYPE_EDIT) // Edit row
			$trx_pembelian_detail_grid->EditRowCnt++;
		if ($trx_pembelian_detail->isConfirm()) // Confirm row
			$trx_pembelian_detail_grid->restoreCurrentRowFormValues($trx_pembelian_detail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$trx_pembelian_detail->RowAttrs = array_merge($trx_pembelian_detail->RowAttrs, array('data-rowindex'=>$trx_pembelian_detail_grid->RowCnt, 'id'=>'r' . $trx_pembelian_detail_grid->RowCnt . '_trx_pembelian_detail', 'data-rowtype'=>$trx_pembelian_detail->RowType));

		// Render row
		$trx_pembelian_detail_grid->renderRow();

		// Render list options
		$trx_pembelian_detail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($trx_pembelian_detail_grid->RowAction <> "delete" && $trx_pembelian_detail_grid->RowAction <> "insertdelete" && !($trx_pembelian_detail_grid->RowAction == "insert" && $trx_pembelian_detail->isConfirm() && $trx_pembelian_detail_grid->emptyRow())) {
?>
	<tr<?php echo $trx_pembelian_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trx_pembelian_detail_grid->ListOptions->render("body", "left", $trx_pembelian_detail_grid->RowCnt);
?>
	<?php if ($trx_pembelian_detail->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang"<?php echo $trx_pembelian_detail->nama_barang->cellAttributes() ?>>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_nama_barang" class="form-group trx_pembelian_detail_nama_barang">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->nama_barang->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" class="text-nowrap" style="z-index: <?php echo (9000 - $trx_pembelian_detail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo RemoveHtml($trx_pembelian_detail->nama_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" data-value-separator="<?php echo $trx_pembelian_detail->nama_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailgrid.createAutoSuggest({"id":"x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->nama_barang->Lookup->getParamTag("p_x" . $trx_pembelian_detail_grid->RowIndex . "_nama_barang") ?>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->OldValue) ?>">
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_nama_barang" class="form-group trx_pembelian_detail_nama_barang">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->nama_barang->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" class="text-nowrap" style="z-index: <?php echo (9000 - $trx_pembelian_detail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo RemoveHtml($trx_pembelian_detail->nama_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" data-value-separator="<?php echo $trx_pembelian_detail->nama_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailgrid.createAutoSuggest({"id":"x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->nama_barang->Lookup->getParamTag("p_x" . $trx_pembelian_detail_grid->RowIndex . "_nama_barang") ?>
</span>
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_nama_barang" class="trx_pembelian_detail_nama_barang">
<span<?php echo $trx_pembelian_detail->nama_barang->viewAttributes() ?>>
<?php echo $trx_pembelian_detail->nama_barang->getViewValue() ?></span>
</span>
<?php if (!$trx_pembelian_detail->isConfirm()) { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->FormValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="ftrx_pembelian_detailgrid$x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="ftrx_pembelian_detailgrid$x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->FormValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="ftrx_pembelian_detailgrid$o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="ftrx_pembelian_detailgrid$o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_no" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_no" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_no" value="<?php echo HtmlEncode($trx_pembelian_detail->no->CurrentValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_no" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_no" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_no" value="<?php echo HtmlEncode($trx_pembelian_detail->no->OldValue) ?>">
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_EDIT || $trx_pembelian_detail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_no" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_no" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_no" value="<?php echo HtmlEncode($trx_pembelian_detail->no->CurrentValue) ?>">
<?php } ?>
	<?php if ($trx_pembelian_detail->qty->Visible) { // qty ?>
		<td data-name="qty"<?php echo $trx_pembelian_detail->qty->cellAttributes() ?>>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_qty" class="form-group trx_pembelian_detail_qty">
<input type="text" data-table="trx_pembelian_detail" data-field="x_qty" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->qty->getPlaceHolder()) ?>" value="<?php echo $trx_pembelian_detail->qty->EditValue ?>"<?php echo $trx_pembelian_detail->qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->OldValue) ?>">
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_qty" class="form-group trx_pembelian_detail_qty">
<input type="text" data-table="trx_pembelian_detail" data-field="x_qty" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->qty->getPlaceHolder()) ?>" value="<?php echo $trx_pembelian_detail->qty->EditValue ?>"<?php echo $trx_pembelian_detail->qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_qty" class="trx_pembelian_detail_qty">
<span<?php echo $trx_pembelian_detail->qty->viewAttributes() ?>>
<?php echo $trx_pembelian_detail->qty->getViewValue() ?></span>
</span>
<?php if (!$trx_pembelian_detail->isConfirm()) { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->FormValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="ftrx_pembelian_detailgrid$x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="ftrx_pembelian_detailgrid$x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->FormValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="ftrx_pembelian_detailgrid$o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="ftrx_pembelian_detailgrid$o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trx_pembelian_detail->kd_satuan->Visible) { // kd_satuan ?>
		<td data-name="kd_satuan"<?php echo $trx_pembelian_detail->kd_satuan->cellAttributes() ?>>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_kd_satuan" class="form-group trx_pembelian_detail_kd_satuan">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" class="text-nowrap" style="z-index: <?php echo (9000 - $trx_pembelian_detail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo RemoveHtml($trx_pembelian_detail->kd_satuan->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->kd_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" data-value-separator="<?php echo $trx_pembelian_detail->kd_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailgrid.createAutoSuggest({"id":"x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->kd_satuan->Lookup->getParamTag("p_x" . $trx_pembelian_detail_grid->RowIndex . "_kd_satuan") ?>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->OldValue) ?>">
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_kd_satuan" class="form-group trx_pembelian_detail_kd_satuan">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" class="text-nowrap" style="z-index: <?php echo (9000 - $trx_pembelian_detail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo RemoveHtml($trx_pembelian_detail->kd_satuan->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->kd_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" data-value-separator="<?php echo $trx_pembelian_detail->kd_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailgrid.createAutoSuggest({"id":"x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->kd_satuan->Lookup->getParamTag("p_x" . $trx_pembelian_detail_grid->RowIndex . "_kd_satuan") ?>
</span>
<?php } ?>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trx_pembelian_detail_grid->RowCnt ?>_trx_pembelian_detail_kd_satuan" class="trx_pembelian_detail_kd_satuan">
<span<?php echo $trx_pembelian_detail->kd_satuan->viewAttributes() ?>>
<?php echo $trx_pembelian_detail->kd_satuan->getViewValue() ?></span>
</span>
<?php if (!$trx_pembelian_detail->isConfirm()) { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->FormValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="ftrx_pembelian_detailgrid$x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="ftrx_pembelian_detailgrid$x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->FormValue) ?>">
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="ftrx_pembelian_detailgrid$o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="ftrx_pembelian_detailgrid$o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trx_pembelian_detail_grid->ListOptions->render("body", "right", $trx_pembelian_detail_grid->RowCnt);
?>
	</tr>
<?php if ($trx_pembelian_detail->RowType == ROWTYPE_ADD || $trx_pembelian_detail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftrx_pembelian_detailgrid.updateLists(<?php echo $trx_pembelian_detail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$trx_pembelian_detail->isGridAdd() || $trx_pembelian_detail->CurrentMode == "copy")
		if (!$trx_pembelian_detail_grid->Recordset->EOF)
			$trx_pembelian_detail_grid->Recordset->moveNext();
}
?>
<?php
	if ($trx_pembelian_detail->CurrentMode == "add" || $trx_pembelian_detail->CurrentMode == "copy" || $trx_pembelian_detail->CurrentMode == "edit") {
		$trx_pembelian_detail_grid->RowIndex = '$rowindex$';
		$trx_pembelian_detail_grid->loadRowValues();

		// Set row properties
		$trx_pembelian_detail->resetAttributes();
		$trx_pembelian_detail->RowAttrs = array_merge($trx_pembelian_detail->RowAttrs, array('data-rowindex'=>$trx_pembelian_detail_grid->RowIndex, 'id'=>'r0_trx_pembelian_detail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($trx_pembelian_detail->RowAttrs["class"], "ew-template");
		$trx_pembelian_detail->RowType = ROWTYPE_ADD;

		// Render row
		$trx_pembelian_detail_grid->renderRow();

		// Render list options
		$trx_pembelian_detail_grid->renderListOptions();
		$trx_pembelian_detail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $trx_pembelian_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trx_pembelian_detail_grid->ListOptions->render("body", "left", $trx_pembelian_detail_grid->RowIndex);
?>
	<?php if ($trx_pembelian_detail->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang">
<?php if (!$trx_pembelian_detail->isConfirm()) { ?>
<span id="el$rowindex$_trx_pembelian_detail_nama_barang" class="form-group trx_pembelian_detail_nama_barang">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->nama_barang->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" class="text-nowrap" style="z-index: <?php echo (9000 - $trx_pembelian_detail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo RemoveHtml($trx_pembelian_detail->nama_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" data-value-separator="<?php echo $trx_pembelian_detail->nama_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailgrid.createAutoSuggest({"id":"x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->nama_barang->Lookup->getParamTag("p_x" . $trx_pembelian_detail_grid->RowIndex . "_nama_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_trx_pembelian_detail_nama_barang" class="form-group trx_pembelian_detail_nama_barang">
<span<?php echo $trx_pembelian_detail->nama_barang->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trx_pembelian_detail->nama_barang->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_nama_barang" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($trx_pembelian_detail->nama_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trx_pembelian_detail->qty->Visible) { // qty ?>
		<td data-name="qty">
<?php if (!$trx_pembelian_detail->isConfirm()) { ?>
<span id="el$rowindex$_trx_pembelian_detail_qty" class="form-group trx_pembelian_detail_qty">
<input type="text" data-table="trx_pembelian_detail" data-field="x_qty" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->qty->getPlaceHolder()) ?>" value="<?php echo $trx_pembelian_detail->qty->EditValue ?>"<?php echo $trx_pembelian_detail->qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trx_pembelian_detail_qty" class="form-group trx_pembelian_detail_qty">
<span<?php echo $trx_pembelian_detail->qty->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trx_pembelian_detail->qty->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_qty" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($trx_pembelian_detail->qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trx_pembelian_detail->kd_satuan->Visible) { // kd_satuan ?>
		<td data-name="kd_satuan">
<?php if (!$trx_pembelian_detail->isConfirm()) { ?>
<span id="el$rowindex$_trx_pembelian_detail_kd_satuan" class="form-group trx_pembelian_detail_kd_satuan">
<?php
$wrkonchange = "" . trim(@$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trx_pembelian_detail->kd_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" class="text-nowrap" style="z-index: <?php echo (9000 - $trx_pembelian_detail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="sv_x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo RemoveHtml($trx_pembelian_detail->kd_satuan->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->getPlaceHolder()) ?>"<?php echo $trx_pembelian_detail->kd_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" data-value-separator="<?php echo $trx_pembelian_detail->kd_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrx_pembelian_detailgrid.createAutoSuggest({"id":"x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan","forceSelect":false});
</script>
<?php echo $trx_pembelian_detail->kd_satuan->Lookup->getParamTag("p_x" . $trx_pembelian_detail_grid->RowIndex . "_kd_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_trx_pembelian_detail_kd_satuan" class="form-group trx_pembelian_detail_kd_satuan">
<span<?php echo $trx_pembelian_detail->kd_satuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trx_pembelian_detail->kd_satuan->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="x<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trx_pembelian_detail" data-field="x_kd_satuan" name="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" id="o<?php echo $trx_pembelian_detail_grid->RowIndex ?>_kd_satuan" value="<?php echo HtmlEncode($trx_pembelian_detail->kd_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trx_pembelian_detail_grid->ListOptions->render("body", "right", $trx_pembelian_detail_grid->RowIndex);
?>
<script>
ftrx_pembelian_detailgrid.updateLists(<?php echo $trx_pembelian_detail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($trx_pembelian_detail->CurrentMode == "add" || $trx_pembelian_detail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $trx_pembelian_detail_grid->FormKeyCountName ?>" id="<?php echo $trx_pembelian_detail_grid->FormKeyCountName ?>" value="<?php echo $trx_pembelian_detail_grid->KeyCount ?>">
<?php echo $trx_pembelian_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($trx_pembelian_detail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $trx_pembelian_detail_grid->FormKeyCountName ?>" id="<?php echo $trx_pembelian_detail_grid->FormKeyCountName ?>" value="<?php echo $trx_pembelian_detail_grid->KeyCount ?>">
<?php echo $trx_pembelian_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($trx_pembelian_detail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftrx_pembelian_detailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($trx_pembelian_detail_grid->Recordset)
	$trx_pembelian_detail_grid->Recordset->Close();
?>
</div>
<?php if ($trx_pembelian_detail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $trx_pembelian_detail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trx_pembelian_detail_grid->TotalRecs == 0 && !$trx_pembelian_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $trx_pembelian_detail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trx_pembelian_detail_grid->terminate();
?>