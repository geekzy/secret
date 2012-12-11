<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_transaksi2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_transaksi2_search = new cmaster_transaksi2_search();
$Page =& $master_transaksi2_search;

// Page init
$master_transaksi2_search->Page_Init();

// Page main
$master_transaksi2_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_transaksi2_search = new ew_Page("master_transaksi2_search");

// page properties
master_transaksi2_search.PageID = "search"; // page ID
master_transaksi2_search.FormID = "fmaster_transaksi2search"; // form ID
var EW_PAGE_ID = master_transaksi2_search.PageID; // for backward compatibility

// extend page with validate function for search
master_transaksi2_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_tanggal"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_transaksi2->tanggal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_saldo_debet"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_transaksi2->saldo_debet->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_saldo_kredit"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_transaksi2->saldo_kredit->FldErrMsg()) ?>");

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
master_transaksi2_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
master_transaksi2_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_transaksi2_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $master_transaksi2->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_transaksi2->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $master_transaksi2_search->ShowPageHeader(); ?>
<?php
$master_transaksi2_search->ShowMessage();
?>
<form name="fmaster_transaksi2search" id="fmaster_transaksi2search" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return master_transaksi2_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="master_transaksi2">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_penjelasan"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->penjelasan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_penjelasan" id="z_penjelasan" onchange="ew_SrchOprChanged('z_penjelasan')"><option value="="<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_transaksi2->penjelasan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_transaksi2->penjelasan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_penjelasan" id="x_penjelasan" size="30" maxlength="255" value="<?php echo $master_transaksi2->penjelasan->EditValue ?>"<?php echo $master_transaksi2->penjelasan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_penjelasan" name="btw1_penjelasan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_penjelasan" name="btw1_penjelasan">
<input type="text" name="y_penjelasan" id="y_penjelasan" size="30" maxlength="255" value="<?php echo $master_transaksi2->penjelasan->EditValue2 ?>"<?php echo $master_transaksi2->penjelasan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_tanggal"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->tanggal->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_tanggal" id="z_tanggal" onchange="ew_SrchOprChanged('z_tanggal')"><option value="="<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_transaksi2->tanggal->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_transaksi2->tanggal->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $master_transaksi2->tanggal->EditValue ?>"<?php echo $master_transaksi2->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_tanggal" name="cal_x_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_tanggal" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_tanggal" name="btw1_tanggal">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_tanggal" name="btw1_tanggal">
<input type="text" name="y_tanggal" id="y_tanggal" value="<?php echo $master_transaksi2->tanggal->EditValue2 ?>"<?php echo $master_transaksi2->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_tanggal" name="cal_y_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_tanggal" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_tipe_transaksi"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->tipe_transaksi->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_tipe_transaksi" id="z_tipe_transaksi" onchange="ew_SrchOprChanged('z_tipe_transaksi')"><option value="="<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_transaksi2->tipe_transaksi->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_tipe_transaksi" id="x_tipe_transaksi" size="30" maxlength="50" value="<?php echo $master_transaksi2->tipe_transaksi->EditValue ?>"<?php echo $master_transaksi2->tipe_transaksi->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_tipe_transaksi" name="btw1_tipe_transaksi">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_tipe_transaksi" name="btw1_tipe_transaksi">
<input type="text" name="y_tipe_transaksi" id="y_tipe_transaksi" size="30" maxlength="50" value="<?php echo $master_transaksi2->tipe_transaksi->EditValue2 ?>"<?php echo $master_transaksi2->tipe_transaksi->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_saldo_debet"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->saldo_debet->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_saldo_debet" id="z_saldo_debet" onchange="ew_SrchOprChanged('z_saldo_debet')"><option value="="<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_transaksi2->saldo_debet->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_saldo_debet" id="x_saldo_debet" size="30" value="<?php echo $master_transaksi2->saldo_debet->EditValue ?>"<?php echo $master_transaksi2->saldo_debet->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_saldo_debet" name="btw1_saldo_debet">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_saldo_debet" name="btw1_saldo_debet">
<input type="text" name="y_saldo_debet" id="y_saldo_debet" size="30" value="<?php echo $master_transaksi2->saldo_debet->EditValue2 ?>"<?php echo $master_transaksi2->saldo_debet->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_saldo_kredit"<?php echo $master_transaksi2->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_transaksi2->saldo_kredit->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_saldo_kredit" id="z_saldo_kredit" onchange="ew_SrchOprChanged('z_saldo_kredit')"><option value="="<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_transaksi2->saldo_kredit->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_saldo_kredit" id="x_saldo_kredit" size="30" value="<?php echo $master_transaksi2->saldo_kredit->EditValue ?>"<?php echo $master_transaksi2->saldo_kredit->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_saldo_kredit" name="btw1_saldo_kredit">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_saldo_kredit" name="btw1_saldo_kredit">
<input type="text" name="y_saldo_kredit" id="y_saldo_kredit" size="30" value="<?php echo $master_transaksi2->saldo_kredit->EditValue2 ?>"<?php echo $master_transaksi2->saldo_kredit->EditAttributes() ?>>
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
ew_SrchOprChanged('z_penjelasan');
ew_SrchOprChanged('z_tanggal');
ew_SrchOprChanged('z_tipe_transaksi');
ew_SrchOprChanged('z_saldo_debet');
ew_SrchOprChanged('z_saldo_kredit');

//-->
</script>
<?php
$master_transaksi2_search->ShowPageFooter();
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
$master_transaksi2_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_transaksi2_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'master_transaksi2';

	// Page object name
	var $PageObjName = 'master_transaksi2_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_transaksi2;
		if ($master_transaksi2->UseTokenInUrl) $PageUrl .= "t=" . $master_transaksi2->TableVar . "&"; // Add page token
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
		global $objForm, $master_transaksi2;
		if ($master_transaksi2->UseTokenInUrl) {
			if ($objForm)
				return ($master_transaksi2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_transaksi2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_transaksi2_search() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_transaksi2)
		if (!isset($GLOBALS["master_transaksi2"])) {
			$GLOBALS["master_transaksi2"] = new cmaster_transaksi2();
			$GLOBALS["Table"] =& $GLOBALS["master_transaksi2"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_transaksi2', TRUE);

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
		global $master_transaksi2;

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
			$this->Page_Terminate("master_transaksi2list.php");
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
		global $objForm, $Language, $gsSearchError, $master_transaksi2;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$master_transaksi2->CurrentAction = $objForm->GetValue("a_search");
			switch ($master_transaksi2->CurrentAction) {
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
						$sSrchStr = $master_transaksi2->UrlParm($sSrchStr);
						$this->Page_Terminate("master_transaksi2list.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$master_transaksi2->RowType = EW_ROWTYPE_SEARCH;
		$master_transaksi2->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $master_transaksi2;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $master_transaksi2->penjelasan); // penjelasan
	$this->BuildSearchUrl($sSrchUrl, $master_transaksi2->tanggal); // tanggal
	$this->BuildSearchUrl($sSrchUrl, $master_transaksi2->tipe_transaksi); // tipe_transaksi
	$this->BuildSearchUrl($sSrchUrl, $master_transaksi2->saldo_debet); // saldo_debet
	$this->BuildSearchUrl($sSrchUrl, $master_transaksi2->saldo_kredit); // saldo_kredit
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
		global $objForm, $master_transaksi2;

		// Load search values
		// penjelasan

		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_penjelasan"));
		$master_transaksi2->penjelasan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_penjelasan");
		$master_transaksi2->penjelasan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_penjelasan");
		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_penjelasan"));
		$master_transaksi2->penjelasan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_penjelasan");

		// tanggal
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tanggal"));
		$master_transaksi2->tanggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tanggal");
		$master_transaksi2->tanggal->AdvancedSearch->SearchCondition = $objForm->GetValue("v_tanggal");
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_tanggal"));
		$master_transaksi2->tanggal->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_tanggal");

		// tipe_transaksi
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tipe_transaksi"));
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tipe_transaksi");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchCondition = $objForm->GetValue("v_tipe_transaksi");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_tipe_transaksi"));
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_tipe_transaksi");

		// saldo_debet
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_saldo_debet"));
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator = $objForm->GetValue("z_saldo_debet");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchCondition = $objForm->GetValue("v_saldo_debet");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_saldo_debet"));
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_saldo_debet");

		// saldo_kredit
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_saldo_kredit"));
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_saldo_kredit");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchCondition = $objForm->GetValue("v_saldo_kredit");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_saldo_kredit"));
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_saldo_kredit");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_transaksi2;

		// Initialize URLs
		// Call Row_Rendering event

		$master_transaksi2->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// penjelasan
		// tanggal
		// tipe_transaksi
		// saldo_debet
		// saldo_kredit

		if ($master_transaksi2->RowType == EW_ROWTYPE_VIEW) { // View row

			// penjelasan
			$master_transaksi2->penjelasan->ViewValue = $master_transaksi2->penjelasan->CurrentValue;
			$master_transaksi2->penjelasan->ViewCustomAttributes = "";

			// tanggal
			$master_transaksi2->tanggal->ViewValue = $master_transaksi2->tanggal->CurrentValue;
			$master_transaksi2->tanggal->ViewValue = ew_FormatDateTime($master_transaksi2->tanggal->ViewValue, 7);
			$master_transaksi2->tanggal->ViewCustomAttributes = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->ViewValue = $master_transaksi2->tipe_transaksi->CurrentValue;
			$master_transaksi2->tipe_transaksi->ViewCustomAttributes = "";

			// saldo_debet
			$master_transaksi2->saldo_debet->ViewValue = $master_transaksi2->saldo_debet->CurrentValue;
			$master_transaksi2->saldo_debet->ViewCustomAttributes = "";

			// saldo_kredit
			$master_transaksi2->saldo_kredit->ViewValue = $master_transaksi2->saldo_kredit->CurrentValue;
			$master_transaksi2->saldo_kredit->ViewCustomAttributes = "";

			// penjelasan
			$master_transaksi2->penjelasan->LinkCustomAttributes = "";
			$master_transaksi2->penjelasan->HrefValue = "";
			$master_transaksi2->penjelasan->TooltipValue = "";

			// tanggal
			$master_transaksi2->tanggal->LinkCustomAttributes = "";
			$master_transaksi2->tanggal->HrefValue = "";
			$master_transaksi2->tanggal->TooltipValue = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->LinkCustomAttributes = "";
			$master_transaksi2->tipe_transaksi->HrefValue = "";
			$master_transaksi2->tipe_transaksi->TooltipValue = "";

			// saldo_debet
			$master_transaksi2->saldo_debet->LinkCustomAttributes = "";
			$master_transaksi2->saldo_debet->HrefValue = "";
			$master_transaksi2->saldo_debet->TooltipValue = "";

			// saldo_kredit
			$master_transaksi2->saldo_kredit->LinkCustomAttributes = "";
			$master_transaksi2->saldo_kredit->HrefValue = "";
			$master_transaksi2->saldo_kredit->TooltipValue = "";
		} elseif ($master_transaksi2->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// penjelasan
			$master_transaksi2->penjelasan->EditCustomAttributes = "";
			$master_transaksi2->penjelasan->EditValue = ew_HtmlEncode($master_transaksi2->penjelasan->AdvancedSearch->SearchValue);
			$master_transaksi2->penjelasan->EditCustomAttributes = "";
			$master_transaksi2->penjelasan->EditValue2 = ew_HtmlEncode($master_transaksi2->penjelasan->AdvancedSearch->SearchValue2);

			// tanggal
			$master_transaksi2->tanggal->EditCustomAttributes = "";
			$master_transaksi2->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_transaksi2->tanggal->AdvancedSearch->SearchValue, 7), 7));
			$master_transaksi2->tanggal->EditCustomAttributes = "";
			$master_transaksi2->tanggal->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_transaksi2->tanggal->AdvancedSearch->SearchValue2, 7), 7));

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->EditCustomAttributes = "";
			$master_transaksi2->tipe_transaksi->EditValue = ew_HtmlEncode($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue);
			$master_transaksi2->tipe_transaksi->EditCustomAttributes = "";
			$master_transaksi2->tipe_transaksi->EditValue2 = ew_HtmlEncode($master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue2);

			// saldo_debet
			$master_transaksi2->saldo_debet->EditCustomAttributes = "";
			$master_transaksi2->saldo_debet->EditValue = ew_HtmlEncode($master_transaksi2->saldo_debet->AdvancedSearch->SearchValue);
			$master_transaksi2->saldo_debet->EditCustomAttributes = "";
			$master_transaksi2->saldo_debet->EditValue2 = ew_HtmlEncode($master_transaksi2->saldo_debet->AdvancedSearch->SearchValue2);

			// saldo_kredit
			$master_transaksi2->saldo_kredit->EditCustomAttributes = "";
			$master_transaksi2->saldo_kredit->EditValue = ew_HtmlEncode($master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue);
			$master_transaksi2->saldo_kredit->EditCustomAttributes = "";
			$master_transaksi2->saldo_kredit->EditValue2 = ew_HtmlEncode($master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue2);
		}
		if ($master_transaksi2->RowType == EW_ROWTYPE_ADD ||
			$master_transaksi2->RowType == EW_ROWTYPE_EDIT ||
			$master_transaksi2->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$master_transaksi2->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($master_transaksi2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_transaksi2->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $master_transaksi2;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($master_transaksi2->tanggal->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_transaksi2->tanggal->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_transaksi2->tanggal->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_transaksi2->tanggal->FldErrMsg());
		}
		if (!ew_CheckNumber($master_transaksi2->saldo_debet->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_transaksi2->saldo_debet->FldErrMsg());
		}
		if (!ew_CheckNumber($master_transaksi2->saldo_debet->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_transaksi2->saldo_debet->FldErrMsg());
		}
		if (!ew_CheckNumber($master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_transaksi2->saldo_kredit->FldErrMsg());
		}
		if (!ew_CheckNumber($master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_transaksi2->saldo_kredit->FldErrMsg());
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
		global $master_transaksi2;
		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_penjelasan");
		$master_transaksi2->penjelasan->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_penjelasan");
		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_penjelasan");
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_tanggal");
		$master_transaksi2->tanggal->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_tanggal");
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_tanggal");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_tipe_transaksi");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_tipe_transaksi");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_tipe_transaksi");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_saldo_debet");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_saldo_debet");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_saldo_debet");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_saldo_kredit");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_saldo_kredit");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_saldo_kredit");
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
