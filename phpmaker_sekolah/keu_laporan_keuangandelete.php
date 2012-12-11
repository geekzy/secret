<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_laporan_keuangan_delete = new ckeu_laporan_keuangan_delete();
$Page =& $keu_laporan_keuangan_delete;

// Page init
$keu_laporan_keuangan_delete->Page_Init();

// Page main
$keu_laporan_keuangan_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_laporan_keuangan_delete = new ew_Page("keu_laporan_keuangan_delete");

// page properties
keu_laporan_keuangan_delete.PageID = "delete"; // page ID
keu_laporan_keuangan_delete.FormID = "fkeu_laporan_keuangandelete"; // form ID
var EW_PAGE_ID = keu_laporan_keuangan_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_laporan_keuangan_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_laporan_keuangan_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_laporan_keuangan_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
keu_laporan_keuangan_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
keu_laporan_keuangan_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($keu_laporan_keuangan_delete->Recordset = $keu_laporan_keuangan_delete->LoadRecordset())
	$keu_laporan_keuangan_deleteTotalRecs = $keu_laporan_keuangan_delete->Recordset->RecordCount(); // Get record count
if ($keu_laporan_keuangan_deleteTotalRecs <= 0) { // No record found, exit
	if ($keu_laporan_keuangan_delete->Recordset)
		$keu_laporan_keuangan_delete->Recordset->Close();
	$keu_laporan_keuangan_delete->Page_Terminate("keu_laporan_keuanganlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $keu_laporan_keuangan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_laporan_keuangan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_laporan_keuangan_delete->ShowPageHeader(); ?>
<?php
$keu_laporan_keuangan_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="keu_laporan_keuangan">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($keu_laporan_keuangan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $keu_laporan_keuangan->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $keu_laporan_keuangan->identitas->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->A_nama_lengkap->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->nama_biaya->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->diskon_sosial->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->diskon_waktu->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->diskon_prestasi->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->diskon_internal->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->diskon_lain_lain->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->jum_cicilan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$keu_laporan_keuangan_delete->RecCnt = 0;
$i = 0;
while (!$keu_laporan_keuangan_delete->Recordset->EOF) {
	$keu_laporan_keuangan_delete->RecCnt++;

	// Set row properties
	$keu_laporan_keuangan->ResetAttrs();
	$keu_laporan_keuangan->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$keu_laporan_keuangan_delete->LoadRowValues($keu_laporan_keuangan_delete->Recordset);

	// Render row
	$keu_laporan_keuangan_delete->RenderRow();
?>
	<tr<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td<?php echo $keu_laporan_keuangan->identitas->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->identitas->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->identitas->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->A_nama_lengkap->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->A_nama_lengkap->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->A_nama_lengkap->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->nama_biaya->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nama_biaya->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nama_biaya->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->diskon_sosial->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_sosial->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->diskon_waktu->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_waktu->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_prestasi->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->diskon_internal->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_internal->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_internal->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->diskon_lain_lain->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_lain_lain->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->jum_cicilan->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->jum_cicilan->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->jum_cicilan->ListViewValue() ?></div></td>
		<td<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->ListViewValue() ?></div></td>
	</tr>
<?php
	$keu_laporan_keuangan_delete->Recordset->MoveNext();
}
$keu_laporan_keuangan_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$keu_laporan_keuangan_delete->ShowPageFooter();
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
$keu_laporan_keuangan_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_laporan_keuangan_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'keu_laporan_keuangan';

	// Page object name
	var $PageObjName = 'keu_laporan_keuangan_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_laporan_keuangan;
		if ($keu_laporan_keuangan->UseTokenInUrl) $PageUrl .= "t=" . $keu_laporan_keuangan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_laporan_keuangan;
		if ($keu_laporan_keuangan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_laporan_keuangan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_laporan_keuangan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_laporan_keuangan_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS["keu_laporan_keuangan"])) {
			$GLOBALS["keu_laporan_keuangan"] = new ckeu_laporan_keuangan();
			$GLOBALS["Table"] =& $GLOBALS["keu_laporan_keuangan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_laporan_keuangan', TRUE);

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
		global $keu_laporan_keuangan;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("keu_laporan_keuanganlist.php");
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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $keu_laporan_keuangan;

		// Load key parameters
		$this->RecKeys = $keu_laporan_keuangan->GetRecordKeys(); // Load record keys
		$sFilter = $keu_laporan_keuangan->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("keu_laporan_keuanganlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in keu_laporan_keuangan class, keu_laporan_keuanganinfo.php

		$keu_laporan_keuangan->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$keu_laporan_keuangan->CurrentAction = $_POST["a_delete"];
		} else {
			$keu_laporan_keuangan->CurrentAction = "D"; // Delete record directly
		}
		switch ($keu_laporan_keuangan->CurrentAction) {
			case "D": // Delete
				$keu_laporan_keuangan->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($keu_laporan_keuangan->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_laporan_keuangan;

		// Call Recordset Selecting event
		$keu_laporan_keuangan->Recordset_Selecting($keu_laporan_keuangan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_laporan_keuangan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_laporan_keuangan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_laporan_keuangan;
		$sFilter = $keu_laporan_keuangan->KeyFilter();

		// Call Row Selecting event
		$keu_laporan_keuangan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_laporan_keuangan->CurrentFilter = $sFilter;
		$sSql = $keu_laporan_keuangan->SQL();
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
		global $conn, $keu_laporan_keuangan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_laporan_keuangan->Row_Selected($row);
		$keu_laporan_keuangan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_laporan_keuangan->identitas->setDbValue($rs->fields('identitas'));
		$keu_laporan_keuangan->A_nama_lengkap->setDbValue($rs->fields('A_nama_lengkap'));
		$keu_laporan_keuangan->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$keu_laporan_keuangan->nilai_tanggungan_bruto->setDbValue($rs->fields('nilai_tanggungan_bruto'));
		$keu_laporan_keuangan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
		$keu_laporan_keuangan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_laporan_keuangan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_laporan_keuangan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_laporan_keuangan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_laporan_keuangan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_laporan_keuangan->nilai_tanggungan_netto->setDbValue($rs->fields('nilai_tanggungan_netto'));
		$keu_laporan_keuangan->jum_cicilan->setDbValue($rs->fields('jum_cicilan'));
		$keu_laporan_keuangan->kekurangan_pembayaran->setDbValue($rs->fields('kekurangan_pembayaran'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_laporan_keuangan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_laporan_keuangan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// identitas
		// A_nama_lengkap
		// nama_biaya
		// nilai_tanggungan_bruto
		// tanggal_rencana_bayar
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan_netto
		// jum_cicilan
		// kekurangan_pembayaran

		if ($keu_laporan_keuangan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_laporan_keuangan->kode_otomatis->ViewValue = $keu_laporan_keuangan->kode_otomatis->CurrentValue;
			$keu_laporan_keuangan->kode_otomatis->ViewCustomAttributes = "";

			// identitas
			$keu_laporan_keuangan->identitas->ViewValue = $keu_laporan_keuangan->identitas->CurrentValue;
			$keu_laporan_keuangan->identitas->ViewCustomAttributes = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->ViewValue = $keu_laporan_keuangan->A_nama_lengkap->CurrentValue;
			$keu_laporan_keuangan->A_nama_lengkap->ViewCustomAttributes = "";

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->ViewValue = $keu_laporan_keuangan->nama_biaya->CurrentValue;
			$keu_laporan_keuangan->nama_biaya->ViewCustomAttributes = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->ViewValue = $keu_laporan_keuangan->nilai_tanggungan_bruto->CurrentValue;
			$keu_laporan_keuangan->nilai_tanggungan_bruto->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue = $keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue;
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->ViewValue = $keu_laporan_keuangan->diskon_sosial->CurrentValue;
			$keu_laporan_keuangan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->ViewValue = $keu_laporan_keuangan->diskon_waktu->CurrentValue;
			$keu_laporan_keuangan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->ViewValue = $keu_laporan_keuangan->diskon_prestasi->CurrentValue;
			$keu_laporan_keuangan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->ViewValue = $keu_laporan_keuangan->diskon_internal->CurrentValue;
			$keu_laporan_keuangan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->ViewValue = $keu_laporan_keuangan->diskon_lain_lain->CurrentValue;
			$keu_laporan_keuangan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->ViewValue = $keu_laporan_keuangan->nilai_tanggungan_netto->CurrentValue;
			$keu_laporan_keuangan->nilai_tanggungan_netto->ViewCustomAttributes = "";

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->ViewValue = $keu_laporan_keuangan->jum_cicilan->CurrentValue;
			$keu_laporan_keuangan->jum_cicilan->ViewCustomAttributes = "";

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->ViewValue = $keu_laporan_keuangan->kekurangan_pembayaran->CurrentValue;
			$keu_laporan_keuangan->kekurangan_pembayaran->ViewCustomAttributes = "";

			// identitas
			$keu_laporan_keuangan->identitas->LinkCustomAttributes = "";
			$keu_laporan_keuangan->identitas->HrefValue = "";
			$keu_laporan_keuangan->identitas->TooltipValue = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->LinkCustomAttributes = "";
			$keu_laporan_keuangan->A_nama_lengkap->HrefValue = "";
			$keu_laporan_keuangan->A_nama_lengkap->TooltipValue = "";

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nama_biaya->HrefValue = "";
			$keu_laporan_keuangan->nama_biaya->TooltipValue = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->HrefValue = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->HrefValue = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->TooltipValue = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_sosial->HrefValue = "";
			$keu_laporan_keuangan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_waktu->HrefValue = "";
			$keu_laporan_keuangan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_prestasi->HrefValue = "";
			$keu_laporan_keuangan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_internal->HrefValue = "";
			$keu_laporan_keuangan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_lain_lain->HrefValue = "";
			$keu_laporan_keuangan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->HrefValue = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->TooltipValue = "";

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->LinkCustomAttributes = "";
			$keu_laporan_keuangan->jum_cicilan->HrefValue = "";
			$keu_laporan_keuangan->jum_cicilan->TooltipValue = "";

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->LinkCustomAttributes = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->HrefValue = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_laporan_keuangan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_laporan_keuangan->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $keu_laporan_keuangan;
		$DeleteRows = TRUE;
		$sSql = $keu_laporan_keuangan->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $keu_laporan_keuangan->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['kode_otomatis'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($keu_laporan_keuangan->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($keu_laporan_keuangan->CancelMessage <> "") {
				$this->setFailureMessage($keu_laporan_keuangan->CancelMessage);
				$keu_laporan_keuangan->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$keu_laporan_keuangan->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
