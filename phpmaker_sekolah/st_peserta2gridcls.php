<?php include_once "penggunainfo.php" ?>
<?php

//
// Page class
//
class cst_peserta2_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'st_peserta2';

	// Page object name
	var $PageObjName = 'st_peserta2_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_peserta2;
		if ($st_peserta2->UseTokenInUrl) $PageUrl .= "t=" . $st_peserta2->TableVar . "&"; // Add page token
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
		global $objForm, $st_peserta2;
		if ($st_peserta2->UseTokenInUrl) {
			if ($objForm)
				return ($st_peserta2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_peserta2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_peserta2_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_peserta2)
		if (!isset($GLOBALS["st_peserta2"])) {
			$GLOBALS["st_peserta2"] = new cst_peserta2();
			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["st_peserta2"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_peserta2', TRUE);

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
		global $st_peserta2;

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
			$st_peserta2->GridAddRowCount = $gridaddcnt;

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
		global $st_peserta2;
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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $st_peserta2;

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
			if ($st_peserta2->Export <> "" ||
				$st_peserta2->CurrentAction == "gridadd" ||
				$st_peserta2->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($st_peserta2->AllowAddDeleteRow) {
				if ($st_peserta2->CurrentAction == "gridadd" ||
					$st_peserta2->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($st_peserta2->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $st_peserta2->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $st_peserta2->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $st_peserta2->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($st_peserta2->getMasterFilter() <> "" && $st_peserta2->getCurrentMasterTable() == "st_master_kelas_kelompok") {
			global $st_master_kelas_kelompok;
			$rsmaster = $st_master_kelas_kelompok->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($st_peserta2->getReturnUrl()); // Return to caller
			} else {
				$st_master_kelas_kelompok->LoadListRowValues($rsmaster);
				$st_master_kelas_kelompok->RowType = EW_ROWTYPE_MASTER; // Master row
				$st_master_kelas_kelompok->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$st_peserta2->setSessionWhere($sFilter);
		$st_peserta2->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $st_peserta2;
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
			$st_peserta2->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$st_peserta2->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $st_peserta2;
		$st_peserta2->LastAction = $st_peserta2->CurrentAction; // Save last action
		$st_peserta2->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $st_peserta2;
		$bGridUpdate = TRUE;

		// Get old recordset
		$st_peserta2->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $st_peserta2->SQL();
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
						$st_peserta2->CurrentFilter = $st_peserta2->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$st_peserta2->SendEmail = FALSE; // Do not send email on update success
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
			$st_peserta2->EventCancelled = TRUE; // Set event cancelled
			$st_peserta2->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $st_peserta2;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $st_peserta2->KeyFilter();
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
		global $st_peserta2;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$st_peserta2->kode_otomatis->setFormValue($arrKeyFlds[0]);
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $st_peserta2;
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
				$st_peserta2->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $st_peserta2->kode_otomatis->CurrentValue;

					// Add filter for this record
					$sFilter = $st_peserta2->KeyFilter();
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
			$st_peserta2->CurrentFilter = $sWrkFilter;
			$sSql = $st_peserta2->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$st_peserta2->EventCancelled = TRUE; // Set event cancelled
			$st_peserta2->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $st_peserta2, $objForm;
		if ($objForm->HasValue("x_identitas") && $objForm->HasValue("o_identitas") && $st_peserta2->identitas->CurrentValue <> $st_peserta2->identitas->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_A_nama_Lengkap") && $objForm->HasValue("o_A_nama_Lengkap") && $st_peserta2->A_nama_Lengkap->CurrentValue <> $st_peserta2->A_nama_Lengkap->OldValue)
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
		global $objForm, $st_peserta2;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $st_peserta2;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$st_peserta2->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$st_peserta2->CurrentOrderType = @$_GET["ordertype"];
			$st_peserta2->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $st_peserta2;
		$sOrderBy = $st_peserta2->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($st_peserta2->SqlOrderBy() <> "") {
				$sOrderBy = $st_peserta2->SqlOrderBy();
				$st_peserta2->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $st_peserta2;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$st_peserta2->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$st_peserta2->kode_otomatis_kelompok->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$st_peserta2->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$st_peserta2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $st_peserta2;

		// "griddelete"
		if ($st_peserta2->AllowAddDeleteRow) {
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
		global $Security, $Language, $st_peserta2, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($st_peserta2->RowType == EW_ROWTYPE_ADD)
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
		if ($st_peserta2->AllowAddDeleteRow) {
			if ($st_peserta2->CurrentMode == "add" || $st_peserta2->CurrentMode == "copy" || $st_peserta2->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, st_peserta2_grid, " . $this->RowIndex . ");\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
				}
			}
		}
		if ($st_peserta2->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $st_peserta2->kode_otomatis->CurrentValue . "\">";
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
		global $Security, $Language, $st_peserta2;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $st_peserta2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$st_peserta2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$st_peserta2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $st_peserta2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$st_peserta2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$st_peserta2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$st_peserta2->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $st_peserta2;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_peserta2;
		$st_peserta2->identitas->CurrentValue = NULL;
		$st_peserta2->identitas->OldValue = $st_peserta2->identitas->CurrentValue;
		$st_peserta2->A_nama_Lengkap->CurrentValue = 0;
		$st_peserta2->A_nama_Lengkap->OldValue = $st_peserta2->A_nama_Lengkap->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_peserta2;
		if (!$st_peserta2->identitas->FldIsDetailKey) {
			$st_peserta2->identitas->setFormValue($objForm->GetValue("x_identitas"));
		}
		$st_peserta2->identitas->setOldValue($objForm->GetValue("o_identitas"));
		if (!$st_peserta2->A_nama_Lengkap->FldIsDetailKey) {
			$st_peserta2->A_nama_Lengkap->setFormValue($objForm->GetValue("x_A_nama_Lengkap"));
		}
		$st_peserta2->A_nama_Lengkap->setOldValue($objForm->GetValue("o_A_nama_Lengkap"));
		if (!$st_peserta2->kode_otomatis->FldIsDetailKey)
			$st_peserta2->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_peserta2;
		$st_peserta2->kode_otomatis->CurrentValue = $st_peserta2->kode_otomatis->FormValue;
		$st_peserta2->identitas->CurrentValue = $st_peserta2->identitas->FormValue;
		$st_peserta2->A_nama_Lengkap->CurrentValue = $st_peserta2->A_nama_Lengkap->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_peserta2;

		// Call Recordset Selecting event
		$st_peserta2->Recordset_Selecting($st_peserta2->CurrentFilter);

		// Load List page SQL
		$sSql = $st_peserta2->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_peserta2->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_peserta2;
		$sFilter = $st_peserta2->KeyFilter();

		// Call Row Selecting event
		$st_peserta2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_peserta2->CurrentFilter = $sFilter;
		$sSql = $st_peserta2->SQL();
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
		global $conn, $st_peserta2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_peserta2->Row_Selected($row);
		$st_peserta2->identitas->setDbValue($rs->fields('identitas'));
		$st_peserta2->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
		$st_peserta2->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$st_peserta2->kode_otomatis_kelompok->setDbValue($rs->fields('kode_otomatis_kelompok'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_peserta2;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$st_peserta2->kode_otomatis->CurrentValue = strval($arKeys[0]); // kode_otomatis
			else
				$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$st_peserta2->CurrentFilter = $st_peserta2->KeyFilter();
			$sSql = $st_peserta2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_peserta2;

		// Initialize URLs
		// Call Row_Rendering event

		$st_peserta2->Row_Rendering();

		// Common render codes for all row types
		// identitas
		// A_nama_Lengkap
		// kode_otomatis
		// kode_otomatis_kelompok

		if ($st_peserta2->RowType == EW_ROWTYPE_VIEW) { // View row

			// identitas
			if (strval($st_peserta2->identitas->CurrentValue) <> "") {
				$sFilterWrk = "`A_nis_nasional` = '" . ew_AdjustSql($st_peserta2->identitas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `A_nis_nasional`, `A_nama_Lengkap` FROM `master_siswa`";
			$sWhereWrk = "";
			$lookuptblfilter = " D_saat_ini_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' "  . " AND apakah_valid='y' " . " AND NOT EXISTS (SELECT identitas,apakah_valid FROM st_peserta_kelas_kelompok,st_master_kelas_kelompok WHERE st_peserta_kelas_kelompok.kode_otomatis_kelompok=st_master_kelas_kelompok.kode_otomatis AND apakah_valid='y' AND kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND A_nis_nasional=identitas "  . ") ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$st_peserta2->identitas->ViewValue = $rswrk->fields('A_nis_nasional');
					$st_peserta2->identitas->ViewValue .= ew_ValueSeparator(0,1,$st_peserta2->identitas) . $rswrk->fields('A_nama_Lengkap');
					$rswrk->Close();
				} else {
					$st_peserta2->identitas->ViewValue = $st_peserta2->identitas->CurrentValue;
				}
			} else {
				$st_peserta2->identitas->ViewValue = NULL;
			}
			$st_peserta2->identitas->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->ViewValue = $st_peserta2->A_nama_Lengkap->CurrentValue;
			$st_peserta2->A_nama_Lengkap->ViewCustomAttributes = "";

			// kode_otomatis
			$st_peserta2->kode_otomatis->ViewValue = $st_peserta2->kode_otomatis->CurrentValue;
			$st_peserta2->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_kelompok
			$st_peserta2->kode_otomatis_kelompok->ViewValue = $st_peserta2->kode_otomatis_kelompok->CurrentValue;
			$st_peserta2->kode_otomatis_kelompok->ViewCustomAttributes = "";

			// identitas
			$st_peserta2->identitas->LinkCustomAttributes = "";
			$st_peserta2->identitas->HrefValue = "";
			$st_peserta2->identitas->TooltipValue = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->LinkCustomAttributes = "";
			$st_peserta2->A_nama_Lengkap->HrefValue = "";
			$st_peserta2->A_nama_Lengkap->TooltipValue = "";
		} elseif ($st_peserta2->RowType == EW_ROWTYPE_ADD) { // Add row

			// identitas
			$st_peserta2->identitas->EditCustomAttributes = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->EditCustomAttributes = "";
			$st_peserta2->A_nama_Lengkap->CurrentValue = 0;

			// Edit refer script
			// identitas

			$st_peserta2->identitas->HrefValue = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->HrefValue = "";
		} elseif ($st_peserta2->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// identitas
			$st_peserta2->identitas->EditCustomAttributes = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->EditCustomAttributes = "";

			// Edit refer script
			// identitas

			$st_peserta2->identitas->HrefValue = "";

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->HrefValue = "";
		}
		if ($st_peserta2->RowType == EW_ROWTYPE_ADD ||
			$st_peserta2->RowType == EW_ROWTYPE_EDIT ||
			$st_peserta2->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_peserta2->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_peserta2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_peserta2->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_peserta2;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_peserta2->identitas->FormValue) && $st_peserta2->identitas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_peserta2->identitas->FldCaption());
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
		global $conn, $Language, $Security, $st_peserta2;
		$DeleteRows = TRUE;
		$sSql = $st_peserta2->SQL();
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
				$DeleteRows = $st_peserta2->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($st_peserta2->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($st_peserta2->CancelMessage <> "") {
				$this->setFailureMessage($st_peserta2->CancelMessage);
				$st_peserta2->CancelMessage = "";
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
				$st_peserta2->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $st_peserta2;
		$sFilter = $st_peserta2->KeyFilter();
		$st_peserta2->CurrentFilter = $sFilter;
		$sSql = $st_peserta2->SQL();
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

			// identitas
			$st_peserta2->identitas->SetDbValueDef($rsnew, $st_peserta2->identitas->CurrentValue, "", $st_peserta2->identitas->ReadOnly);

			// A_nama_Lengkap
			$st_peserta2->A_nama_Lengkap->SetDbValueDef($rsnew, $st_peserta2->A_nama_Lengkap->CurrentValue, "", $st_peserta2->A_nama_Lengkap->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $st_peserta2->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($st_peserta2->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($st_peserta2->CancelMessage <> "") {
					$this->setFailureMessage($st_peserta2->CancelMessage);
					$st_peserta2->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$st_peserta2->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $st_peserta2;

		// Set up foreign key field value from Session
			if ($st_peserta2->getCurrentMasterTable() == "st_master_kelas_kelompok") {
				$st_peserta2->kode_otomatis_kelompok->CurrentValue = $st_peserta2->kode_otomatis_kelompok->getSessionValue();
			}

		// Check if key value entered
		if ($st_peserta2->kode_otomatis->CurrentValue == "" && $st_peserta2->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_peserta2->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_peserta2->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_peserta2->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_peserta2->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_peserta2->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_peserta2->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// identitas
		$st_peserta2->identitas->SetDbValueDef($rsnew, $st_peserta2->identitas->CurrentValue, "", FALSE);

		// A_nama_Lengkap
		$st_peserta2->A_nama_Lengkap->SetDbValueDef($rsnew, $st_peserta2->A_nama_Lengkap->CurrentValue, "", FALSE);

		// kode_otomatis_kelompok
		if ($st_peserta2->kode_otomatis_kelompok->getSessionValue() <> "") {
			$rsnew['kode_otomatis_kelompok'] = $st_peserta2->kode_otomatis_kelompok->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_peserta2->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_peserta2->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_peserta2->CancelMessage <> "") {
				$this->setFailureMessage($st_peserta2->CancelMessage);
				$st_peserta2->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$st_peserta2->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $st_peserta2;

		// Hide foreign keys
		$sMasterTblVar = $st_peserta2->getCurrentMasterTable();
		if ($sMasterTblVar == "st_master_kelas_kelompok") {
			$st_peserta2->kode_otomatis_kelompok->Visible = FALSE;
			if ($GLOBALS["st_master_kelas_kelompok"]->EventCancelled) $st_peserta2->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $st_peserta2->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $st_peserta2->getDetailFilter(); // Get detail filter
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
