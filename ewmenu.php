<?php
namespace PHPMaker2019\project4;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(7, "mi_trx_penerimaan", $MenuLanguage->MenuPhrase("7", "MenuText"), "trx_penerimaanlist.php", -1, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}trx_penerimaan'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_trx_penerimaan_detail", $MenuLanguage->MenuPhrase("10", "MenuText"), "trx_penerimaan_detaillist.php?cmd=resetall", 7, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}trx_penerimaan_detail'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_tb_penerima", $MenuLanguage->MenuPhrase("3", "MenuText"), "tb_penerimalist.php", 7, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_penerima'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_tb_unitkerja", $MenuLanguage->MenuPhrase("5", "MenuText"), "tb_unitkerjalist.php", 7, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_unitkerja'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_trx_pembelian", $MenuLanguage->MenuPhrase("6", "MenuText"), "trx_pembelianlist.php", -1, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}trx_pembelian'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_trx_pembelian_detail", $MenuLanguage->MenuPhrase("9", "MenuText"), "trx_pembelian_detaillist.php?cmd=resetall", 6, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}trx_pembelian_detail'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_tb_vendor", $MenuLanguage->MenuPhrase("8", "MenuText"), "tb_vendorlist.php", 6, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_vendor'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(1, "mi_tb_barang", $MenuLanguage->MenuPhrase("1", "MenuText"), "tb_baranglist.php", -1, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_barang'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_tb_satuan", $MenuLanguage->MenuPhrase("4", "MenuText"), "tb_satuanlist.php", 1, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_satuan'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_tb_kategori", $MenuLanguage->MenuPhrase("2", "MenuText"), "tb_kategorilist.php", 1, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_kategori'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mci_Laporan", $MenuLanguage->MenuPhrase("20", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_v_stok", $MenuLanguage->MenuPhrase("11", "MenuText"), "v_stoklist.php", 20, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}v_stok'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(27, "mi_v_lap_pembelian", $MenuLanguage->MenuPhrase("27", "MenuText"), "v_lap_pembelianlist.php", 20, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}v_lap_pembelian'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(28, "mi_v_lap_penerimaan", $MenuLanguage->MenuPhrase("28", "MenuText"), "v_lap_penerimaanlist.php", 20, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}v_lap_penerimaan'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(25, "mi_tb_user", $MenuLanguage->MenuPhrase("25", "MenuText"), "tb_userlist.php", -1, "", IsLoggedIn() || AllowListMenu('{67EA411E-68CD-4417-BBD3-7C9FD30B9B35}tb_user'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>