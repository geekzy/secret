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
$subtigarek_addopt = new csubtigarek_addopt();
$Page =& $subtigarek_addopt;

// Page init
$subtigarek_addopt->Page_Init();

// Page main
$subtigarek_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var subtigarek_addopt = new ew_Page("subtigarek_addopt");

// page properties
subtigarek_addopt.PageID = "addopt"; // page ID
subtigarek_addopt.FormID = "fsubtigarekaddopt"; // form ID
var EW_PAGE_ID = subtigarek_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
subtigarek_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
$subtigarek_addopt->ShowMessage();
?>
<form name="fsubtigarekaddopt" id="fsubtigarekaddopt" action="subtigarekaddopt.php" method="post" onsubmit="return subtigarek_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="subtigarek">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
<input type="hidden" name="x_kodePokok" id="x_kodePokok" value="<?php echo ew_HtmlEncode($subtigarek->kodePokok->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubSatu" id="x_kodeSubSatu" value="<?php echo ew_HtmlEncode($subtigarek->kodeSubSatu->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubDua" id="x_kodeSubDua" value="<?php echo ew_HtmlEncode($subtigarek->kodeSubDua->CurrentValue) ?>">
	<tr>
		<td><?php echo $subtigarek->kodeSubTiga->FldCaption() ?></td>
		<td><span id="el_kodeSubTiga">
<input type="text" name="x_kodeSubTiga" id="x_kodeSubTiga" size="30" maxlength="50" value="<?php echo $subtigarek->kodeSubTiga->EditValue ?>"<?php echo $subtigarek->kodeSubTiga->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td><?php echo $subtigarek->namaSubTiga->FldCaption() ?></td>
		<td><span id="el_namaSubTiga">
<input type="text" name="x_namaSubTiga" id="x_namaSubTiga" size="30" maxlength="50" value="<?php echo $subtigarek->namaSubTiga->EditValue ?>"<?php echo $subtigarek->namaSubTiga->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$subtigarek_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class csubtigarek_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'subtigarek';

	// Page object name
	var $PageObjName = 'subtigarek_addopt';

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
	function csubtigarek_addopt() {
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
			define("EW_PAGE_ID", 'addopt', TRUE);

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
		if (!$Security->CanAdd()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $subtigarek;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$subtigarek->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subtigarek->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back
			$subtigarek->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($subtigarek->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$subtigarek->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_kodePokok", strval($subtigarek->kodePokok->FormValue));
					$XMLDoc->AddField("x_kodeSubSatu", strval($subtigarek->kodeSubSatu->FormValue));
					$XMLDoc->AddField("x_kodeSubDua", strval($subtigarek->kodeSubDua->FormValue));
					$XMLDoc->AddField("x_kodeSubTiga", strval($subtigarek->kodeSubTiga->FormValue));
					$XMLDoc->AddField("x_namaSubTiga", strval($subtigarek->namaSubTiga->FormValue));
					$XMLDoc->AddField("x_id", strval($subtigarek->id->DbValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$subtigarek->RowType = EW_ROWTYPE_ADD; // Render add type
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

	// Load default values
	function LoadDefaultValues() {
		global $subtigarek;
		$subtigarek->kodePokok->CurrentValue = $_SESSION["kode_pokok"];
		$subtigarek->kodeSubSatu->CurrentValue = $_SESSION["kode_sub_satu"];
		$subtigarek->kodeSubDua->CurrentValue = $_SESSION["kode_sub_dua"];
		$subtigarek->kodeSubTiga->CurrentValue = NULL;
		$subtigarek->kodeSubTiga->OldValue = $subtigarek->kodeSubTiga->CurrentValue;
		$subtigarek->namaSubTiga->CurrentValue = NULL;
		$subtigarek->namaSubTiga->OldValue = $subtigarek->namaSubTiga->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subtigarek;
		if (!$subtigarek->kodePokok->FldIsDetailKey) {
			$subtigarek->kodePokok->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodePokok")));
		}
		if (!$subtigarek->kodeSubSatu->FldIsDetailKey) {
			$subtigarek->kodeSubSatu->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodeSubSatu")));
		}
		if (!$subtigarek->kodeSubDua->FldIsDetailKey) {
			$subtigarek->kodeSubDua->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodeSubDua")));
		}
		if (!$subtigarek->kodeSubTiga->FldIsDetailKey) {
			$subtigarek->kodeSubTiga->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodeSubTiga")));
		}
		if (!$subtigarek->namaSubTiga->FldIsDetailKey) {
			$subtigarek->namaSubTiga->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_namaSubTiga")));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subtigarek;
		$subtigarek->kodePokok->CurrentValue = ew_ConvertToUtf8($subtigarek->kodePokok->FormValue);
		$subtigarek->kodeSubSatu->CurrentValue = ew_ConvertToUtf8($subtigarek->kodeSubSatu->FormValue);
		$subtigarek->kodeSubDua->CurrentValue = ew_ConvertToUtf8($subtigarek->kodeSubDua->FormValue);
		$subtigarek->kodeSubTiga->CurrentValue = ew_ConvertToUtf8($subtigarek->kodeSubTiga->FormValue);
		$subtigarek->namaSubTiga->CurrentValue = ew_ConvertToUtf8($subtigarek->namaSubTiga->FormValue);
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
		} elseif ($subtigarek->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodePokok
			$subtigarek->kodePokok->EditCustomAttributes = "";
			$subtigarek->kodePokok->CurrentValue = $_SESSION["kode_pokok"];

			// kodeSubSatu
			$subtigarek->kodeSubSatu->EditCustomAttributes = "";
			$subtigarek->kodeSubSatu->CurrentValue = $_SESSION["kode_sub_satu"];

			// kodeSubDua
			$subtigarek->kodeSubDua->EditCustomAttributes = "";
			$subtigarek->kodeSubDua->CurrentValue = $_SESSION["kode_sub_dua"];

			// kodeSubTiga
			$subtigarek->kodeSubTiga->EditCustomAttributes = "";
			$subtigarek->kodeSubTiga->EditValue = ew_HtmlEncode($subtigarek->kodeSubTiga->CurrentValue);

			// namaSubTiga
			$subtigarek->namaSubTiga->EditCustomAttributes = "";
			$subtigarek->namaSubTiga->EditValue = ew_HtmlEncode($subtigarek->namaSubTiga->CurrentValue);

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
		global $conn, $Language, $Security, $subtigarek;
		$rsnew = array();

		// kodePokok
		$subtigarek->kodePokok->SetDbValueDef($rsnew, $subtigarek->kodePokok->CurrentValue, NULL, FALSE);

		// kodeSubSatu
		$subtigarek->kodeSubSatu->SetDbValueDef($rsnew, $subtigarek->kodeSubSatu->CurrentValue, NULL, FALSE);

		// kodeSubDua
		$subtigarek->kodeSubDua->SetDbValueDef($rsnew, $subtigarek->kodeSubDua->CurrentValue, NULL, FALSE);

		// kodeSubTiga
		$subtigarek->kodeSubTiga->SetDbValueDef($rsnew, $subtigarek->kodeSubTiga->CurrentValue, NULL, FALSE);

		// namaSubTiga
		$subtigarek->namaSubTiga->SetDbValueDef($rsnew, $subtigarek->namaSubTiga->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $subtigarek->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($subtigarek->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($subtigarek->CancelMessage <> "") {
				$this->setFailureMessage($subtigarek->CancelMessage);
				$subtigarek->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$subtigarek->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $subtigarek->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$subtigarek->Row_Inserted($rs, $rsnew);
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
