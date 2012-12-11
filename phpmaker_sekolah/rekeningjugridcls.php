<?php include_once "penggunainfo.php" ?>
<?php

//
// Page class
//
class crekeningju_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'rekeningju';

	// Page object name
	var $PageObjName = 'rekeningju_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rekeningju;
		if ($rekeningju->UseTokenInUrl) $PageUrl .= "t=" . $rekeningju->TableVar . "&"; // Add page token
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
		global $objForm, $rekeningju;
		if ($rekeningju->UseTokenInUrl) {
			if ($objForm)
				return ($rekeningju->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rekeningju->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crekeningju_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (rekeningju)
		if (!isset($GLOBALS["rekeningju"])) {
			$GLOBALS["rekeningju"] = new crekeningju();
			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["rekeningju"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rekeningju', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $rekeningju;

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$rekeningju->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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
		global $rekeningju;
		$GLOBALS["Table"] =& $GLOBALS["MasterTable"];
		if ($url == "")
			return;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $rekeningju;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($rekeningju->Export <> "" ||
				$rekeningju->CurrentAction == "gridadd" ||
				$rekeningju->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($rekeningju->AllowAddDeleteRow) {
				if ($rekeningju->CurrentAction == "gridadd" ||
					$rekeningju->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($rekeningju->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $rekeningju->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $rekeningju->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $rekeningju->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($rekeningju->getMasterFilter() <> "" && $rekeningju->getCurrentMasterTable() == "master_transaksi2") {
			global $master_transaksi2;
			$rsmaster = $master_transaksi2->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($rekeningju->getReturnUrl()); // Return to caller
			} else {
				$master_transaksi2->LoadListRowValues($rsmaster);
				$master_transaksi2->RowType = EW_ROWTYPE_MASTER; // Master row
				$master_transaksi2->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$rekeningju->setSessionWhere($sFilter);
		$rekeningju->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $rekeningju;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$rekeningju->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$rekeningju->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $rekeningju;
		$rekeningju->LastAction = $rekeningju->CurrentAction; // Save last action
		$rekeningju->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $rekeningju;
		$bGridUpdate = TRUE;

		// Get old recordset
		$rekeningju->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $rekeningju->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue("k_key"));
			$rowaction = strval($objForm->GetValue("k_action"));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$rekeningju->CurrentFilter = $rekeningju->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$rekeningju->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$rekeningju->EventCancelled = TRUE; // Set event cancelled
			$rekeningju->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $rekeningju;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $rekeningju->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $rekeningju;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$rekeningju->kode_otomatis->setFormValue($arrKeyFlds[0]);
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $rekeningju;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
				$this->LoadOldRecord(); // Load old recordset
			}
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$rekeningju->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $rekeningju->kode_otomatis->CurrentValue;

					// Add filter for this record
					$sFilter = $rekeningju->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->ClearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($bGridInsert) {

			// Get new recordset
			$rekeningju->CurrentFilter = $sWrkFilter;
			$sSql = $rekeningju->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$rekeningju->EventCancelled = TRUE; // Set event cancelled
			$rekeningju->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $rekeningju, $objForm;
		if ($objForm->HasValue("x_NoRek") && $objForm->HasValue("o_NoRek") && $rekeningju->NoRek->CurrentValue <> $rekeningju->NoRek->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Keterangan") && $objForm->HasValue("o_Keterangan") && $rekeningju->Keterangan->CurrentValue <> $rekeningju->Keterangan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_debet") && $objForm->HasValue("o_debet") && $rekeningju->debet->CurrentValue <> $rekeningju->debet->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kredit") && $objForm->HasValue("o_kredit") && $rekeningju->kredit->CurrentValue <> $rekeningju->kredit->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_bukti") && $objForm->HasValue("o_kode_bukti") && $rekeningju->kode_bukti->CurrentValue <> $rekeningju->kode_bukti->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tanggal") && $objForm->HasValue("o_tanggal") && $rekeningju->tanggal->CurrentValue <> $rekeningju->tanggal->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tanggal_nota") && $objForm->HasValue("o_tanggal_nota") && $rekeningju->tanggal_nota->CurrentValue <> $rekeningju->tanggal_nota->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis") && $objForm->HasValue("o_kode_otomatis") && $rekeningju->kode_otomatis->CurrentValue <> $rekeningju->kode_otomatis->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis_tingkat") && $objForm->HasValue("o_kode_otomatis_tingkat") && $rekeningju->kode_otomatis_tingkat->CurrentValue <> $rekeningju->kode_otomatis_tingkat->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_apakah_original") && $objForm->HasValue("o_apakah_original") && $rekeningju->apakah_original->CurrentValue <> $rekeningju->apakah_original->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $rekeningju;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $rekeningju;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$rekeningju->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$rekeningju->CurrentOrderType = @$_GET["ordertype"];
			$rekeningju->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $rekeningju;
		$sOrderBy = $rekeningju->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($rekeningju->SqlOrderBy() <> "") {
				$sOrderBy = $rekeningju->SqlOrderBy();
				$rekeningju->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $rekeningju;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$rekeningju->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$rekeningju->kode_otomatis_master->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$rekeningju->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$rekeningju->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $rekeningju;

		// "griddelete"
		if ($rekeningju->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $rekeningju, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($rekeningju->RowType == EW_ROWTYPE_ADD)
			$this->RowAction = "insert";
		else
			$this->RowAction = "";
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($objForm->HasValue("k_action"))
				$this->RowAction = strval($objForm->GetValue("k_action"));
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($objForm->HasValue("k_oldkey"))
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_oldkey\" id=\"k" . $this->RowIndex . "_oldkey\" value = \"" . ew_HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
		}

		// "delete"
		if ($rekeningju->AllowAddDeleteRow) {
			if ($rekeningju->CurrentMode == "add" || $rekeningju->CurrentMode == "copy" || $rekeningju->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, rekeningju_grid, " . $this->RowIndex . ");\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
				}
			}
		}
		if ($rekeningju->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $rekeningju->kode_otomatis->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('kode_otomatis');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $rekeningju;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $rekeningju;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$rekeningju->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$rekeningju->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $rekeningju->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$rekeningju->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$rekeningju->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$rekeningju->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $rekeningju;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $rekeningju;
		$rekeningju->NoRek->CurrentValue = "sementara";
		$rekeningju->NoRek->OldValue = $rekeningju->NoRek->CurrentValue;
		$rekeningju->Keterangan->CurrentValue = "-";
		$rekeningju->Keterangan->OldValue = $rekeningju->Keterangan->CurrentValue;
		$rekeningju->debet->CurrentValue = 0;
		$rekeningju->debet->OldValue = $rekeningju->debet->CurrentValue;
		$rekeningju->kredit->CurrentValue = 0;
		$rekeningju->kredit->OldValue = $rekeningju->kredit->CurrentValue;
		$rekeningju->kode_bukti->CurrentValue = "-";
		$rekeningju->kode_bukti->OldValue = $rekeningju->kode_bukti->CurrentValue;
		$rekeningju->tanggal->CurrentValue = "1970-01-01 00:00:00";
		$rekeningju->tanggal->OldValue = $rekeningju->tanggal->CurrentValue;
		$rekeningju->tanggal_nota->CurrentValue = "1970-01-01";
		$rekeningju->tanggal_nota->OldValue = $rekeningju->tanggal_nota->CurrentValue;
		$rekeningju->kode_otomatis->CurrentValue = unik();
		$rekeningju->kode_otomatis->OldValue = $rekeningju->kode_otomatis->CurrentValue;
		$rekeningju->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];
		$rekeningju->kode_otomatis_tingkat->OldValue = $rekeningju->kode_otomatis_tingkat->CurrentValue;
		$rekeningju->apakah_original->CurrentValue = "y";
		$rekeningju->apakah_original->OldValue = $rekeningju->apakah_original->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $rekeningju;
		if (!$rekeningju->NoRek->FldIsDetailKey) {
			$rekeningju->NoRek->setFormValue($objForm->GetValue("x_NoRek"));
		}
		$rekeningju->NoRek->setOldValue($objForm->GetValue("o_NoRek"));
		if (!$rekeningju->Keterangan->FldIsDetailKey) {
			$rekeningju->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		$rekeningju->Keterangan->setOldValue($objForm->GetValue("o_Keterangan"));
		if (!$rekeningju->debet->FldIsDetailKey) {
			$rekeningju->debet->setFormValue($objForm->GetValue("x_debet"));
		}
		$rekeningju->debet->setOldValue($objForm->GetValue("o_debet"));
		if (!$rekeningju->kredit->FldIsDetailKey) {
			$rekeningju->kredit->setFormValue($objForm->GetValue("x_kredit"));
		}
		$rekeningju->kredit->setOldValue($objForm->GetValue("o_kredit"));
		if (!$rekeningju->kode_bukti->FldIsDetailKey) {
			$rekeningju->kode_bukti->setFormValue($objForm->GetValue("x_kode_bukti"));
		}
		$rekeningju->kode_bukti->setOldValue($objForm->GetValue("o_kode_bukti"));
		if (!$rekeningju->tanggal->FldIsDetailKey) {
			$rekeningju->tanggal->setFormValue($objForm->GetValue("x_tanggal"));
			$rekeningju->tanggal->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7);
		}
		$rekeningju->tanggal->setOldValue($objForm->GetValue("o_tanggal"));
		if (!$rekeningju->tanggal_nota->FldIsDetailKey) {
			$rekeningju->tanggal_nota->setFormValue($objForm->GetValue("x_tanggal_nota"));
			$rekeningju->tanggal_nota->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7);
		}
		$rekeningju->tanggal_nota->setOldValue($objForm->GetValue("o_tanggal_nota"));
		if (!$rekeningju->kode_otomatis->FldIsDetailKey) {
			$rekeningju->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		$rekeningju->kode_otomatis->setOldValue($objForm->GetValue("o_kode_otomatis"));
		if (!$rekeningju->kode_otomatis_tingkat->FldIsDetailKey) {
			$rekeningju->kode_otomatis_tingkat->setFormValue($objForm->GetValue("x_kode_otomatis_tingkat"));
		}
		$rekeningju->kode_otomatis_tingkat->setOldValue($objForm->GetValue("o_kode_otomatis_tingkat"));
		if (!$rekeningju->apakah_original->FldIsDetailKey) {
			$rekeningju->apakah_original->setFormValue($objForm->GetValue("x_apakah_original"));
		}
		$rekeningju->apakah_original->setOldValue($objForm->GetValue("o_apakah_original"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $rekeningju;
		$rekeningju->NoRek->CurrentValue = $rekeningju->NoRek->FormValue;
		$rekeningju->Keterangan->CurrentValue = $rekeningju->Keterangan->FormValue;
		$rekeningju->debet->CurrentValue = $rekeningju->debet->FormValue;
		$rekeningju->kredit->CurrentValue = $rekeningju->kredit->FormValue;
		$rekeningju->kode_bukti->CurrentValue = $rekeningju->kode_bukti->FormValue;
		$rekeningju->tanggal->CurrentValue = $rekeningju->tanggal->FormValue;
		$rekeningju->tanggal->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7);
		$rekeningju->tanggal_nota->CurrentValue = $rekeningju->tanggal_nota->FormValue;
		$rekeningju->tanggal_nota->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7);
		$rekeningju->kode_otomatis->CurrentValue = $rekeningju->kode_otomatis->FormValue;
		$rekeningju->kode_otomatis_tingkat->CurrentValue = $rekeningju->kode_otomatis_tingkat->FormValue;
		$rekeningju->apakah_original->CurrentValue = $rekeningju->apakah_original->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $rekeningju;

		// Call Recordset Selecting event
		$rekeningju->Recordset_Selecting($rekeningju->CurrentFilter);

		// Load List page SQL
		$sSql = $rekeningju->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$rekeningju->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rekeningju;
		$sFilter = $rekeningju->KeyFilter();

		// Call Row Selecting event
		$rekeningju->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rekeningju->CurrentFilter = $sFilter;
		$sSql = $rekeningju->SQL();
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
		global $conn, $rekeningju;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$rekeningju->Row_Selected($row);
		$rekeningju->NoRek->setDbValue($rs->fields('NoRek'));
		$rekeningju->Keterangan->setDbValue($rs->fields('Keterangan'));
		$rekeningju->debet->setDbValue($rs->fields('debet'));
		$rekeningju->kredit->setDbValue($rs->fields('kredit'));
		$rekeningju->kode_bukti->setDbValue($rs->fields('kode_bukti'));
		$rekeningju->tanggal->setDbValue($rs->fields('tanggal'));
		$rekeningju->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
		$rekeningju->tanggal_nota->setDbValue($rs->fields('tanggal_nota'));
		$rekeningju->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$rekeningju->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$rekeningju->id->setDbValue($rs->fields('id'));
		$rekeningju->apakah_original->setDbValue($rs->fields('apakah_original'));
	}

	// Load old record
	function LoadOldRecord() {
		global $rekeningju;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$rekeningju->kode_otomatis->CurrentValue = strval($arKeys[0]); // kode_otomatis
			else
				$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$rekeningju->CurrentFilter = $rekeningju->KeyFilter();
			$sSql = $rekeningju->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rekeningju;

		// Initialize URLs
		// Call Row_Rendering event

		$rekeningju->Row_Rendering();

		// Common render codes for all row types
		// NoRek
		// Keterangan
		// debet
		// kredit
		// kode_bukti
		// tanggal
		// kode_otomatis_master

		$rekeningju->kode_otomatis_master->CellCssStyle = "white-space: nowrap;";

		// tanggal_nota
		// kode_otomatis

		$rekeningju->kode_otomatis->CellCssStyle = "white-space: nowrap;";

		// kode_otomatis_tingkat
		$rekeningju->kode_otomatis_tingkat->CellCssStyle = "white-space: nowrap;";

		// id
		$rekeningju->id->CellCssStyle = "white-space: nowrap;";

		// apakah_original
		if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View row

			// NoRek
			if (strval($rekeningju->NoRek->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($rekeningju->NoRek->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rekeningju->NoRek->ViewValue = $rswrk->fields('Norek');
					$rekeningju->NoRek->ViewValue .= ew_ValueSeparator(0,1,$rekeningju->NoRek) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$rekeningju->NoRek->ViewValue = $rekeningju->NoRek->CurrentValue;
				}
			} else {
				$rekeningju->NoRek->ViewValue = NULL;
			}
			$rekeningju->NoRek->ViewCustomAttributes = "";

			// Keterangan
			$rekeningju->Keterangan->ViewValue = $rekeningju->Keterangan->CurrentValue;
			$rekeningju->Keterangan->ViewCustomAttributes = "";

			// debet
			$rekeningju->debet->ViewValue = $rekeningju->debet->CurrentValue;
			$rekeningju->debet->ViewCustomAttributes = "";

			// kredit
			$rekeningju->kredit->ViewValue = $rekeningju->kredit->CurrentValue;
			$rekeningju->kredit->ViewCustomAttributes = "";

			// kode_bukti
			$rekeningju->kode_bukti->ViewValue = $rekeningju->kode_bukti->CurrentValue;
			$rekeningju->kode_bukti->ViewCustomAttributes = "";

			// tanggal
			$rekeningju->tanggal->ViewValue = $rekeningju->tanggal->CurrentValue;
			$rekeningju->tanggal->ViewValue = ew_FormatDateTime($rekeningju->tanggal->ViewValue, 7);
			$rekeningju->tanggal->ViewCustomAttributes = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->ViewValue = $rekeningju->tanggal_nota->CurrentValue;
			$rekeningju->tanggal_nota->ViewValue = ew_FormatDateTime($rekeningju->tanggal_nota->ViewValue, 7);
			$rekeningju->tanggal_nota->ViewCustomAttributes = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->ViewValue = $rekeningju->kode_otomatis->CurrentValue;
			$rekeningju->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->ViewValue = $rekeningju->kode_otomatis_tingkat->CurrentValue;
			$rekeningju->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// apakah_original
			$rekeningju->apakah_original->ViewValue = $rekeningju->apakah_original->CurrentValue;
			$rekeningju->apakah_original->ViewCustomAttributes = "";

			// NoRek
			$rekeningju->NoRek->LinkCustomAttributes = "";
			$rekeningju->NoRek->HrefValue = "";
			$rekeningju->NoRek->TooltipValue = "";

			// Keterangan
			$rekeningju->Keterangan->LinkCustomAttributes = "";
			$rekeningju->Keterangan->HrefValue = "";
			$rekeningju->Keterangan->TooltipValue = "";

			// debet
			$rekeningju->debet->LinkCustomAttributes = "";
			$rekeningju->debet->HrefValue = "";
			$rekeningju->debet->TooltipValue = "";

			// kredit
			$rekeningju->kredit->LinkCustomAttributes = "";
			$rekeningju->kredit->HrefValue = "";
			$rekeningju->kredit->TooltipValue = "";

			// kode_bukti
			$rekeningju->kode_bukti->LinkCustomAttributes = "";
			$rekeningju->kode_bukti->HrefValue = "";
			$rekeningju->kode_bukti->TooltipValue = "";

			// tanggal
			$rekeningju->tanggal->LinkCustomAttributes = "";
			$rekeningju->tanggal->HrefValue = "";
			$rekeningju->tanggal->TooltipValue = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->LinkCustomAttributes = "";
			$rekeningju->tanggal_nota->HrefValue = "";
			$rekeningju->tanggal_nota->TooltipValue = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->LinkCustomAttributes = "";
			$rekeningju->kode_otomatis->HrefValue = "";
			$rekeningju->kode_otomatis->TooltipValue = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$rekeningju->kode_otomatis_tingkat->HrefValue = "";
			$rekeningju->kode_otomatis_tingkat->TooltipValue = "";

			// apakah_original
			$rekeningju->apakah_original->LinkCustomAttributes = "";
			$rekeningju->apakah_original->HrefValue = "";
			$rekeningju->apakah_original->TooltipValue = "";
		} elseif ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add row

			// NoRek
			$rekeningju->NoRek->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$rekeningju->NoRek->EditValue = $arwrk;

			// Keterangan
			$rekeningju->Keterangan->EditCustomAttributes = "";
			$rekeningju->Keterangan->EditValue = ew_HtmlEncode($rekeningju->Keterangan->CurrentValue);

			// debet
			$rekeningju->debet->EditCustomAttributes = "";
			$rekeningju->debet->EditValue = ew_HtmlEncode($rekeningju->debet->CurrentValue);

			// kredit
			$rekeningju->kredit->EditCustomAttributes = "";
			$rekeningju->kredit->EditValue = ew_HtmlEncode($rekeningju->kredit->CurrentValue);

			// kode_bukti
			$rekeningju->kode_bukti->EditCustomAttributes = "";
			$rekeningju->kode_bukti->EditValue = ew_HtmlEncode($rekeningju->kode_bukti->CurrentValue);

			// tanggal
			$rekeningju->tanggal->EditCustomAttributes = "";
			$rekeningju->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal->CurrentValue, 7));

			// tanggal_nota
			$rekeningju->tanggal_nota->EditCustomAttributes = "";
			$rekeningju->tanggal_nota->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7));

			// kode_otomatis
			$rekeningju->kode_otomatis->EditCustomAttributes = "";
			$rekeningju->kode_otomatis->CurrentValue = unik();

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->EditCustomAttributes = "";
			$rekeningju->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];

			// apakah_original
			$rekeningju->apakah_original->EditCustomAttributes = "";
			$rekeningju->apakah_original->EditValue = ew_HtmlEncode($rekeningju->apakah_original->CurrentValue);

			// Edit refer script
			// NoRek

			$rekeningju->NoRek->HrefValue = "";

			// Keterangan
			$rekeningju->Keterangan->HrefValue = "";

			// debet
			$rekeningju->debet->HrefValue = "";

			// kredit
			$rekeningju->kredit->HrefValue = "";

			// kode_bukti
			$rekeningju->kode_bukti->HrefValue = "";

			// tanggal
			$rekeningju->tanggal->HrefValue = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->HrefValue = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->HrefValue = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->HrefValue = "";

			// apakah_original
			$rekeningju->apakah_original->HrefValue = "";
		} elseif ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// NoRek
			$rekeningju->NoRek->EditCustomAttributes = "";

			// Keterangan
			$rekeningju->Keterangan->EditCustomAttributes = "";
			$rekeningju->Keterangan->EditValue = ew_HtmlEncode($rekeningju->Keterangan->CurrentValue);

			// debet
			$rekeningju->debet->EditCustomAttributes = "";
			$rekeningju->debet->EditValue = ew_HtmlEncode($rekeningju->debet->CurrentValue);

			// kredit
			$rekeningju->kredit->EditCustomAttributes = "";
			$rekeningju->kredit->EditValue = ew_HtmlEncode($rekeningju->kredit->CurrentValue);

			// kode_bukti
			$rekeningju->kode_bukti->EditCustomAttributes = "";
			$rekeningju->kode_bukti->EditValue = ew_HtmlEncode($rekeningju->kode_bukti->CurrentValue);

			// tanggal
			$rekeningju->tanggal->EditCustomAttributes = "";
			$rekeningju->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal->CurrentValue, 7));

			// tanggal_nota
			$rekeningju->tanggal_nota->EditCustomAttributes = "";
			$rekeningju->tanggal_nota->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7));

			// kode_otomatis
			$rekeningju->kode_otomatis->EditCustomAttributes = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->EditCustomAttributes = "";

			// apakah_original
			$rekeningju->apakah_original->EditCustomAttributes = "";
			$rekeningju->apakah_original->EditValue = ew_HtmlEncode($rekeningju->apakah_original->CurrentValue);

			// Edit refer script
			// NoRek

			$rekeningju->NoRek->HrefValue = "";

			// Keterangan
			$rekeningju->Keterangan->HrefValue = "";

			// debet
			$rekeningju->debet->HrefValue = "";

			// kredit
			$rekeningju->kredit->HrefValue = "";

			// kode_bukti
			$rekeningju->kode_bukti->HrefValue = "";

			// tanggal
			$rekeningju->tanggal->HrefValue = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->HrefValue = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->HrefValue = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->HrefValue = "";

			// apakah_original
			$rekeningju->apakah_original->HrefValue = "";
		}
		if ($rekeningju->RowType == EW_ROWTYPE_ADD ||
			$rekeningju->RowType == EW_ROWTYPE_EDIT ||
			$rekeningju->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$rekeningju->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($rekeningju->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rekeningju->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $rekeningju;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($rekeningju->NoRek->FormValue) && $rekeningju->NoRek->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->NoRek->FldCaption());
		}
		if (!is_null($rekeningju->debet->FormValue) && $rekeningju->debet->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->debet->FldCaption());
		}
		if (!ew_CheckNumber($rekeningju->debet->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->debet->FldErrMsg());
		}
		if (!is_null($rekeningju->kredit->FormValue) && $rekeningju->kredit->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->kredit->FldCaption());
		}
		if (!ew_CheckNumber($rekeningju->kredit->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->kredit->FldErrMsg());
		}
		if (!is_null($rekeningju->tanggal->FormValue) && $rekeningju->tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->tanggal->FldCaption());
		}
		if (!ew_CheckEuroDate($rekeningju->tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->tanggal->FldErrMsg());
		}
		if (!is_null($rekeningju->tanggal_nota->FormValue) && $rekeningju->tanggal_nota->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->tanggal_nota->FldCaption());
		}
		if (!ew_CheckEuroDate($rekeningju->tanggal_nota->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->tanggal_nota->FldErrMsg());
		}
		if (!is_null($rekeningju->apakah_original->FormValue) && $rekeningju->apakah_original->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->apakah_original->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $rekeningju;
		$DeleteRows = TRUE;
		$sSql = $rekeningju->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $rekeningju->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($rekeningju->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($rekeningju->CancelMessage <> "") {
				$this->setFailureMessage($rekeningju->CancelMessage);
				$rekeningju->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$rekeningju->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $rekeningju;
		$sFilter = $rekeningju->KeyFilter();
		$rekeningju->CurrentFilter = $sFilter;
		$sSql = $rekeningju->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// NoRek
			$rekeningju->NoRek->SetDbValueDef($rsnew, $rekeningju->NoRek->CurrentValue, "", $rekeningju->NoRek->ReadOnly);

			// Keterangan
			$rekeningju->Keterangan->SetDbValueDef($rsnew, $rekeningju->Keterangan->CurrentValue, NULL, $rekeningju->Keterangan->ReadOnly);

			// debet
			$rekeningju->debet->SetDbValueDef($rsnew, $rekeningju->debet->CurrentValue, 0, $rekeningju->debet->ReadOnly);

			// kredit
			$rekeningju->kredit->SetDbValueDef($rsnew, $rekeningju->kredit->CurrentValue, 0, $rekeningju->kredit->ReadOnly);

			// kode_bukti
			$rekeningju->kode_bukti->SetDbValueDef($rsnew, $rekeningju->kode_bukti->CurrentValue, NULL, $rekeningju->kode_bukti->ReadOnly);

			// tanggal
			$rekeningju->tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7), ew_CurrentDate(), $rekeningju->tanggal->ReadOnly);

			// tanggal_nota
			$rekeningju->tanggal_nota->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7), ew_CurrentDate(), $rekeningju->tanggal_nota->ReadOnly);

			// kode_otomatis
			// kode_otomatis_tingkat

			$rekeningju->kode_otomatis_tingkat->SetDbValueDef($rsnew, $rekeningju->kode_otomatis_tingkat->CurrentValue, "", $rekeningju->kode_otomatis_tingkat->ReadOnly);

			// apakah_original
			$rekeningju->apakah_original->SetDbValueDef($rsnew, $rekeningju->apakah_original->CurrentValue, "", $rekeningju->apakah_original->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $rekeningju->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($rekeningju->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($rekeningju->CancelMessage <> "") {
					$this->setFailureMessage($rekeningju->CancelMessage);
					$rekeningju->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$rekeningju->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $rekeningju;

		// Set up foreign key field value from Session
			if ($rekeningju->getCurrentMasterTable() == "master_transaksi2") {
				$rekeningju->kode_otomatis_master->CurrentValue = $rekeningju->kode_otomatis_master->getSessionValue();
			}

		// Check if key value entered
		if ($rekeningju->kode_otomatis->CurrentValue == "" && $rekeningju->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $rekeningju->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $rekeningju->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($rekeningju->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($rekeningju->kode_otomatis->CurrentValue) . "')";
			$rsChk = $rekeningju->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $rekeningju->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// NoRek
		$rekeningju->NoRek->SetDbValueDef($rsnew, $rekeningju->NoRek->CurrentValue, "", strval($rekeningju->NoRek->CurrentValue) == "");

		// Keterangan
		$rekeningju->Keterangan->SetDbValueDef($rsnew, $rekeningju->Keterangan->CurrentValue, NULL, strval($rekeningju->Keterangan->CurrentValue) == "");

		// debet
		$rekeningju->debet->SetDbValueDef($rsnew, $rekeningju->debet->CurrentValue, 0, strval($rekeningju->debet->CurrentValue) == "");

		// kredit
		$rekeningju->kredit->SetDbValueDef($rsnew, $rekeningju->kredit->CurrentValue, 0, strval($rekeningju->kredit->CurrentValue) == "");

		// kode_bukti
		$rekeningju->kode_bukti->SetDbValueDef($rsnew, $rekeningju->kode_bukti->CurrentValue, NULL, strval($rekeningju->kode_bukti->CurrentValue) == "");

		// tanggal
		$rekeningju->tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7), ew_CurrentDate(), strval($rekeningju->tanggal->CurrentValue) == "");

		// tanggal_nota
		$rekeningju->tanggal_nota->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7), ew_CurrentDate(), strval($rekeningju->tanggal_nota->CurrentValue) == "");

		// kode_otomatis
		$rekeningju->kode_otomatis->SetDbValueDef($rsnew, $rekeningju->kode_otomatis->CurrentValue, "", FALSE);

		// kode_otomatis_tingkat
		$rekeningju->kode_otomatis_tingkat->SetDbValueDef($rsnew, $rekeningju->kode_otomatis_tingkat->CurrentValue, "", FALSE);

		// apakah_original
		$rekeningju->apakah_original->SetDbValueDef($rsnew, $rekeningju->apakah_original->CurrentValue, "", strval($rekeningju->apakah_original->CurrentValue) == "");

		// kode_otomatis_master
		if ($rekeningju->kode_otomatis_master->getSessionValue() <> "") {
			$rsnew['kode_otomatis_master'] = $rekeningju->kode_otomatis_master->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $rekeningju->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($rekeningju->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($rekeningju->CancelMessage <> "") {
				$this->setFailureMessage($rekeningju->CancelMessage);
				$rekeningju->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$rekeningju->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $rekeningju->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$rekeningju->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $rekeningju;

		// Hide foreign keys
		$sMasterTblVar = $rekeningju->getCurrentMasterTable();
		if ($sMasterTblVar == "master_transaksi2") {
			$rekeningju->kode_otomatis_master->Visible = FALSE;
			if ($GLOBALS["master_transaksi2"]->EventCancelled) $rekeningju->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $rekeningju->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $rekeningju->getDetailFilter(); // Get detail filter
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
