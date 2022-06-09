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
$tb_penerima_list = new tb_penerima_list();

// Run the page
$tb_penerima_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_penerima_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_penerima->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftb_penerimalist = currentForm = new ew.Form("ftb_penerimalist", "list");
ftb_penerimalist.formKeyCountName = '<?php echo $tb_penerima_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftb_penerimalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_penerimalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftb_penerimalistsrch = currentSearchForm = new ew.Form("ftb_penerimalistsrch");

// Filters
ftb_penerimalistsrch.filterList = <?php echo $tb_penerima_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_penerima->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tb_penerima_list->TotalRecs > 0 && $tb_penerima_list->ExportOptions->visible()) { ?>
<?php $tb_penerima_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_penerima_list->ImportOptions->visible()) { ?>
<?php $tb_penerima_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_penerima_list->SearchOptions->visible()) { ?>
<?php $tb_penerima_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tb_penerima_list->FilterOptions->visible()) { ?>
<?php $tb_penerima_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tb_penerima_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tb_penerima->isExport() && !$tb_penerima->CurrentAction) { ?>
<form name="ftb_penerimalistsrch" id="ftb_penerimalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tb_penerima_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftb_penerimalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_penerima">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tb_penerima_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Cari Penerima Barang")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tb_penerima_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("Cari") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tb_penerima_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tb_penerima_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tb_penerima_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tb_penerima_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tb_penerima_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tb_penerima_list->showPageHeader(); ?>
<?php
$tb_penerima_list->showMessage();
?>
<?php if ($tb_penerima_list->TotalRecs > 0 || $tb_penerima->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tb_penerima_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_penerima">
<form name="ftb_penerimalist" id="ftb_penerimalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_penerima_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_penerima_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_penerima">
<div id="gmp_tb_penerima" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tb_penerima_list->TotalRecs > 0 || $tb_penerima->isGridEdit()) { ?>
<table id="tbl_tb_penerimalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tb_penerima_list->RowType = ROWTYPE_HEADER;

// Render list options
$tb_penerima_list->renderListOptions();

// Render list options (header, left)
$tb_penerima_list->ListOptions->render("header", "left");
?>
<?php if ($tb_penerima->kd_penerima->Visible) { // kd_penerima ?>
	<?php if ($tb_penerima->sortUrl($tb_penerima->kd_penerima) == "") { ?>
		<th data-name="kd_penerima" class="<?php echo $tb_penerima->kd_penerima->headerCellClass() ?>"><div id="elh_tb_penerima_kd_penerima" class="tb_penerima_kd_penerima"><div class="ew-table-header-caption"><?php echo $tb_penerima->kd_penerima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_penerima" class="<?php echo $tb_penerima->kd_penerima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_penerima->SortUrl($tb_penerima->kd_penerima) ?>',1);"><div id="elh_tb_penerima_kd_penerima" class="tb_penerima_kd_penerima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_penerima->kd_penerima->caption() ?></span><span class="ew-table-header-sort"><?php if ($tb_penerima->kd_penerima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_penerima->kd_penerima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_penerima->nama_penerima->Visible) { // nama_penerima ?>
	<?php if ($tb_penerima->sortUrl($tb_penerima->nama_penerima) == "") { ?>
		<th data-name="nama_penerima" class="<?php echo $tb_penerima->nama_penerima->headerCellClass() ?>"><div id="elh_tb_penerima_nama_penerima" class="tb_penerima_nama_penerima"><div class="ew-table-header-caption"><?php echo $tb_penerima->nama_penerima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_penerima" class="<?php echo $tb_penerima->nama_penerima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_penerima->SortUrl($tb_penerima->nama_penerima) ?>',1);"><div id="elh_tb_penerima_nama_penerima" class="tb_penerima_nama_penerima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_penerima->nama_penerima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_penerima->nama_penerima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_penerima->nama_penerima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tb_penerima_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tb_penerima->ExportAll && $tb_penerima->isExport()) {
	$tb_penerima_list->StopRec = $tb_penerima_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tb_penerima_list->TotalRecs > $tb_penerima_list->StartRec + $tb_penerima_list->DisplayRecs - 1)
		$tb_penerima_list->StopRec = $tb_penerima_list->StartRec + $tb_penerima_list->DisplayRecs - 1;
	else
		$tb_penerima_list->StopRec = $tb_penerima_list->TotalRecs;
}
$tb_penerima_list->RecCnt = $tb_penerima_list->StartRec - 1;
if ($tb_penerima_list->Recordset && !$tb_penerima_list->Recordset->EOF) {
	$tb_penerima_list->Recordset->moveFirst();
	$selectLimit = $tb_penerima_list->UseSelectLimit;
	if (!$selectLimit && $tb_penerima_list->StartRec > 1)
		$tb_penerima_list->Recordset->move($tb_penerima_list->StartRec - 1);
} elseif (!$tb_penerima->AllowAddDeleteRow && $tb_penerima_list->StopRec == 0) {
	$tb_penerima_list->StopRec = $tb_penerima->GridAddRowCount;
}

// Initialize aggregate
$tb_penerima->RowType = ROWTYPE_AGGREGATEINIT;
$tb_penerima->resetAttributes();
$tb_penerima_list->renderRow();
while ($tb_penerima_list->RecCnt < $tb_penerima_list->StopRec) {
	$tb_penerima_list->RecCnt++;
	if ($tb_penerima_list->RecCnt >= $tb_penerima_list->StartRec) {
		$tb_penerima_list->RowCnt++;

		// Set up key count
		$tb_penerima_list->KeyCount = $tb_penerima_list->RowIndex;

		// Init row class and style
		$tb_penerima->resetAttributes();
		$tb_penerima->CssClass = "";
		if ($tb_penerima->isGridAdd()) {
		} else {
			$tb_penerima_list->loadRowValues($tb_penerima_list->Recordset); // Load row values
		}
		$tb_penerima->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tb_penerima->RowAttrs = array_merge($tb_penerima->RowAttrs, array('data-rowindex'=>$tb_penerima_list->RowCnt, 'id'=>'r' . $tb_penerima_list->RowCnt . '_tb_penerima', 'data-rowtype'=>$tb_penerima->RowType));

		// Render row
		$tb_penerima_list->renderRow();

		// Render list options
		$tb_penerima_list->renderListOptions();
?>
	<tr<?php echo $tb_penerima->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tb_penerima_list->ListOptions->render("body", "left", $tb_penerima_list->RowCnt);
?>
	<?php if ($tb_penerima->kd_penerima->Visible) { // kd_penerima ?>
		<td data-name="kd_penerima"<?php echo $tb_penerima->kd_penerima->cellAttributes() ?>>
<span id="el<?php echo $tb_penerima_list->RowCnt ?>_tb_penerima_kd_penerima" class="tb_penerima_kd_penerima">
<span<?php echo $tb_penerima->kd_penerima->viewAttributes() ?>>
<?php echo $tb_penerima->kd_penerima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_penerima->nama_penerima->Visible) { // nama_penerima ?>
		<td data-name="nama_penerima"<?php echo $tb_penerima->nama_penerima->cellAttributes() ?>>
<span id="el<?php echo $tb_penerima_list->RowCnt ?>_tb_penerima_nama_penerima" class="tb_penerima_nama_penerima">
<span<?php echo $tb_penerima->nama_penerima->viewAttributes() ?>>
<?php echo $tb_penerima->nama_penerima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tb_penerima_list->ListOptions->render("body", "right", $tb_penerima_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tb_penerima->isGridAdd())
		$tb_penerima_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tb_penerima->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tb_penerima_list->Recordset)
	$tb_penerima_list->Recordset->Close();
?>
<?php if (!$tb_penerima->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tb_penerima->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tb_penerima_list->Pager)) $tb_penerima_list->Pager = new PrevNextPager($tb_penerima_list->StartRec, $tb_penerima_list->DisplayRecs, $tb_penerima_list->TotalRecs, $tb_penerima_list->AutoHidePager) ?>
<?php if ($tb_penerima_list->Pager->RecordCount > 0 && $tb_penerima_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tb_penerima_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tb_penerima_list->pageUrl() ?>start=<?php echo $tb_penerima_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tb_penerima_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tb_penerima_list->pageUrl() ?>start=<?php echo $tb_penerima_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tb_penerima_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tb_penerima_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tb_penerima_list->pageUrl() ?>start=<?php echo $tb_penerima_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tb_penerima_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tb_penerima_list->pageUrl() ?>start=<?php echo $tb_penerima_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tb_penerima_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tb_penerima_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tb_penerima_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tb_penerima_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tb_penerima_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tb_penerima_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tb_penerima_list->TotalRecs == 0 && !$tb_penerima->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tb_penerima_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tb_penerima_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_penerima->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_penerima_list->terminate();
?>