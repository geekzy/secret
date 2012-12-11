<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tahap1info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tahap1_add = new ctahap1_add();
$Page =& $tahap1_add;

// Page init
$tahap1_add->Page_Init();

// Page main
$tahap1_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tahap1_add = new ew_Page("tahap1_add");

// page properties
tahap1_add.PageID = "add"; // page ID
tahap1_add.FormID = "ftahap1add"; // form ID
var EW_PAGE_ID = tahap1_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tahap1_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap1->kodePokok->FldCaption()) ?>");

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
tahap1_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tahap1_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tahap1_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $tahap1->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tahap1->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tahap1_add->ShowPageHeader(); ?>
<?php
$tahap1_add->ShowMessage();
?>
<form name="ftahap1add" id="ftahap1add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tahap1_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tahap1">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tahap1->kodePokok->Visible) { // kodePokok ?>
	<tr id="r_kodePokok"<?php echo $tahap1->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap1->kodePokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap1->kodePokok->CellAttributes() ?>><span id="el_kodePokok">
<select id="x_kodePokok" name="x_kodePokok"<?php echo $tahap1->kodePokok->EditAttributes() ?>>
<?php
if (is_array($tahap1->kodePokok->EditValue)) {
	$arwrk = $tahap1->kodePokok->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tahap1->kodePokok->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$tahap1->kodePokok) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd("pokokrek")) { ?>
&nbsp;<a name="aol_x_kodePokok" id="aol_x_kodePokok" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:tahap1_add,lnk:'aol_x_kodePokok',el:'x_kodePokok',hdr:this.innerHTML, url:'pokokrekaddopt.php',lf:'x_kodePokok',df:'x_kodePokok',df2:'x_namaPokok',df3:'',df4:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $tahap1->kodePokok->FldCaption() ?></a>
<?php } ?>
</span><?php echo $tahap1->kodePokok->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tahap1_add->ShowPageFooter();
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
$tahap1_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctahap1_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tahap1';

	// Page object name
	var $PageObjName = 'tahap1_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tahap1;
		if ($tahap1->UseTokenInUrl) $PageUrl .= "t=" . $tahap1->TableVar . "&"; // Add page token
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
		global $objForm, $tahap1;
		if ($tahap1->UseTokenInUrl) {
			if ($objForm)
				return ($tahap1->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tahap1->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctahap1_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tahap1)
		if (!isset($GLOBALS["tahap1"])) {
			$GLOBALS["tahap1"] = new ctahap1();
			$GLOBALS["Table"] =& $GLOBALS["tahap1"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tahap1', TRUE);

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
		global $tahap1;

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
			$this->Page_Terminate("tahap1list.php");
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
		global $objForm, $Language, $gsFormError, $tahap1;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tahap1->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tahap1->CurrentAction = "I"; // Form error, reset action
				$tahap1->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$tahap1->id->setQueryStringValue($_GET["id"]);
				$tahap1->setKey("id", $tahap1->id->CurrentValue); // Set up key
			} else {
				$tahap1->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tahap1->CurrentAction = "C"; // Copy record
			} else {
				$tahap1->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tahap1->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tahap1list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tahap1->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tahap1->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tahap1view.php")
						$sReturnUrl = $tahap1->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tahap1->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tahap1->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$tahap1->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tahap1;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $tahap1;
		$tahap1->kodePokok->CurrentValue = NULL;
		$tahap1->kodePokok->OldValue = $tahap1->kodePokok->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tahap1;
		if (!$tahap1->kodePokok->FldIsDetailKey) {
			$tahap1->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tahap1;
		$this->LoadOldRecord();
		$tahap1->kodePokok->CurrentValue = $tahap1->kodePokok->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tahap1;
		$sFilter = $tahap1->KeyFilter();

		// Call Row Selecting event
		$tahap1->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tahap1->CurrentFilter = $sFilter;
		$sSql = $tahap1->SQL();
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
		global $conn, $tahap1;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tahap1->Row_Selected($row);
		$tahap1->kodePokok->setDbValue($rs->fields('kodePokok'));
		$tahap1->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tahap1;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tahap1->getKey("id")) <> "")
			$tahap1->id->CurrentValue = $tahap1->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tahap1->CurrentFilter = $tahap1->KeyFilter();
			$sSql = $tahap1->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tahap1;

		// Initialize URLs
		// Call Row_Rendering event

		$tahap1->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// id

		if ($tahap1->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			if (strval($tahap1->kodePokok->CurrentValue) <> "") {
				$sFilterWrk = "`kodePokok` = '" . ew_AdjustSql($tahap1->kodePokok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodePokok`, `namaPokok` FROM `pokokrek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodePokok` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tahap1->kodePokok->ViewValue = $rswrk->fields('kodePokok');
					$tahap1->kodePokok->ViewValue .= ew_ValueSeparator(0,1,$tahap1->kodePokok) . $rswrk->fields('namaPokok');
					$rswrk->Close();
				} else {
					$tahap1->kodePokok->ViewValue = $tahap1->kodePokok->CurrentValue;
				}
			} else {
				$tahap1->kodePokok->ViewValue = NULL;
			}
			$tahap1->kodePokok->ViewCustomAttributes = "";

			// id
			$tahap1->id->ViewValue = $tahap1->id->CurrentValue;
			$tahap1->id->ViewCustomAttributes = "";

			// kodePokok
			$tahap1->kodePokok->LinkCustomAttributes = "";
			$tahap1->kodePokok->HrefValue = "";
			$tahap1->kodePokok->TooltipValue = "";
		} elseif ($tahap1->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodePokok
			$tahap1->kodePokok->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kodePokok`, `kodePokok` AS `DispFld`, `namaPokok` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `pokokrek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodePokok` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$tahap1->kodePokok->EditValue = $arwrk;

			// Edit refer script
			// kodePokok

			$tahap1->kodePokok->HrefValue = "";
		}
		if ($tahap1->RowType == EW_ROWTYPE_ADD ||
			$tahap1->RowType == EW_ROWTYPE_EDIT ||
			$tahap1->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tahap1->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tahap1->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tahap1->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tahap1;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tahap1->kodePokok->FormValue) && $tahap1->kodePokok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap1->kodePokok->FldCaption());
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
		global $conn, $Language, $Security, $tahap1;
		$rsnew = array();

		// kodePokok
		$tahap1->kodePokok->SetDbValueDef($rsnew, $tahap1->kodePokok->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tahap1->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tahap1->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tahap1->CancelMessage <> "") {
				$this->setFailureMessage($tahap1->CancelMessage);
				$tahap1->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$tahap1->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tahap1->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tahap1->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
function Page_Load() {
	// Bismillaah
	global $Language;
	
	$Language->setPhrase("GoBack","");  
	$Language->setPhrase("AddBtn","Ke Tahap Berikutnya");      
	
	$judul= "Tahap 1, Pemilihan Kode Pokok Rekening. "  ;          
	   
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
