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
$tb_user_list = new tb_user_list();

// Run the page
$tb_user_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tb_user_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tb_user->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftb_userlist = currentForm = new ew.Form("ftb_userlist", "list");
ftb_userlist.formKeyCountName = '<?php echo $tb_user_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftb_userlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftb_userlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftb_userlistsrch = currentSearchForm = new ew.Form("ftb_userlistsrch");

// Filters
ftb_userlistsrch.filterList = <?php echo $tb_user_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tb_user->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tb_user_list->TotalRecs > 0 && $tb_user_list->ExportOptions->visible()) { ?>
<?php $tb_user_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_user_list->ImportOptions->visible()) { ?>
<?php $tb_user_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tb_user_list->SearchOptions->visible()) { ?>
<?php $tb_user_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tb_user_list->FilterOptions->visible()) { ?>
<?php $tb_user_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tb_user_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tb_user->isExport() && !$tb_user->CurrentAction) { ?>
<form name="ftb_userlistsrch" id="ftb_userlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tb_user_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftb_userlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_user">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tb_user_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tb_user_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tb_user_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tb_user_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tb_user_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tb_user_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tb_user_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tb_user_list->showPageHeader(); ?>
<?php
$tb_user_list->showMessage();
?>
<?php if ($tb_user_list->TotalRecs > 0 || $tb_user->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tb_user_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_user">
<form name="ftb_userlist" id="ftb_userlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tb_user_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tb_user_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tb_user">
<div id="gmp_tb_user" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tb_user_list->TotalRecs > 0 || $tb_user->isGridEdit()) { ?>
<table id="tbl_tb_userlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tb_user_list->RowType = ROWTYPE_HEADER;

// Render list options
$tb_user_list->renderListOptions();

// Render list options (header, left)
$tb_user_list->ListOptions->render("header", "left");
?>
<?php if ($tb_user->id_user->Visible) { // id_user ?>
	<?php if ($tb_user->sortUrl($tb_user->id_user) == "") { ?>
		<th data-name="id_user" class="<?php echo $tb_user->id_user->headerCellClass() ?>"><div id="elh_tb_user_id_user" class="tb_user_id_user"><div class="ew-table-header-caption"><?php echo $tb_user->id_user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_user" class="<?php echo $tb_user->id_user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_user->SortUrl($tb_user->id_user) ?>',1);"><div id="elh_tb_user_id_user" class="tb_user_id_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_user->id_user->caption() ?></span><span class="ew-table-header-sort"><?php if ($tb_user->id_user->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_user->id_user->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_user->username->Visible) { // username ?>
	<?php if ($tb_user->sortUrl($tb_user->username) == "") { ?>
		<th data-name="username" class="<?php echo $tb_user->username->headerCellClass() ?>"><div id="elh_tb_user_username" class="tb_user_username"><div class="ew-table-header-caption"><?php echo $tb_user->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $tb_user->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_user->SortUrl($tb_user->username) ?>',1);"><div id="elh_tb_user_username" class="tb_user_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_user->username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_user->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_user->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tb_user->password->Visible) { // password ?>
	<?php if ($tb_user->sortUrl($tb_user->password) == "") { ?>
		<th data-name="password" class="<?php echo $tb_user->password->headerCellClass() ?>"><div id="elh_tb_user_password" class="tb_user_password"><div class="ew-table-header-caption"><?php echo $tb_user->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $tb_user->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tb_user->SortUrl($tb_user->password) ?>',1);"><div id="elh_tb_user_password" class="tb_user_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tb_user->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tb_user->password->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tb_user->password->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tb_user_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tb_user->ExportAll && $tb_user->isExport()) {
	$tb_user_list->StopRec = $tb_user_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tb_user_list->TotalRecs > $tb_user_list->StartRec + $tb_user_list->DisplayRecs - 1)
		$tb_user_list->StopRec = $tb_user_list->StartRec + $tb_user_list->DisplayRecs - 1;
	else
		$tb_user_list->StopRec = $tb_user_list->TotalRecs;
}
$tb_user_list->RecCnt = $tb_user_list->StartRec - 1;
if ($tb_user_list->Recordset && !$tb_user_list->Recordset->EOF) {
	$tb_user_list->Recordset->moveFirst();
	$selectLimit = $tb_user_list->UseSelectLimit;
	if (!$selectLimit && $tb_user_list->StartRec > 1)
		$tb_user_list->Recordset->move($tb_user_list->StartRec - 1);
} elseif (!$tb_user->AllowAddDeleteRow && $tb_user_list->StopRec == 0) {
	$tb_user_list->StopRec = $tb_user->GridAddRowCount;
}

// Initialize aggregate
$tb_user->RowType = ROWTYPE_AGGREGATEINIT;
$tb_user->resetAttributes();
$tb_user_list->renderRow();
while ($tb_user_list->RecCnt < $tb_user_list->StopRec) {
	$tb_user_list->RecCnt++;
	if ($tb_user_list->RecCnt >= $tb_user_list->StartRec) {
		$tb_user_list->RowCnt++;

		// Set up key count
		$tb_user_list->KeyCount = $tb_user_list->RowIndex;

		// Init row class and style
		$tb_user->resetAttributes();
		$tb_user->CssClass = "";
		if ($tb_user->isGridAdd()) {
		} else {
			$tb_user_list->loadRowValues($tb_user_list->Recordset); // Load row values
		}
		$tb_user->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tb_user->RowAttrs = array_merge($tb_user->RowAttrs, array('data-rowindex'=>$tb_user_list->RowCnt, 'id'=>'r' . $tb_user_list->RowCnt . '_tb_user', 'data-rowtype'=>$tb_user->RowType));

		// Render row
		$tb_user_list->renderRow();

		// Render list options
		$tb_user_list->renderListOptions();
?>
	<tr<?php echo $tb_user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tb_user_list->ListOptions->render("body", "left", $tb_user_list->RowCnt);
?>
	<?php if ($tb_user->id_user->Visible) { // id_user ?>
		<td data-name="id_user"<?php echo $tb_user->id_user->cellAttributes() ?>>
<span id="el<?php echo $tb_user_list->RowCnt ?>_tb_user_id_user" class="tb_user_id_user">
<span<?php echo $tb_user->id_user->viewAttributes() ?>>
<?php echo $tb_user->id_user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_user->username->Visible) { // username ?>
		<td data-name="username"<?php echo $tb_user->username->cellAttributes() ?>>
<span id="el<?php echo $tb_user_list->RowCnt ?>_tb_user_username" class="tb_user_username">
<span<?php echo $tb_user->username->viewAttributes() ?>>
<?php echo $tb_user->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tb_user->password->Visible) { // password ?>
		<td data-name="password"<?php echo $tb_user->password->cellAttributes() ?>>
<span id="el<?php echo $tb_user_list->RowCnt ?>_tb_user_password" class="tb_user_password">
<span<?php echo $tb_user->password->viewAttributes() ?>>
<?php echo $tb_user->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tb_user_list->ListOptions->render("body", "right", $tb_user_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tb_user->isGridAdd())
		$tb_user_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tb_user->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tb_user_list->Recordset)
	$tb_user_list->Recordset->Close();
?>
<?php if (!$tb_user->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tb_user->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tb_user_list->Pager)) $tb_user_list->Pager = new PrevNextPager($tb_user_list->StartRec, $tb_user_list->DisplayRecs, $tb_user_list->TotalRecs, $tb_user_list->AutoHidePager) ?>
<?php if ($tb_user_list->Pager->RecordCount > 0 && $tb_user_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tb_user_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tb_user_list->pageUrl() ?>start=<?php echo $tb_user_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tb_user_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tb_user_list->pageUrl() ?>start=<?php echo $tb_user_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tb_user_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tb_user_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tb_user_list->pageUrl() ?>start=<?php echo $tb_user_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tb_user_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tb_user_list->pageUrl() ?>start=<?php echo $tb_user_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tb_user_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tb_user_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tb_user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tb_user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tb_user_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tb_user_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tb_user_list->TotalRecs == 0 && !$tb_user->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tb_user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tb_user_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tb_user->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tb_user_list->terminate();
?>