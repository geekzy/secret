<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_agamainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_agama_edit = new cmaster_agama_edit();
$Page =& $master_agama_edit;

// Page init
$master_agama_edit->Page_Init();

// Page main
$master_agama_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_agama_edit = new ew_Page("master_agama_edit");

// page properties
master_agama_edit.PageID = "edit"; // page ID
master_agama_edit.FormID = "fmaster_agamaedit"; // form ID
var EW_PAGE_ID = master_agama_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
master_agama_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_agama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($master_agama->agama->FldCaption()) ?>");

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
master_agama_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
master_agama_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_agama_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $master_agama->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_agama->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $master_agama_edit->ShowPageHeader(); ?>
<?php
$master_agama_edit->ShowMessage();
?>
<form name="fmaster_agamaedit" id="fmaster_agamaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return master_agama_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="master_agama">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($master_agama->id->Visible) { // id ?>
	<tr id="r_id"<?php echo $master_agama->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_agama->id->FldCaption() ?></td>
		<td<?php echo $master_agama->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $master_agama->id->ViewAttributes() ?>><?php echo $master_agama->id->EditValue ?></div>
<input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($master_agama->id->CurrentValue) ?>">
</span><?php echo $master_agama->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($master_agama->agama->Visible) { // agama ?>
	<tr id="r_agama"<?php echo $master_agama->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_agama->agama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $master_agama->agama->CellAttributes() ?>><span id="el_agama">
<input type="text" name="x_agama" id="x_agama" size="30" maxlength="50" value="<?php echo $master_agama->agama->EditValue ?>"<?php echo $master_agama->agama->EditAttributes() ?>>
</span><?php echo $master_agama->agama->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$master_agama_edit->ShowPageFooter();
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
$master_agama_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_agama_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'master_agama';

	// Page object name
	var $PageObjName = 'master_agama_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_agama;
		if ($master_agama->UseTokenInUrl) $PageUrl .= "t=" . $master_agama->TableVar . "&"; // Add page token
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
		global $objForm, $master_agama;
		if ($master_agama->UseTokenInUrl) {
			if ($objForm)
				return ($master_agama->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_agama->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_agama_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_agama)
		if (!isset($GLOBALS["master_agama"])) {
			$GLOBALS["master_agama"] = new cmaster_agama();
			$GLOBALS["Table"] =& $GLOBALS["master_agama"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_agama', TRUE);

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
		global $master_agama;

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("master_agamalist.php");
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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $master_agama;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$master_agama->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$master_agama->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$master_agama->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$master_agama->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$master_agama->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($master_agama->id->CurrentValue == "")
			$this->Page_Terminate("master_agamalist.php"); // Invalid key, return to list
		switch ($master_agama->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("master_agamalist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$master_agama->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $master_agama->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$master_agama->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$master_agama->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$master_agama->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $master_agama;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $master_agama;
		if (!$master_agama->id->FldIsDetailKey)
			$master_agama->id->setFormValue($objForm->GetValue("x_id"));
		if (!$master_agama->agama->FldIsDetailKey) {
			$master_agama->agama->setFormValue($objForm->GetValue("x_agama"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $master_agama;
		$this->LoadRow();
		$master_agama->id->CurrentValue = $master_agama->id->FormValue;
		$master_agama->agama->CurrentValue = $master_agama->agama->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $master_agama;
		$sFilter = $master_agama->KeyFilter();

		// Call Row Selecting event
		$master_agama->Row_Selecting($sFilter);

		// Load SQL based on filter
		$master_agama->CurrentFilter = $sFilter;
		$sSql = $master_agama->SQL();
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
		global $conn, $master_agama;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$master_agama->Row_Selected($row);
		$master_agama->id->setDbValue($rs->fields('id'));
		$master_agama->agama->setDbValue($rs->fields('agama'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_agama;

		// Initialize URLs
		// Call Row_Rendering event

		$master_agama->Row_Rendering();

		// Common render codes for all row types
		// id
		// agama

		if ($master_agama->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$master_agama->id->ViewValue = $master_agama->id->CurrentValue;
			$master_agama->id->ViewCustomAttributes = "";

			// agama
			$master_agama->agama->ViewValue = $master_agama->agama->CurrentValue;
			$master_agama->agama->ViewCustomAttributes = "";

			// id
			$master_agama->id->LinkCustomAttributes = "";
			$master_agama->id->HrefValue = "";
			$master_agama->id->TooltipValue = "";

			// agama
			$master_agama->agama->LinkCustomAttributes = "";
			$master_agama->agama->HrefValue = "";
			$master_agama->agama->TooltipValue = "";
		} elseif ($master_agama->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$master_agama->id->EditCustomAttributes = "";
			$master_agama->id->EditValue = $master_agama->id->CurrentValue;
			$master_agama->id->ViewCustomAttributes = "";

			// agama
			$master_agama->agama->EditCustomAttributes = "";
			$master_agama->agama->EditValue = ew_HtmlEncode($master_agama->agama->CurrentValue);

			// Edit refer script
			// id

			$master_agama->id->HrefValue = "";

			// agama
			$master_agama->agama->HrefValue = "";
		}
		if ($master_agama->RowType == EW_ROWTYPE_ADD ||
			$master_agama->RowType == EW_ROWTYPE_EDIT ||
			$master_agama->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$master_agama->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($master_agama->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_agama->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $master_agama;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($master_agama->agama->FormValue) && $master_agama->agama->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $master_agama->agama->FldCaption());
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $master_agama;
		$sFilter = $master_agama->KeyFilter();
			if ($master_agama->agama->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`agama` = '" . ew_AdjustSql($master_agama->agama->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$master_agama->CurrentFilter = $sFilterChk;
			$sSqlChk = $master_agama->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'agama', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $master_agama->agama->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$master_agama->CurrentFilter = $sFilter;
		$sSql = $master_agama->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// agama
			$master_agama->agama->SetDbValueDef($rsnew, $master_agama->agama->CurrentValue, "", $master_agama->agama->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $master_agama->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($master_agama->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($master_agama->CancelMessage <> "") {
					$this->setFailureMessage($master_agama->CancelMessage);
					$master_agama->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$master_agama->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
