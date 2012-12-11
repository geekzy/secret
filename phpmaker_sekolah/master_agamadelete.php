<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_agamainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_agama_delete = new cmaster_agama_delete();
$Page =& $master_agama_delete;

// Page init
$master_agama_delete->Page_Init();

// Page main
$master_agama_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_agama_delete = new ew_Page("master_agama_delete");

// page properties
master_agama_delete.PageID = "delete"; // page ID
master_agama_delete.FormID = "fmaster_agamadelete"; // form ID
var EW_PAGE_ID = master_agama_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
master_agama_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
master_agama_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_agama_delete.ValidateRequired = false; // no JavaScript validation
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
if ($master_agama_delete->Recordset = $master_agama_delete->LoadRecordset())
	$master_agama_deleteTotalRecs = $master_agama_delete->Recordset->RecordCount(); // Get record count
if ($master_agama_deleteTotalRecs <= 0) { // No record found, exit
	if ($master_agama_delete->Recordset)
		$master_agama_delete->Recordset->Close();
	$master_agama_delete->Page_Terminate("master_agamalist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $master_agama->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_agama->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $master_agama_delete->ShowPageHeader(); ?>
<?php
$master_agama_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="master_agama">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($master_agama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $master_agama->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $master_agama->id->FldCaption() ?></td>
		<td valign="top"><?php echo $master_agama->agama->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$master_agama_delete->RecCnt = 0;
$i = 0;
while (!$master_agama_delete->Recordset->EOF) {
	$master_agama_delete->RecCnt++;

	// Set row properties
	$master_agama->ResetAttrs();
	$master_agama->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$master_agama_delete->LoadRowValues($master_agama_delete->Recordset);

	// Render row
	$master_agama_delete->RenderRow();
?>
	<tr<?php echo $master_agama->RowAttributes() ?>>
		<td<?php echo $master_agama->id->CellAttributes() ?>>
<div<?php echo $master_agama->id->ViewAttributes() ?>><?php echo $master_agama->id->ListViewValue() ?></div></td>
		<td<?php echo $master_agama->agama->CellAttributes() ?>>
<div<?php echo $master_agama->agama->ViewAttributes() ?>><?php echo $master_agama->agama->ListViewValue() ?></div></td>
	</tr>
<?php
	$master_agama_delete->Recordset->MoveNext();
}
$master_agama_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$master_agama_delete->ShowPageFooter();
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
$master_agama_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_agama_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'master_agama';

	// Page object name
	var $PageObjName = 'master_agama_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_agama;
		if ($master_agama->UseTokenInUrl) $PageUrl .= "t=" . $master_agama->TableVar . "&"; // Add page token
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
		global $objForm, $master_agama;
		if ($master_agama->UseTokenInUrl) {
			if ($objForm)
				return ($master_agama->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_agama->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_agama_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_agama)
		if (!isset($GLOBALS["master_agama"])) {
			$GLOBALS["master_agama"] = new cmaster_agama();
			$GLOBALS["Table"] =& $GLOBALS["master_agama"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_agama', TRUE);

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
		global $master_agama;

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
			$this->Page_Terminate("master_agamalist.php");
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
		global $Language, $master_agama;

		// Load key parameters
		$this->RecKeys = $master_agama->GetRecordKeys(); // Load record keys
		$sFilter = $master_agama->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("master_agamalist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in master_agama class, master_agamainfo.php

		$master_agama->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$master_agama->CurrentAction = $_POST["a_delete"];
		} else {
			$master_agama->CurrentAction = "I"; // Display record
		}
		switch ($master_agama->CurrentAction) {
			case "D": // Delete
				$master_agama->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($master_agama->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $master_agama;

		// Call Recordset Selecting event
		$master_agama->Recordset_Selecting($master_agama->CurrentFilter);

		// Load List page SQL
		$sSql = $master_agama->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$master_agama->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $master_agama;
		$sFilter = $master_agama->KeyFilter();

		// Call Row Selecting event
		$master_agama->Row_Selecting($sFilter);

		// Load SQL based on filter
		$master_agama->CurrentFilter = $sFilter;
		$sSql = $master_agama->SQL();
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
		global $conn, $master_agama;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$master_agama->Row_Selected($row);
		$master_agama->id->setDbValue($rs->fields('id'));
		$master_agama->agama->setDbValue($rs->fields('agama'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_agama;

		// Initialize URLs
		// Call Row_Rendering event

		$master_agama->Row_Rendering();

		// Common render codes for all row types
		// id
		// agama

		if ($master_agama->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$master_agama->id->ViewValue = $master_agama->id->CurrentValue;
			$master_agama->id->ViewCustomAttributes = "";

			// agama
			$master_agama->agama->ViewValue = $master_agama->agama->CurrentValue;
			$master_agama->agama->ViewCustomAttributes = "";

			// id
			$master_agama->id->LinkCustomAttributes = "";
			$master_agama->id->HrefValue = "";
			$master_agama->id->TooltipValue = "";

			// agama
			$master_agama->agama->LinkCustomAttributes = "";
			$master_agama->agama->HrefValue = "";
			$master_agama->agama->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($master_agama->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_agama->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $master_agama;
		$DeleteRows = TRUE;
		$sSql = $master_agama->SQL();
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
				$DeleteRows = $master_agama->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($master_agama->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($master_agama->CancelMessage <> "") {
				$this->setFailureMessage($master_agama->CancelMessage);
				$master_agama->CancelMessage = "";
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
				$master_agama->Row_Deleted($row);
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
