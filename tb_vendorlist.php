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
$tb_vendor_list = new tb_vendor_list();

// Run the page
$tb_vendor_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_vendor_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_vendor->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftb_vendorlist = currentForm = new ew.Form("ftb_vendorlist", "list");
ftb_vendorlist.formKeyCountName = '<?php echo $tb_vendor_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftb_vendorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_vendorlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftb_vendorlistsrch = currentSearchForm = new ew.Form("ftb_vendorlistsrch");

// Filters
ftb_vendorlistsrch.filterList = <?php echo $tb_vendor_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_vendor->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tb_vendor_list->TotalRecs > 0 && $tb_vendor_list->ExportOptions->visible()) { ?>
<?php $tb_vendor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_vendor_list->ImportOptions->visible()) { ?>
<?php $tb_vendor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_vendor_list->SearchOptions->visible()) { ?>
<?php $tb_vendor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tb_vendor_list->FilterOptions->visible()) { ?>
<?php $tb_vendor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tb_vendor_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tb_vendor->isExport() && !$tb_vendor->CurrentAction) { ?>
<form name="ftb_vendorlistsrch" id="ftb_vendorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tb_vendor_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftb_vendorlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_vendor">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tb_vendor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tb_vendor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tb_vendor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tb_vendor_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tb_vendor_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tb_vendor_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tb_vendor_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tb_vendor_list->showPageHeader(); ?>
<?php
$tb_vendor_list->showMessage();
?>
<?php if ($tb_vendor_list->TotalRecs > 0 || $tb_vendor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tb_vendor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_vendor">
<form name="ftb_vendorlist" id="ftb_vendorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_vendor_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_vendor_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_vendor">
<div id="gmp_tb_vendor" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tb_vendor_list->TotalRecs > 0 || $tb_vendor->isGridEdit()) { ?>
<table id="tbl_tb_vendorlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tb_vendor_list->RowType = ROWTYPE_HEADER;

// Render list options
$tb_vendor_list->renderListOptions();

// Render list options (header, left)
$tb_vendor_list->ListOptions->render("header", "left");
?>
<?php if ($tb_vendor->nama_vendor->Visible) { // nama_vendor ?>
	<?php if ($tb_vendor->sortUrl($tb_vendor->nama_vendor) == "") { ?>
		<th data-name="nama_vendor" class="<?php echo $tb_vendor->nama_vendor->headerCellClass() ?>"><div id="elh_tb_vendor_nama_vendor" class="tb_vendor_nama_vendor"><div class="ew-table-header-caption"><?php echo $tb_vendor->nama_vendor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_vendor" class="<?php echo $tb_vendor->nama_vendor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_vendor->SortUrl($tb_vendor->nama_vendor) ?>',1);"><div id="elh_tb_vendor_nama_vendor" class="tb_vendor_nama_vendor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_vendor->nama_vendor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_vendor->nama_vendor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_vendor->nama_vendor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_vendor->alamat->Visible) { // alamat ?>
	<?php if ($tb_vendor->sortUrl($tb_vendor->alamat) == "") { ?>
		<th data-name="alamat" class="<?php echo $tb_vendor->alamat->headerCellClass() ?>"><div id="elh_tb_vendor_alamat" class="tb_vendor_alamat"><div class="ew-table-header-caption"><?php echo $tb_vendor->alamat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat" class="<?php echo $tb_vendor->alamat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_vendor->SortUrl($tb_vendor->alamat) ?>',1);"><div id="elh_tb_vendor_alamat" class="tb_vendor_alamat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_vendor->alamat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_vendor->alamat->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_vendor->alamat->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_vendor->telp->Visible) { // telp ?>
	<?php if ($tb_vendor->sortUrl($tb_vendor->telp) == "") { ?>
		<th data-name="telp" class="<?php echo $tb_vendor->telp->headerCellClass() ?>"><div id="elh_tb_vendor_telp" class="tb_vendor_telp"><div class="ew-table-header-caption"><?php echo $tb_vendor->telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telp" class="<?php echo $tb_vendor->telp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_vendor->SortUrl($tb_vendor->telp) ?>',1);"><div id="elh_tb_vendor_telp" class="tb_vendor_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_vendor->telp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_vendor->telp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_vendor->telp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tb_vendor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tb_vendor->ExportAll && $tb_vendor->isExport()) {
	$tb_vendor_list->StopRec = $tb_vendor_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tb_vendor_list->TotalRecs > $tb_vendor_list->StartRec + $tb_vendor_list->DisplayRecs - 1)
		$tb_vendor_list->StopRec = $tb_vendor_list->StartRec + $tb_vendor_list->DisplayRecs - 1;
	else
		$tb_vendor_list->StopRec = $tb_vendor_list->TotalRecs;
}
$tb_vendor_list->RecCnt = $tb_vendor_list->StartRec - 1;
if ($tb_vendor_list->Recordset && !$tb_vendor_list->Recordset->EOF) {
	$tb_vendor_list->Recordset->moveFirst();
	$selectLimit = $tb_vendor_list->UseSelectLimit;
	if (!$selectLimit && $tb_vendor_list->StartRec > 1)
		$tb_vendor_list->Recordset->move($tb_vendor_list->StartRec - 1);
} elseif (!$tb_vendor->AllowAddDeleteRow && $tb_vendor_list->StopRec == 0) {
	$tb_vendor_list->StopRec = $tb_vendor->GridAddRowCount;
}

// Initialize aggregate
$tb_vendor->RowType = ROWTYPE_AGGREGATEINIT;
$tb_vendor->resetAttributes();
$tb_vendor_list->renderRow();
while ($tb_vendor_list->RecCnt < $tb_vendor_list->StopRec) {
	$tb_vendor_list->RecCnt++;
	if ($tb_vendor_list->RecCnt >= $tb_vendor_list->StartRec) {
		$tb_vendor_list->RowCnt++;

		// Set up key count
		$tb_vendor_list->KeyCount = $tb_vendor_list->RowIndex;

		// Init row class and style
		$tb_vendor->resetAttributes();
		$tb_vendor->CssClass = "";
		if ($tb_vendor->isGridAdd()) {
		} else {
			$tb_vendor_list->loadRowValues($tb_vendor_list->Recordset); // Load row values
		}
		$tb_vendor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tb_vendor->RowAttrs = array_merge($tb_vendor->RowAttrs, array('data-rowindex'=>$tb_vendor_list->RowCnt, 'id'=>'r' . $tb_vendor_list->RowCnt . '_tb_vendor', 'data-rowtype'=>$tb_vendor->RowType));

		// Render row
		$tb_vendor_list->renderRow();

		// Render list options
		$tb_vendor_list->renderListOptions();
?>
	<tr<?php echo $tb_vendor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tb_vendor_list->ListOptions->render("body", "left", $tb_vendor_list->RowCnt);
?>
	<?php if ($tb_vendor->nama_vendor->Visible) { // nama_vendor ?>
		<td data-name="nama_vendor"<?php echo $tb_vendor->nama_vendor->cellAttributes() ?>>
<span id="el<?php echo $tb_vendor_list->RowCnt ?>_tb_vendor_nama_vendor" class="tb_vendor_nama_vendor">
<span<?php echo $tb_vendor->nama_vendor->viewAttributes() ?>>
<?php echo $tb_vendor->nama_vendor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_vendor->alamat->Visible) { // alamat ?>
		<td data-name="alamat"<?php echo $tb_vendor->alamat->cellAttributes() ?>>
<span id="el<?php echo $tb_vendor_list->RowCnt ?>_tb_vendor_alamat" class="tb_vendor_alamat">
<span<?php echo $tb_vendor->alamat->viewAttributes() ?>>
<?php echo $tb_vendor->alamat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_vendor->telp->Visible) { // telp ?>
		<td data-name="telp"<?php echo $tb_vendor->telp->cellAttributes() ?>>
<span id="el<?php echo $tb_vendor_list->RowCnt ?>_tb_vendor_telp" class="tb_vendor_telp">
<span<?php echo $tb_vendor->telp->viewAttributes() ?>>
<?php echo $tb_vendor->telp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tb_vendor_list->ListOptions->render("body", "right", $tb_vendor_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tb_vendor->isGridAdd())
		$tb_vendor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tb_vendor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tb_vendor_list->Recordset)
	$tb_vendor_list->Recordset->Close();
?>
<?php if (!$tb_vendor->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tb_vendor->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tb_vendor_list->Pager)) $tb_vendor_list->Pager = new PrevNextPager($tb_vendor_list->StartRec, $tb_vendor_list->DisplayRecs, $tb_vendor_list->TotalRecs, $tb_vendor_list->AutoHidePager) ?>
<?php if ($tb_vendor_list->Pager->RecordCount > 0 && $tb_vendor_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tb_vendor_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tb_vendor_list->pageUrl() ?>start=<?php echo $tb_vendor_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tb_vendor_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tb_vendor_list->pageUrl() ?>start=<?php echo $tb_vendor_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tb_vendor_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tb_vendor_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tb_vendor_list->pageUrl() ?>start=<?php echo $tb_vendor_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tb_vendor_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tb_vendor_list->pageUrl() ?>start=<?php echo $tb_vendor_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tb_vendor_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tb_vendor_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tb_vendor_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tb_vendor_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tb_vendor_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tb_vendor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tb_vendor_list->TotalRecs == 0 && !$tb_vendor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tb_vendor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tb_vendor_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_vendor->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_vendor_list->terminate();
?>