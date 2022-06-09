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
$v_lap_pembelian_list = new v_lap_pembelian_list();

// Run the page
$v_lap_pembelian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_lap_pembelian_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$v_lap_pembelian->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fv_lap_pembelianlist = currentForm = new ew.Form("fv_lap_pembelianlist", "list");
fv_lap_pembelianlist.formKeyCountName = '<?php echo $v_lap_pembelian_list->FormKeyCountName ?>';

// Form_CustomValidate event
fv_lap_pembelianlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fv_lap_pembelianlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fv_lap_pembelianlistsrch = currentSearchForm = new ew.Form("fv_lap_pembelianlistsrch");

// Filters
fv_lap_pembelianlistsrch.filterList = <?php echo $v_lap_pembelian_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$v_lap_pembelian->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_lap_pembelian_list->TotalRecs > 0 && $v_lap_pembelian_list->ExportOptions->visible()) { ?>
<?php $v_lap_pembelian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_pembelian_list->ImportOptions->visible()) { ?>
<?php $v_lap_pembelian_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_pembelian_list->SearchOptions->visible()) { ?>
<?php $v_lap_pembelian_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_pembelian_list->FilterOptions->visible()) { ?>
<?php $v_lap_pembelian_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_lap_pembelian_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_lap_pembelian->isExport() && !$v_lap_pembelian->CurrentAction) { ?>
<form name="fv_lap_pembelianlistsrch" id="fv_lap_pembelianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($v_lap_pembelian_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fv_lap_pembelianlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_lap_pembelian">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($v_lap_pembelian_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($v_lap_pembelian_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_lap_pembelian_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_lap_pembelian_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_lap_pembelian_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_lap_pembelian_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_lap_pembelian_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $v_lap_pembelian_list->showPageHeader(); ?>
<?php
$v_lap_pembelian_list->showMessage();
?>
<?php if ($v_lap_pembelian_list->TotalRecs > 0 || $v_lap_pembelian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_lap_pembelian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_lap_pembelian">
<form name="fv_lap_pembelianlist" id="fv_lap_pembelianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($v_lap_pembelian_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $v_lap_pembelian_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_lap_pembelian">
<div id="gmp_v_lap_pembelian" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($v_lap_pembelian_list->TotalRecs > 0 || $v_lap_pembelian->isGridEdit()) { ?>
<table id="tbl_v_lap_pembelianlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_lap_pembelian_list->RowType = ROWTYPE_HEADER;

// Render list options
$v_lap_pembelian_list->renderListOptions();

// Render list options (header, left)
$v_lap_pembelian_list->ListOptions->render("header", "left");
?>
<?php if ($v_lap_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->tgl_pembelian) == "") { ?>
		<th data-name="tgl_pembelian" class="<?php echo $v_lap_pembelian->tgl_pembelian->headerCellClass() ?>"><div id="elh_v_lap_pembelian_tgl_pembelian" class="v_lap_pembelian_tgl_pembelian"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->tgl_pembelian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_pembelian" class="<?php echo $v_lap_pembelian->tgl_pembelian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->tgl_pembelian) ?>',1);"><div id="elh_v_lap_pembelian_tgl_pembelian" class="v_lap_pembelian_tgl_pembelian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->tgl_pembelian->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->tgl_pembelian->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->tgl_pembelian->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_pembelian->kode_barang->Visible) { // kode_barang ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $v_lap_pembelian->kode_barang->headerCellClass() ?>"><div id="elh_v_lap_pembelian_kode_barang" class="v_lap_pembelian_kode_barang"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $v_lap_pembelian->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->kode_barang) ?>',1);"><div id="elh_v_lap_pembelian_kode_barang" class="v_lap_pembelian_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->kode_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->kode_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_pembelian->nama_barang->Visible) { // nama_barang ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $v_lap_pembelian->nama_barang->headerCellClass() ?>"><div id="elh_v_lap_pembelian_nama_barang" class="v_lap_pembelian_nama_barang"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $v_lap_pembelian->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->nama_barang) ?>',1);"><div id="elh_v_lap_pembelian_nama_barang" class="v_lap_pembelian_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->nama_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->nama_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_pembelian->nama_kategori->Visible) { // nama_kategori ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->nama_kategori) == "") { ?>
		<th data-name="nama_kategori" class="<?php echo $v_lap_pembelian->nama_kategori->headerCellClass() ?>"><div id="elh_v_lap_pembelian_nama_kategori" class="v_lap_pembelian_nama_kategori"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_kategori" class="<?php echo $v_lap_pembelian->nama_kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->nama_kategori) ?>',1);"><div id="elh_v_lap_pembelian_nama_kategori" class="v_lap_pembelian_nama_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_kategori->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->nama_kategori->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->nama_kategori->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_pembelian->nama_satuan->Visible) { // nama_satuan ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->nama_satuan) == "") { ?>
		<th data-name="nama_satuan" class="<?php echo $v_lap_pembelian->nama_satuan->headerCellClass() ?>"><div id="elh_v_lap_pembelian_nama_satuan" class="v_lap_pembelian_nama_satuan"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_satuan" class="<?php echo $v_lap_pembelian->nama_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->nama_satuan) ?>',1);"><div id="elh_v_lap_pembelian_nama_satuan" class="v_lap_pembelian_nama_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->nama_satuan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->nama_satuan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_pembelian->nama_vendor->Visible) { // nama_vendor ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->nama_vendor) == "") { ?>
		<th data-name="nama_vendor" class="<?php echo $v_lap_pembelian->nama_vendor->headerCellClass() ?>"><div id="elh_v_lap_pembelian_nama_vendor" class="v_lap_pembelian_nama_vendor"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_vendor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_vendor" class="<?php echo $v_lap_pembelian->nama_vendor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->nama_vendor) ?>',1);"><div id="elh_v_lap_pembelian_nama_vendor" class="v_lap_pembelian_nama_vendor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->nama_vendor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->nama_vendor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->nama_vendor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_pembelian->qty->Visible) { // qty ?>
	<?php if ($v_lap_pembelian->sortUrl($v_lap_pembelian->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $v_lap_pembelian->qty->headerCellClass() ?>"><div id="elh_v_lap_pembelian_qty" class="v_lap_pembelian_qty"><div class="ew-table-header-caption"><?php echo $v_lap_pembelian->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $v_lap_pembelian->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_pembelian->SortUrl($v_lap_pembelian->qty) ?>',1);"><div id="elh_v_lap_pembelian_qty" class="v_lap_pembelian_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_pembelian->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_lap_pembelian->qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_pembelian->qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_lap_pembelian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_lap_pembelian->ExportAll && $v_lap_pembelian->isExport()) {
	$v_lap_pembelian_list->StopRec = $v_lap_pembelian_list->TotalRecs;
} else {

	// Set the last record to display
	if ($v_lap_pembelian_list->TotalRecs > $v_lap_pembelian_list->StartRec + $v_lap_pembelian_list->DisplayRecs - 1)
		$v_lap_pembelian_list->StopRec = $v_lap_pembelian_list->StartRec + $v_lap_pembelian_list->DisplayRecs - 1;
	else
		$v_lap_pembelian_list->StopRec = $v_lap_pembelian_list->TotalRecs;
}
$v_lap_pembelian_list->RecCnt = $v_lap_pembelian_list->StartRec - 1;
if ($v_lap_pembelian_list->Recordset && !$v_lap_pembelian_list->Recordset->EOF) {
	$v_lap_pembelian_list->Recordset->moveFirst();
	$selectLimit = $v_lap_pembelian_list->UseSelectLimit;
	if (!$selectLimit && $v_lap_pembelian_list->StartRec > 1)
		$v_lap_pembelian_list->Recordset->move($v_lap_pembelian_list->StartRec - 1);
} elseif (!$v_lap_pembelian->AllowAddDeleteRow && $v_lap_pembelian_list->StopRec == 0) {
	$v_lap_pembelian_list->StopRec = $v_lap_pembelian->GridAddRowCount;
}

// Initialize aggregate
$v_lap_pembelian->RowType = ROWTYPE_AGGREGATEINIT;
$v_lap_pembelian->resetAttributes();
$v_lap_pembelian_list->renderRow();
while ($v_lap_pembelian_list->RecCnt < $v_lap_pembelian_list->StopRec) {
	$v_lap_pembelian_list->RecCnt++;
	if ($v_lap_pembelian_list->RecCnt >= $v_lap_pembelian_list->StartRec) {
		$v_lap_pembelian_list->RowCnt++;

		// Set up key count
		$v_lap_pembelian_list->KeyCount = $v_lap_pembelian_list->RowIndex;

		// Init row class and style
		$v_lap_pembelian->resetAttributes();
		$v_lap_pembelian->CssClass = "";
		if ($v_lap_pembelian->isGridAdd()) {
		} else {
			$v_lap_pembelian_list->loadRowValues($v_lap_pembelian_list->Recordset); // Load row values
		}
		$v_lap_pembelian->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_lap_pembelian->RowAttrs = array_merge($v_lap_pembelian->RowAttrs, array('data-rowindex'=>$v_lap_pembelian_list->RowCnt, 'id'=>'r' . $v_lap_pembelian_list->RowCnt . '_v_lap_pembelian', 'data-rowtype'=>$v_lap_pembelian->RowType));

		// Render row
		$v_lap_pembelian_list->renderRow();

		// Render list options
		$v_lap_pembelian_list->renderListOptions();
?>
	<tr<?php echo $v_lap_pembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_lap_pembelian_list->ListOptions->render("body", "left", $v_lap_pembelian_list->RowCnt);
?>
	<?php if ($v_lap_pembelian->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<td data-name="tgl_pembelian"<?php echo $v_lap_pembelian->tgl_pembelian->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_tgl_pembelian" class="v_lap_pembelian_tgl_pembelian">
<span<?php echo $v_lap_pembelian->tgl_pembelian->viewAttributes() ?>>
<?php echo $v_lap_pembelian->tgl_pembelian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_pembelian->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang"<?php echo $v_lap_pembelian->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_kode_barang" class="v_lap_pembelian_kode_barang">
<span<?php echo $v_lap_pembelian->kode_barang->viewAttributes() ?>>
<?php echo $v_lap_pembelian->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_pembelian->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang"<?php echo $v_lap_pembelian->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_nama_barang" class="v_lap_pembelian_nama_barang">
<span<?php echo $v_lap_pembelian->nama_barang->viewAttributes() ?>>
<?php echo $v_lap_pembelian->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_pembelian->nama_kategori->Visible) { // nama_kategori ?>
		<td data-name="nama_kategori"<?php echo $v_lap_pembelian->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_nama_kategori" class="v_lap_pembelian_nama_kategori">
<span<?php echo $v_lap_pembelian->nama_kategori->viewAttributes() ?>>
<?php echo $v_lap_pembelian->nama_kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_pembelian->nama_satuan->Visible) { // nama_satuan ?>
		<td data-name="nama_satuan"<?php echo $v_lap_pembelian->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_nama_satuan" class="v_lap_pembelian_nama_satuan">
<span<?php echo $v_lap_pembelian->nama_satuan->viewAttributes() ?>>
<?php echo $v_lap_pembelian->nama_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_pembelian->nama_vendor->Visible) { // nama_vendor ?>
		<td data-name="nama_vendor"<?php echo $v_lap_pembelian->nama_vendor->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_nama_vendor" class="v_lap_pembelian_nama_vendor">
<span<?php echo $v_lap_pembelian->nama_vendor->viewAttributes() ?>>
<?php echo $v_lap_pembelian->nama_vendor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_pembelian->qty->Visible) { // qty ?>
		<td data-name="qty"<?php echo $v_lap_pembelian->qty->cellAttributes() ?>>
<span id="el<?php echo $v_lap_pembelian_list->RowCnt ?>_v_lap_pembelian_qty" class="v_lap_pembelian_qty">
<span<?php echo $v_lap_pembelian->qty->viewAttributes() ?>>
<?php echo $v_lap_pembelian->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_lap_pembelian_list->ListOptions->render("body", "right", $v_lap_pembelian_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$v_lap_pembelian->isGridAdd())
		$v_lap_pembelian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$v_lap_pembelian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_lap_pembelian_list->Recordset)
	$v_lap_pembelian_list->Recordset->Close();
?>
<?php if (!$v_lap_pembelian->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_lap_pembelian->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($v_lap_pembelian_list->Pager)) $v_lap_pembelian_list->Pager = new PrevNextPager($v_lap_pembelian_list->StartRec, $v_lap_pembelian_list->DisplayRecs, $v_lap_pembelian_list->TotalRecs, $v_lap_pembelian_list->AutoHidePager) ?>
<?php if ($v_lap_pembelian_list->Pager->RecordCount > 0 && $v_lap_pembelian_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($v_lap_pembelian_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $v_lap_pembelian_list->pageUrl() ?>start=<?php echo $v_lap_pembelian_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($v_lap_pembelian_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $v_lap_pembelian_list->pageUrl() ?>start=<?php echo $v_lap_pembelian_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $v_lap_pembelian_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($v_lap_pembelian_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $v_lap_pembelian_list->pageUrl() ?>start=<?php echo $v_lap_pembelian_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($v_lap_pembelian_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $v_lap_pembelian_list->pageUrl() ?>start=<?php echo $v_lap_pembelian_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v_lap_pembelian_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($v_lap_pembelian_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v_lap_pembelian_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v_lap_pembelian_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v_lap_pembelian_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_lap_pembelian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_lap_pembelian_list->TotalRecs == 0 && !$v_lap_pembelian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_lap_pembelian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_lap_pembelian_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$v_lap_pembelian->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$v_lap_pembelian_list->terminate();
?>