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
$trx_penerimaan_detail_list = new trx_penerimaan_detail_list();

// Run the page
$trx_penerimaan_detail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trx_penerimaan_detail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftrx_penerimaan_detaillist = currentForm = new ew.Form("ftrx_penerimaan_detaillist", "list");
ftrx_penerimaan_detaillist.formKeyCountName = '<?php echo $trx_penerimaan_detail_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftrx_penerimaan_detaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrx_penerimaan_detaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrx_penerimaan_detaillist.lists["x_nama_barang"] = <?php echo $trx_penerimaan_detail_list->nama_barang->Lookup->toClientList() ?>;
ftrx_penerimaan_detaillist.lists["x_nama_barang"].options = <?php echo JsonEncode($trx_penerimaan_detail_list->nama_barang->lookupOptions()) ?>;
ftrx_penerimaan_detaillist.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftrx_penerimaan_detaillistsrch = currentSearchForm = new ew.Form("ftrx_penerimaan_detaillistsrch");

// Filters
ftrx_penerimaan_detaillistsrch.filterList = <?php echo $trx_penerimaan_detail_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($trx_penerimaan_detail_list->TotalRecs > 0 && $trx_penerimaan_detail_list->ExportOptions->visible()) { ?>
<?php $trx_penerimaan_detail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($trx_penerimaan_detail_list->ImportOptions->visible()) { ?>
<?php $trx_penerimaan_detail_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($trx_penerimaan_detail_list->SearchOptions->visible()) { ?>
<?php $trx_penerimaan_detail_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($trx_penerimaan_detail_list->FilterOptions->visible()) { ?>
<?php $trx_penerimaan_detail_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$trx_penerimaan_detail->isExport() || EXPORT_MASTER_RECORD && $trx_penerimaan_detail->isExport("print")) { ?>
<?php
if ($trx_penerimaan_detail_list->DbMasterFilter <> "" && $trx_penerimaan_detail->getCurrentMasterTable() == "trx_penerimaan") {
	if ($trx_penerimaan_detail_list->MasterRecordExists) {
		include_once "trx_penerimaanmaster.php";
	}
}
?>
<?php } ?>
<?php
$trx_penerimaan_detail_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$trx_penerimaan_detail->isExport() && !$trx_penerimaan_detail->CurrentAction) { ?>
<form name="ftrx_penerimaan_detaillistsrch" id="ftrx_penerimaan_detaillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($trx_penerimaan_detail_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftrx_penerimaan_detaillistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="trx_penerimaan_detail">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($trx_penerimaan_detail_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($trx_penerimaan_detail_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $trx_penerimaan_detail_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($trx_penerimaan_detail_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($trx_penerimaan_detail_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($trx_penerimaan_detail_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($trx_penerimaan_detail_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $trx_penerimaan_detail_list->showPageHeader(); ?>
<?php
$trx_penerimaan_detail_list->showMessage();
?>
<?php if ($trx_penerimaan_detail_list->TotalRecs > 0 || $trx_penerimaan_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trx_penerimaan_detail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trx_penerimaan_detail">
<form name="ftrx_penerimaan_detaillist" id="ftrx_penerimaan_detaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trx_penerimaan_detail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trx_penerimaan_detail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trx_penerimaan_detail">
<?php if ($trx_penerimaan_detail->getCurrentMasterTable() == "trx_penerimaan" && $trx_penerimaan_detail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="trx_penerimaan">
<input type="hidden" name="fk_kd_penerimaan" value="<?php echo $trx_penerimaan_detail->kd_penerimaan->getSessionValue() ?>">
<?php } ?>
<div id="gmp_trx_penerimaan_detail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($trx_penerimaan_detail_list->TotalRecs > 0 || $trx_penerimaan_detail->isGridEdit()) { ?>
<table id="tbl_trx_penerimaan_detaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trx_penerimaan_detail_list->RowType = ROWTYPE_HEADER;

// Render list options
$trx_penerimaan_detail_list->renderListOptions();

// Render list options (header, left)
$trx_penerimaan_detail_list->ListOptions->render("header", "left");
?>
<?php if ($trx_penerimaan_detail->nama_barang->Visible) { // nama_barang ?>
	<?php if ($trx_penerimaan_detail->sortUrl($trx_penerimaan_detail->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $trx_penerimaan_detail->nama_barang->headerCellClass() ?>"><div id="elh_trx_penerimaan_detail_nama_barang" class="trx_penerimaan_detail_nama_barang"><div class="ew-table-header-caption"><?php echo $trx_penerimaan_detail->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $trx_penerimaan_detail->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan_detail->SortUrl($trx_penerimaan_detail->nama_barang) ?>',1);"><div id="elh_trx_penerimaan_detail_nama_barang" class="trx_penerimaan_detail_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan_detail->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan_detail->nama_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan_detail->nama_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_penerimaan_detail->qty->Visible) { // qty ?>
	<?php if ($trx_penerimaan_detail->sortUrl($trx_penerimaan_detail->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $trx_penerimaan_detail->qty->headerCellClass() ?>"><div id="elh_trx_penerimaan_detail_qty" class="trx_penerimaan_detail_qty"><div class="ew-table-header-caption"><?php echo $trx_penerimaan_detail->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $trx_penerimaan_detail->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan_detail->SortUrl($trx_penerimaan_detail->qty) ?>',1);"><div id="elh_trx_penerimaan_detail_qty" class="trx_penerimaan_detail_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan_detail->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan_detail->qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan_detail->qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trx_penerimaan_detail->paraf->Visible) { // paraf ?>
	<?php if ($trx_penerimaan_detail->sortUrl($trx_penerimaan_detail->paraf) == "") { ?>
		<th data-name="paraf" class="<?php echo $trx_penerimaan_detail->paraf->headerCellClass() ?>"><div id="elh_trx_penerimaan_detail_paraf" class="trx_penerimaan_detail_paraf"><div class="ew-table-header-caption"><?php echo $trx_penerimaan_detail->paraf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="paraf" class="<?php echo $trx_penerimaan_detail->paraf->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $trx_penerimaan_detail->SortUrl($trx_penerimaan_detail->paraf) ?>',1);"><div id="elh_trx_penerimaan_detail_paraf" class="trx_penerimaan_detail_paraf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trx_penerimaan_detail->paraf->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($trx_penerimaan_detail->paraf->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trx_penerimaan_detail->paraf->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trx_penerimaan_detail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($trx_penerimaan_detail->ExportAll && $trx_penerimaan_detail->isExport()) {
	$trx_penerimaan_detail_list->StopRec = $trx_penerimaan_detail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($trx_penerimaan_detail_list->TotalRecs > $trx_penerimaan_detail_list->StartRec + $trx_penerimaan_detail_list->DisplayRecs - 1)
		$trx_penerimaan_detail_list->StopRec = $trx_penerimaan_detail_list->StartRec + $trx_penerimaan_detail_list->DisplayRecs - 1;
	else
		$trx_penerimaan_detail_list->StopRec = $trx_penerimaan_detail_list->TotalRecs;
}
$trx_penerimaan_detail_list->RecCnt = $trx_penerimaan_detail_list->StartRec - 1;
if ($trx_penerimaan_detail_list->Recordset && !$trx_penerimaan_detail_list->Recordset->EOF) {
	$trx_penerimaan_detail_list->Recordset->moveFirst();
	$selectLimit = $trx_penerimaan_detail_list->UseSelectLimit;
	if (!$selectLimit && $trx_penerimaan_detail_list->StartRec > 1)
		$trx_penerimaan_detail_list->Recordset->move($trx_penerimaan_detail_list->StartRec - 1);
} elseif (!$trx_penerimaan_detail->AllowAddDeleteRow && $trx_penerimaan_detail_list->StopRec == 0) {
	$trx_penerimaan_detail_list->StopRec = $trx_penerimaan_detail->GridAddRowCount;
}

// Initialize aggregate
$trx_penerimaan_detail->RowType = ROWTYPE_AGGREGATEINIT;
$trx_penerimaan_detail->resetAttributes();
$trx_penerimaan_detail_list->renderRow();
while ($trx_penerimaan_detail_list->RecCnt < $trx_penerimaan_detail_list->StopRec) {
	$trx_penerimaan_detail_list->RecCnt++;
	if ($trx_penerimaan_detail_list->RecCnt >= $trx_penerimaan_detail_list->StartRec) {
		$trx_penerimaan_detail_list->RowCnt++;

		// Set up key count
		$trx_penerimaan_detail_list->KeyCount = $trx_penerimaan_detail_list->RowIndex;

		// Init row class and style
		$trx_penerimaan_detail->resetAttributes();
		$trx_penerimaan_detail->CssClass = "";
		if ($trx_penerimaan_detail->isGridAdd()) {
		} else {
			$trx_penerimaan_detail_list->loadRowValues($trx_penerimaan_detail_list->Recordset); // Load row values
		}
		$trx_penerimaan_detail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$trx_penerimaan_detail->RowAttrs = array_merge($trx_penerimaan_detail->RowAttrs, array('data-rowindex'=>$trx_penerimaan_detail_list->RowCnt, 'id'=>'r' . $trx_penerimaan_detail_list->RowCnt . '_trx_penerimaan_detail', 'data-rowtype'=>$trx_penerimaan_detail->RowType));

		// Render row
		$trx_penerimaan_detail_list->renderRow();

		// Render list options
		$trx_penerimaan_detail_list->renderListOptions();
?>
	<tr<?php echo $trx_penerimaan_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trx_penerimaan_detail_list->ListOptions->render("body", "left", $trx_penerimaan_detail_list->RowCnt);
?>
	<?php if ($trx_penerimaan_detail->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang"<?php echo $trx_penerimaan_detail->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_detail_list->RowCnt ?>_trx_penerimaan_detail_nama_barang" class="trx_penerimaan_detail_nama_barang">
<span<?php echo $trx_penerimaan_detail->nama_barang->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trx_penerimaan_detail->qty->Visible) { // qty ?>
		<td data-name="qty"<?php echo $trx_penerimaan_detail->qty->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_detail_list->RowCnt ?>_trx_penerimaan_detail_qty" class="trx_penerimaan_detail_qty">
<span<?php echo $trx_penerimaan_detail->qty->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($trx_penerimaan_detail->paraf->Visible) { // paraf ?>
		<td data-name="paraf"<?php echo $trx_penerimaan_detail->paraf->cellAttributes() ?>>
<span id="el<?php echo $trx_penerimaan_detail_list->RowCnt ?>_trx_penerimaan_detail_paraf" class="trx_penerimaan_detail_paraf">
<span<?php echo $trx_penerimaan_detail->paraf->viewAttributes() ?>>
<?php echo $trx_penerimaan_detail->paraf->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trx_penerimaan_detail_list->ListOptions->render("body", "right", $trx_penerimaan_detail_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$trx_penerimaan_detail->isGridAdd())
		$trx_penerimaan_detail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$trx_penerimaan_detail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($trx_penerimaan_detail_list->Recordset)
	$trx_penerimaan_detail_list->Recordset->Close();
?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$trx_penerimaan_detail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trx_penerimaan_detail_list->Pager)) $trx_penerimaan_detail_list->Pager = new PrevNextPager($trx_penerimaan_detail_list->StartRec, $trx_penerimaan_detail_list->DisplayRecs, $trx_penerimaan_detail_list->TotalRecs, $trx_penerimaan_detail_list->AutoHidePager) ?>
<?php if ($trx_penerimaan_detail_list->Pager->RecordCount > 0 && $trx_penerimaan_detail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($trx_penerimaan_detail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $trx_penerimaan_detail_list->pageUrl() ?>start=<?php echo $trx_penerimaan_detail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($trx_penerimaan_detail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $trx_penerimaan_detail_list->pageUrl() ?>start=<?php echo $trx_penerimaan_detail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $trx_penerimaan_detail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($trx_penerimaan_detail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $trx_penerimaan_detail_list->pageUrl() ?>start=<?php echo $trx_penerimaan_detail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($trx_penerimaan_detail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $trx_penerimaan_detail_list->pageUrl() ?>start=<?php echo $trx_penerimaan_detail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trx_penerimaan_detail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($trx_penerimaan_detail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trx_penerimaan_detail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trx_penerimaan_detail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trx_penerimaan_detail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $trx_penerimaan_detail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trx_penerimaan_detail_list->TotalRecs == 0 && !$trx_penerimaan_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $trx_penerimaan_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trx_penerimaan_detail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trx_penerimaan_detail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trx_penerimaan_detail_list->terminate();
?>