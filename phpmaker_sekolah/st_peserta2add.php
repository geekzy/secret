<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_peserta2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "st_master_kelas_kelompokinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_peserta2_add = new cst_peserta2_add();
$Page =& $st_peserta2_add;

// Page init
$st_peserta2_add->Page_Init();

// Page main
$st_peserta2_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_peserta2_add = new ew_Page("st_peserta2_add");

// page properties
st_peserta2_add.PageID = "add"; // page ID
st_peserta2_add.FormID = "fst_peserta2add"; // form ID
var EW_PAGE_ID = st_peserta2_add.PageID; // for backward compatibility

// extend page with ValidateForm function
st_peserta2_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_identitas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_peserta2->identitas->FldCaption()) ?>");

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
st_peserta2_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_peserta2_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_peserta2_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $st_peserta2->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_peserta2->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_peserta2_add->ShowPageHeader(); ?>
<?php
$st_peserta2_add->ShowMessage();
?>
<form name="fst_peserta2add" id="fst_peserta2add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return st_peserta2_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="st_peserta2">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($st_peserta2->identitas->Visible) { // identitas ?>
	<tr id="r_identitas"<?php echo $st_peserta2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_peserta2->identitas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_peserta2->identitas->CellAttributes() ?>><span id="el_identitas">
<select id="x_identitas" name="x_identitas"<?php echo $st_peserta2->identitas->EditAttributes() ?>>
<?php
if (is_array($st_peserta2->identitas->EditValue)) {
	$arwrk = $st_peserta2->identitas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_peserta2->identitas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$st_peserta2->identitas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $st_peserta2->identitas->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta2->kode_otomatis->CurrentValue) ?>">
<?php if ($st_peserta2->kode_otomatis_kelompok->getSessionValue() <> "") { ?>
<input type="hidden" id="x_kode_otomatis_kelompok" name="x_kode_otomatis_kelompok" value="<?php echo ew_HtmlEncode($st_peserta2->kode_otomatis_kelompok->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_kode_otomatis_kelompok" id="x_kode_otomatis_kelompok" size="30" maxlength="50" value="<?php echo $st_peserta2->kode_otomatis_kelompok->EditValue ?>"<?php echo $st_peserta2->kode_otomatis_kelompok->EditAttributes() ?>>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$st_peserta2_add->ShowPageFooter();
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
$st_peserta2_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_peserta2_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'st_peserta2';

	// Page object name
	var $PageObjName = 'st_peserta2_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_peserta2;
		if ($st_peserta2->UseTokenInUrl) $PageUrl .= "t=" . $st_peserta2->TableVar . "&"; // Add page token
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
		global $objForm, $st_peserta2;
		if ($st_peserta2->UseTokenInUrl) {
			if ($objForm)
				return ($st_peserta2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_peserta2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_peserta2_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_peserta2)
		if (!isset($GLOBALS["st_peserta2"])) {
			$GLOBALS["st_peserta2"] = new cst_peserta2();
			$GLOBALS["Table"] =& $GLOBALS["st_peserta2"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (st_master_kelas_kelompok)
		if (!isset($GLOBALS['st_master_kelas_kelompok'])) $GLOBALS['st_master_kelas_kelompok'] = new cst_master_kelas_kelompok();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_peserta2', TRUE);

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
		global $st_peserta2;

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
			$this->Page_Terminate("st_peserta2list.php");
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
		global $objForm, $Language, $gsFormError, $st_peserta2;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$st_peserta2->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$st_peserta2->CurrentAction = "I"; // Form error, reset action
				$st_peserta2->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["kode_otomatis"] != "") {
				$st_peserta2->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$st_peserta2->setKey("kode_otomatis", $st_peserta2->kode_otomatis->CurrentValue); // Set up key
			} else {
				$st_peserta2->setKey("kode_otomatis", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$st_peserta2->CurrentAction = "C"; // Copy record
			} else {
				$st_peserta2->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($st_peserta2->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("st_peserta2list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$st_peserta2->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = "st_peserta2list.php";
					if (ew_GetPageName($sReturnUrl) == "st_peserta2view.php")
						$sReturnUrl = $st_peserta2->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$st_peserta2->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$st_peserta2->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$st_peserta2->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $st_peserta2;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_peserta2;
		$st_peserta2->identitas->CurrentValue = NULL;
		$st_peserta2->identitas->OldValue = $st_peserta2->identitas->CurrentValue;
		$st_peserta2->kode_otomatis->CurrentValue = unik();
		$st_peserta2->kode_otomatis_kelompok->CurrentValue = NULL;
		$st_peserta2->kode_otomatis_kelompok->OldValue = $st_peserta2->kode_otomatis_kelompok->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_peserta2;
		if (!$st_peserta2->identitas->FldIsDetailKey) {
			$st_peserta2->identitas->setFormValue($objForm->GetValue("x_identitas"));
		}
		if (!$st_peserta2->kode_otomatis->FldIsDetailKey) {
			$st_peserta2->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$st_peserta2->kode_otomatis_kelompok->FldIsDetailKey) {
			$st_peserta2->kode_otomatis_kelompok->setFormValue($objForm->GetValue("x_kode_otomatis_kelompok"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_peserta2;
		$this->LoadOldRecord();
		$st_peserta2->identitas->CurrentValue = $st_peserta2->identitas->FormValue;
		$st_peserta2->kode_otomatis->CurrentValue = $st_peserta2->kode_otomatis->FormValue;
		$st_peserta2->kode_otomatis_kelompok->CurrentValue = $st_peserta2->kode_otomatis_kelompok->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_peserta2;
		$sFilter = $st_peserta2->KeyFilter();

		// Call Row Selecting event
		$st_peserta2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_peserta2->CurrentFilter = $sFilter;
		$sSql = $st_peserta2->SQL();
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
		global $conn, $st_peserta2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_peserta2->Row_Selected($row);
		$st_peserta2->identitas->setDbValue($rs->fields('identitas'));
		$st_peserta2->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
		$st_peserta2->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$st_peserta2->kode_otomatis_kelompok->setDbValue($rs->fields('kode_otomatis_kelompok'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_peserta2;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_peserta2->getKey("kode_otomatis")) <> "")
			$st_peserta2->kode_otomatis->CurrentValue = $st_peserta2->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_peserta2->CurrentFilter = $st_peserta2->KeyFilter();
			$sSql = $st_peserta2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_peserta2;

		// Initialize URLs
		// Call Row_Rendering event

		$st_peserta2->Row_Rendering();

		// Common render codes for all row types
		// identitas
		// A_nama_Lengkap
		// kode_otomatis
		// kode_otomatis_kelompok

		if ($st_peserta2->RowType == EW_ROWTYPE_VIEW) { // View row

			// identitas
			if (strval($st_peserta2->identitas->CurrentValue) <> "") {
				$sFilterWrk = "`A_nis_nasional` = '" . ew_AdjustSql($st_peserta2->identitas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `A_nis_nasional`, `A_nama_Lengkap` FROM `master_siswa`";
			$sWhereWrk = "";
			$lookuptblfilter = " D_saat_ini_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' "  . " AND apakah_valid='y' " . " AND NOT EXISTS (SELECT identitas,apakah_valid FROM st_peserta_kelas_kelompok,st_master_kelas_kelompok WHERE st_peserta_kelas_kelompok.kode_otomatis_kelompok=st_master_kelas_kelompok.kode_otomatis AND apakah_valid='y' AND kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND A_nis_nasional=identitas "  . ") ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$st_peserta2->identitas->ViewValue = $rswrk->fields('A_nis_nasional');
					$st_peserta2->identitas->ViewValue .= ew_ValueSeparator(0,1,$st_peserta2->identitas) . $rswrk->fields('A_nama_Lengkap');
					$rswrk->Close();
				} else {
					$st_peserta2->identitas->ViewValue = $st_peserta2->identitas->CurrentValue;
				}
			} else {
				$st_peserta2->identitas->ViewValue = NULL;
			}
			$st_peserta2->identitas->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->ViewValue = $st_peserta2->A_nama_Lengkap->CurrentValue;
			$st_peserta2->A_nama_Lengkap->ViewCustomAttributes = "";

			// kode_otomatis
			$st_peserta2->kode_otomatis->ViewValue = $st_peserta2->kode_otomatis->CurrentValue;
			$st_peserta2->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_kelompok
			$st_peserta2->kode_otomatis_kelompok->ViewValue = $st_peserta2->kode_otomatis_kelompok->CurrentValue;
			$st_peserta2->kode_otomatis_kelompok->ViewCustomAttributes = "";

			// identitas
			$st_peserta2->identitas->LinkCustomAttributes = "";
			$st_peserta2->identitas->HrefValue = "";
			$st_peserta2->identitas->TooltipValue = "";

			// kode_otomatis
			$st_peserta2->kode_otomatis->LinkCustomAttributes = "";
			$st_peserta2->kode_otomatis->HrefValue = "";
			$st_peserta2->kode_otomatis->TooltipValue = "";

			// kode_otomatis_kelompok
			$st_peserta2->kode_otomatis_kelompok->LinkCustomAttributes = "";
			$st_peserta2->kode_otomatis_kelompok->HrefValue = "";
			$st_peserta2->kode_otomatis_kelompok->TooltipValue = "";
		} elseif ($st_peserta2->RowType == EW_ROWTYPE_ADD) { // Add row

			// identitas
			$st_peserta2->identitas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `A_nis_nasional`, `A_nis_nasional` AS `DispFld`, `A_nama_Lengkap` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_siswa`";
			$sWhereWrk = "";
			$lookuptblfilter = " D_saat_ini_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' "  . " AND apakah_valid='y' " . " AND NOT EXISTS (SELECT identitas,apakah_valid FROM st_peserta_kelas_kelompok,st_master_kelas_kelompok WHERE st_peserta_kelas_kelompok.kode_otomatis_kelompok=st_master_kelas_kelompok.kode_otomatis AND apakah_valid='y' AND kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND A_nis_nasional=identitas "  . ") ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$st_peserta2->identitas->EditValue = $arwrk;

			// kode_otomatis
			$st_peserta2->kode_otomatis->EditCustomAttributes = "";
			$st_peserta2->kode_otomatis->CurrentValue = unik();

			// kode_otomatis_kelompok
			$st_peserta2->kode_otomatis_kelompok->EditCustomAttributes = "";
			if ($st_peserta2->kode_otomatis_kelompok->getSessionValue() <> "") {
				$st_peserta2->kode_otomatis_kelompok->CurrentValue = $st_peserta2->kode_otomatis_kelompok->getSessionValue();
			$st_peserta2->kode_otomatis_kelompok->ViewValue = $st_peserta2->kode_otomatis_kelompok->CurrentValue;
			$st_peserta2->kode_otomatis_kelompok->ViewCustomAttributes = "";
			} else {
			$st_peserta2->kode_otomatis_kelompok->EditValue = ew_HtmlEncode($st_peserta2->kode_otomatis_kelompok->CurrentValue);
			}

			// Edit refer script
			// identitas

			$st_peserta2->identitas->HrefValue = "";

			// kode_otomatis
			$st_peserta2->kode_otomatis->HrefValue = "";

			// kode_otomatis_kelompok
			$st_peserta2->kode_otomatis_kelompok->HrefValue = "";
		}
		if ($st_peserta2->RowType == EW_ROWTYPE_ADD ||
			$st_peserta2->RowType == EW_ROWTYPE_EDIT ||
			$st_peserta2->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_peserta2->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_peserta2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_peserta2->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_peserta2;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_peserta2->identitas->FormValue) && $st_peserta2->identitas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_peserta2->identitas->FldCaption());
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
		global $conn, $Language, $Security, $st_peserta2;

		// Check if key value entered
		if ($st_peserta2->kode_otomatis->CurrentValue == "" && $st_peserta2->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_peserta2->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_peserta2->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_peserta2->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_peserta2->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_peserta2->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_peserta2->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// identitas
		$st_peserta2->identitas->SetDbValueDef($rsnew, $st_peserta2->identitas->CurrentValue, "", FALSE);

		// kode_otomatis
		$st_peserta2->kode_otomatis->SetDbValueDef($rsnew, $st_peserta2->kode_otomatis->CurrentValue, "", FALSE);

		// kode_otomatis_kelompok
		$st_peserta2->kode_otomatis_kelompok->SetDbValueDef($rsnew, $st_peserta2->kode_otomatis_kelompok->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_peserta2->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_peserta2->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_peserta2->CancelMessage <> "") {
				$this->setFailureMessage($st_peserta2->CancelMessage);
				$st_peserta2->CancelMessage = "";
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
			$st_peserta2->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $st_peserta2;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "st_master_kelas_kelompok") {
				$bValidMaster = TRUE;
				if (@$_GET["kode_otomatis"] <> "") {
					$GLOBALS["st_master_kelas_kelompok"]->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
					$st_peserta2->kode_otomatis_kelompok->setQueryStringValue($GLOBALS["st_master_kelas_kelompok"]->kode_otomatis->QueryStringValue);
					$st_peserta2->kode_otomatis_kelompok->setSessionValue($st_peserta2->kode_otomatis_kelompok->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$st_peserta2->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$st_peserta2->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "st_master_kelas_kelompok") {
				if ($st_peserta2->kode_otomatis_kelompok->QueryStringValue == "") $st_peserta2->kode_otomatis_kelompok->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $st_peserta2->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $st_peserta2->getDetailFilter(); // Get detail filter
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
