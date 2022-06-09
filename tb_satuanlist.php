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
$tb_satuan_list = new tb_satuan_list();

// Run the page
$tb_satuan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_satuan_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_satuan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftb_satuanlist = currentForm = new ew.Form("ftb_satuanlist", "list");
ftb_satuanlist.formKeyCountName = '<?php echo $tb_satuan_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftb_satuanlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_satuanlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftb_satuanlistsrch = currentSearchForm = new ew.Form("ftb_satuanlistsrch");

// Filters
ftb_satuanlistsrch.filterList = <?php echo $tb_satuan_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_satuan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tb_satuan_list->TotalRecs > 0 && $tb_satuan_list->ExportOptions->visible()) { ?>
<?php $tb_satuan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_satuan_list->ImportOptions->visible()) { ?>
<?php $tb_satuan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_satuan_list->SearchOptions->visible()) { ?>
<?php $tb_satuan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tb_satuan_list->FilterOptions->visible()) { ?>
<?php $tb_satuan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tb_satuan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tb_satuan->isExport() && !$tb_satuan->CurrentAction) { ?>
<form name="ftb_satuanlistsrch" id="ftb_satuanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tb_satuan_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftb_satuanlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_satuan">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tb_satuan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Pencarian Satuan")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tb_satuan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("Cari") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tb_satuan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tb_satuan_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tb_satuan_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tb_satuan_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tb_satuan_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tb_satuan_list->showPageHeader(); ?>
<?php
$tb_satuan_list->showMessage();
?>
<?php if ($tb_satuan_list->TotalRecs > 0 || $tb_satuan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tb_satuan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_satuan">
<form name="ftb_satuanlist" id="ftb_satuanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_satuan_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_satuan_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_satuan">
<div id="gmp_tb_satuan" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tb_satuan_list->TotalRecs > 0 || $tb_satuan->isGridEdit()) { ?>
<table id="tbl_tb_satuanlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tb_satuan_list->RowType = ROWTYPE_HEADER;

// Render list options
$tb_satuan_list->renderListOptions();

// Render list options (header, left)
$tb_satuan_list->ListOptions->render("header", "left");
?>
<?php if ($tb_satuan->nama_satuan->Visible) { // nama_satuan ?>
	<?php if ($tb_satuan->sortUrl($tb_satuan->nama_satuan) == "") { ?>
		<th data-name="nama_satuan" class="<?php echo $tb_satuan->nama_satuan->headerCellClass() ?>"><div id="elh_tb_satuan_nama_satuan" class="tb_satuan_nama_satuan"><div class="ew-table-header-caption"><?php echo $tb_satuan->nama_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_satuan" class="<?php echo $tb_satuan->nama_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_satuan->SortUrl($tb_satuan->nama_satuan) ?>',1);"><div id="elh_tb_satuan_nama_satuan" class="tb_satuan_nama_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_satuan->nama_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_satuan->nama_satuan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_satuan->nama_satuan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tb_satuan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tb_satuan->ExportAll && $tb_satuan->isExport()) {
	$tb_satuan_list->StopRec = $tb_satuan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tb_satuan_list->TotalRecs > $tb_satuan_list->StartRec + $tb_satuan_list->DisplayRecs - 1)
		$tb_satuan_list->StopRec = $tb_satuan_list->StartRec + $tb_satuan_list->DisplayRecs - 1;
	else
		$tb_satuan_list->StopRec = $tb_satuan_list->TotalRecs;
}
$tb_satuan_list->RecCnt = $tb_satuan_list->StartRec - 1;
if ($tb_satuan_list->Recordset && !$tb_satuan_list->Recordset->EOF) {
	$tb_satuan_list->Recordset->moveFirst();
	$selectLimit = $tb_satuan_list->UseSelectLimit;
	if (!$selectLimit && $tb_satuan_list->StartRec > 1)
		$tb_satuan_list->Recordset->move($tb_satuan_list->StartRec - 1);
} elseif (!$tb_satuan->AllowAddDeleteRow && $tb_satuan_list->StopRec == 0) {
	$tb_satuan_list->StopRec = $tb_satuan->GridAddRowCount;
}

// Initialize aggregate
$tb_satuan->RowType = ROWTYPE_AGGREGATEINIT;
$tb_satuan->resetAttributes();
$tb_satuan_list->renderRow();
while ($tb_satuan_list->RecCnt < $tb_satuan_list->StopRec) {
	$tb_satuan_list->RecCnt++;
	if ($tb_satuan_list->RecCnt >= $tb_satuan_list->StartRec) {
		$tb_satuan_list->RowCnt++;

		// Set up key count
		$tb_satuan_list->KeyCount = $tb_satuan_list->RowIndex;

		// Init row class and style
		$tb_satuan->resetAttributes();
		$tb_satuan->CssClass = "";
		if ($tb_satuan->isGridAdd()) {
		} else {
			$tb_satuan_list->loadRowValues($tb_satuan_list->Recordset); // Load row values
		}
		$tb_satuan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tb_satuan->RowAttrs = array_merge($tb_satuan->RowAttrs, array('data-rowindex'=>$tb_satuan_list->RowCnt, 'id'=>'r' . $tb_satuan_list->RowCnt . '_tb_satuan', 'data-rowtype'=>$tb_satuan->RowType));

		// Render row
		$tb_satuan_list->renderRow();

		// Render list options
		$tb_satuan_list->renderListOptions();
?>
	<tr<?php echo $tb_satuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tb_satuan_list->ListOptions->render("body", "left", $tb_satuan_list->RowCnt);
?>
	<?php if ($tb_satuan->nama_satuan->Visible) { // nama_satuan ?>
		<td data-name="nama_satuan"<?php echo $tb_satuan->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $tb_satuan_list->RowCnt ?>_tb_satuan_nama_satuan" class="tb_satuan_nama_satuan">
<span<?php echo $tb_satuan->nama_satuan->viewAttributes() ?>>
<?php echo $tb_satuan->nama_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tb_satuan_list->ListOptions->render("body", "right", $tb_satuan_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tb_satuan->isGridAdd())
		$tb_satuan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tb_satuan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tb_satuan_list->Recordset)
	$tb_satuan_list->Recordset->Close();
?>
<?php if (!$tb_satuan->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tb_satuan->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tb_satuan_list->Pager)) $tb_satuan_list->Pager = new PrevNextPager($tb_satuan_list->StartRec, $tb_satuan_list->DisplayRecs, $tb_satuan_list->TotalRecs, $tb_satuan_list->AutoHidePager) ?>
<?php if ($tb_satuan_list->Pager->RecordCount > 0 && $tb_satuan_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tb_satuan_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tb_satuan_list->pageUrl() ?>start=<?php echo $tb_satuan_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tb_satuan_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tb_satuan_list->pageUrl() ?>start=<?php echo $tb_satuan_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tb_satuan_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tb_satuan_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tb_satuan_list->pageUrl() ?>start=<?php echo $tb_satuan_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tb_satuan_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tb_satuan_list->pageUrl() ?>start=<?php echo $tb_satuan_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tb_satuan_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tb_satuan_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tb_satuan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tb_satuan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tb_satuan_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tb_satuan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tb_satuan_list->TotalRecs == 0 && !$tb_satuan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tb_satuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tb_satuan_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_satuan->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_satuan_list->terminate();
?>