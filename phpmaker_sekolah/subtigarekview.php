<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subtigarekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subtigarek_view = new csubtigarek_view();
$Page =& $subtigarek_view;

// Page init
$subtigarek_view->Page_Init();

// Page main
$subtigarek_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subtigarek->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subtigarek_view = new ew_Page("subtigarek_view");

// page properties
subtigarek_view.PageID = "view"; // page ID
subtigarek_view.FormID = "fsubtigarekview"; // form ID
var EW_PAGE_ID = subtigarek_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subtigarek_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subtigarek_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subtigarek_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subtigarek->TableCaption() ?>
&nbsp;&nbsp;<?php $subtigarek_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($subtigarek->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $subtigarek_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $subtigarek_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $subtigarek_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $subtigarek_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $subtigarek_view->ShowPageHeader(); ?>
<?php
$subtigarek_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subtigarek->kodePokok->Visible) { // kodePokok ?>
	<tr id="r_kodePokok"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->kodePokok->FldCaption() ?></td>
		<td<?php echo $subtigarek->kodePokok->CellAttributes() ?>>
<div<?php echo $subtigarek->kodePokok->ViewAttributes() ?>><?php echo $subtigarek->kodePokok->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<tr id="r_kodeSubSatu"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->kodeSubSatu->FldCaption() ?></td>
		<td<?php echo $subtigarek->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubSatu->ViewAttributes() ?>><?php echo $subtigarek->kodeSubSatu->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->kodeSubDua->Visible) { // kodeSubDua ?>
	<tr id="r_kodeSubDua"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->kodeSubDua->FldCaption() ?></td>
		<td<?php echo $subtigarek->kodeSubDua->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubDua->ViewAttributes() ?>><?php echo $subtigarek->kodeSubDua->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<tr id="r_kodeSubTiga"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->kodeSubTiga->FldCaption() ?></td>
		<td<?php echo $subtigarek->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubTiga->ViewAttributes() ?>><?php echo $subtigarek->kodeSubTiga->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->namaSubTiga->Visible) { // namaSubTiga ?>
	<tr id="r_namaSubTiga"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->namaSubTiga->FldCaption() ?></td>
		<td<?php echo $subtigarek->namaSubTiga->CellAttributes() ?>>
<div<?php echo $subtigarek->namaSubTiga->ViewAttributes() ?>><?php echo $subtigarek->namaSubTiga->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->id->Visible) { // id ?>
	<tr id="r_id"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->id->FldCaption() ?></td>
		<td<?php echo $subtigarek->id->CellAttributes() ?>>
<div<?php echo $subtigarek->id->ViewAttributes() ?>><?php echo $subtigarek->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$subtigarek_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subtigarek->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subtigarek_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csubtigarek_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'subtigarek';

	// Page object name
	var $PageObjName = 'subtigarek_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subtigarek;
		if ($subtigarek->UseTokenInUrl) $PageUrl .= "t=" . $subtigarek->TableVar . "&"; // Add page token
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
		global $objForm, $subtigarek;
		if ($subtigarek->UseTokenInUrl) {
			if ($objForm)
				return ($subtigarek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subtigarek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubtigarek_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subtigarek)
		if (!isset($GLOBALS["subtigarek"])) {
			$GLOBALS["subtigarek"] = new csubtigarek();
			$GLOBALS["Table"] =& $GLOBALS["subtigarek"];
		}
		$KeyUrl = "";
		if (@$_GET["id"] <> "") {
			$this->RecKey["id"] = $_GET["id"];
			$KeyUrl .= "&id=" . urlencode($this->RecKey["id"]);
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
			define("EW_TABLE_NAME", 'subtigarek', TRUE);

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
		global $subtigarek;

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
			$this->Page_Terminate("subtigareklist.php");
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
		global $Language, $subtigarek;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$subtigarek->id->setQueryStringValue($_GET["id"]);
				$this->RecKey["id"] = $subtigarek->id->QueryStringValue;
			} else {
				$sReturnUrl = "subtigareklist.php"; // Return to list
			}

			// Get action
			$subtigarek->CurrentAction = "I"; // Display form
			switch ($subtigarek->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "subtigareklist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "subtigareklist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$subtigarek->RowType = EW_ROWTYPE_VIEW;
		$subtigarek->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subtigarek;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subtigarek->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subtigarek->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subtigarek->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subtigarek->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subtigarek->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subtigarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subtigarek;
		$sFilter = $subtigarek->KeyFilter();

		// Call Row Selecting event
		$subtigarek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subtigarek->CurrentFilter = $sFilter;
		$sSql = $subtigarek->SQL();
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
		global $conn, $subtigarek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subtigarek->Row_Selected($row);
		$subtigarek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subtigarek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subtigarek->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$subtigarek->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$subtigarek->namaSubTiga->setDbValue($rs->fields('namaSubTiga'));
		$subtigarek->id->setDbValue($rs->fields('id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subtigarek;

		// Initialize URLs
		$this->AddUrl = $subtigarek->AddUrl();
		$this->EditUrl = $subtigarek->EditUrl();
		$this->CopyUrl = $subtigarek->CopyUrl();
		$this->DeleteUrl = $subtigarek->DeleteUrl();
		$this->ListUrl = $subtigarek->ListUrl();

		// Call Row_Rendering event
		$subtigarek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// namaSubTiga
		// id

		if ($subtigarek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$subtigarek->kodePokok->ViewValue = $subtigarek->kodePokok->CurrentValue;
			$subtigarek->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->ViewValue = $subtigarek->kodeSubSatu->CurrentValue;
			$subtigarek->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->ViewValue = $subtigarek->kodeSubDua->CurrentValue;
			$subtigarek->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->ViewValue = $subtigarek->kodeSubTiga->CurrentValue;
			$subtigarek->kodeSubTiga->ViewCustomAttributes = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->ViewValue = $subtigarek->namaSubTiga->CurrentValue;
			$subtigarek->namaSubTiga->ViewCustomAttributes = "";

			// id
			$subtigarek->id->ViewValue = $subtigarek->id->CurrentValue;
			$subtigarek->id->ViewCustomAttributes = "";

			// kodePokok
			$subtigarek->kodePokok->LinkCustomAttributes = "";
			$subtigarek->kodePokok->HrefValue = "";
			$subtigarek->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->LinkCustomAttributes = "";
			$subtigarek->kodeSubSatu->HrefValue = "";
			$subtigarek->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->LinkCustomAttributes = "";
			$subtigarek->kodeSubDua->HrefValue = "";
			$subtigarek->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->LinkCustomAttributes = "";
			$subtigarek->kodeSubTiga->HrefValue = "";
			$subtigarek->kodeSubTiga->TooltipValue = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->LinkCustomAttributes = "";
			$subtigarek->namaSubTiga->HrefValue = "";
			$subtigarek->namaSubTiga->TooltipValue = "";

			// id
			$subtigarek->id->LinkCustomAttributes = "";
			$subtigarek->id->HrefValue = "";
			$subtigarek->id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subtigarek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subtigarek->Row_Rendered();
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
