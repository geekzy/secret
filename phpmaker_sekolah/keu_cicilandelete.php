<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_cicilaninfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_cicilan_delete = new ckeu_cicilan_delete();
$Page =& $keu_cicilan_delete;

// Page init
$keu_cicilan_delete->Page_Init();

// Page main
$keu_cicilan_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_cicilan_delete = new ew_Page("keu_cicilan_delete");

// page properties
keu_cicilan_delete.PageID = "delete"; // page ID
keu_cicilan_delete.FormID = "fkeu_cicilandelete"; // form ID
var EW_PAGE_ID = keu_cicilan_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_cicilan_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_cicilan_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_cicilan_delete.ValidateRequired = false; // no JavaScript validation
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
if ($keu_cicilan_delete->Recordset = $keu_cicilan_delete->LoadRecordset())
	$keu_cicilan_deleteTotalRecs = $keu_cicilan_delete->Recordset->RecordCount(); // Get record count
if ($keu_cicilan_deleteTotalRecs <= 0) { // No record found, exit
	if ($keu_cicilan_delete->Recordset)
		$keu_cicilan_delete->Recordset->Close();
	$keu_cicilan_delete->Page_Terminate("keu_cicilanlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_cicilan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_cicilan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_cicilan_delete->ShowPageHeader(); ?>
<?php
$keu_cicilan_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="keu_cicilan">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($keu_cicilan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $keu_cicilan->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $keu_cicilan->cicilan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$keu_cicilan_delete->RecCnt = 0;
$i = 0;
while (!$keu_cicilan_delete->Recordset->EOF) {
	$keu_cicilan_delete->RecCnt++;

	// Set row properties
	$keu_cicilan->ResetAttrs();
	$keu_cicilan->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$keu_cicilan_delete->LoadRowValues($keu_cicilan_delete->Recordset);

	// Render row
	$keu_cicilan_delete->RenderRow();
?>
	<tr<?php echo $keu_cicilan->RowAttributes() ?>>
		<td<?php echo $keu_cicilan->cicilan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->cicilan->ViewAttributes() ?>><?php echo $keu_cicilan->cicilan->ListViewValue() ?></div></td>
		<td<?php echo $keu_cicilan->tanggal_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_cicilan->tanggal_pembayaran->ViewAttributes() ?>><?php echo $keu_cicilan->tanggal_pembayaran->ListViewValue() ?></div></td>
		<td<?php echo $keu_cicilan->rek_kas->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_kas->ViewAttributes() ?>><?php echo $keu_cicilan->rek_kas->ListViewValue() ?></div></td>
		<td<?php echo $keu_cicilan->rek_pendapatan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_cicilan->rek_pendapatan->ListViewValue() ?></div></td>
		<td<?php echo $keu_cicilan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis->ListViewValue() ?></div></td>
		<td<?php echo $keu_cicilan->kode_otomatis_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_tanggungan->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_tanggungan->ListViewValue() ?></div></td>
		<td<?php echo $keu_cicilan->kode_otomatis_master->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_master->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_master->ListViewValue() ?></div></td>
	</tr>
<?php
	$keu_cicilan_delete->Recordset->MoveNext();
}
$keu_cicilan_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$keu_cicilan_delete->ShowPageFooter();
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
$keu_cicilan_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_cicilan_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'keu_cicilan';

	// Page object name
	var $PageObjName = 'keu_cicilan_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) $PageUrl .= "t=" . $keu_cicilan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_cicilan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_cicilan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_cicilan_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_cicilan)
		if (!isset($GLOBALS["keu_cicilan"])) {
			$GLOBALS["keu_cicilan"] = new ckeu_cicilan();
			$GLOBALS["Table"] =& $GLOBALS["keu_cicilan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS['keu_laporan_keuangan'])) $GLOBALS['keu_laporan_keuangan'] = new ckeu_laporan_keuangan();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_cicilan', TRUE);

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
		global $keu_cicilan;

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
			$this->Page_Terminate("keu_cicilanlist.php");
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
		global $Language, $keu_cicilan;

		// Load key parameters
		$this->RecKeys = $keu_cicilan->GetRecordKeys(); // Load record keys
		$sFilter = $keu_cicilan->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("keu_cicilanlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in keu_cicilan class, keu_cicilaninfo.php

		$keu_cicilan->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$keu_cicilan->CurrentAction = $_POST["a_delete"];
		} else {
			$keu_cicilan->CurrentAction = "I"; // Display record
		}
		switch ($keu_cicilan->CurrentAction) {
			case "D": // Delete
				$keu_cicilan->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($keu_cicilan->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_cicilan;

		// Call Recordset Selecting event
		$keu_cicilan->Recordset_Selecting($keu_cicilan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_cicilan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_cicilan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_cicilan;
		$sFilter = $keu_cicilan->KeyFilter();

		// Call Row Selecting event
		$keu_cicilan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_cicilan->CurrentFilter = $sFilter;
		$sSql = $keu_cicilan->SQL();
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
		global $conn, $keu_cicilan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_cicilan->Row_Selected($row);
		$keu_cicilan->cicilan->setDbValue($rs->fields('cicilan'));
		$keu_cicilan->tanggal_pembayaran->setDbValue($rs->fields('tanggal_pembayaran'));
		$keu_cicilan->rek_kas->setDbValue($rs->fields('rek_kas'));
		$keu_cicilan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_cicilan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_cicilan->kode_otomatis_tanggungan->setDbValue($rs->fields('kode_otomatis_tanggungan'));
		$keu_cicilan->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_cicilan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_cicilan->Row_Rendering();

		// Common render codes for all row types
		// cicilan
		// tanggal_pembayaran
		// rek_kas
		// rek_pendapatan
		// kode_otomatis
		// kode_otomatis_tanggungan
		// kode_otomatis_master

		if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View row

			// cicilan
			$keu_cicilan->cicilan->ViewValue = $keu_cicilan->cicilan->CurrentValue;
			$keu_cicilan->cicilan->ViewCustomAttributes = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->ViewValue = $keu_cicilan->tanggal_pembayaran->CurrentValue;
			$keu_cicilan->tanggal_pembayaran->ViewValue = ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->ViewValue, 7);
			$keu_cicilan->tanggal_pembayaran->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_cicilan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='1' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_kas) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_kas->ViewValue = $keu_cicilan->rek_kas->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_kas->ViewValue = NULL;
			}
			$keu_cicilan->rek_kas->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_cicilan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='4' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_pendapatan->ViewValue = $keu_cicilan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_cicilan->rek_pendapatan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->ViewValue = $keu_cicilan->kode_otomatis->CurrentValue;
			$keu_cicilan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->ViewValue = $keu_cicilan->kode_otomatis_master->CurrentValue;
			$keu_cicilan->kode_otomatis_master->ViewCustomAttributes = "";

			// cicilan
			$keu_cicilan->cicilan->LinkCustomAttributes = "";
			$keu_cicilan->cicilan->HrefValue = "";
			$keu_cicilan->cicilan->TooltipValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->LinkCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";
			$keu_cicilan->tanggal_pembayaran->TooltipValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->LinkCustomAttributes = "";
			$keu_cicilan->rek_kas->HrefValue = "";
			$keu_cicilan->rek_kas->TooltipValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_cicilan->rek_pendapatan->HrefValue = "";
			$keu_cicilan->rek_pendapatan->TooltipValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis->HrefValue = "";
			$keu_cicilan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";
			$keu_cicilan->kode_otomatis_tanggungan->TooltipValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
			$keu_cicilan->kode_otomatis_master->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_cicilan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_cicilan->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $keu_cicilan;
		$DeleteRows = TRUE;
		$sSql = $keu_cicilan->SQL();
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
				$DeleteRows = $keu_cicilan->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($keu_cicilan->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($keu_cicilan->CancelMessage <> "") {
				$this->setFailureMessage($keu_cicilan->CancelMessage);
				$keu_cicilan->CancelMessage = "";
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
				$keu_cicilan->Row_Deleted($row);
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
