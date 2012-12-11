<?php

// Global variable for table object
$pemilihan_pokok = NULL;

//
// Table class for pemilihan_pokok
//
class cpemilihan_pokok {
	var $TableVar = 'pemilihan_pokok';
	var $TableName = 'pemilihan_pokok';
	var $TableType = 'VIEW';
	var $kodePokok;
	var $nama_pokok;
	var $kodeSubSatu;
	var $nama_sub_satu;
	var $kodeSubDua;
	var $nama_sub_dua;
	var $kodeSubTiga;
	var $nama_sub_tiga;
	var $Norek;
	var $Keterangan;
	var $D2FK;
	var $SaldoAwal;
	var $TanggalSaldo;
	var $Saldo;
	var $target;
	var $id;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = FALSE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 2;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function cpemilihan_pokok() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// kodePokok
		$this->kodePokok = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_kodePokok', 'kodePokok', '`kodePokok`', 200, -1, FALSE, '`EV__kodePokok`', TRUE, FALSE, 'FORMATTED TEXT');
		$this->fields['kodePokok'] =& $this->kodePokok;

		// nama_pokok
		$this->nama_pokok = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_nama_pokok', 'nama_pokok', '`nama_pokok`', 200, -1, FALSE, '`nama_pokok`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nama_pokok'] =& $this->nama_pokok;

		// kodeSubSatu
		$this->kodeSubSatu = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_kodeSubSatu', 'kodeSubSatu', '`kodeSubSatu`', 200, -1, FALSE, '`kodeSubSatu`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kodeSubSatu'] =& $this->kodeSubSatu;

		// nama_sub_satu
		$this->nama_sub_satu = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_nama_sub_satu', 'nama_sub_satu', '`nama_sub_satu`', 200, -1, FALSE, '`nama_sub_satu`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nama_sub_satu'] =& $this->nama_sub_satu;

		// kodeSubDua
		$this->kodeSubDua = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_kodeSubDua', 'kodeSubDua', '`kodeSubDua`', 200, -1, FALSE, '`kodeSubDua`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kodeSubDua'] =& $this->kodeSubDua;

		// nama_sub_dua
		$this->nama_sub_dua = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_nama_sub_dua', 'nama_sub_dua', '`nama_sub_dua`', 200, -1, FALSE, '`nama_sub_dua`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nama_sub_dua'] =& $this->nama_sub_dua;

		// kodeSubTiga
		$this->kodeSubTiga = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_kodeSubTiga', 'kodeSubTiga', '`kodeSubTiga`', 200, -1, FALSE, '`kodeSubTiga`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kodeSubTiga'] =& $this->kodeSubTiga;

		// nama_sub_tiga
		$this->nama_sub_tiga = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_nama_sub_tiga', 'nama_sub_tiga', '`nama_sub_tiga`', 200, -1, FALSE, '`nama_sub_tiga`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nama_sub_tiga'] =& $this->nama_sub_tiga;

		// Norek
		$this->Norek = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_Norek', 'Norek', '`Norek`', 200, -1, FALSE, '`Norek`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['Norek'] =& $this->Norek;

		// Keterangan
		$this->Keterangan = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_Keterangan', 'Keterangan', '`Keterangan`', 200, -1, FALSE, '`Keterangan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['Keterangan'] =& $this->Keterangan;

		// D/K
		$this->D2FK = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_D2FK', 'D/K', '`D/K`', 200, -1, FALSE, '`D/K`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['D/K'] =& $this->D2FK;

		// SaldoAwal
		$this->SaldoAwal = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_SaldoAwal', 'SaldoAwal', '`SaldoAwal`', 5, -1, FALSE, '`SaldoAwal`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->SaldoAwal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['SaldoAwal'] =& $this->SaldoAwal;

		// TanggalSaldo
		$this->TanggalSaldo = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_TanggalSaldo', 'TanggalSaldo', '`TanggalSaldo`', 135, 7, FALSE, '`TanggalSaldo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->TanggalSaldo->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['TanggalSaldo'] =& $this->TanggalSaldo;

		// Saldo
		$this->Saldo = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_Saldo', 'Saldo', '`Saldo`', 5, -1, FALSE, '`Saldo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->Saldo->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Saldo'] =& $this->Saldo;

		// target
		$this->target = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_target', 'target', '`target`', 5, -1, FALSE, '`target`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->target->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['target'] =& $this->target;

		// id
		$this->id = new cField('pemilihan_pokok', 'pemilihan_pokok', 'x_id', 'id', '`id`', 19, -1, FALSE, '`id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "pemilihan_pokok_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`pemilihan_pokok`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlSelectList() { // Select for List page
		return "SELECT * FROM (" .
			"SELECT *, (SELECT CONCAT(`kodePokok`,', ',`namaPokok`) FROM `pokokrek` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`kodePokok` = `pemilihan_pokok`.`kodePokok`) AS `EV__kodePokok` FROM `pemilihan_pokok`" .
			") `EW_TMP_TABLE`";
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->SqlSelectList(), $this->SqlWhere(), $this->SqlGroupBy(), 
				$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
				$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->getSessionBasicSearchKeyword() <> "")
			return TRUE;
		if ($this->kodePokok->AdvancedSearch->SearchValue <> "" ||
			$this->kodePokok->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->kodePokok->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->kodePokok->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `pemilihan_pokok` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `pemilihan_pokok` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `pemilihan_pokok` WHERE ";
		$SQL .= ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "pemilihan_pokoklist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "pemilihan_pokoklist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("pemilihan_pokokview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "pemilihan_pokokadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("pemilihan_pokokedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("pemilihan_pokokadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("pemilihan_pokokdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=pemilihan_pokok" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["id"]; // id

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->kodePokok->setDbValue($rs->fields('kodePokok'));
		$this->nama_pokok->setDbValue($rs->fields('nama_pokok'));
		$this->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$this->nama_sub_satu->setDbValue($rs->fields('nama_sub_satu'));
		$this->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$this->nama_sub_dua->setDbValue($rs->fields('nama_sub_dua'));
		$this->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$this->nama_sub_tiga->setDbValue($rs->fields('nama_sub_tiga'));
		$this->Norek->setDbValue($rs->fields('Norek'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->D2FK->setDbValue($rs->fields('D/K'));
		$this->SaldoAwal->setDbValue($rs->fields('SaldoAwal'));
		$this->TanggalSaldo->setDbValue($rs->fields('TanggalSaldo'));
		$this->Saldo->setDbValue($rs->fields('Saldo'));
		$this->target->setDbValue($rs->fields('target'));
		$this->id->setDbValue($rs->fields('id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// kodePokok
		// nama_pokok
		// kodeSubSatu
		// nama_sub_satu
		// kodeSubDua
		// nama_sub_dua
		// kodeSubTiga
		// nama_sub_tiga
		// Norek
		// Keterangan
		// D/K
		// SaldoAwal
		// TanggalSaldo
		// Saldo
		// target
		// id
		// kodePokok

		if ($this->kodePokok->VirtualValue <> "") {
			$this->kodePokok->ViewValue = $this->kodePokok->VirtualValue;
		} else {
		if (strval($this->kodePokok->CurrentValue) <> "") {
			$sFilterWrk = "`kodePokok` = '" . ew_AdjustSql($this->kodePokok->CurrentValue) . "'";
		$sSqlWrk = "SELECT `kodePokok`, `namaPokok` FROM `pokokrek`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->kodePokok->ViewValue = $rswrk->fields('kodePokok');
				$this->kodePokok->ViewValue .= ew_ValueSeparator(0,1,$this->kodePokok) . $rswrk->fields('namaPokok');
				$rswrk->Close();
			} else {
				$this->kodePokok->ViewValue = $this->kodePokok->CurrentValue;
			}
		} else {
			$this->kodePokok->ViewValue = NULL;
		}
		}
		$this->kodePokok->ViewCustomAttributes = "";

		// nama_pokok
		if (strval($this->nama_pokok->CurrentValue) <> "") {
			$sFilterWrk = "`namaPokok` = '" . ew_AdjustSql($this->nama_pokok->CurrentValue) . "'";
		$sSqlWrk = "SELECT `namaPokok` FROM `pokokrek`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->nama_pokok->ViewValue = $rswrk->fields('namaPokok');
				$rswrk->Close();
			} else {
				$this->nama_pokok->ViewValue = $this->nama_pokok->CurrentValue;
			}
		} else {
			$this->nama_pokok->ViewValue = NULL;
		}
		$this->nama_pokok->ViewCustomAttributes = "";

		// kodeSubSatu
		if (strval($this->kodeSubSatu->CurrentValue) <> "") {
			$sFilterWrk = "`kodeSubSatu` = '" . ew_AdjustSql($this->kodeSubSatu->CurrentValue) . "'";
		$sSqlWrk = "SELECT `kodeSubSatu`, `namaSubSatu` FROM `subsaturek`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->kodeSubSatu->ViewValue = $rswrk->fields('kodeSubSatu');
				$this->kodeSubSatu->ViewValue .= ew_ValueSeparator(0,1,$this->kodeSubSatu) . $rswrk->fields('namaSubSatu');
				$rswrk->Close();
			} else {
				$this->kodeSubSatu->ViewValue = $this->kodeSubSatu->CurrentValue;
			}
		} else {
			$this->kodeSubSatu->ViewValue = NULL;
		}
		$this->kodeSubSatu->ViewCustomAttributes = "";

		// nama_sub_satu
		$this->nama_sub_satu->ViewValue = $this->nama_sub_satu->CurrentValue;
		$this->nama_sub_satu->ViewCustomAttributes = "";

		// kodeSubDua
		$this->kodeSubDua->ViewValue = $this->kodeSubDua->CurrentValue;
		$this->kodeSubDua->ViewCustomAttributes = "";

		// nama_sub_dua
		$this->nama_sub_dua->ViewValue = $this->nama_sub_dua->CurrentValue;
		$this->nama_sub_dua->ViewCustomAttributes = "";

		// kodeSubTiga
		$this->kodeSubTiga->ViewValue = $this->kodeSubTiga->CurrentValue;
		$this->kodeSubTiga->ViewCustomAttributes = "";

		// nama_sub_tiga
		$this->nama_sub_tiga->ViewValue = $this->nama_sub_tiga->CurrentValue;
		$this->nama_sub_tiga->ViewCustomAttributes = "";

		// Norek
		$this->Norek->ViewValue = $this->Norek->CurrentValue;
		$this->Norek->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// D/K
		$this->D2FK->ViewValue = $this->D2FK->CurrentValue;
		$this->D2FK->ViewCustomAttributes = "";

		// SaldoAwal
		$this->SaldoAwal->ViewValue = $this->SaldoAwal->CurrentValue;
		$this->SaldoAwal->ViewCustomAttributes = "";

		// TanggalSaldo
		$this->TanggalSaldo->ViewValue = $this->TanggalSaldo->CurrentValue;
		$this->TanggalSaldo->ViewValue = ew_FormatDateTime($this->TanggalSaldo->ViewValue, 7);
		$this->TanggalSaldo->ViewCustomAttributes = "";

		// Saldo
		$this->Saldo->ViewValue = $this->Saldo->CurrentValue;
		$this->Saldo->ViewCustomAttributes = "";

		// target
		$this->target->ViewValue = $this->target->CurrentValue;
		$this->target->ViewCustomAttributes = "";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kodePokok
		$this->kodePokok->LinkCustomAttributes = "";
		$this->kodePokok->HrefValue = "";
		$this->kodePokok->TooltipValue = "";

		// nama_pokok
		$this->nama_pokok->LinkCustomAttributes = "";
		$this->nama_pokok->HrefValue = "";
		$this->nama_pokok->TooltipValue = "";

		// kodeSubSatu
		$this->kodeSubSatu->LinkCustomAttributes = "";
		$this->kodeSubSatu->HrefValue = "";
		$this->kodeSubSatu->TooltipValue = "";

		// nama_sub_satu
		$this->nama_sub_satu->LinkCustomAttributes = "";
		$this->nama_sub_satu->HrefValue = "";
		$this->nama_sub_satu->TooltipValue = "";

		// kodeSubDua
		$this->kodeSubDua->LinkCustomAttributes = "";
		$this->kodeSubDua->HrefValue = "";
		$this->kodeSubDua->TooltipValue = "";

		// nama_sub_dua
		$this->nama_sub_dua->LinkCustomAttributes = "";
		$this->nama_sub_dua->HrefValue = "";
		$this->nama_sub_dua->TooltipValue = "";

		// kodeSubTiga
		$this->kodeSubTiga->LinkCustomAttributes = "";
		$this->kodeSubTiga->HrefValue = "";
		$this->kodeSubTiga->TooltipValue = "";

		// nama_sub_tiga
		$this->nama_sub_tiga->LinkCustomAttributes = "";
		$this->nama_sub_tiga->HrefValue = "";
		$this->nama_sub_tiga->TooltipValue = "";

		// Norek
		$this->Norek->LinkCustomAttributes = "";
		$this->Norek->HrefValue = "";
		$this->Norek->TooltipValue = "";

		// Keterangan
		$this->Keterangan->LinkCustomAttributes = "";
		$this->Keterangan->HrefValue = "";
		$this->Keterangan->TooltipValue = "";

		// D/K
		$this->D2FK->LinkCustomAttributes = "";
		$this->D2FK->HrefValue = "";
		$this->D2FK->TooltipValue = "";

		// SaldoAwal
		$this->SaldoAwal->LinkCustomAttributes = "";
		$this->SaldoAwal->HrefValue = "";
		$this->SaldoAwal->TooltipValue = "";

		// TanggalSaldo
		$this->TanggalSaldo->LinkCustomAttributes = "";
		$this->TanggalSaldo->HrefValue = "";
		$this->TanggalSaldo->TooltipValue = "";

		// Saldo
		$this->Saldo->LinkCustomAttributes = "";
		$this->Saldo->HrefValue = "";
		$this->Saldo->TooltipValue = "";

		// target
		$this->target->LinkCustomAttributes = "";
		$this->target->HrefValue = "";
		$this->target->TooltipValue = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('kodePokok', $this->kodePokok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_pokok', $this->nama_pokok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kodeSubSatu', $this->kodeSubSatu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_sub_satu', $this->nama_sub_satu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kodeSubDua', $this->kodeSubDua->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_sub_dua', $this->nama_sub_dua->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kodeSubTiga', $this->kodeSubTiga->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_sub_tiga', $this->nama_sub_tiga->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Norek', $this->Norek->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Keterangan', $this->Keterangan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D2FK', $this->D2FK->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('SaldoAwal', $this->SaldoAwal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('TanggalSaldo', $this->TanggalSaldo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Saldo', $this->Saldo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('target', $this->target->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id', $this->id->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('kodePokok', $this->kodePokok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_pokok', $this->nama_pokok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kodeSubSatu', $this->kodeSubSatu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_sub_satu', $this->nama_sub_satu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kodeSubDua', $this->kodeSubDua->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_sub_dua', $this->nama_sub_dua->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kodeSubTiga', $this->kodeSubTiga->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_sub_tiga', $this->nama_sub_tiga->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Norek', $this->Norek->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Keterangan', $this->Keterangan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('D2FK', $this->D2FK->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('SaldoAwal', $this->SaldoAwal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('TanggalSaldo', $this->TanggalSaldo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Saldo', $this->Saldo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('target', $this->target->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id', $this->id->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->kodePokok);
				$Doc->ExportCaption($this->nama_pokok);
				$Doc->ExportCaption($this->kodeSubSatu);
				$Doc->ExportCaption($this->nama_sub_satu);
				$Doc->ExportCaption($this->kodeSubDua);
				$Doc->ExportCaption($this->nama_sub_dua);
				$Doc->ExportCaption($this->kodeSubTiga);
				$Doc->ExportCaption($this->nama_sub_tiga);
				$Doc->ExportCaption($this->Norek);
				$Doc->ExportCaption($this->Keterangan);
				$Doc->ExportCaption($this->D2FK);
				$Doc->ExportCaption($this->SaldoAwal);
				$Doc->ExportCaption($this->TanggalSaldo);
				$Doc->ExportCaption($this->Saldo);
				$Doc->ExportCaption($this->target);
				$Doc->ExportCaption($this->id);
			} else {
				$Doc->ExportCaption($this->kodePokok);
				$Doc->ExportCaption($this->nama_pokok);
				$Doc->ExportCaption($this->kodeSubSatu);
				$Doc->ExportCaption($this->nama_sub_satu);
				$Doc->ExportCaption($this->kodeSubDua);
				$Doc->ExportCaption($this->nama_sub_dua);
				$Doc->ExportCaption($this->kodeSubTiga);
				$Doc->ExportCaption($this->nama_sub_tiga);
				$Doc->ExportCaption($this->Norek);
				$Doc->ExportCaption($this->Keterangan);
				$Doc->ExportCaption($this->D2FK);
				$Doc->ExportCaption($this->SaldoAwal);
				$Doc->ExportCaption($this->TanggalSaldo);
				$Doc->ExportCaption($this->Saldo);
				$Doc->ExportCaption($this->target);
				$Doc->ExportCaption($this->id);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->kodePokok);
					$Doc->ExportField($this->nama_pokok);
					$Doc->ExportField($this->kodeSubSatu);
					$Doc->ExportField($this->nama_sub_satu);
					$Doc->ExportField($this->kodeSubDua);
					$Doc->ExportField($this->nama_sub_dua);
					$Doc->ExportField($this->kodeSubTiga);
					$Doc->ExportField($this->nama_sub_tiga);
					$Doc->ExportField($this->Norek);
					$Doc->ExportField($this->Keterangan);
					$Doc->ExportField($this->D2FK);
					$Doc->ExportField($this->SaldoAwal);
					$Doc->ExportField($this->TanggalSaldo);
					$Doc->ExportField($this->Saldo);
					$Doc->ExportField($this->target);
					$Doc->ExportField($this->id);
				} else {
					$Doc->ExportField($this->kodePokok);
					$Doc->ExportField($this->nama_pokok);
					$Doc->ExportField($this->kodeSubSatu);
					$Doc->ExportField($this->nama_sub_satu);
					$Doc->ExportField($this->kodeSubDua);
					$Doc->ExportField($this->nama_sub_dua);
					$Doc->ExportField($this->kodeSubTiga);
					$Doc->ExportField($this->nama_sub_tiga);
					$Doc->ExportField($this->Norek);
					$Doc->ExportField($this->Keterangan);
					$Doc->ExportField($this->D2FK);
					$Doc->ExportField($this->SaldoAwal);
					$Doc->ExportField($this->TanggalSaldo);
					$Doc->ExportField($this->Saldo);
					$Doc->ExportField($this->target);
					$Doc->ExportField($this->id);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
