<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subsaturekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subsaturek_add = new csubsaturek_add();
$Page =& $subsaturek_add;

// Page init
$subsaturek_add->Page_Init();

// Page main
$subsaturek_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subsaturek_add = new ew_Page("subsaturek_add");

// page properties
subsaturek_add.PageID = "add"; // page ID
subsaturek_add.FormID = "fsubsaturekadd"; // form ID
var EW_PAGE_ID = subsaturek_add.PageID; // for backward compatibility

// extend page with ValidateForm function
subsaturek_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";

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
subsaturek_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subsaturek_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subsaturek_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subsaturek->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subsaturek->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subsaturek_add->ShowPageHeader(); ?>
<?php
$subsaturek_add->ShowMessage();
?>
<form name="fsubsaturekadd" id="fsubsaturekadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subsaturek_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="subsaturek">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subsaturek->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<tr id="r_kodeSubSatu"<?php echo $subsaturek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subsaturek->kodeSubSatu->FldCaption() ?></td>
		<td<?php echo $subsaturek->kodeSubSatu->CellAttributes() ?>><span id="el_kodeSubSatu">
<input type="text" name="x_kodeSubSatu" id="x_kodeSubSatu" size="30" maxlength="50" value="<?php echo $subsaturek->kodeSubSatu->EditValue ?>"<?php echo $subsaturek->kodeSubSatu->EditAttributes() ?>>
</span><?php echo $subsaturek->kodeSubSatu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subsaturek->namaSubSatu->Visible) { // namaSubSatu ?>
	<tr id="r_namaSubSatu"<?php echo $subsaturek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subsaturek->namaSubSatu->FldCaption() ?></td>
		<td<?php echo $subsaturek->namaSubSatu->CellAttributes() ?>><span id="el_namaSubSatu">
<input type="text" name="x_namaSubSatu" id="x_namaSubSatu" size="30" maxlength="50" value="<?php echo $subsaturek->namaSubSatu->EditValue ?>"<?php echo $subsaturek->namaSubSatu->EditAttributes() ?>>
</span><?php echo $subsaturek->namaSubSatu->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kodePokok" id="x_kodePokok" value="<?php echo ew_HtmlEncode($subsaturek->kodePokok->CurrentValue) ?>">
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$subsaturek_add->ShowPageFooter();
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
$subsaturek_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csubsaturek_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'subsaturek';

	// Page object name
	var $PageObjName = 'subsaturek_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subsaturek;
		if ($subsaturek->UseTokenInUrl) $PageUrl .= "t=" . $subsaturek->TableVar . "&"; // Add page token
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
		global $objForm, $subsaturek;
		if ($subsaturek->UseTokenInUrl) {
			if ($objForm)
				return ($subsaturek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subsaturek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubsaturek_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subsaturek)
		if (!isset($GLOBALS["subsaturek"])) {
			$GLOBALS["subsaturek"] = new csubsaturek();
			$GLOBALS["Table"] =& $GLOBALS["subsaturek"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subsaturek', TRUE);

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
		global $subsaturek;

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
			$this->Page_Terminate("subsatureklist.php");
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
		global $objForm, $Language, $gsFormError, $subsaturek;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$subsaturek->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subsaturek->CurrentAction = "I"; // Form error, reset action
				$subsaturek->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$subsaturek->id->setQueryStringValue($_GET["id"]);
				$subsaturek->setKey("id", $subsaturek->id->CurrentValue); // Set up key
			} else {
				$subsaturek->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$subsaturek->CurrentAction = "C"; // Copy record
			} else {
				$subsaturek->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($subsaturek->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subsatureklist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$subsaturek->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $subsaturek->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "subsaturekview.php")
						$sReturnUrl = $subsaturek->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$subsaturek->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$subsaturek->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$subsaturek->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subsaturek;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $subsaturek;
		$subsaturek->kodeSubSatu->CurrentValue = NULL;
		$subsaturek->kodeSubSatu->OldValue = $subsaturek->kodeSubSatu->CurrentValue;
		$subsaturek->namaSubSatu->CurrentValue = NULL;
		$subsaturek->namaSubSatu->OldValue = $subsaturek->namaSubSatu->CurrentValue;
		$subsaturek->kodePokok->CurrentValue = $_SESSION["kode_pokok"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subsaturek;
		if (!$subsaturek->kodeSubSatu->FldIsDetailKey) {
			$subsaturek->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
		if (!$subsaturek->namaSubSatu->FldIsDetailKey) {
			$subsaturek->namaSubSatu->setFormValue($objForm->GetValue("x_namaSubSatu"));
		}
		if (!$subsaturek->kodePokok->FldIsDetailKey) {
			$subsaturek->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subsaturek;
		$this->LoadOldRecord();
		$subsaturek->kodeSubSatu->CurrentValue = $subsaturek->kodeSubSatu->FormValue;
		$subsaturek->namaSubSatu->CurrentValue = $subsaturek->namaSubSatu->FormValue;
		$subsaturek->kodePokok->CurrentValue = $subsaturek->kodePokok->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subsaturek;
		$sFilter = $subsaturek->KeyFilter();

		// Call Row Selecting event
		$subsaturek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subsaturek->CurrentFilter = $sFilter;
		$sSql = $subsaturek->SQL();
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
		global $conn, $subsaturek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subsaturek->Row_Selected($row);
		$subsaturek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subsaturek->namaSubSatu->setDbValue($rs->fields('namaSubSatu'));
		$subsaturek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subsaturek->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subsaturek;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subsaturek->getKey("id")) <> "")
			$subsaturek->id->CurrentValue = $subsaturek->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subsaturek->CurrentFilter = $subsaturek->KeyFilter();
			$sSql = $subsaturek->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subsaturek;

		// Initialize URLs
		// Call Row_Rendering event

		$subsaturek->Row_Rendering();

		// Common render codes for all row types
		// kodeSubSatu
		// namaSubSatu
		// kodePokok
		// id

		if ($subsaturek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodeSubSatu
			$subsaturek->kodeSubSatu->ViewValue = $subsaturek->kodeSubSatu->CurrentValue;
			$subsaturek->kodeSubSatu->ViewCustomAttributes = "";

			// namaSubSatu
			$subsaturek->namaSubSatu->ViewValue = $subsaturek->namaSubSatu->CurrentValue;
			$subsaturek->namaSubSatu->ViewCustomAttributes = "";

			// kodePokok
			$subsaturek->kodePokok->ViewValue = $subsaturek->kodePokok->CurrentValue;
			$subsaturek->kodePokok->ViewCustomAttributes = "";

			// id
			$subsaturek->id->ViewValue = $subsaturek->id->CurrentValue;
			$subsaturek->id->ViewCustomAttributes = "";

			// kodeSubSatu
			$subsaturek->kodeSubSatu->LinkCustomAttributes = "";
			$subsaturek->kodeSubSatu->HrefValue = "";
			$subsaturek->kodeSubSatu->TooltipValue = "";

			// namaSubSatu
			$subsaturek->namaSubSatu->LinkCustomAttributes = "";
			$subsaturek->namaSubSatu->HrefValue = "";
			$subsaturek->namaSubSatu->TooltipValue = "";

			// kodePokok
			$subsaturek->kodePokok->LinkCustomAttributes = "";
			$subsaturek->kodePokok->HrefValue = "";
			$subsaturek->kodePokok->TooltipValue = "";
		} elseif ($subsaturek->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodeSubSatu
			$subsaturek->kodeSubSatu->EditCustomAttributes = "";
			$subsaturek->kodeSubSatu->EditValue = ew_HtmlEncode($subsaturek->kodeSubSatu->CurrentValue);

			// namaSubSatu
			$subsaturek->namaSubSatu->EditCustomAttributes = "";
			$subsaturek->namaSubSatu->EditValue = ew_HtmlEncode($subsaturek->namaSubSatu->CurrentValue);

			// kodePokok
			$subsaturek->kodePokok->EditCustomAttributes = "";
			$subsaturek->kodePokok->CurrentValue = $_SESSION["kode_pokok"];

			// Edit refer script
			// kodeSubSatu

			$subsaturek->kodeSubSatu->HrefValue = "";

			// namaSubSatu
			$subsaturek->namaSubSatu->HrefValue = "";

			// kodePokok
			$subsaturek->kodePokok->HrefValue = "";
		}
		if ($subsaturek->RowType == EW_ROWTYPE_ADD ||
			$subsaturek->RowType == EW_ROWTYPE_EDIT ||
			$subsaturek->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subsaturek->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subsaturek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subsaturek->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subsaturek;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Language, $Security, $subsaturek;
		$rsnew = array();

		// kodeSubSatu
		$subsaturek->kodeSubSatu->SetDbValueDef($rsnew, $subsaturek->kodeSubSatu->CurrentValue, NULL, FALSE);

		// namaSubSatu
		$subsaturek->namaSubSatu->SetDbValueDef($rsnew, $subsaturek->namaSubSatu->CurrentValue, NULL, FALSE);

		// kodePokok
		$subsaturek->kodePokok->SetDbValueDef($rsnew, $subsaturek->kodePokok->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $subsaturek->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($subsaturek->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($subsaturek->CancelMessage <> "") {
				$this->setFailureMessage($subsaturek->CancelMessage);
				$subsaturek->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$subsaturek->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $subsaturek->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$subsaturek->Row_Inserted($rs, $rsnew);
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
