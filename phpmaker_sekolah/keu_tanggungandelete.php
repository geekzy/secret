<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_tanggungan_delete = new ckeu_tanggungan_delete();
$Page =& $keu_tanggungan_delete;

// Page init
$keu_tanggungan_delete->Page_Init();

// Page main
$keu_tanggungan_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_tanggungan_delete = new ew_Page("keu_tanggungan_delete");

// page properties
keu_tanggungan_delete.PageID = "delete"; // page ID
keu_tanggungan_delete.FormID = "fkeu_tanggungandelete"; // form ID
var EW_PAGE_ID = keu_tanggungan_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_tanggungan_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_tanggungan_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_tanggungan_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($keu_tanggungan_delete->Recordset = $keu_tanggungan_delete->LoadRecordset())
	$keu_tanggungan_deleteTotalRecs = $keu_tanggungan_delete->Recordset->RecordCount(); // Get record count
if ($keu_tanggungan_deleteTotalRecs <= 0) { // No record found, exit
	if ($keu_tanggungan_delete->Recordset)
		$keu_tanggungan_delete->Recordset->Close();
	$keu_tanggungan_delete->Page_Terminate("keu_tanggunganlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_tanggungan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_tanggungan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_tanggungan_delete->ShowPageHeader(); ?>
<?php
$keu_tanggungan_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="keu_tanggungan">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($keu_tanggungan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $keu_tanggungan->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $keu_tanggungan->kode_otomatis->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->identitas->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->diskon_sosial->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->diskon_waktu->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->diskon_prestasi->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->diskon_internal->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->diskon_lain_lain->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->nilai_tanggungan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_tanggungan->tanggal_rencana_bayar->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$keu_tanggungan_delete->RecCnt = 0;
$i = 0;
while (!$keu_tanggungan_delete->Recordset->EOF) {
	$keu_tanggungan_delete->RecCnt++;

	// Set row properties
	$keu_tanggungan->ResetAttrs();
	$keu_tanggungan->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$keu_tanggungan_delete->LoadRowValues($keu_tanggungan_delete->Recordset);

	// Render row
	$keu_tanggungan_delete->RenderRow();
?>
	<tr<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td<?php echo $keu_tanggungan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->identitas->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->identitas->ViewAttributes() ?>><?php echo $keu_tanggungan->identitas->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->diskon_sosial->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_sosial->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->diskon_waktu->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_waktu->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_prestasi->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->diskon_internal->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_internal->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_internal->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->diskon_lain_lain->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_lain_lain->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->nilai_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->nilai_tanggungan->ViewAttributes() ?>><?php echo $keu_tanggungan->nilai_tanggungan->ListViewValue() ?></div></td>
		<td<?php echo $keu_tanggungan->tanggal_rencana_bayar->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_tanggungan->tanggal_rencana_bayar->ListViewValue() ?></div></td>
	</tr>
<?php
	$keu_tanggungan_delete->Recordset->MoveNext();
}
$keu_tanggungan_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$keu_tanggungan_delete->ShowPageFooter();
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
$keu_tanggungan_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_tanggungan_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'keu_tanggungan';

	// Page object name
	var $PageObjName = 'keu_tanggungan_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_tanggungan_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_tanggungan)
		if (!isset($GLOBALS["keu_tanggungan"])) {
			$GLOBALS["keu_tanggungan"] = new ckeu_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_tanggungan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_tanggungan', TRUE);

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
		global $keu_tanggungan;

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
			$this->Page_Terminate("keu_tanggunganlist.php");
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
		global $Language, $keu_tanggungan;

		// Load key parameters
		$this->RecKeys = $keu_tanggungan->GetRecordKeys(); // Load record keys
		$sFilter = $keu_tanggungan->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("keu_tanggunganlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in keu_tanggungan class, keu_tanggunganinfo.php

		$keu_tanggungan->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$keu_tanggungan->CurrentAction = $_POST["a_delete"];
		} else {
			$keu_tanggungan->CurrentAction = "I"; // Display record
		}
		switch ($keu_tanggungan->CurrentAction) {
			case "D": // Delete
				$keu_tanggungan->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($keu_tanggungan->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_tanggungan;

		// Call Recordset Selecting event
		$keu_tanggungan->Recordset_Selecting($keu_tanggungan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_tanggungan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_tanggungan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_tanggungan;
		$sFilter = $keu_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_tanggungan->SQL();
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
		global $conn, $keu_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_tanggungan->Row_Selected($row);
		$keu_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_tanggungan->kode_otomatis_master_tanggungan->setDbValue($rs->fields('kode_otomatis_master_tanggungan'));
		$keu_tanggungan->identitas->setDbValue($rs->fields('identitas'));
		$keu_tanggungan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_tanggungan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_tanggungan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_tanggungan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_tanggungan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_tanggungan->nilai_tanggungan->setDbValue($rs->fields('nilai_tanggungan'));
		$keu_tanggungan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_tanggungan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// kode_otomatis_master_tanggungan
		// identitas
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan
		// tanggal_rencana_bayar

		if ($keu_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->ViewValue = $keu_tanggungan->kode_otomatis->CurrentValue;
			$keu_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewValue = $keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue;
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewCustomAttributes = "";

			// identitas
			$keu_tanggungan->identitas->ViewValue = $keu_tanggungan->identitas->CurrentValue;
			$keu_tanggungan->identitas->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->ViewValue = $keu_tanggungan->diskon_sosial->CurrentValue;
			$keu_tanggungan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->ViewValue = $keu_tanggungan->diskon_waktu->CurrentValue;
			$keu_tanggungan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->ViewValue = $keu_tanggungan->diskon_prestasi->CurrentValue;
			$keu_tanggungan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->ViewValue = $keu_tanggungan->diskon_internal->CurrentValue;
			$keu_tanggungan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->ViewValue = $keu_tanggungan->diskon_lain_lain->CurrentValue;
			$keu_tanggungan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->ViewValue = $keu_tanggungan->nilai_tanggungan->CurrentValue;
			$keu_tanggungan->nilai_tanggungan->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = $keu_tanggungan->tanggal_rencana_bayar->CurrentValue;
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_tanggungan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_tanggungan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis->HrefValue = "";
			$keu_tanggungan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->HrefValue = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->TooltipValue = "";

			// identitas
			$keu_tanggungan->identitas->LinkCustomAttributes = "";
			$keu_tanggungan->identitas->HrefValue = "";
			$keu_tanggungan->identitas->TooltipValue = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_sosial->HrefValue = "";
			$keu_tanggungan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_waktu->HrefValue = "";
			$keu_tanggungan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_prestasi->HrefValue = "";
			$keu_tanggungan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_internal->HrefValue = "";
			$keu_tanggungan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_lain_lain->HrefValue = "";
			$keu_tanggungan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->nilai_tanggungan->HrefValue = "";
			$keu_tanggungan->nilai_tanggungan->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_tanggungan->tanggal_rencana_bayar->HrefValue = "";
			$keu_tanggungan->tanggal_rencana_bayar->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_tanggungan->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $keu_tanggungan;
		$DeleteRows = TRUE;
		$sSql = $keu_tanggungan->SQL();
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
				$DeleteRows = $keu_tanggungan->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($keu_tanggungan->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($keu_tanggungan->CancelMessage <> "") {
				$this->setFailureMessage($keu_tanggungan->CancelMessage);
				$keu_tanggungan->CancelMessage = "";
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
				$keu_tanggungan->Row_Deleted($row);
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
