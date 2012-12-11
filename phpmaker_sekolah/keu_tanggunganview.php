<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_tanggungan_view = new ckeu_tanggungan_view();
$Page =& $keu_tanggungan_view;

// Page init
$keu_tanggungan_view->Page_Init();

// Page main
$keu_tanggungan_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($keu_tanggungan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_tanggungan_view = new ew_Page("keu_tanggungan_view");

// page properties
keu_tanggungan_view.PageID = "view"; // page ID
keu_tanggungan_view.FormID = "fkeu_tanggunganview"; // form ID
var EW_PAGE_ID = keu_tanggungan_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_tanggungan_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_tanggungan_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_tanggungan_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_tanggungan->TableCaption() ?>
&nbsp;&nbsp;<?php $keu_tanggungan_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($keu_tanggungan->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $keu_tanggungan_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $keu_tanggungan_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $keu_tanggungan_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $keu_tanggungan_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $keu_tanggungan_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $keu_tanggungan_view->ShowPageHeader(); ?>
<?php
$keu_tanggungan_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($keu_tanggungan->kode_otomatis->Visible) { // kode_otomatis ?>
	<tr id="r_kode_otomatis"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->kode_otomatis->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->kode_otomatis_master_tanggungan->Visible) { // kode_otomatis_master_tanggungan ?>
	<tr id="r_kode_otomatis_master_tanggungan"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->identitas->Visible) { // identitas ?>
	<tr id="r_identitas"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->identitas->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->identitas->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->identitas->ViewAttributes() ?>><?php echo $keu_tanggungan->identitas->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_sosial->Visible) { // diskon_sosial ?>
	<tr id="r_diskon_sosial"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_sosial->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->diskon_sosial->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_sosial->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_waktu->Visible) { // diskon_waktu ?>
	<tr id="r_diskon_waktu"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_waktu->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->diskon_waktu->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_waktu->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<tr id="r_diskon_prestasi"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_prestasi->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_prestasi->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_internal->Visible) { // diskon_internal ?>
	<tr id="r_diskon_internal"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_internal->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->diskon_internal->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_internal->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_internal->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
	<tr id="r_diskon_lain_lain"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_lain_lain->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->diskon_lain_lain->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_lain_lain->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->nilai_tanggungan->Visible) { // nilai_tanggungan ?>
	<tr id="r_nilai_tanggungan"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->nilai_tanggungan->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->nilai_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->nilai_tanggungan->ViewAttributes() ?>><?php echo $keu_tanggungan->nilai_tanggungan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
	<tr id="r_tanggal_rencana_bayar"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->tanggal_rencana_bayar->FldCaption() ?></td>
		<td<?php echo $keu_tanggungan->tanggal_rencana_bayar->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_tanggungan->tanggal_rencana_bayar->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$keu_tanggungan_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($keu_tanggungan->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$keu_tanggungan_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_tanggungan_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'keu_tanggungan';

	// Page object name
	var $PageObjName = 'keu_tanggungan_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_tanggungan_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_tanggungan)
		if (!isset($GLOBALS["keu_tanggungan"])) {
			$GLOBALS["keu_tanggungan"] = new ckeu_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_tanggungan"];
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
			define("EW_TABLE_NAME", 'keu_tanggungan', TRUE);

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
		global $keu_tanggungan;

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
			$this->Page_Terminate("keu_tanggunganlist.php");
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
		global $Language, $keu_tanggungan;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode_otomatis"] <> "") {
				$keu_tanggungan->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$this->RecKey["kode_otomatis"] = $keu_tanggungan->kode_otomatis->QueryStringValue;
			} else {
				$sReturnUrl = "keu_tanggunganlist.php"; // Return to list
			}

			// Get action
			$keu_tanggungan->CurrentAction = "I"; // Display form
			switch ($keu_tanggungan->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "keu_tanggunganlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "keu_tanggunganlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$keu_tanggungan->RowType = EW_ROWTYPE_VIEW;
		$keu_tanggungan->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_tanggungan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_tanggungan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_tanggungan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_tanggungan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_tanggungan;
		$sFilter = $keu_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_tanggungan->SQL();
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
		global $conn, $keu_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_tanggungan->Row_Selected($row);
		$keu_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_tanggungan->kode_otomatis_master_tanggungan->setDbValue($rs->fields('kode_otomatis_master_tanggungan'));
		$keu_tanggungan->identitas->setDbValue($rs->fields('identitas'));
		$keu_tanggungan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_tanggungan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_tanggungan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_tanggungan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_tanggungan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_tanggungan->nilai_tanggungan->setDbValue($rs->fields('nilai_tanggungan'));
		$keu_tanggungan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_tanggungan;

		// Initialize URLs
		$this->AddUrl = $keu_tanggungan->AddUrl();
		$this->EditUrl = $keu_tanggungan->EditUrl();
		$this->CopyUrl = $keu_tanggungan->CopyUrl();
		$this->DeleteUrl = $keu_tanggungan->DeleteUrl();
		$this->ListUrl = $keu_tanggungan->ListUrl();

		// Call Row_Rendering event
		$keu_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// kode_otomatis_master_tanggungan
		// identitas
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan
		// tanggal_rencana_bayar

		if ($keu_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->ViewValue = $keu_tanggungan->kode_otomatis->CurrentValue;
			$keu_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewValue = $keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue;
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewCustomAttributes = "";

			// identitas
			$keu_tanggungan->identitas->ViewValue = $keu_tanggungan->identitas->CurrentValue;
			$keu_tanggungan->identitas->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->ViewValue = $keu_tanggungan->diskon_sosial->CurrentValue;
			$keu_tanggungan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->ViewValue = $keu_tanggungan->diskon_waktu->CurrentValue;
			$keu_tanggungan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->ViewValue = $keu_tanggungan->diskon_prestasi->CurrentValue;
			$keu_tanggungan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->ViewValue = $keu_tanggungan->diskon_internal->CurrentValue;
			$keu_tanggungan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->ViewValue = $keu_tanggungan->diskon_lain_lain->CurrentValue;
			$keu_tanggungan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->ViewValue = $keu_tanggungan->nilai_tanggungan->CurrentValue;
			$keu_tanggungan->nilai_tanggungan->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = $keu_tanggungan->tanggal_rencana_bayar->CurrentValue;
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_tanggungan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_tanggungan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis->HrefValue = "";
			$keu_tanggungan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->HrefValue = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->TooltipValue = "";

			// identitas
			$keu_tanggungan->identitas->LinkCustomAttributes = "";
			$keu_tanggungan->identitas->HrefValue = "";
			$keu_tanggungan->identitas->TooltipValue = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_sosial->HrefValue = "";
			$keu_tanggungan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_waktu->HrefValue = "";
			$keu_tanggungan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_prestasi->HrefValue = "";
			$keu_tanggungan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_internal->HrefValue = "";
			$keu_tanggungan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_lain_lain->HrefValue = "";
			$keu_tanggungan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->nilai_tanggungan->HrefValue = "";
			$keu_tanggungan->nilai_tanggungan->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_tanggungan->tanggal_rencana_bayar->HrefValue = "";
			$keu_tanggungan->tanggal_rencana_bayar->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_tanggungan->Row_Rendered();
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
