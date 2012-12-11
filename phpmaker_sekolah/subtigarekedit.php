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
$subtigarek_edit = new csubtigarek_edit();
$Page =& $subtigarek_edit;

// Page init
$subtigarek_edit->Page_Init();

// Page main
$subtigarek_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subtigarek_edit = new ew_Page("subtigarek_edit");

// page properties
subtigarek_edit.PageID = "edit"; // page ID
subtigarek_edit.FormID = "fsubtigarekedit"; // form ID
var EW_PAGE_ID = subtigarek_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
subtigarek_edit.ValidateForm = function(fobj) {
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
subtigarek_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subtigarek_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subtigarek_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subtigarek->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subtigarek->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subtigarek_edit->ShowPageHeader(); ?>
<?php
$subtigarek_edit->ShowMessage();
?>
<form name="fsubtigarekedit" id="fsubtigarekedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subtigarek_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="subtigarek">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<input type="hidden" name="x_kodePokok" id="x_kodePokok" value="<?php echo ew_HtmlEncode($subtigarek->kodePokok->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubSatu" id="x_kodeSubSatu" value="<?php echo ew_HtmlEncode($subtigarek->kodeSubSatu->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubDua" id="x_kodeSubDua" value="<?php echo ew_HtmlEncode($subtigarek->kodeSubDua->CurrentValue) ?>">
<?php if ($subtigarek->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<tr id="r_kodeSubTiga"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->kodeSubTiga->FldCaption() ?></td>
		<td<?php echo $subtigarek->kodeSubTiga->CellAttributes() ?>><span id="el_kodeSubTiga">
<input type="text" name="x_kodeSubTiga" id="x_kodeSubTiga" size="30" maxlength="50" value="<?php echo $subtigarek->kodeSubTiga->EditValue ?>"<?php echo $subtigarek->kodeSubTiga->EditAttributes() ?>>
</span><?php echo $subtigarek->kodeSubTiga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->namaSubTiga->Visible) { // namaSubTiga ?>
	<tr id="r_namaSubTiga"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->namaSubTiga->FldCaption() ?></td>
		<td<?php echo $subtigarek->namaSubTiga->CellAttributes() ?>><span id="el_namaSubTiga">
<input type="text" name="x_namaSubTiga" id="x_namaSubTiga" size="30" maxlength="50" value="<?php echo $subtigarek->namaSubTiga->EditValue ?>"<?php echo $subtigarek->namaSubTiga->EditAttributes() ?>>
</span><?php echo $subtigarek->namaSubTiga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subtigarek->id->Visible) { // id ?>
	<tr id="r_id"<?php echo $subtigarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subtigarek->id->FldCaption() ?></td>
		<td<?php echo $subtigarek->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $subtigarek->id->ViewAttributes() ?>><?php echo $subtigarek->id->EditValue ?></div>
<input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($subtigarek->id->CurrentValue) ?>">
</span><?php echo $subtigarek->id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$subtigarek_edit->ShowPageFooter();
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
$subtigarek_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csubtigarek_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'subtigarek';

	// Page object name
	var $PageObjName = 'subtigarek_edit';

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
	function csubtigarek_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subtigarek)
		if (!isset($GLOBALS["subtigarek"])) {
			$GLOBALS["subtigarek"] = new csubtigarek();
			$GLOBALS["Table"] =& $GLOBALS["subtigarek"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subtigarek', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("subtigareklist.php");
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
		global $objForm, $Language, $gsFormError, $subtigarek;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$subtigarek->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$subtigarek->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subtigarek->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$subtigarek->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$subtigarek->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($subtigarek->id->CurrentValue == "")
			$this->Page_Terminate("subtigareklist.php"); // Invalid key, return to list
		switch ($subtigarek->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subtigareklist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$subtigarek->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $subtigarek->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$subtigarek->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$subtigarek->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$subtigarek->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subtigarek;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subtigarek;
		if (!$subtigarek->kodePokok->FldIsDetailKey) {
			$subtigarek->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
		if (!$subtigarek->kodeSubSatu->FldIsDetailKey) {
			$subtigarek->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
		if (!$subtigarek->kodeSubDua->FldIsDetailKey) {
			$subtigarek->kodeSubDua->setFormValue($objForm->GetValue("x_kodeSubDua"));
		}
		if (!$subtigarek->kodeSubTiga->FldIsDetailKey) {
			$subtigarek->kodeSubTiga->setFormValue($objForm->GetValue("x_kodeSubTiga"));
		}
		if (!$subtigarek->namaSubTiga->FldIsDetailKey) {
			$subtigarek->namaSubTiga->setFormValue($objForm->GetValue("x_namaSubTiga"));
		}
		if (!$subtigarek->id->FldIsDetailKey)
			$subtigarek->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subtigarek;
		$this->LoadRow();
		$subtigarek->kodePokok->CurrentValue = $subtigarek->kodePokok->FormValue;
		$subtigarek->kodeSubSatu->CurrentValue = $subtigarek->kodeSubSatu->FormValue;
		$subtigarek->kodeSubDua->CurrentValue = $subtigarek->kodeSubDua->FormValue;
		$subtigarek->kodeSubTiga->CurrentValue = $subtigarek->kodeSubTiga->FormValue;
		$subtigarek->namaSubTiga->CurrentValue = $subtigarek->namaSubTiga->FormValue;
		$subtigarek->id->CurrentValue = $subtigarek->id->FormValue;
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
		} elseif ($subtigarek->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kodePokok
			$subtigarek->kodePokok->EditCustomAttributes = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->EditCustomAttributes = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->EditCustomAttributes = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->EditCustomAttributes = "";
			$subtigarek->kodeSubTiga->EditValue = ew_HtmlEncode($subtigarek->kodeSubTiga->CurrentValue);

			// namaSubTiga
			$subtigarek->namaSubTiga->EditCustomAttributes = "";
			$subtigarek->namaSubTiga->EditValue = ew_HtmlEncode($subtigarek->namaSubTiga->CurrentValue);

			// id
			$subtigarek->id->EditCustomAttributes = "";
			$subtigarek->id->EditValue = $subtigarek->id->CurrentValue;
			$subtigarek->id->ViewCustomAttributes = "";

			// Edit refer script
			// kodePokok

			$subtigarek->kodePokok->HrefValue = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->HrefValue = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->HrefValue = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->HrefValue = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->HrefValue = "";

			// id
			$subtigarek->id->HrefValue = "";
		}
		if ($subtigarek->RowType == EW_ROWTYPE_ADD ||
			$subtigarek->RowType == EW_ROWTYPE_EDIT ||
			$subtigarek->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subtigarek->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subtigarek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subtigarek->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subtigarek;

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $subtigarek;
		$sFilter = $subtigarek->KeyFilter();
		$subtigarek->CurrentFilter = $sFilter;
		$sSql = $subtigarek->SQL();
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

			// kodePokok
			$subtigarek->kodePokok->SetDbValueDef($rsnew, $subtigarek->kodePokok->CurrentValue, NULL, $subtigarek->kodePokok->ReadOnly);

			// kodeSubSatu
			$subtigarek->kodeSubSatu->SetDbValueDef($rsnew, $subtigarek->kodeSubSatu->CurrentValue, NULL, $subtigarek->kodeSubSatu->ReadOnly);

			// kodeSubDua
			$subtigarek->kodeSubDua->SetDbValueDef($rsnew, $subtigarek->kodeSubDua->CurrentValue, NULL, $subtigarek->kodeSubDua->ReadOnly);

			// kodeSubTiga
			$subtigarek->kodeSubTiga->SetDbValueDef($rsnew, $subtigarek->kodeSubTiga->CurrentValue, NULL, $subtigarek->kodeSubTiga->ReadOnly);

			// namaSubTiga
			$subtigarek->namaSubTiga->SetDbValueDef($rsnew, $subtigarek->namaSubTiga->CurrentValue, NULL, $subtigarek->namaSubTiga->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $subtigarek->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($subtigarek->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($subtigarek->CancelMessage <> "") {
					$this->setFailureMessage($subtigarek->CancelMessage);
					$subtigarek->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subtigarek->Row_Updated($rsold, $rsnew);
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
