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
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_cicilan_view = new ckeu_cicilan_view();
$Page =& $keu_cicilan_view;

// Page init
$keu_cicilan_view->Page_Init();

// Page main
$keu_cicilan_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($keu_cicilan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_cicilan_view = new ew_Page("keu_cicilan_view");

// page properties
keu_cicilan_view.PageID = "view"; // page ID
keu_cicilan_view.FormID = "fkeu_cicilanview"; // form ID
var EW_PAGE_ID = keu_cicilan_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_cicilan_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_cicilan_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_cicilan_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_cicilan->TableCaption() ?>
&nbsp;&nbsp;<?php $keu_cicilan_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($keu_cicilan->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $keu_cicilan_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $keu_cicilan_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $keu_cicilan_view->ShowPageHeader(); ?>
<?php
$keu_cicilan_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
	<tr id="r_cicilan"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->cicilan->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->cicilan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->cicilan->ViewAttributes() ?>><?php echo $keu_cicilan->cicilan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
	<tr id="r_tanggal_pembayaran"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->tanggal_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_cicilan->tanggal_pembayaran->ViewAttributes() ?>><?php echo $keu_cicilan->tanggal_pembayaran->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
	<tr id="r_rek_kas"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->rek_kas->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_kas->ViewAttributes() ?>><?php echo $keu_cicilan->rek_kas->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
	<tr id="r_rek_pendapatan"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->rek_pendapatan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_cicilan->rek_pendapatan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
	<tr id="r_kode_otomatis"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
	<tr id="r_kode_otomatis_tanggungan"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->kode_otomatis_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_tanggungan->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_tanggungan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
	<tr id="r_kode_otomatis_master"<?php echo $keu_cicilan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td>
		<td<?php echo $keu_cicilan->kode_otomatis_master->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_master->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_master->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$keu_cicilan_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($keu_cicilan->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$keu_cicilan_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_cicilan_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'keu_cicilan';

	// Page object name
	var $PageObjName = 'keu_cicilan_view';

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
	function ckeu_cicilan_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_cicilan)
		if (!isset($GLOBALS["keu_cicilan"])) {
			$GLOBALS["keu_cicilan"] = new ckeu_cicilan();
			$GLOBALS["Table"] =& $GLOBALS["keu_cicilan"];
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

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS['keu_laporan_keuangan'])) $GLOBALS['keu_laporan_keuangan'] = new ckeu_laporan_keuangan();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_cicilan', TRUE);

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
		global $keu_cicilan;

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
			$this->Page_Terminate("keu_cicilanlist.php");
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
		global $Language, $keu_cicilan;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode_otomatis"] <> "") {
				$keu_cicilan->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$this->RecKey["kode_otomatis"] = $keu_cicilan->kode_otomatis->QueryStringValue;
			} else {
				$sReturnUrl = "keu_cicilanlist.php"; // Return to list
			}

			// Get action
			$keu_cicilan->CurrentAction = "I"; // Display form
			switch ($keu_cicilan->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "keu_cicilanlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "keu_cicilanlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$keu_cicilan->RowType = EW_ROWTYPE_VIEW;
		$keu_cicilan->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_cicilan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_cicilan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_cicilan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_cicilan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_cicilan;
		$sFilter = $keu_cicilan->KeyFilter();

		// Call Row Selecting event
		$keu_cicilan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_cicilan->CurrentFilter = $sFilter;
		$sSql = $keu_cicilan->SQL();
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
		global $conn, $keu_cicilan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_cicilan->Row_Selected($row);
		$keu_cicilan->cicilan->setDbValue($rs->fields('cicilan'));
		$keu_cicilan->tanggal_pembayaran->setDbValue($rs->fields('tanggal_pembayaran'));
		$keu_cicilan->rek_kas->setDbValue($rs->fields('rek_kas'));
		$keu_cicilan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_cicilan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_cicilan->kode_otomatis_tanggungan->setDbValue($rs->fields('kode_otomatis_tanggungan'));
		$keu_cicilan->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_cicilan;

		// Initialize URLs
		$this->AddUrl = $keu_cicilan->AddUrl();
		$this->EditUrl = $keu_cicilan->EditUrl();
		$this->CopyUrl = $keu_cicilan->CopyUrl();
		$this->DeleteUrl = $keu_cicilan->DeleteUrl();
		$this->ListUrl = $keu_cicilan->ListUrl();

		// Call Row_Rendering event
		$keu_cicilan->Row_Rendering();

		// Common render codes for all row types
		// cicilan
		// tanggal_pembayaran
		// rek_kas
		// rek_pendapatan
		// kode_otomatis
		// kode_otomatis_tanggungan
		// kode_otomatis_master

		if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View row

			// cicilan
			$keu_cicilan->cicilan->ViewValue = $keu_cicilan->cicilan->CurrentValue;
			$keu_cicilan->cicilan->ViewCustomAttributes = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->ViewValue = $keu_cicilan->tanggal_pembayaran->CurrentValue;
			$keu_cicilan->tanggal_pembayaran->ViewValue = ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->ViewValue, 7);
			$keu_cicilan->tanggal_pembayaran->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_cicilan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='1' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_kas) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_kas->ViewValue = $keu_cicilan->rek_kas->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_kas->ViewValue = NULL;
			}
			$keu_cicilan->rek_kas->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_cicilan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='4' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_pendapatan->ViewValue = $keu_cicilan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_cicilan->rek_pendapatan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->ViewValue = $keu_cicilan->kode_otomatis->CurrentValue;
			$keu_cicilan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->ViewValue = $keu_cicilan->kode_otomatis_master->CurrentValue;
			$keu_cicilan->kode_otomatis_master->ViewCustomAttributes = "";

			// cicilan
			$keu_cicilan->cicilan->LinkCustomAttributes = "";
			$keu_cicilan->cicilan->HrefValue = "";
			$keu_cicilan->cicilan->TooltipValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->LinkCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";
			$keu_cicilan->tanggal_pembayaran->TooltipValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->LinkCustomAttributes = "";
			$keu_cicilan->rek_kas->HrefValue = "";
			$keu_cicilan->rek_kas->TooltipValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_cicilan->rek_pendapatan->HrefValue = "";
			$keu_cicilan->rek_pendapatan->TooltipValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis->HrefValue = "";
			$keu_cicilan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";
			$keu_cicilan->kode_otomatis_tanggungan->TooltipValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
			$keu_cicilan->kode_otomatis_master->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_cicilan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_cicilan->Row_Rendered();
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
