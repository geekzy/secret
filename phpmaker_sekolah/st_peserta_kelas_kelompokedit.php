<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_peserta_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_peserta_kelas_kelompok_edit = new cst_peserta_kelas_kelompok_edit();
$Page =& $st_peserta_kelas_kelompok_edit;

// Page init
$st_peserta_kelas_kelompok_edit->Page_Init();

// Page main
$st_peserta_kelas_kelompok_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_peserta_kelas_kelompok_edit = new ew_Page("st_peserta_kelas_kelompok_edit");

// page properties
st_peserta_kelas_kelompok_edit.PageID = "edit"; // page ID
st_peserta_kelas_kelompok_edit.FormID = "fst_peserta_kelas_kelompokedit"; // form ID
var EW_PAGE_ID = st_peserta_kelas_kelompok_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
st_peserta_kelas_kelompok_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_peserta_kelas_kelompok->identitas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_otomatis_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_peserta_kelas_kelompok->kode_otomatis_kelompok->FldCaption()) ?>");

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
st_peserta_kelas_kelompok_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_peserta_kelas_kelompok_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_peserta_kelas_kelompok_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_peserta_kelas_kelompok->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_peserta_kelas_kelompok->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_peserta_kelas_kelompok_edit->ShowPageHeader(); ?>
<?php
$st_peserta_kelas_kelompok_edit->ShowMessage();
?>
<form name="fst_peserta_kelas_kelompokedit" id="fst_peserta_kelas_kelompokedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return st_peserta_kelas_kelompok_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="st_peserta_kelas_kelompok">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
	<tr id="r_identitas"<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_peserta_kelas_kelompok->identitas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_peserta_kelas_kelompok->identitas->CellAttributes() ?>><span id="el_identitas">
<select id="x_identitas" name="x_identitas"<?php echo $st_peserta_kelas_kelompok->identitas->EditAttributes() ?>>
<?php
if (is_array($st_peserta_kelas_kelompok->identitas->EditValue)) {
	$arwrk = $st_peserta_kelas_kelompok->identitas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_peserta_kelas_kelompok->identitas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$st_peserta_kelas_kelompok->identitas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $st_peserta_kelas_kelompok->identitas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->kode_otomatis_kelompok->Visible) { // kode_otomatis_kelompok ?>
	<tr id="r_kode_otomatis_kelompok"<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_peserta_kelas_kelompok->kode_otomatis_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_peserta_kelas_kelompok->kode_otomatis_kelompok->CellAttributes() ?>><span id="el_kode_otomatis_kelompok">
<input type="text" name="x_kode_otomatis_kelompok" id="x_kode_otomatis_kelompok" size="30" maxlength="50" value="<?php echo $st_peserta_kelas_kelompok->kode_otomatis_kelompok->EditValue ?>"<?php echo $st_peserta_kelas_kelompok->kode_otomatis_kelompok->EditAttributes() ?>>
</span><?php echo $st_peserta_kelas_kelompok->kode_otomatis_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$st_peserta_kelas_kelompok_edit->ShowPageFooter();
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
$st_peserta_kelas_kelompok_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_peserta_kelas_kelompok_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'st_peserta_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_peserta_kelas_kelompok_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_peserta_kelas_kelompok;
		if ($st_peserta_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_peserta_kelas_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $st_peserta_kelas_kelompok;
		if ($st_peserta_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_peserta_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_peserta_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_peserta_kelas_kelompok_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_peserta_kelas_kelompok)
		if (!isset($GLOBALS["st_peserta_kelas_kelompok"])) {
			$GLOBALS["st_peserta_kelas_kelompok"] = new cst_peserta_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_peserta_kelas_kelompok"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_peserta_kelas_kelompok', TRUE);

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
		global $st_peserta_kelas_kelompok;

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("st_peserta_kelas_kelompoklist.php");
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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $st_peserta_kelas_kelompok;

		// Load key from QueryString
		if (@$_GET["kode_otomatis"] <> "")
			$st_peserta_kelas_kelompok->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
		if (@$_POST["a_edit"] <> "") {
			$st_peserta_kelas_kelompok->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$st_peserta_kelas_kelompok->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$st_peserta_kelas_kelompok->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$st_peserta_kelas_kelompok->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue == "")
			$this->Page_Terminate("st_peserta_kelas_kelompoklist.php"); // Invalid key, return to list
		switch ($st_peserta_kelas_kelompok->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("st_peserta_kelas_kelompoklist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$st_peserta_kelas_kelompok->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $st_peserta_kelas_kelompok->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$st_peserta_kelas_kelompok->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$st_peserta_kelas_kelompok->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $st_peserta_kelas_kelompok;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_peserta_kelas_kelompok;
		if (!$st_peserta_kelas_kelompok->identitas->FldIsDetailKey) {
			$st_peserta_kelas_kelompok->identitas->setFormValue($objForm->GetValue("x_identitas"));
		}
		if (!$st_peserta_kelas_kelompok->kode_otomatis_kelompok->FldIsDetailKey) {
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->setFormValue($objForm->GetValue("x_kode_otomatis_kelompok"));
		}
		if (!$st_peserta_kelas_kelompok->kode_otomatis->FldIsDetailKey) {
			$st_peserta_kelas_kelompok->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_peserta_kelas_kelompok;
		$this->LoadRow();
		$st_peserta_kelas_kelompok->identitas->CurrentValue = $st_peserta_kelas_kelompok->identitas->FormValue;
		$st_peserta_kelas_kelompok->kode_otomatis_kelompok->CurrentValue = $st_peserta_kelas_kelompok->kode_otomatis_kelompok->FormValue;
		$st_peserta_kelas_kelompok->kode_otomatis->CurrentValue = $st_peserta_kelas_kelompok->kode_otomatis->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_peserta_kelas_kelompok;
		$sFilter = $st_peserta_kelas_kelompok->KeyFilter();

		// Call Row Selecting event
		$st_peserta_kelas_kelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_peserta_kelas_kelompok->CurrentFilter = $sFilter;
		$sSql = $st_peserta_kelas_kelompok->SQL();
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
		global $conn, $st_peserta_kelas_kelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_peserta_kelas_kelompok->Row_Selected($row);
		$st_peserta_kelas_kelompok->identitas->setDbValue($rs->fields('identitas'));
		$st_peserta_kelas_kelompok->kode_otomatis_kelompok->setDbValue($rs->fields('kode_otomatis_kelompok'));
		$st_peserta_kelas_kelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_peserta_kelas_kelompok;

		// Initialize URLs
		// Call Row_Rendering event

		$st_peserta_kelas_kelompok->Row_Rendering();

		// Common render codes for all row types
		// identitas
		// kode_otomatis_kelompok
		// kode_otomatis

		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// identitas
			if (strval($st_peserta_kelas_kelompok->identitas->CurrentValue) <> "") {
				$sFilterWrk = "`A_nis_nasional` = '" . ew_AdjustSql($st_peserta_kelas_kelompok->identitas->CurrentValue) . "'";
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
					$st_peserta_kelas_kelompok->identitas->ViewValue = $rswrk->fields('A_nis_nasional');
					$st_peserta_kelas_kelompok->identitas->ViewValue .= ew_ValueSeparator(0,1,$st_peserta_kelas_kelompok->identitas) . $rswrk->fields('A_nama_Lengkap');
					$rswrk->Close();
				} else {
					$st_peserta_kelas_kelompok->identitas->ViewValue = $st_peserta_kelas_kelompok->identitas->CurrentValue;
				}
			} else {
				$st_peserta_kelas_kelompok->identitas->ViewValue = NULL;
			}
			$st_peserta_kelas_kelompok->identitas->ViewCustomAttributes = "";

			// kode_otomatis_kelompok
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->ViewValue = $st_peserta_kelas_kelompok->kode_otomatis_kelompok->CurrentValue;
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->ViewValue = $st_peserta_kelas_kelompok->kode_otomatis->CurrentValue;
			$st_peserta_kelas_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// identitas
			$st_peserta_kelas_kelompok->identitas->LinkCustomAttributes = "";
			$st_peserta_kelas_kelompok->identitas->HrefValue = "";
			$st_peserta_kelas_kelompok->identitas->TooltipValue = "";

			// kode_otomatis_kelompok
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->LinkCustomAttributes = "";
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->HrefValue = "";
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->TooltipValue = "";

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$st_peserta_kelas_kelompok->kode_otomatis->HrefValue = "";
			$st_peserta_kelas_kelompok->kode_otomatis->TooltipValue = "";
		} elseif ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// identitas
			$st_peserta_kelas_kelompok->identitas->EditCustomAttributes = "";
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
			$st_peserta_kelas_kelompok->identitas->EditValue = $arwrk;

			// kode_otomatis_kelompok
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->EditCustomAttributes = "";
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->EditValue = ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis_kelompok->CurrentValue);

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->EditCustomAttributes = "";

			// Edit refer script
			// identitas

			$st_peserta_kelas_kelompok->identitas->HrefValue = "";

			// kode_otomatis_kelompok
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->HrefValue = "";

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->HrefValue = "";
		}
		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD ||
			$st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT ||
			$st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_peserta_kelas_kelompok->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_peserta_kelas_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_peserta_kelas_kelompok->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_peserta_kelas_kelompok;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_peserta_kelas_kelompok->identitas->FormValue) && $st_peserta_kelas_kelompok->identitas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_peserta_kelas_kelompok->identitas->FldCaption());
		}
		if (!is_null($st_peserta_kelas_kelompok->kode_otomatis_kelompok->FormValue) && $st_peserta_kelas_kelompok->kode_otomatis_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_peserta_kelas_kelompok->kode_otomatis_kelompok->FldCaption());
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $st_peserta_kelas_kelompok;
		$sFilter = $st_peserta_kelas_kelompok->KeyFilter();
		$st_peserta_kelas_kelompok->CurrentFilter = $sFilter;
		$sSql = $st_peserta_kelas_kelompok->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// identitas
			$st_peserta_kelas_kelompok->identitas->SetDbValueDef($rsnew, $st_peserta_kelas_kelompok->identitas->CurrentValue, "", $st_peserta_kelas_kelompok->identitas->ReadOnly);

			// kode_otomatis_kelompok
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->SetDbValueDef($rsnew, $st_peserta_kelas_kelompok->kode_otomatis_kelompok->CurrentValue, "", $st_peserta_kelas_kelompok->kode_otomatis_kelompok->ReadOnly);

			// kode_otomatis
			// Call Row Updating event

			$bUpdateRow = $st_peserta_kelas_kelompok->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($st_peserta_kelas_kelompok->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($st_peserta_kelas_kelompok->CancelMessage <> "") {
					$this->setFailureMessage($st_peserta_kelas_kelompok->CancelMessage);
					$st_peserta_kelas_kelompok->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$st_peserta_kelas_kelompok->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
