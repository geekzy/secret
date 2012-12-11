<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subduarekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subduarek_add = new csubduarek_add();
$Page =& $subduarek_add;

// Page init
$subduarek_add->Page_Init();

// Page main
$subduarek_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subduarek_add = new ew_Page("subduarek_add");

// page properties
subduarek_add.PageID = "add"; // page ID
subduarek_add.FormID = "fsubduarekadd"; // form ID
var EW_PAGE_ID = subduarek_add.PageID; // for backward compatibility

// extend page with ValidateForm function
subduarek_add.ValidateForm = function(fobj) {
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
subduarek_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subduarek_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subduarek_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subduarek->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subduarek->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subduarek_add->ShowPageHeader(); ?>
<?php
$subduarek_add->ShowMessage();
?>
<form name="fsubduarekadd" id="fsubduarekadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subduarek_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="subduarek">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<input type="hidden" name="x_kodePokok" id="x_kodePokok" value="<?php echo ew_HtmlEncode($subduarek->kodePokok->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubSatu" id="x_kodeSubSatu" value="<?php echo ew_HtmlEncode($subduarek->kodeSubSatu->CurrentValue) ?>">
<?php if ($subduarek->kodeSubDua->Visible) { // kodeSubDua ?>
	<tr id="r_kodeSubDua"<?php echo $subduarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subduarek->kodeSubDua->FldCaption() ?></td>
		<td<?php echo $subduarek->kodeSubDua->CellAttributes() ?>><span id="el_kodeSubDua">
<input type="text" name="x_kodeSubDua" id="x_kodeSubDua" size="30" maxlength="50" value="<?php echo $subduarek->kodeSubDua->EditValue ?>"<?php echo $subduarek->kodeSubDua->EditAttributes() ?>>
</span><?php echo $subduarek->kodeSubDua->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subduarek->namaSubDua->Visible) { // namaSubDua ?>
	<tr id="r_namaSubDua"<?php echo $subduarek->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subduarek->namaSubDua->FldCaption() ?></td>
		<td<?php echo $subduarek->namaSubDua->CellAttributes() ?>><span id="el_namaSubDua">
<input type="text" name="x_namaSubDua" id="x_namaSubDua" size="30" maxlength="50" value="<?php echo $subduarek->namaSubDua->EditValue ?>"<?php echo $subduarek->namaSubDua->EditAttributes() ?>>
</span><?php echo $subduarek->namaSubDua->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$subduarek_add->ShowPageFooter();
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
$subduarek_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csubduarek_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'subduarek';

	// Page object name
	var $PageObjName = 'subduarek_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subduarek;
		if ($subduarek->UseTokenInUrl) $PageUrl .= "t=" . $subduarek->TableVar . "&"; // Add page token
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
		global $objForm, $subduarek;
		if ($subduarek->UseTokenInUrl) {
			if ($objForm)
				return ($subduarek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subduarek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubduarek_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subduarek)
		if (!isset($GLOBALS["subduarek"])) {
			$GLOBALS["subduarek"] = new csubduarek();
			$GLOBALS["Table"] =& $GLOBALS["subduarek"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subduarek', TRUE);

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
		global $subduarek;

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
			$this->Page_Terminate("subduareklist.php");
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
		global $objForm, $Language, $gsFormError, $subduarek;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$subduarek->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subduarek->CurrentAction = "I"; // Form error, reset action
				$subduarek->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$subduarek->id->setQueryStringValue($_GET["id"]);
				$subduarek->setKey("id", $subduarek->id->CurrentValue); // Set up key
			} else {
				$subduarek->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$subduarek->CurrentAction = "C"; // Copy record
			} else {
				$subduarek->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($subduarek->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subduareklist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$subduarek->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $subduarek->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "subduarekview.php")
						$sReturnUrl = $subduarek->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$subduarek->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$subduarek->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$subduarek->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subduarek;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $subduarek;
		$subduarek->kodePokok->CurrentValue = $_SESSION["kode_pokok"];
		$subduarek->kodeSubSatu->CurrentValue = $_SESSION["kode_sub_satu"];
		$subduarek->kodeSubDua->CurrentValue = NULL;
		$subduarek->kodeSubDua->OldValue = $subduarek->kodeSubDua->CurrentValue;
		$subduarek->namaSubDua->CurrentValue = NULL;
		$subduarek->namaSubDua->OldValue = $subduarek->namaSubDua->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subduarek;
		if (!$subduarek->kodePokok->FldIsDetailKey) {
			$subduarek->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
		if (!$subduarek->kodeSubSatu->FldIsDetailKey) {
			$subduarek->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
		if (!$subduarek->kodeSubDua->FldIsDetailKey) {
			$subduarek->kodeSubDua->setFormValue($objForm->GetValue("x_kodeSubDua"));
		}
		if (!$subduarek->namaSubDua->FldIsDetailKey) {
			$subduarek->namaSubDua->setFormValue($objForm->GetValue("x_namaSubDua"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subduarek;
		$this->LoadOldRecord();
		$subduarek->kodePokok->CurrentValue = $subduarek->kodePokok->FormValue;
		$subduarek->kodeSubSatu->CurrentValue = $subduarek->kodeSubSatu->FormValue;
		$subduarek->kodeSubDua->CurrentValue = $subduarek->kodeSubDua->FormValue;
		$subduarek->namaSubDua->CurrentValue = $subduarek->namaSubDua->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subduarek;
		$sFilter = $subduarek->KeyFilter();

		// Call Row Selecting event
		$subduarek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subduarek->CurrentFilter = $sFilter;
		$sSql = $subduarek->SQL();
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
		global $conn, $subduarek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subduarek->Row_Selected($row);
		$subduarek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subduarek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subduarek->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$subduarek->namaSubDua->setDbValue($rs->fields('namaSubDua'));
		$subduarek->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subduarek;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subduarek->getKey("id")) <> "")
			$subduarek->id->CurrentValue = $subduarek->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subduarek->CurrentFilter = $subduarek->KeyFilter();
			$sSql = $subduarek->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subduarek;

		// Initialize URLs
		// Call Row_Rendering event

		$subduarek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// namaSubDua
		// id

		if ($subduarek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$subduarek->kodePokok->ViewValue = $subduarek->kodePokok->CurrentValue;
			$subduarek->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$subduarek->kodeSubSatu->ViewValue = $subduarek->kodeSubSatu->CurrentValue;
			$subduarek->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$subduarek->kodeSubDua->ViewValue = $subduarek->kodeSubDua->CurrentValue;
			$subduarek->kodeSubDua->ViewCustomAttributes = "";

			// namaSubDua
			$subduarek->namaSubDua->ViewValue = $subduarek->namaSubDua->CurrentValue;
			$subduarek->namaSubDua->ViewCustomAttributes = "";

			// id
			$subduarek->id->ViewValue = $subduarek->id->CurrentValue;
			$subduarek->id->ViewCustomAttributes = "";

			// kodePokok
			$subduarek->kodePokok->LinkCustomAttributes = "";
			$subduarek->kodePokok->HrefValue = "";
			$subduarek->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$subduarek->kodeSubSatu->LinkCustomAttributes = "";
			$subduarek->kodeSubSatu->HrefValue = "";
			$subduarek->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$subduarek->kodeSubDua->LinkCustomAttributes = "";
			$subduarek->kodeSubDua->HrefValue = "";
			$subduarek->kodeSubDua->TooltipValue = "";

			// namaSubDua
			$subduarek->namaSubDua->LinkCustomAttributes = "";
			$subduarek->namaSubDua->HrefValue = "";
			$subduarek->namaSubDua->TooltipValue = "";
		} elseif ($subduarek->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodePokok
			$subduarek->kodePokok->EditCustomAttributes = "";
			$subduarek->kodePokok->CurrentValue = $_SESSION["kode_pokok"];

			// kodeSubSatu
			$subduarek->kodeSubSatu->EditCustomAttributes = "";
			$subduarek->kodeSubSatu->CurrentValue = $_SESSION["kode_sub_satu"];

			// kodeSubDua
			$subduarek->kodeSubDua->EditCustomAttributes = "";
			$subduarek->kodeSubDua->EditValue = ew_HtmlEncode($subduarek->kodeSubDua->CurrentValue);

			// namaSubDua
			$subduarek->namaSubDua->EditCustomAttributes = "";
			$subduarek->namaSubDua->EditValue = ew_HtmlEncode($subduarek->namaSubDua->CurrentValue);

			// Edit refer script
			// kodePokok

			$subduarek->kodePokok->HrefValue = "";

			// kodeSubSatu
			$subduarek->kodeSubSatu->HrefValue = "";

			// kodeSubDua
			$subduarek->kodeSubDua->HrefValue = "";

			// namaSubDua
			$subduarek->namaSubDua->HrefValue = "";
		}
		if ($subduarek->RowType == EW_ROWTYPE_ADD ||
			$subduarek->RowType == EW_ROWTYPE_EDIT ||
			$subduarek->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subduarek->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subduarek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subduarek->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subduarek;

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
		global $conn, $Language, $Security, $subduarek;
		$rsnew = array();

		// kodePokok
		$subduarek->kodePokok->SetDbValueDef($rsnew, $subduarek->kodePokok->CurrentValue, NULL, FALSE);

		// kodeSubSatu
		$subduarek->kodeSubSatu->SetDbValueDef($rsnew, $subduarek->kodeSubSatu->CurrentValue, NULL, FALSE);

		// kodeSubDua
		$subduarek->kodeSubDua->SetDbValueDef($rsnew, $subduarek->kodeSubDua->CurrentValue, NULL, FALSE);

		// namaSubDua
		$subduarek->namaSubDua->SetDbValueDef($rsnew, $subduarek->namaSubDua->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $subduarek->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($subduarek->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($subduarek->CancelMessage <> "") {
				$this->setFailureMessage($subduarek->CancelMessage);
				$subduarek->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$subduarek->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $subduarek->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$subduarek->Row_Inserted($rs, $rsnew);
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
