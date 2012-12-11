<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "rekening2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$rekening2_view = new crekening2_view();
$Page =& $rekening2_view;

// Page init
$rekening2_view->Page_Init();

// Page main
$rekening2_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($rekening2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rekening2_view = new ew_Page("rekening2_view");

// page properties
rekening2_view.PageID = "view"; // page ID
rekening2_view.FormID = "frekening2view"; // form ID
var EW_PAGE_ID = rekening2_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
rekening2_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
rekening2_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rekening2_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rekening2->TableCaption() ?>
&nbsp;&nbsp;<?php $rekening2_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($rekening2->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $rekening2_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $rekening2_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $rekening2_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $rekening2_view->ShowPageHeader(); ?>
<?php
$rekening2_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($rekening2->kodePokok->Visible) { // kodePokok ?>
	<tr id="r_kodePokok"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodePokok->FldCaption() ?></td>
		<td<?php echo $rekening2->kodePokok->CellAttributes() ?>>
<div<?php echo $rekening2->kodePokok->ViewAttributes() ?>><?php echo $rekening2->kodePokok->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<tr id="r_kodeSubSatu"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodeSubSatu->FldCaption() ?></td>
		<td<?php echo $rekening2->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $rekening2->kodeSubSatu->ViewAttributes() ?>><?php echo $rekening2->kodeSubSatu->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kodeSubDua->Visible) { // kodeSubDua ?>
	<tr id="r_kodeSubDua"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodeSubDua->FldCaption() ?></td>
		<td<?php echo $rekening2->kodeSubDua->CellAttributes() ?>>
<div<?php echo $rekening2->kodeSubDua->ViewAttributes() ?>><?php echo $rekening2->kodeSubDua->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<tr id="r_kodeSubTiga"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodeSubTiga->FldCaption() ?></td>
		<td<?php echo $rekening2->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $rekening2->kodeSubTiga->ViewAttributes() ?>><?php echo $rekening2->kodeSubTiga->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->Norek->Visible) { // Norek ?>
	<tr id="r_Norek"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->Norek->FldCaption() ?></td>
		<td<?php echo $rekening2->Norek->CellAttributes() ?>>
<div<?php echo $rekening2->Norek->ViewAttributes() ?>><?php echo $rekening2->Norek->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->Keterangan->Visible) { // Keterangan ?>
	<tr id="r_Keterangan"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->Keterangan->FldCaption() ?></td>
		<td<?php echo $rekening2->Keterangan->CellAttributes() ?>>
<div<?php echo $rekening2->Keterangan->ViewAttributes() ?>><?php echo $rekening2->Keterangan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->D2FK->Visible) { // D/K ?>
	<tr id="r_D2FK"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->D2FK->FldCaption() ?></td>
		<td<?php echo $rekening2->D2FK->CellAttributes() ?>>
<div<?php echo $rekening2->D2FK->ViewAttributes() ?>><?php echo $rekening2->D2FK->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->SaldoAwal->Visible) { // SaldoAwal ?>
	<tr id="r_SaldoAwal"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->SaldoAwal->FldCaption() ?></td>
		<td<?php echo $rekening2->SaldoAwal->CellAttributes() ?>>
<div<?php echo $rekening2->SaldoAwal->ViewAttributes() ?>><?php echo $rekening2->SaldoAwal->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->Saldo->Visible) { // Saldo ?>
	<tr id="r_Saldo"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->Saldo->FldCaption() ?></td>
		<td<?php echo $rekening2->Saldo->CellAttributes() ?>>
<div<?php echo $rekening2->Saldo->ViewAttributes() ?>><?php echo $rekening2->Saldo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->TanggalSaldo->Visible) { // TanggalSaldo ?>
	<tr id="r_TanggalSaldo"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->TanggalSaldo->FldCaption() ?></td>
		<td<?php echo $rekening2->TanggalSaldo->CellAttributes() ?>>
<div<?php echo $rekening2->TanggalSaldo->ViewAttributes() ?>><?php echo $rekening2->TanggalSaldo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->target->Visible) { // target ?>
	<tr id="r_target"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->target->FldCaption() ?></td>
		<td<?php echo $rekening2->target->CellAttributes() ?>>
<div<?php echo $rekening2->target->ViewAttributes() ?>><?php echo $rekening2->target->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->id->Visible) { // id ?>
	<tr id="r_id"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->id->FldCaption() ?></td>
		<td<?php echo $rekening2->id->CellAttributes() ?>>
<div<?php echo $rekening2->id->ViewAttributes() ?>><?php echo $rekening2->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->debet_kali->Visible) { // debet_kali ?>
	<tr id="r_debet_kali"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->debet_kali->FldCaption() ?></td>
		<td<?php echo $rekening2->debet_kali->CellAttributes() ?>>
<div<?php echo $rekening2->debet_kali->ViewAttributes() ?>><?php echo $rekening2->debet_kali->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kredit_kali->Visible) { // kredit_kali ?>
	<tr id="r_kredit_kali"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kredit_kali->FldCaption() ?></td>
		<td<?php echo $rekening2->kredit_kali->CellAttributes() ?>>
<div<?php echo $rekening2->kredit_kali->ViewAttributes() ?>><?php echo $rekening2->kredit_kali->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$rekening2_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($rekening2->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$rekening2_view->Page_Terminate();
?>
<?php

//
// Page class
//
class crekening2_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'rekening2';

	// Page object name
	var $PageObjName = 'rekening2_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rekening2;
		if ($rekening2->UseTokenInUrl) $PageUrl .= "t=" . $rekening2->TableVar . "&"; // Add page token
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
		global $objForm, $rekening2;
		if ($rekening2->UseTokenInUrl) {
			if ($objForm)
				return ($rekening2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rekening2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crekening2_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (rekening2)
		if (!isset($GLOBALS["rekening2"])) {
			$GLOBALS["rekening2"] = new crekening2();
			$GLOBALS["Table"] =& $GLOBALS["rekening2"];
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
			define("EW_TABLE_NAME", 'rekening2', TRUE);

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
		global $rekening2;

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
			$this->Page_Terminate("rekening2list.php");
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
		global $Language, $rekening2;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$rekening2->id->setQueryStringValue($_GET["id"]);
				$this->RecKey["id"] = $rekening2->id->QueryStringValue;
			} else {
				$sReturnUrl = "rekening2list.php"; // Return to list
			}

			// Get action
			$rekening2->CurrentAction = "I"; // Display form
			switch ($rekening2->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "rekening2list.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "rekening2list.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$rekening2->RowType = EW_ROWTYPE_VIEW;
		$rekening2->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $rekening2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$rekening2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$rekening2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $rekening2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$rekening2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$rekening2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$rekening2->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rekening2;
		$sFilter = $rekening2->KeyFilter();

		// Call Row Selecting event
		$rekening2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rekening2->CurrentFilter = $sFilter;
		$sSql = $rekening2->SQL();
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
		global $conn, $rekening2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$rekening2->Row_Selected($row);
		$rekening2->kodePokok->setDbValue($rs->fields('kodePokok'));
		$rekening2->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$rekening2->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$rekening2->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$rekening2->Norek->setDbValue($rs->fields('Norek'));
		$rekening2->Keterangan->setDbValue($rs->fields('Keterangan'));
		$rekening2->D2FK->setDbValue($rs->fields('D/K'));
		$rekening2->SaldoAwal->setDbValue($rs->fields('SaldoAwal'));
		$rekening2->Saldo->setDbValue($rs->fields('Saldo'));
		$rekening2->TanggalSaldo->setDbValue($rs->fields('TanggalSaldo'));
		$rekening2->target->setDbValue($rs->fields('target'));
		$rekening2->id->setDbValue($rs->fields('id'));
		$rekening2->debet_kali->setDbValue($rs->fields('debet_kali'));
		$rekening2->kredit_kali->setDbValue($rs->fields('kredit_kali'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rekening2;

		// Initialize URLs
		$this->AddUrl = $rekening2->AddUrl();
		$this->EditUrl = $rekening2->EditUrl();
		$this->CopyUrl = $rekening2->CopyUrl();
		$this->DeleteUrl = $rekening2->DeleteUrl();
		$this->ListUrl = $rekening2->ListUrl();

		// Call Row_Rendering event
		$rekening2->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// Norek
		// Keterangan
		// D/K
		// SaldoAwal
		// Saldo
		// TanggalSaldo
		// target
		// id
		// debet_kali
		// kredit_kali

		if ($rekening2->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$rekening2->kodePokok->ViewValue = $rekening2->kodePokok->CurrentValue;
			$rekening2->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->ViewValue = $rekening2->kodeSubSatu->CurrentValue;
			$rekening2->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$rekening2->kodeSubDua->ViewValue = $rekening2->kodeSubDua->CurrentValue;
			$rekening2->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->ViewValue = $rekening2->kodeSubTiga->CurrentValue;
			$rekening2->kodeSubTiga->ViewCustomAttributes = "";

			// Norek
			$rekening2->Norek->ViewValue = $rekening2->Norek->CurrentValue;
			$rekening2->Norek->ViewCustomAttributes = "";

			// Keterangan
			$rekening2->Keterangan->ViewValue = $rekening2->Keterangan->CurrentValue;
			$rekening2->Keterangan->ViewCustomAttributes = "";

			// D/K
			$rekening2->D2FK->ViewValue = $rekening2->D2FK->CurrentValue;
			$rekening2->D2FK->ViewCustomAttributes = "";

			// SaldoAwal
			$rekening2->SaldoAwal->ViewValue = $rekening2->SaldoAwal->CurrentValue;
			$rekening2->SaldoAwal->ViewCustomAttributes = "";

			// Saldo
			$rekening2->Saldo->ViewValue = $rekening2->Saldo->CurrentValue;
			$rekening2->Saldo->ViewCustomAttributes = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->ViewValue = $rekening2->TanggalSaldo->CurrentValue;
			$rekening2->TanggalSaldo->ViewValue = ew_FormatDateTime($rekening2->TanggalSaldo->ViewValue, 7);
			$rekening2->TanggalSaldo->ViewCustomAttributes = "";

			// target
			$rekening2->target->ViewValue = $rekening2->target->CurrentValue;
			$rekening2->target->ViewCustomAttributes = "";

			// id
			$rekening2->id->ViewValue = $rekening2->id->CurrentValue;
			$rekening2->id->ViewCustomAttributes = "";

			// debet_kali
			$rekening2->debet_kali->ViewValue = $rekening2->debet_kali->CurrentValue;
			$rekening2->debet_kali->ViewCustomAttributes = "";

			// kredit_kali
			$rekening2->kredit_kali->ViewValue = $rekening2->kredit_kali->CurrentValue;
			$rekening2->kredit_kali->ViewCustomAttributes = "";

			// kodePokok
			$rekening2->kodePokok->LinkCustomAttributes = "";
			$rekening2->kodePokok->HrefValue = "";
			$rekening2->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->LinkCustomAttributes = "";
			$rekening2->kodeSubSatu->HrefValue = "";
			$rekening2->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$rekening2->kodeSubDua->LinkCustomAttributes = "";
			$rekening2->kodeSubDua->HrefValue = "";
			$rekening2->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->LinkCustomAttributes = "";
			$rekening2->kodeSubTiga->HrefValue = "";
			$rekening2->kodeSubTiga->TooltipValue = "";

			// Norek
			$rekening2->Norek->LinkCustomAttributes = "";
			$rekening2->Norek->HrefValue = "";
			$rekening2->Norek->TooltipValue = "";

			// Keterangan
			$rekening2->Keterangan->LinkCustomAttributes = "";
			$rekening2->Keterangan->HrefValue = "";
			$rekening2->Keterangan->TooltipValue = "";

			// D/K
			$rekening2->D2FK->LinkCustomAttributes = "";
			$rekening2->D2FK->HrefValue = "";
			$rekening2->D2FK->TooltipValue = "";

			// SaldoAwal
			$rekening2->SaldoAwal->LinkCustomAttributes = "";
			$rekening2->SaldoAwal->HrefValue = "";
			$rekening2->SaldoAwal->TooltipValue = "";

			// Saldo
			$rekening2->Saldo->LinkCustomAttributes = "";
			$rekening2->Saldo->HrefValue = "";
			$rekening2->Saldo->TooltipValue = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->LinkCustomAttributes = "";
			$rekening2->TanggalSaldo->HrefValue = "";
			$rekening2->TanggalSaldo->TooltipValue = "";

			// target
			$rekening2->target->LinkCustomAttributes = "";
			$rekening2->target->HrefValue = "";
			$rekening2->target->TooltipValue = "";

			// id
			$rekening2->id->LinkCustomAttributes = "";
			$rekening2->id->HrefValue = "";
			$rekening2->id->TooltipValue = "";

			// debet_kali
			$rekening2->debet_kali->LinkCustomAttributes = "";
			$rekening2->debet_kali->HrefValue = "";
			$rekening2->debet_kali->TooltipValue = "";

			// kredit_kali
			$rekening2->kredit_kali->LinkCustomAttributes = "";
			$rekening2->kredit_kali->HrefValue = "";
			$rekening2->kredit_kali->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($rekening2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rekening2->Row_Rendered();
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
