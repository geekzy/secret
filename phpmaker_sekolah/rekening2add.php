<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "rekening2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$rekening2_add = new crekening2_add();
$Page =& $rekening2_add;

// Page init
$rekening2_add->Page_Init();

// Page main
$rekening2_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var rekening2_add = new ew_Page("rekening2_add");

// page properties
rekening2_add.PageID = "add"; // page ID
rekening2_add.FormID = "frekening2add"; // form ID
var EW_PAGE_ID = rekening2_add.PageID; // for backward compatibility

// extend page with ValidateForm function
rekening2_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kodePokok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->kodePokok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kodeSubSatu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->kodeSubSatu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kodeSubDua"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->kodeSubDua->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kodeSubTiga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->kodeSubTiga->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Norek"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->Norek->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Keterangan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->Keterangan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D2FK"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->D2FK->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_SaldoAwal"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekening2->SaldoAwal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Saldo"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekening2->Saldo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_TanggalSaldo"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekening2->TanggalSaldo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_target"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekening2->target->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_debet_kali"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->debet_kali->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_debet_kali"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekening2->debet_kali->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_kredit_kali"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekening2->kredit_kali->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kredit_kali"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekening2->kredit_kali->FldErrMsg()) ?>");

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
rekening2_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
rekening2_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rekening2_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rekening2->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $rekening2->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $rekening2_add->ShowPageHeader(); ?>
<?php
$rekening2_add->ShowMessage();
?>
<form name="frekening2add" id="frekening2add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return rekening2_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="rekening2">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($rekening2->kodePokok->Visible) { // kodePokok ?>
	<tr id="r_kodePokok"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodePokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->kodePokok->CellAttributes() ?>><span id="el_kodePokok">
<input type="text" name="x_kodePokok" id="x_kodePokok" size="30" maxlength="50" value="<?php echo $rekening2->kodePokok->EditValue ?>"<?php echo $rekening2->kodePokok->EditAttributes() ?>>
</span><?php echo $rekening2->kodePokok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<tr id="r_kodeSubSatu"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodeSubSatu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->kodeSubSatu->CellAttributes() ?>><span id="el_kodeSubSatu">
<input type="text" name="x_kodeSubSatu" id="x_kodeSubSatu" size="30" maxlength="50" value="<?php echo $rekening2->kodeSubSatu->EditValue ?>"<?php echo $rekening2->kodeSubSatu->EditAttributes() ?>>
</span><?php echo $rekening2->kodeSubSatu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kodeSubDua->Visible) { // kodeSubDua ?>
	<tr id="r_kodeSubDua"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodeSubDua->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->kodeSubDua->CellAttributes() ?>><span id="el_kodeSubDua">
<input type="text" name="x_kodeSubDua" id="x_kodeSubDua" size="30" maxlength="50" value="<?php echo $rekening2->kodeSubDua->EditValue ?>"<?php echo $rekening2->kodeSubDua->EditAttributes() ?>>
</span><?php echo $rekening2->kodeSubDua->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<tr id="r_kodeSubTiga"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kodeSubTiga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->kodeSubTiga->CellAttributes() ?>><span id="el_kodeSubTiga">
<input type="text" name="x_kodeSubTiga" id="x_kodeSubTiga" size="30" maxlength="50" value="<?php echo $rekening2->kodeSubTiga->EditValue ?>"<?php echo $rekening2->kodeSubTiga->EditAttributes() ?>>
</span><?php echo $rekening2->kodeSubTiga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->Norek->Visible) { // Norek ?>
	<tr id="r_Norek"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->Norek->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->Norek->CellAttributes() ?>><span id="el_Norek">
<input type="text" name="x_Norek" id="x_Norek" size="30" maxlength="50" value="<?php echo $rekening2->Norek->EditValue ?>"<?php echo $rekening2->Norek->EditAttributes() ?>>
</span><?php echo $rekening2->Norek->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->Keterangan->Visible) { // Keterangan ?>
	<tr id="r_Keterangan"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->Keterangan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->Keterangan->CellAttributes() ?>><span id="el_Keterangan">
<input type="text" name="x_Keterangan" id="x_Keterangan" size="30" maxlength="50" value="<?php echo $rekening2->Keterangan->EditValue ?>"<?php echo $rekening2->Keterangan->EditAttributes() ?>>
</span><?php echo $rekening2->Keterangan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->D2FK->Visible) { // D/K ?>
	<tr id="r_D2FK"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->D2FK->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->D2FK->CellAttributes() ?>><span id="el_D2FK">
<input type="text" name="x_D2FK" id="x_D2FK" size="30" maxlength="2" value="<?php echo $rekening2->D2FK->EditValue ?>"<?php echo $rekening2->D2FK->EditAttributes() ?>>
</span><?php echo $rekening2->D2FK->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->SaldoAwal->Visible) { // SaldoAwal ?>
	<tr id="r_SaldoAwal"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->SaldoAwal->FldCaption() ?></td>
		<td<?php echo $rekening2->SaldoAwal->CellAttributes() ?>><span id="el_SaldoAwal">
<input type="text" name="x_SaldoAwal" id="x_SaldoAwal" size="30" value="<?php echo $rekening2->SaldoAwal->EditValue ?>"<?php echo $rekening2->SaldoAwal->EditAttributes() ?>>
</span><?php echo $rekening2->SaldoAwal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->Saldo->Visible) { // Saldo ?>
	<tr id="r_Saldo"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->Saldo->FldCaption() ?></td>
		<td<?php echo $rekening2->Saldo->CellAttributes() ?>><span id="el_Saldo">
<input type="text" name="x_Saldo" id="x_Saldo" size="30" value="<?php echo $rekening2->Saldo->EditValue ?>"<?php echo $rekening2->Saldo->EditAttributes() ?>>
</span><?php echo $rekening2->Saldo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->TanggalSaldo->Visible) { // TanggalSaldo ?>
	<tr id="r_TanggalSaldo"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->TanggalSaldo->FldCaption() ?></td>
		<td<?php echo $rekening2->TanggalSaldo->CellAttributes() ?>><span id="el_TanggalSaldo">
<input type="text" name="x_TanggalSaldo" id="x_TanggalSaldo" value="<?php echo $rekening2->TanggalSaldo->EditValue ?>"<?php echo $rekening2->TanggalSaldo->EditAttributes() ?>>
</span><?php echo $rekening2->TanggalSaldo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->target->Visible) { // target ?>
	<tr id="r_target"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->target->FldCaption() ?></td>
		<td<?php echo $rekening2->target->CellAttributes() ?>><span id="el_target">
<input type="text" name="x_target" id="x_target" size="30" value="<?php echo $rekening2->target->EditValue ?>"<?php echo $rekening2->target->EditAttributes() ?>>
</span><?php echo $rekening2->target->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->debet_kali->Visible) { // debet_kali ?>
	<tr id="r_debet_kali"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->debet_kali->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->debet_kali->CellAttributes() ?>><span id="el_debet_kali">
<input type="text" name="x_debet_kali" id="x_debet_kali" size="30" value="<?php echo $rekening2->debet_kali->EditValue ?>"<?php echo $rekening2->debet_kali->EditAttributes() ?>>
</span><?php echo $rekening2->debet_kali->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rekening2->kredit_kali->Visible) { // kredit_kali ?>
	<tr id="r_kredit_kali"<?php echo $rekening2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $rekening2->kredit_kali->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $rekening2->kredit_kali->CellAttributes() ?>><span id="el_kredit_kali">
<input type="text" name="x_kredit_kali" id="x_kredit_kali" size="30" value="<?php echo $rekening2->kredit_kali->EditValue ?>"<?php echo $rekening2->kredit_kali->EditAttributes() ?>>
</span><?php echo $rekening2->kredit_kali->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$rekening2_add->ShowPageFooter();
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
$rekening2_add->Page_Terminate();
?>
<?php

//
// Page class
//
class crekening2_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'rekening2';

	// Page object name
	var $PageObjName = 'rekening2_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rekening2;
		if ($rekening2->UseTokenInUrl) $PageUrl .= "t=" . $rekening2->TableVar . "&"; // Add page token
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
		global $objForm, $rekening2;
		if ($rekening2->UseTokenInUrl) {
			if ($objForm)
				return ($rekening2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rekening2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crekening2_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (rekening2)
		if (!isset($GLOBALS["rekening2"])) {
			$GLOBALS["rekening2"] = new crekening2();
			$GLOBALS["Table"] =& $GLOBALS["rekening2"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rekening2', TRUE);

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
		global $rekening2;

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
			$this->Page_Terminate("rekening2list.php");
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
		global $objForm, $Language, $gsFormError, $rekening2;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$rekening2->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$rekening2->CurrentAction = "I"; // Form error, reset action
				$rekening2->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$rekening2->id->setQueryStringValue($_GET["id"]);
				$rekening2->setKey("id", $rekening2->id->CurrentValue); // Set up key
			} else {
				$rekening2->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$rekening2->CurrentAction = "C"; // Copy record
			} else {
				$rekening2->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($rekening2->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("rekening2list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$rekening2->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $rekening2->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rekening2view.php")
						$sReturnUrl = $rekening2->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$rekening2->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$rekening2->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$rekening2->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $rekening2;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $rekening2;
		$rekening2->kodePokok->CurrentValue = NULL;
		$rekening2->kodePokok->OldValue = $rekening2->kodePokok->CurrentValue;
		$rekening2->kodeSubSatu->CurrentValue = NULL;
		$rekening2->kodeSubSatu->OldValue = $rekening2->kodeSubSatu->CurrentValue;
		$rekening2->kodeSubDua->CurrentValue = NULL;
		$rekening2->kodeSubDua->OldValue = $rekening2->kodeSubDua->CurrentValue;
		$rekening2->kodeSubTiga->CurrentValue = NULL;
		$rekening2->kodeSubTiga->OldValue = $rekening2->kodeSubTiga->CurrentValue;
		$rekening2->Norek->CurrentValue = NULL;
		$rekening2->Norek->OldValue = $rekening2->Norek->CurrentValue;
		$rekening2->Keterangan->CurrentValue = NULL;
		$rekening2->Keterangan->OldValue = $rekening2->Keterangan->CurrentValue;
		$rekening2->D2FK->CurrentValue = NULL;
		$rekening2->D2FK->OldValue = $rekening2->D2FK->CurrentValue;
		$rekening2->SaldoAwal->CurrentValue = 0;
		$rekening2->Saldo->CurrentValue = 0;
		$rekening2->TanggalSaldo->CurrentValue = "1970-01-01 00:00:00";
		$rekening2->target->CurrentValue = 0;
		$rekening2->debet_kali->CurrentValue = 0;
		$rekening2->kredit_kali->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $rekening2;
		if (!$rekening2->kodePokok->FldIsDetailKey) {
			$rekening2->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
		if (!$rekening2->kodeSubSatu->FldIsDetailKey) {
			$rekening2->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
		if (!$rekening2->kodeSubDua->FldIsDetailKey) {
			$rekening2->kodeSubDua->setFormValue($objForm->GetValue("x_kodeSubDua"));
		}
		if (!$rekening2->kodeSubTiga->FldIsDetailKey) {
			$rekening2->kodeSubTiga->setFormValue($objForm->GetValue("x_kodeSubTiga"));
		}
		if (!$rekening2->Norek->FldIsDetailKey) {
			$rekening2->Norek->setFormValue($objForm->GetValue("x_Norek"));
		}
		if (!$rekening2->Keterangan->FldIsDetailKey) {
			$rekening2->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$rekening2->D2FK->FldIsDetailKey) {
			$rekening2->D2FK->setFormValue($objForm->GetValue("x_D2FK"));
		}
		if (!$rekening2->SaldoAwal->FldIsDetailKey) {
			$rekening2->SaldoAwal->setFormValue($objForm->GetValue("x_SaldoAwal"));
		}
		if (!$rekening2->Saldo->FldIsDetailKey) {
			$rekening2->Saldo->setFormValue($objForm->GetValue("x_Saldo"));
		}
		if (!$rekening2->TanggalSaldo->FldIsDetailKey) {
			$rekening2->TanggalSaldo->setFormValue($objForm->GetValue("x_TanggalSaldo"));
			$rekening2->TanggalSaldo->CurrentValue = ew_UnFormatDateTime($rekening2->TanggalSaldo->CurrentValue, 7);
		}
		if (!$rekening2->target->FldIsDetailKey) {
			$rekening2->target->setFormValue($objForm->GetValue("x_target"));
		}
		if (!$rekening2->debet_kali->FldIsDetailKey) {
			$rekening2->debet_kali->setFormValue($objForm->GetValue("x_debet_kali"));
		}
		if (!$rekening2->kredit_kali->FldIsDetailKey) {
			$rekening2->kredit_kali->setFormValue($objForm->GetValue("x_kredit_kali"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $rekening2;
		$this->LoadOldRecord();
		$rekening2->kodePokok->CurrentValue = $rekening2->kodePokok->FormValue;
		$rekening2->kodeSubSatu->CurrentValue = $rekening2->kodeSubSatu->FormValue;
		$rekening2->kodeSubDua->CurrentValue = $rekening2->kodeSubDua->FormValue;
		$rekening2->kodeSubTiga->CurrentValue = $rekening2->kodeSubTiga->FormValue;
		$rekening2->Norek->CurrentValue = $rekening2->Norek->FormValue;
		$rekening2->Keterangan->CurrentValue = $rekening2->Keterangan->FormValue;
		$rekening2->D2FK->CurrentValue = $rekening2->D2FK->FormValue;
		$rekening2->SaldoAwal->CurrentValue = $rekening2->SaldoAwal->FormValue;
		$rekening2->Saldo->CurrentValue = $rekening2->Saldo->FormValue;
		$rekening2->TanggalSaldo->CurrentValue = $rekening2->TanggalSaldo->FormValue;
		$rekening2->TanggalSaldo->CurrentValue = ew_UnFormatDateTime($rekening2->TanggalSaldo->CurrentValue, 7);
		$rekening2->target->CurrentValue = $rekening2->target->FormValue;
		$rekening2->debet_kali->CurrentValue = $rekening2->debet_kali->FormValue;
		$rekening2->kredit_kali->CurrentValue = $rekening2->kredit_kali->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rekening2;
		$sFilter = $rekening2->KeyFilter();

		// Call Row Selecting event
		$rekening2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rekening2->CurrentFilter = $sFilter;
		$sSql = $rekening2->SQL();
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
		global $conn, $rekening2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$rekening2->Row_Selected($row);
		$rekening2->kodePokok->setDbValue($rs->fields('kodePokok'));
		$rekening2->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$rekening2->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$rekening2->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$rekening2->Norek->setDbValue($rs->fields('Norek'));
		$rekening2->Keterangan->setDbValue($rs->fields('Keterangan'));
		$rekening2->D2FK->setDbValue($rs->fields('D/K'));
		$rekening2->SaldoAwal->setDbValue($rs->fields('SaldoAwal'));
		$rekening2->Saldo->setDbValue($rs->fields('Saldo'));
		$rekening2->TanggalSaldo->setDbValue($rs->fields('TanggalSaldo'));
		$rekening2->target->setDbValue($rs->fields('target'));
		$rekening2->id->setDbValue($rs->fields('id'));
		$rekening2->debet_kali->setDbValue($rs->fields('debet_kali'));
		$rekening2->kredit_kali->setDbValue($rs->fields('kredit_kali'));
	}

	// Load old record
	function LoadOldRecord() {
		global $rekening2;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($rekening2->getKey("id")) <> "")
			$rekening2->id->CurrentValue = $rekening2->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$rekening2->CurrentFilter = $rekening2->KeyFilter();
			$sSql = $rekening2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rekening2;

		// Initialize URLs
		// Call Row_Rendering event

		$rekening2->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// Norek
		// Keterangan
		// D/K
		// SaldoAwal
		// Saldo
		// TanggalSaldo
		// target
		// id
		// debet_kali
		// kredit_kali

		if ($rekening2->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$rekening2->kodePokok->ViewValue = $rekening2->kodePokok->CurrentValue;
			$rekening2->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->ViewValue = $rekening2->kodeSubSatu->CurrentValue;
			$rekening2->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$rekening2->kodeSubDua->ViewValue = $rekening2->kodeSubDua->CurrentValue;
			$rekening2->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->ViewValue = $rekening2->kodeSubTiga->CurrentValue;
			$rekening2->kodeSubTiga->ViewCustomAttributes = "";

			// Norek
			$rekening2->Norek->ViewValue = $rekening2->Norek->CurrentValue;
			$rekening2->Norek->ViewCustomAttributes = "";

			// Keterangan
			$rekening2->Keterangan->ViewValue = $rekening2->Keterangan->CurrentValue;
			$rekening2->Keterangan->ViewCustomAttributes = "";

			// D/K
			$rekening2->D2FK->ViewValue = $rekening2->D2FK->CurrentValue;
			$rekening2->D2FK->ViewCustomAttributes = "";

			// SaldoAwal
			$rekening2->SaldoAwal->ViewValue = $rekening2->SaldoAwal->CurrentValue;
			$rekening2->SaldoAwal->ViewCustomAttributes = "";

			// Saldo
			$rekening2->Saldo->ViewValue = $rekening2->Saldo->CurrentValue;
			$rekening2->Saldo->ViewCustomAttributes = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->ViewValue = $rekening2->TanggalSaldo->CurrentValue;
			$rekening2->TanggalSaldo->ViewValue = ew_FormatDateTime($rekening2->TanggalSaldo->ViewValue, 7);
			$rekening2->TanggalSaldo->ViewCustomAttributes = "";

			// target
			$rekening2->target->ViewValue = $rekening2->target->CurrentValue;
			$rekening2->target->ViewCustomAttributes = "";

			// id
			$rekening2->id->ViewValue = $rekening2->id->CurrentValue;
			$rekening2->id->ViewCustomAttributes = "";

			// debet_kali
			$rekening2->debet_kali->ViewValue = $rekening2->debet_kali->CurrentValue;
			$rekening2->debet_kali->ViewCustomAttributes = "";

			// kredit_kali
			$rekening2->kredit_kali->ViewValue = $rekening2->kredit_kali->CurrentValue;
			$rekening2->kredit_kali->ViewCustomAttributes = "";

			// kodePokok
			$rekening2->kodePokok->LinkCustomAttributes = "";
			$rekening2->kodePokok->HrefValue = "";
			$rekening2->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->LinkCustomAttributes = "";
			$rekening2->kodeSubSatu->HrefValue = "";
			$rekening2->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$rekening2->kodeSubDua->LinkCustomAttributes = "";
			$rekening2->kodeSubDua->HrefValue = "";
			$rekening2->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->LinkCustomAttributes = "";
			$rekening2->kodeSubTiga->HrefValue = "";
			$rekening2->kodeSubTiga->TooltipValue = "";

			// Norek
			$rekening2->Norek->LinkCustomAttributes = "";
			$rekening2->Norek->HrefValue = "";
			$rekening2->Norek->TooltipValue = "";

			// Keterangan
			$rekening2->Keterangan->LinkCustomAttributes = "";
			$rekening2->Keterangan->HrefValue = "";
			$rekening2->Keterangan->TooltipValue = "";

			// D/K
			$rekening2->D2FK->LinkCustomAttributes = "";
			$rekening2->D2FK->HrefValue = "";
			$rekening2->D2FK->TooltipValue = "";

			// SaldoAwal
			$rekening2->SaldoAwal->LinkCustomAttributes = "";
			$rekening2->SaldoAwal->HrefValue = "";
			$rekening2->SaldoAwal->TooltipValue = "";

			// Saldo
			$rekening2->Saldo->LinkCustomAttributes = "";
			$rekening2->Saldo->HrefValue = "";
			$rekening2->Saldo->TooltipValue = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->LinkCustomAttributes = "";
			$rekening2->TanggalSaldo->HrefValue = "";
			$rekening2->TanggalSaldo->TooltipValue = "";

			// target
			$rekening2->target->LinkCustomAttributes = "";
			$rekening2->target->HrefValue = "";
			$rekening2->target->TooltipValue = "";

			// debet_kali
			$rekening2->debet_kali->LinkCustomAttributes = "";
			$rekening2->debet_kali->HrefValue = "";
			$rekening2->debet_kali->TooltipValue = "";

			// kredit_kali
			$rekening2->kredit_kali->LinkCustomAttributes = "";
			$rekening2->kredit_kali->HrefValue = "";
			$rekening2->kredit_kali->TooltipValue = "";
		} elseif ($rekening2->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodePokok
			$rekening2->kodePokok->EditCustomAttributes = "";
			$rekening2->kodePokok->EditValue = ew_HtmlEncode($rekening2->kodePokok->CurrentValue);

			// kodeSubSatu
			$rekening2->kodeSubSatu->EditCustomAttributes = "";
			$rekening2->kodeSubSatu->EditValue = ew_HtmlEncode($rekening2->kodeSubSatu->CurrentValue);

			// kodeSubDua
			$rekening2->kodeSubDua->EditCustomAttributes = "";
			$rekening2->kodeSubDua->EditValue = ew_HtmlEncode($rekening2->kodeSubDua->CurrentValue);

			// kodeSubTiga
			$rekening2->kodeSubTiga->EditCustomAttributes = "";
			$rekening2->kodeSubTiga->EditValue = ew_HtmlEncode($rekening2->kodeSubTiga->CurrentValue);

			// Norek
			$rekening2->Norek->EditCustomAttributes = "";
			$rekening2->Norek->EditValue = ew_HtmlEncode($rekening2->Norek->CurrentValue);

			// Keterangan
			$rekening2->Keterangan->EditCustomAttributes = "";
			$rekening2->Keterangan->EditValue = ew_HtmlEncode($rekening2->Keterangan->CurrentValue);

			// D/K
			$rekening2->D2FK->EditCustomAttributes = "";
			$rekening2->D2FK->EditValue = ew_HtmlEncode($rekening2->D2FK->CurrentValue);

			// SaldoAwal
			$rekening2->SaldoAwal->EditCustomAttributes = "";
			$rekening2->SaldoAwal->EditValue = ew_HtmlEncode($rekening2->SaldoAwal->CurrentValue);

			// Saldo
			$rekening2->Saldo->EditCustomAttributes = "";
			$rekening2->Saldo->EditValue = ew_HtmlEncode($rekening2->Saldo->CurrentValue);

			// TanggalSaldo
			$rekening2->TanggalSaldo->EditCustomAttributes = "";
			$rekening2->TanggalSaldo->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekening2->TanggalSaldo->CurrentValue, 7));

			// target
			$rekening2->target->EditCustomAttributes = "";
			$rekening2->target->EditValue = ew_HtmlEncode($rekening2->target->CurrentValue);

			// debet_kali
			$rekening2->debet_kali->EditCustomAttributes = "";
			$rekening2->debet_kali->EditValue = ew_HtmlEncode($rekening2->debet_kali->CurrentValue);

			// kredit_kali
			$rekening2->kredit_kali->EditCustomAttributes = "";
			$rekening2->kredit_kali->EditValue = ew_HtmlEncode($rekening2->kredit_kali->CurrentValue);

			// Edit refer script
			// kodePokok

			$rekening2->kodePokok->HrefValue = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->HrefValue = "";

			// kodeSubDua
			$rekening2->kodeSubDua->HrefValue = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->HrefValue = "";

			// Norek
			$rekening2->Norek->HrefValue = "";

			// Keterangan
			$rekening2->Keterangan->HrefValue = "";

			// D/K
			$rekening2->D2FK->HrefValue = "";

			// SaldoAwal
			$rekening2->SaldoAwal->HrefValue = "";

			// Saldo
			$rekening2->Saldo->HrefValue = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->HrefValue = "";

			// target
			$rekening2->target->HrefValue = "";

			// debet_kali
			$rekening2->debet_kali->HrefValue = "";

			// kredit_kali
			$rekening2->kredit_kali->HrefValue = "";
		}
		if ($rekening2->RowType == EW_ROWTYPE_ADD ||
			$rekening2->RowType == EW_ROWTYPE_EDIT ||
			$rekening2->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$rekening2->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($rekening2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rekening2->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $rekening2;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($rekening2->kodePokok->FormValue) && $rekening2->kodePokok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->kodePokok->FldCaption());
		}
		if (!is_null($rekening2->kodeSubSatu->FormValue) && $rekening2->kodeSubSatu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->kodeSubSatu->FldCaption());
		}
		if (!is_null($rekening2->kodeSubDua->FormValue) && $rekening2->kodeSubDua->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->kodeSubDua->FldCaption());
		}
		if (!is_null($rekening2->kodeSubTiga->FormValue) && $rekening2->kodeSubTiga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->kodeSubTiga->FldCaption());
		}
		if (!is_null($rekening2->Norek->FormValue) && $rekening2->Norek->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->Norek->FldCaption());
		}
		if (!is_null($rekening2->Keterangan->FormValue) && $rekening2->Keterangan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->Keterangan->FldCaption());
		}
		if (!is_null($rekening2->D2FK->FormValue) && $rekening2->D2FK->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->D2FK->FldCaption());
		}
		if (!ew_CheckNumber($rekening2->SaldoAwal->FormValue)) {
			ew_AddMessage($gsFormError, $rekening2->SaldoAwal->FldErrMsg());
		}
		if (!ew_CheckNumber($rekening2->Saldo->FormValue)) {
			ew_AddMessage($gsFormError, $rekening2->Saldo->FldErrMsg());
		}
		if (!ew_CheckEuroDate($rekening2->TanggalSaldo->FormValue)) {
			ew_AddMessage($gsFormError, $rekening2->TanggalSaldo->FldErrMsg());
		}
		if (!ew_CheckNumber($rekening2->target->FormValue)) {
			ew_AddMessage($gsFormError, $rekening2->target->FldErrMsg());
		}
		if (!is_null($rekening2->debet_kali->FormValue) && $rekening2->debet_kali->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->debet_kali->FldCaption());
		}
		if (!ew_CheckInteger($rekening2->debet_kali->FormValue)) {
			ew_AddMessage($gsFormError, $rekening2->debet_kali->FldErrMsg());
		}
		if (!is_null($rekening2->kredit_kali->FormValue) && $rekening2->kredit_kali->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekening2->kredit_kali->FldCaption());
		}
		if (!ew_CheckInteger($rekening2->kredit_kali->FormValue)) {
			ew_AddMessage($gsFormError, $rekening2->kredit_kali->FldErrMsg());
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
		global $conn, $Language, $Security, $rekening2;
		if ($rekening2->Norek->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Norek = '" . ew_AdjustSql($rekening2->Norek->CurrentValue) . "')";
			$rsChk = $rekening2->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'Norek', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $rekening2->Norek->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// kodePokok
		$rekening2->kodePokok->SetDbValueDef($rsnew, $rekening2->kodePokok->CurrentValue, "", FALSE);

		// kodeSubSatu
		$rekening2->kodeSubSatu->SetDbValueDef($rsnew, $rekening2->kodeSubSatu->CurrentValue, "", FALSE);

		// kodeSubDua
		$rekening2->kodeSubDua->SetDbValueDef($rsnew, $rekening2->kodeSubDua->CurrentValue, "", FALSE);

		// kodeSubTiga
		$rekening2->kodeSubTiga->SetDbValueDef($rsnew, $rekening2->kodeSubTiga->CurrentValue, "", FALSE);

		// Norek
		$rekening2->Norek->SetDbValueDef($rsnew, $rekening2->Norek->CurrentValue, "", FALSE);

		// Keterangan
		$rekening2->Keterangan->SetDbValueDef($rsnew, $rekening2->Keterangan->CurrentValue, "", FALSE);

		// D/K
		$rekening2->D2FK->SetDbValueDef($rsnew, $rekening2->D2FK->CurrentValue, "", FALSE);

		// SaldoAwal
		$rekening2->SaldoAwal->SetDbValueDef($rsnew, $rekening2->SaldoAwal->CurrentValue, 0, strval($rekening2->SaldoAwal->CurrentValue) == "");

		// Saldo
		$rekening2->Saldo->SetDbValueDef($rsnew, $rekening2->Saldo->CurrentValue, 0, strval($rekening2->Saldo->CurrentValue) == "");

		// TanggalSaldo
		$rekening2->TanggalSaldo->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekening2->TanggalSaldo->CurrentValue, 7), ew_CurrentDate(), strval($rekening2->TanggalSaldo->CurrentValue) == "");

		// target
		$rekening2->target->SetDbValueDef($rsnew, $rekening2->target->CurrentValue, 0, strval($rekening2->target->CurrentValue) == "");

		// debet_kali
		$rekening2->debet_kali->SetDbValueDef($rsnew, $rekening2->debet_kali->CurrentValue, 0, strval($rekening2->debet_kali->CurrentValue) == "");

		// kredit_kali
		$rekening2->kredit_kali->SetDbValueDef($rsnew, $rekening2->kredit_kali->CurrentValue, 0, strval($rekening2->kredit_kali->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $rekening2->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($rekening2->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($rekening2->CancelMessage <> "") {
				$this->setFailureMessage($rekening2->CancelMessage);
				$rekening2->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$rekening2->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $rekening2->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$rekening2->Row_Inserted($rs, $rsnew);
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
