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
$tb_kategori_list = new tb_kategori_list();

// Run the page
$tb_kategori_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_kategori_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_kategori->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftb_kategorilist = currentForm = new ew.Form("ftb_kategorilist", "list");
ftb_kategorilist.formKeyCountName = '<?php echo $tb_kategori_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftb_kategorilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_kategorilist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftb_kategorilistsrch = currentSearchForm = new ew.Form("ftb_kategorilistsrch");

// Filters
ftb_kategorilistsrch.filterList = <?php echo $tb_kategori_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_kategori->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tb_kategori_list->TotalRecs > 0 && $tb_kategori_list->ExportOptions->visible()) { ?>
<?php $tb_kategori_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_kategori_list->ImportOptions->visible()) { ?>
<?php $tb_kategori_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_kategori_list->SearchOptions->visible()) { ?>
<?php $tb_kategori_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tb_kategori_list->FilterOptions->visible()) { ?>
<?php $tb_kategori_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tb_kategori_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tb_kategori->isExport() && !$tb_kategori->CurrentAction) { ?>
<form name="ftb_kategorilistsrch" id="ftb_kategorilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tb_kategori_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftb_kategorilistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_kategori">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tb_kategori_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Pencarian Kategori")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tb_kategori_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("Cari") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tb_kategori_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tb_kategori_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tb_kategori_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tb_kategori_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tb_kategori_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tb_kategori_list->showPageHeader(); ?>
<?php
$tb_kategori_list->showMessage();
?>
<?php if ($tb_kategori_list->TotalRecs > 0 || $tb_kategori->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tb_kategori_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_kategori">
<form name="ftb_kategorilist" id="ftb_kategorilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_kategori_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_kategori_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_kategori">
<div id="gmp_tb_kategori" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tb_kategori_list->TotalRecs > 0 || $tb_kategori->isGridEdit()) { ?>
<table id="tbl_tb_kategorilist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tb_kategori_list->RowType = ROWTYPE_HEADER;

// Render list options
$tb_kategori_list->renderListOptions();

// Render list options (header, left)
$tb_kategori_list->ListOptions->render("header", "left");
?>
<?php if ($tb_kategori->nama_kategori->Visible) { // nama_kategori ?>
	<?php if ($tb_kategori->sortUrl($tb_kategori->nama_kategori) == "") { ?>
		<th data-name="nama_kategori" class="<?php echo $tb_kategori->nama_kategori->headerCellClass() ?>"><div id="elh_tb_kategori_nama_kategori" class="tb_kategori_nama_kategori"><div class="ew-table-header-caption"><?php echo $tb_kategori->nama_kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_kategori" class="<?php echo $tb_kategori->nama_kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_kategori->SortUrl($tb_kategori->nama_kategori) ?>',1);"><div id="elh_tb_kategori_nama_kategori" class="tb_kategori_nama_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_kategori->nama_kategori->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_kategori->nama_kategori->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_kategori->nama_kategori->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_kategori->keterangan->Visible) { // keterangan ?>
	<?php if ($tb_kategori->sortUrl($tb_kategori->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $tb_kategori->keterangan->headerCellClass() ?>"><div id="elh_tb_kategori_keterangan" class="tb_kategori_keterangan"><div class="ew-table-header-caption"><?php echo $tb_kategori->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $tb_kategori->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_kategori->SortUrl($tb_kategori->keterangan) ?>',1);"><div id="elh_tb_kategori_keterangan" class="tb_kategori_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_kategori->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_kategori->keterangan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_kategori->keterangan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tb_kategori_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tb_kategori->ExportAll && $tb_kategori->isExport()) {
	$tb_kategori_list->StopRec = $tb_kategori_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tb_kategori_list->TotalRecs > $tb_kategori_list->StartRec + $tb_kategori_list->DisplayRecs - 1)
		$tb_kategori_list->StopRec = $tb_kategori_list->StartRec + $tb_kategori_list->DisplayRecs - 1;
	else
		$tb_kategori_list->StopRec = $tb_kategori_list->TotalRecs;
}
$tb_kategori_list->RecCnt = $tb_kategori_list->StartRec - 1;
if ($tb_kategori_list->Recordset && !$tb_kategori_list->Recordset->EOF) {
	$tb_kategori_list->Recordset->moveFirst();
	$selectLimit = $tb_kategori_list->UseSelectLimit;
	if (!$selectLimit && $tb_kategori_list->StartRec > 1)
		$tb_kategori_list->Recordset->move($tb_kategori_list->StartRec - 1);
} elseif (!$tb_kategori->AllowAddDeleteRow && $tb_kategori_list->StopRec == 0) {
	$tb_kategori_list->StopRec = $tb_kategori->GridAddRowCount;
}

// Initialize aggregate
$tb_kategori->RowType = ROWTYPE_AGGREGATEINIT;
$tb_kategori->resetAttributes();
$tb_kategori_list->renderRow();
while ($tb_kategori_list->RecCnt < $tb_kategori_list->StopRec) {
	$tb_kategori_list->RecCnt++;
	if ($tb_kategori_list->RecCnt >= $tb_kategori_list->StartRec) {
		$tb_kategori_list->RowCnt++;

		// Set up key count
		$tb_kategori_list->KeyCount = $tb_kategori_list->RowIndex;

		// Init row class and style
		$tb_kategori->resetAttributes();
		$tb_kategori->CssClass = "";
		if ($tb_kategori->isGridAdd()) {
		} else {
			$tb_kategori_list->loadRowValues($tb_kategori_list->Recordset); // Load row values
		}
		$tb_kategori->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tb_kategori->RowAttrs = array_merge($tb_kategori->RowAttrs, array('data-rowindex'=>$tb_kategori_list->RowCnt, 'id'=>'r' . $tb_kategori_list->RowCnt . '_tb_kategori', 'data-rowtype'=>$tb_kategori->RowType));

		// Render row
		$tb_kategori_list->renderRow();

		// Render list options
		$tb_kategori_list->renderListOptions();
?>
	<tr<?php echo $tb_kategori->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tb_kategori_list->ListOptions->render("body", "left", $tb_kategori_list->RowCnt);
?>
	<?php if ($tb_kategori->nama_kategori->Visible) { // nama_kategori ?>
		<td data-name="nama_kategori"<?php echo $tb_kategori->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $tb_kategori_list->RowCnt ?>_tb_kategori_nama_kategori" class="tb_kategori_nama_kategori">
<span<?php echo $tb_kategori->nama_kategori->viewAttributes() ?>>
<?php echo $tb_kategori->nama_kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_kategori->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan"<?php echo $tb_kategori->keterangan->cellAttributes() ?>>
<span id="el<?php echo $tb_kategori_list->RowCnt ?>_tb_kategori_keterangan" class="tb_kategori_keterangan">
<span<?php echo $tb_kategori->keterangan->viewAttributes() ?>>
<?php echo $tb_kategori->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tb_kategori_list->ListOptions->render("body", "right", $tb_kategori_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tb_kategori->isGridAdd())
		$tb_kategori_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tb_kategori->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tb_kategori_list->Recordset)
	$tb_kategori_list->Recordset->Close();
?>
<?php if (!$tb_kategori->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tb_kategori->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tb_kategori_list->Pager)) $tb_kategori_list->Pager = new PrevNextPager($tb_kategori_list->StartRec, $tb_kategori_list->DisplayRecs, $tb_kategori_list->TotalRecs, $tb_kategori_list->AutoHidePager) ?>
<?php if ($tb_kategori_list->Pager->RecordCount > 0 && $tb_kategori_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tb_kategori_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tb_kategori_list->pageUrl() ?>start=<?php echo $tb_kategori_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tb_kategori_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tb_kategori_list->pageUrl() ?>start=<?php echo $tb_kategori_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tb_kategori_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tb_kategori_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tb_kategori_list->pageUrl() ?>start=<?php echo $tb_kategori_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tb_kategori_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tb_kategori_list->pageUrl() ?>start=<?php echo $tb_kategori_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tb_kategori_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tb_kategori_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tb_kategori_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tb_kategori_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tb_kategori_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tb_kategori_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tb_kategori_list->TotalRecs == 0 && !$tb_kategori->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tb_kategori_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tb_kategori_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_kategori->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_kategori_list->terminate();
?>