<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pengguna_add = new cpengguna_add();
$Page =& $pengguna_add;

// Page init
$pengguna_add->Page_Init();

// Page main
$pengguna_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pengguna_add = new ew_Page("pengguna_add");

// page properties
pengguna_add.PageID = "add"; // page ID
pengguna_add.FormID = "fpenggunaadd"; // form ID
var EW_PAGE_ID = pengguna_add.PageID; // for backward compatibility

// extend page with ValidateForm function
pengguna_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nama_pengguna"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pengguna->nama_pengguna->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pengguna->password->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pengguna->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_otomatis_tingkat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pengguna->kode_otomatis_tingkat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_user_level"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pengguna->user_level->FldCaption()) ?>");

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
pengguna_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pengguna_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pengguna_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pengguna->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pengguna->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pengguna_add->ShowPageHeader(); ?>
<?php
$pengguna_add->ShowMessage();
?>
<form name="fpenggunaadd" id="fpenggunaadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pengguna_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pengguna">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pengguna->nama_pengguna->Visible) { // nama_pengguna ?>
	<tr id="r_nama_pengguna"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->nama_pengguna->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pengguna->nama_pengguna->CellAttributes() ?>><span id="el_nama_pengguna">
<input type="text" name="x_nama_pengguna" id="x_nama_pengguna" size="30" maxlength="100" value="<?php echo $pengguna->nama_pengguna->EditValue ?>"<?php echo $pengguna->nama_pengguna->EditAttributes() ?>>
</span><?php echo $pengguna->nama_pengguna->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pengguna->password->Visible) { // password ?>
	<tr id="r_password"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pengguna->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" size="30" maxlength="100" value="<?php echo $pengguna->password->EditValue ?>"<?php echo $pengguna->password->EditAttributes() ?>>
</span><?php echo $pengguna->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pengguna->username->Visible) { // username ?>
	<tr id="r_username"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pengguna->username->CellAttributes() ?>><span id="el_username">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_username" name="x_username"<?php echo $pengguna->username->EditAttributes() ?>>
<?php
if (is_array($pengguna->username->EditValue)) {
	$arwrk = $pengguna->username->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->username->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<input type="text" name="x_username" id="x_username" size="30" maxlength="50" value="<?php echo $pengguna->username->EditValue ?>"<?php echo $pengguna->username->EditAttributes() ?>>
<?php } ?>
</span><?php echo $pengguna->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pengguna->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<tr id="r_kode_otomatis_tingkat"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->kode_otomatis_tingkat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pengguna->kode_otomatis_tingkat->CellAttributes() ?>><span id="el_kode_otomatis_tingkat">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_kode_otomatis_tingkat" name="x_kode_otomatis_tingkat"<?php echo $pengguna->kode_otomatis_tingkat->EditAttributes() ?>>
<?php
if (is_array($pengguna->kode_otomatis_tingkat->EditValue)) {
	$arwrk = $pengguna->kode_otomatis_tingkat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->kode_otomatis_tingkat->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<select id="x_kode_otomatis_tingkat" name="x_kode_otomatis_tingkat"<?php echo $pengguna->kode_otomatis_tingkat->EditAttributes() ?>>
<?php
if (is_array($pengguna->kode_otomatis_tingkat->EditValue)) {
	$arwrk = $pengguna->kode_otomatis_tingkat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->kode_otomatis_tingkat->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $pengguna->kode_otomatis_tingkat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pengguna->user_level->Visible) { // user_level ?>
	<tr id="r_user_level"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->user_level->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pengguna->user_level->CellAttributes() ?>><span id="el_user_level">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $pengguna->user_level->ViewAttributes() ?>><?php echo $pengguna->user_level->EditValue ?></div>
<?php } else { ?>
<select id="x_user_level" name="x_user_level"<?php echo $pengguna->user_level->EditAttributes() ?>>
<?php
if (is_array($pengguna->user_level->EditValue)) {
	$arwrk = $pengguna->user_level->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->user_level->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $pengguna->user_level->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$pengguna_add->ShowPageFooter();
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
$pengguna_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpengguna_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'pengguna';

	// Page object name
	var $PageObjName = 'pengguna_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pengguna;
		if ($pengguna->UseTokenInUrl) $PageUrl .= "t=" . $pengguna->TableVar . "&"; // Add page token
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
		global $objForm, $pengguna;
		if ($pengguna->UseTokenInUrl) {
			if ($objForm)
				return ($pengguna->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pengguna->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpengguna_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pengguna)
		if (!isset($GLOBALS["pengguna"])) {
			$GLOBALS["pengguna"] = new cpengguna();
			$GLOBALS["Table"] =& $GLOBALS["pengguna"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pengguna', TRUE);

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
		global $pengguna;

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
			$this->Page_Terminate("penggunalist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("penggunalist.php");
		}

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
		global $objForm, $Language, $gsFormError, $pengguna;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$pengguna->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pengguna->CurrentAction = "I"; // Form error, reset action
				$pengguna->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$pengguna->id->setQueryStringValue($_GET["id"]);
				$pengguna->setKey("id", $pengguna->id->CurrentValue); // Set up key
			} else {
				$pengguna->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$pengguna->CurrentAction = "C"; // Copy record
			} else {
				$pengguna->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($pengguna->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("penggunalist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$pengguna->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $pengguna->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "penggunaview.php")
						$sReturnUrl = $pengguna->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$pengguna->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$pengguna->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$pengguna->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pengguna;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $pengguna;
		$pengguna->nama_pengguna->CurrentValue = NULL;
		$pengguna->nama_pengguna->OldValue = $pengguna->nama_pengguna->CurrentValue;
		$pengguna->password->CurrentValue = NULL;
		$pengguna->password->OldValue = $pengguna->password->CurrentValue;
		$pengguna->username->CurrentValue = CurrentUserID();
		$pengguna->kode_otomatis_tingkat->CurrentValue = NULL;
		$pengguna->kode_otomatis_tingkat->OldValue = $pengguna->kode_otomatis_tingkat->CurrentValue;
		$pengguna->user_level->CurrentValue = NULL;
		$pengguna->user_level->OldValue = $pengguna->user_level->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pengguna;
		if (!$pengguna->nama_pengguna->FldIsDetailKey) {
			$pengguna->nama_pengguna->setFormValue($objForm->GetValue("x_nama_pengguna"));
		}
		if (!$pengguna->password->FldIsDetailKey) {
			$pengguna->password->setFormValue($objForm->GetValue("x_password"));
		}
		if (!$pengguna->username->FldIsDetailKey) {
			$pengguna->username->setFormValue($objForm->GetValue("x_username"));
		}
		if (!$pengguna->kode_otomatis_tingkat->FldIsDetailKey) {
			$pengguna->kode_otomatis_tingkat->setFormValue($objForm->GetValue("x_kode_otomatis_tingkat"));
		}
		if (!$pengguna->user_level->FldIsDetailKey) {
			$pengguna->user_level->setFormValue($objForm->GetValue("x_user_level"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pengguna;
		$this->LoadOldRecord();
		$pengguna->nama_pengguna->CurrentValue = $pengguna->nama_pengguna->FormValue;
		$pengguna->password->CurrentValue = $pengguna->password->FormValue;
		$pengguna->username->CurrentValue = $pengguna->username->FormValue;
		$pengguna->kode_otomatis_tingkat->CurrentValue = $pengguna->kode_otomatis_tingkat->FormValue;
		$pengguna->user_level->CurrentValue = $pengguna->user_level->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pengguna;
		$sFilter = $pengguna->KeyFilter();

		// Call Row Selecting event
		$pengguna->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pengguna->CurrentFilter = $sFilter;
		$sSql = $pengguna->SQL();
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
		global $conn, $pengguna;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pengguna->Row_Selected($row);
		$pengguna->id->setDbValue($rs->fields('id'));
		$pengguna->nama_pengguna->setDbValue($rs->fields('nama_pengguna'));
		$pengguna->password->setDbValue($rs->fields('password'));
		$pengguna->username->setDbValue($rs->fields('username'));
		$pengguna->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$pengguna->user_level->setDbValue($rs->fields('user_level'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pengguna;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pengguna->getKey("id")) <> "")
			$pengguna->id->CurrentValue = $pengguna->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pengguna->CurrentFilter = $pengguna->KeyFilter();
			$sSql = $pengguna->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pengguna;

		// Initialize URLs
		// Call Row_Rendering event

		$pengguna->Row_Rendering();

		// Common render codes for all row types
		// id
		// nama_pengguna
		// password
		// username
		// kode_otomatis_tingkat
		// user_level

		if ($pengguna->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pengguna->id->ViewValue = $pengguna->id->CurrentValue;
			$pengguna->id->ViewCustomAttributes = "";

			// nama_pengguna
			$pengguna->nama_pengguna->ViewValue = $pengguna->nama_pengguna->CurrentValue;
			$pengguna->nama_pengguna->ViewCustomAttributes = "";

			// password
			$pengguna->password->ViewValue = $pengguna->password->CurrentValue;
			$pengguna->password->ViewCustomAttributes = "";

			// username
			$pengguna->username->ViewValue = $pengguna->username->CurrentValue;
			$pengguna->username->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			if (strval($pengguna->kode_otomatis_tingkat->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pengguna->kode_otomatis_tingkat->CurrentValue) . "'";
			$sSqlWrk = "SELECT `tingkat` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->kode_otomatis_tingkat->ViewValue = $rswrk->fields('tingkat');
					$rswrk->Close();
				} else {
					$pengguna->kode_otomatis_tingkat->ViewValue = $pengguna->kode_otomatis_tingkat->CurrentValue;
				}
			} else {
				$pengguna->kode_otomatis_tingkat->ViewValue = NULL;
			}
			$pengguna->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// user_level
			if ($Security->CanAdmin()) { // System admin
			if (strval($pengguna->user_level->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($pengguna->user_level->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->user_level->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$pengguna->user_level->ViewValue = $pengguna->user_level->CurrentValue;
				}
			} else {
				$pengguna->user_level->ViewValue = NULL;
			}
			} else {
				$pengguna->user_level->ViewValue = "********";
			}
			$pengguna->user_level->ViewCustomAttributes = "";

			// nama_pengguna
			$pengguna->nama_pengguna->LinkCustomAttributes = "";
			$pengguna->nama_pengguna->HrefValue = "";
			$pengguna->nama_pengguna->TooltipValue = "";

			// password
			$pengguna->password->LinkCustomAttributes = "";
			$pengguna->password->HrefValue = "";
			$pengguna->password->TooltipValue = "";

			// username
			$pengguna->username->LinkCustomAttributes = "";
			$pengguna->username->HrefValue = "";
			$pengguna->username->TooltipValue = "";

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$pengguna->kode_otomatis_tingkat->HrefValue = "";
			$pengguna->kode_otomatis_tingkat->TooltipValue = "";

			// user_level
			$pengguna->user_level->LinkCustomAttributes = "";
			$pengguna->user_level->HrefValue = "";
			$pengguna->user_level->TooltipValue = "";
		} elseif ($pengguna->RowType == EW_ROWTYPE_ADD) { // Add row

			// nama_pengguna
			$pengguna->nama_pengguna->EditCustomAttributes = "";
			$pengguna->nama_pengguna->EditValue = ew_HtmlEncode($pengguna->nama_pengguna->CurrentValue);

			// password
			$pengguna->password->EditCustomAttributes = "";
			$pengguna->password->EditValue = ew_HtmlEncode($pengguna->password->CurrentValue);

			// username
			$pengguna->username->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sFilterWrk = $GLOBALS["pengguna"]->AddUserIDFilter("");
			$sSqlWrk = "SELECT `username`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `pengguna`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$pengguna->username->EditValue = $arwrk;
			} else {
			$pengguna->username->EditValue = ew_HtmlEncode($pengguna->username->CurrentValue);
			}

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `kode_otomatis`, `tingkat` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$pengguna->kode_otomatis_tingkat->EditValue = $arwrk;
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kode_otomatis`, `tingkat` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pengguna->kode_otomatis_tingkat->EditValue = $arwrk;
			}

			// user_level
			$pengguna->user_level->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$pengguna->user_level->EditValue = "********";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pengguna->user_level->EditValue = $arwrk;
			}

			// Edit refer script
			// nama_pengguna

			$pengguna->nama_pengguna->HrefValue = "";

			// password
			$pengguna->password->HrefValue = "";

			// username
			$pengguna->username->HrefValue = "";

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->HrefValue = "";

			// user_level
			$pengguna->user_level->HrefValue = "";
		}
		if ($pengguna->RowType == EW_ROWTYPE_ADD ||
			$pengguna->RowType == EW_ROWTYPE_EDIT ||
			$pengguna->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pengguna->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pengguna->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pengguna->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pengguna;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pengguna->nama_pengguna->FormValue) && $pengguna->nama_pengguna->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pengguna->nama_pengguna->FldCaption());
		}
		if (!is_null($pengguna->password->FormValue) && $pengguna->password->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pengguna->password->FldCaption());
		}
		if (!is_null($pengguna->username->FormValue) && $pengguna->username->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pengguna->username->FldCaption());
		}
		if (!is_null($pengguna->kode_otomatis_tingkat->FormValue) && $pengguna->kode_otomatis_tingkat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pengguna->kode_otomatis_tingkat->FldCaption());
		}
		if (!is_null($pengguna->user_level->FormValue) && $pengguna->user_level->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pengguna->user_level->FldCaption());
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
		global $conn, $Language, $Security, $pengguna;

		// Check if valid User ID
		$bValidUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$bValidUser = $Security->IsValidUserID($pengguna->username->CurrentValue);
			if (!$bValidUser) {
				$sUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedUserID"));
				$sUserIdMsg = str_replace("%u", $pengguna->username->CurrentValue, $sUserIdMsg);
				$this->setFailureMessage($sUserIdMsg);
				return FALSE;
			}
		}

		// Check if valid parent user id
		$bValidParentUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$bValidParentUser = $Security->IsValidUserID($pengguna->kode_otomatis_tingkat->CurrentValue);
			if (!$bValidParentUser) {
				$sParentUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedParentUserID"));
				$sParentUserIdMsg = str_replace("%p", $pengguna->kode_otomatis_tingkat->CurrentValue, $sParentUserIdMsg);
				$this->setFailureMessage($sParentUserIdMsg);
				return FALSE;
			}
		}
		$rsnew = array();

		// nama_pengguna
		$pengguna->nama_pengguna->SetDbValueDef($rsnew, $pengguna->nama_pengguna->CurrentValue, "", FALSE);

		// password
		$pengguna->password->SetDbValueDef($rsnew, $pengguna->password->CurrentValue, "", FALSE);

		// username
		$pengguna->username->SetDbValueDef($rsnew, $pengguna->username->CurrentValue, "", FALSE);

		// kode_otomatis_tingkat
		$pengguna->kode_otomatis_tingkat->SetDbValueDef($rsnew, $pengguna->kode_otomatis_tingkat->CurrentValue, "", FALSE);

		// user_level
		if ($Security->CanAdmin()) { // System admin
		$pengguna->user_level->SetDbValueDef($rsnew, $pengguna->user_level->CurrentValue, 0, FALSE);
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $pengguna->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pengguna->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pengguna->CancelMessage <> "") {
				$this->setFailureMessage($pengguna->CancelMessage);
				$pengguna->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$pengguna->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $pengguna->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$pengguna->Row_Inserted($rs, $rsnew);
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
