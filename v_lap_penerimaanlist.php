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
$v_lap_penerimaan_list = new v_lap_penerimaan_list();

// Run the page
$v_lap_penerimaan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_lap_penerimaan_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$v_lap_penerimaan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fv_lap_penerimaanlist = currentForm = new ew.Form("fv_lap_penerimaanlist", "list");
fv_lap_penerimaanlist.formKeyCountName = '<?php echo $v_lap_penerimaan_list->FormKeyCountName ?>';

// Form_CustomValidate event
fv_lap_penerimaanlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fv_lap_penerimaanlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fv_lap_penerimaanlistsrch = currentSearchForm = new ew.Form("fv_lap_penerimaanlistsrch");

// Validate function for search
fv_lap_penerimaanlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_tgl_penerimaan");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($v_lap_penerimaan->tgl_penerimaan->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fv_lap_penerimaanlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fv_lap_penerimaanlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Filters

fv_lap_penerimaanlistsrch.filterList = <?php echo $v_lap_penerimaan_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$v_lap_penerimaan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_lap_penerimaan_list->TotalRecs > 0 && $v_lap_penerimaan_list->ExportOptions->visible()) { ?>
<?php $v_lap_penerimaan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_penerimaan_list->ImportOptions->visible()) { ?>
<?php $v_lap_penerimaan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_penerimaan_list->SearchOptions->visible()) { ?>
<?php $v_lap_penerimaan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_penerimaan_list->FilterOptions->visible()) { ?>
<?php $v_lap_penerimaan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_lap_penerimaan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_lap_penerimaan->isExport() && !$v_lap_penerimaan->CurrentAction) { ?>
<form name="fv_lap_penerimaanlistsrch" id="fv_lap_penerimaanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($v_lap_penerimaan_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fv_lap_penerimaanlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_lap_penerimaan">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$v_lap_penerimaan_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$v_lap_penerimaan->RowType = ROWTYPE_SEARCH;

// Render row
$v_lap_penerimaan->resetAttributes();
$v_lap_penerimaan_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($v_lap_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
	<div id="xsc_tgl_penerimaan" class="ew-cell form-group">
	
		<span class="ew-search-operator"><?php echo $Language->phrase("") ?><input type="hidden" name="z_tgl_penerimaan" id="z_tgl_penerimaan" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="v_lap_penerimaan" data-field="x_tgl_penerimaan" name="x_tgl_penerimaan" id="x_tgl_penerimaan" placeholder="<?php echo HtmlEncode($v_lap_penerimaan->tgl_penerimaan->getPlaceHolder()) ?>" value="<?php echo $v_lap_penerimaan->tgl_penerimaan->EditValue ?>"<?php echo $v_lap_penerimaan->tgl_penerimaan->editAttributes() ?>>
<?php if (!$v_lap_penerimaan->tgl_penerimaan->ReadOnly && !$v_lap_penerimaan->tgl_penerimaan->Disabled && !isset($v_lap_penerimaan->tgl_penerimaan->EditAttrs["readonly"]) && !isset($v_lap_penerimaan->tgl_penerimaan->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fv_lap_penerimaanlistsrch", "x_tgl_penerimaan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_tgl_penerimaan"><label><?php echo $Language->Phrase("s.d") ?></label></span>
		<span class="ew-search-field btw1_tgl_penerimaan">
<input type="text" data-table="v_lap_penerimaan" data-field="x_tgl_penerimaan" name="y_tgl_penerimaan" id="y_tgl_penerimaan" placeholder="<?php echo HtmlEncode($v_lap_penerimaan->tgl_penerimaan->getPlaceHolder()) ?>" value="<?php echo $v_lap_penerimaan->tgl_penerimaan->EditValue2 ?>"<?php echo $v_lap_penerimaan->tgl_penerimaan->editAttributes() ?>>
<?php if (!$v_lap_penerimaan->tgl_penerimaan->ReadOnly && !$v_lap_penerimaan->tgl_penerimaan->Disabled && !isset($v_lap_penerimaan->tgl_penerimaan->EditAttrs["readonly"]) && !isset($v_lap_penerimaan->tgl_penerimaan->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fv_lap_penerimaanlistsrch", "y_tgl_penerimaan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($v_lap_penerimaan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Pencarian Pengambilan Barang")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($v_lap_penerimaan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("Cari") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_lap_penerimaan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_lap_penerimaan_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_lap_penerimaan_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_lap_penerimaan_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_lap_penerimaan_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $v_lap_penerimaan_list->showPageHeader(); ?>
<?php
$v_lap_penerimaan_list->showMessage();
?>
<?php if ($v_lap_penerimaan_list->TotalRecs > 0 || $v_lap_penerimaan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_lap_penerimaan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_lap_penerimaan">
<form name="fv_lap_penerimaanlist" id="fv_lap_penerimaanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($v_lap_penerimaan_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $v_lap_penerimaan_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_lap_penerimaan">
<div id="gmp_v_lap_penerimaan" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($v_lap_penerimaan_list->TotalRecs > 0 || $v_lap_penerimaan->isGridEdit()) { ?>
<table id="tbl_v_lap_penerimaanlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_lap_penerimaan_list->RowType = ROWTYPE_HEADER;

// Render list options
$v_lap_penerimaan_list->renderListOptions();

// Render list options (header, left)
$v_lap_penerimaan_list->ListOptions->render("header", "left");
?>
<?php if ($v_lap_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->tgl_penerimaan) == "") { ?>
		<th data-name="tgl_penerimaan" class="<?php echo $v_lap_penerimaan->tgl_penerimaan->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_tgl_penerimaan" class="v_lap_penerimaan_tgl_penerimaan"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->tgl_penerimaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_penerimaan" class="<?php echo $v_lap_penerimaan->tgl_penerimaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->tgl_penerimaan) ?>',1);"><div id="elh_v_lap_penerimaan_tgl_penerimaan" class="v_lap_penerimaan_tgl_penerimaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->tgl_penerimaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->tgl_penerimaan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->tgl_penerimaan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->kd_penerimaan) == "") { ?>
		<th data-name="kd_penerimaan" class="<?php echo $v_lap_penerimaan->kd_penerimaan->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_kd_penerimaan" class="v_lap_penerimaan_kd_penerimaan"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->kd_penerimaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kd_penerimaan" class="<?php echo $v_lap_penerimaan->kd_penerimaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->kd_penerimaan) ?>',1);"><div id="elh_v_lap_penerimaan_kd_penerimaan" class="v_lap_penerimaan_kd_penerimaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->kd_penerimaan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->kd_penerimaan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->kd_penerimaan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->nama_penerima->Visible) { // nama_penerima ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->nama_penerima) == "") { ?>
		<th data-name="nama_penerima" class="<?php echo $v_lap_penerimaan->nama_penerima->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_nama_penerima" class="v_lap_penerimaan_nama_penerima"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_penerima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_penerima" class="<?php echo $v_lap_penerimaan->nama_penerima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->nama_penerima) ?>',1);"><div id="elh_v_lap_penerimaan_nama_penerima" class="v_lap_penerimaan_nama_penerima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_penerima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->nama_penerima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->nama_penerima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->nama_unit->Visible) { // nama_unit ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->nama_unit) == "") { ?>
		<th data-name="nama_unit" class="<?php echo $v_lap_penerimaan->nama_unit->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_nama_unit" class="v_lap_penerimaan_nama_unit"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_unit" class="<?php echo $v_lap_penerimaan->nama_unit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->nama_unit) ?>',1);"><div id="elh_v_lap_penerimaan_nama_unit" class="v_lap_penerimaan_nama_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_unit->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->nama_unit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->nama_unit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->kode_barang->Visible) { // kode_barang ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $v_lap_penerimaan->kode_barang->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_kode_barang" class="v_lap_penerimaan_kode_barang"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $v_lap_penerimaan->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->kode_barang) ?>',1);"><div id="elh_v_lap_penerimaan_kode_barang" class="v_lap_penerimaan_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->kode_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->kode_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->nama_barang->Visible) { // nama_barang ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $v_lap_penerimaan->nama_barang->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_nama_barang" class="v_lap_penerimaan_nama_barang"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $v_lap_penerimaan->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->nama_barang) ?>',1);"><div id="elh_v_lap_penerimaan_nama_barang" class="v_lap_penerimaan_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->nama_barang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->nama_barang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->nama_kategori->Visible) { // nama_kategori ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->nama_kategori) == "") { ?>
		<th data-name="nama_kategori" class="<?php echo $v_lap_penerimaan->nama_kategori->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_nama_kategori" class="v_lap_penerimaan_nama_kategori"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_kategori" class="<?php echo $v_lap_penerimaan->nama_kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->nama_kategori) ?>',1);"><div id="elh_v_lap_penerimaan_nama_kategori" class="v_lap_penerimaan_nama_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_kategori->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->nama_kategori->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->nama_kategori->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->qty->Visible) { // qty ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $v_lap_penerimaan->qty->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_qty" class="v_lap_penerimaan_qty"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $v_lap_penerimaan->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->qty) ?>',1);"><div id="elh_v_lap_penerimaan_qty" class="v_lap_penerimaan_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_penerimaan->nama_satuan->Visible) { // nama_satuan ?>
	<?php if ($v_lap_penerimaan->sortUrl($v_lap_penerimaan->nama_satuan) == "") { ?>
		<th data-name="nama_satuan" class="<?php echo $v_lap_penerimaan->nama_satuan->headerCellClass() ?>"><div id="elh_v_lap_penerimaan_nama_satuan" class="v_lap_penerimaan_nama_satuan"><div class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_satuan" class="<?php echo $v_lap_penerimaan->nama_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $v_lap_penerimaan->SortUrl($v_lap_penerimaan->nama_satuan) ?>',1);"><div id="elh_v_lap_penerimaan_nama_satuan" class="v_lap_penerimaan_nama_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_penerimaan->nama_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_penerimaan->nama_satuan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($v_lap_penerimaan->nama_satuan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_lap_penerimaan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_lap_penerimaan->ExportAll && $v_lap_penerimaan->isExport()) {
	$v_lap_penerimaan_list->StopRec = $v_lap_penerimaan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($v_lap_penerimaan_list->TotalRecs > $v_lap_penerimaan_list->StartRec + $v_lap_penerimaan_list->DisplayRecs - 1)
		$v_lap_penerimaan_list->StopRec = $v_lap_penerimaan_list->StartRec + $v_lap_penerimaan_list->DisplayRecs - 1;
	else
		$v_lap_penerimaan_list->StopRec = $v_lap_penerimaan_list->TotalRecs;
}
$v_lap_penerimaan_list->RecCnt = $v_lap_penerimaan_list->StartRec - 1;
if ($v_lap_penerimaan_list->Recordset && !$v_lap_penerimaan_list->Recordset->EOF) {
	$v_lap_penerimaan_list->Recordset->moveFirst();
	$selectLimit = $v_lap_penerimaan_list->UseSelectLimit;
	if (!$selectLimit && $v_lap_penerimaan_list->StartRec > 1)
		$v_lap_penerimaan_list->Recordset->move($v_lap_penerimaan_list->StartRec - 1);
} elseif (!$v_lap_penerimaan->AllowAddDeleteRow && $v_lap_penerimaan_list->StopRec == 0) {
	$v_lap_penerimaan_list->StopRec = $v_lap_penerimaan->GridAddRowCount;
}

// Initialize aggregate
$v_lap_penerimaan->RowType = ROWTYPE_AGGREGATEINIT;
$v_lap_penerimaan->resetAttributes();
$v_lap_penerimaan_list->renderRow();
while ($v_lap_penerimaan_list->RecCnt < $v_lap_penerimaan_list->StopRec) {
	$v_lap_penerimaan_list->RecCnt++;
	if ($v_lap_penerimaan_list->RecCnt >= $v_lap_penerimaan_list->StartRec) {
		$v_lap_penerimaan_list->RowCnt++;

		// Set up key count
		$v_lap_penerimaan_list->KeyCount = $v_lap_penerimaan_list->RowIndex;

		// Init row class and style
		$v_lap_penerimaan->resetAttributes();
		$v_lap_penerimaan->CssClass = "";
		if ($v_lap_penerimaan->isGridAdd()) {
		} else {
			$v_lap_penerimaan_list->loadRowValues($v_lap_penerimaan_list->Recordset); // Load row values
		}
		$v_lap_penerimaan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_lap_penerimaan->RowAttrs = array_merge($v_lap_penerimaan->RowAttrs, array('data-rowindex'=>$v_lap_penerimaan_list->RowCnt, 'id'=>'r' . $v_lap_penerimaan_list->RowCnt . '_v_lap_penerimaan', 'data-rowtype'=>$v_lap_penerimaan->RowType));

		// Render row
		$v_lap_penerimaan_list->renderRow();

		// Render list options
		$v_lap_penerimaan_list->renderListOptions();
?>
	<tr<?php echo $v_lap_penerimaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_lap_penerimaan_list->ListOptions->render("body", "left", $v_lap_penerimaan_list->RowCnt);
?>
	<?php if ($v_lap_penerimaan->tgl_penerimaan->Visible) { // tgl_penerimaan ?>
		<td data-name="tgl_penerimaan"<?php echo $v_lap_penerimaan->tgl_penerimaan->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_tgl_penerimaan" class="v_lap_penerimaan_tgl_penerimaan">
<span<?php echo $v_lap_penerimaan->tgl_penerimaan->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->tgl_penerimaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->kd_penerimaan->Visible) { // kd_penerimaan ?>
		<td data-name="kd_penerimaan"<?php echo $v_lap_penerimaan->kd_penerimaan->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_kd_penerimaan" class="v_lap_penerimaan_kd_penerimaan">
<span<?php echo $v_lap_penerimaan->kd_penerimaan->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->kd_penerimaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->nama_penerima->Visible) { // nama_penerima ?>
		<td data-name="nama_penerima"<?php echo $v_lap_penerimaan->nama_penerima->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_nama_penerima" class="v_lap_penerimaan_nama_penerima">
<span<?php echo $v_lap_penerimaan->nama_penerima->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->nama_penerima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->nama_unit->Visible) { // nama_unit ?>
		<td data-name="nama_unit"<?php echo $v_lap_penerimaan->nama_unit->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_nama_unit" class="v_lap_penerimaan_nama_unit">
<span<?php echo $v_lap_penerimaan->nama_unit->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->nama_unit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang"<?php echo $v_lap_penerimaan->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_kode_barang" class="v_lap_penerimaan_kode_barang">
<span<?php echo $v_lap_penerimaan->kode_barang->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang"<?php echo $v_lap_penerimaan->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_nama_barang" class="v_lap_penerimaan_nama_barang">
<span<?php echo $v_lap_penerimaan->nama_barang->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->nama_kategori->Visible) { // nama_kategori ?>
		<td data-name="nama_kategori"<?php echo $v_lap_penerimaan->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_nama_kategori" class="v_lap_penerimaan_nama_kategori">
<span<?php echo $v_lap_penerimaan->nama_kategori->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->nama_kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->qty->Visible) { // qty ?>
		<td data-name="qty"<?php echo $v_lap_penerimaan->qty->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_qty" class="v_lap_penerimaan_qty">
<span<?php echo $v_lap_penerimaan->qty->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_penerimaan->nama_satuan->Visible) { // nama_satuan ?>
		<td data-name="nama_satuan"<?php echo $v_lap_penerimaan->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $v_lap_penerimaan_list->RowCnt ?>_v_lap_penerimaan_nama_satuan" class="v_lap_penerimaan_nama_satuan">
<span<?php echo $v_lap_penerimaan->nama_satuan->viewAttributes() ?>>
<?php echo $v_lap_penerimaan->nama_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_lap_penerimaan_list->ListOptions->render("body", "right", $v_lap_penerimaan_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$v_lap_penerimaan->isGridAdd())
		$v_lap_penerimaan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$v_lap_penerimaan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_lap_penerimaan_list->Recordset)
	$v_lap_penerimaan_list->Recordset->Close();
?>
<?php if (!$v_lap_penerimaan->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_lap_penerimaan->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($v_lap_penerimaan_list->Pager)) $v_lap_penerimaan_list->Pager = new PrevNextPager($v_lap_penerimaan_list->StartRec, $v_lap_penerimaan_list->DisplayRecs, $v_lap_penerimaan_list->TotalRecs, $v_lap_penerimaan_list->AutoHidePager) ?>
<?php if ($v_lap_penerimaan_list->Pager->RecordCount > 0 && $v_lap_penerimaan_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($v_lap_penerimaan_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $v_lap_penerimaan_list->pageUrl() ?>start=<?php echo $v_lap_penerimaan_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($v_lap_penerimaan_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $v_lap_penerimaan_list->pageUrl() ?>start=<?php echo $v_lap_penerimaan_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $v_lap_penerimaan_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($v_lap_penerimaan_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $v_lap_penerimaan_list->pageUrl() ?>start=<?php echo $v_lap_penerimaan_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($v_lap_penerimaan_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $v_lap_penerimaan_list->pageUrl() ?>start=<?php echo $v_lap_penerimaan_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v_lap_penerimaan_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($v_lap_penerimaan_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v_lap_penerimaan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v_lap_penerimaan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v_lap_penerimaan_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_lap_penerimaan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_lap_penerimaan_list->TotalRecs == 0 && !$v_lap_penerimaan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_lap_penerimaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_lap_penerimaan_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$v_lap_penerimaan->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$v_lap_penerimaan_list->terminate();
?>