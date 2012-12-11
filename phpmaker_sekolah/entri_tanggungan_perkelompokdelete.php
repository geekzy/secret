<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "entri_tanggungan_perkelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$entri_tanggungan_perkelompok_delete = new centri_tanggungan_perkelompok_delete();
$Page =& $entri_tanggungan_perkelompok_delete;

// Page init
$entri_tanggungan_perkelompok_delete->Page_Init();

// Page main
$entri_tanggungan_perkelompok_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entri_tanggungan_perkelompok_delete = new ew_Page("entri_tanggungan_perkelompok_delete");

// page properties
entri_tanggungan_perkelompok_delete.PageID = "delete"; // page ID
entri_tanggungan_perkelompok_delete.FormID = "fentri_tanggungan_perkelompokdelete"; // form ID
var EW_PAGE_ID = entri_tanggungan_perkelompok_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entri_tanggungan_perkelompok_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
entri_tanggungan_perkelompok_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
entri_tanggungan_perkelompok_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entri_tanggungan_perkelompok_delete.ValidateRequired = false; // no JavaScript validation
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
if ($entri_tanggungan_perkelompok_delete->Recordset = $entri_tanggungan_perkelompok_delete->LoadRecordset())
	$entri_tanggungan_perkelompok_deleteTotalRecs = $entri_tanggungan_perkelompok_delete->Recordset->RecordCount(); // Get record count
if ($entri_tanggungan_perkelompok_deleteTotalRecs <= 0) { // No record found, exit
	if ($entri_tanggungan_perkelompok_delete->Recordset)
		$entri_tanggungan_perkelompok_delete->Recordset->Close();
	$entri_tanggungan_perkelompok_delete->Page_Terminate("entri_tanggungan_perkelompoklist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $entri_tanggungan_perkelompok->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $entri_tanggungan_perkelompok->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $entri_tanggungan_perkelompok_delete->ShowPageHeader(); ?>
<?php
$entri_tanggungan_perkelompok_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="entri_tanggungan_perkelompok">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($entri_tanggungan_perkelompok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $entri_tanggungan_perkelompok->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $entri_tanggungan_perkelompok->tahun->FldCaption() ?></td>
		<td valign="top"><?php echo $entri_tanggungan_perkelompok->kelas->FldCaption() ?></td>
		<td valign="top"><?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->FldCaption() ?></td>
		<td valign="top"><?php echo $entri_tanggungan_perkelompok->kode_otomatis->FldCaption() ?></td>
		<td valign="top"><?php echo $entri_tanggungan_perkelompok->apakah_valid->FldCaption() ?></td>
		<td valign="top"><?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$entri_tanggungan_perkelompok_delete->RecCnt = 0;
$i = 0;
while (!$entri_tanggungan_perkelompok_delete->Recordset->EOF) {
	$entri_tanggungan_perkelompok_delete->RecCnt++;

	// Set row properties
	$entri_tanggungan_perkelompok->ResetAttrs();
	$entri_tanggungan_perkelompok->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$entri_tanggungan_perkelompok_delete->LoadRowValues($entri_tanggungan_perkelompok_delete->Recordset);

	// Render row
	$entri_tanggungan_perkelompok_delete->RenderRow();
?>
	<tr<?php echo $entri_tanggungan_perkelompok->RowAttributes() ?>>
		<td<?php echo $entri_tanggungan_perkelompok->tahun->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->tahun->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->tahun->ListViewValue() ?></div></td>
		<td<?php echo $entri_tanggungan_perkelompok->kelas->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->kelas->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->kelas->ListViewValue() ?></div></td>
		<td<?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->ListViewValue() ?></div></td>
		<td<?php echo $entri_tanggungan_perkelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->kode_otomatis->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->kode_otomatis->ListViewValue() ?></div></td>
		<td<?php echo $entri_tanggungan_perkelompok->apakah_valid->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->apakah_valid->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->apakah_valid->ListViewValue() ?></div></td>
		<td<?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->ListViewValue() ?></div></td>
	</tr>
<?php
	$entri_tanggungan_perkelompok_delete->Recordset->MoveNext();
}
$entri_tanggungan_perkelompok_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$entri_tanggungan_perkelompok_delete->ShowPageFooter();
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
$entri_tanggungan_perkelompok_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class centri_tanggungan_perkelompok_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'entri_tanggungan_perkelompok';

	// Page object name
	var $PageObjName = 'entri_tanggungan_perkelompok_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entri_tanggungan_perkelompok;
		if ($entri_tanggungan_perkelompok->UseTokenInUrl) $PageUrl .= "t=" . $entri_tanggungan_perkelompok->TableVar . "&"; // Add page token
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
		global $objForm, $entri_tanggungan_perkelompok;
		if ($entri_tanggungan_perkelompok->UseTokenInUrl) {
			if ($objForm)
				return ($entri_tanggungan_perkelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entri_tanggungan_perkelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centri_tanggungan_perkelompok_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (entri_tanggungan_perkelompok)
		if (!isset($GLOBALS["entri_tanggungan_perkelompok"])) {
			$GLOBALS["entri_tanggungan_perkelompok"] = new centri_tanggungan_perkelompok();
			$GLOBALS["Table"] =& $GLOBALS["entri_tanggungan_perkelompok"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entri_tanggungan_perkelompok', TRUE);

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
		global $entri_tanggungan_perkelompok;

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
			$this->Page_Terminate("entri_tanggungan_perkelompoklist.php");
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
		global $Language, $entri_tanggungan_perkelompok;

		// Load key parameters
		$this->RecKeys = $entri_tanggungan_perkelompok->GetRecordKeys(); // Load record keys
		$sFilter = $entri_tanggungan_perkelompok->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("entri_tanggungan_perkelompoklist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in entri_tanggungan_perkelompok class, entri_tanggungan_perkelompokinfo.php

		$entri_tanggungan_perkelompok->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$entri_tanggungan_perkelompok->CurrentAction = $_POST["a_delete"];
		} else {
			$entri_tanggungan_perkelompok->CurrentAction = "I"; // Display record
		}
		switch ($entri_tanggungan_perkelompok->CurrentAction) {
			case "D": // Delete
				$entri_tanggungan_perkelompok->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($entri_tanggungan_perkelompok->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entri_tanggungan_perkelompok;

		// Call Recordset Selecting event
		$entri_tanggungan_perkelompok->Recordset_Selecting($entri_tanggungan_perkelompok->CurrentFilter);

		// Load List page SQL
		$sSql = $entri_tanggungan_perkelompok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entri_tanggungan_perkelompok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entri_tanggungan_perkelompok;
		$sFilter = $entri_tanggungan_perkelompok->KeyFilter();

		// Call Row Selecting event
		$entri_tanggungan_perkelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entri_tanggungan_perkelompok->CurrentFilter = $sFilter;
		$sSql = $entri_tanggungan_perkelompok->SQL();
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
		global $conn, $entri_tanggungan_perkelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$entri_tanggungan_perkelompok->Row_Selected($row);
		$entri_tanggungan_perkelompok->tahun->setDbValue($rs->fields('tahun'));
		$entri_tanggungan_perkelompok->kelas->setDbValue($rs->fields('kelas'));
		$entri_tanggungan_perkelompok->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$entri_tanggungan_perkelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$entri_tanggungan_perkelompok->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$entri_tanggungan_perkelompok->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entri_tanggungan_perkelompok;

		// Initialize URLs
		// Call Row_Rendering event

		$entri_tanggungan_perkelompok->Row_Rendering();

		// Common render codes for all row types
		// tahun
		// kelas
		// nama_kelas_kelompok
		// kode_otomatis
		// apakah_valid
		// kode_otomatis_tingkat

		if ($entri_tanggungan_perkelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// tahun
			$entri_tanggungan_perkelompok->tahun->ViewValue = $entri_tanggungan_perkelompok->tahun->CurrentValue;
			$entri_tanggungan_perkelompok->tahun->ViewCustomAttributes = "";

			// kelas
			$entri_tanggungan_perkelompok->kelas->ViewValue = $entri_tanggungan_perkelompok->kelas->CurrentValue;
			$entri_tanggungan_perkelompok->kelas->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->ViewValue = $entri_tanggungan_perkelompok->nama_kelas_kelompok->CurrentValue;
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$entri_tanggungan_perkelompok->kode_otomatis->ViewValue = $entri_tanggungan_perkelompok->kode_otomatis->CurrentValue;
			$entri_tanggungan_perkelompok->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			$entri_tanggungan_perkelompok->apakah_valid->ViewValue = $entri_tanggungan_perkelompok->apakah_valid->CurrentValue;
			$entri_tanggungan_perkelompok->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->ViewValue = $entri_tanggungan_perkelompok->kode_otomatis_tingkat->CurrentValue;
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$entri_tanggungan_perkelompok->tahun->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->tahun->HrefValue = "";
			$entri_tanggungan_perkelompok->tahun->TooltipValue = "";

			// kelas
			$entri_tanggungan_perkelompok->kelas->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->kelas->HrefValue = "";
			$entri_tanggungan_perkelompok->kelas->TooltipValue = "";

			// nama_kelas_kelompok
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->HrefValue = "";
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->TooltipValue = "";

			// kode_otomatis
			$entri_tanggungan_perkelompok->kode_otomatis->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->kode_otomatis->HrefValue = "";
			$entri_tanggungan_perkelompok->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$entri_tanggungan_perkelompok->apakah_valid->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->apakah_valid->HrefValue = "";
			$entri_tanggungan_perkelompok->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->HrefValue = "";
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entri_tanggungan_perkelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entri_tanggungan_perkelompok->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $entri_tanggungan_perkelompok;
		$DeleteRows = TRUE;
		$sSql = $entri_tanggungan_perkelompok->SQL();
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
				$DeleteRows = $entri_tanggungan_perkelompok->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($entri_tanggungan_perkelompok->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($entri_tanggungan_perkelompok->CancelMessage <> "") {
				$this->setFailureMessage($entri_tanggungan_perkelompok->CancelMessage);
				$entri_tanggungan_perkelompok->CancelMessage = "";
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
				$entri_tanggungan_perkelompok->Row_Deleted($row);
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
