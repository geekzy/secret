<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_transaksi2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "rekeningjuinfo.php" ?>
<?php include_once "rekeningjugridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_transaksi2_add = new cmaster_transaksi2_add();
$Page =& $master_transaksi2_add;

// Page init
$master_transaksi2_add->Page_Init();

// Page main
$master_transaksi2_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_transaksi2_add = new ew_Page("master_transaksi2_add");

// page properties
master_transaksi2_add.PageID = "add"; // page ID
master_transaksi2_add.FormID = "fmaster_transaksi2add"; // form ID
var EW_PAGE_ID = master_transaksi2_add.PageID; // for backward compatibility

// extend page with ValidateForm function
master_transaksi2_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_penjelasan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_transaksi2->penjelasan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_transaksi2->tanggal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_transaksi2->tanggal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tipe_transaksi"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_transaksi2->tipe_transaksi->FldCaption()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
master_transaksi2_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
master_transaksi2_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_transaksi2_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $master_transaksi2->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_transaksi2->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $master_transaksi2_add->ShowPageHeader(); ?>
<?php
$master_transaksi2_add->ShowMessage();
?>
<form name="fmaster_transaksi2add" id="fmaster_transaksi2add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return master_transaksi2_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="master_transaksi2">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($master_transaksi2->kode_otomatis->CurrentValue) ?>">
<?php if ($master_transaksi2->penjelasan->Visible) { // penjelasan ?>
	<tr id="r_penjelasan"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->penjelasan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_transaksi2->penjelasan->CellAttributes() ?>><span id="el_penjelasan">
<input type="text" name="x_penjelasan" id="x_penjelasan" size="30" maxlength="255" value="<?php echo $master_transaksi2->penjelasan->EditValue ?>"<?php echo $master_transaksi2->penjelasan->EditAttributes() ?>>
</span><?php echo $master_transaksi2->penjelasan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_transaksi2->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->tanggal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_transaksi2->tanggal->CellAttributes() ?>><span id="el_tanggal">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $master_transaksi2->tanggal->EditValue ?>"<?php echo $master_transaksi2->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_tanggal" name="cal_x_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_tanggal" // button id
});
</script>
</span><?php echo $master_transaksi2->tanggal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_transaksi2->tipe_transaksi->Visible) { // tipe_transaksi ?>
	<tr id="r_tipe_transaksi"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->tipe_transaksi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_transaksi2->tipe_transaksi->CellAttributes() ?>><span id="el_tipe_transaksi">
<input type="text" name="x_tipe_transaksi" id="x_tipe_transaksi" size="30" maxlength="50" value="<?php echo $master_transaksi2->tipe_transaksi->EditValue ?>"<?php echo $master_transaksi2->tipe_transaksi->EditAttributes() ?>>
</span><?php echo $master_transaksi2->tipe_transaksi->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($master_transaksi2->getCurrentDetailTable() == "rekeningju" && $rekeningju->DetailAdd) { ?>
<br>
<?php include_once "rekeningjugrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$master_transaksi2_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$master_transaksi2_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_transaksi2_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'master_transaksi2';

	// Page object name
	var $PageObjName = 'master_transaksi2_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_transaksi2;
		if ($master_transaksi2->UseTokenInUrl) $PageUrl .= "t=" . $master_transaksi2->TableVar . "&"; // Add page token
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
		global $objForm, $master_transaksi2;
		if ($master_transaksi2->UseTokenInUrl) {
			if ($objForm)
				return ($master_transaksi2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_transaksi2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_transaksi2_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_transaksi2)
		if (!isset($GLOBALS["master_transaksi2"])) {
			$GLOBALS["master_transaksi2"] = new cmaster_transaksi2();
			$GLOBALS["Table"] =& $GLOBALS["master_transaksi2"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (rekeningju)
		if (!isset($GLOBALS['rekeningju'])) $GLOBALS['rekeningju'] = new crekeningju();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_transaksi2', TRUE);

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
		global $master_transaksi2;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("master_transaksi2list.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $master_transaksi2;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$master_transaksi2->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$master_transaksi2->CurrentAction = "I"; // Form error, reset action
				$master_transaksi2->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["kode_otomatis"] != "") {
				$master_transaksi2->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$master_transaksi2->setKey("kode_otomatis", $master_transaksi2->kode_otomatis->CurrentValue); // Set up key
			} else {
				$master_transaksi2->setKey("kode_otomatis", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$master_transaksi2->CurrentAction = "C"; // Copy record
			} else {
				$master_transaksi2->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($master_transaksi2->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("master_transaksi2list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$master_transaksi2->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($master_transaksi2->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $master_transaksi2->getDetailUrl();
					else
						$sReturnUrl = $master_transaksi2->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "master_transaksi2view.php")
						$sReturnUrl = $master_transaksi2->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$master_transaksi2->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$master_transaksi2->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$master_transaksi2->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $master_transaksi2;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $master_transaksi2;
		$master_transaksi2->kode_otomatis->CurrentValue = unik();
		$master_transaksi2->penjelasan->CurrentValue = "-";
		$master_transaksi2->tanggal->CurrentValue = NULL;
		$master_transaksi2->tanggal->OldValue = $master_transaksi2->tanggal->CurrentValue;
		$master_transaksi2->tipe_transaksi->CurrentValue = "manual";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $master_transaksi2;
		if (!$master_transaksi2->kode_otomatis->FldIsDetailKey) {
			$master_transaksi2->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$master_transaksi2->penjelasan->FldIsDetailKey) {
			$master_transaksi2->penjelasan->setFormValue($objForm->GetValue("x_penjelasan"));
		}
		if (!$master_transaksi2->tanggal->FldIsDetailKey) {
			$master_transaksi2->tanggal->setFormValue($objForm->GetValue("x_tanggal"));
			$master_transaksi2->tanggal->CurrentValue = ew_UnFormatDateTime($master_transaksi2->tanggal->CurrentValue, 7);
		}
		if (!$master_transaksi2->tipe_transaksi->FldIsDetailKey) {
			$master_transaksi2->tipe_transaksi->setFormValue($objForm->GetValue("x_tipe_transaksi"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $master_transaksi2;
		$this->LoadOldRecord();
		$master_transaksi2->kode_otomatis->CurrentValue = $master_transaksi2->kode_otomatis->FormValue;
		$master_transaksi2->penjelasan->CurrentValue = $master_transaksi2->penjelasan->FormValue;
		$master_transaksi2->tanggal->CurrentValue = $master_transaksi2->tanggal->FormValue;
		$master_transaksi2->tanggal->CurrentValue = ew_UnFormatDateTime($master_transaksi2->tanggal->CurrentValue, 7);
		$master_transaksi2->tipe_transaksi->CurrentValue = $master_transaksi2->tipe_transaksi->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $master_transaksi2;
		$sFilter = $master_transaksi2->KeyFilter();

		// Call Row Selecting event
		$master_transaksi2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$master_transaksi2->CurrentFilter = $sFilter;
		$sSql = $master_transaksi2->SQL();
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
		global $conn, $master_transaksi2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$master_transaksi2->Row_Selected($row);
		$master_transaksi2->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$master_transaksi2->penjelasan->setDbValue($rs->fields('penjelasan'));
		$master_transaksi2->tanggal->setDbValue($rs->fields('tanggal'));
		$master_transaksi2->tipe_transaksi->setDbValue($rs->fields('tipe_transaksi'));
		$master_transaksi2->saldo_debet->setDbValue($rs->fields('saldo_debet'));
		$master_transaksi2->saldo_kredit->setDbValue($rs->fields('saldo_kredit'));
	}

	// Load old record
	function LoadOldRecord() {
		global $master_transaksi2;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($master_transaksi2->getKey("kode_otomatis")) <> "")
			$master_transaksi2->kode_otomatis->CurrentValue = $master_transaksi2->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$master_transaksi2->CurrentFilter = $master_transaksi2->KeyFilter();
			$sSql = $master_transaksi2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_transaksi2;

		// Initialize URLs
		// Call Row_Rendering event

		$master_transaksi2->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// penjelasan
		// tanggal
		// tipe_transaksi
		// saldo_debet
		// saldo_kredit

		if ($master_transaksi2->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$master_transaksi2->kode_otomatis->ViewValue = $master_transaksi2->kode_otomatis->CurrentValue;
			$master_transaksi2->kode_otomatis->ViewCustomAttributes = "";

			// penjelasan
			$master_transaksi2->penjelasan->ViewValue = $master_transaksi2->penjelasan->CurrentValue;
			$master_transaksi2->penjelasan->ViewCustomAttributes = "";

			// tanggal
			$master_transaksi2->tanggal->ViewValue = $master_transaksi2->tanggal->CurrentValue;
			$master_transaksi2->tanggal->ViewValue = ew_FormatDateTime($master_transaksi2->tanggal->ViewValue, 7);
			$master_transaksi2->tanggal->ViewCustomAttributes = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->ViewValue = $master_transaksi2->tipe_transaksi->CurrentValue;
			$master_transaksi2->tipe_transaksi->ViewCustomAttributes = "";

			// saldo_debet
			$master_transaksi2->saldo_debet->ViewValue = $master_transaksi2->saldo_debet->CurrentValue;
			$master_transaksi2->saldo_debet->ViewCustomAttributes = "";

			// saldo_kredit
			$master_transaksi2->saldo_kredit->ViewValue = $master_transaksi2->saldo_kredit->CurrentValue;
			$master_transaksi2->saldo_kredit->ViewCustomAttributes = "";

			// kode_otomatis
			$master_transaksi2->kode_otomatis->LinkCustomAttributes = "";
			$master_transaksi2->kode_otomatis->HrefValue = "";
			$master_transaksi2->kode_otomatis->TooltipValue = "";

			// penjelasan
			$master_transaksi2->penjelasan->LinkCustomAttributes = "";
			$master_transaksi2->penjelasan->HrefValue = "";
			$master_transaksi2->penjelasan->TooltipValue = "";

			// tanggal
			$master_transaksi2->tanggal->LinkCustomAttributes = "";
			$master_transaksi2->tanggal->HrefValue = "";
			$master_transaksi2->tanggal->TooltipValue = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->LinkCustomAttributes = "";
			$master_transaksi2->tipe_transaksi->HrefValue = "";
			$master_transaksi2->tipe_transaksi->TooltipValue = "";
		} elseif ($master_transaksi2->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode_otomatis
			$master_transaksi2->kode_otomatis->EditCustomAttributes = "";
			$master_transaksi2->kode_otomatis->CurrentValue = unik();

			// penjelasan
			$master_transaksi2->penjelasan->EditCustomAttributes = "";
			$master_transaksi2->penjelasan->EditValue = ew_HtmlEncode($master_transaksi2->penjelasan->CurrentValue);

			// tanggal
			$master_transaksi2->tanggal->EditCustomAttributes = "";
			$master_transaksi2->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($master_transaksi2->tanggal->CurrentValue, 7));

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->EditCustomAttributes = "";
			$master_transaksi2->tipe_transaksi->EditValue = ew_HtmlEncode($master_transaksi2->tipe_transaksi->CurrentValue);

			// Edit refer script
			// kode_otomatis

			$master_transaksi2->kode_otomatis->HrefValue = "";

			// penjelasan
			$master_transaksi2->penjelasan->HrefValue = "";

			// tanggal
			$master_transaksi2->tanggal->HrefValue = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->HrefValue = "";
		}
		if ($master_transaksi2->RowType == EW_ROWTYPE_ADD ||
			$master_transaksi2->RowType == EW_ROWTYPE_EDIT ||
			$master_transaksi2->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$master_transaksi2->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($master_transaksi2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_transaksi2->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $master_transaksi2;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($master_transaksi2->penjelasan->FormValue) && $master_transaksi2->penjelasan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_transaksi2->penjelasan->FldCaption());
		}
		if (!is_null($master_transaksi2->tanggal->FormValue) && $master_transaksi2->tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_transaksi2->tanggal->FldCaption());
		}
		if (!ew_CheckEuroDate($master_transaksi2->tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $master_transaksi2->tanggal->FldErrMsg());
		}
		if (!is_null($master_transaksi2->tipe_transaksi->FormValue) && $master_transaksi2->tipe_transaksi->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_transaksi2->tipe_transaksi->FldCaption());
		}

		// Validate detail grid
		if ($master_transaksi2->getCurrentDetailTable() == "rekeningju" && $GLOBALS["rekeningju"]->DetailAdd) {
			$rekeningju_grid = new crekeningju_grid(); // get detail page object
			$rekeningju_grid->ValidateGridForm();
			$rekeningju_grid = NULL;
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $master_transaksi2;

		// Check if key value entered
		if ($master_transaksi2->kode_otomatis->CurrentValue == "" && $master_transaksi2->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $master_transaksi2->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $master_transaksi2->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}

		// Begin transaction
		if ($master_transaksi2->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// kode_otomatis
		$master_transaksi2->kode_otomatis->SetDbValueDef($rsnew, $master_transaksi2->kode_otomatis->CurrentValue, "", FALSE);

		// penjelasan
		$master_transaksi2->penjelasan->SetDbValueDef($rsnew, $master_transaksi2->penjelasan->CurrentValue, "", strval($master_transaksi2->penjelasan->CurrentValue) == "");

		// tanggal
		$master_transaksi2->tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($master_transaksi2->tanggal->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// tipe_transaksi
		$master_transaksi2->tipe_transaksi->SetDbValueDef($rsnew, $master_transaksi2->tipe_transaksi->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $master_transaksi2->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($master_transaksi2->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($master_transaksi2->CancelMessage <> "") {
				$this->setFailureMessage($master_transaksi2->CancelMessage);
				$master_transaksi2->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}

		// Add detail records
		if ($AddRow) {
			if ($master_transaksi2->getCurrentDetailTable() == "rekeningju" && $GLOBALS["rekeningju"]->DetailAdd) {
				$GLOBALS["rekeningju"]->kode_otomatis_master->setSessionValue($master_transaksi2->kode_otomatis->CurrentValue); // Set master key
				$rekeningju_grid = new crekeningju_grid(); // get detail page object
				$AddRow = $rekeningju_grid->GridInsert();
				$rekeningju_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($master_transaksi2->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$master_transaksi2->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $master_transaksi2;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$master_transaksi2->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $master_transaksi2->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "rekeningju") {
				if (!isset($GLOBALS["rekeningju"]))
					$GLOBALS["rekeningju"] = new crekeningju;
				if ($GLOBALS["rekeningju"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["rekeningju"]->CurrentMode = "copy";
					else
						$GLOBALS["rekeningju"]->CurrentMode = "add";
					$GLOBALS["rekeningju"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["rekeningju"]->setCurrentMasterTable($master_transaksi2->TableVar);
					$GLOBALS["rekeningju"]->setStartRecordNumber(1);
					$GLOBALS["rekeningju"]->kode_otomatis_master->FldIsDetailKey = TRUE;
					$GLOBALS["rekeningju"]->kode_otomatis_master->CurrentValue = $master_transaksi2->kode_otomatis->CurrentValue;
					$GLOBALS["rekeningju"]->kode_otomatis_master->setSessionValue($GLOBALS["rekeningju"]->kode_otomatis_master->CurrentValue);
				}
			}
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
