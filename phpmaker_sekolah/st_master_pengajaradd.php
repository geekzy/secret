<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_pengajarinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_pengajar_add = new cst_master_pengajar_add();
$Page =& $st_master_pengajar_add;

// Page init
$st_master_pengajar_add->Page_Init();

// Page main
$st_master_pengajar_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_pengajar_add = new ew_Page("st_master_pengajar_add");

// page properties
st_master_pengajar_add.PageID = "add"; // page ID
st_master_pengajar_add.FormID = "fst_master_pengajaradd"; // form ID
var EW_PAGE_ID = st_master_pengajar_add.PageID; // for backward compatibility

// extend page with ValidateForm function
st_master_pengajar_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_pengajar->nama->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_pengajar"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_pengajar->kode_pengajar->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_pengajar->password->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_hp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_pengajar->hp->FldCaption()) ?>");

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
st_master_pengajar_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_pengajar_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_pengajar_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_pengajar->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_master_pengajar->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_master_pengajar_add->ShowPageHeader(); ?>
<?php
$st_master_pengajar_add->ShowMessage();
?>
<form name="fst_master_pengajaradd" id="fst_master_pengajaradd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return st_master_pengajar_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="st_master_pengajar">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($st_master_pengajar->nama->Visible) { // nama ?>
	<tr id="r_nama"<?php echo $st_master_pengajar->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_pengajar->nama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_pengajar->nama->CellAttributes() ?>><span id="el_nama">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $st_master_pengajar->nama->EditValue ?>"<?php echo $st_master_pengajar->nama->EditAttributes() ?>>
</span><?php echo $st_master_pengajar->nama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($st_master_pengajar->kode_pengajar->Visible) { // kode_pengajar ?>
	<tr id="r_kode_pengajar"<?php echo $st_master_pengajar->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_pengajar->kode_pengajar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_pengajar->kode_pengajar->CellAttributes() ?>><span id="el_kode_pengajar">
<input type="text" name="x_kode_pengajar" id="x_kode_pengajar" size="30" maxlength="50" value="<?php echo $st_master_pengajar->kode_pengajar->EditValue ?>"<?php echo $st_master_pengajar->kode_pengajar->EditAttributes() ?>>
</span><?php echo $st_master_pengajar->kode_pengajar->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($st_master_pengajar->password->Visible) { // password ?>
	<tr id="r_password"<?php echo $st_master_pengajar->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_pengajar->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_pengajar->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" size="30" maxlength="50" value="<?php echo $st_master_pengajar->password->EditValue ?>"<?php echo $st_master_pengajar->password->EditAttributes() ?>>
</span><?php echo $st_master_pengajar->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis_tingkat" id="x_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($st_master_pengajar->kode_otomatis_tingkat->CurrentValue) ?>">
<?php if ($st_master_pengajar->hp->Visible) { // hp ?>
	<tr id="r_hp"<?php echo $st_master_pengajar->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_pengajar->hp->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_pengajar->hp->CellAttributes() ?>><span id="el_hp">
<input type="text" name="x_hp" id="x_hp" size="30" maxlength="50" value="<?php echo $st_master_pengajar->hp->EditValue ?>"<?php echo $st_master_pengajar->hp->EditAttributes() ?>>
</span><?php echo $st_master_pengajar->hp->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_pengajar->kode_otomatis->CurrentValue) ?>">
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$st_master_pengajar_add->ShowPageFooter();
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
$st_master_pengajar_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_pengajar_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'st_master_pengajar';

	// Page object name
	var $PageObjName = 'st_master_pengajar_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_pengajar;
		if ($st_master_pengajar->UseTokenInUrl) $PageUrl .= "t=" . $st_master_pengajar->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_pengajar;
		if ($st_master_pengajar->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_pengajar->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_pengajar->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_pengajar_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_pengajar)
		if (!isset($GLOBALS["st_master_pengajar"])) {
			$GLOBALS["st_master_pengajar"] = new cst_master_pengajar();
			$GLOBALS["Table"] =& $GLOBALS["st_master_pengajar"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_pengajar', TRUE);

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
		global $st_master_pengajar;

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
			$this->Page_Terminate("st_master_pengajarlist.php");
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
		global $objForm, $Language, $gsFormError, $st_master_pengajar;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$st_master_pengajar->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$st_master_pengajar->CurrentAction = "I"; // Form error, reset action
				$st_master_pengajar->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["kode_otomatis"] != "") {
				$st_master_pengajar->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$st_master_pengajar->setKey("kode_otomatis", $st_master_pengajar->kode_otomatis->CurrentValue); // Set up key
			} else {
				$st_master_pengajar->setKey("kode_otomatis", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$st_master_pengajar->CurrentAction = "C"; // Copy record
			} else {
				$st_master_pengajar->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($st_master_pengajar->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("st_master_pengajarlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$st_master_pengajar->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $st_master_pengajar->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "st_master_pengajarview.php")
						$sReturnUrl = $st_master_pengajar->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$st_master_pengajar->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$st_master_pengajar->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$st_master_pengajar->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $st_master_pengajar;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_master_pengajar;
		$st_master_pengajar->nama->CurrentValue = NULL;
		$st_master_pengajar->nama->OldValue = $st_master_pengajar->nama->CurrentValue;
		$st_master_pengajar->kode_pengajar->CurrentValue = NULL;
		$st_master_pengajar->kode_pengajar->OldValue = $st_master_pengajar->kode_pengajar->CurrentValue;
		$st_master_pengajar->password->CurrentValue = NULL;
		$st_master_pengajar->password->OldValue = $st_master_pengajar->password->CurrentValue;
		$st_master_pengajar->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];
		$st_master_pengajar->hp->CurrentValue = NULL;
		$st_master_pengajar->hp->OldValue = $st_master_pengajar->hp->CurrentValue;
		$st_master_pengajar->kode_otomatis->CurrentValue = unik();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_master_pengajar;
		if (!$st_master_pengajar->nama->FldIsDetailKey) {
			$st_master_pengajar->nama->setFormValue($objForm->GetValue("x_nama"));
		}
		if (!$st_master_pengajar->kode_pengajar->FldIsDetailKey) {
			$st_master_pengajar->kode_pengajar->setFormValue($objForm->GetValue("x_kode_pengajar"));
		}
		if (!$st_master_pengajar->password->FldIsDetailKey) {
			$st_master_pengajar->password->setFormValue($objForm->GetValue("x_password"));
		}
		if (!$st_master_pengajar->kode_otomatis_tingkat->FldIsDetailKey) {
			$st_master_pengajar->kode_otomatis_tingkat->setFormValue($objForm->GetValue("x_kode_otomatis_tingkat"));
		}
		if (!$st_master_pengajar->hp->FldIsDetailKey) {
			$st_master_pengajar->hp->setFormValue($objForm->GetValue("x_hp"));
		}
		if (!$st_master_pengajar->kode_otomatis->FldIsDetailKey) {
			$st_master_pengajar->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_master_pengajar;
		$this->LoadOldRecord();
		$st_master_pengajar->nama->CurrentValue = $st_master_pengajar->nama->FormValue;
		$st_master_pengajar->kode_pengajar->CurrentValue = $st_master_pengajar->kode_pengajar->FormValue;
		$st_master_pengajar->password->CurrentValue = $st_master_pengajar->password->FormValue;
		$st_master_pengajar->kode_otomatis_tingkat->CurrentValue = $st_master_pengajar->kode_otomatis_tingkat->FormValue;
		$st_master_pengajar->hp->CurrentValue = $st_master_pengajar->hp->FormValue;
		$st_master_pengajar->kode_otomatis->CurrentValue = $st_master_pengajar->kode_otomatis->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_pengajar;
		$sFilter = $st_master_pengajar->KeyFilter();

		// Call Row Selecting event
		$st_master_pengajar->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_pengajar->CurrentFilter = $sFilter;
		$sSql = $st_master_pengajar->SQL();
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
		global $conn, $st_master_pengajar;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_pengajar->Row_Selected($row);
		$st_master_pengajar->nama->setDbValue($rs->fields('nama'));
		$st_master_pengajar->kode_pengajar->setDbValue($rs->fields('kode_pengajar'));
		$st_master_pengajar->password->setDbValue($rs->fields('password'));
		$st_master_pengajar->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$st_master_pengajar->hp->setDbValue($rs->fields('hp'));
		$st_master_pengajar->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_master_pengajar;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_master_pengajar->getKey("kode_otomatis")) <> "")
			$st_master_pengajar->kode_otomatis->CurrentValue = $st_master_pengajar->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_master_pengajar->CurrentFilter = $st_master_pengajar->KeyFilter();
			$sSql = $st_master_pengajar->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_pengajar;

		// Initialize URLs
		// Call Row_Rendering event

		$st_master_pengajar->Row_Rendering();

		// Common render codes for all row types
		// nama
		// kode_pengajar
		// password
		// kode_otomatis_tingkat
		// hp
		// kode_otomatis

		if ($st_master_pengajar->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama
			$st_master_pengajar->nama->ViewValue = $st_master_pengajar->nama->CurrentValue;
			$st_master_pengajar->nama->ViewCustomAttributes = "";

			// kode_pengajar
			$st_master_pengajar->kode_pengajar->ViewValue = $st_master_pengajar->kode_pengajar->CurrentValue;
			$st_master_pengajar->kode_pengajar->ViewCustomAttributes = "";

			// password
			$st_master_pengajar->password->ViewValue = $st_master_pengajar->password->CurrentValue;
			$st_master_pengajar->password->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_pengajar->kode_otomatis_tingkat->ViewValue = $st_master_pengajar->kode_otomatis_tingkat->CurrentValue;
			$st_master_pengajar->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// hp
			$st_master_pengajar->hp->ViewValue = $st_master_pengajar->hp->CurrentValue;
			$st_master_pengajar->hp->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_pengajar->kode_otomatis->ViewValue = $st_master_pengajar->kode_otomatis->CurrentValue;
			$st_master_pengajar->kode_otomatis->ViewCustomAttributes = "";

			// nama
			$st_master_pengajar->nama->LinkCustomAttributes = "";
			$st_master_pengajar->nama->HrefValue = "";
			$st_master_pengajar->nama->TooltipValue = "";

			// kode_pengajar
			$st_master_pengajar->kode_pengajar->LinkCustomAttributes = "";
			$st_master_pengajar->kode_pengajar->HrefValue = "";
			$st_master_pengajar->kode_pengajar->TooltipValue = "";

			// password
			$st_master_pengajar->password->LinkCustomAttributes = "";
			$st_master_pengajar->password->HrefValue = "";
			$st_master_pengajar->password->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_pengajar->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_pengajar->kode_otomatis_tingkat->HrefValue = "";
			$st_master_pengajar->kode_otomatis_tingkat->TooltipValue = "";

			// hp
			$st_master_pengajar->hp->LinkCustomAttributes = "";
			$st_master_pengajar->hp->HrefValue = "";
			$st_master_pengajar->hp->TooltipValue = "";

			// kode_otomatis
			$st_master_pengajar->kode_otomatis->LinkCustomAttributes = "";
			$st_master_pengajar->kode_otomatis->HrefValue = "";
			$st_master_pengajar->kode_otomatis->TooltipValue = "";
		} elseif ($st_master_pengajar->RowType == EW_ROWTYPE_ADD) { // Add row

			// nama
			$st_master_pengajar->nama->EditCustomAttributes = "";
			$st_master_pengajar->nama->EditValue = ew_HtmlEncode($st_master_pengajar->nama->CurrentValue);

			// kode_pengajar
			$st_master_pengajar->kode_pengajar->EditCustomAttributes = "";
			$st_master_pengajar->kode_pengajar->EditValue = ew_HtmlEncode($st_master_pengajar->kode_pengajar->CurrentValue);

			// password
			$st_master_pengajar->password->EditCustomAttributes = "";
			$st_master_pengajar->password->EditValue = ew_HtmlEncode($st_master_pengajar->password->CurrentValue);

			// kode_otomatis_tingkat
			$st_master_pengajar->kode_otomatis_tingkat->EditCustomAttributes = "";
			$st_master_pengajar->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];

			// hp
			$st_master_pengajar->hp->EditCustomAttributes = "";
			$st_master_pengajar->hp->EditValue = ew_HtmlEncode($st_master_pengajar->hp->CurrentValue);

			// kode_otomatis
			$st_master_pengajar->kode_otomatis->EditCustomAttributes = "";
			$st_master_pengajar->kode_otomatis->CurrentValue = unik();

			// Edit refer script
			// nama

			$st_master_pengajar->nama->HrefValue = "";

			// kode_pengajar
			$st_master_pengajar->kode_pengajar->HrefValue = "";

			// password
			$st_master_pengajar->password->HrefValue = "";

			// kode_otomatis_tingkat
			$st_master_pengajar->kode_otomatis_tingkat->HrefValue = "";

			// hp
			$st_master_pengajar->hp->HrefValue = "";

			// kode_otomatis
			$st_master_pengajar->kode_otomatis->HrefValue = "";
		}
		if ($st_master_pengajar->RowType == EW_ROWTYPE_ADD ||
			$st_master_pengajar->RowType == EW_ROWTYPE_EDIT ||
			$st_master_pengajar->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_master_pengajar->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_master_pengajar->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_pengajar->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_master_pengajar;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_master_pengajar->nama->FormValue) && $st_master_pengajar->nama->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_pengajar->nama->FldCaption());
		}
		if (!is_null($st_master_pengajar->kode_pengajar->FormValue) && $st_master_pengajar->kode_pengajar->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_pengajar->kode_pengajar->FldCaption());
		}
		if (!is_null($st_master_pengajar->password->FormValue) && $st_master_pengajar->password->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_pengajar->password->FldCaption());
		}
		if (!is_null($st_master_pengajar->hp->FormValue) && $st_master_pengajar->hp->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_pengajar->hp->FldCaption());
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
		global $conn, $Language, $Security, $st_master_pengajar;

		// Check if key value entered
		if ($st_master_pengajar->kode_otomatis->CurrentValue == "" && $st_master_pengajar->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_master_pengajar->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_master_pengajar->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_pengajar->kode_pengajar->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_pengajar = '" . ew_AdjustSql($st_master_pengajar->kode_pengajar->CurrentValue) . "')";
			$rsChk = $st_master_pengajar->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_pengajar', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_pengajar->kode_pengajar->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_pengajar->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_master_pengajar->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_master_pengajar->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_pengajar->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// nama
		$st_master_pengajar->nama->SetDbValueDef($rsnew, $st_master_pengajar->nama->CurrentValue, "", FALSE);

		// kode_pengajar
		$st_master_pengajar->kode_pengajar->SetDbValueDef($rsnew, $st_master_pengajar->kode_pengajar->CurrentValue, "", FALSE);

		// password
		$st_master_pengajar->password->SetDbValueDef($rsnew, $st_master_pengajar->password->CurrentValue, "", FALSE);

		// kode_otomatis_tingkat
		$st_master_pengajar->kode_otomatis_tingkat->SetDbValueDef($rsnew, $st_master_pengajar->kode_otomatis_tingkat->CurrentValue, "", FALSE);

		// hp
		$st_master_pengajar->hp->SetDbValueDef($rsnew, $st_master_pengajar->hp->CurrentValue, "", FALSE);

		// kode_otomatis
		$st_master_pengajar->kode_otomatis->SetDbValueDef($rsnew, $st_master_pengajar->kode_otomatis->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_master_pengajar->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_master_pengajar->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_master_pengajar->CancelMessage <> "") {
				$this->setFailureMessage($st_master_pengajar->CancelMessage);
				$st_master_pengajar->CancelMessage = "";
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
			$st_master_pengajar->Row_Inserted($rs, $rsnew);
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
