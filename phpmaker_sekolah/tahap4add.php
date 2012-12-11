<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tahap4info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tahap4_add = new ctahap4_add();
$Page =& $tahap4_add;

// Page init
$tahap4_add->Page_Init();

// Page main
$tahap4_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tahap4_add = new ew_Page("tahap4_add");

// page properties
tahap4_add.PageID = "add"; // page ID
tahap4_add.FormID = "ftahap4add"; // form ID
var EW_PAGE_ID = tahap4_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tahap4_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kodeSubTiga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap4->kodeSubTiga->FldCaption()) ?>");

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
tahap4_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tahap4_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tahap4_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $tahap4->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tahap4->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tahap4_add->ShowPageHeader(); ?>
<?php
$tahap4_add->ShowMessage();
?>
<form name="ftahap4add" id="ftahap4add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tahap4_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tahap4">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tahap4->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<tr id="r_kodeSubTiga"<?php echo $tahap4->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap4->kodeSubTiga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap4->kodeSubTiga->CellAttributes() ?>><span id="el_kodeSubTiga">
<select id="x_kodeSubTiga" name="x_kodeSubTiga"<?php echo $tahap4->kodeSubTiga->EditAttributes() ?>>
<?php
if (is_array($tahap4->kodeSubTiga->EditValue)) {
	$arwrk = $tahap4->kodeSubTiga->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tahap4->kodeSubTiga->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$tahap4->kodeSubTiga) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd("subtigarek")) { ?>
&nbsp;<a name="aol_x_kodeSubTiga" id="aol_x_kodeSubTiga" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:tahap4_add,lnk:'aol_x_kodeSubTiga',el:'x_kodeSubTiga',hdr:this.innerHTML, url:'subtigarekaddopt.php',lf:'x_kodeSubTiga',df:'x_kodeSubTiga',df2:'x_namaSubTiga',df3:'',df4:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $tahap4->kodeSubTiga->FldCaption() ?></a>
<?php } ?>
</span><?php echo $tahap4->kodeSubTiga->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tahap4_add->ShowPageFooter();
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
$tahap4_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctahap4_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tahap4';

	// Page object name
	var $PageObjName = 'tahap4_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tahap4;
		if ($tahap4->UseTokenInUrl) $PageUrl .= "t=" . $tahap4->TableVar . "&"; // Add page token
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
		global $objForm, $tahap4;
		if ($tahap4->UseTokenInUrl) {
			if ($objForm)
				return ($tahap4->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tahap4->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctahap4_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tahap4)
		if (!isset($GLOBALS["tahap4"])) {
			$GLOBALS["tahap4"] = new ctahap4();
			$GLOBALS["Table"] =& $GLOBALS["tahap4"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tahap4', TRUE);

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
		global $tahap4;

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
			$this->Page_Terminate("tahap4list.php");
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
		global $objForm, $Language, $gsFormError, $tahap4;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tahap4->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tahap4->CurrentAction = "I"; // Form error, reset action
				$tahap4->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$tahap4->id->setQueryStringValue($_GET["id"]);
				$tahap4->setKey("id", $tahap4->id->CurrentValue); // Set up key
			} else {
				$tahap4->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tahap4->CurrentAction = "C"; // Copy record
			} else {
				$tahap4->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tahap4->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tahap4list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tahap4->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tahap4->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tahap4view.php")
						$sReturnUrl = $tahap4->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tahap4->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tahap4->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$tahap4->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tahap4;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $tahap4;
		$tahap4->kodeSubTiga->CurrentValue = NULL;
		$tahap4->kodeSubTiga->OldValue = $tahap4->kodeSubTiga->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tahap4;
		if (!$tahap4->kodeSubTiga->FldIsDetailKey) {
			$tahap4->kodeSubTiga->setFormValue($objForm->GetValue("x_kodeSubTiga"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tahap4;
		$this->LoadOldRecord();
		$tahap4->kodeSubTiga->CurrentValue = $tahap4->kodeSubTiga->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tahap4;
		$sFilter = $tahap4->KeyFilter();

		// Call Row Selecting event
		$tahap4->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tahap4->CurrentFilter = $sFilter;
		$sSql = $tahap4->SQL();
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
		global $conn, $tahap4;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tahap4->Row_Selected($row);
		$tahap4->id->setDbValue($rs->fields('id'));
		$tahap4->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tahap4;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tahap4->getKey("id")) <> "")
			$tahap4->id->CurrentValue = $tahap4->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tahap4->CurrentFilter = $tahap4->KeyFilter();
			$sSql = $tahap4->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tahap4;

		// Initialize URLs
		// Call Row_Rendering event

		$tahap4->Row_Rendering();

		// Common render codes for all row types
		// id
		// kodeSubTiga

		if ($tahap4->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tahap4->id->ViewValue = $tahap4->id->CurrentValue;
			$tahap4->id->ViewCustomAttributes = "";

			// kodeSubTiga
			if (strval($tahap4->kodeSubTiga->CurrentValue) <> "") {
				$sFilterWrk = "`kodeSubTiga` = '" . ew_AdjustSql($tahap4->kodeSubTiga->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodeSubTiga`, `namaSubTiga` FROM `subtigarek`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='" . $_SESSION["kode_pokok"] . "' AND kodeSubSatu='" . $_SESSION["kode_sub_satu"] . "' AND kodeSubDua='" . $_SESSION["kode_sub_dua"] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodeSubTiga` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tahap4->kodeSubTiga->ViewValue = $rswrk->fields('kodeSubTiga');
					$tahap4->kodeSubTiga->ViewValue .= ew_ValueSeparator(0,1,$tahap4->kodeSubTiga) . $rswrk->fields('namaSubTiga');
					$rswrk->Close();
				} else {
					$tahap4->kodeSubTiga->ViewValue = $tahap4->kodeSubTiga->CurrentValue;
				}
			} else {
				$tahap4->kodeSubTiga->ViewValue = NULL;
			}
			$tahap4->kodeSubTiga->ViewCustomAttributes = "";

			// kodeSubTiga
			$tahap4->kodeSubTiga->LinkCustomAttributes = "";
			$tahap4->kodeSubTiga->HrefValue = "";
			$tahap4->kodeSubTiga->TooltipValue = "";
		} elseif ($tahap4->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodeSubTiga
			$tahap4->kodeSubTiga->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kodeSubTiga`, `kodeSubTiga` AS `DispFld`, `namaSubTiga` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `subtigarek`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='" . $_SESSION["kode_pokok"] . "' AND kodeSubSatu='" . $_SESSION["kode_sub_satu"] . "' AND kodeSubDua='" . $_SESSION["kode_sub_dua"] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodeSubTiga` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$tahap4->kodeSubTiga->EditValue = $arwrk;

			// Edit refer script
			// kodeSubTiga

			$tahap4->kodeSubTiga->HrefValue = "";
		}
		if ($tahap4->RowType == EW_ROWTYPE_ADD ||
			$tahap4->RowType == EW_ROWTYPE_EDIT ||
			$tahap4->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tahap4->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tahap4->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tahap4->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tahap4;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tahap4->kodeSubTiga->FormValue) && $tahap4->kodeSubTiga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap4->kodeSubTiga->FldCaption());
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
		global $conn, $Language, $Security, $tahap4;
		$rsnew = array();

		// kodeSubTiga
		$tahap4->kodeSubTiga->SetDbValueDef($rsnew, $tahap4->kodeSubTiga->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tahap4->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tahap4->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tahap4->CancelMessage <> "") {
				$this->setFailureMessage($tahap4->CancelMessage);
				$tahap4->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$tahap4->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tahap4->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tahap4->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
function Page_Load() {
   // Bismillaah
	global $Language;
	
	$Language->setPhrase("GoBack","");  
	$Language->setPhrase("AddBtn","Ke Tahap Berikutnya");      
	
	$judul= "Tahap 4, Pemilihan Sub Tiga  Rekening.<BR><BR> Kode Pokok:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_pokok"] . " (" .  
	   $_SESSION["nama_kode_pokok"] . ")</FONT></STRONG>" .
	   "<BR> Kode Sub Satu:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_sub_satu"] . " (" .  
	   $_SESSION["nama_sub_satu"] . ")</FONT></STRONG>" .  
	   "<BR> Kode Sub Dua:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_sub_dua"] . " (" .  
	   $_SESSION["nama_sub_dua"] . 
	   ")</FONT><STRONG>" ;
	   
														   
					 
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
