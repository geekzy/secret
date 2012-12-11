<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pengguna_search = new cpengguna_search();
$Page =& $pengguna_search;

// Page init
$pengguna_search->Page_Init();

// Page main
$pengguna_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pengguna_search = new ew_Page("pengguna_search");

// page properties
pengguna_search.PageID = "search"; // page ID
pengguna_search.FormID = "fpenggunasearch"; // form ID
var EW_PAGE_ID = pengguna_search.PageID; // for backward compatibility

// extend page with validate function for search
pengguna_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pengguna->id->FldErrMsg()) ?>");

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
pengguna_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pengguna_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pengguna_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pengguna->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pengguna->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $pengguna_search->ShowPageHeader(); ?>
<?php
$pengguna_search->ShowMessage();
?>
<form name="fpenggunasearch" id="fpenggunasearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pengguna_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="pengguna">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_id"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->id->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></td>
		<td<?php echo $pengguna->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_id" id="x_id" size="30" value="<?php echo $pengguna->id->EditValue ?>"<?php echo $pengguna->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_nama_pengguna"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->nama_pengguna->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_nama_pengguna" id="z_nama_pengguna" value="LIKE"></td>
		<td<?php echo $pengguna->nama_pengguna->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_nama_pengguna" id="x_nama_pengguna" size="30" maxlength="100" value="<?php echo $pengguna->nama_pengguna->EditValue ?>"<?php echo $pengguna->nama_pengguna->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_password"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->password->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_password" id="z_password" value="LIKE"></td>
		<td<?php echo $pengguna->password->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_password" id="x_password" size="30" maxlength="100" value="<?php echo $pengguna->password->EditValue ?>"<?php echo $pengguna->password->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_username"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->username->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_username" id="z_username" value="LIKE"></td>
		<td<?php echo $pengguna->username->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_username" name="x_username"<?php echo $pengguna->username->EditAttributes() ?>>
<?php
if (is_array($pengguna->username->EditValue)) {
	$arwrk = $pengguna->username->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->username->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<input type="text" name="x_username" id="x_username" size="30" maxlength="50" value="<?php echo $pengguna->username->EditValue ?>"<?php echo $pengguna->username->EditAttributes() ?>>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_kode_otomatis_tingkat"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->kode_otomatis_tingkat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_kode_otomatis_tingkat" id="z_kode_otomatis_tingkat" value="LIKE"></td>
		<td<?php echo $pengguna->kode_otomatis_tingkat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<?php if (strval($pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue) == "") $pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue = CurrentUserID() ?>
<select id="x_kode_otomatis_tingkat" name="x_kode_otomatis_tingkat"<?php echo $pengguna->kode_otomatis_tingkat->EditAttributes() ?>>
<?php
if (is_array($pengguna->kode_otomatis_tingkat->EditValue)) {
	$arwrk = $pengguna->kode_otomatis_tingkat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<select id="x_kode_otomatis_tingkat" name="x_kode_otomatis_tingkat"<?php echo $pengguna->kode_otomatis_tingkat->EditAttributes() ?>>
<?php
if (is_array($pengguna->kode_otomatis_tingkat->EditValue)) {
	$arwrk = $pengguna->kode_otomatis_tingkat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_user_level"<?php echo $pengguna->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pengguna->user_level->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_level" id="z_user_level" value="="></td>
		<td<?php echo $pengguna->user_level->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $pengguna->user_level->ViewAttributes() ?>><?php echo $pengguna->user_level->EditValue ?></div>
<?php } else { ?>
<select id="x_user_level" name="x_user_level"<?php echo $pengguna->user_level->EditAttributes() ?>>
<?php
if (is_array($pengguna->user_level->EditValue)) {
	$arwrk = $pengguna->user_level->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pengguna->user_level->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
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
$pengguna_search->ShowPageFooter();
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
$pengguna_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cpengguna_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'pengguna';

	// Page object name
	var $PageObjName = 'pengguna_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pengguna;
		if ($pengguna->UseTokenInUrl) $PageUrl .= "t=" . $pengguna->TableVar . "&"; // Add page token
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
		global $objForm, $pengguna;
		if ($pengguna->UseTokenInUrl) {
			if ($objForm)
				return ($pengguna->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pengguna->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpengguna_search() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pengguna)
		if (!isset($GLOBALS["pengguna"])) {
			$GLOBALS["pengguna"] = new cpengguna();
			$GLOBALS["Table"] =& $GLOBALS["pengguna"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pengguna', TRUE);

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
		global $pengguna;

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
			$this->Page_Terminate("penggunalist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("penggunalist.php");
		}

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
		global $objForm, $Language, $gsSearchError, $pengguna;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$pengguna->CurrentAction = $objForm->GetValue("a_search");
			switch ($pengguna->CurrentAction) {
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
						$sSrchStr = $pengguna->UrlParm($sSrchStr);
						$this->Page_Terminate("penggunalist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$pengguna->RowType = EW_ROWTYPE_SEARCH;
		$pengguna->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $pengguna;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $pengguna->id); // id
	$this->BuildSearchUrl($sSrchUrl, $pengguna->nama_pengguna); // nama_pengguna
	$this->BuildSearchUrl($sSrchUrl, $pengguna->password); // password
	$this->BuildSearchUrl($sSrchUrl, $pengguna->username); // username
	$this->BuildSearchUrl($sSrchUrl, $pengguna->kode_otomatis_tingkat); // kode_otomatis_tingkat
	$this->BuildSearchUrl($sSrchUrl, $pengguna->user_level); // user_level
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
		global $objForm, $pengguna;

		// Load search values
		// id

		$pengguna->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$pengguna->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// nama_pengguna
		$pengguna->nama_pengguna->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_nama_pengguna"));
		$pengguna->nama_pengguna->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nama_pengguna");

		// password
		$pengguna->password->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_password"));
		$pengguna->password->AdvancedSearch->SearchOperator = $objForm->GetValue("z_password");

		// username
		$pengguna->username->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_username"));
		$pengguna->username->AdvancedSearch->SearchOperator = $objForm->GetValue("z_username");

		// kode_otomatis_tingkat
		$pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kode_otomatis_tingkat"));
		$pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_otomatis_tingkat");

		// user_level
		$pengguna->user_level->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_user_level"));
		$pengguna->user_level->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_level");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pengguna;

		// Initialize URLs
		// Call Row_Rendering event

		$pengguna->Row_Rendering();

		// Common render codes for all row types
		// id
		// nama_pengguna
		// password
		// username
		// kode_otomatis_tingkat
		// user_level

		if ($pengguna->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pengguna->id->ViewValue = $pengguna->id->CurrentValue;
			$pengguna->id->ViewCustomAttributes = "";

			// nama_pengguna
			$pengguna->nama_pengguna->ViewValue = $pengguna->nama_pengguna->CurrentValue;
			$pengguna->nama_pengguna->ViewCustomAttributes = "";

			// password
			$pengguna->password->ViewValue = $pengguna->password->CurrentValue;
			$pengguna->password->ViewCustomAttributes = "";

			// username
			$pengguna->username->ViewValue = $pengguna->username->CurrentValue;
			$pengguna->username->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			if (strval($pengguna->kode_otomatis_tingkat->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pengguna->kode_otomatis_tingkat->CurrentValue) . "'";
			$sSqlWrk = "SELECT `tingkat` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->kode_otomatis_tingkat->ViewValue = $rswrk->fields('tingkat');
					$rswrk->Close();
				} else {
					$pengguna->kode_otomatis_tingkat->ViewValue = $pengguna->kode_otomatis_tingkat->CurrentValue;
				}
			} else {
				$pengguna->kode_otomatis_tingkat->ViewValue = NULL;
			}
			$pengguna->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// user_level
			if ($Security->CanAdmin()) { // System admin
			if (strval($pengguna->user_level->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($pengguna->user_level->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->user_level->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$pengguna->user_level->ViewValue = $pengguna->user_level->CurrentValue;
				}
			} else {
				$pengguna->user_level->ViewValue = NULL;
			}
			} else {
				$pengguna->user_level->ViewValue = "********";
			}
			$pengguna->user_level->ViewCustomAttributes = "";

			// id
			$pengguna->id->LinkCustomAttributes = "";
			$pengguna->id->HrefValue = "";
			$pengguna->id->TooltipValue = "";

			// nama_pengguna
			$pengguna->nama_pengguna->LinkCustomAttributes = "";
			$pengguna->nama_pengguna->HrefValue = "";
			$pengguna->nama_pengguna->TooltipValue = "";

			// password
			$pengguna->password->LinkCustomAttributes = "";
			$pengguna->password->HrefValue = "";
			$pengguna->password->TooltipValue = "";

			// username
			$pengguna->username->LinkCustomAttributes = "";
			$pengguna->username->HrefValue = "";
			$pengguna->username->TooltipValue = "";

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$pengguna->kode_otomatis_tingkat->HrefValue = "";
			$pengguna->kode_otomatis_tingkat->TooltipValue = "";

			// user_level
			$pengguna->user_level->LinkCustomAttributes = "";
			$pengguna->user_level->HrefValue = "";
			$pengguna->user_level->TooltipValue = "";
		} elseif ($pengguna->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$pengguna->id->EditCustomAttributes = "";
			$pengguna->id->EditValue = ew_HtmlEncode($pengguna->id->AdvancedSearch->SearchValue);

			// nama_pengguna
			$pengguna->nama_pengguna->EditCustomAttributes = "";
			$pengguna->nama_pengguna->EditValue = ew_HtmlEncode($pengguna->nama_pengguna->AdvancedSearch->SearchValue);

			// password
			$pengguna->password->EditCustomAttributes = "";
			$pengguna->password->EditValue = ew_HtmlEncode($pengguna->password->AdvancedSearch->SearchValue);

			// username
			$pengguna->username->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sFilterWrk = $GLOBALS["pengguna"]->AddUserIDFilter("");
			$sSqlWrk = "SELECT `username`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `pengguna`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$pengguna->username->EditValue = $arwrk;
			} else {
			$pengguna->username->EditValue = ew_HtmlEncode($pengguna->username->AdvancedSearch->SearchValue);
			}

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `kode_otomatis`, `tingkat` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$pengguna->kode_otomatis_tingkat->EditValue = $arwrk;
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kode_otomatis`, `tingkat` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pengguna->kode_otomatis_tingkat->EditValue = $arwrk;
			}

			// user_level
			$pengguna->user_level->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$pengguna->user_level->EditValue = "********";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pengguna->user_level->EditValue = $arwrk;
			}
		}
		if ($pengguna->RowType == EW_ROWTYPE_ADD ||
			$pengguna->RowType == EW_ROWTYPE_EDIT ||
			$pengguna->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pengguna->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pengguna->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pengguna->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $pengguna;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($pengguna->id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $pengguna->id->FldErrMsg());
		}

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
		global $pengguna;
		$pengguna->id->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_id");
		$pengguna->nama_pengguna->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_nama_pengguna");
		$pengguna->password->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_password");
		$pengguna->username->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_username");
		$pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_kode_otomatis_tingkat");
		$pengguna->user_level->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_user_level");
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
