<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pemilihan_kelasinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pemilihan_kelas_add = new cpemilihan_kelas_add();
$Page =& $pemilihan_kelas_add;

// Page init
$pemilihan_kelas_add->Page_Init();

// Page main
$pemilihan_kelas_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pemilihan_kelas_add = new ew_Page("pemilihan_kelas_add");

// page properties
pemilihan_kelas_add.PageID = "add"; // page ID
pemilihan_kelas_add.FormID = "fpemilihan_kelasadd"; // form ID
var EW_PAGE_ID = pemilihan_kelas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
pemilihan_kelas_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nama_kelas_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_kelas->nama_kelas_kelompok->FldCaption()) ?>");

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
pemilihan_kelas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pemilihan_kelas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pemilihan_kelas_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $pemilihan_kelas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pemilihan_kelas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pemilihan_kelas_add->ShowPageHeader(); ?>
<?php
$pemilihan_kelas_add->ShowMessage();
?>
<form name="fpemilihan_kelasadd" id="fpemilihan_kelasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pemilihan_kelas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pemilihan_kelas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pemilihan_kelas->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<tr id="r_nama_kelas_kelompok"<?php echo $pemilihan_kelas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_kelas->nama_kelas_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_kelas->nama_kelas_kelompok->CellAttributes() ?>><span id="el_nama_kelas_kelompok">
<select id="x_nama_kelas_kelompok" name="x_nama_kelas_kelompok"<?php echo $pemilihan_kelas->nama_kelas_kelompok->EditAttributes() ?>>
<?php
if (is_array($pemilihan_kelas->nama_kelas_kelompok->EditValue)) {
	$arwrk = $pemilihan_kelas->nama_kelas_kelompok->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_kelas->nama_kelas_kelompok->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $pemilihan_kelas->nama_kelas_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$pemilihan_kelas_add->ShowPageFooter();
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
$pemilihan_kelas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpemilihan_kelas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'pemilihan_kelas';

	// Page object name
	var $PageObjName = 'pemilihan_kelas_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pemilihan_kelas;
		if ($pemilihan_kelas->UseTokenInUrl) $PageUrl .= "t=" . $pemilihan_kelas->TableVar . "&"; // Add page token
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
		global $objForm, $pemilihan_kelas;
		if ($pemilihan_kelas->UseTokenInUrl) {
			if ($objForm)
				return ($pemilihan_kelas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pemilihan_kelas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpemilihan_kelas_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pemilihan_kelas)
		if (!isset($GLOBALS["pemilihan_kelas"])) {
			$GLOBALS["pemilihan_kelas"] = new cpemilihan_kelas();
			$GLOBALS["Table"] =& $GLOBALS["pemilihan_kelas"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pemilihan_kelas', TRUE);

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
		global $pemilihan_kelas;

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
			$this->Page_Terminate("pemilihan_kelaslist.php");
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
		global $objForm, $Language, $gsFormError, $pemilihan_kelas;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$pemilihan_kelas->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pemilihan_kelas->CurrentAction = "I"; // Form error, reset action
				$pemilihan_kelas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["nama_kelas_kelompok"] != "") {
				$pemilihan_kelas->nama_kelas_kelompok->setQueryStringValue($_GET["nama_kelas_kelompok"]);
				$pemilihan_kelas->setKey("nama_kelas_kelompok", $pemilihan_kelas->nama_kelas_kelompok->CurrentValue); // Set up key
			} else {
				$pemilihan_kelas->setKey("nama_kelas_kelompok", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$pemilihan_kelas->CurrentAction = "C"; // Copy record
			} else {
				$pemilihan_kelas->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($pemilihan_kelas->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pemilihan_kelaslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$pemilihan_kelas->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $pemilihan_kelas->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pemilihan_kelasview.php")
						$sReturnUrl = $pemilihan_kelas->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$pemilihan_kelas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$pemilihan_kelas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$pemilihan_kelas->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pemilihan_kelas;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $pemilihan_kelas;
		$pemilihan_kelas->nama_kelas_kelompok->CurrentValue = NULL;
		$pemilihan_kelas->nama_kelas_kelompok->OldValue = $pemilihan_kelas->nama_kelas_kelompok->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pemilihan_kelas;
		if (!$pemilihan_kelas->nama_kelas_kelompok->FldIsDetailKey) {
			$pemilihan_kelas->nama_kelas_kelompok->setFormValue($objForm->GetValue("x_nama_kelas_kelompok"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pemilihan_kelas;
		$this->LoadOldRecord();
		$pemilihan_kelas->nama_kelas_kelompok->CurrentValue = $pemilihan_kelas->nama_kelas_kelompok->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pemilihan_kelas;
		$sFilter = $pemilihan_kelas->KeyFilter();

		// Call Row Selecting event
		$pemilihan_kelas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pemilihan_kelas->CurrentFilter = $sFilter;
		$sSql = $pemilihan_kelas->SQL();
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
		global $conn, $pemilihan_kelas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pemilihan_kelas->Row_Selected($row);
		$pemilihan_kelas->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$pemilihan_kelas->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$pemilihan_kelas->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$pemilihan_kelas->tahun->setDbValue($rs->fields('tahun'));
		$pemilihan_kelas->kelas->setDbValue($rs->fields('kelas'));
		$pemilihan_kelas->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pemilihan_kelas;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pemilihan_kelas->getKey("nama_kelas_kelompok")) <> "")
			$pemilihan_kelas->nama_kelas_kelompok->CurrentValue = $pemilihan_kelas->getKey("nama_kelas_kelompok"); // nama_kelas_kelompok
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pemilihan_kelas->CurrentFilter = $pemilihan_kelas->KeyFilter();
			$sSql = $pemilihan_kelas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pemilihan_kelas;

		// Initialize URLs
		// Call Row_Rendering event

		$pemilihan_kelas->Row_Rendering();

		// Common render codes for all row types
		// nama_kelas_kelompok
		// apakah_valid
		// kode_otomatis_tingkat
		// tahun
		// kelas
		// kode_otomatis

		if ($pemilihan_kelas->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama_kelas_kelompok
			if (strval($pemilihan_kelas->nama_kelas_kelompok->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_kelas->nama_kelas_kelompok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nama_kelas_kelompok` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND apakah_valid='y' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nama_kelas_kelompok` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_kelas->nama_kelas_kelompok->ViewValue = $rswrk->fields('nama_kelas_kelompok');
					$rswrk->Close();
				} else {
					$pemilihan_kelas->nama_kelas_kelompok->ViewValue = $pemilihan_kelas->nama_kelas_kelompok->CurrentValue;
				}
			} else {
				$pemilihan_kelas->nama_kelas_kelompok->ViewValue = NULL;
			}
			$pemilihan_kelas->nama_kelas_kelompok->ViewCustomAttributes = "";

			// apakah_valid
			$pemilihan_kelas->apakah_valid->ViewValue = $pemilihan_kelas->apakah_valid->CurrentValue;
			$pemilihan_kelas->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$pemilihan_kelas->kode_otomatis_tingkat->ViewValue = $pemilihan_kelas->kode_otomatis_tingkat->CurrentValue;
			$pemilihan_kelas->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$pemilihan_kelas->tahun->ViewValue = $pemilihan_kelas->tahun->CurrentValue;
			$pemilihan_kelas->tahun->ViewCustomAttributes = "";

			// kelas
			if (strval($pemilihan_kelas->kelas->CurrentValue) <> "") {
				$sFilterWrk = "`kelas` = '" . ew_AdjustSql($pemilihan_kelas->kelas->CurrentValue) . "'";
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
					$pemilihan_kelas->kelas->ViewValue = $rswrk->fields('kelas');
					$rswrk->Close();
				} else {
					$pemilihan_kelas->kelas->ViewValue = $pemilihan_kelas->kelas->CurrentValue;
				}
			} else {
				$pemilihan_kelas->kelas->ViewValue = NULL;
			}
			$pemilihan_kelas->kelas->ViewCustomAttributes = "";

			// kode_otomatis
			$pemilihan_kelas->kode_otomatis->ViewValue = $pemilihan_kelas->kode_otomatis->CurrentValue;
			$pemilihan_kelas->kode_otomatis->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$pemilihan_kelas->nama_kelas_kelompok->LinkCustomAttributes = "";
			$pemilihan_kelas->nama_kelas_kelompok->HrefValue = "";
			$pemilihan_kelas->nama_kelas_kelompok->TooltipValue = "";
		} elseif ($pemilihan_kelas->RowType == EW_ROWTYPE_ADD) { // Add row

			// nama_kelas_kelompok
			$pemilihan_kelas->nama_kelas_kelompok->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kode_otomatis`, `nama_kelas_kelompok` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND apakah_valid='y' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nama_kelas_kelompok` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pemilihan_kelas->nama_kelas_kelompok->EditValue = $arwrk;

			// Edit refer script
			// nama_kelas_kelompok

			$pemilihan_kelas->nama_kelas_kelompok->HrefValue = "";
		}
		if ($pemilihan_kelas->RowType == EW_ROWTYPE_ADD ||
			$pemilihan_kelas->RowType == EW_ROWTYPE_EDIT ||
			$pemilihan_kelas->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pemilihan_kelas->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pemilihan_kelas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pemilihan_kelas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pemilihan_kelas;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pemilihan_kelas->nama_kelas_kelompok->FormValue) && $pemilihan_kelas->nama_kelas_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_kelas->nama_kelas_kelompok->FldCaption());
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
		global $conn, $Language, $Security, $pemilihan_kelas;

		// Check if key value entered
		if ($pemilihan_kelas->nama_kelas_kelompok->CurrentValue == "" && $pemilihan_kelas->nama_kelas_kelompok->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $pemilihan_kelas->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $pemilihan_kelas->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($pemilihan_kelas->nama_kelas_kelompok->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nama_kelas_kelompok = '" . ew_AdjustSql($pemilihan_kelas->nama_kelas_kelompok->CurrentValue) . "')";
			$rsChk = $pemilihan_kelas->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'nama_kelas_kelompok', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $pemilihan_kelas->nama_kelas_kelompok->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($pemilihan_kelas->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($pemilihan_kelas->kode_otomatis->CurrentValue) . "')";
			$rsChk = $pemilihan_kelas->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $pemilihan_kelas->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// nama_kelas_kelompok
		$pemilihan_kelas->nama_kelas_kelompok->SetDbValueDef($rsnew, $pemilihan_kelas->nama_kelas_kelompok->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $pemilihan_kelas->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pemilihan_kelas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pemilihan_kelas->CancelMessage <> "") {
				$this->setFailureMessage($pemilihan_kelas->CancelMessage);
				$pemilihan_kelas->CancelMessage = "";
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
			$pemilihan_kelas->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
	function Page_Load() {  

		// Bismillaah
		global $Language;    
		$Language->setPhrase("Add","");  
		$Language->setPhrase("GoBack","");  
		$Language->setPhrase("AddBtn","Ketahap2-->Pemilihan Siswa");      
		$judul= "Silahkan Anda Pilih Kelas Kelompok Yang Akan Dientri Pesertanya"  ;          
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
