<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "st_peserta2info.php" ?>
<?php include_once "st_peserta2gridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_kelas_kelompok_add = new cst_master_kelas_kelompok_add();
$Page =& $st_master_kelas_kelompok_add;

// Page init
$st_master_kelas_kelompok_add->Page_Init();

// Page main
$st_master_kelas_kelompok_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_kelas_kelompok_add = new ew_Page("st_master_kelas_kelompok_add");

// page properties
st_master_kelas_kelompok_add.PageID = "add"; // page ID
st_master_kelas_kelompok_add.FormID = "fst_master_kelas_kelompokadd"; // form ID
var EW_PAGE_ID = st_master_kelas_kelompok_add.PageID; // for backward compatibility

// extend page with ValidateForm function
st_master_kelas_kelompok_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_tahun"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->tahun->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kelas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->kelas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_kelas_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_apakah_valid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->apakah_valid->FldCaption()) ?>");

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
st_master_kelas_kelompok_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
st_master_kelas_kelompok_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_kelas_kelompok_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_kelas_kelompok_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_kelas_kelompok->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_master_kelas_kelompok->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_master_kelas_kelompok_add->ShowPageHeader(); ?>
<?php
$st_master_kelas_kelompok_add->ShowMessage();
?>
<form name="fst_master_kelas_kelompokadd" id="fst_master_kelas_kelompokadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return st_master_kelas_kelompok_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="st_master_kelas_kelompok">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($st_master_kelas_kelompok->tahun->Visible) { // tahun ?>
	<tr id="r_tahun"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_kelas_kelompok->tahun->CellAttributes() ?>><span id="el_tahun">
<input type="text" name="x_tahun" id="x_tahun" size="30" maxlength="4" value="<?php echo $st_master_kelas_kelompok->tahun->EditValue ?>"<?php echo $st_master_kelas_kelompok->tahun->EditAttributes() ?>>
</span><?php echo $st_master_kelas_kelompok->tahun->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->kelas->Visible) { // kelas ?>
	<tr id="r_kelas"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kelas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_kelas_kelompok->kelas->CellAttributes() ?>><span id="el_kelas">
<select id="x_kelas" name="x_kelas"<?php echo $st_master_kelas_kelompok->kelas->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->kelas->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->kelas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->kelas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $st_master_kelas_kelompok->kelas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($st_master_kelas_kelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<tr id="r_nama_kelas_kelompok"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->CellAttributes() ?>><span id="el_nama_kelas_kelompok">
<input type="text" name="x_nama_kelas_kelompok" id="x_nama_kelas_kelompok" size="30" maxlength="50" value="<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditValue ?>"<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditAttributes() ?>>
</span><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<?php if ($st_master_kelas_kelompok->apakah_valid->Visible) { // apakah_valid ?>
	<tr id="r_apakah_valid"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_kelas_kelompok->apakah_valid->CellAttributes() ?>><span id="el_apakah_valid">
<select id="x_apakah_valid" name="x_apakah_valid"<?php echo $st_master_kelas_kelompok->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->apakah_valid->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $st_master_kelas_kelompok->apakah_valid->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis_tingkat" id="x_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue) ?>">
</table>
</div>
</td></tr></table>
<p>
<?php if ($st_master_kelas_kelompok->getCurrentDetailTable() == "st_peserta2" && $st_peserta2->DetailAdd) { ?>
<br>
<?php include_once "st_peserta2grid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$st_master_kelas_kelompok_add->ShowPageFooter();
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
$st_master_kelas_kelompok_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_kelas_kelompok_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'st_master_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_master_kelas_kelompok_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_master_kelas_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_kelas_kelompok_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_kelas_kelompok)
		if (!isset($GLOBALS["st_master_kelas_kelompok"])) {
			$GLOBALS["st_master_kelas_kelompok"] = new cst_master_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_master_kelas_kelompok"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (st_peserta2)
		if (!isset($GLOBALS['st_peserta2'])) $GLOBALS['st_peserta2'] = new cst_peserta2();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_kelas_kelompok', TRUE);

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
		global $st_master_kelas_kelompok;

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
			$this->Page_Terminate("st_master_kelas_kelompoklist.php");
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
		global $objForm, $Language, $gsFormError, $st_master_kelas_kelompok;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$st_master_kelas_kelompok->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$st_master_kelas_kelompok->CurrentAction = "I"; // Form error, reset action
				$st_master_kelas_kelompok->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["kode_otomatis"] != "") {
				$st_master_kelas_kelompok->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$st_master_kelas_kelompok->setKey("kode_otomatis", $st_master_kelas_kelompok->kode_otomatis->CurrentValue); // Set up key
			} else {
				$st_master_kelas_kelompok->setKey("kode_otomatis", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$st_master_kelas_kelompok->CurrentAction = "C"; // Copy record
			} else {
				$st_master_kelas_kelompok->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($st_master_kelas_kelompok->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("st_master_kelas_kelompoklist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$st_master_kelas_kelompok->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($st_master_kelas_kelompok->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $st_master_kelas_kelompok->getDetailUrl();
					else
						$sReturnUrl = $st_master_kelas_kelompok->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "st_master_kelas_kelompokview.php")
						$sReturnUrl = $st_master_kelas_kelompok->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$st_master_kelas_kelompok->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$st_master_kelas_kelompok->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$st_master_kelas_kelompok->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $st_master_kelas_kelompok;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->tahun->CurrentValue = NULL;
		$st_master_kelas_kelompok->tahun->OldValue = $st_master_kelas_kelompok->tahun->CurrentValue;
		$st_master_kelas_kelompok->kelas->CurrentValue = NULL;
		$st_master_kelas_kelompok->kelas->OldValue = $st_master_kelas_kelompok->kelas->CurrentValue;
		$st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue = NULL;
		$st_master_kelas_kelompok->nama_kelas_kelompok->OldValue = $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue;
		$st_master_kelas_kelompok->kode_otomatis->CurrentValue = unik();
		$st_master_kelas_kelompok->apakah_valid->CurrentValue = NULL;
		$st_master_kelas_kelompok->apakah_valid->OldValue = $st_master_kelas_kelompok->apakah_valid->CurrentValue;
		$st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_master_kelas_kelompok;
		if (!$st_master_kelas_kelompok->tahun->FldIsDetailKey) {
			$st_master_kelas_kelompok->tahun->setFormValue($objForm->GetValue("x_tahun"));
		}
		if (!$st_master_kelas_kelompok->kelas->FldIsDetailKey) {
			$st_master_kelas_kelompok->kelas->setFormValue($objForm->GetValue("x_kelas"));
		}
		if (!$st_master_kelas_kelompok->nama_kelas_kelompok->FldIsDetailKey) {
			$st_master_kelas_kelompok->nama_kelas_kelompok->setFormValue($objForm->GetValue("x_nama_kelas_kelompok"));
		}
		if (!$st_master_kelas_kelompok->kode_otomatis->FldIsDetailKey) {
			$st_master_kelas_kelompok->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$st_master_kelas_kelompok->apakah_valid->FldIsDetailKey) {
			$st_master_kelas_kelompok->apakah_valid->setFormValue($objForm->GetValue("x_apakah_valid"));
		}
		if (!$st_master_kelas_kelompok->kode_otomatis_tingkat->FldIsDetailKey) {
			$st_master_kelas_kelompok->kode_otomatis_tingkat->setFormValue($objForm->GetValue("x_kode_otomatis_tingkat"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_master_kelas_kelompok;
		$this->LoadOldRecord();
		$st_master_kelas_kelompok->tahun->CurrentValue = $st_master_kelas_kelompok->tahun->FormValue;
		$st_master_kelas_kelompok->kelas->CurrentValue = $st_master_kelas_kelompok->kelas->FormValue;
		$st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue = $st_master_kelas_kelompok->nama_kelas_kelompok->FormValue;
		$st_master_kelas_kelompok->kode_otomatis->CurrentValue = $st_master_kelas_kelompok->kode_otomatis->FormValue;
		$st_master_kelas_kelompok->apakah_valid->CurrentValue = $st_master_kelas_kelompok->apakah_valid->FormValue;
		$st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_kelas_kelompok;
		$sFilter = $st_master_kelas_kelompok->KeyFilter();

		// Call Row Selecting event
		$st_master_kelas_kelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_kelas_kelompok->CurrentFilter = $sFilter;
		$sSql = $st_master_kelas_kelompok->SQL();
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
		global $conn, $st_master_kelas_kelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_kelas_kelompok->Row_Selected($row);
		$st_master_kelas_kelompok->tahun->setDbValue($rs->fields('tahun'));
		$st_master_kelas_kelompok->kelas->setDbValue($rs->fields('kelas'));
		$st_master_kelas_kelompok->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$st_master_kelas_kelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$st_master_kelas_kelompok->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$st_master_kelas_kelompok->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_master_kelas_kelompok;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_master_kelas_kelompok->getKey("kode_otomatis")) <> "")
			$st_master_kelas_kelompok->kode_otomatis->CurrentValue = $st_master_kelas_kelompok->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_master_kelas_kelompok->CurrentFilter = $st_master_kelas_kelompok->KeyFilter();
			$sSql = $st_master_kelas_kelompok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_kelas_kelompok;

		// Initialize URLs
		// Call Row_Rendering event

		$st_master_kelas_kelompok->Row_Rendering();

		// Common render codes for all row types
		// tahun
		// kelas
		// nama_kelas_kelompok
		// kode_otomatis
		// apakah_valid
		// kode_otomatis_tingkat

		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// tahun
			$st_master_kelas_kelompok->tahun->ViewValue = $st_master_kelas_kelompok->tahun->CurrentValue;
			$st_master_kelas_kelompok->tahun->ViewCustomAttributes = "";

			// kelas
			if (strval($st_master_kelas_kelompok->kelas->CurrentValue) <> "") {
				$sFilterWrk = "`kelas` = '" . ew_AdjustSql($st_master_kelas_kelompok->kelas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kelas` FROM `st_master_kelas`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kelas` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$st_master_kelas_kelompok->kelas->ViewValue = $rswrk->fields('kelas');
					$rswrk->Close();
				} else {
					$st_master_kelas_kelompok->kelas->ViewValue = $st_master_kelas_kelompok->kelas->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->kelas->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->kelas->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewValue = $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue;
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->ViewValue = $st_master_kelas_kelompok->kode_otomatis->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) <> "") {
				switch ($st_master_kelas_kelompok->apakah_valid->CurrentValue) {
					case "y":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					case "t":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					default:
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->apakah_valid->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$st_master_kelas_kelompok->tahun->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->HrefValue = "";
			$st_master_kelas_kelompok->tahun->TooltipValue = "";

			// kelas
			$st_master_kelas_kelompok->kelas->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kelas->HrefValue = "";
			$st_master_kelas_kelompok->kelas->TooltipValue = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->HrefValue = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->TooltipValue = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->apakah_valid->HrefValue = "";
			$st_master_kelas_kelompok->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->TooltipValue = "";
		} elseif ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add row

			// tahun
			$st_master_kelas_kelompok->tahun->EditCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->tahun->CurrentValue);

			// kelas
			$st_master_kelas_kelompok->kelas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kelas`, `kelas` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_kelas`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kelas` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->kelas->EditValue = $arwrk;

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue);

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->CurrentValue = unik();

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->apakah_valid->EditValue = $arwrk;

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];

			// Edit refer script
			// tahun

			$st_master_kelas_kelompok->tahun->HrefValue = "";

			// kelas
			$st_master_kelas_kelompok->kelas->HrefValue = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->HrefValue = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->HrefValue = "";

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->HrefValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->HrefValue = "";
		}
		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD ||
			$st_master_kelas_kelompok->RowType == EW_ROWTYPE_EDIT ||
			$st_master_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_master_kelas_kelompok->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_master_kelas_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_kelas_kelompok->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_master_kelas_kelompok;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_master_kelas_kelompok->tahun->FormValue) && $st_master_kelas_kelompok->tahun->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->tahun->FldCaption());
		}
		if (!is_null($st_master_kelas_kelompok->kelas->FormValue) && $st_master_kelas_kelompok->kelas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->kelas->FldCaption());
		}
		if (!is_null($st_master_kelas_kelompok->nama_kelas_kelompok->FormValue) && $st_master_kelas_kelompok->nama_kelas_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption());
		}
		if (!is_null($st_master_kelas_kelompok->apakah_valid->FormValue) && $st_master_kelas_kelompok->apakah_valid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->apakah_valid->FldCaption());
		}

		// Validate detail grid
		if ($st_master_kelas_kelompok->getCurrentDetailTable() == "st_peserta2" && $GLOBALS["st_peserta2"]->DetailAdd) {
			$st_peserta2_grid = new cst_peserta2_grid(); // get detail page object
			$st_peserta2_grid->ValidateGridForm();
			$st_peserta2_grid = NULL;
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
		global $conn, $Language, $Security, $st_master_kelas_kelompok;

		// Check if key value entered
		if ($st_master_kelas_kelompok->kode_otomatis->CurrentValue == "" && $st_master_kelas_kelompok->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_master_kelas_kelompok->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_master_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nama_kelas_kelompok = '" . ew_AdjustSql($st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue) . "')";
			$rsChk = $st_master_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'nama_kelas_kelompok', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_kelas_kelompok->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_master_kelas_kelompok->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_master_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_kelas_kelompok->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}

		// Begin transaction
		if ($st_master_kelas_kelompok->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// tahun
		$st_master_kelas_kelompok->tahun->SetDbValueDef($rsnew, $st_master_kelas_kelompok->tahun->CurrentValue, "", FALSE);

		// kelas
		$st_master_kelas_kelompok->kelas->SetDbValueDef($rsnew, $st_master_kelas_kelompok->kelas->CurrentValue, "", FALSE);

		// nama_kelas_kelompok
		$st_master_kelas_kelompok->nama_kelas_kelompok->SetDbValueDef($rsnew, $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue, "", FALSE);

		// kode_otomatis
		$st_master_kelas_kelompok->kode_otomatis->SetDbValueDef($rsnew, $st_master_kelas_kelompok->kode_otomatis->CurrentValue, "", FALSE);

		// apakah_valid
		$st_master_kelas_kelompok->apakah_valid->SetDbValueDef($rsnew, $st_master_kelas_kelompok->apakah_valid->CurrentValue, "", FALSE);

		// kode_otomatis_tingkat
		$st_master_kelas_kelompok->kode_otomatis_tingkat->SetDbValueDef($rsnew, $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_master_kelas_kelompok->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_master_kelas_kelompok->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_master_kelas_kelompok->CancelMessage <> "") {
				$this->setFailureMessage($st_master_kelas_kelompok->CancelMessage);
				$st_master_kelas_kelompok->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}

		// Add detail records
		if ($AddRow) {
			if ($st_master_kelas_kelompok->getCurrentDetailTable() == "st_peserta2" && $GLOBALS["st_peserta2"]->DetailAdd) {
				$GLOBALS["st_peserta2"]->kode_otomatis_kelompok->setSessionValue($st_master_kelas_kelompok->kode_otomatis->CurrentValue); // Set master key
				$st_peserta2_grid = new cst_peserta2_grid(); // get detail page object
				$AddRow = $st_peserta2_grid->GridInsert();
				$st_peserta2_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($st_master_kelas_kelompok->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$st_master_kelas_kelompok->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $st_master_kelas_kelompok;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$st_master_kelas_kelompok->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $st_master_kelas_kelompok->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "st_peserta2") {
				if (!isset($GLOBALS["st_peserta2"]))
					$GLOBALS["st_peserta2"] = new cst_peserta2;
				if ($GLOBALS["st_peserta2"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["st_peserta2"]->CurrentMode = "copy";
					else
						$GLOBALS["st_peserta2"]->CurrentMode = "add";
					$GLOBALS["st_peserta2"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["st_peserta2"]->setCurrentMasterTable($st_master_kelas_kelompok->TableVar);
					$GLOBALS["st_peserta2"]->setStartRecordNumber(1);
					$GLOBALS["st_peserta2"]->kode_otomatis_kelompok->FldIsDetailKey = TRUE;
					$GLOBALS["st_peserta2"]->kode_otomatis_kelompok->CurrentValue = $st_master_kelas_kelompok->kode_otomatis->CurrentValue;
					$GLOBALS["st_peserta2"]->kode_otomatis_kelompok->setSessionValue($GLOBALS["st_peserta2"]->kode_otomatis_kelompok->CurrentValue);
				}
			}
		}
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
