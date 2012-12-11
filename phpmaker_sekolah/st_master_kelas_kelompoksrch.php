<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_kelas_kelompok_search = new cst_master_kelas_kelompok_search();
$Page =& $st_master_kelas_kelompok_search;

// Page init
$st_master_kelas_kelompok_search->Page_Init();

// Page main
$st_master_kelas_kelompok_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_kelas_kelompok_search = new ew_Page("st_master_kelas_kelompok_search");

// page properties
st_master_kelas_kelompok_search.PageID = "search"; // page ID
st_master_kelas_kelompok_search.FormID = "fst_master_kelas_kelompoksearch"; // form ID
var EW_PAGE_ID = st_master_kelas_kelompok_search.PageID; // for backward compatibility

// extend page with validate function for search
st_master_kelas_kelompok_search.ValidateSearch = function(fobj) {
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
st_master_kelas_kelompok_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
st_master_kelas_kelompok_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_kelas_kelompok_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_kelas_kelompok_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_kelas_kelompok->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_master_kelas_kelompok->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $st_master_kelas_kelompok_search->ShowPageHeader(); ?>
<?php
$st_master_kelas_kelompok_search->ShowMessage();
?>
<form name="fst_master_kelas_kelompoksearch" id="fst_master_kelas_kelompoksearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return st_master_kelas_kelompok_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="st_master_kelas_kelompok">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_tahun"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_tahun" id="z_tahun" value="LIKE"></td>
		<td<?php echo $st_master_kelas_kelompok->tahun->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_tahun" id="x_tahun" size="30" maxlength="4" value="<?php echo $st_master_kelas_kelompok->tahun->EditValue ?>"<?php echo $st_master_kelas_kelompok->tahun->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_kelas"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kelas->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_kelas" id="z_kelas" value="LIKE"></td>
		<td<?php echo $st_master_kelas_kelompok->kelas->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_kelas" name="x_kelas"<?php echo $st_master_kelas_kelompok->kelas->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->kelas->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->kelas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->kelas->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_nama_kelas_kelompok"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_nama_kelas_kelompok" id="z_nama_kelas_kelompok" value="LIKE"></td>
		<td<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_nama_kelas_kelompok" id="x_nama_kelas_kelompok" size="30" maxlength="50" value="<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditValue ?>"<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_kode_otomatis"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_kode_otomatis" id="z_kode_otomatis" value="LIKE"></td>
		<td<?php echo $st_master_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_kode_otomatis" id="x_kode_otomatis" size="30" maxlength="50" value="<?php echo $st_master_kelas_kelompok->kode_otomatis->EditValue ?>"<?php echo $st_master_kelas_kelompok->kode_otomatis->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_apakah_valid"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_apakah_valid" id="z_apakah_valid" value="LIKE"></td>
		<td<?php echo $st_master_kelas_kelompok->apakah_valid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_apakah_valid" name="x_apakah_valid"<?php echo $st_master_kelas_kelompok->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->apakah_valid->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_kode_otomatis_tingkat"<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_kode_otomatis_tingkat" id="z_kode_otomatis_tingkat" value="LIKE"></td>
		<td<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_kode_otomatis_tingkat" id="x_kode_otomatis_tingkat" size="30" maxlength="50" value="<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->EditValue ?>"<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->EditAttributes() ?>>
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
<?php
$st_master_kelas_kelompok_search->ShowPageFooter();
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
$st_master_kelas_kelompok_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_kelas_kelompok_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'st_master_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_master_kelas_kelompok_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_master_kelas_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_kelas_kelompok_search() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_kelas_kelompok)
		if (!isset($GLOBALS["st_master_kelas_kelompok"])) {
			$GLOBALS["st_master_kelas_kelompok"] = new cst_master_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_master_kelas_kelompok"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_kelas_kelompok', TRUE);

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
		global $st_master_kelas_kelompok;

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
			$this->Page_Terminate("st_master_kelas_kelompoklist.php");
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
		global $objForm, $Language, $gsSearchError, $st_master_kelas_kelompok;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$st_master_kelas_kelompok->CurrentAction = $objForm->GetValue("a_search");
			switch ($st_master_kelas_kelompok->CurrentAction) {
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
						$sSrchStr = $st_master_kelas_kelompok->UrlParm($sSrchStr);
						$this->Page_Terminate("st_master_kelas_kelompoklist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$st_master_kelas_kelompok->RowType = EW_ROWTYPE_SEARCH;
		$st_master_kelas_kelompok->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $st_master_kelas_kelompok;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $st_master_kelas_kelompok->tahun); // tahun
	$this->BuildSearchUrl($sSrchUrl, $st_master_kelas_kelompok->kelas); // kelas
	$this->BuildSearchUrl($sSrchUrl, $st_master_kelas_kelompok->nama_kelas_kelompok); // nama_kelas_kelompok
	$this->BuildSearchUrl($sSrchUrl, $st_master_kelas_kelompok->kode_otomatis); // kode_otomatis
	$this->BuildSearchUrl($sSrchUrl, $st_master_kelas_kelompok->apakah_valid); // apakah_valid
	$this->BuildSearchUrl($sSrchUrl, $st_master_kelas_kelompok->kode_otomatis_tingkat); // kode_otomatis_tingkat
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
		global $objForm, $st_master_kelas_kelompok;

		// Load search values
		// tahun

		$st_master_kelas_kelompok->tahun->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tahun"));
		$st_master_kelas_kelompok->tahun->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tahun");

		// kelas
		$st_master_kelas_kelompok->kelas->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kelas"));
		$st_master_kelas_kelompok->kelas->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kelas");

		// nama_kelas_kelompok
		$st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_nama_kelas_kelompok"));
		$st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nama_kelas_kelompok");

		// kode_otomatis
		$st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kode_otomatis"));
		$st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_otomatis");

		// apakah_valid
		$st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_apakah_valid"));
		$st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_apakah_valid");

		// kode_otomatis_tingkat
		$st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kode_otomatis_tingkat"));
		$st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_otomatis_tingkat");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_kelas_kelompok;

		// Initialize URLs
		// Call Row_Rendering event

		$st_master_kelas_kelompok->Row_Rendering();

		// Common render codes for all row types
		// tahun
		// kelas
		// nama_kelas_kelompok
		// kode_otomatis
		// apakah_valid
		// kode_otomatis_tingkat

		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// tahun
			$st_master_kelas_kelompok->tahun->ViewValue = $st_master_kelas_kelompok->tahun->CurrentValue;
			$st_master_kelas_kelompok->tahun->ViewCustomAttributes = "";

			// kelas
			if (strval($st_master_kelas_kelompok->kelas->CurrentValue) <> "") {
				$sFilterWrk = "`kelas` = '" . ew_AdjustSql($st_master_kelas_kelompok->kelas->CurrentValue) . "'";
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
					$st_master_kelas_kelompok->kelas->ViewValue = $rswrk->fields('kelas');
					$rswrk->Close();
				} else {
					$st_master_kelas_kelompok->kelas->ViewValue = $st_master_kelas_kelompok->kelas->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->kelas->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->kelas->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewValue = $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue;
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->ViewValue = $st_master_kelas_kelompok->kode_otomatis->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) <> "") {
				switch ($st_master_kelas_kelompok->apakah_valid->CurrentValue) {
					case "y":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					case "t":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					default:
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->apakah_valid->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$st_master_kelas_kelompok->tahun->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->HrefValue = "";
			$st_master_kelas_kelompok->tahun->TooltipValue = "";

			// kelas
			$st_master_kelas_kelompok->kelas->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kelas->HrefValue = "";
			$st_master_kelas_kelompok->kelas->TooltipValue = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->HrefValue = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->TooltipValue = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->apakah_valid->HrefValue = "";
			$st_master_kelas_kelompok->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->TooltipValue = "";
		} elseif ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// tahun
			$st_master_kelas_kelompok->tahun->EditCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->tahun->AdvancedSearch->SearchValue);

			// kelas
			$st_master_kelas_kelompok->kelas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kelas`, `kelas` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_kelas`";
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
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->kelas->EditValue = $arwrk;

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchValue);

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue);

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->apakah_valid->EditValue = $arwrk;

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchValue);
		}
		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD ||
			$st_master_kelas_kelompok->RowType == EW_ROWTYPE_EDIT ||
			$st_master_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_master_kelas_kelompok->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_master_kelas_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_kelas_kelompok->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $st_master_kelas_kelompok;

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
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->tahun->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_tahun");
		$st_master_kelas_kelompok->kelas->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_kelas");
		$st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_nama_kelas_kelompok");
		$st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_kode_otomatis");
		$st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_apakah_valid");
		$st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_kode_otomatis_tingkat");
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
