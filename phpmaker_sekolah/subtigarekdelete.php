<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subtigarekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subtigarek_delete = new csubtigarek_delete();
$Page =& $subtigarek_delete;

// Page init
$subtigarek_delete->Page_Init();

// Page main
$subtigarek_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subtigarek_delete = new ew_Page("subtigarek_delete");

// page properties
subtigarek_delete.PageID = "delete"; // page ID
subtigarek_delete.FormID = "fsubtigarekdelete"; // form ID
var EW_PAGE_ID = subtigarek_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subtigarek_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subtigarek_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subtigarek_delete.ValidateRequired = false; // no JavaScript validation
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
if ($subtigarek_delete->Recordset = $subtigarek_delete->LoadRecordset())
	$subtigarek_deleteTotalRecs = $subtigarek_delete->Recordset->RecordCount(); // Get record count
if ($subtigarek_deleteTotalRecs <= 0) { // No record found, exit
	if ($subtigarek_delete->Recordset)
		$subtigarek_delete->Recordset->Close();
	$subtigarek_delete->Page_Terminate("subtigareklist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subtigarek->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subtigarek->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subtigarek_delete->ShowPageHeader(); ?>
<?php
$subtigarek_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subtigarek">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subtigarek_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subtigarek->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subtigarek->kodePokok->FldCaption() ?></td>
		<td valign="top"><?php echo $subtigarek->kodeSubSatu->FldCaption() ?></td>
		<td valign="top"><?php echo $subtigarek->kodeSubDua->FldCaption() ?></td>
		<td valign="top"><?php echo $subtigarek->kodeSubTiga->FldCaption() ?></td>
		<td valign="top"><?php echo $subtigarek->namaSubTiga->FldCaption() ?></td>
		<td valign="top"><?php echo $subtigarek->id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subtigarek_delete->RecCnt = 0;
$i = 0;
while (!$subtigarek_delete->Recordset->EOF) {
	$subtigarek_delete->RecCnt++;

	// Set row properties
	$subtigarek->ResetAttrs();
	$subtigarek->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subtigarek_delete->LoadRowValues($subtigarek_delete->Recordset);

	// Render row
	$subtigarek_delete->RenderRow();
?>
	<tr<?php echo $subtigarek->RowAttributes() ?>>
		<td<?php echo $subtigarek->kodePokok->CellAttributes() ?>>
<div<?php echo $subtigarek->kodePokok->ViewAttributes() ?>><?php echo $subtigarek->kodePokok->ListViewValue() ?></div></td>
		<td<?php echo $subtigarek->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubSatu->ViewAttributes() ?>><?php echo $subtigarek->kodeSubSatu->ListViewValue() ?></div></td>
		<td<?php echo $subtigarek->kodeSubDua->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubDua->ViewAttributes() ?>><?php echo $subtigarek->kodeSubDua->ListViewValue() ?></div></td>
		<td<?php echo $subtigarek->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubTiga->ViewAttributes() ?>><?php echo $subtigarek->kodeSubTiga->ListViewValue() ?></div></td>
		<td<?php echo $subtigarek->namaSubTiga->CellAttributes() ?>>
<div<?php echo $subtigarek->namaSubTiga->ViewAttributes() ?>><?php echo $subtigarek->namaSubTiga->ListViewValue() ?></div></td>
		<td<?php echo $subtigarek->id->CellAttributes() ?>>
<div<?php echo $subtigarek->id->ViewAttributes() ?>><?php echo $subtigarek->id->ListViewValue() ?></div></td>
	</tr>
<?php
	$subtigarek_delete->Recordset->MoveNext();
}
$subtigarek_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$subtigarek_delete->ShowPageFooter();
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
$subtigarek_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubtigarek_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subtigarek';

	// Page object name
	var $PageObjName = 'subtigarek_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subtigarek;
		if ($subtigarek->UseTokenInUrl) $PageUrl .= "t=" . $subtigarek->TableVar . "&"; // Add page token
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
		global $objForm, $subtigarek;
		if ($subtigarek->UseTokenInUrl) {
			if ($objForm)
				return ($subtigarek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subtigarek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubtigarek_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subtigarek)
		if (!isset($GLOBALS["subtigarek"])) {
			$GLOBALS["subtigarek"] = new csubtigarek();
			$GLOBALS["Table"] =& $GLOBALS["subtigarek"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subtigarek', TRUE);

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
		global $subtigarek;

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
			$this->Page_Terminate("subtigareklist.php");
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
		global $Language, $subtigarek;

		// Load key parameters
		$this->RecKeys = $subtigarek->GetRecordKeys(); // Load record keys
		$sFilter = $subtigarek->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("subtigareklist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subtigarek class, subtigarekinfo.php

		$subtigarek->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subtigarek->CurrentAction = $_POST["a_delete"];
		} else {
			$subtigarek->CurrentAction = "I"; // Display record
		}
		switch ($subtigarek->CurrentAction) {
			case "D": // Delete
				$subtigarek->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subtigarek->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subtigarek;

		// Call Recordset Selecting event
		$subtigarek->Recordset_Selecting($subtigarek->CurrentFilter);

		// Load List page SQL
		$sSql = $subtigarek->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subtigarek->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subtigarek;
		$sFilter = $subtigarek->KeyFilter();

		// Call Row Selecting event
		$subtigarek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subtigarek->CurrentFilter = $sFilter;
		$sSql = $subtigarek->SQL();
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
		global $conn, $subtigarek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subtigarek->Row_Selected($row);
		$subtigarek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subtigarek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subtigarek->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$subtigarek->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$subtigarek->namaSubTiga->setDbValue($rs->fields('namaSubTiga'));
		$subtigarek->id->setDbValue($rs->fields('id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subtigarek;

		// Initialize URLs
		// Call Row_Rendering event

		$subtigarek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// namaSubTiga
		// id

		if ($subtigarek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$subtigarek->kodePokok->ViewValue = $subtigarek->kodePokok->CurrentValue;
			$subtigarek->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->ViewValue = $subtigarek->kodeSubSatu->CurrentValue;
			$subtigarek->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->ViewValue = $subtigarek->kodeSubDua->CurrentValue;
			$subtigarek->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->ViewValue = $subtigarek->kodeSubTiga->CurrentValue;
			$subtigarek->kodeSubTiga->ViewCustomAttributes = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->ViewValue = $subtigarek->namaSubTiga->CurrentValue;
			$subtigarek->namaSubTiga->ViewCustomAttributes = "";

			// id
			$subtigarek->id->ViewValue = $subtigarek->id->CurrentValue;
			$subtigarek->id->ViewCustomAttributes = "";

			// kodePokok
			$subtigarek->kodePokok->LinkCustomAttributes = "";
			$subtigarek->kodePokok->HrefValue = "";
			$subtigarek->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->LinkCustomAttributes = "";
			$subtigarek->kodeSubSatu->HrefValue = "";
			$subtigarek->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->LinkCustomAttributes = "";
			$subtigarek->kodeSubDua->HrefValue = "";
			$subtigarek->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->LinkCustomAttributes = "";
			$subtigarek->kodeSubTiga->HrefValue = "";
			$subtigarek->kodeSubTiga->TooltipValue = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->LinkCustomAttributes = "";
			$subtigarek->namaSubTiga->HrefValue = "";
			$subtigarek->namaSubTiga->TooltipValue = "";

			// id
			$subtigarek->id->LinkCustomAttributes = "";
			$subtigarek->id->HrefValue = "";
			$subtigarek->id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subtigarek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subtigarek->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subtigarek;
		$DeleteRows = TRUE;
		$sSql = $subtigarek->SQL();
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
				$DeleteRows = $subtigarek->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($subtigarek->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subtigarek->CancelMessage <> "") {
				$this->setFailureMessage($subtigarek->CancelMessage);
				$subtigarek->CancelMessage = "";
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
				$subtigarek->Row_Deleted($row);
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
