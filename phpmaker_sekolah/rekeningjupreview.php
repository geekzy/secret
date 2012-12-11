<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "rekeningjuinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "master_transaksi2info.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE, 'utf-8') ?>
<?php

// Create page object
$rekeningju_preview = new crekeningju_preview();
$Page =& $rekeningju_preview;

// Page init
$rekeningju_preview->Page_Init();

// Page main
$rekeningju_preview->Page_Main();
?>
<link href="phpcss/phpmaker_sekolah.css" rel="stylesheet" type="text/css">
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo  $rekeningju->TableCaption() ?>&nbsp;
<?php if ($rekeningju_preview->TotalRecs > 0) { ?>
(<?php echo $rekeningju_preview->TotalRecs ?>&nbsp;<?php echo $Language->Phrase("Record") ?>)
<?php } else { ?>
(<?php echo $Language->Phrase("NoRecord") ?>)
<?php } ?>
</p>
<?php $rekeningju_preview->ShowPageHeader(); ?>
<?php if ($rekeningju_preview->TotalRecs > 0) { ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="ewDetailsPreviewTable" name="ewDetailsPreviewTable" cellspacing="0" class="ewTable ewTableSeparate">
	<thead><!-- Table header -->
		<tr class="ewTableHeader">
<?php if ($rekeningju->apakah_original->Visible) { // NoRek ?>
			<td valign="top"><?php echo $rekeningju->NoRek->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // Keterangan ?>
			<td valign="top"><?php echo $rekeningju->Keterangan->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // debet ?>
			<td valign="top"><?php echo $rekeningju->debet->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // kredit ?>
			<td valign="top"><?php echo $rekeningju->kredit->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // kode_bukti ?>
			<td valign="top"><?php echo $rekeningju->kode_bukti->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // tanggal ?>
			<td valign="top"><?php echo $rekeningju->tanggal->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // tanggal_nota ?>
			<td valign="top"><?php echo $rekeningju->tanggal_nota->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // kode_otomatis ?>
			<td valign="top" style="white-space: nowrap;"><?php echo $rekeningju->kode_otomatis->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // kode_otomatis_tingkat ?>
			<td valign="top" style="white-space: nowrap;"><?php echo $rekeningju->kode_otomatis_tingkat->FldCaption() ?></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
			<td valign="top"><?php echo $rekeningju->apakah_original->FldCaption() ?></td>
<?php } ?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$rekeningju_preview->RecCount = 0;
while ($rekeningju_preview->Recordset && !$rekeningju_preview->Recordset->EOF) {

	// Init row class and style
	$rekeningju_preview->RecCount++;
	$rekeningju->CssClass = "";
	$rekeningju->CssStyle = "";
	$rekeningju->LoadListRowValues($rekeningju_preview->Recordset);

	// Render row
	$rekeningju->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$rekeningju->RenderListRow();
?>
	<tr<?php echo $rekeningju->RowAttributes() ?>>
<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
		<!-- NoRek -->
		<td<?php echo $rekeningju->NoRek->CellAttributes() ?>>
<div<?php echo $rekeningju->NoRek->ViewAttributes() ?>><?php echo $rekeningju->NoRek->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
		<!-- Keterangan -->
		<td<?php echo $rekeningju->Keterangan->CellAttributes() ?>>
<div<?php echo $rekeningju->Keterangan->ViewAttributes() ?>><?php echo $rekeningju->Keterangan->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->debet->Visible) { // debet ?>
		<!-- debet -->
		<td<?php echo $rekeningju->debet->CellAttributes() ?>>
<div<?php echo $rekeningju->debet->ViewAttributes() ?>><?php echo $rekeningju->debet->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->kredit->Visible) { // kredit ?>
		<!-- kredit -->
		<td<?php echo $rekeningju->kredit->CellAttributes() ?>>
<div<?php echo $rekeningju->kredit->ViewAttributes() ?>><?php echo $rekeningju->kredit->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
		<!-- kode_bukti -->
		<td<?php echo $rekeningju->kode_bukti->CellAttributes() ?>>
<div<?php echo $rekeningju->kode_bukti->ViewAttributes() ?>><?php echo $rekeningju->kode_bukti->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
		<!-- tanggal -->
		<td<?php echo $rekeningju->tanggal->CellAttributes() ?>>
<div<?php echo $rekeningju->tanggal->ViewAttributes() ?>><?php echo $rekeningju->tanggal->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
		<!-- tanggal_nota -->
		<td<?php echo $rekeningju->tanggal_nota->CellAttributes() ?>>
<div<?php echo $rekeningju->tanggal_nota->ViewAttributes() ?>><?php echo $rekeningju->tanggal_nota->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
		<!-- kode_otomatis -->
		<td<?php echo $rekeningju->kode_otomatis->CellAttributes() ?>>
<div<?php echo $rekeningju->kode_otomatis->ViewAttributes() ?>><?php echo $rekeningju->kode_otomatis->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<!-- kode_otomatis_tingkat -->
		<td<?php echo $rekeningju->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $rekeningju->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $rekeningju->kode_otomatis_tingkat->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
		<!-- apakah_original -->
		<td<?php echo $rekeningju->apakah_original->CellAttributes() ?>>
<div<?php echo $rekeningju->apakah_original->ViewAttributes() ?>><?php echo $rekeningju->apakah_original->ListViewValue() ?></div></td>
<?php } ?>
	</tr>
<?php
	$rekeningju_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table>
</div>
</td></tr></table>
<?php
$rekeningju_preview->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
if ($rekeningju_preview->Recordset)
	$rekeningju_preview->Recordset->Close();
}
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
<?php
$rekeningju_preview->Page_Terminate();
?>
<?php

//
// Page class
//
class crekeningju_preview {

	// Page ID
	var $PageID = 'preview';

	// Table name
	var $TableName = 'rekeningju';

	// Page object name
	var $PageObjName = 'rekeningju_preview';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rekeningju;
		if ($rekeningju->UseTokenInUrl) $PageUrl .= "t=" . $rekeningju->TableVar . "&"; // Add page token
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
		global $objForm, $rekeningju;
		if ($rekeningju->UseTokenInUrl) {
			if ($objForm)
				return ($rekeningju->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rekeningju->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crekeningju_preview() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (rekeningju)
		if (!isset($GLOBALS["rekeningju"])) {
			$GLOBALS["rekeningju"] = new crekeningju();
			$GLOBALS["Table"] =& $GLOBALS["rekeningju"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (master_transaksi2)
		if (!isset($GLOBALS['master_transaksi2'])) $GLOBALS['master_transaksi2'] = new cmaster_transaksi2();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'preview', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rekeningju', TRUE);

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
		global $rekeningju;

		// Security
		$Security = new cAdvancedSecurity();
		if (is_null($Security)) $Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel('rekeningju');
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			echo $Language->Phrase("NoPermission");
			exit();
		}
		if (!$Security->CanList()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $Recordset;
	var $TotalRecs;
	var $RecCount;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $rekeningju;

		// Load filter
		$qs = new cQueryString();
		$filter = $qs->GetValue("f");
		$filter = TEAdecrypt($filter, EW_RANDOM_KEY);
		if ($filter == "") $filter = "0=1";

		// Load recordset
		// Call Recordset Selecting event

		$rekeningju->Recordset_Selecting($filter);
		$this->Recordset = $rekeningju->LoadRs($filter);
		$this->TotalRecs = ($this->Recordset) ? $this->Recordset->RecordCount() : 0;

		// Call Recordset Selected event
		$rekeningju->Recordset_Selected($this->Recordset);
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
}
?>
