<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tahap3info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tahap3_add = new ctahap3_add();
$Page =& $tahap3_add;

// Page init
$tahap3_add->Page_Init();

// Page main
$tahap3_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tahap3_add = new ew_Page("tahap3_add");

// page properties
tahap3_add.PageID = "add"; // page ID
tahap3_add.FormID = "ftahap3add"; // form ID
var EW_PAGE_ID = tahap3_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tahap3_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kodeSubDua"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap3->kodeSubDua->FldCaption()) ?>");

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
tahap3_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tahap3_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tahap3_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $tahap3->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tahap3->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tahap3_add->ShowPageHeader(); ?>
<?php
$tahap3_add->ShowMessage();
?>
<form name="ftahap3add" id="ftahap3add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tahap3_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tahap3">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tahap3->kodeSubDua->Visible) { // kodeSubDua ?>
	<tr id="r_kodeSubDua"<?php echo $tahap3->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap3->kodeSubDua->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap3->kodeSubDua->CellAttributes() ?>><span id="el_kodeSubDua">
<select id="x_kodeSubDua" name="x_kodeSubDua"<?php echo $tahap3->kodeSubDua->EditAttributes() ?>>
<?php
if (is_array($tahap3->kodeSubDua->EditValue)) {
	$arwrk = $tahap3->kodeSubDua->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tahap3->kodeSubDua->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$tahap3->kodeSubDua) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd("subduarek")) { ?>
&nbsp;<a name="aol_x_kodeSubDua" id="aol_x_kodeSubDua" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:tahap3_add,lnk:'aol_x_kodeSubDua',el:'x_kodeSubDua',hdr:this.innerHTML, url:'subduarekaddopt.php',lf:'x_kodeSubDua',df:'x_kodeSubDua',df2:'x_namaSubDua',df3:'',df4:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $tahap3->kodeSubDua->FldCaption() ?></a>
<?php } ?>
</span><?php echo $tahap3->kodeSubDua->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tahap3_add->ShowPageFooter();
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
$tahap3_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctahap3_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tahap3';

	// Page object name
	var $PageObjName = 'tahap3_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tahap3;
		if ($tahap3->UseTokenInUrl) $PageUrl .= "t=" . $tahap3->TableVar . "&"; // Add page token
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
		global $objForm, $tahap3;
		if ($tahap3->UseTokenInUrl) {
			if ($objForm)
				return ($tahap3->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tahap3->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctahap3_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tahap3)
		if (!isset($GLOBALS["tahap3"])) {
			$GLOBALS["tahap3"] = new ctahap3();
			$GLOBALS["Table"] =& $GLOBALS["tahap3"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tahap3', TRUE);

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
		global $tahap3;

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
			$this->Page_Terminate("tahap3list.php");
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
		global $objForm, $Language, $gsFormError, $tahap3;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tahap3->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tahap3->CurrentAction = "I"; // Form error, reset action
				$tahap3->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$tahap3->id->setQueryStringValue($_GET["id"]);
				$tahap3->setKey("id", $tahap3->id->CurrentValue); // Set up key
			} else {
				$tahap3->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tahap3->CurrentAction = "C"; // Copy record
			} else {
				$tahap3->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tahap3->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tahap3list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tahap3->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tahap3->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tahap3view.php")
						$sReturnUrl = $tahap3->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tahap3->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tahap3->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$tahap3->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tahap3;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $tahap3;
		$tahap3->kodeSubDua->CurrentValue = NULL;
		$tahap3->kodeSubDua->OldValue = $tahap3->kodeSubDua->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tahap3;
		if (!$tahap3->kodeSubDua->FldIsDetailKey) {
			$tahap3->kodeSubDua->setFormValue($objForm->GetValue("x_kodeSubDua"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tahap3;
		$this->LoadOldRecord();
		$tahap3->kodeSubDua->CurrentValue = $tahap3->kodeSubDua->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tahap3;
		$sFilter = $tahap3->KeyFilter();

		// Call Row Selecting event
		$tahap3->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tahap3->CurrentFilter = $sFilter;
		$sSql = $tahap3->SQL();
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
		global $conn, $tahap3;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tahap3->Row_Selected($row);
		$tahap3->id->setDbValue($rs->fields('id'));
		$tahap3->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tahap3;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tahap3->getKey("id")) <> "")
			$tahap3->id->CurrentValue = $tahap3->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tahap3->CurrentFilter = $tahap3->KeyFilter();
			$sSql = $tahap3->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tahap3;

		// Initialize URLs
		// Call Row_Rendering event

		$tahap3->Row_Rendering();

		// Common render codes for all row types
		// id
		// kodeSubDua

		if ($tahap3->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tahap3->id->ViewValue = $tahap3->id->CurrentValue;
			$tahap3->id->ViewCustomAttributes = "";

			// kodeSubDua
			if (strval($tahap3->kodeSubDua->CurrentValue) <> "") {
				$sFilterWrk = "`kodeSubDua` = '" . ew_AdjustSql($tahap3->kodeSubDua->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodeSubDua`, `namaSubDua` FROM `subduarek`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='" . $_SESSION["kode_pokok"] . "' AND kodeSubSatu='" . $_SESSION["kode_sub_satu"] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodeSubDua` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tahap3->kodeSubDua->ViewValue = $rswrk->fields('kodeSubDua');
					$tahap3->kodeSubDua->ViewValue .= ew_ValueSeparator(0,1,$tahap3->kodeSubDua) . $rswrk->fields('namaSubDua');
					$rswrk->Close();
				} else {
					$tahap3->kodeSubDua->ViewValue = $tahap3->kodeSubDua->CurrentValue;
				}
			} else {
				$tahap3->kodeSubDua->ViewValue = NULL;
			}
			$tahap3->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubDua
			$tahap3->kodeSubDua->LinkCustomAttributes = "";
			$tahap3->kodeSubDua->HrefValue = "";
			$tahap3->kodeSubDua->TooltipValue = "";
		} elseif ($tahap3->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodeSubDua
			$tahap3->kodeSubDua->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kodeSubDua`, `kodeSubDua` AS `DispFld`, `namaSubDua` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `subduarek`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='" . $_SESSION["kode_pokok"] . "' AND kodeSubSatu='" . $_SESSION["kode_sub_satu"] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodeSubDua` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$tahap3->kodeSubDua->EditValue = $arwrk;

			// Edit refer script
			// kodeSubDua

			$tahap3->kodeSubDua->HrefValue = "";
		}
		if ($tahap3->RowType == EW_ROWTYPE_ADD ||
			$tahap3->RowType == EW_ROWTYPE_EDIT ||
			$tahap3->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tahap3->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tahap3->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tahap3->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tahap3;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tahap3->kodeSubDua->FormValue) && $tahap3->kodeSubDua->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap3->kodeSubDua->FldCaption());
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
		global $conn, $Language, $Security, $tahap3;
		$rsnew = array();

		// kodeSubDua
		$tahap3->kodeSubDua->SetDbValueDef($rsnew, $tahap3->kodeSubDua->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tahap3->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tahap3->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tahap3->CancelMessage <> "") {
				$this->setFailureMessage($tahap3->CancelMessage);
				$tahap3->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$tahap3->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tahap3->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tahap3->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
function Page_Load() {
	// Bismillaah
	global $Language;
	
	$Language->setPhrase("GoBack","");  
	$Language->setPhrase("AddBtn","Ke Tahap Berikutnya");      
	
	$judul= "Tahap 3, Pemilihan Sub Dua  Rekening.<BR><BR> Kode Pokok:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_pokok"] . " (" .  
	   $_SESSION["nama_kode_pokok"] . ")</FONT></STRONG>" .
	   "<BR> Kode Sub Satu:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_sub_satu"] . " (" .  
	   $_SESSION["nama_sub_satu"] . ")</FONT><STRONG>" ;     
	   
														   
					 
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
