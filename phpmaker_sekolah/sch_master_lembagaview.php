<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "sch_master_lembagainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$sch_master_lembaga_view = new csch_master_lembaga_view();
$Page =& $sch_master_lembaga_view;

// Page init
$sch_master_lembaga_view->Page_Init();

// Page main
$sch_master_lembaga_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($sch_master_lembaga->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sch_master_lembaga_view = new ew_Page("sch_master_lembaga_view");

// page properties
sch_master_lembaga_view.PageID = "view"; // page ID
sch_master_lembaga_view.FormID = "fsch_master_lembagaview"; // form ID
var EW_PAGE_ID = sch_master_lembaga_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sch_master_lembaga_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sch_master_lembaga_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sch_master_lembaga_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sch_master_lembaga->TableCaption() ?>
&nbsp;&nbsp;<?php $sch_master_lembaga_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($sch_master_lembaga->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $sch_master_lembaga_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $sch_master_lembaga_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $sch_master_lembaga_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $sch_master_lembaga_view->ShowPageHeader(); ?>
<?php
$sch_master_lembaga_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sch_master_lembaga->kode_lembaga->Visible) { // kode_lembaga ?>
	<tr id="r_kode_lembaga"<?php echo $sch_master_lembaga->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sch_master_lembaga->kode_lembaga->FldCaption() ?></td>
		<td<?php echo $sch_master_lembaga->kode_lembaga->CellAttributes() ?>>
<div<?php echo $sch_master_lembaga->kode_lembaga->ViewAttributes() ?>><?php echo $sch_master_lembaga->kode_lembaga->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sch_master_lembaga->nama_lembaga->Visible) { // nama_lembaga ?>
	<tr id="r_nama_lembaga"<?php echo $sch_master_lembaga->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sch_master_lembaga->nama_lembaga->FldCaption() ?></td>
		<td<?php echo $sch_master_lembaga->nama_lembaga->CellAttributes() ?>>
<div<?php echo $sch_master_lembaga->nama_lembaga->ViewAttributes() ?>><?php echo $sch_master_lembaga->nama_lembaga->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$sch_master_lembaga_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($sch_master_lembaga->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$sch_master_lembaga_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csch_master_lembaga_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'sch_master_lembaga';

	// Page object name
	var $PageObjName = 'sch_master_lembaga_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sch_master_lembaga;
		if ($sch_master_lembaga->UseTokenInUrl) $PageUrl .= "t=" . $sch_master_lembaga->TableVar . "&"; // Add page token
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
		global $objForm, $sch_master_lembaga;
		if ($sch_master_lembaga->UseTokenInUrl) {
			if ($objForm)
				return ($sch_master_lembaga->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sch_master_lembaga->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csch_master_lembaga_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (sch_master_lembaga)
		if (!isset($GLOBALS["sch_master_lembaga"])) {
			$GLOBALS["sch_master_lembaga"] = new csch_master_lembaga();
			$GLOBALS["Table"] =& $GLOBALS["sch_master_lembaga"];
		}
		$KeyUrl = "";
		if (@$_GET["kode_lembaga"] <> "") {
			$this->RecKey["kode_lembaga"] = $_GET["kode_lembaga"];
			$KeyUrl .= "&kode_lembaga=" . urlencode($this->RecKey["kode_lembaga"]);
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
			define("EW_TABLE_NAME", 'sch_master_lembaga', TRUE);

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
		global $sch_master_lembaga;

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
			$this->Page_Terminate("sch_master_lembagalist.php");
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
		global $Language, $sch_master_lembaga;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode_lembaga"] <> "") {
				$sch_master_lembaga->kode_lembaga->setQueryStringValue($_GET["kode_lembaga"]);
				$this->RecKey["kode_lembaga"] = $sch_master_lembaga->kode_lembaga->QueryStringValue;
			} else {
				$sReturnUrl = "sch_master_lembagalist.php"; // Return to list
			}

			// Get action
			$sch_master_lembaga->CurrentAction = "I"; // Display form
			switch ($sch_master_lembaga->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "sch_master_lembagalist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "sch_master_lembagalist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$sch_master_lembaga->RowType = EW_ROWTYPE_VIEW;
		$sch_master_lembaga->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sch_master_lembaga;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$sch_master_lembaga->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$sch_master_lembaga->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $sch_master_lembaga->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sch_master_lembaga;
		$sFilter = $sch_master_lembaga->KeyFilter();

		// Call Row Selecting event
		$sch_master_lembaga->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sch_master_lembaga->CurrentFilter = $sFilter;
		$sSql = $sch_master_lembaga->SQL();
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
		global $conn, $sch_master_lembaga;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$sch_master_lembaga->Row_Selected($row);
		$sch_master_lembaga->kode_lembaga->setDbValue($rs->fields('kode_lembaga'));
		$sch_master_lembaga->nama_lembaga->setDbValue($rs->fields('nama_lembaga'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sch_master_lembaga;

		// Initialize URLs
		$this->AddUrl = $sch_master_lembaga->AddUrl();
		$this->EditUrl = $sch_master_lembaga->EditUrl();
		$this->CopyUrl = $sch_master_lembaga->CopyUrl();
		$this->DeleteUrl = $sch_master_lembaga->DeleteUrl();
		$this->ListUrl = $sch_master_lembaga->ListUrl();

		// Call Row_Rendering event
		$sch_master_lembaga->Row_Rendering();

		// Common render codes for all row types
		// kode_lembaga
		// nama_lembaga

		if ($sch_master_lembaga->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_lembaga
			$sch_master_lembaga->kode_lembaga->ViewValue = $sch_master_lembaga->kode_lembaga->CurrentValue;
			$sch_master_lembaga->kode_lembaga->ViewCustomAttributes = "";

			// nama_lembaga
			$sch_master_lembaga->nama_lembaga->ViewValue = $sch_master_lembaga->nama_lembaga->CurrentValue;
			$sch_master_lembaga->nama_lembaga->ViewCustomAttributes = "";

			// kode_lembaga
			$sch_master_lembaga->kode_lembaga->LinkCustomAttributes = "";
			$sch_master_lembaga->kode_lembaga->HrefValue = "";
			$sch_master_lembaga->kode_lembaga->TooltipValue = "";

			// nama_lembaga
			$sch_master_lembaga->nama_lembaga->LinkCustomAttributes = "";
			$sch_master_lembaga->nama_lembaga->HrefValue = "";
			$sch_master_lembaga->nama_lembaga->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($sch_master_lembaga->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sch_master_lembaga->Row_Rendered();
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
