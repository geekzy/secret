<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tahap22info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tahap22_add = new ctahap22_add();
$Page =& $tahap22_add;

// Page init
$tahap22_add->Page_Init();

// Page main
$tahap22_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tahap22_add = new ew_Page("tahap22_add");

// page properties
tahap22_add.PageID = "add"; // page ID
tahap22_add.FormID = "ftahap22add"; // form ID
var EW_PAGE_ID = tahap22_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tahap22_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kodeSubSatu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tahap22->kodeSubSatu->FldCaption()) ?>");

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
tahap22_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tahap22_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tahap22_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $tahap22->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tahap22->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tahap22_add->ShowPageHeader(); ?>
<?php
$tahap22_add->ShowMessage();
?>
<form name="ftahap22add" id="ftahap22add" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tahap22_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tahap22">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tahap22->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<tr id="r_kodeSubSatu"<?php echo $tahap22->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tahap22->kodeSubSatu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tahap22->kodeSubSatu->CellAttributes() ?>><span id="el_kodeSubSatu">
<select id="x_kodeSubSatu" name="x_kodeSubSatu"<?php echo $tahap22->kodeSubSatu->EditAttributes() ?>>
<?php
if (is_array($tahap22->kodeSubSatu->EditValue)) {
	$arwrk = $tahap22->kodeSubSatu->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tahap22->kodeSubSatu->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$tahap22->kodeSubSatu) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd("subsaturek")) { ?>
&nbsp;<a name="aol_x_kodeSubSatu" id="aol_x_kodeSubSatu" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:tahap22_add,lnk:'aol_x_kodeSubSatu',el:'x_kodeSubSatu',hdr:this.innerHTML, url:'subsaturekaddopt.php',lf:'x_kodeSubSatu',df:'x_kodeSubSatu',df2:'x_namaSubSatu',df3:'',df4:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $tahap22->kodeSubSatu->FldCaption() ?></a>
<?php } ?>
</span><?php echo $tahap22->kodeSubSatu->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tahap22_add->ShowPageFooter();
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
$tahap22_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctahap22_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tahap22';

	// Page object name
	var $PageObjName = 'tahap22_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tahap22;
		if ($tahap22->UseTokenInUrl) $PageUrl .= "t=" . $tahap22->TableVar . "&"; // Add page token
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
		global $objForm, $tahap22;
		if ($tahap22->UseTokenInUrl) {
			if ($objForm)
				return ($tahap22->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tahap22->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctahap22_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tahap22)
		if (!isset($GLOBALS["tahap22"])) {
			$GLOBALS["tahap22"] = new ctahap22();
			$GLOBALS["Table"] =& $GLOBALS["tahap22"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tahap22', TRUE);

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
		global $tahap22;

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
			$this->Page_Terminate("tahap22list.php");
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
		global $objForm, $Language, $gsFormError, $tahap22;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tahap22->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tahap22->CurrentAction = "I"; // Form error, reset action
				$tahap22->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$tahap22->id->setQueryStringValue($_GET["id"]);
				$tahap22->setKey("id", $tahap22->id->CurrentValue); // Set up key
			} else {
				$tahap22->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tahap22->CurrentAction = "C"; // Copy record
			} else {
				$tahap22->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tahap22->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tahap22list.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tahap22->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tahap22->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tahap22view.php")
						$sReturnUrl = $tahap22->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tahap22->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tahap22->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$tahap22->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tahap22;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $tahap22;
		$tahap22->kodeSubSatu->CurrentValue = NULL;
		$tahap22->kodeSubSatu->OldValue = $tahap22->kodeSubSatu->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tahap22;
		if (!$tahap22->kodeSubSatu->FldIsDetailKey) {
			$tahap22->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tahap22;
		$this->LoadOldRecord();
		$tahap22->kodeSubSatu->CurrentValue = $tahap22->kodeSubSatu->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tahap22;
		$sFilter = $tahap22->KeyFilter();

		// Call Row Selecting event
		$tahap22->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tahap22->CurrentFilter = $sFilter;
		$sSql = $tahap22->SQL();
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
		global $conn, $tahap22;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tahap22->Row_Selected($row);
		$tahap22->id->setDbValue($rs->fields('id'));
		$tahap22->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tahap22;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tahap22->getKey("id")) <> "")
			$tahap22->id->CurrentValue = $tahap22->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tahap22->CurrentFilter = $tahap22->KeyFilter();
			$sSql = $tahap22->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tahap22;

		// Initialize URLs
		// Call Row_Rendering event

		$tahap22->Row_Rendering();

		// Common render codes for all row types
		// id
		// kodeSubSatu

		if ($tahap22->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tahap22->id->ViewValue = $tahap22->id->CurrentValue;
			$tahap22->id->ViewCustomAttributes = "";

			// kodeSubSatu
			if (strval($tahap22->kodeSubSatu->CurrentValue) <> "") {
				$sFilterWrk = "`kodeSubSatu` = '" . ew_AdjustSql($tahap22->kodeSubSatu->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodeSubSatu`, `namaSubSatu` FROM `subsaturek`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='" . $_SESSION["kode_pokok"] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodeSubSatu` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tahap22->kodeSubSatu->ViewValue = $rswrk->fields('kodeSubSatu');
					$tahap22->kodeSubSatu->ViewValue .= ew_ValueSeparator(0,1,$tahap22->kodeSubSatu) . $rswrk->fields('namaSubSatu');
					$rswrk->Close();
				} else {
					$tahap22->kodeSubSatu->ViewValue = $tahap22->kodeSubSatu->CurrentValue;
				}
			} else {
				$tahap22->kodeSubSatu->ViewValue = NULL;
			}
			$tahap22->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubSatu
			$tahap22->kodeSubSatu->LinkCustomAttributes = "";
			$tahap22->kodeSubSatu->HrefValue = "";
			$tahap22->kodeSubSatu->TooltipValue = "";
		} elseif ($tahap22->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodeSubSatu
			$tahap22->kodeSubSatu->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kodeSubSatu`, `kodeSubSatu` AS `DispFld`, `namaSubSatu` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `subsaturek`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='" . $_SESSION["kode_pokok"] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kodeSubSatu` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$tahap22->kodeSubSatu->EditValue = $arwrk;

			// Edit refer script
			// kodeSubSatu

			$tahap22->kodeSubSatu->HrefValue = "";
		}
		if ($tahap22->RowType == EW_ROWTYPE_ADD ||
			$tahap22->RowType == EW_ROWTYPE_EDIT ||
			$tahap22->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tahap22->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tahap22->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tahap22->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tahap22;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tahap22->kodeSubSatu->FormValue) && $tahap22->kodeSubSatu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tahap22->kodeSubSatu->FldCaption());
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
		global $conn, $Language, $Security, $tahap22;
		$rsnew = array();

		// kodeSubSatu
		$tahap22->kodeSubSatu->SetDbValueDef($rsnew, $tahap22->kodeSubSatu->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tahap22->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tahap22->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tahap22->CancelMessage <> "") {
				$this->setFailureMessage($tahap22->CancelMessage);
				$tahap22->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$tahap22->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tahap22->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tahap22->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
function Page_Load() {
	// Bismillaah
	global $Language;
	
	$Language->setPhrase("GoBack","");  
	$Language->setPhrase("AddBtn","Ke Tahap Berikutnya");   
		  
	$Language->setPhrase("TblTypeVIEW","");
	
	$judul= "Tahap 2, Pemilihan Sub Satu  Rekening.<BR><BR> Kode Pokok:  " . 
	   "<FONT COLOR= #0000FF><STRONG>". $_SESSION["kode_pokok"] . " (" .  
	   $_SESSION["nama_kode_pokok"] . ")</FONT></STRONG>"  ;
	   
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
