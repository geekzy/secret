<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pokokrekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pokokrek_addopt = new cpokokrek_addopt();
$Page =& $pokokrek_addopt;

// Page init
$pokokrek_addopt->Page_Init();

// Page main
$pokokrek_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var pokokrek_addopt = new ew_Page("pokokrek_addopt");

// page properties
pokokrek_addopt.PageID = "addopt"; // page ID
pokokrek_addopt.FormID = "fpokokrekaddopt"; // form ID
var EW_PAGE_ID = pokokrek_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
pokokrek_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
$pokokrek_addopt->ShowMessage();
?>
<form name="fpokokrekaddopt" id="fpokokrekaddopt" action="pokokrekaddopt.php" method="post" onsubmit="return pokokrek_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pokokrek">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $pokokrek->kodePokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td><span id="el_kodePokok">
<input type="text" name="x_kodePokok" id="x_kodePokok" size="30" maxlength="50" value="<?php echo $pokokrek->kodePokok->EditValue ?>"<?php echo $pokokrek->kodePokok->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td><?php echo $pokokrek->namaPokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td><span id="el_namaPokok">
<input type="text" name="x_namaPokok" id="x_namaPokok" size="30" maxlength="50" value="<?php echo $pokokrek->namaPokok->EditValue ?>"<?php echo $pokokrek->namaPokok->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$pokokrek_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokokrek_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'pokokrek';

	// Page object name
	var $PageObjName = 'pokokrek_addopt';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokokrek;
		if ($pokokrek->UseTokenInUrl) $PageUrl .= "t=" . $pokokrek->TableVar . "&"; // Add page token
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
		global $objForm, $pokokrek;
		if ($pokokrek->UseTokenInUrl) {
			if ($objForm)
				return ($pokokrek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokokrek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokokrek_addopt() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pokokrek)
		if (!isset($GLOBALS["pokokrek"])) {
			$GLOBALS["pokokrek"] = new cpokokrek();
			$GLOBALS["Table"] =& $GLOBALS["pokokrek"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokokrek', TRUE);

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
		global $pokokrek;

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
			$this->Page_Terminate("pokokreklist.php");
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $pokokrek;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$pokokrek->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pokokrek->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back
			$pokokrek->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($pokokrek->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$pokokrek->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_kodePokok", strval($pokokrek->kodePokok->FormValue));
					$XMLDoc->AddField("x_namaPokok", strval($pokokrek->namaPokok->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$pokokrek->RowType = EW_ROWTYPE_ADD; // Render add type
		$pokokrek->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pokokrek;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $pokokrek;
		$pokokrek->kodePokok->CurrentValue = NULL;
		$pokokrek->kodePokok->OldValue = $pokokrek->kodePokok->CurrentValue;
		$pokokrek->namaPokok->CurrentValue = NULL;
		$pokokrek->namaPokok->OldValue = $pokokrek->namaPokok->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pokokrek;
		if (!$pokokrek->kodePokok->FldIsDetailKey) {
			$pokokrek->kodePokok->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodePokok")));
		}
		if (!$pokokrek->namaPokok->FldIsDetailKey) {
			$pokokrek->namaPokok->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_namaPokok")));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pokokrek;
		$pokokrek->kodePokok->CurrentValue = ew_ConvertToUtf8($pokokrek->kodePokok->FormValue);
		$pokokrek->namaPokok->CurrentValue = ew_ConvertToUtf8($pokokrek->namaPokok->FormValue);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokokrek;
		$sFilter = $pokokrek->KeyFilter();

		// Call Row Selecting event
		$pokokrek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokokrek->CurrentFilter = $sFilter;
		$sSql = $pokokrek->SQL();
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
		global $conn, $pokokrek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pokokrek->Row_Selected($row);
		$pokokrek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$pokokrek->namaPokok->setDbValue($rs->fields('namaPokok'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokokrek;

		// Initialize URLs
		// Call Row_Rendering event

		$pokokrek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// namaPokok

		if ($pokokrek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$pokokrek->kodePokok->ViewValue = $pokokrek->kodePokok->CurrentValue;
			$pokokrek->kodePokok->ViewCustomAttributes = "";

			// namaPokok
			$pokokrek->namaPokok->ViewValue = $pokokrek->namaPokok->CurrentValue;
			$pokokrek->namaPokok->ViewCustomAttributes = "";

			// kodePokok
			$pokokrek->kodePokok->LinkCustomAttributes = "";
			$pokokrek->kodePokok->HrefValue = "";
			$pokokrek->kodePokok->TooltipValue = "";

			// namaPokok
			$pokokrek->namaPokok->LinkCustomAttributes = "";
			$pokokrek->namaPokok->HrefValue = "";
			$pokokrek->namaPokok->TooltipValue = "";
		} elseif ($pokokrek->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodePokok
			$pokokrek->kodePokok->EditCustomAttributes = "";
			$pokokrek->kodePokok->EditValue = ew_HtmlEncode($pokokrek->kodePokok->CurrentValue);

			// namaPokok
			$pokokrek->namaPokok->EditCustomAttributes = "";
			$pokokrek->namaPokok->EditValue = ew_HtmlEncode($pokokrek->namaPokok->CurrentValue);

			// Edit refer script
			// kodePokok

			$pokokrek->kodePokok->HrefValue = "";

			// namaPokok
			$pokokrek->namaPokok->HrefValue = "";
		}
		if ($pokokrek->RowType == EW_ROWTYPE_ADD ||
			$pokokrek->RowType == EW_ROWTYPE_EDIT ||
			$pokokrek->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pokokrek->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pokokrek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokokrek->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pokokrek;

		// Initialize form error message
		$gsFormError = "";
		if (!is_null($pokokrek->kodePokok->FormValue) && $pokokrek->kodePokok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pokokrek->kodePokok->FldCaption());
		}
		if (!is_null($pokokrek->namaPokok->FormValue) && $pokokrek->namaPokok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pokokrek->namaPokok->FldCaption());
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
		global $conn, $Language, $Security, $pokokrek;

		// Check if key value entered
		if ($pokokrek->kodePokok->CurrentValue == "" && $pokokrek->kodePokok->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $pokokrek->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $pokokrek->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($pokokrek->kodePokok->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kodePokok = '" . ew_AdjustSql($pokokrek->kodePokok->CurrentValue) . "')";
			$rsChk = $pokokrek->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kodePokok', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $pokokrek->kodePokok->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// kodePokok
		$pokokrek->kodePokok->SetDbValueDef($rsnew, $pokokrek->kodePokok->CurrentValue, "", FALSE);

		// namaPokok
		$pokokrek->namaPokok->SetDbValueDef($rsnew, $pokokrek->namaPokok->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $pokokrek->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pokokrek->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pokokrek->CancelMessage <> "") {
				$this->setFailureMessage($pokokrek->CancelMessage);
				$pokokrek->CancelMessage = "";
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
			$pokokrek->Row_Inserted($rs, $rsnew);
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

	// Custom validate event
	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
