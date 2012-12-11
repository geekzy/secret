<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pengguna_delete = new cpengguna_delete();
$Page =& $pengguna_delete;

// Page init
$pengguna_delete->Page_Init();

// Page main
$pengguna_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pengguna_delete = new ew_Page("pengguna_delete");

// page properties
pengguna_delete.PageID = "delete"; // page ID
pengguna_delete.FormID = "fpenggunadelete"; // form ID
var EW_PAGE_ID = pengguna_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pengguna_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pengguna_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pengguna_delete.ValidateRequired = false; // no JavaScript validation
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
if ($pengguna_delete->Recordset = $pengguna_delete->LoadRecordset())
	$pengguna_deleteTotalRecs = $pengguna_delete->Recordset->RecordCount(); // Get record count
if ($pengguna_deleteTotalRecs <= 0) { // No record found, exit
	if ($pengguna_delete->Recordset)
		$pengguna_delete->Recordset->Close();
	$pengguna_delete->Page_Terminate("penggunalist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pengguna->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pengguna->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pengguna_delete->ShowPageHeader(); ?>
<?php
$pengguna_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="pengguna">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pengguna_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $pengguna->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $pengguna->id->FldCaption() ?></td>
		<td valign="top"><?php echo $pengguna->nama_pengguna->FldCaption() ?></td>
		<td valign="top"><?php echo $pengguna->password->FldCaption() ?></td>
		<td valign="top"><?php echo $pengguna->username->FldCaption() ?></td>
		<td valign="top"><?php echo $pengguna->kode_otomatis_tingkat->FldCaption() ?></td>
		<td valign="top"><?php echo $pengguna->user_level->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$pengguna_delete->RecCnt = 0;
$i = 0;
while (!$pengguna_delete->Recordset->EOF) {
	$pengguna_delete->RecCnt++;

	// Set row properties
	$pengguna->ResetAttrs();
	$pengguna->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pengguna_delete->LoadRowValues($pengguna_delete->Recordset);

	// Render row
	$pengguna_delete->RenderRow();
?>
	<tr<?php echo $pengguna->RowAttributes() ?>>
		<td<?php echo $pengguna->id->CellAttributes() ?>>
<div<?php echo $pengguna->id->ViewAttributes() ?>><?php echo $pengguna->id->ListViewValue() ?></div></td>
		<td<?php echo $pengguna->nama_pengguna->CellAttributes() ?>>
<div<?php echo $pengguna->nama_pengguna->ViewAttributes() ?>><?php echo $pengguna->nama_pengguna->ListViewValue() ?></div></td>
		<td<?php echo $pengguna->password->CellAttributes() ?>>
<div<?php echo $pengguna->password->ViewAttributes() ?>><?php echo $pengguna->password->ListViewValue() ?></div></td>
		<td<?php echo $pengguna->username->CellAttributes() ?>>
<div<?php echo $pengguna->username->ViewAttributes() ?>><?php echo $pengguna->username->ListViewValue() ?></div></td>
		<td<?php echo $pengguna->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $pengguna->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $pengguna->kode_otomatis_tingkat->ListViewValue() ?></div></td>
		<td<?php echo $pengguna->user_level->CellAttributes() ?>>
<div<?php echo $pengguna->user_level->ViewAttributes() ?>><?php echo $pengguna->user_level->ListViewValue() ?></div></td>
	</tr>
<?php
	$pengguna_delete->Recordset->MoveNext();
}
$pengguna_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$pengguna_delete->ShowPageFooter();
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
$pengguna_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpengguna_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'pengguna';

	// Page object name
	var $PageObjName = 'pengguna_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pengguna;
		if ($pengguna->UseTokenInUrl) $PageUrl .= "t=" . $pengguna->TableVar . "&"; // Add page token
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
		global $objForm, $pengguna;
		if ($pengguna->UseTokenInUrl) {
			if ($objForm)
				return ($pengguna->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pengguna->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpengguna_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pengguna)
		if (!isset($GLOBALS["pengguna"])) {
			$GLOBALS["pengguna"] = new cpengguna();
			$GLOBALS["Table"] =& $GLOBALS["pengguna"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pengguna', TRUE);

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
		global $pengguna;

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
			$this->Page_Terminate("penggunalist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("penggunalist.php");
		}

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
		global $Language, $pengguna;

		// Load key parameters
		$this->RecKeys = $pengguna->GetRecordKeys(); // Load record keys
		$sFilter = $pengguna->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("penggunalist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pengguna class, penggunainfo.php

		$pengguna->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$pengguna->CurrentAction = $_POST["a_delete"];
		} else {
			$pengguna->CurrentAction = "I"; // Display record
		}
		switch ($pengguna->CurrentAction) {
			case "D": // Delete
				$pengguna->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($pengguna->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pengguna;

		// Call Recordset Selecting event
		$pengguna->Recordset_Selecting($pengguna->CurrentFilter);

		// Load List page SQL
		$sSql = $pengguna->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pengguna->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pengguna;
		$sFilter = $pengguna->KeyFilter();

		// Call Row Selecting event
		$pengguna->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pengguna->CurrentFilter = $sFilter;
		$sSql = $pengguna->SQL();
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
		global $conn, $pengguna;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pengguna->Row_Selected($row);
		$pengguna->id->setDbValue($rs->fields('id'));
		$pengguna->nama_pengguna->setDbValue($rs->fields('nama_pengguna'));
		$pengguna->password->setDbValue($rs->fields('password'));
		$pengguna->username->setDbValue($rs->fields('username'));
		$pengguna->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$pengguna->user_level->setDbValue($rs->fields('user_level'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pengguna;

		// Initialize URLs
		// Call Row_Rendering event

		$pengguna->Row_Rendering();

		// Common render codes for all row types
		// id
		// nama_pengguna
		// password
		// username
		// kode_otomatis_tingkat
		// user_level

		if ($pengguna->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pengguna->id->ViewValue = $pengguna->id->CurrentValue;
			$pengguna->id->ViewCustomAttributes = "";

			// nama_pengguna
			$pengguna->nama_pengguna->ViewValue = $pengguna->nama_pengguna->CurrentValue;
			$pengguna->nama_pengguna->ViewCustomAttributes = "";

			// password
			$pengguna->password->ViewValue = $pengguna->password->CurrentValue;
			$pengguna->password->ViewCustomAttributes = "";

			// username
			$pengguna->username->ViewValue = $pengguna->username->CurrentValue;
			$pengguna->username->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			if (strval($pengguna->kode_otomatis_tingkat->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pengguna->kode_otomatis_tingkat->CurrentValue) . "'";
			$sSqlWrk = "SELECT `tingkat` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->kode_otomatis_tingkat->ViewValue = $rswrk->fields('tingkat');
					$rswrk->Close();
				} else {
					$pengguna->kode_otomatis_tingkat->ViewValue = $pengguna->kode_otomatis_tingkat->CurrentValue;
				}
			} else {
				$pengguna->kode_otomatis_tingkat->ViewValue = NULL;
			}
			$pengguna->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// user_level
			if ($Security->CanAdmin()) { // System admin
			if (strval($pengguna->user_level->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($pengguna->user_level->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->user_level->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$pengguna->user_level->ViewValue = $pengguna->user_level->CurrentValue;
				}
			} else {
				$pengguna->user_level->ViewValue = NULL;
			}
			} else {
				$pengguna->user_level->ViewValue = "********";
			}
			$pengguna->user_level->ViewCustomAttributes = "";

			// id
			$pengguna->id->LinkCustomAttributes = "";
			$pengguna->id->HrefValue = "";
			$pengguna->id->TooltipValue = "";

			// nama_pengguna
			$pengguna->nama_pengguna->LinkCustomAttributes = "";
			$pengguna->nama_pengguna->HrefValue = "";
			$pengguna->nama_pengguna->TooltipValue = "";

			// password
			$pengguna->password->LinkCustomAttributes = "";
			$pengguna->password->HrefValue = "";
			$pengguna->password->TooltipValue = "";

			// username
			$pengguna->username->LinkCustomAttributes = "";
			$pengguna->username->HrefValue = "";
			$pengguna->username->TooltipValue = "";

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$pengguna->kode_otomatis_tingkat->HrefValue = "";
			$pengguna->kode_otomatis_tingkat->TooltipValue = "";

			// user_level
			$pengguna->user_level->LinkCustomAttributes = "";
			$pengguna->user_level->HrefValue = "";
			$pengguna->user_level->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pengguna->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pengguna->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pengguna;
		$DeleteRows = TRUE;
		$sSql = $pengguna->SQL();
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
				$DeleteRows = $pengguna->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($pengguna->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pengguna->CancelMessage <> "") {
				$this->setFailureMessage($pengguna->CancelMessage);
				$pengguna->CancelMessage = "";
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
				$pengguna->Row_Deleted($row);
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
