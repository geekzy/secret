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
$sch_master_lembaga_add = new csch_master_lembaga_add();
$Page =& $sch_master_lembaga_add;

// Page init
$sch_master_lembaga_add->Page_Init();

// Page main
$sch_master_lembaga_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sch_master_lembaga_add = new ew_Page("sch_master_lembaga_add");

// page properties
sch_master_lembaga_add.PageID = "add"; // page ID
sch_master_lembaga_add.FormID = "fsch_master_lembagaadd"; // form ID
var EW_PAGE_ID = sch_master_lembaga_add.PageID; // for backward compatibility

// extend page with ValidateForm function
sch_master_lembaga_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kode_lembaga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($sch_master_lembaga->kode_lembaga->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_lembaga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($sch_master_lembaga->nama_lembaga->FldCaption()) ?>");

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
sch_master_lembaga_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sch_master_lembaga_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sch_master_lembaga_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sch_master_lembaga->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $sch_master_lembaga->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $sch_master_lembaga_add->ShowPageHeader(); ?>
<?php
$sch_master_lembaga_add->ShowMessage();
?>
<form name="fsch_master_lembagaadd" id="fsch_master_lembagaadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return sch_master_lembaga_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="sch_master_lembaga">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sch_master_lembaga->kode_lembaga->Visible) { // kode_lembaga ?>
	<tr id="r_kode_lembaga"<?php echo $sch_master_lembaga->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sch_master_lembaga->kode_lembaga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $sch_master_lembaga->kode_lembaga->CellAttributes() ?>><span id="el_kode_lembaga">
<input type="text" name="x_kode_lembaga" id="x_kode_lembaga" size="30" maxlength="50" value="<?php echo $sch_master_lembaga->kode_lembaga->EditValue ?>"<?php echo $sch_master_lembaga->kode_lembaga->EditAttributes() ?>>
</span><?php echo $sch_master_lembaga->kode_lembaga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($sch_master_lembaga->nama_lembaga->Visible) { // nama_lembaga ?>
	<tr id="r_nama_lembaga"<?php echo $sch_master_lembaga->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sch_master_lembaga->nama_lembaga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $sch_master_lembaga->nama_lembaga->CellAttributes() ?>><span id="el_nama_lembaga">
<input type="text" name="x_nama_lembaga" id="x_nama_lembaga" size="30" maxlength="50" value="<?php echo $sch_master_lembaga->nama_lembaga->EditValue ?>"<?php echo $sch_master_lembaga->nama_lembaga->EditAttributes() ?>>
</span><?php echo $sch_master_lembaga->nama_lembaga->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$sch_master_lembaga_add->ShowPageFooter();
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
$sch_master_lembaga_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csch_master_lembaga_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'sch_master_lembaga';

	// Page object name
	var $PageObjName = 'sch_master_lembaga_add';

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
	function csch_master_lembaga_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (sch_master_lembaga)
		if (!isset($GLOBALS["sch_master_lembaga"])) {
			$GLOBALS["sch_master_lembaga"] = new csch_master_lembaga();
			$GLOBALS["Table"] =& $GLOBALS["sch_master_lembaga"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sch_master_lembaga', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("sch_master_lembagalist.php");
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
		global $objForm, $Language, $gsFormError, $sch_master_lembaga;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$sch_master_lembaga->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$sch_master_lembaga->CurrentAction = "I"; // Form error, reset action
				$sch_master_lembaga->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["kode_lembaga"] != "") {
				$sch_master_lembaga->kode_lembaga->setQueryStringValue($_GET["kode_lembaga"]);
				$sch_master_lembaga->setKey("kode_lembaga", $sch_master_lembaga->kode_lembaga->CurrentValue); // Set up key
			} else {
				$sch_master_lembaga->setKey("kode_lembaga", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$sch_master_lembaga->CurrentAction = "C"; // Copy record
			} else {
				$sch_master_lembaga->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($sch_master_lembaga->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("sch_master_lembagalist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$sch_master_lembaga->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $sch_master_lembaga->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "sch_master_lembagaview.php")
						$sReturnUrl = $sch_master_lembaga->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$sch_master_lembaga->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$sch_master_lembaga->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$sch_master_lembaga->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $sch_master_lembaga;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $sch_master_lembaga;
		$sch_master_lembaga->kode_lembaga->CurrentValue = NULL;
		$sch_master_lembaga->kode_lembaga->OldValue = $sch_master_lembaga->kode_lembaga->CurrentValue;
		$sch_master_lembaga->nama_lembaga->CurrentValue = NULL;
		$sch_master_lembaga->nama_lembaga->OldValue = $sch_master_lembaga->nama_lembaga->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $sch_master_lembaga;
		if (!$sch_master_lembaga->kode_lembaga->FldIsDetailKey) {
			$sch_master_lembaga->kode_lembaga->setFormValue($objForm->GetValue("x_kode_lembaga"));
		}
		if (!$sch_master_lembaga->nama_lembaga->FldIsDetailKey) {
			$sch_master_lembaga->nama_lembaga->setFormValue($objForm->GetValue("x_nama_lembaga"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $sch_master_lembaga;
		$this->LoadOldRecord();
		$sch_master_lembaga->kode_lembaga->CurrentValue = $sch_master_lembaga->kode_lembaga->FormValue;
		$sch_master_lembaga->nama_lembaga->CurrentValue = $sch_master_lembaga->nama_lembaga->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $sch_master_lembaga;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($sch_master_lembaga->getKey("kode_lembaga")) <> "")
			$sch_master_lembaga->kode_lembaga->CurrentValue = $sch_master_lembaga->getKey("kode_lembaga"); // kode_lembaga
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$sch_master_lembaga->CurrentFilter = $sch_master_lembaga->KeyFilter();
			$sSql = $sch_master_lembaga->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sch_master_lembaga;

		// Initialize URLs
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
		} elseif ($sch_master_lembaga->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode_lembaga
			$sch_master_lembaga->kode_lembaga->EditCustomAttributes = "";
			$sch_master_lembaga->kode_lembaga->EditValue = ew_HtmlEncode($sch_master_lembaga->kode_lembaga->CurrentValue);

			// nama_lembaga
			$sch_master_lembaga->nama_lembaga->EditCustomAttributes = "";
			$sch_master_lembaga->nama_lembaga->EditValue = ew_HtmlEncode($sch_master_lembaga->nama_lembaga->CurrentValue);

			// Edit refer script
			// kode_lembaga

			$sch_master_lembaga->kode_lembaga->HrefValue = "";

			// nama_lembaga
			$sch_master_lembaga->nama_lembaga->HrefValue = "";
		}
		if ($sch_master_lembaga->RowType == EW_ROWTYPE_ADD ||
			$sch_master_lembaga->RowType == EW_ROWTYPE_EDIT ||
			$sch_master_lembaga->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$sch_master_lembaga->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($sch_master_lembaga->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sch_master_lembaga->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $sch_master_lembaga;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($sch_master_lembaga->kode_lembaga->FormValue) && $sch_master_lembaga->kode_lembaga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $sch_master_lembaga->kode_lembaga->FldCaption());
		}
		if (!is_null($sch_master_lembaga->nama_lembaga->FormValue) && $sch_master_lembaga->nama_lembaga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $sch_master_lembaga->nama_lembaga->FldCaption());
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
		global $conn, $Language, $Security, $sch_master_lembaga;

		// Check if key value entered
		if ($sch_master_lembaga->kode_lembaga->CurrentValue == "" && $sch_master_lembaga->kode_lembaga->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $sch_master_lembaga->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $sch_master_lembaga->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($sch_master_lembaga->kode_lembaga->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_lembaga = '" . ew_AdjustSql($sch_master_lembaga->kode_lembaga->CurrentValue) . "')";
			$rsChk = $sch_master_lembaga->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_lembaga', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $sch_master_lembaga->kode_lembaga->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($sch_master_lembaga->nama_lembaga->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nama_lembaga = '" . ew_AdjustSql($sch_master_lembaga->nama_lembaga->CurrentValue) . "')";
			$rsChk = $sch_master_lembaga->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'nama_lembaga', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $sch_master_lembaga->nama_lembaga->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// kode_lembaga
		$sch_master_lembaga->kode_lembaga->SetDbValueDef($rsnew, $sch_master_lembaga->kode_lembaga->CurrentValue, "", FALSE);

		// nama_lembaga
		$sch_master_lembaga->nama_lembaga->SetDbValueDef($rsnew, $sch_master_lembaga->nama_lembaga->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $sch_master_lembaga->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($sch_master_lembaga->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($sch_master_lembaga->CancelMessage <> "") {
				$this->setFailureMessage($sch_master_lembaga->CancelMessage);
				$sch_master_lembaga->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$sch_master_lembaga->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
