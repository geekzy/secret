<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "view_pesertainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$view_peserta_delete = new cview_peserta_delete();
$Page =& $view_peserta_delete;

// Page init
$view_peserta_delete->Page_Init();

// Page main
$view_peserta_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var view_peserta_delete = new ew_Page("view_peserta_delete");

// page properties
view_peserta_delete.PageID = "delete"; // page ID
view_peserta_delete.FormID = "fview_pesertadelete"; // form ID
var EW_PAGE_ID = view_peserta_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
view_peserta_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
view_peserta_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
view_peserta_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_peserta_delete.ValidateRequired = false; // no JavaScript validation
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
if ($view_peserta_delete->Recordset = $view_peserta_delete->LoadRecordset())
	$view_peserta_deleteTotalRecs = $view_peserta_delete->Recordset->RecordCount(); // Get record count
if ($view_peserta_deleteTotalRecs <= 0) { // No record found, exit
	if ($view_peserta_delete->Recordset)
		$view_peserta_delete->Recordset->Close();
	$view_peserta_delete->Page_Terminate("view_pesertalist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_peserta->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $view_peserta->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $view_peserta_delete->ShowPageHeader(); ?>
<?php
$view_peserta_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="view_peserta">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($view_peserta_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $view_peserta->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $view_peserta->identitas->FldCaption() ?></td>
		<td valign="top"><?php echo $view_peserta->A_nama_Lengkap->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$view_peserta_delete->RecCnt = 0;
$i = 0;
while (!$view_peserta_delete->Recordset->EOF) {
	$view_peserta_delete->RecCnt++;

	// Set row properties
	$view_peserta->ResetAttrs();
	$view_peserta->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$view_peserta_delete->LoadRowValues($view_peserta_delete->Recordset);

	// Render row
	$view_peserta_delete->RenderRow();
?>
	<tr<?php echo $view_peserta->RowAttributes() ?>>
		<td<?php echo $view_peserta->identitas->CellAttributes() ?>>
<div<?php echo $view_peserta->identitas->ViewAttributes() ?>><?php echo $view_peserta->identitas->ListViewValue() ?></div></td>
		<td<?php echo $view_peserta->A_nama_Lengkap->CellAttributes() ?>>
<div<?php echo $view_peserta->A_nama_Lengkap->ViewAttributes() ?>><?php echo $view_peserta->A_nama_Lengkap->ListViewValue() ?></div></td>
	</tr>
<?php
	$view_peserta_delete->Recordset->MoveNext();
}
$view_peserta_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$view_peserta_delete->ShowPageFooter();
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
$view_peserta_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_peserta_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'view_peserta';

	// Page object name
	var $PageObjName = 'view_peserta_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_peserta;
		if ($view_peserta->UseTokenInUrl) $PageUrl .= "t=" . $view_peserta->TableVar . "&"; // Add page token
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
		global $objForm, $view_peserta;
		if ($view_peserta->UseTokenInUrl) {
			if ($objForm)
				return ($view_peserta->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_peserta->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_peserta_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (view_peserta)
		if (!isset($GLOBALS["view_peserta"])) {
			$GLOBALS["view_peserta"] = new cview_peserta();
			$GLOBALS["Table"] =& $GLOBALS["view_peserta"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_peserta', TRUE);

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
		global $view_peserta;

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
			$this->Page_Terminate("view_pesertalist.php");
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
		global $Language, $view_peserta;

		// Load key parameters
		$this->RecKeys = $view_peserta->GetRecordKeys(); // Load record keys
		$sFilter = $view_peserta->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("view_pesertalist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in view_peserta class, view_pesertainfo.php

		$view_peserta->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$view_peserta->CurrentAction = $_POST["a_delete"];
		} else {
			$view_peserta->CurrentAction = "I"; // Display record
		}
		switch ($view_peserta->CurrentAction) {
			case "D": // Delete
				$view_peserta->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($view_peserta->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view_peserta;

		// Call Recordset Selecting event
		$view_peserta->Recordset_Selecting($view_peserta->CurrentFilter);

		// Load List page SQL
		$sSql = $view_peserta->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view_peserta->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view_peserta;
		$sFilter = $view_peserta->KeyFilter();

		// Call Row Selecting event
		$view_peserta->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view_peserta->CurrentFilter = $sFilter;
		$sSql = $view_peserta->SQL();
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
		global $conn, $view_peserta;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$view_peserta->Row_Selected($row);
		$view_peserta->identitas->setDbValue($rs->fields('identitas'));
		$view_peserta->kode_otomatis_kelompok->setDbValue($rs->fields('kode_otomatis_kelompok'));
		$view_peserta->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$view_peserta->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_peserta;

		// Initialize URLs
		// Call Row_Rendering event

		$view_peserta->Row_Rendering();

		// Common render codes for all row types
		// identitas
		// kode_otomatis_kelompok

		$view_peserta->kode_otomatis_kelompok->CellCssStyle = "white-space: nowrap;";

		// kode_otomatis
		$view_peserta->kode_otomatis->CellCssStyle = "white-space: nowrap;";

		// A_nama_Lengkap
		if ($view_peserta->RowType == EW_ROWTYPE_VIEW) { // View row

			// identitas
			$view_peserta->identitas->ViewValue = $view_peserta->identitas->CurrentValue;
			$view_peserta->identitas->ViewCustomAttributes = "";

			// kode_otomatis_kelompok
			$view_peserta->kode_otomatis_kelompok->ViewValue = $view_peserta->kode_otomatis_kelompok->CurrentValue;
			$view_peserta->kode_otomatis_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$view_peserta->kode_otomatis->ViewValue = $view_peserta->kode_otomatis->CurrentValue;
			$view_peserta->kode_otomatis->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$view_peserta->A_nama_Lengkap->ViewValue = $view_peserta->A_nama_Lengkap->CurrentValue;
			$view_peserta->A_nama_Lengkap->ViewCustomAttributes = "";

			// identitas
			$view_peserta->identitas->LinkCustomAttributes = "";
			$view_peserta->identitas->HrefValue = "";
			$view_peserta->identitas->TooltipValue = "";

			// A_nama_Lengkap
			$view_peserta->A_nama_Lengkap->LinkCustomAttributes = "";
			$view_peserta->A_nama_Lengkap->HrefValue = "";
			$view_peserta->A_nama_Lengkap->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($view_peserta->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_peserta->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
function DeleteRows() {

// AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
global $conn, $Language, $Security, $view_peserta;
$DeleteRows = TRUE;
$sSql = $view_peserta->SQL();
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
$DeleteRows = $view_peserta->Row_Deleting($row);
if (!$DeleteRows) break;
}
}
if ($DeleteRows) {

//$GLOBAL['urutan']=array();
//global $konter;
$urut=array();
$_SESSION['array_siswa']=$urut;
//$konter=0;
//$GLOBAL['konter']=0;
$sKey = "";
foreach ($rsold as $row) {
$sThisKey = "";
if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
$sThisKey .= $row['kode_otomatis'];
$conn->raiseErrorFn = 'ew_ErrorFn';

array_push($urut,$row['identitas']);

$DeleteRows = $conn->Execute("SELECT 1");


$conn->raiseErrorFn = '';
if ($DeleteRows === FALSE)
break;
if ($sKey <> "") $sKey .= ", ";
$sKey .= $sThisKey;
}
} else {

// Set up error message
if ($view_peserta->CancelMessage <> "") {
$this->setFailureMessage($view_peserta->CancelMessage);
$view_peserta->CancelMessage = "";
} else {
$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
}
}
if ($DeleteRows) {
$conn->CommitTrans(); // Commit the changes
$_SESSION['array_siswa']=$urut;
} else {
$conn->RollbackTrans(); // Rollback changes
}

// Call Row Deleted event
if ($DeleteRows) {
foreach ($rsold as $row) {
$view_peserta->Row_Deleted($row);
}
}
return $DeleteRows;
}  
		// Page Load event
	function Page_Load() {  
		global $Language;
		$Language->setPhrase("DeleteBtn","Ya, Entrikan Tanggungan Untuk Siswa Diatas.");     
		$Language->setPhrase("Delete","Anda Yakin Mengentrikan Siswa Berikut ?"); 
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
