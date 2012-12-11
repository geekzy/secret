<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (pengguna)
		if (!isset($GLOBALS["pengguna"])) $GLOBALS["pengguna"] = new cpengguna;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $pengguna;

		// Security
		$Security = new cAdvancedSecurity();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('st_master_kelas_kelompok'))
		$this->Page_Terminate("st_master_kelas_kelompoklist.php"); // Exit and go to default page
		if ($Security->AllowList('keu_cicilan'))
			$this->Page_Terminate("keu_cicilanlist.php");
		if ($Security->AllowList('keu_master_tanggungan'))
			$this->Page_Terminate("keu_master_tanggunganlist.php");
		if ($Security->AllowList('keu_tanggungan'))
			$this->Page_Terminate("keu_tanggunganlist.php");
		if ($Security->AllowList('pengguna'))
			$this->Page_Terminate("penggunalist.php");
		if ($Security->AllowList('pokokrek'))
			$this->Page_Terminate("pokokreklist.php");
		if ($Security->AllowList('rekap_kirim'))
			$this->Page_Terminate("rekap_kirimlist.php");
		if ($Security->AllowList('rekening2'))
			$this->Page_Terminate("rekening2list.php");
		if ($Security->AllowList('rekeningju'))
			$this->Page_Terminate("rekeningjulist.php");
		if ($Security->AllowList('sch_master_lembaga'))
			$this->Page_Terminate("sch_master_lembagalist.php");
		if ($Security->AllowList('st_krs_masal'))
			$this->Page_Terminate("st_krs_masallist.php");
		if ($Security->AllowList('st_master_kelas'))
			$this->Page_Terminate("st_master_kelaslist.php");
		if ($Security->AllowList('st_master_tingkat'))
			$this->Page_Terminate("st_master_tingkatlist.php");
		if ($Security->AllowList('st_peserta_kelas_kelompok'))
			$this->Page_Terminate("st_peserta_kelas_kelompoklist.php");
		if ($Security->AllowList('st_umum'))
			$this->Page_Terminate("st_umumlist.php");
		if ($Security->AllowList('subduarek'))
			$this->Page_Terminate("subduareklist.php");
		if ($Security->AllowList('subsaturek'))
			$this->Page_Terminate("subsatureklist.php");
		if ($Security->AllowList('subtigarek'))
			$this->Page_Terminate("subtigareklist.php");
		if ($Security->AllowList('st_master_pengajar'))
			$this->Page_Terminate("st_master_pengajarlist.php");
		if ($Security->AllowList('master_siswa'))
			$this->Page_Terminate("master_siswalist.php");
		if ($Security->AllowList('master_agama'))
			$this->Page_Terminate("master_agamalist.php");
		if ($Security->AllowList('keu_laporan_keuangan'))
			$this->Page_Terminate("keu_laporan_keuanganlist.php");
		if ($Security->AllowList('pemilihan_pokok'))
			$this->Page_Terminate("pemilihan_pokoklist.php");
		if ($Security->AllowList('tahap22'))
			$this->Page_Terminate("tahap22list.php");
		if ($Security->AllowList('neraca1'))
			$this->Page_Terminate("neraca1list.php");
		if ($Security->AllowList('master_transaksi2'))
			$this->Page_Terminate("master_transaksi2list.php");
		if ($Security->AllowList('neraca_rugilaba'))
			$this->Page_Terminate("neraca_rugilabalist.php");
		if ($Security->AllowList('neraca2'))
			$this->Page_Terminate("neraca2list.php");
		if ($Security->AllowList('saldo_rugilaba'))
			$this->Page_Terminate("saldo_rugilabalist.php");
		if ($Security->AllowList('entri_tanggungan_perkelompok'))
			$this->Page_Terminate("entri_tanggungan_perkelompoklist.php");
		if ($Security->AllowList('view_peserta'))
			$this->Page_Terminate("view_pesertalist.php");
		if ($Security->AllowList('pemilihan_jenis_biaya'))
			$this->Page_Terminate("pemilihan_jenis_biayalist.php");
		if ($Security->AllowList('lihat_peserta_kelompok'))
			$this->Page_Terminate("lihat_peserta_kelompoklist.php");
		if ($Security->AllowList('tahap1'))
			$this->Page_Terminate("tahap1list.php");
		if ($Security->AllowList('tahap3'))
			$this->Page_Terminate("tahap3list.php");
		if ($Security->AllowList('tahap4'))
			$this->Page_Terminate("tahap4list.php");
		if ($Security->AllowList('tahap5'))
			$this->Page_Terminate("tahap5list.php");
		if ($Security->AllowList('uji'))
			$this->Page_Terminate("ujilist.php");
		if ($Security->AllowList('pemilihan_kelas'))
			$this->Page_Terminate("pemilihan_kelaslist.php");
		if ($Security->AllowList('view_peserta2'))
			$this->Page_Terminate("view_peserta2list.php");
		if ($Security->AllowList('st_peserta2'))
			$this->Page_Terminate("st_peserta2list.php");
		if ($Security->AllowList('Report1'))
			$this->Page_Terminate("Report1report.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage($Language->Phrase("NoPermission") . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>
