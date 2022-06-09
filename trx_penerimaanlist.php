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
$trx_penerimaan_list = new trx_penerimaan_list();

// Run the page
$trx_penerimaan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftrx_penerimaanlist = currentForm = new ew.Form("ftrx_penerimaanlist", "list");
ftrx_penerimaanlist.formKeyCountName = '<?php echo $trx_penerimaan_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftrx_penerimaanlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaanlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaanlist.lists["x_kd_penerima"] = <?php echo $trx_penerimaan_list->kd_penerima->Lookup->toClientList() ?>;
ftrx_penerimaanlist.lists["x_kd_penerima"].options = <?php echo JsonEncode($trx_penerimaan_list->kd_penerima->lookupOptions()) ?>;
ftrx_penerimaanlist.autoSuggests["x_kd_penerima"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftrx_penerimaanlist.lists["x_kd_unit"] = <?php echo $trx_penerimaan_list->kd_unit->Lookup->toClientList() ?>;
ftrx_penerimaanlist.lists["x_kd_unit"].options = <?php echo JsonEncode($trx_penerimaan_list->kd_unit->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($trx_penerimaan_list->TotalRecs > 0 && $trx_penerimaan_list->ExportOptions->visible()) { ?>
<?php $trx_penerimaan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($trx_penerimaan_list->ImportOptions->visible()) { ?>
<?php $trx_penerimaan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$trx_penerimaan_list->renderOtherOptions();
?>
<?php $trx_penerimaan_list->showPageHeader(); ?>
<?php
$trx_penerimaan_list->showMessage();
?>
<?php if ($trx_penerimaan_list->TotalRecs > 0 || $trx_penerimaan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trx_penerimaan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trx_penerimaan">
<form name="ftrx_penerimaanlist" id="ftrx_penerimaanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan">
<div id="gmp_trx_penerimaan" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($trx_penerimaan_list->TotalRecs > 0 || $trx_penerimaan->isGridEdit()) { ?>
<table id="tbl_trx_penerimaanlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trx_penerimaan_list->RowType = ROWTYPE_HEADER;

// Render list options
$trx_penerimaan_list->renderListOptions();

// Render list options (header, left)
$trx_penerimaan_list->ListOptions->render("header", "left");
?>
<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
	<?php if ($trx_penerimaan->sortUrl($trx_penerimaan->kd_penerimaan) == "") { ?>
		<th data-name="kd_penerimaan" class="<?php echo $trx_penerimaan->kd_penerimaan->headerCellClass() ?>"><div id="elh_trx_penerimaan_kd_penerimaan" class="trx_penerimaan_kd_penerimaan"><div class="ew-table-header-caption"><?php echo $trx_penerimaan->kd_penerimaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_penerimaan" class="<?php echo $trx_penerimaan->kd_penerimaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan->SortUrl($trx_penerimaan->kd_penerimaan) ?>',1);"><div id="elh_trx_penerimaan_kd_penerimaan" class="trx_penerimaan_kd_penerimaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan->kd_penerimaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan->kd_penerimaan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan->kd_penerimaan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
	<?php if ($trx_penerimaan->sortUrl($trx_penerimaan->tgl_penerimaan) == "") { ?>
		<th data-name="tgl_penerimaan" class="<?php echo $trx_penerimaan->tgl_penerimaan->headerCellClass() ?>"><div id="elh_trx_penerimaan_tgl_penerimaan" class="trx_penerimaan_tgl_penerimaan"><div class="ew-table-header-caption"><?php echo $trx_penerimaan->tgl_penerimaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_penerimaan" class="<?php echo $trx_penerimaan->tgl_penerimaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan->SortUrl($trx_penerimaan->tgl_penerimaan) ?>',1);"><div id="elh_trx_penerimaan_tgl_penerimaan" class="trx_penerimaan_tgl_penerimaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan->tgl_penerimaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan->tgl_penerimaan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan->tgl_penerimaan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
	<?php if ($trx_penerimaan->sortUrl($trx_penerimaan->kd_penerima) == "") { ?>
		<th data-name="kd_penerima" class="<?php echo $trx_penerimaan->kd_penerima->headerCellClass() ?>"><div id="elh_trx_penerimaan_kd_penerima" class="trx_penerimaan_kd_penerima"><div class="ew-table-header-caption"><?php echo $trx_penerimaan->kd_penerima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_penerima" class="<?php echo $trx_penerimaan->kd_penerima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan->SortUrl($trx_penerimaan->kd_penerima) ?>',1);"><div id="elh_trx_penerimaan_kd_penerima" class="trx_penerimaan_kd_penerima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan->kd_penerima->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan->kd_penerima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan->kd_penerima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
	<?php if ($trx_penerimaan->sortUrl($trx_penerimaan->kd_unit) == "") { ?>
		<th data-name="kd_unit" class="<?php echo $trx_penerimaan->kd_unit->headerCellClass() ?>"><div id="elh_trx_penerimaan_kd_unit" class="trx_penerimaan_kd_unit"><div class="ew-table-header-caption"><?php echo $trx_penerimaan->kd_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_unit" class="<?php echo $trx_penerimaan->kd_unit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan->SortUrl($trx_penerimaan->kd_unit) ?>',1);"><div id="elh_trx_penerimaan_kd_unit" class="trx_penerimaan_kd_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan->kd_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan->kd_unit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan->kd_unit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trx_penerimaan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($trx_penerimaan->ExportAll && $trx_penerimaan->isExport()) {
	$trx_penerimaan_list->StopRec = $trx_penerimaan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($trx_penerimaan_list->TotalRecs > $trx_penerimaan_list->StartRec + $trx_penerimaan_list->DisplayRecs - 1)
		$trx_penerimaan_list->StopRec = $trx_penerimaan_list->StartRec + $trx_penerimaan_list->DisplayRecs - 1;
	else
		$trx_penerimaan_list->StopRec = $trx_penerimaan_list->TotalRecs;
}
$trx_penerimaan_list->RecCnt = $trx_penerimaan_list->StartRec - 1;
if ($trx_penerimaan_list->Recordset && !$trx_penerimaan_list->Recordset->EOF) {
	$trx_penerimaan_list->Recordset->moveFirst();
	$selectLimit = $trx_penerimaan_list->UseSelectLimit;
	if (!$selectLimit && $trx_penerimaan_list->StartRec > 1)
		$trx_penerimaan_list->Recordset->move($trx_penerimaan_list->StartRec - 1);
} elseif (!$trx_penerimaan->AllowAddDeleteRow && $trx_penerimaan_list->StopRec == 0) {
	$trx_penerimaan_list->StopRec = $trx_penerimaan->GridAddRowCount;
}

// Initialize aggregate
$trx_penerimaan->RowType = ROWTYPE_AGGREGATEINIT;
$trx_penerimaan->resetAttributes();
$trx_penerimaan_list->renderRow();
while ($trx_penerimaan_list->RecCnt < $trx_penerimaan_list->StopRec) {
	$trx_penerimaan_list->RecCnt++;
	if ($trx_penerimaan_list->RecCnt >= $trx_penerimaan_list->StartRec) {
		$trx_penerimaan_list->RowCnt++;

		// Set up key count
		$trx_penerimaan_list->KeyCount = $trx_penerimaan_list->RowIndex;

		// Init row class and style
		$trx_penerimaan->resetAttributes();
		$trx_penerimaan->CssClass = "";
		if ($trx_penerimaan->isGridAdd()) {
		} else {
			$trx_penerimaan_list->loadRowValues($trx_penerimaan_list->Recordset); // Load row values
		}
		$trx_penerimaan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$trx_penerimaan->RowAttrs = array_merge($trx_penerimaan->RowAttrs, array('data-rowindex'=>$trx_penerimaan_list->RowCnt, 'id'=>'r' . $trx_penerimaan_list->RowCnt . '_trx_penerimaan', 'data-rowtype'=>$trx_penerimaan->RowType));

		// Render row
		$trx_penerimaan_list->renderRow();

		// Render list options
		$trx_penerimaan_list->renderListOptions();
?>
	<tr<?php echo $trx_penerimaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trx_penerimaan_list->ListOptions->render("body", "left", $trx_penerimaan_list->RowCnt);
?>
	<?php if ($trx_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
		<td data-name="kd_penerimaan"<?php echo $trx_penerimaan->kd_penerimaan->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_list->RowCnt ?>_trx_penerimaan_kd_penerimaan" class="trx_penerimaan_kd_penerimaan">
<span<?php echo $trx_penerimaan->kd_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerimaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trx_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
		<td data-name="tgl_penerimaan"<?php echo $trx_penerimaan->tgl_penerimaan->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_list->RowCnt ?>_trx_penerimaan_tgl_penerimaan" class="trx_penerimaan_tgl_penerimaan">
<span<?php echo $trx_penerimaan->tgl_penerimaan->viewAttributes() ?>>
<?php echo $trx_penerimaan->tgl_penerimaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trx_penerimaan->kd_penerima->Visible) { // kd_penerima ?>
		<td data-name="kd_penerima"<?php echo $trx_penerimaan->kd_penerima->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_list->RowCnt ?>_trx_penerimaan_kd_penerima" class="trx_penerimaan_kd_penerima">
<span<?php echo $trx_penerimaan->kd_penerima->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_penerima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trx_penerimaan->kd_unit->Visible) { // kd_unit ?>
		<td data-name="kd_unit"<?php echo $trx_penerimaan->kd_unit->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_list->RowCnt ?>_trx_penerimaan_kd_unit" class="trx_penerimaan_kd_unit">
<span<?php echo $trx_penerimaan->kd_unit->viewAttributes() ?>>
<?php echo $trx_penerimaan->kd_unit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trx_penerimaan_list->ListOptions->render("body", "right", $trx_penerimaan_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$trx_penerimaan->isGridAdd())
		$trx_penerimaan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$trx_penerimaan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($trx_penerimaan_list->Recordset)
	$trx_penerimaan_list->Recordset->Close();
?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$trx_penerimaan->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trx_penerimaan_list->Pager)) $trx_penerimaan_list->Pager = new PrevNextPager($trx_penerimaan_list->StartRec, $trx_penerimaan_list->DisplayRecs, $trx_penerimaan_list->TotalRecs, $trx_penerimaan_list->AutoHidePager) ?>
<?php if ($trx_penerimaan_list->Pager->RecordCount > 0 && $trx_penerimaan_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trx_penerimaan_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trx_penerimaan_list->pageUrl() ?>start=<?php echo $trx_penerimaan_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trx_penerimaan_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trx_penerimaan_list->pageUrl() ?>start=<?php echo $trx_penerimaan_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trx_penerimaan_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trx_penerimaan_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trx_penerimaan_list->pageUrl() ?>start=<?php echo $trx_penerimaan_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trx_penerimaan_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trx_penerimaan_list->pageUrl() ?>start=<?php echo $trx_penerimaan_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trx_penerimaan_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($trx_penerimaan_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trx_penerimaan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trx_penerimaan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trx_penerimaan_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $trx_penerimaan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trx_penerimaan_list->TotalRecs == 0 && !$trx_penerimaan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $trx_penerimaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trx_penerimaan_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trx_penerimaan->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_list->terminate();
?>