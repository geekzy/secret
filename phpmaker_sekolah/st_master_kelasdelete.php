<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_kelasinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_kelas_delete = new cst_master_kelas_delete();
$Page =& $st_master_kelas_delete;

// Page init
$st_master_kelas_delete->Page_Init();

// Page main
$st_master_kelas_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_kelas_delete = new ew_Page("st_master_kelas_delete");

// page properties
st_master_kelas_delete.PageID = "delete"; // page ID
st_master_kelas_delete.FormID = "fst_master_kelasdelete"; // form ID
var EW_PAGE_ID = st_master_kelas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
st_master_kelas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_kelas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_kelas_delete.ValidateRequired = false; // no JavaScript validation
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
if ($st_master_kelas_delete->Recordset = $st_master_kelas_delete->LoadRecordset())
	$st_master_kelas_deleteTotalRecs = $st_master_kelas_delete->Recordset->RecordCount(); // Get record count
if ($st_master_kelas_deleteTotalRecs <= 0) { // No record found, exit
	if ($st_master_kelas_delete->Recordset)
		$st_master_kelas_delete->Recordset->Close();
	$st_master_kelas_delete->Page_Terminate("st_master_kelaslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_kelas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_master_kelas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_master_kelas_delete->ShowPageHeader(); ?>
<?php
$st_master_kelas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="st_master_kelas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($st_master_kelas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $st_master_kelas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $st_master_kelas->kelas->FldCaption() ?></td>
		<td valign="top"><?php echo $st_master_kelas->kode_otomatis_tingkat->FldCaption() ?></td>
		<td valign="top"><?php echo $st_master_kelas->kode_otomatis->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$st_master_kelas_delete->RecCnt = 0;
$i = 0;
while (!$st_master_kelas_delete->Recordset->EOF) {
	$st_master_kelas_delete->RecCnt++;

	// Set row properties
	$st_master_kelas->ResetAttrs();
	$st_master_kelas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$st_master_kelas_delete->LoadRowValues($st_master_kelas_delete->Recordset);

	// Render row
	$st_master_kelas_delete->RenderRow();
?>
	<tr<?php echo $st_master_kelas->RowAttributes() ?>>
		<td<?php echo $st_master_kelas->kelas->CellAttributes() ?>>
<div<?php echo $st_master_kelas->kelas->ViewAttributes() ?>><?php echo $st_master_kelas->kelas->ListViewValue() ?></div></td>
		<td<?php echo $st_master_kelas->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $st_master_kelas->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $st_master_kelas->kode_otomatis_tingkat->ListViewValue() ?></div></td>
		<td<?php echo $st_master_kelas->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_master_kelas->kode_otomatis->ViewAttributes() ?>><?php echo $st_master_kelas->kode_otomatis->ListViewValue() ?></div></td>
	</tr>
<?php
	$st_master_kelas_delete->Recordset->MoveNext();
}
$st_master_kelas_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$st_master_kelas_delete->ShowPageFooter();
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
$st_master_kelas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_kelas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'st_master_kelas';

	// Page object name
	var $PageObjName = 'st_master_kelas_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_kelas;
		if ($st_master_kelas->UseTokenInUrl) $PageUrl .= "t=" . $st_master_kelas->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_kelas;
		if ($st_master_kelas->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_kelas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_kelas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_kelas_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_kelas)
		if (!isset($GLOBALS["st_master_kelas"])) {
			$GLOBALS["st_master_kelas"] = new cst_master_kelas();
			$GLOBALS["Table"] =& $GLOBALS["st_master_kelas"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_kelas', TRUE);

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
		global $st_master_kelas;

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
			$this->Page_Terminate("st_master_kelaslist.php");
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
		global $Language, $st_master_kelas;

		// Load key parameters
		$this->RecKeys = $st_master_kelas->GetRecordKeys(); // Load record keys
		$sFilter = $st_master_kelas->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("st_master_kelaslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in st_master_kelas class, st_master_kelasinfo.php

		$st_master_kelas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$st_master_kelas->CurrentAction = $_POST["a_delete"];
		} else {
			$st_master_kelas->CurrentAction = "I"; // Display record
		}
		switch ($st_master_kelas->CurrentAction) {
			case "D": // Delete
				$st_master_kelas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($st_master_kelas->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_master_kelas;

		// Call Recordset Selecting event
		$st_master_kelas->Recordset_Selecting($st_master_kelas->CurrentFilter);

		// Load List page SQL
		$sSql = $st_master_kelas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_master_kelas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_kelas;
		$sFilter = $st_master_kelas->KeyFilter();

		// Call Row Selecting event
		$st_master_kelas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_kelas->CurrentFilter = $sFilter;
		$sSql = $st_master_kelas->SQL();
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
		global $conn, $st_master_kelas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_kelas->Row_Selected($row);
		$st_master_kelas->kelas->setDbValue($rs->fields('kelas'));
		$st_master_kelas->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$st_master_kelas->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_kelas;

		// Initialize URLs
		// Call Row_Rendering event

		$st_master_kelas->Row_Rendering();

		// Common render codes for all row types
		// kelas
		// kode_otomatis_tingkat
		// kode_otomatis

		if ($st_master_kelas->RowType == EW_ROWTYPE_VIEW) { // View row

			// kelas
			$st_master_kelas->kelas->ViewValue = $st_master_kelas->kelas->CurrentValue;
			$st_master_kelas->kelas->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_kelas->kode_otomatis_tingkat->ViewValue = $st_master_kelas->kode_otomatis_tingkat->CurrentValue;
			$st_master_kelas->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_kelas->kode_otomatis->ViewValue = $st_master_kelas->kode_otomatis->CurrentValue;
			$st_master_kelas->kode_otomatis->ViewCustomAttributes = "";

			// kelas
			$st_master_kelas->kelas->LinkCustomAttributes = "";
			$st_master_kelas->kelas->HrefValue = "";
			$st_master_kelas->kelas->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_kelas->kode_otomatis_tingkat->HrefValue = "";
			$st_master_kelas->kode_otomatis_tingkat->TooltipValue = "";

			// kode_otomatis
			$st_master_kelas->kode_otomatis->LinkCustomAttributes = "";
			$st_master_kelas->kode_otomatis->HrefValue = "";
			$st_master_kelas->kode_otomatis->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($st_master_kelas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_kelas->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $st_master_kelas;
		$DeleteRows = TRUE;
		$sSql = $st_master_kelas->SQL();
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
				$DeleteRows = $st_master_kelas->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($st_master_kelas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($st_master_kelas->CancelMessage <> "") {
				$this->setFailureMessage($st_master_kelas->CancelMessage);
				$st_master_kelas->CancelMessage = "";
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
				$st_master_kelas->Row_Deleted($row);
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
