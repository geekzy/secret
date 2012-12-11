<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_cicilaninfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE, 'utf-8') ?>
<?php

// Create page object
$keu_cicilan_preview = new ckeu_cicilan_preview();
$Page =& $keu_cicilan_preview;

// Page init
$keu_cicilan_preview->Page_Init();

// Page main
$keu_cicilan_preview->Page_Main();
?>
<link href="phpcss/phpmaker_sekolah.css" rel="stylesheet" type="text/css">
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo  $keu_cicilan->TableCaption() ?>&nbsp;
<?php if ($keu_cicilan_preview->TotalRecs > 0) { ?>
(<?php echo $keu_cicilan_preview->TotalRecs ?>&nbsp;<?php echo $Language->Phrase("Record") ?>)
<?php } else { ?>
(<?php echo $Language->Phrase("NoRecord") ?>)
<?php } ?>
</p>
<?php $keu_cicilan_preview->ShowPageHeader(); ?>
<?php if ($keu_cicilan_preview->TotalRecs > 0) { ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="ewDetailsPreviewTable" name="ewDetailsPreviewTable" cellspacing="0" class="ewTable ewTableSeparate">
	<thead><!-- Table header -->
		<tr class="ewTableHeader">
<?php if ($keu_cicilan->kode_otomatis->Visible) { // cicilan ?>
			<td valign="top"><?php echo $keu_cicilan->cicilan->FldCaption() ?></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // tanggal_pembayaran ?>
			<td valign="top"><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // rek_kas ?>
			<td valign="top"><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // rek_pendapatan ?>
			<td valign="top"><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
			<td valign="top"><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis_tanggungan ?>
			<td valign="top"><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis_master ?>
			<td valign="top"><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td>
<?php } ?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$keu_cicilan_preview->RecCount = 0;
while ($keu_cicilan_preview->Recordset && !$keu_cicilan_preview->Recordset->EOF) {

	// Init row class and style
	$keu_cicilan_preview->RecCount++;
	$keu_cicilan->CssClass = "";
	$keu_cicilan->CssStyle = "";
	$keu_cicilan->LoadListRowValues($keu_cicilan_preview->Recordset);

	// Render row
	$keu_cicilan->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$keu_cicilan->RenderListRow();
?>
	<tr<?php echo $keu_cicilan->RowAttributes() ?>>
<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
		<!-- cicilan -->
		<td<?php echo $keu_cicilan->cicilan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->cicilan->ViewAttributes() ?>><?php echo $keu_cicilan->cicilan->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
		<!-- tanggal_pembayaran -->
		<td<?php echo $keu_cicilan->tanggal_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_cicilan->tanggal_pembayaran->ViewAttributes() ?>><?php echo $keu_cicilan->tanggal_pembayaran->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
		<!-- rek_kas -->
		<td<?php echo $keu_cicilan->rek_kas->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_kas->ViewAttributes() ?>><?php echo $keu_cicilan->rek_kas->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
		<!-- rek_pendapatan -->
		<td<?php echo $keu_cicilan->rek_pendapatan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_cicilan->rek_pendapatan->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
		<!-- kode_otomatis -->
		<td<?php echo $keu_cicilan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
		<!-- kode_otomatis_tanggungan -->
		<td<?php echo $keu_cicilan->kode_otomatis_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_tanggungan->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_tanggungan->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
		<!-- kode_otomatis_master -->
		<td<?php echo $keu_cicilan->kode_otomatis_master->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_master->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_master->ListViewValue() ?></div></td>
<?php } ?>
	</tr>
<?php
	$keu_cicilan_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table>
</div>
</td></tr></table>
<?php
$keu_cicilan_preview->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
if ($keu_cicilan_preview->Recordset)
	$keu_cicilan_preview->Recordset->Close();
}
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
<?php
$keu_cicilan_preview->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_cicilan_preview {

	// Page ID
	var $PageID = 'preview';

	// Table name
	var $TableName = 'keu_cicilan';

	// Page object name
	var $PageObjName = 'keu_cicilan_preview';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) $PageUrl .= "t=" . $keu_cicilan->TableVar . "&"; // Add page token
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
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_cicilan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_cicilan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_cicilan_preview() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_cicilan)
		if (!isset($GLOBALS["keu_cicilan"])) {
			$GLOBALS["keu_cicilan"] = new ckeu_cicilan();
			$GLOBALS["Table"] =& $GLOBALS["keu_cicilan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS['keu_laporan_keuangan'])) $GLOBALS['keu_laporan_keuangan'] = new ckeu_laporan_keuangan();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'preview', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_cicilan', TRUE);

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
		global $keu_cicilan;

		// Security
		$Security = new cAdvancedSecurity();
		if (is_null($Security)) $Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel('keu_cicilan');
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			echo $Language->Phrase("NoPermission");
			exit();
		}
		if (!$Security->CanList()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $Recordset;
	var $TotalRecs;
	var $RecCount;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $keu_cicilan;

		// Load filter
		$qs = new cQueryString();
		$filter = $qs->GetValue("f");
		$filter = TEAdecrypt($filter, EW_RANDOM_KEY);
		if ($filter == "") $filter = "0=1";

		// Load recordset
		// Call Recordset Selecting event

		$keu_cicilan->Recordset_Selecting($filter);
		$this->Recordset = $keu_cicilan->LoadRs($filter);
		$this->TotalRecs = ($this->Recordset) ? $this->Recordset->RecordCount() : 0;

		// Call Recordset Selected event
		$keu_cicilan->Recordset_Selected($this->Recordset);
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

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
