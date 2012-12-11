<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "yuimenubar yuimenubarnav", TRUE);
define("EW_MENUBAR_ITEM_CLASSNAME", "yuimenubaritem", TRUE);
define("EW_MENUBAR_ITEM_LABEL_CLASSNAME", "yuimenubaritemlabel", TRUE);
define("EW_MENU_CLASSNAME", "yuimenu", TRUE);
define("EW_MENU_ITEM_CLASSNAME", "yuimenuitem", TRUE); // Vertical
define("EW_MENU_ITEM_LABEL_CLASSNAME", "yuimenuitemlabel", TRUE); // Vertical
?>
<?php

// Menu Rendering event
function Menu_Rendering(&$Menu) {

	// Change menu items here
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "st_master_tingkatlist.php", 3, "", AllowListMenu('st_master_tingkat'), FALSE);
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "penggunalist.php", 3, "", AllowListMenu('pengguna'), FALSE);
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "st_master_pengajarlist.php", 3, "", AllowListMenu('st_master_pengajar'), FALSE);
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "master_siswalist.php", 3, "", AllowListMenu('master_siswa'), FALSE);
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "master_agamalist.php", 3, "", AllowListMenu('master_agama'), FALSE);
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "st_master_kelaslist.php", 3, "", AllowListMenu('st_master_kelas'), FALSE);
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "st_master_kelas_kelompoklist.php", 3, "", AllowListMenu('st_master_kelas_kelompok'), FALSE);
$RootMenu->AddMenuItem(313, $Language->MenuPhrase("313", "MenuText"), "pemilihan_kelasadd.php", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "keu_master_tanggunganlist.php", 3, "", AllowListMenu('keu_master_tanggungan'), FALSE);
$RootMenu->AddMenuItem(130, $Language->MenuPhrase("130", "MenuText"), "", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(131, $Language->MenuPhrase("131", "MenuText"), "tahap1add.php", 130, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(132, $Language->MenuPhrase("132", "MenuText"), "tahap22add.php", 130, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(133, $Language->MenuPhrase("133", "MenuText"), "tahap3add.php", 130, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(134, $Language->MenuPhrase("134", "MenuText"), "tahap4add.php", 130, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(190, $Language->MenuPhrase("190", "MenuText"), "tahap5add.php", 130, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(36, $Language->MenuPhrase("36", "MenuText"), "", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(41, $Language->MenuPhrase("41", "MenuText"), "pemilihan_jenis_biayaadd.php", 36, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(49, $Language->MenuPhrase("49", "MenuText"), "keu_laporan_keuanganlist.php", 36, "", AllowListMenu('keu_laporan_keuangan'), FALSE);
$RootMenu->AddMenuItem(246, $Language->MenuPhrase("246", "MenuText"), "master_transaksi2list.php", 36, "", AllowListMenu('master_transaksi2'), FALSE);
$RootMenu->AddMenuItem(245, $Language->MenuPhrase("245", "MenuText"), "", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(248, $Language->MenuPhrase("248", "MenuText"), "neraca2list.php", 245, "", AllowListMenu('neraca2'), FALSE);
$RootMenu->AddMenuItem(247, $Language->MenuPhrase("247", "MenuText"), "neraca_rugilabalist.php", 245, "", AllowListMenu('neraca_rugilaba'), FALSE);
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--

// init the menu
var RootMenu = new YAHOO.widget.MenuBar("RootMenu", { autosubmenudisplay: true, hidedelay: 750, lazyload: true });
RootMenu.render();        

//-->
</script>
