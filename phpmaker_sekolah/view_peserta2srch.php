<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "view_peserta2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$view_peserta2_search = new cview_peserta2_search();
$Page =& $view_peserta2_search;

// Page init
$view_peserta2_search->Page_Init();

// Page main
$view_peserta2_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var view_peserta2_search = new ew_Page("view_peserta2_search");

// page properties
view_peserta2_search.PageID = "search"; // page ID
view_peserta2_search.FormID = "fview_peserta2search"; // form ID
var EW_PAGE_ID = view_peserta2_search.PageID; // for backward compatibility

// extend page with validate function for search
view_peserta2_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
view_peserta2_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
view_peserta2_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
view_peserta2_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_peserta2_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_peserta2->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $view_peserta2->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $view_peserta2_search->ShowPageHeader(); ?>
<?php
$view_peserta2_search->ShowMessage();
?>
<form name="fview_peserta2search" id="fview_peserta2search" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return view_peserta2_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="view_peserta2">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_A_nama_Lengkap"<?php echo $view_peserta2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_peserta2->A_nama_Lengkap->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_nama_Lengkap" id="z_A_nama_Lengkap" onchange="ew_SrchOprChanged('z_A_nama_Lengkap')"><option value="="<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $view_peserta2->A_nama_Lengkap->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_nama_Lengkap" id="x_A_nama_Lengkap" size="30" maxlength="50" value="<?php echo $view_peserta2->A_nama_Lengkap->EditValue ?>"<?php echo $view_peserta2->A_nama_Lengkap->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_nama_Lengkap" name="btw1_A_nama_Lengkap">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_nama_Lengkap" name="btw1_A_nama_Lengkap">
<input type="text" name="y_A_nama_Lengkap" id="y_A_nama_Lengkap" size="30" maxlength="50" value="<?php echo $view_peserta2->A_nama_Lengkap->EditValue2 ?>"<?php echo $view_peserta2->A_nama_Lengkap->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_nis_nasional"<?php echo $view_peserta2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_peserta2->A_nis_nasional->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_nis_nasional" id="z_A_nis_nasional" onchange="ew_SrchOprChanged('z_A_nis_nasional')"><option value="="<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $view_peserta2->A_nis_nasional->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_nis_nasional" id="x_A_nis_nasional" size="30" maxlength="20" value="<?php echo $view_peserta2->A_nis_nasional->EditValue ?>"<?php echo $view_peserta2->A_nis_nasional->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_nis_nasional" name="btw1_A_nis_nasional">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_nis_nasional" name="btw1_A_nis_nasional">
<input type="text" name="y_A_nis_nasional" id="y_A_nis_nasional" size="30" maxlength="20" value="<?php echo $view_peserta2->A_nis_nasional->EditValue2 ?>"<?php echo $view_peserta2->A_nis_nasional->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_SrchOprChanged('z_A_nama_Lengkap');
ew_SrchOprChanged('z_A_nis_nasional');

//-->
</script>
<?php
$view_peserta2_search->ShowPageFooter();
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
$view_peserta2_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_peserta2_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'view_peserta2';

	// Page object name
	var $PageObjName = 'view_peserta2_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_peserta2;
		if ($view_peserta2->UseTokenInUrl) $PageUrl .= "t=" . $view_peserta2->TableVar . "&"; // Add page token
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
		global $objForm, $view_peserta2;
		if ($view_peserta2->UseTokenInUrl) {
			if ($objForm)
				return ($view_peserta2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_peserta2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_peserta2_search() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (view_peserta2)
		if (!isset($GLOBALS["view_peserta2"])) {
			$GLOBALS["view_peserta2"] = new cview_peserta2();
			$GLOBALS["Table"] =& $GLOBALS["view_peserta2"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_peserta2', TRUE);

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
		global $view_peserta2;

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("view_peserta2list.php");
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $view_peserta2;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$view_peserta2->CurrentAction = $objForm->GetValue("a_search");
			switch ($view_peserta2->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $view_peserta2->UrlParm($sSrchStr);
						$this->Page_Terminate("view_peserta2list.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$view_peserta2->RowType = EW_ROWTYPE_SEARCH;
		$view_peserta2->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $view_peserta2;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $view_peserta2->A_nama_Lengkap); // A_nama_Lengkap
	$this->BuildSearchUrl($sSrchUrl, $view_peserta2->A_nis_nasional); // A_nis_nasional
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $view_peserta2;

		// Load search values
		// A_nama_Lengkap

		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_nama_Lengkap"));
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_nama_Lengkap");
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_nama_Lengkap");
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_nama_Lengkap"));
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_nama_Lengkap");

		// A_nis_nasional
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_nis_nasional"));
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_nis_nasional");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_nis_nasional");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_nis_nasional"));
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_nis_nasional");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_peserta2;

		// Initialize URLs
		// Call Row_Rendering event

		$view_peserta2->Row_Rendering();

		// Common render codes for all row types
		// A_nama_Lengkap
		// A_nis_nasional

		if ($view_peserta2->RowType == EW_ROWTYPE_VIEW) { // View row

			// A_nama_Lengkap
			$view_peserta2->A_nama_Lengkap->ViewValue = $view_peserta2->A_nama_Lengkap->CurrentValue;
			$view_peserta2->A_nama_Lengkap->ViewCustomAttributes = "";

			// A_nis_nasional
			$view_peserta2->A_nis_nasional->ViewValue = $view_peserta2->A_nis_nasional->CurrentValue;
			$view_peserta2->A_nis_nasional->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$view_peserta2->A_nama_Lengkap->LinkCustomAttributes = "";
			$view_peserta2->A_nama_Lengkap->HrefValue = "";
			$view_peserta2->A_nama_Lengkap->TooltipValue = "";

			// A_nis_nasional
			$view_peserta2->A_nis_nasional->LinkCustomAttributes = "";
			$view_peserta2->A_nis_nasional->HrefValue = "";
			$view_peserta2->A_nis_nasional->TooltipValue = "";
		} elseif ($view_peserta2->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// A_nama_Lengkap
			$view_peserta2->A_nama_Lengkap->EditCustomAttributes = "";
			$view_peserta2->A_nama_Lengkap->EditValue = ew_HtmlEncode($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue);
			$view_peserta2->A_nama_Lengkap->EditCustomAttributes = "";
			$view_peserta2->A_nama_Lengkap->EditValue2 = ew_HtmlEncode($view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue2);

			// A_nis_nasional
			$view_peserta2->A_nis_nasional->EditCustomAttributes = "";
			$view_peserta2->A_nis_nasional->EditValue = ew_HtmlEncode($view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue);
			$view_peserta2->A_nis_nasional->EditCustomAttributes = "";
			$view_peserta2->A_nis_nasional->EditValue2 = ew_HtmlEncode($view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue2);
		}
		if ($view_peserta2->RowType == EW_ROWTYPE_ADD ||
			$view_peserta2->RowType == EW_ROWTYPE_EDIT ||
			$view_peserta2->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$view_peserta2->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($view_peserta2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_peserta2->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $view_peserta2;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $view_peserta2;
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue = $view_peserta2->getAdvancedSearch("x_A_nama_Lengkap");
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator = $view_peserta2->getAdvancedSearch("z_A_nama_Lengkap");
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue2 = $view_peserta2->getAdvancedSearch("y_A_nama_Lengkap");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue = $view_peserta2->getAdvancedSearch("x_A_nis_nasional");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator = $view_peserta2->getAdvancedSearch("z_A_nis_nasional");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue2 = $view_peserta2->getAdvancedSearch("y_A_nis_nasional");
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
