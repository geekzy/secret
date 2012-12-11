<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_peserta_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "st_master_kelas_kelompokinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE, 'utf-8') ?>
<?php

// Create page object
$st_peserta_kelas_kelompok_preview = new cst_peserta_kelas_kelompok_preview();
$Page =& $st_peserta_kelas_kelompok_preview;

// Page init
$st_peserta_kelas_kelompok_preview->Page_Init();

// Page main
$st_peserta_kelas_kelompok_preview->Page_Main();
?>
<link href="phpcss/phpmaker_sekolah.css" rel="stylesheet" type="text/css">
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo  $st_peserta_kelas_kelompok->TableCaption() ?>&nbsp;
<?php if ($st_peserta_kelas_kelompok_preview->TotalRecs > 0) { ?>
(<?php echo $st_peserta_kelas_kelompok_preview->TotalRecs ?>&nbsp;<?php echo $Language->Phrase("Record") ?>)
<?php } else { ?>
(<?php echo $Language->Phrase("NoRecord") ?>)
<?php } ?>
</p>
<?php $st_peserta_kelas_kelompok_preview->ShowPageHeader(); ?>
<?php if ($st_peserta_kelas_kelompok_preview->TotalRecs > 0) { ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="ewDetailsPreviewTable" name="ewDetailsPreviewTable" cellspacing="0" class="ewTable ewTableSeparate">
	<thead><!-- Table header -->
		<tr class="ewTableHeader">
<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // identitas ?>
			<td valign="top" style="white-space: nowrap;"><?php echo $st_peserta_kelas_kelompok->identitas->FldCaption() ?></td>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
			<td valign="top"><?php echo $st_peserta_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
<?php } ?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$st_peserta_kelas_kelompok_preview->RecCount = 0;
while ($st_peserta_kelas_kelompok_preview->Recordset && !$st_peserta_kelas_kelompok_preview->Recordset->EOF) {

	// Init row class and style
	$st_peserta_kelas_kelompok_preview->RecCount++;
	$st_peserta_kelas_kelompok->CssClass = "";
	$st_peserta_kelas_kelompok->CssStyle = "";
	$st_peserta_kelas_kelompok->LoadListRowValues($st_peserta_kelas_kelompok_preview->Recordset);

	// Render row
	$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$st_peserta_kelas_kelompok->RenderListRow();
?>
	<tr<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
		<!-- identitas -->
		<td<?php echo $st_peserta_kelas_kelompok->identitas->CellAttributes() ?>>
<div<?php echo $st_peserta_kelas_kelompok->identitas->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->identitas->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<!-- kode_otomatis -->
		<td<?php echo $st_peserta_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_peserta_kelas_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->kode_otomatis->ListViewValue() ?></div></td>
<?php } ?>
	</tr>
<?php
	$st_peserta_kelas_kelompok_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table>
</div>
</td></tr></table>
<?php
$st_peserta_kelas_kelompok_preview->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
if ($st_peserta_kelas_kelompok_preview->Recordset)
	$st_peserta_kelas_kelompok_preview->Recordset->Close();
}
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
<?php
$st_peserta_kelas_kelompok_preview->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_peserta_kelas_kelompok_preview {

	// Page ID
	var $PageID = 'preview';

	// Table name
	var $TableName = 'st_peserta_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_peserta_kelas_kelompok_preview';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_peserta_kelas_kelompok;
		if ($st_peserta_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_peserta_kelas_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $st_peserta_kelas_kelompok;
		if ($st_peserta_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_peserta_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_peserta_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_peserta_kelas_kelompok_preview() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_peserta_kelas_kelompok)
		if (!isset($GLOBALS["st_peserta_kelas_kelompok"])) {
			$GLOBALS["st_peserta_kelas_kelompok"] = new cst_peserta_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_peserta_kelas_kelompok"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (st_master_kelas_kelompok)
		if (!isset($GLOBALS['st_master_kelas_kelompok'])) $GLOBALS['st_master_kelas_kelompok'] = new cst_master_kelas_kelompok();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'preview', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_peserta_kelas_kelompok', TRUE);

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
		global $st_peserta_kelas_kelompok;

		// Security
		$Security = new cAdvancedSecurity();
		if (is_null($Security)) $Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel('st_peserta_kelas_kelompok');
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
		global $Language, $st_peserta_kelas_kelompok;

		// Load filter
		$qs = new cQueryString();
		$filter = $qs->GetValue("f");
		$filter = TEAdecrypt($filter, EW_RANDOM_KEY);
		if ($filter == "") $filter = "0=1";

		// Load recordset
		// Call Recordset Selecting event

		$st_peserta_kelas_kelompok->Recordset_Selecting($filter);
		$this->Recordset = $st_peserta_kelas_kelompok->LoadRs($filter);
		$this->TotalRecs = ($this->Recordset) ? $this->Recordset->RecordCount() : 0;

		// Call Recordset Selected event
		$st_peserta_kelas_kelompok->Recordset_Selected($this->Recordset);
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
