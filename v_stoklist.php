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
$v_stok_list = new v_stok_list();

// Run the page
$v_stok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_stok_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$v_stok->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fv_stoklist = currentForm = new ew.Form("fv_stoklist", "list");
fv_stoklist.formKeyCountName = '<?php echo $v_stok_list->FormKeyCountName ?>';

// Form_CustomValidate event
fv_stoklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fv_stoklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fv_stoklistsrch = currentSearchForm = new ew.Form("fv_stoklistsrch");

// Filters
fv_stoklistsrch.filterList = <?php echo $v_stok_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$v_stok->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_stok_list->TotalRecs > 0 && $v_stok_list->ExportOptions->visible()) { ?>
<?php $v_stok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_stok_list->ImportOptions->visible()) { ?>
<?php $v_stok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_stok_list->SearchOptions->visible()) { ?>
<?php $v_stok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_stok_list->FilterOptions->visible()) { ?>
<?php $v_stok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_stok_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_stok->isExport() && !$v_stok->CurrentAction) { ?>
<form name="fv_stoklistsrch" id="fv_stoklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($v_stok_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fv_stoklistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_stok">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($v_stok_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($v_stok_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_stok_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_stok_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_stok_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_stok_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_stok_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $v_stok_list->showPageHeader(); ?>
<?php
$v_stok_list->showMessage();
?>
<?php if ($v_stok_list->TotalRecs > 0 || $v_stok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_stok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_stok">
<form name="fv_stoklist" id="fv_stoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($v_stok_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $v_stok_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_stok">
<div id="gmp_v_stok" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($v_stok_list->TotalRecs > 0 || $v_stok->isGridEdit()) { ?>
<table id="tbl_v_stoklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_stok_list->RowType = ROWTYPE_HEADER;

// Render list options
$v_stok_list->renderListOptions();

// Render list options (header, left)
$v_stok_list->ListOptions->render("header", "left");
?>
<?php if ($v_stok->kode_barang->Visible) { // kode_barang ?>
	<?php if ($v_stok->sortUrl($v_stok->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $v_stok->kode_barang->headerCellClass() ?>"><div id="elh_v_stok_kode_barang" class="v_stok_kode_barang"><div class="ew-table-header-caption"><?php echo $v_stok->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $v_stok->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_stok->SortUrl($v_stok->kode_barang) ?>',1);"><div id="elh_v_stok_kode_barang" class="v_stok_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stok->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_stok->kode_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_stok->kode_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stok->nama_barang->Visible) { // nama_barang ?>
	<?php if ($v_stok->sortUrl($v_stok->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $v_stok->nama_barang->headerCellClass() ?>"><div id="elh_v_stok_nama_barang" class="v_stok_nama_barang"><div class="ew-table-header-caption"><?php echo $v_stok->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $v_stok->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_stok->SortUrl($v_stok->nama_barang) ?>',1);"><div id="elh_v_stok_nama_barang" class="v_stok_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stok->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_stok->nama_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_stok->nama_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stok->nama_kategori->Visible) { // nama_kategori ?>
	<?php if ($v_stok->sortUrl($v_stok->nama_kategori) == "") { ?>
		<th data-name="nama_kategori" class="<?php echo $v_stok->nama_kategori->headerCellClass() ?>"><div id="elh_v_stok_nama_kategori" class="v_stok_nama_kategori"><div class="ew-table-header-caption"><?php echo $v_stok->nama_kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_kategori" class="<?php echo $v_stok->nama_kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_stok->SortUrl($v_stok->nama_kategori) ?>',1);"><div id="elh_v_stok_nama_kategori" class="v_stok_nama_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stok->nama_kategori->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_stok->nama_kategori->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_stok->nama_kategori->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stok->nama_satuan->Visible) { // nama_satuan ?>
	<?php if ($v_stok->sortUrl($v_stok->nama_satuan) == "") { ?>
		<th data-name="nama_satuan" class="<?php echo $v_stok->nama_satuan->headerCellClass() ?>"><div id="elh_v_stok_nama_satuan" class="v_stok_nama_satuan"><div class="ew-table-header-caption"><?php echo $v_stok->nama_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_satuan" class="<?php echo $v_stok->nama_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_stok->SortUrl($v_stok->nama_satuan) ?>',1);"><div id="elh_v_stok_nama_satuan" class="v_stok_nama_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stok->nama_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_stok->nama_satuan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_stok->nama_satuan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stok->Stok_Awal->Visible) { // Stok Awal ?>
	<?php if ($v_stok->sortUrl($v_stok->Stok_Awal) == "") { ?>
		<th data-name="Stok_Awal" class="<?php echo $v_stok->Stok_Awal->headerCellClass() ?>"><div id="elh_v_stok_Stok_Awal" class="v_stok_Stok_Awal"><div class="ew-table-header-caption"><?php echo $v_stok->Stok_Awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Stok_Awal" class="<?php echo $v_stok->Stok_Awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_stok->SortUrl($v_stok->Stok_Awal) ?>',1);"><div id="elh_v_stok_Stok_Awal" class="v_stok_Stok_Awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stok->Stok_Awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_stok->Stok_Awal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_stok->Stok_Awal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stok->Stok_Akhir->Visible) { // Stok Akhir ?>
	<?php if ($v_stok->sortUrl($v_stok->Stok_Akhir) == "") { ?>
		<th data-name="Stok_Akhir" class="<?php echo $v_stok->Stok_Akhir->headerCellClass() ?>"><div id="elh_v_stok_Stok_Akhir" class="v_stok_Stok_Akhir"><div class="ew-table-header-caption"><?php echo $v_stok->Stok_Akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Stok_Akhir" class="<?php echo $v_stok->Stok_Akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_stok->SortUrl($v_stok->Stok_Akhir) ?>',1);"><div id="elh_v_stok_Stok_Akhir" class="v_stok_Stok_Akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stok->Stok_Akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_stok->Stok_Akhir->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_stok->Stok_Akhir->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_stok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_stok->ExportAll && $v_stok->isExport()) {
	$v_stok_list->StopRec = $v_stok_list->TotalRecs;
} else {

	// Set the last record to display
	if ($v_stok_list->TotalRecs > $v_stok_list->StartRec + $v_stok_list->DisplayRecs - 1)
		$v_stok_list->StopRec = $v_stok_list->StartRec + $v_stok_list->DisplayRecs - 1;
	else
		$v_stok_list->StopRec = $v_stok_list->TotalRecs;
}
$v_stok_list->RecCnt = $v_stok_list->StartRec - 1;
if ($v_stok_list->Recordset && !$v_stok_list->Recordset->EOF) {
	$v_stok_list->Recordset->moveFirst();
	$selectLimit = $v_stok_list->UseSelectLimit;
	if (!$selectLimit && $v_stok_list->StartRec > 1)
		$v_stok_list->Recordset->move($v_stok_list->StartRec - 1);
} elseif (!$v_stok->AllowAddDeleteRow && $v_stok_list->StopRec == 0) {
	$v_stok_list->StopRec = $v_stok->GridAddRowCount;
}

// Initialize aggregate
$v_stok->RowType = ROWTYPE_AGGREGATEINIT;
$v_stok->resetAttributes();
$v_stok_list->renderRow();
while ($v_stok_list->RecCnt < $v_stok_list->StopRec) {
	$v_stok_list->RecCnt++;
	if ($v_stok_list->RecCnt >= $v_stok_list->StartRec) {
		$v_stok_list->RowCnt++;

		// Set up key count
		$v_stok_list->KeyCount = $v_stok_list->RowIndex;

		// Init row class and style
		$v_stok->resetAttributes();
		$v_stok->CssClass = "";
		if ($v_stok->isGridAdd()) {
		} else {
			$v_stok_list->loadRowValues($v_stok_list->Recordset); // Load row values
		}
		$v_stok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_stok->RowAttrs = array_merge($v_stok->RowAttrs, array('data-rowindex'=>$v_stok_list->RowCnt, 'id'=>'r' . $v_stok_list->RowCnt . '_v_stok', 'data-rowtype'=>$v_stok->RowType));

		// Render row
		$v_stok_list->renderRow();

		// Render list options
		$v_stok_list->renderListOptions();
?>
	<tr<?php echo $v_stok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_stok_list->ListOptions->render("body", "left", $v_stok_list->RowCnt);
?>
	<?php if ($v_stok->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang"<?php echo $v_stok->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $v_stok_list->RowCnt ?>_v_stok_kode_barang" class="v_stok_kode_barang">
<span<?php echo $v_stok->kode_barang->viewAttributes() ?>>
<?php echo $v_stok->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stok->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang"<?php echo $v_stok->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $v_stok_list->RowCnt ?>_v_stok_nama_barang" class="v_stok_nama_barang">
<span<?php echo $v_stok->nama_barang->viewAttributes() ?>>
<?php echo $v_stok->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stok->nama_kategori->Visible) { // nama_kategori ?>
		<td data-name="nama_kategori"<?php echo $v_stok->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $v_stok_list->RowCnt ?>_v_stok_nama_kategori" class="v_stok_nama_kategori">
<span<?php echo $v_stok->nama_kategori->viewAttributes() ?>>
<?php echo $v_stok->nama_kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stok->nama_satuan->Visible) { // nama_satuan ?>
		<td data-name="nama_satuan"<?php echo $v_stok->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $v_stok_list->RowCnt ?>_v_stok_nama_satuan" class="v_stok_nama_satuan">
<span<?php echo $v_stok->nama_satuan->viewAttributes() ?>>
<?php echo $v_stok->nama_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stok->Stok_Awal->Visible) { // Stok Awal ?>
		<td data-name="Stok_Awal"<?php echo $v_stok->Stok_Awal->cellAttributes() ?>>
<span id="el<?php echo $v_stok_list->RowCnt ?>_v_stok_Stok_Awal" class="v_stok_Stok_Awal">
<span<?php echo $v_stok->Stok_Awal->viewAttributes() ?>>
<?php echo $v_stok->Stok_Awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stok->Stok_Akhir->Visible) { // Stok Akhir ?>
		<td data-name="Stok_Akhir"<?php echo $v_stok->Stok_Akhir->cellAttributes() ?>>
<span id="el<?php echo $v_stok_list->RowCnt ?>_v_stok_Stok_Akhir" class="v_stok_Stok_Akhir">
<span<?php echo $v_stok->Stok_Akhir->viewAttributes() ?>>
<?php echo $v_stok->Stok_Akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_stok_list->ListOptions->render("body", "right", $v_stok_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$v_stok->isGridAdd())
		$v_stok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$v_stok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_stok_list->Recordset)
	$v_stok_list->Recordset->Close();
?>
<?php if (!$v_stok->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_stok->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($v_stok_list->Pager)) $v_stok_list->Pager = new PrevNextPager($v_stok_list->StartRec, $v_stok_list->DisplayRecs, $v_stok_list->TotalRecs, $v_stok_list->AutoHidePager) ?>
<?php if ($v_stok_list->Pager->RecordCount > 0 && $v_stok_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($v_stok_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $v_stok_list->pageUrl() ?>start=<?php echo $v_stok_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($v_stok_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $v_stok_list->pageUrl() ?>start=<?php echo $v_stok_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $v_stok_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($v_stok_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $v_stok_list->pageUrl() ?>start=<?php echo $v_stok_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($v_stok_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $v_stok_list->pageUrl() ?>start=<?php echo $v_stok_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v_stok_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($v_stok_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v_stok_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v_stok_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v_stok_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_stok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_stok_list->TotalRecs == 0 && !$v_stok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_stok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_stok_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$v_stok->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$v_stok_list->terminate();
?>