<?php include_once "penggunainfo.php" ?>
<?php

//
// Page class
//
class ckeu_cicilan_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'keu_cicilan';

	// Page object name
	var $PageObjName = 'keu_cicilan_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) $PageUrl .= "t=" . $keu_cicilan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_cicilan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_cicilan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_cicilan_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_cicilan)
		if (!isset($GLOBALS["keu_cicilan"])) {
			$GLOBALS["keu_cicilan"] = new ckeu_cicilan();
			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["keu_cicilan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_cicilan', TRUE);

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
		global $keu_cicilan;

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
			$keu_cicilan->GridAddRowCount = $gridaddcnt;

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
		global $keu_cicilan;
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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $keu_cicilan;

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
			if ($keu_cicilan->Export <> "" ||
				$keu_cicilan->CurrentAction == "gridadd" ||
				$keu_cicilan->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($keu_cicilan->AllowAddDeleteRow) {
				if ($keu_cicilan->CurrentAction == "gridadd" ||
					$keu_cicilan->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($keu_cicilan->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $keu_cicilan->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $keu_cicilan->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $keu_cicilan->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($keu_cicilan->getMasterFilter() <> "" && $keu_cicilan->getCurrentMasterTable() == "keu_laporan_keuangan") {
			global $keu_laporan_keuangan;
			$rsmaster = $keu_laporan_keuangan->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($keu_cicilan->getReturnUrl()); // Return to caller
			} else {
				$keu_laporan_keuangan->LoadListRowValues($rsmaster);
				$keu_laporan_keuangan->RowType = EW_ROWTYPE_MASTER; // Master row
				$keu_laporan_keuangan->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$keu_cicilan->setSessionWhere($sFilter);
		$keu_cicilan->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $keu_cicilan;
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
			$keu_cicilan->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $keu_cicilan;
		$keu_cicilan->LastAction = $keu_cicilan->CurrentAction; // Save last action
		$keu_cicilan->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $keu_cicilan;
		$bGridUpdate = TRUE;

		// Get old recordset
		$keu_cicilan->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $keu_cicilan->SQL();
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
						$keu_cicilan->CurrentFilter = $keu_cicilan->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$keu_cicilan->SendEmail = FALSE; // Do not send email on update success
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
			$keu_cicilan->EventCancelled = TRUE; // Set event cancelled
			$keu_cicilan->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $keu_cicilan;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $keu_cicilan->KeyFilter();
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
		global $keu_cicilan;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$keu_cicilan->kode_otomatis->setFormValue($arrKeyFlds[0]);
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $keu_cicilan;
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
				$keu_cicilan->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $keu_cicilan->kode_otomatis->CurrentValue;

					// Add filter for this record
					$sFilter = $keu_cicilan->KeyFilter();
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
			$keu_cicilan->CurrentFilter = $sWrkFilter;
			$sSql = $keu_cicilan->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$keu_cicilan->EventCancelled = TRUE; // Set event cancelled
			$keu_cicilan->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $keu_cicilan, $objForm;
		if ($objForm->HasValue("x_cicilan") && $objForm->HasValue("o_cicilan") && $keu_cicilan->cicilan->CurrentValue <> $keu_cicilan->cicilan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tanggal_pembayaran") && $objForm->HasValue("o_tanggal_pembayaran") && $keu_cicilan->tanggal_pembayaran->CurrentValue <> $keu_cicilan->tanggal_pembayaran->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_rek_kas") && $objForm->HasValue("o_rek_kas") && $keu_cicilan->rek_kas->CurrentValue <> $keu_cicilan->rek_kas->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_rek_pendapatan") && $objForm->HasValue("o_rek_pendapatan") && $keu_cicilan->rek_pendapatan->CurrentValue <> $keu_cicilan->rek_pendapatan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis") && $objForm->HasValue("o_kode_otomatis") && $keu_cicilan->kode_otomatis->CurrentValue <> $keu_cicilan->kode_otomatis->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis_tanggungan") && $objForm->HasValue("o_kode_otomatis_tanggungan") && $keu_cicilan->kode_otomatis_tanggungan->CurrentValue <> $keu_cicilan->kode_otomatis_tanggungan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis_master") && $objForm->HasValue("o_kode_otomatis_master") && $keu_cicilan->kode_otomatis_master->CurrentValue <> $keu_cicilan->kode_otomatis_master->OldValue)
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
		global $objForm, $keu_cicilan;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $keu_cicilan;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$keu_cicilan->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$keu_cicilan->CurrentOrderType = @$_GET["ordertype"];
			$keu_cicilan->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $keu_cicilan;
		$sOrderBy = $keu_cicilan->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($keu_cicilan->SqlOrderBy() <> "") {
				$sOrderBy = $keu_cicilan->SqlOrderBy();
				$keu_cicilan->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $keu_cicilan;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$keu_cicilan->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$keu_cicilan->kode_otomatis_tanggungan->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$keu_cicilan->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $keu_cicilan;

		// "griddelete"
		if ($keu_cicilan->AllowAddDeleteRow) {
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
		global $Security, $Language, $keu_cicilan, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($keu_cicilan->RowType == EW_ROWTYPE_ADD)
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
		if ($keu_cicilan->AllowAddDeleteRow) {
			if ($keu_cicilan->CurrentMode == "add" || $keu_cicilan->CurrentMode == "copy" || $keu_cicilan->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, keu_cicilan_grid, " . $this->RowIndex . ");\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
				}
			}
		}
		if ($keu_cicilan->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $keu_cicilan->kode_otomatis->CurrentValue . "\">";
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
		global $Security, $Language, $keu_cicilan;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_cicilan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_cicilan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_cicilan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_cicilan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $keu_cicilan;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $keu_cicilan;
		$keu_cicilan->cicilan->CurrentValue = isi_cicilan();
		$keu_cicilan->cicilan->OldValue = $keu_cicilan->cicilan->CurrentValue;
		$keu_cicilan->tanggal_pembayaran->CurrentValue = ew_CurrentDate();
		$keu_cicilan->tanggal_pembayaran->OldValue = $keu_cicilan->tanggal_pembayaran->CurrentValue;
		$keu_cicilan->rek_kas->CurrentValue = NULL;
		$keu_cicilan->rek_kas->OldValue = $keu_cicilan->rek_kas->CurrentValue;
		$keu_cicilan->rek_pendapatan->CurrentValue = NULL;
		$keu_cicilan->rek_pendapatan->OldValue = $keu_cicilan->rek_pendapatan->CurrentValue;
		$keu_cicilan->kode_otomatis->CurrentValue = unik();
		$keu_cicilan->kode_otomatis->OldValue = $keu_cicilan->kode_otomatis->CurrentValue;
		$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = NULL;
		$keu_cicilan->kode_otomatis_tanggungan->OldValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
		$keu_cicilan->kode_otomatis_master->CurrentValue = "-";
		$keu_cicilan->kode_otomatis_master->OldValue = $keu_cicilan->kode_otomatis_master->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $keu_cicilan;
		if (!$keu_cicilan->cicilan->FldIsDetailKey) {
			$keu_cicilan->cicilan->setFormValue($objForm->GetValue("x_cicilan"));
		}
		$keu_cicilan->cicilan->setOldValue($objForm->GetValue("o_cicilan"));
		if (!$keu_cicilan->tanggal_pembayaran->FldIsDetailKey) {
			$keu_cicilan->tanggal_pembayaran->setFormValue($objForm->GetValue("x_tanggal_pembayaran"));
			$keu_cicilan->tanggal_pembayaran->CurrentValue = ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7);
		}
		$keu_cicilan->tanggal_pembayaran->setOldValue($objForm->GetValue("o_tanggal_pembayaran"));
		if (!$keu_cicilan->rek_kas->FldIsDetailKey) {
			$keu_cicilan->rek_kas->setFormValue($objForm->GetValue("x_rek_kas"));
		}
		$keu_cicilan->rek_kas->setOldValue($objForm->GetValue("o_rek_kas"));
		if (!$keu_cicilan->rek_pendapatan->FldIsDetailKey) {
			$keu_cicilan->rek_pendapatan->setFormValue($objForm->GetValue("x_rek_pendapatan"));
		}
		$keu_cicilan->rek_pendapatan->setOldValue($objForm->GetValue("o_rek_pendapatan"));
		if (!$keu_cicilan->kode_otomatis->FldIsDetailKey) {
			$keu_cicilan->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		$keu_cicilan->kode_otomatis->setOldValue($objForm->GetValue("o_kode_otomatis"));
		if (!$keu_cicilan->kode_otomatis_tanggungan->FldIsDetailKey) {
			$keu_cicilan->kode_otomatis_tanggungan->setFormValue($objForm->GetValue("x_kode_otomatis_tanggungan"));
		}
		$keu_cicilan->kode_otomatis_tanggungan->setOldValue($objForm->GetValue("o_kode_otomatis_tanggungan"));
		if (!$keu_cicilan->kode_otomatis_master->FldIsDetailKey) {
			$keu_cicilan->kode_otomatis_master->setFormValue($objForm->GetValue("x_kode_otomatis_master"));
		}
		$keu_cicilan->kode_otomatis_master->setOldValue($objForm->GetValue("o_kode_otomatis_master"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $keu_cicilan;
		$keu_cicilan->cicilan->CurrentValue = $keu_cicilan->cicilan->FormValue;
		$keu_cicilan->tanggal_pembayaran->CurrentValue = $keu_cicilan->tanggal_pembayaran->FormValue;
		$keu_cicilan->tanggal_pembayaran->CurrentValue = ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7);
		$keu_cicilan->rek_kas->CurrentValue = $keu_cicilan->rek_kas->FormValue;
		$keu_cicilan->rek_pendapatan->CurrentValue = $keu_cicilan->rek_pendapatan->FormValue;
		$keu_cicilan->kode_otomatis->CurrentValue = $keu_cicilan->kode_otomatis->FormValue;
		$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = $keu_cicilan->kode_otomatis_tanggungan->FormValue;
		$keu_cicilan->kode_otomatis_master->CurrentValue = $keu_cicilan->kode_otomatis_master->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_cicilan;

		// Call Recordset Selecting event
		$keu_cicilan->Recordset_Selecting($keu_cicilan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_cicilan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_cicilan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_cicilan;
		$sFilter = $keu_cicilan->KeyFilter();

		// Call Row Selecting event
		$keu_cicilan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_cicilan->CurrentFilter = $sFilter;
		$sSql = $keu_cicilan->SQL();
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
		global $conn, $keu_cicilan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_cicilan->Row_Selected($row);
		$keu_cicilan->cicilan->setDbValue($rs->fields('cicilan'));
		$keu_cicilan->tanggal_pembayaran->setDbValue($rs->fields('tanggal_pembayaran'));
		$keu_cicilan->rek_kas->setDbValue($rs->fields('rek_kas'));
		$keu_cicilan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_cicilan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_cicilan->kode_otomatis_tanggungan->setDbValue($rs->fields('kode_otomatis_tanggungan'));
		$keu_cicilan->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
	}

	// Load old record
	function LoadOldRecord() {
		global $keu_cicilan;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$keu_cicilan->kode_otomatis->CurrentValue = strval($arKeys[0]); // kode_otomatis
			else
				$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$keu_cicilan->CurrentFilter = $keu_cicilan->KeyFilter();
			$sSql = $keu_cicilan->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_cicilan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_cicilan->Row_Rendering();

		// Common render codes for all row types
		// cicilan
		// tanggal_pembayaran
		// rek_kas
		// rek_pendapatan
		// kode_otomatis
		// kode_otomatis_tanggungan
		// kode_otomatis_master

		if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View row

			// cicilan
			$keu_cicilan->cicilan->ViewValue = $keu_cicilan->cicilan->CurrentValue;
			$keu_cicilan->cicilan->ViewCustomAttributes = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->ViewValue = $keu_cicilan->tanggal_pembayaran->CurrentValue;
			$keu_cicilan->tanggal_pembayaran->ViewValue = ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->ViewValue, 7);
			$keu_cicilan->tanggal_pembayaran->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_cicilan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='1' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_kas) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_kas->ViewValue = $keu_cicilan->rek_kas->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_kas->ViewValue = NULL;
			}
			$keu_cicilan->rek_kas->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_cicilan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='4' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_pendapatan->ViewValue = $keu_cicilan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_cicilan->rek_pendapatan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->ViewValue = $keu_cicilan->kode_otomatis->CurrentValue;
			$keu_cicilan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->ViewValue = $keu_cicilan->kode_otomatis_master->CurrentValue;
			$keu_cicilan->kode_otomatis_master->ViewCustomAttributes = "";

			// cicilan
			$keu_cicilan->cicilan->LinkCustomAttributes = "";
			$keu_cicilan->cicilan->HrefValue = "";
			$keu_cicilan->cicilan->TooltipValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->LinkCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";
			$keu_cicilan->tanggal_pembayaran->TooltipValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->LinkCustomAttributes = "";
			$keu_cicilan->rek_kas->HrefValue = "";
			$keu_cicilan->rek_kas->TooltipValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_cicilan->rek_pendapatan->HrefValue = "";
			$keu_cicilan->rek_pendapatan->TooltipValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis->HrefValue = "";
			$keu_cicilan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";
			$keu_cicilan->kode_otomatis_tanggungan->TooltipValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
			$keu_cicilan->kode_otomatis_master->TooltipValue = "";
		} elseif ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add row

			// cicilan
			$keu_cicilan->cicilan->EditCustomAttributes = "";
			$keu_cicilan->cicilan->EditValue = ew_HtmlEncode($keu_cicilan->cicilan->CurrentValue);

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->EditCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->EditValue = ew_HtmlEncode(ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7));

			// rek_kas
			$keu_cicilan->rek_kas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='1' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
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
			$keu_cicilan->rek_kas->EditValue = $arwrk;

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='4' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
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
			$keu_cicilan->rek_pendapatan->EditValue = $arwrk;

			// kode_otomatis
			$keu_cicilan->kode_otomatis->EditCustomAttributes = "";
			$keu_cicilan->kode_otomatis->CurrentValue = unik();

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->EditCustomAttributes = "";
			if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") {
				$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = $keu_cicilan->kode_otomatis_tanggungan->getSessionValue();
				$keu_cicilan->kode_otomatis_tanggungan->OldValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";
			} else {
			$keu_cicilan->kode_otomatis_tanggungan->EditValue = ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue);
			}

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->EditCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->EditValue = ew_HtmlEncode($keu_cicilan->kode_otomatis_master->CurrentValue);

			// Edit refer script
			// cicilan

			$keu_cicilan->cicilan->HrefValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->HrefValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->HrefValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->HrefValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
		} elseif ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// cicilan
			$keu_cicilan->cicilan->EditCustomAttributes = "";
			$keu_cicilan->cicilan->EditValue = ew_HtmlEncode($keu_cicilan->cicilan->CurrentValue);

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->EditCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->EditValue = ew_HtmlEncode(ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7));

			// rek_kas
			$keu_cicilan->rek_kas->EditCustomAttributes = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->EditCustomAttributes = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->EditCustomAttributes = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->EditCustomAttributes = "";
			if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") {
				$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = $keu_cicilan->kode_otomatis_tanggungan->getSessionValue();
				$keu_cicilan->kode_otomatis_tanggungan->OldValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";
			} else {
			}

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->EditCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->EditValue = ew_HtmlEncode($keu_cicilan->kode_otomatis_master->CurrentValue);

			// Edit refer script
			// cicilan

			$keu_cicilan->cicilan->HrefValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->HrefValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->HrefValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->HrefValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
		}
		if ($keu_cicilan->RowType == EW_ROWTYPE_ADD ||
			$keu_cicilan->RowType == EW_ROWTYPE_EDIT ||
			$keu_cicilan->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$keu_cicilan->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($keu_cicilan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_cicilan->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $keu_cicilan;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($keu_cicilan->cicilan->FormValue) && $keu_cicilan->cicilan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->cicilan->FldCaption());
		}
		if (!ew_CheckNumber($keu_cicilan->cicilan->FormValue)) {
			ew_AddMessage($gsFormError, $keu_cicilan->cicilan->FldErrMsg());
		}
		if (!is_null($keu_cicilan->tanggal_pembayaran->FormValue) && $keu_cicilan->tanggal_pembayaran->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->tanggal_pembayaran->FldCaption());
		}
		if (!ew_CheckEuroDate($keu_cicilan->tanggal_pembayaran->FormValue)) {
			ew_AddMessage($gsFormError, $keu_cicilan->tanggal_pembayaran->FldErrMsg());
		}
		if (!is_null($keu_cicilan->rek_kas->FormValue) && $keu_cicilan->rek_kas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->rek_kas->FldCaption());
		}
		if (!is_null($keu_cicilan->rek_pendapatan->FormValue) && $keu_cicilan->rek_pendapatan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->rek_pendapatan->FldCaption());
		}
		if (!is_null($keu_cicilan->kode_otomatis_master->FormValue) && $keu_cicilan->kode_otomatis_master->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->kode_otomatis_master->FldCaption());
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
		global $conn, $Language, $Security, $keu_cicilan;
		$DeleteRows = TRUE;
		$sSql = $keu_cicilan->SQL();
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
				$DeleteRows = $keu_cicilan->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($keu_cicilan->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($keu_cicilan->CancelMessage <> "") {
				$this->setFailureMessage($keu_cicilan->CancelMessage);
				$keu_cicilan->CancelMessage = "";
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
				$keu_cicilan->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $keu_cicilan;
		$sFilter = $keu_cicilan->KeyFilter();
		$keu_cicilan->CurrentFilter = $sFilter;
		$sSql = $keu_cicilan->SQL();
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

			// cicilan
			$keu_cicilan->cicilan->SetDbValueDef($rsnew, $keu_cicilan->cicilan->CurrentValue, 0, $keu_cicilan->cicilan->ReadOnly);

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->SetDbValueDef($rsnew, ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7), ew_CurrentDate(), $keu_cicilan->tanggal_pembayaran->ReadOnly);

			// rek_kas
			$keu_cicilan->rek_kas->SetDbValueDef($rsnew, $keu_cicilan->rek_kas->CurrentValue, "", $keu_cicilan->rek_kas->ReadOnly);

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->SetDbValueDef($rsnew, $keu_cicilan->rek_pendapatan->CurrentValue, "", $keu_cicilan->rek_pendapatan->ReadOnly);

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis_tanggungan->CurrentValue, "", $keu_cicilan->kode_otomatis_tanggungan->ReadOnly);

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis_master->CurrentValue, "", $keu_cicilan->kode_otomatis_master->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $keu_cicilan->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($keu_cicilan->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($keu_cicilan->CancelMessage <> "") {
					$this->setFailureMessage($keu_cicilan->CancelMessage);
					$keu_cicilan->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$keu_cicilan->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $keu_cicilan;

		// Set up foreign key field value from Session
			if ($keu_cicilan->getCurrentMasterTable() == "keu_laporan_keuangan") {
				$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = $keu_cicilan->kode_otomatis_tanggungan->getSessionValue();
			}

		// Check if key value entered
		if ($keu_cicilan->kode_otomatis->CurrentValue == "" && $keu_cicilan->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $keu_cicilan->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $keu_cicilan->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($keu_cicilan->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($keu_cicilan->kode_otomatis->CurrentValue) . "')";
			$rsChk = $keu_cicilan->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $keu_cicilan->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// cicilan
		$keu_cicilan->cicilan->SetDbValueDef($rsnew, $keu_cicilan->cicilan->CurrentValue, 0, strval($keu_cicilan->cicilan->CurrentValue) == "");

		// tanggal_pembayaran
		$keu_cicilan->tanggal_pembayaran->SetDbValueDef($rsnew, ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7), ew_CurrentDate(), strval($keu_cicilan->tanggal_pembayaran->CurrentValue) == "");

		// rek_kas
		$keu_cicilan->rek_kas->SetDbValueDef($rsnew, $keu_cicilan->rek_kas->CurrentValue, "", strval($keu_cicilan->rek_kas->CurrentValue) == "");

		// rek_pendapatan
		$keu_cicilan->rek_pendapatan->SetDbValueDef($rsnew, $keu_cicilan->rek_pendapatan->CurrentValue, "", strval($keu_cicilan->rek_pendapatan->CurrentValue) == "");

		// kode_otomatis
		$keu_cicilan->kode_otomatis->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis->CurrentValue, "", FALSE);

		// kode_otomatis_tanggungan
		$keu_cicilan->kode_otomatis_tanggungan->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis_tanggungan->CurrentValue, "", FALSE);

		// kode_otomatis_master
		$keu_cicilan->kode_otomatis_master->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis_master->CurrentValue, "", strval($keu_cicilan->kode_otomatis_master->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $keu_cicilan->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($keu_cicilan->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($keu_cicilan->CancelMessage <> "") {
				$this->setFailureMessage($keu_cicilan->CancelMessage);
				$keu_cicilan->CancelMessage = "";
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
			$keu_cicilan->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $keu_cicilan;

		// Hide foreign keys
		$sMasterTblVar = $keu_cicilan->getCurrentMasterTable();
		if ($sMasterTblVar == "keu_laporan_keuangan") {
			$keu_cicilan->kode_otomatis_tanggungan->Visible = FALSE;
			if ($GLOBALS["keu_laporan_keuangan"]->EventCancelled) $keu_cicilan->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $keu_cicilan->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $keu_cicilan->getDetailFilter(); // Get detail filter
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
