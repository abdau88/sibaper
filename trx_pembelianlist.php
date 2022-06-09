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
$trx_pembelian_list = new trx_pembelian_list();

// Run the page
$trx_pembelian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_pembelian_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trx_pembelian->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftrx_pembelianlist = currentForm = new ew.Form("ftrx_pembelianlist", "list");
ftrx_pembelianlist.formKeyCountName = '<?php echo $trx_pembelian_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftrx_pembelianlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_pembelianlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_pembelianlist.lists["x_kd_vendor"] = <?php echo $trx_pembelian_list->kd_vendor->Lookup->toClientList() ?>;
ftrx_pembelianlist.lists["x_kd_vendor"].options = <?php echo JsonEncode($trx_pembelian_list->kd_vendor->lookupOptions()) ?>;
ftrx_pembelianlist.autoSuggests["x_kd_vendor"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trx_pembelian->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($trx_pembelian_list->TotalRecs > 0 && $trx_pembelian_list->ExportOptions->visible()) { ?>
<?php $trx_pembelian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($trx_pembelian_list->ImportOptions->visible()) { ?>
<?php $trx_pembelian_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$trx_pembelian_list->renderOtherOptions();
?>
<?php $trx_pembelian_list->showPageHeader(); ?>
<?php
$trx_pembelian_list->showMessage();
?>
<?php if ($trx_pembelian_list->TotalRecs > 0 || $trx_pembelian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trx_pembelian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trx_pembelian">
<form name="ftrx_pembelianlist" id="ftrx_pembelianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_pembelian_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_pembelian_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_pembelian">
<div id="gmp_trx_pembelian" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($trx_pembelian_list->TotalRecs > 0 || $trx_pembelian->isGridEdit()) { ?>
<table id="tbl_trx_pembelianlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trx_pembelian_list->RowType = ROWTYPE_HEADER;

// Render list options
$trx_pembelian_list->renderListOptions();

// Render list options (header, left)
$trx_pembelian_list->ListOptions->render("header", "left");
?>
<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
	<?php if ($trx_pembelian->sortUrl($trx_pembelian->tgl_pembelian) == "") { ?>
		<th data-name="tgl_pembelian" class="<?php echo $trx_pembelian->tgl_pembelian->headerCellClass() ?>"><div id="elh_trx_pembelian_tgl_pembelian" class="trx_pembelian_tgl_pembelian"><div class="ew-table-header-caption"><?php echo $trx_pembelian->tgl_pembelian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_pembelian" class="<?php echo $trx_pembelian->tgl_pembelian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_pembelian->SortUrl($trx_pembelian->tgl_pembelian) ?>',1);"><div id="elh_trx_pembelian_tgl_pembelian" class="trx_pembelian_tgl_pembelian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_pembelian->tgl_pembelian->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_pembelian->tgl_pembelian->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_pembelian->tgl_pembelian->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
	<?php if ($trx_pembelian->sortUrl($trx_pembelian->kd_vendor) == "") { ?>
		<th data-name="kd_vendor" class="<?php echo $trx_pembelian->kd_vendor->headerCellClass() ?>"><div id="elh_trx_pembelian_kd_vendor" class="trx_pembelian_kd_vendor"><div class="ew-table-header-caption"><?php echo $trx_pembelian->kd_vendor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_vendor" class="<?php echo $trx_pembelian->kd_vendor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_pembelian->SortUrl($trx_pembelian->kd_vendor) ?>',1);"><div id="elh_trx_pembelian_kd_vendor" class="trx_pembelian_kd_vendor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_pembelian->kd_vendor->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_pembelian->kd_vendor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_pembelian->kd_vendor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trx_pembelian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($trx_pembelian->ExportAll && $trx_pembelian->isExport()) {
	$trx_pembelian_list->StopRec = $trx_pembelian_list->TotalRecs;
} else {

	// Set the last record to display
	if ($trx_pembelian_list->TotalRecs > $trx_pembelian_list->StartRec + $trx_pembelian_list->DisplayRecs - 1)
		$trx_pembelian_list->StopRec = $trx_pembelian_list->StartRec + $trx_pembelian_list->DisplayRecs - 1;
	else
		$trx_pembelian_list->StopRec = $trx_pembelian_list->TotalRecs;
}
$trx_pembelian_list->RecCnt = $trx_pembelian_list->StartRec - 1;
if ($trx_pembelian_list->Recordset && !$trx_pembelian_list->Recordset->EOF) {
	$trx_pembelian_list->Recordset->moveFirst();
	$selectLimit = $trx_pembelian_list->UseSelectLimit;
	if (!$selectLimit && $trx_pembelian_list->StartRec > 1)
		$trx_pembelian_list->Recordset->move($trx_pembelian_list->StartRec - 1);
} elseif (!$trx_pembelian->AllowAddDeleteRow && $trx_pembelian_list->StopRec == 0) {
	$trx_pembelian_list->StopRec = $trx_pembelian->GridAddRowCount;
}

// Initialize aggregate
$trx_pembelian->RowType = ROWTYPE_AGGREGATEINIT;
$trx_pembelian->resetAttributes();
$trx_pembelian_list->renderRow();
while ($trx_pembelian_list->RecCnt < $trx_pembelian_list->StopRec) {
	$trx_pembelian_list->RecCnt++;
	if ($trx_pembelian_list->RecCnt >= $trx_pembelian_list->StartRec) {
		$trx_pembelian_list->RowCnt++;

		// Set up key count
		$trx_pembelian_list->KeyCount = $trx_pembelian_list->RowIndex;

		// Init row class and style
		$trx_pembelian->resetAttributes();
		$trx_pembelian->CssClass = "";
		if ($trx_pembelian->isGridAdd()) {
		} else {
			$trx_pembelian_list->loadRowValues($trx_pembelian_list->Recordset); // Load row values
		}
		$trx_pembelian->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$trx_pembelian->RowAttrs = array_merge($trx_pembelian->RowAttrs, array('data-rowindex'=>$trx_pembelian_list->RowCnt, 'id'=>'r' . $trx_pembelian_list->RowCnt . '_trx_pembelian', 'data-rowtype'=>$trx_pembelian->RowType));

		// Render row
		$trx_pembelian_list->renderRow();

		// Render list options
		$trx_pembelian_list->renderListOptions();
?>
	<tr<?php echo $trx_pembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trx_pembelian_list->ListOptions->render("body", "left", $trx_pembelian_list->RowCnt);
?>
	<?php if ($trx_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<td data-name="tgl_pembelian"<?php echo $trx_pembelian->tgl_pembelian->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_list->RowCnt ?>_trx_pembelian_tgl_pembelian" class="trx_pembelian_tgl_pembelian">
<span<?php echo $trx_pembelian->tgl_pembelian->viewAttributes() ?>>
<?php echo $trx_pembelian->tgl_pembelian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trx_pembelian->kd_vendor->Visible) { // kd_vendor ?>
		<td data-name="kd_vendor"<?php echo $trx_pembelian->kd_vendor->cellAttributes() ?>>
<span id="el<?php echo $trx_pembelian_list->RowCnt ?>_trx_pembelian_kd_vendor" class="trx_pembelian_kd_vendor">
<span<?php echo $trx_pembelian->kd_vendor->viewAttributes() ?>>
<?php echo $trx_pembelian->kd_vendor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trx_pembelian_list->ListOptions->render("body", "right", $trx_pembelian_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$trx_pembelian->isGridAdd())
		$trx_pembelian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$trx_pembelian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($trx_pembelian_list->Recordset)
	$trx_pembelian_list->Recordset->Close();
?>
<?php if (!$trx_pembelian->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$trx_pembelian->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trx_pembelian_list->Pager)) $trx_pembelian_list->Pager = new PrevNextPager($trx_pembelian_list->StartRec, $trx_pembelian_list->DisplayRecs, $trx_pembelian_list->TotalRecs, $trx_pembelian_list->AutoHidePager) ?>
<?php if ($trx_pembelian_list->Pager->RecordCount > 0 && $trx_pembelian_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trx_pembelian_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trx_pembelian_list->pageUrl() ?>start=<?php echo $trx_pembelian_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trx_pembelian_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trx_pembelian_list->pageUrl() ?>start=<?php echo $trx_pembelian_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trx_pembelian_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trx_pembelian_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trx_pembelian_list->pageUrl() ?>start=<?php echo $trx_pembelian_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trx_pembelian_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trx_pembelian_list->pageUrl() ?>start=<?php echo $trx_pembelian_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trx_pembelian_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($trx_pembelian_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trx_pembelian_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trx_pembelian_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trx_pembelian_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $trx_pembelian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trx_pembelian_list->TotalRecs == 0 && !$trx_pembelian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $trx_pembelian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trx_pembelian_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trx_pembelian->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trx_pembelian_list->terminate();
?>