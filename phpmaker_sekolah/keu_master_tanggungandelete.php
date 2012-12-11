<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_master_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_master_tanggungan_delete = new ckeu_master_tanggungan_delete();
$Page =& $keu_master_tanggungan_delete;

// Page init
$keu_master_tanggungan_delete->Page_Init();

// Page main
$keu_master_tanggungan_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_master_tanggungan_delete = new ew_Page("keu_master_tanggungan_delete");

// page properties
keu_master_tanggungan_delete.PageID = "delete"; // page ID
keu_master_tanggungan_delete.FormID = "fkeu_master_tanggungandelete"; // form ID
var EW_PAGE_ID = keu_master_tanggungan_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_master_tanggungan_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_master_tanggungan_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_master_tanggungan_delete.ValidateRequired = false; // no JavaScript validation
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
if ($keu_master_tanggungan_delete->Recordset = $keu_master_tanggungan_delete->LoadRecordset())
	$keu_master_tanggungan_deleteTotalRecs = $keu_master_tanggungan_delete->Recordset->RecordCount(); // Get record count
if ($keu_master_tanggungan_deleteTotalRecs <= 0) { // No record found, exit
	if ($keu_master_tanggungan_delete->Recordset)
		$keu_master_tanggungan_delete->Recordset->Close();
	$keu_master_tanggungan_delete->Page_Terminate("keu_master_tanggunganlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_master_tanggungan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_master_tanggungan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_master_tanggungan_delete->ShowPageHeader(); ?>
<?php
$keu_master_tanggungan_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="keu_master_tanggungan">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($keu_master_tanggungan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $keu_master_tanggungan->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $keu_master_tanggungan->nama_biaya->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_master_tanggungan->apakah_disembunyikan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_master_tanggungan->kode_otomatis->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_master_tanggungan->rek_pendapatan->FldCaption() ?></td>
		<td valign="top"><?php echo $keu_master_tanggungan->rek_kas->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$keu_master_tanggungan_delete->RecCnt = 0;
$i = 0;
while (!$keu_master_tanggungan_delete->Recordset->EOF) {
	$keu_master_tanggungan_delete->RecCnt++;

	// Set row properties
	$keu_master_tanggungan->ResetAttrs();
	$keu_master_tanggungan->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$keu_master_tanggungan_delete->LoadRowValues($keu_master_tanggungan_delete->Recordset);

	// Render row
	$keu_master_tanggungan_delete->RenderRow();
?>
	<tr<?php echo $keu_master_tanggungan->RowAttributes() ?>>
		<td<?php echo $keu_master_tanggungan->nama_biaya->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->nama_biaya->ViewAttributes() ?>><?php echo $keu_master_tanggungan->nama_biaya->ListViewValue() ?></div></td>
		<td<?php echo $keu_master_tanggungan->apakah_disembunyikan->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->apakah_disembunyikan->ViewAttributes() ?>><?php echo $keu_master_tanggungan->apakah_disembunyikan->ListViewValue() ?></div></td>
		<td<?php echo $keu_master_tanggungan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_master_tanggungan->kode_otomatis->ListViewValue() ?></div></td>
		<td<?php echo $keu_master_tanggungan->rek_pendapatan->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_master_tanggungan->rek_pendapatan->ListViewValue() ?></div></td>
		<td<?php echo $keu_master_tanggungan->rek_kas->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->rek_kas->ViewAttributes() ?>><?php echo $keu_master_tanggungan->rek_kas->ListViewValue() ?></div></td>
	</tr>
<?php
	$keu_master_tanggungan_delete->Recordset->MoveNext();
}
$keu_master_tanggungan_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$keu_master_tanggungan_delete->ShowPageFooter();
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
$keu_master_tanggungan_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_master_tanggungan_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'keu_master_tanggungan';

	// Page object name
	var $PageObjName = 'keu_master_tanggungan_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_master_tanggungan;
		if ($keu_master_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_master_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_master_tanggungan;
		if ($keu_master_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_master_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_master_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_master_tanggungan_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_master_tanggungan)
		if (!isset($GLOBALS["keu_master_tanggungan"])) {
			$GLOBALS["keu_master_tanggungan"] = new ckeu_master_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_master_tanggungan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_master_tanggungan', TRUE);

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
		global $keu_master_tanggungan;

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
			$this->Page_Terminate("keu_master_tanggunganlist.php");
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
		global $Language, $keu_master_tanggungan;

		// Load key parameters
		$this->RecKeys = $keu_master_tanggungan->GetRecordKeys(); // Load record keys
		$sFilter = $keu_master_tanggungan->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("keu_master_tanggunganlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in keu_master_tanggungan class, keu_master_tanggunganinfo.php

		$keu_master_tanggungan->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$keu_master_tanggungan->CurrentAction = $_POST["a_delete"];
		} else {
			$keu_master_tanggungan->CurrentAction = "I"; // Display record
		}
		switch ($keu_master_tanggungan->CurrentAction) {
			case "D": // Delete
				$keu_master_tanggungan->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($keu_master_tanggungan->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_master_tanggungan;

		// Call Recordset Selecting event
		$keu_master_tanggungan->Recordset_Selecting($keu_master_tanggungan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_master_tanggungan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_master_tanggungan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_master_tanggungan;
		$sFilter = $keu_master_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_master_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_master_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_master_tanggungan->SQL();
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
		global $conn, $keu_master_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_master_tanggungan->Row_Selected($row);
		$keu_master_tanggungan->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$keu_master_tanggungan->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$keu_master_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_master_tanggungan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_master_tanggungan->rek_kas->setDbValue($rs->fields('rek_kas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_master_tanggungan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_master_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// nama_biaya
		// apakah_disembunyikan
		// kode_otomatis
		// rek_pendapatan
		// rek_kas

		if ($keu_master_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->ViewValue = $keu_master_tanggungan->nama_biaya->CurrentValue;
			$keu_master_tanggungan->nama_biaya->ViewCustomAttributes = "";

			// apakah_disembunyikan
			if (strval($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) <> "") {
				switch ($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) {
					case "y":
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) : $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
						break;
					case "t":
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) : $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
						break;
					default:
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->apakah_disembunyikan->ViewValue = NULL;
			}
			$keu_master_tanggungan->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->ViewValue = $keu_master_tanggungan->kode_otomatis->CurrentValue;
			$keu_master_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_master_tanggungan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_master_tanggungan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan`, `D/K` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_master_tanggungan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_master_tanggungan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_master_tanggungan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$keu_master_tanggungan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,2,$keu_master_tanggungan->rek_pendapatan) . $rswrk->fields('D/K');
					$rswrk->Close();
				} else {
					$keu_master_tanggungan->rek_pendapatan->ViewValue = $keu_master_tanggungan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_master_tanggungan->rek_pendapatan->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_master_tanggungan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_master_tanggungan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan`, `D/K` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_master_tanggungan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_master_tanggungan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_master_tanggungan->rek_kas) . $rswrk->fields('Keterangan');
					$keu_master_tanggungan->rek_kas->ViewValue .= ew_ValueSeparator(0,2,$keu_master_tanggungan->rek_kas) . $rswrk->fields('D/K');
					$rswrk->Close();
				} else {
					$keu_master_tanggungan->rek_kas->ViewValue = $keu_master_tanggungan->rek_kas->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->rek_kas->ViewValue = NULL;
			}
			$keu_master_tanggungan->rek_kas->ViewCustomAttributes = "";

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->LinkCustomAttributes = "";
			$keu_master_tanggungan->nama_biaya->HrefValue = "";
			$keu_master_tanggungan->nama_biaya->TooltipValue = "";

			// apakah_disembunyikan
			$keu_master_tanggungan->apakah_disembunyikan->LinkCustomAttributes = "";
			$keu_master_tanggungan->apakah_disembunyikan->HrefValue = "";
			$keu_master_tanggungan->apakah_disembunyikan->TooltipValue = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_master_tanggungan->kode_otomatis->HrefValue = "";
			$keu_master_tanggungan->kode_otomatis->TooltipValue = "";

			// rek_pendapatan
			$keu_master_tanggungan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_master_tanggungan->rek_pendapatan->HrefValue = "";
			$keu_master_tanggungan->rek_pendapatan->TooltipValue = "";

			// rek_kas
			$keu_master_tanggungan->rek_kas->LinkCustomAttributes = "";
			$keu_master_tanggungan->rek_kas->HrefValue = "";
			$keu_master_tanggungan->rek_kas->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_master_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_master_tanggungan->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $keu_master_tanggungan;
		$DeleteRows = TRUE;
		$sSql = $keu_master_tanggungan->SQL();
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
				$DeleteRows = $keu_master_tanggungan->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($keu_master_tanggungan->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($keu_master_tanggungan->CancelMessage <> "") {
				$this->setFailureMessage($keu_master_tanggungan->CancelMessage);
				$keu_master_tanggungan->CancelMessage = "";
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
				$keu_master_tanggungan->Row_Deleted($row);
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
