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
$subsaturek_addopt = new csubsaturek_addopt();
$Page =& $subsaturek_addopt;

// Page init
$subsaturek_addopt->Page_Init();

// Page main
$subsaturek_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var subsaturek_addopt = new ew_Page("subsaturek_addopt");

// page properties
subsaturek_addopt.PageID = "addopt"; // page ID
subsaturek_addopt.FormID = "fsubsaturekaddopt"; // form ID
var EW_PAGE_ID = subsaturek_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
subsaturek_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
$subsaturek_addopt->ShowMessage();
?>
<form name="fsubsaturekaddopt" id="fsubsaturekaddopt" action="subsaturekaddopt.php" method="post" onsubmit="return subsaturek_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="subsaturek">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $subsaturek->kodeSubSatu->FldCaption() ?></td>
		<td><span id="el_kodeSubSatu">
<input type="text" name="x_kodeSubSatu" id="x_kodeSubSatu" size="30" maxlength="50" value="<?php echo $subsaturek->kodeSubSatu->EditValue ?>"<?php echo $subsaturek->kodeSubSatu->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td><?php echo $subsaturek->namaSubSatu->FldCaption() ?></td>
		<td><span id="el_namaSubSatu">
<input type="text" name="x_namaSubSatu" id="x_namaSubSatu" size="30" maxlength="50" value="<?php echo $subsaturek->namaSubSatu->EditValue ?>"<?php echo $subsaturek->namaSubSatu->EditAttributes() ?>>
</span></td>
	</tr>
<input type="hidden" name="x_kodePokok" id="x_kodePokok" value="<?php echo ew_HtmlEncode($subsaturek->kodePokok->CurrentValue) ?>">
</table>
<p>
</form>
<?php
$subsaturek_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class csubsaturek_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'subsaturek';

	// Page object name
	var $PageObjName = 'subsaturek_addopt';

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
	function csubsaturek_addopt() {
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
			define("EW_PAGE_ID", 'addopt', TRUE);

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $subsaturek;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$subsaturek->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subsaturek->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back
			$subsaturek->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($subsaturek->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$subsaturek->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_kodeSubSatu", strval($subsaturek->kodeSubSatu->FormValue));
					$XMLDoc->AddField("x_namaSubSatu", strval($subsaturek->namaSubSatu->FormValue));
					$XMLDoc->AddField("x_kodePokok", strval($subsaturek->kodePokok->FormValue));
					$XMLDoc->AddField("x_id", strval($subsaturek->id->DbValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$subsaturek->RowType = EW_ROWTYPE_ADD; // Render add type
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
			$subsaturek->kodeSubSatu->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodeSubSatu")));
		}
		if (!$subsaturek->namaSubSatu->FldIsDetailKey) {
			$subsaturek->namaSubSatu->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_namaSubSatu")));
		}
		if (!$subsaturek->kodePokok->FldIsDetailKey) {
			$subsaturek->kodePokok->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_kodePokok")));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subsaturek;
		$subsaturek->kodeSubSatu->CurrentValue = ew_ConvertToUtf8($subsaturek->kodeSubSatu->FormValue);
		$subsaturek->namaSubSatu->CurrentValue = ew_ConvertToUtf8($subsaturek->namaSubSatu->FormValue);
		$subsaturek->kodePokok->CurrentValue = ew_ConvertToUtf8($subsaturek->kodePokok->FormValue);
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

	// Custom validate event
	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
