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
$tb_barang_list = new tb_barang_list();

// Run the page
$tb_barang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_barang_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_barang->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftb_baranglist = currentForm = new ew.Form("ftb_baranglist", "list");
ftb_baranglist.formKeyCountName = '<?php echo $tb_barang_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftb_baranglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_baranglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftb_baranglist.lists["x_kd_kategori"] = <?php echo $tb_barang_list->kd_kategori->Lookup->toClientList() ?>;
ftb_baranglist.lists["x_kd_kategori"].options = <?php echo JsonEncode($tb_barang_list->kd_kategori->lookupOptions()) ?>;
ftb_baranglist.lists["x_kd_satuan"] = <?php echo $tb_barang_list->kd_satuan->Lookup->toClientList() ?>;
ftb_baranglist.lists["x_kd_satuan"].options = <?php echo JsonEncode($tb_barang_list->kd_satuan->lookupOptions()) ?>;

// Form object for search
var ftb_baranglistsrch = currentSearchForm = new ew.Form("ftb_baranglistsrch");

// Filters
ftb_baranglistsrch.filterList = <?php echo $tb_barang_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_barang->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tb_barang_list->TotalRecs > 0 && $tb_barang_list->ExportOptions->visible()) { ?>
<?php $tb_barang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_barang_list->ImportOptions->visible()) { ?>
<?php $tb_barang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_barang_list->SearchOptions->visible()) { ?>
<?php $tb_barang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tb_barang_list->FilterOptions->visible()) { ?>
<?php $tb_barang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tb_barang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tb_barang->isExport() && !$tb_barang->CurrentAction) { ?>
<form name="ftb_baranglistsrch" id="ftb_baranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tb_barang_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftb_baranglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_barang">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tb_barang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Pencarian Data Barang")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tb_barang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("Cari") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tb_barang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tb_barang_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tb_barang_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tb_barang_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tb_barang_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tb_barang_list->showPageHeader(); ?>
<?php
$tb_barang_list->showMessage();
?>
<?php if ($tb_barang_list->TotalRecs > 0 || $tb_barang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tb_barang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_barang">
<form name="ftb_baranglist" id="ftb_baranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_barang_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_barang_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_barang">
<div id="gmp_tb_barang" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tb_barang_list->TotalRecs > 0 || $tb_barang->isGridEdit()) { ?>
<table id="tbl_tb_baranglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tb_barang_list->RowType = ROWTYPE_HEADER;

// Render list options
$tb_barang_list->renderListOptions();

// Render list options (header, left)
$tb_barang_list->ListOptions->render("header", "left");
?>
<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
	<?php if ($tb_barang->sortUrl($tb_barang->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $tb_barang->kode_barang->headerCellClass() ?>"><div id="elh_tb_barang_kode_barang" class="tb_barang_kode_barang"><div class="ew-table-header-caption"><?php echo $tb_barang->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $tb_barang->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_barang->SortUrl($tb_barang->kode_barang) ?>',1);"><div id="elh_tb_barang_kode_barang" class="tb_barang_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_barang->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_barang->kode_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_barang->kode_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
	<?php if ($tb_barang->sortUrl($tb_barang->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $tb_barang->nama_barang->headerCellClass() ?>"><div id="elh_tb_barang_nama_barang" class="tb_barang_nama_barang"><div class="ew-table-header-caption"><?php echo $tb_barang->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $tb_barang->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_barang->SortUrl($tb_barang->nama_barang) ?>',1);"><div id="elh_tb_barang_nama_barang" class="tb_barang_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_barang->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_barang->nama_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_barang->nama_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
	<?php if ($tb_barang->sortUrl($tb_barang->kd_kategori) == "") { ?>
		<th data-name="kd_kategori" class="<?php echo $tb_barang->kd_kategori->headerCellClass() ?>"><div id="elh_tb_barang_kd_kategori" class="tb_barang_kd_kategori"><div class="ew-table-header-caption"><?php echo $tb_barang->kd_kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_kategori" class="<?php echo $tb_barang->kd_kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_barang->SortUrl($tb_barang->kd_kategori) ?>',1);"><div id="elh_tb_barang_kd_kategori" class="tb_barang_kd_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_barang->kd_kategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($tb_barang->kd_kategori->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_barang->kd_kategori->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
	<?php if ($tb_barang->sortUrl($tb_barang->kd_satuan) == "") { ?>
		<th data-name="kd_satuan" class="<?php echo $tb_barang->kd_satuan->headerCellClass() ?>"><div id="elh_tb_barang_kd_satuan" class="tb_barang_kd_satuan"><div class="ew-table-header-caption"><?php echo $tb_barang->kd_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_satuan" class="<?php echo $tb_barang->kd_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_barang->SortUrl($tb_barang->kd_satuan) ?>',1);"><div id="elh_tb_barang_kd_satuan" class="tb_barang_kd_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_barang->kd_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($tb_barang->kd_satuan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_barang->kd_satuan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
	<?php if ($tb_barang->sortUrl($tb_barang->stok_awal) == "") { ?>
		<th data-name="stok_awal" class="<?php echo $tb_barang->stok_awal->headerCellClass() ?>"><div id="elh_tb_barang_stok_awal" class="tb_barang_stok_awal"><div class="ew-table-header-caption"><?php echo $tb_barang->stok_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok_awal" class="<?php echo $tb_barang->stok_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_barang->SortUrl($tb_barang->stok_awal) ?>',1);"><div id="elh_tb_barang_stok_awal" class="tb_barang_stok_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_barang->stok_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($tb_barang->stok_awal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_barang->stok_awal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_barang->stok_akhir->Visible) { // stok_akhir ?>
	<?php if ($tb_barang->sortUrl($tb_barang->stok_akhir) == "") { ?>
		<th data-name="stok_akhir" class="<?php echo $tb_barang->stok_akhir->headerCellClass() ?>"><div id="elh_tb_barang_stok_akhir" class="tb_barang_stok_akhir"><div class="ew-table-header-caption"><?php echo $tb_barang->stok_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok_akhir" class="<?php echo $tb_barang->stok_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_barang->SortUrl($tb_barang->stok_akhir) ?>',1);"><div id="elh_tb_barang_stok_akhir" class="tb_barang_stok_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_barang->stok_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($tb_barang->stok_akhir->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_barang->stok_akhir->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tb_barang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tb_barang->ExportAll && $tb_barang->isExport()) {
	$tb_barang_list->StopRec = $tb_barang_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tb_barang_list->TotalRecs > $tb_barang_list->StartRec + $tb_barang_list->DisplayRecs - 1)
		$tb_barang_list->StopRec = $tb_barang_list->StartRec + $tb_barang_list->DisplayRecs - 1;
	else
		$tb_barang_list->StopRec = $tb_barang_list->TotalRecs;
}
$tb_barang_list->RecCnt = $tb_barang_list->StartRec - 1;
if ($tb_barang_list->Recordset && !$tb_barang_list->Recordset->EOF) {
	$tb_barang_list->Recordset->moveFirst();
	$selectLimit = $tb_barang_list->UseSelectLimit;
	if (!$selectLimit && $tb_barang_list->StartRec > 1)
		$tb_barang_list->Recordset->move($tb_barang_list->StartRec - 1);
} elseif (!$tb_barang->AllowAddDeleteRow && $tb_barang_list->StopRec == 0) {
	$tb_barang_list->StopRec = $tb_barang->GridAddRowCount;
}

// Initialize aggregate
$tb_barang->RowType = ROWTYPE_AGGREGATEINIT;
$tb_barang->resetAttributes();
$tb_barang_list->renderRow();
while ($tb_barang_list->RecCnt < $tb_barang_list->StopRec) {
	$tb_barang_list->RecCnt++;
	if ($tb_barang_list->RecCnt >= $tb_barang_list->StartRec) {
		$tb_barang_list->RowCnt++;

		// Set up key count
		$tb_barang_list->KeyCount = $tb_barang_list->RowIndex;

		// Init row class and style
		$tb_barang->resetAttributes();
		$tb_barang->CssClass = "";
		if ($tb_barang->isGridAdd()) {
		} else {
			$tb_barang_list->loadRowValues($tb_barang_list->Recordset); // Load row values
		}
		$tb_barang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tb_barang->RowAttrs = array_merge($tb_barang->RowAttrs, array('data-rowindex'=>$tb_barang_list->RowCnt, 'id'=>'r' . $tb_barang_list->RowCnt . '_tb_barang', 'data-rowtype'=>$tb_barang->RowType));

		// Render row
		$tb_barang_list->renderRow();

		// Render list options
		$tb_barang_list->renderListOptions();
?>
	<tr<?php echo $tb_barang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tb_barang_list->ListOptions->render("body", "left", $tb_barang_list->RowCnt);
?>
	<?php if ($tb_barang->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang"<?php echo $tb_barang->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_list->RowCnt ?>_tb_barang_kode_barang" class="tb_barang_kode_barang">
<span<?php echo $tb_barang->kode_barang->viewAttributes() ?>>
<?php echo $tb_barang->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_barang->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang"<?php echo $tb_barang->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_list->RowCnt ?>_tb_barang_nama_barang" class="tb_barang_nama_barang">
<span<?php echo $tb_barang->nama_barang->viewAttributes() ?>>
<?php echo $tb_barang->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_barang->kd_kategori->Visible) { // kd_kategori ?>
		<td data-name="kd_kategori"<?php echo $tb_barang->kd_kategori->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_list->RowCnt ?>_tb_barang_kd_kategori" class="tb_barang_kd_kategori">
<span<?php echo $tb_barang->kd_kategori->viewAttributes() ?>>
<?php echo $tb_barang->kd_kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_barang->kd_satuan->Visible) { // kd_satuan ?>
		<td data-name="kd_satuan"<?php echo $tb_barang->kd_satuan->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_list->RowCnt ?>_tb_barang_kd_satuan" class="tb_barang_kd_satuan">
<span<?php echo $tb_barang->kd_satuan->viewAttributes() ?>>
<?php echo $tb_barang->kd_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_barang->stok_awal->Visible) { // stok_awal ?>
		<td data-name="stok_awal"<?php echo $tb_barang->stok_awal->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_list->RowCnt ?>_tb_barang_stok_awal" class="tb_barang_stok_awal">
<span<?php echo $tb_barang->stok_awal->viewAttributes() ?>>
<?php echo $tb_barang->stok_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_barang->stok_akhir->Visible) { // stok_akhir ?>
		<td data-name="stok_akhir"<?php echo $tb_barang->stok_akhir->cellAttributes() ?>>
<span id="el<?php echo $tb_barang_list->RowCnt ?>_tb_barang_stok_akhir" class="tb_barang_stok_akhir">
<span<?php echo $tb_barang->stok_akhir->viewAttributes() ?>>
<?php echo $tb_barang->stok_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tb_barang_list->ListOptions->render("body", "right", $tb_barang_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tb_barang->isGridAdd())
		$tb_barang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tb_barang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tb_barang_list->Recordset)
	$tb_barang_list->Recordset->Close();
?>
<?php if (!$tb_barang->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tb_barang->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tb_barang_list->Pager)) $tb_barang_list->Pager = new PrevNextPager($tb_barang_list->StartRec, $tb_barang_list->DisplayRecs, $tb_barang_list->TotalRecs, $tb_barang_list->AutoHidePager) ?>
<?php if ($tb_barang_list->Pager->RecordCount > 0 && $tb_barang_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tb_barang_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tb_barang_list->pageUrl() ?>start=<?php echo $tb_barang_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tb_barang_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tb_barang_list->pageUrl() ?>start=<?php echo $tb_barang_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tb_barang_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tb_barang_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tb_barang_list->pageUrl() ?>start=<?php echo $tb_barang_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tb_barang_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tb_barang_list->pageUrl() ?>start=<?php echo $tb_barang_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tb_barang_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tb_barang_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tb_barang_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tb_barang_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tb_barang_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tb_barang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tb_barang_list->TotalRecs == 0 && !$tb_barang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tb_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tb_barang_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_barang->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_barang_list->terminate();
?>