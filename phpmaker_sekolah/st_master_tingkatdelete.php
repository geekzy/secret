<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_tingkatinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_tingkat_delete = new cst_master_tingkat_delete();
$Page =& $st_master_tingkat_delete;

// Page init
$st_master_tingkat_delete->Page_Init();

// Page main
$st_master_tingkat_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_tingkat_delete = new ew_Page("st_master_tingkat_delete");

// page properties
st_master_tingkat_delete.PageID = "delete"; // page ID
st_master_tingkat_delete.FormID = "fst_master_tingkatdelete"; // form ID
var EW_PAGE_ID = st_master_tingkat_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
st_master_tingkat_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_tingkat_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_tingkat_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
st_master_tingkat_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
st_master_tingkat_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($st_master_tingkat_delete->Recordset = $st_master_tingkat_delete->LoadRecordset())
	$st_master_tingkat_deleteTotalRecs = $st_master_tingkat_delete->Recordset->RecordCount(); // Get record count
if ($st_master_tingkat_deleteTotalRecs <= 0) { // No record found, exit
	if ($st_master_tingkat_delete->Recordset)
		$st_master_tingkat_delete->Recordset->Close();
	$st_master_tingkat_delete->Page_Terminate("st_master_tingkatlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_tingkat->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_master_tingkat->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_master_tingkat_delete->ShowPageHeader(); ?>
<?php
$st_master_tingkat_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="st_master_tingkat">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($st_master_tingkat_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $st_master_tingkat->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $st_master_tingkat->tingkat->FldCaption() ?></td>
		<td valign="top"><?php echo $st_master_tingkat->apakah_disembunyikan->FldCaption() ?></td>
		<td valign="top"><?php echo $st_master_tingkat->kode_otomatis->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$st_master_tingkat_delete->RecCnt = 0;
$i = 0;
while (!$st_master_tingkat_delete->Recordset->EOF) {
	$st_master_tingkat_delete->RecCnt++;

	// Set row properties
	$st_master_tingkat->ResetAttrs();
	$st_master_tingkat->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$st_master_tingkat_delete->LoadRowValues($st_master_tingkat_delete->Recordset);

	// Render row
	$st_master_tingkat_delete->RenderRow();
?>
	<tr<?php echo $st_master_tingkat->RowAttributes() ?>>
		<td<?php echo $st_master_tingkat->tingkat->CellAttributes() ?>>
<div<?php echo $st_master_tingkat->tingkat->ViewAttributes() ?>><?php echo $st_master_tingkat->tingkat->ListViewValue() ?></div></td>
		<td<?php echo $st_master_tingkat->apakah_disembunyikan->CellAttributes() ?>>
<div<?php echo $st_master_tingkat->apakah_disembunyikan->ViewAttributes() ?>><?php echo $st_master_tingkat->apakah_disembunyikan->ListViewValue() ?></div></td>
		<td<?php echo $st_master_tingkat->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_master_tingkat->kode_otomatis->ViewAttributes() ?>><?php echo $st_master_tingkat->kode_otomatis->ListViewValue() ?></div></td>
	</tr>
<?php
	$st_master_tingkat_delete->Recordset->MoveNext();
}
$st_master_tingkat_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$st_master_tingkat_delete->ShowPageFooter();
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
$st_master_tingkat_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_tingkat_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'st_master_tingkat';

	// Page object name
	var $PageObjName = 'st_master_tingkat_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_tingkat;
		if ($st_master_tingkat->UseTokenInUrl) $PageUrl .= "t=" . $st_master_tingkat->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_tingkat;
		if ($st_master_tingkat->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_tingkat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_tingkat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_tingkat_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_tingkat)
		if (!isset($GLOBALS["st_master_tingkat"])) {
			$GLOBALS["st_master_tingkat"] = new cst_master_tingkat();
			$GLOBALS["Table"] =& $GLOBALS["st_master_tingkat"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_tingkat', TRUE);

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
		global $st_master_tingkat;

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
			$this->Page_Terminate("st_master_tingkatlist.php");
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
		global $Language, $st_master_tingkat;

		// Load key parameters
		$this->RecKeys = $st_master_tingkat->GetRecordKeys(); // Load record keys
		$sFilter = $st_master_tingkat->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("st_master_tingkatlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in st_master_tingkat class, st_master_tingkatinfo.php

		$st_master_tingkat->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$st_master_tingkat->CurrentAction = $_POST["a_delete"];
		} else {
			$st_master_tingkat->CurrentAction = "D"; // Delete record directly
		}
		switch ($st_master_tingkat->CurrentAction) {
			case "D": // Delete
				$st_master_tingkat->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($st_master_tingkat->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_master_tingkat;

		// Call Recordset Selecting event
		$st_master_tingkat->Recordset_Selecting($st_master_tingkat->CurrentFilter);

		// Load List page SQL
		$sSql = $st_master_tingkat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_master_tingkat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_tingkat;
		$sFilter = $st_master_tingkat->KeyFilter();

		// Call Row Selecting event
		$st_master_tingkat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_tingkat->CurrentFilter = $sFilter;
		$sSql = $st_master_tingkat->SQL();
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
		global $conn, $st_master_tingkat;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_tingkat->Row_Selected($row);
		$st_master_tingkat->tingkat->setDbValue($rs->fields('tingkat'));
		$st_master_tingkat->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$st_master_tingkat->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_tingkat;

		// Initialize URLs
		// Call Row_Rendering event

		$st_master_tingkat->Row_Rendering();

		// Common render codes for all row types
		// tingkat
		// apakah_disembunyikan
		// kode_otomatis

		if ($st_master_tingkat->RowType == EW_ROWTYPE_VIEW) { // View row

			// tingkat
			$st_master_tingkat->tingkat->ViewValue = $st_master_tingkat->tingkat->CurrentValue;
			$st_master_tingkat->tingkat->ViewCustomAttributes = "";

			// apakah_disembunyikan
			if (strval($st_master_tingkat->apakah_disembunyikan->CurrentValue) <> "") {
				switch ($st_master_tingkat->apakah_disembunyikan->CurrentValue) {
					case "y":
						$st_master_tingkat->apakah_disembunyikan->ViewValue = $st_master_tingkat->apakah_disembunyikan->FldTagCaption(1) <> "" ? $st_master_tingkat->apakah_disembunyikan->FldTagCaption(1) : $st_master_tingkat->apakah_disembunyikan->CurrentValue;
						break;
					case "t":
						$st_master_tingkat->apakah_disembunyikan->ViewValue = $st_master_tingkat->apakah_disembunyikan->FldTagCaption(2) <> "" ? $st_master_tingkat->apakah_disembunyikan->FldTagCaption(2) : $st_master_tingkat->apakah_disembunyikan->CurrentValue;
						break;
					default:
						$st_master_tingkat->apakah_disembunyikan->ViewValue = $st_master_tingkat->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$st_master_tingkat->apakah_disembunyikan->ViewValue = NULL;
			}
			$st_master_tingkat->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_tingkat->kode_otomatis->ViewValue = $st_master_tingkat->kode_otomatis->CurrentValue;
			$st_master_tingkat->kode_otomatis->ViewCustomAttributes = "";

			// tingkat
			$st_master_tingkat->tingkat->LinkCustomAttributes = "";
			$st_master_tingkat->tingkat->HrefValue = "";
			$st_master_tingkat->tingkat->TooltipValue = "";

			// apakah_disembunyikan
			$st_master_tingkat->apakah_disembunyikan->LinkCustomAttributes = "";
			$st_master_tingkat->apakah_disembunyikan->HrefValue = "";
			$st_master_tingkat->apakah_disembunyikan->TooltipValue = "";

			// kode_otomatis
			$st_master_tingkat->kode_otomatis->LinkCustomAttributes = "";
			$st_master_tingkat->kode_otomatis->HrefValue = "";
			$st_master_tingkat->kode_otomatis->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($st_master_tingkat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_tingkat->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $st_master_tingkat;
		$DeleteRows = TRUE;
		$sSql = $st_master_tingkat->SQL();
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
				$DeleteRows = $st_master_tingkat->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($st_master_tingkat->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($st_master_tingkat->CancelMessage <> "") {
				$this->setFailureMessage($st_master_tingkat->CancelMessage);
				$st_master_tingkat->CancelMessage = "";
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
				$st_master_tingkat->Row_Deleted($row);
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
