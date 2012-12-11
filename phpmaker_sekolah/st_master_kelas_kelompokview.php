<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_kelas_kelompok_view = new cst_master_kelas_kelompok_view();
$Page =& $st_master_kelas_kelompok_view;

// Page init
$st_master_kelas_kelompok_view->Page_Init();

// Page main
$st_master_kelas_kelompok_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($st_master_kelas_kelompok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_kelas_kelompok_view = new ew_Page("st_master_kelas_kelompok_view");

// page properties
st_master_kelas_kelompok_view.PageID = "view"; // page ID
st_master_kelas_kelompok_view.FormID = "fst_master_kelas_kelompokview"; // form ID
var EW_PAGE_ID = st_master_kelas_kelompok_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
st_master_kelas_kelompok_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_kelas_kelompok_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_kelas_kelompok_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_kelas_kelompok->TableCaption() ?>
&nbsp;&nbsp;<?php $st_master_kelas_kelompok_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($st_master_kelas_kelompok->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $st_master_kelas_kelompok_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $st_master_kelas_kelompok_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $st_master_kelas_kelompok_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $st_master_kelas_kelompok_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('st_peserta2')) { ?>
<a href="st_peserta2list.php?<?php echo EW_TABLE_SHOW_MASTER ?>=st_master_kelas_kelompok&kode_otomatis=<?php echo urlencode(strval($st_master_kelas_kelompok->kode_otomatis->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("st_peserta2", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $st_master_kelas_kelompok_view->ShowPageHeader(); ?>
<?php
$st_master_kelas_kelompok_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($st_master_kelas_kelompok->tahun->Visible) { // tahun ?>
	<tr id="r_tahun"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?></td>
		<td<?php echo $st_master_kelas_kelompok->tahun->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->tahun->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->tahun->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->kelas->Visible) { // kelas ?>
	<tr id="r_kelas"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kelas->FldCaption() ?></td>
		<td<?php echo $st_master_kelas_kelompok->kelas->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->kelas->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kelas->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<tr id="r_nama_kelas_kelompok"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption() ?></td>
		<td<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
	<tr id="r_kode_otomatis"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
		<td<?php echo $st_master_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kode_otomatis->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->apakah_valid->Visible) { // apakah_valid ?>
	<tr id="r_apakah_valid"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?></td>
		<td<?php echo $st_master_kelas_kelompok->apakah_valid->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->apakah_valid->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->apakah_valid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<tr id="r_kode_otomatis_tingkat"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->FldCaption() ?></td>
		<td<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$st_master_kelas_kelompok_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($st_master_kelas_kelompok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$st_master_kelas_kelompok_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_kelas_kelompok_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'st_master_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_master_kelas_kelompok_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_master_kelas_kelompok->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		global $objForm, $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_kelas_kelompok_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_kelas_kelompok)
		if (!isset($GLOBALS["st_master_kelas_kelompok"])) {
			$GLOBALS["st_master_kelas_kelompok"] = new cst_master_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_master_kelas_kelompok"];
		}
		$KeyUrl = "";
		if (@$_GET["kode_otomatis"] <> "") {
			$this->RecKey["kode_otomatis"] = $_GET["kode_otomatis"];
			$KeyUrl .= "&kode_otomatis=" . urlencode($this->RecKey["kode_otomatis"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_kelas_kelompok', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $st_master_kelas_kelompok;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("st_master_kelas_kelompoklist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$st_master_kelas_kelompok->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$st_master_kelas_kelompok->Export = $_POST["exporttype"];
		} else {
			$st_master_kelas_kelompok->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $st_master_kelas_kelompok->Export; // Get export parameter, used in header
		$gsExportFile = $st_master_kelas_kelompok->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["kode_otomatis"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["kode_otomatis"]);
		}
		if ($st_master_kelas_kelompok->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($st_master_kelas_kelompok->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Setup export options
		$this->SetupExportOptions();

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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $st_master_kelas_kelompok;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode_otomatis"] <> "") {
				$st_master_kelas_kelompok->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$this->RecKey["kode_otomatis"] = $st_master_kelas_kelompok->kode_otomatis->QueryStringValue;
			} else {
				$sReturnUrl = "st_master_kelas_kelompoklist.php"; // Return to list
			}

			// Get action
			$st_master_kelas_kelompok->CurrentAction = "I"; // Display form
			switch ($st_master_kelas_kelompok->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "st_master_kelas_kelompoklist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($st_master_kelas_kelompok->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				if ($st_master_kelas_kelompok->Export == "email" && $st_master_kelas_kelompok->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$st_master_kelas_kelompok->setExportReturnUrl($st_master_kelas_kelompok->ViewUrl()); // Add key
				$this->ExportData();
				if ($st_master_kelas_kelompok->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "st_master_kelas_kelompoklist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$st_master_kelas_kelompok->RowType = EW_ROWTYPE_VIEW;
		$st_master_kelas_kelompok->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $st_master_kelas_kelompok;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $st_master_kelas_kelompok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_master_kelas_kelompok;

		// Call Recordset Selecting event
		$st_master_kelas_kelompok->Recordset_Selecting($st_master_kelas_kelompok->CurrentFilter);

		// Load List page SQL
		$sSql = $st_master_kelas_kelompok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_master_kelas_kelompok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_kelas_kelompok;
		$sFilter = $st_master_kelas_kelompok->KeyFilter();

		// Call Row Selecting event
		$st_master_kelas_kelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_kelas_kelompok->CurrentFilter = $sFilter;
		$sSql = $st_master_kelas_kelompok->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $st_master_kelas_kelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_kelas_kelompok->Row_Selected($row);
		$st_master_kelas_kelompok->tahun->setDbValue($rs->fields('tahun'));
		$st_master_kelas_kelompok->kelas->setDbValue($rs->fields('kelas'));
		$st_master_kelas_kelompok->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$st_master_kelas_kelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$st_master_kelas_kelompok->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$st_master_kelas_kelompok->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_kelas_kelompok;

		// Initialize URLs
		$this->AddUrl = $st_master_kelas_kelompok->AddUrl();
		$this->EditUrl = $st_master_kelas_kelompok->EditUrl();
		$this->CopyUrl = $st_master_kelas_kelompok->CopyUrl();
		$this->DeleteUrl = $st_master_kelas_kelompok->DeleteUrl();
		$this->ListUrl = $st_master_kelas_kelompok->ListUrl();

		// Call Row_Rendering event
		$st_master_kelas_kelompok->Row_Rendering();

		// Common render codes for all row types
		// tahun
		// kelas
		// nama_kelas_kelompok
		// kode_otomatis
		// apakah_valid
		// kode_otomatis_tingkat

		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// tahun
			$st_master_kelas_kelompok->tahun->ViewValue = $st_master_kelas_kelompok->tahun->CurrentValue;
			$st_master_kelas_kelompok->tahun->ViewCustomAttributes = "";

			// kelas
			if (strval($st_master_kelas_kelompok->kelas->CurrentValue) <> "") {
				$sFilterWrk = "`kelas` = '" . ew_AdjustSql($st_master_kelas_kelompok->kelas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kelas` FROM `st_master_kelas`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kelas` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$st_master_kelas_kelompok->kelas->ViewValue = $rswrk->fields('kelas');
					$rswrk->Close();
				} else {
					$st_master_kelas_kelompok->kelas->ViewValue = $st_master_kelas_kelompok->kelas->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->kelas->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->kelas->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewValue = $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue;
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->ViewValue = $st_master_kelas_kelompok->kode_otomatis->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) <> "") {
				switch ($st_master_kelas_kelompok->apakah_valid->CurrentValue) {
					case "y":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					case "t":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					default:
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->apakah_valid->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$st_master_kelas_kelompok->tahun->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->HrefValue = "";
			$st_master_kelas_kelompok->tahun->TooltipValue = "";

			// kelas
			$st_master_kelas_kelompok->kelas->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kelas->HrefValue = "";
			$st_master_kelas_kelompok->kelas->TooltipValue = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->HrefValue = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->TooltipValue = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->apakah_valid->HrefValue = "";
			$st_master_kelas_kelompok->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($st_master_kelas_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_kelas_kelompok->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $st_master_kelas_kelompok;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_st_master_kelas_kelompok\" id=\"emf_st_master_kelas_kelompok\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_st_master_kelas_kelompok',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($st_master_kelas_kelompok->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $st_master_kelas_kelompok;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $st_master_kelas_kelompok->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs < 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($st_master_kelas_kelompok->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($st_master_kelas_kelompok, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($st_master_kelas_kelompok->Export == "xml") {
			$st_master_kelas_kelompok->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$st_master_kelas_kelompok->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($st_master_kelas_kelompok->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($st_master_kelas_kelompok->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($st_master_kelas_kelompok->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($st_master_kelas_kelompok->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($st_master_kelas_kelompok->ExportReturnUrl());
		} elseif ($st_master_kelas_kelompok->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
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
