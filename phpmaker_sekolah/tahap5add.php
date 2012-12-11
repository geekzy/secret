<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tahap5info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tahap5_add = new ctahap5_add();
$Page =& $tahap5_add;

// Page init
$tahap5_add->Page_Init();

// Page main
$tahap5_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tahap5_add = new ew_Page("tahap5_add");

// page properties
tahap5_add.PageID = "add"; // page ID
tahap5_add.FormID = "ftahap5add"; // form ID
var EW_PAGE_ID = tahap5_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tahap5_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_Norek"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap5->Norek->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Keterangan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap5->Keterangan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D2FK"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap5->D2FK->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kredit_kali"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap5->kredit_kali->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kredit_kali"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tahap5->kredit_kali->FldErrMsg()) ?>");

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
tahap5_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tahap5_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tahap5_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $tahap5->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tahap5->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tahap5_add->ShowPageHeader(); ?>
<?php
$tahap5_add->ShowMessage();
?>
<form name="ftahap5add" id="ftahap5add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tahap5_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tahap5">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tahap5->Norek->Visible) { // Norek ?>
	<tr id="r_Norek"<?php echo $tahap5->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap5->Norek->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap5->Norek->CellAttributes() ?>><span id="el_Norek">
<input type="text" name="x_Norek" id="x_Norek" size="30" maxlength="50" value="<?php echo $tahap5->Norek->EditValue ?>"<?php echo $tahap5->Norek->EditAttributes() ?>>
</span><?php echo $tahap5->Norek->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tahap5->Keterangan->Visible) { // Keterangan ?>
	<tr id="r_Keterangan"<?php echo $tahap5->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap5->Keterangan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap5->Keterangan->CellAttributes() ?>><span id="el_Keterangan">
<input type="text" name="x_Keterangan" id="x_Keterangan" size="30" maxlength="50" value="<?php echo $tahap5->Keterangan->EditValue ?>"<?php echo $tahap5->Keterangan->EditAttributes() ?>>
</span><?php echo $tahap5->Keterangan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tahap5->D2FK->Visible) { // D/K ?>
	<tr id="r_D2FK"<?php echo $tahap5->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap5->D2FK->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap5->D2FK->CellAttributes() ?>><span id="el_D2FK">
<select id="x_D2FK" name="x_D2FK"<?php echo $tahap5->D2FK->EditAttributes() ?>>
<?php
if (is_array($tahap5->D2FK->EditValue)) {
	$arwrk = $tahap5->D2FK->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tahap5->D2FK->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $tahap5->D2FK->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kodePokok" id="x_kodePokok" value="<?php echo ew_HtmlEncode($tahap5->kodePokok->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubSatu" id="x_kodeSubSatu" value="<?php echo ew_HtmlEncode($tahap5->kodeSubSatu->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubDua" id="x_kodeSubDua" value="<?php echo ew_HtmlEncode($tahap5->kodeSubDua->CurrentValue) ?>">
<input type="hidden" name="x_kodeSubTiga" id="x_kodeSubTiga" value="<?php echo ew_HtmlEncode($tahap5->kodeSubTiga->CurrentValue) ?>">
<input type="hidden" name="x_debet_kali" id="x_debet_kali" value="<?php echo ew_HtmlEncode($tahap5->debet_kali->CurrentValue) ?>">
<?php if ($tahap5->kredit_kali->Visible) { // kredit_kali ?>
	<tr id="r_kredit_kali"<?php echo $tahap5->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap5->kredit_kali->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap5->kredit_kali->CellAttributes() ?>><span id="el_kredit_kali">
<input type="text" name="x_kredit_kali" id="x_kredit_kali" size="30" value="<?php echo $tahap5->kredit_kali->EditValue ?>"<?php echo $tahap5->kredit_kali->EditAttributes() ?>>
</span><?php echo $tahap5->kredit_kali->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tahap5_add->ShowPageFooter();
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
$tahap5_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctahap5_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tahap5';

	// Page object name
	var $PageObjName = 'tahap5_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tahap5;
		if ($tahap5->UseTokenInUrl) $PageUrl .= "t=" . $tahap5->TableVar . "&"; // Add page token
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
		global $objForm, $tahap5;
		if ($tahap5->UseTokenInUrl) {
			if ($objForm)
				return ($tahap5->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tahap5->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctahap5_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tahap5)
		if (!isset($GLOBALS["tahap5"])) {
			$GLOBALS["tahap5"] = new ctahap5();
			$GLOBALS["Table"] =& $GLOBALS["tahap5"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tahap5', TRUE);

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
		global $tahap5;

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
			$this->Page_Terminate("tahap5list.php");
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
		global $objForm, $Language, $gsFormError, $tahap5;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tahap5->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tahap5->CurrentAction = "I"; // Form error, reset action
				$tahap5->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$tahap5->id->setQueryStringValue($_GET["id"]);
				$tahap5->setKey("id", $tahap5->id->CurrentValue); // Set up key
			} else {
				$tahap5->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tahap5->CurrentAction = "C"; // Copy record
			} else {
				$tahap5->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tahap5->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tahap5list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tahap5->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "tahap5list.php";
					if (ew_GetPageName($sReturnUrl) == "tahap5view.php")
						$sReturnUrl = $tahap5->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tahap5->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tahap5->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$tahap5->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tahap5;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $tahap5;
		$tahap5->Norek->CurrentValue = $_SESSION["kode_pokok"] . "." . $_SESSION["kode_sub_satu"] . "." . $_SESSION["kode_sub_dua"] . "." .  $_SESSION["kode_sub_tiga"];
		$tahap5->Keterangan->CurrentValue = NULL;
		$tahap5->Keterangan->OldValue = $tahap5->Keterangan->CurrentValue;
		$tahap5->D2FK->CurrentValue = NULL;
		$tahap5->D2FK->OldValue = $tahap5->D2FK->CurrentValue;
		$tahap5->kodePokok->CurrentValue = $_SESSION["kode_pokok"];
		$tahap5->kodeSubSatu->CurrentValue = $_SESSION["kode_sub_satu"];
		$tahap5->kodeSubDua->CurrentValue = $_SESSION["kode_sub_dua"];
		$tahap5->kodeSubTiga->CurrentValue = $_SESSION["kode_sub_tiga"];
		$tahap5->debet_kali->CurrentValue = 0;
		$tahap5->kredit_kali->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tahap5;
		if (!$tahap5->Norek->FldIsDetailKey) {
			$tahap5->Norek->setFormValue($objForm->GetValue("x_Norek"));
		}
		if (!$tahap5->Keterangan->FldIsDetailKey) {
			$tahap5->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$tahap5->D2FK->FldIsDetailKey) {
			$tahap5->D2FK->setFormValue($objForm->GetValue("x_D2FK"));
		}
		if (!$tahap5->kodePokok->FldIsDetailKey) {
			$tahap5->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
		if (!$tahap5->kodeSubSatu->FldIsDetailKey) {
			$tahap5->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
		if (!$tahap5->kodeSubDua->FldIsDetailKey) {
			$tahap5->kodeSubDua->setFormValue($objForm->GetValue("x_kodeSubDua"));
		}
		if (!$tahap5->kodeSubTiga->FldIsDetailKey) {
			$tahap5->kodeSubTiga->setFormValue($objForm->GetValue("x_kodeSubTiga"));
		}
		if (!$tahap5->debet_kali->FldIsDetailKey) {
			$tahap5->debet_kali->setFormValue($objForm->GetValue("x_debet_kali"));
		}
		if (!$tahap5->kredit_kali->FldIsDetailKey) {
			$tahap5->kredit_kali->setFormValue($objForm->GetValue("x_kredit_kali"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tahap5;
		$this->LoadOldRecord();
		$tahap5->Norek->CurrentValue = $tahap5->Norek->FormValue;
		$tahap5->Keterangan->CurrentValue = $tahap5->Keterangan->FormValue;
		$tahap5->D2FK->CurrentValue = $tahap5->D2FK->FormValue;
		$tahap5->kodePokok->CurrentValue = $tahap5->kodePokok->FormValue;
		$tahap5->kodeSubSatu->CurrentValue = $tahap5->kodeSubSatu->FormValue;
		$tahap5->kodeSubDua->CurrentValue = $tahap5->kodeSubDua->FormValue;
		$tahap5->kodeSubTiga->CurrentValue = $tahap5->kodeSubTiga->FormValue;
		$tahap5->debet_kali->CurrentValue = $tahap5->debet_kali->FormValue;
		$tahap5->kredit_kali->CurrentValue = $tahap5->kredit_kali->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tahap5;
		$sFilter = $tahap5->KeyFilter();

		// Call Row Selecting event
		$tahap5->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tahap5->CurrentFilter = $sFilter;
		$sSql = $tahap5->SQL();
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
		global $conn, $tahap5;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tahap5->Row_Selected($row);
		$tahap5->id->setDbValue($rs->fields('id'));
		$tahap5->Norek->setDbValue($rs->fields('Norek'));
		$tahap5->Keterangan->setDbValue($rs->fields('Keterangan'));
		$tahap5->D2FK->setDbValue($rs->fields('D/K'));
		$tahap5->kodePokok->setDbValue($rs->fields('kodePokok'));
		$tahap5->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$tahap5->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$tahap5->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$tahap5->debet_kali->setDbValue($rs->fields('debet_kali'));
		$tahap5->kredit_kali->setDbValue($rs->fields('kredit_kali'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tahap5;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tahap5->getKey("id")) <> "")
			$tahap5->id->CurrentValue = $tahap5->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tahap5->CurrentFilter = $tahap5->KeyFilter();
			$sSql = $tahap5->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tahap5;

		// Initialize URLs
		// Call Row_Rendering event

		$tahap5->Row_Rendering();

		// Common render codes for all row types
		// id
		// Norek
		// Keterangan
		// D/K
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// debet_kali
		// kredit_kali

		if ($tahap5->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tahap5->id->ViewValue = $tahap5->id->CurrentValue;
			$tahap5->id->ViewCustomAttributes = "";

			// Norek
			$tahap5->Norek->ViewValue = $tahap5->Norek->CurrentValue;
			$tahap5->Norek->ViewCustomAttributes = "";

			// Keterangan
			$tahap5->Keterangan->ViewValue = $tahap5->Keterangan->CurrentValue;
			$tahap5->Keterangan->ViewCustomAttributes = "";

			// D/K
			if (strval($tahap5->D2FK->CurrentValue) <> "") {
				switch ($tahap5->D2FK->CurrentValue) {
					case "D":
						$tahap5->D2FK->ViewValue = $tahap5->D2FK->FldTagCaption(1) <> "" ? $tahap5->D2FK->FldTagCaption(1) : $tahap5->D2FK->CurrentValue;
						break;
					case "K":
						$tahap5->D2FK->ViewValue = $tahap5->D2FK->FldTagCaption(2) <> "" ? $tahap5->D2FK->FldTagCaption(2) : $tahap5->D2FK->CurrentValue;
						break;
					default:
						$tahap5->D2FK->ViewValue = $tahap5->D2FK->CurrentValue;
				}
			} else {
				$tahap5->D2FK->ViewValue = NULL;
			}
			$tahap5->D2FK->ViewCustomAttributes = "";

			// kodePokok
			$tahap5->kodePokok->ViewValue = $tahap5->kodePokok->CurrentValue;
			$tahap5->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$tahap5->kodeSubSatu->ViewValue = $tahap5->kodeSubSatu->CurrentValue;
			$tahap5->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$tahap5->kodeSubDua->ViewValue = $tahap5->kodeSubDua->CurrentValue;
			$tahap5->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$tahap5->kodeSubTiga->ViewValue = $tahap5->kodeSubTiga->CurrentValue;
			$tahap5->kodeSubTiga->ViewCustomAttributes = "";

			// debet_kali
			$tahap5->debet_kali->ViewValue = $tahap5->debet_kali->CurrentValue;
			$tahap5->debet_kali->ViewCustomAttributes = "";

			// kredit_kali
			$tahap5->kredit_kali->ViewValue = $tahap5->kredit_kali->CurrentValue;
			$tahap5->kredit_kali->ViewCustomAttributes = "";

			// Norek
			$tahap5->Norek->LinkCustomAttributes = "";
			$tahap5->Norek->HrefValue = "";
			$tahap5->Norek->TooltipValue = "";

			// Keterangan
			$tahap5->Keterangan->LinkCustomAttributes = "";
			$tahap5->Keterangan->HrefValue = "";
			$tahap5->Keterangan->TooltipValue = "";

			// D/K
			$tahap5->D2FK->LinkCustomAttributes = "";
			$tahap5->D2FK->HrefValue = "";
			$tahap5->D2FK->TooltipValue = "";

			// kodePokok
			$tahap5->kodePokok->LinkCustomAttributes = "";
			$tahap5->kodePokok->HrefValue = "";
			$tahap5->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$tahap5->kodeSubSatu->LinkCustomAttributes = "";
			$tahap5->kodeSubSatu->HrefValue = "";
			$tahap5->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$tahap5->kodeSubDua->LinkCustomAttributes = "";
			$tahap5->kodeSubDua->HrefValue = "";
			$tahap5->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$tahap5->kodeSubTiga->LinkCustomAttributes = "";
			$tahap5->kodeSubTiga->HrefValue = "";
			$tahap5->kodeSubTiga->TooltipValue = "";

			// debet_kali
			$tahap5->debet_kali->LinkCustomAttributes = "";
			$tahap5->debet_kali->HrefValue = "";
			$tahap5->debet_kali->TooltipValue = "";

			// kredit_kali
			$tahap5->kredit_kali->LinkCustomAttributes = "";
			$tahap5->kredit_kali->HrefValue = "";
			$tahap5->kredit_kali->TooltipValue = "";
		} elseif ($tahap5->RowType == EW_ROWTYPE_ADD) { // Add row

			// Norek
			$tahap5->Norek->EditCustomAttributes = "";
			$tahap5->Norek->EditValue = ew_HtmlEncode($tahap5->Norek->CurrentValue);

			// Keterangan
			$tahap5->Keterangan->EditCustomAttributes = "";
			$tahap5->Keterangan->EditValue = ew_HtmlEncode($tahap5->Keterangan->CurrentValue);

			// D/K
			$tahap5->D2FK->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("D", $tahap5->D2FK->FldTagCaption(1) <> "" ? $tahap5->D2FK->FldTagCaption(1) : "D");
			$arwrk[] = array("K", $tahap5->D2FK->FldTagCaption(2) <> "" ? $tahap5->D2FK->FldTagCaption(2) : "K");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$tahap5->D2FK->EditValue = $arwrk;

			// kodePokok
			$tahap5->kodePokok->EditCustomAttributes = "";
			$tahap5->kodePokok->CurrentValue = $_SESSION["kode_pokok"];

			// kodeSubSatu
			$tahap5->kodeSubSatu->EditCustomAttributes = "";
			$tahap5->kodeSubSatu->CurrentValue = $_SESSION["kode_sub_satu"];

			// kodeSubDua
			$tahap5->kodeSubDua->EditCustomAttributes = "";
			$tahap5->kodeSubDua->CurrentValue = $_SESSION["kode_sub_dua"];

			// kodeSubTiga
			$tahap5->kodeSubTiga->EditCustomAttributes = "";
			$tahap5->kodeSubTiga->CurrentValue = $_SESSION["kode_sub_tiga"];

			// debet_kali
			$tahap5->debet_kali->EditCustomAttributes = "";
			$tahap5->debet_kali->CurrentValue = 0;

			// kredit_kali
			$tahap5->kredit_kali->EditCustomAttributes = "";
			$tahap5->kredit_kali->EditValue = ew_HtmlEncode($tahap5->kredit_kali->CurrentValue);

			// Edit refer script
			// Norek

			$tahap5->Norek->HrefValue = "";

			// Keterangan
			$tahap5->Keterangan->HrefValue = "";

			// D/K
			$tahap5->D2FK->HrefValue = "";

			// kodePokok
			$tahap5->kodePokok->HrefValue = "";

			// kodeSubSatu
			$tahap5->kodeSubSatu->HrefValue = "";

			// kodeSubDua
			$tahap5->kodeSubDua->HrefValue = "";

			// kodeSubTiga
			$tahap5->kodeSubTiga->HrefValue = "";

			// debet_kali
			$tahap5->debet_kali->HrefValue = "";

			// kredit_kali
			$tahap5->kredit_kali->HrefValue = "";
		}
		if ($tahap5->RowType == EW_ROWTYPE_ADD ||
			$tahap5->RowType == EW_ROWTYPE_EDIT ||
			$tahap5->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tahap5->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tahap5->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tahap5->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tahap5;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tahap5->Norek->FormValue) && $tahap5->Norek->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap5->Norek->FldCaption());
		}
		if (!is_null($tahap5->Keterangan->FormValue) && $tahap5->Keterangan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap5->Keterangan->FldCaption());
		}
		if (!is_null($tahap5->D2FK->FormValue) && $tahap5->D2FK->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap5->D2FK->FldCaption());
		}
		if (!is_null($tahap5->kredit_kali->FormValue) && $tahap5->kredit_kali->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap5->kredit_kali->FldCaption());
		}
		if (!ew_CheckInteger($tahap5->kredit_kali->FormValue)) {
			ew_AddMessage($gsFormError, $tahap5->kredit_kali->FldErrMsg());
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
		global $conn, $Language, $Security, $tahap5;
		if ($tahap5->Norek->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Norek = '" . ew_AdjustSql($tahap5->Norek->CurrentValue) . "')";
			$rsChk = $tahap5->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'Norek', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $tahap5->Norek->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Norek
		$tahap5->Norek->SetDbValueDef($rsnew, $tahap5->Norek->CurrentValue, "", FALSE);

		// Keterangan
		$tahap5->Keterangan->SetDbValueDef($rsnew, $tahap5->Keterangan->CurrentValue, "", FALSE);

		// D/K
		$tahap5->D2FK->SetDbValueDef($rsnew, $tahap5->D2FK->CurrentValue, "", FALSE);

		// kodePokok
		$tahap5->kodePokok->SetDbValueDef($rsnew, $tahap5->kodePokok->CurrentValue, "", FALSE);

		// kodeSubSatu
		$tahap5->kodeSubSatu->SetDbValueDef($rsnew, $tahap5->kodeSubSatu->CurrentValue, "", FALSE);

		// kodeSubDua
		$tahap5->kodeSubDua->SetDbValueDef($rsnew, $tahap5->kodeSubDua->CurrentValue, "", FALSE);

		// kodeSubTiga
		$tahap5->kodeSubTiga->SetDbValueDef($rsnew, $tahap5->kodeSubTiga->CurrentValue, "", FALSE);

		// debet_kali
		$tahap5->debet_kali->SetDbValueDef($rsnew, $tahap5->debet_kali->CurrentValue, 0, strval($tahap5->debet_kali->CurrentValue) == "");

		// kredit_kali
		$tahap5->kredit_kali->SetDbValueDef($rsnew, $tahap5->kredit_kali->CurrentValue, 0, strval($tahap5->kredit_kali->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tahap5->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tahap5->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tahap5->CancelMessage <> "") {
				$this->setFailureMessage($tahap5->CancelMessage);
				$tahap5->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$tahap5->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tahap5->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tahap5->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
function Page_Load() 
{
		
	// Bismillaah
	
	global $Language;
	
	$Language->setPhrase("GoBack","");  
	//$Language->setPhrase("AddBtn","Ke Tahap Berikutnya");      
	  
	   
	$judul= "Tahap 5, Pembuatan Rekening.<BR><BR> Kode Pokok:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_pokok"] . " (" .  
	   $_SESSION["nama_kode_pokok"] . ")</FONT></STRONG>" .
	   "<BR> Kode Sub Satu:  " .           
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_sub_satu"] . " (" .  
	   $_SESSION["nama_sub_satu"] . ")</FONT></STRONG>" .  
	   "<BR> Kode Sub Dua:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_sub_dua"] . " (" .  
	   $_SESSION["nama_sub_dua"] . 
	   ")</FONT></STRONG><BR>" . 
	   "Kode Sub Tiga: <FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_sub_tiga"] . " (" .  
	   $_SESSION["nama_sub_tiga"] . ")</FONT></STRONG><BR>" ;                             
	
					
	$Language->setTablePhrase(CurrentTable()->TableName, "TblCaption", $judul);   
		
	

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
