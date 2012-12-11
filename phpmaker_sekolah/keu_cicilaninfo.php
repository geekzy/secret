<?php

// Global variable for table object
$keu_cicilan = NULL;

//
// Table class for keu_cicilan
//
class ckeu_cicilan {
	var $TableVar = 'keu_cicilan';
	var $TableName = 'keu_cicilan';
	var $TableType = 'TABLE';
	var $cicilan;
	var $tanggal_pembayaran;
	var $rek_kas;
	var $rek_pendapatan;
	var $kode_otomatis;
	var $kode_otomatis_tanggungan;
	var $kode_otomatis_master;
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
	function ckeu_cicilan() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// cicilan
		$this->cicilan = new cField('keu_cicilan', 'keu_cicilan', 'x_cicilan', 'cicilan', '`cicilan`', 5, -1, FALSE, '`cicilan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->cicilan->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cicilan'] =& $this->cicilan;

		// tanggal_pembayaran
		$this->tanggal_pembayaran = new cField('keu_cicilan', 'keu_cicilan', 'x_tanggal_pembayaran', 'tanggal_pembayaran', '`tanggal_pembayaran`', 135, 7, FALSE, '`tanggal_pembayaran`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->tanggal_pembayaran->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['tanggal_pembayaran'] =& $this->tanggal_pembayaran;

		// rek_kas
		$this->rek_kas = new cField('keu_cicilan', 'keu_cicilan', 'x_rek_kas', 'rek_kas', '`rek_kas`', 200, -1, FALSE, '`rek_kas`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['rek_kas'] =& $this->rek_kas;

		// rek_pendapatan
		$this->rek_pendapatan = new cField('keu_cicilan', 'keu_cicilan', 'x_rek_pendapatan', 'rek_pendapatan', '`rek_pendapatan`', 200, -1, FALSE, '`rek_pendapatan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['rek_pendapatan'] =& $this->rek_pendapatan;

		// kode_otomatis
		$this->kode_otomatis = new cField('keu_cicilan', 'keu_cicilan', 'x_kode_otomatis', 'kode_otomatis', '`kode_otomatis`', 200, -1, FALSE, '`kode_otomatis`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis'] =& $this->kode_otomatis;

		// kode_otomatis_tanggungan
		$this->kode_otomatis_tanggungan = new cField('keu_cicilan', 'keu_cicilan', 'x_kode_otomatis_tanggungan', 'kode_otomatis_tanggungan', '`kode_otomatis_tanggungan`', 200, -1, FALSE, '`kode_otomatis_tanggungan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis_tanggungan'] =& $this->kode_otomatis_tanggungan;

		// kode_otomatis_master
		$this->kode_otomatis_master = new cField('keu_cicilan', 'keu_cicilan', 'x_kode_otomatis_master', 'kode_otomatis_master', '`kode_otomatis_master`', 200, -1, FALSE, '`kode_otomatis_master`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis_master'] =& $this->kode_otomatis_master;
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
		return "keu_cicilan_Highlight";
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

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "keu_laporan_keuangan") {
			if ($this->kode_otomatis_tanggungan->getSessionValue() <> "")
				$sMasterFilter .= "`kode_otomatis`=" . ew_QuotedValue($this->kode_otomatis_tanggungan->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function getDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "keu_laporan_keuangan") {
			if ($this->kode_otomatis_tanggungan->getSessionValue() <> "")
				$sDetailFilter .= "`kode_otomatis_tanggungan`=" . ew_QuotedValue($this->kode_otomatis_tanggungan->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_keu_laporan_keuangan() {
		return "`kode_otomatis`='@kode_otomatis@'";
	}

	// Detail filter
	function SqlDetailFilter_keu_laporan_keuangan() {
		return "`kode_otomatis_tanggungan`='@kode_otomatis_tanggungan@'";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`keu_cicilan`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
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
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
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
		return "INSERT INTO `keu_cicilan` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `keu_cicilan` SET ";
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
		$SQL = "DELETE FROM `keu_cicilan` WHERE ";
		$SQL .= ew_QuotedName('kode_otomatis') . '=' . ew_QuotedValue($rs['kode_otomatis'], $this->kode_otomatis->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`kode_otomatis` = '@kode_otomatis@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@kode_otomatis@", ew_AdjustSql($this->kode_otomatis->CurrentValue), $sKeyFilter); // Replace key value
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
			return "keu_cicilanlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "keu_cicilanlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("keu_cicilanview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "keu_cicilanadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("keu_cicilanedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("keu_cicilanadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("keu_cicilandelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->kode_otomatis->CurrentValue)) {
			$sUrl .= "kode_otomatis=" . urlencode($this->kode_otomatis->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=keu_cicilan" : "";
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
			$arKeys[] = @$_GET["kode_otomatis"]; // kode_otomatis

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
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
			$this->kode_otomatis->CurrentValue = $key;
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
		$this->cicilan->setDbValue($rs->fields('cicilan'));
		$this->tanggal_pembayaran->setDbValue($rs->fields('tanggal_pembayaran'));
		$this->rek_kas->setDbValue($rs->fields('rek_kas'));
		$this->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$this->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$this->kode_otomatis_tanggungan->setDbValue($rs->fields('kode_otomatis_tanggungan'));
		$this->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// cicilan
		// tanggal_pembayaran
		// rek_kas
		// rek_pendapatan
		// kode_otomatis
		// kode_otomatis_tanggungan
		// kode_otomatis_master
		// cicilan

		$this->cicilan->ViewValue = $this->cicilan->CurrentValue;
		$this->cicilan->ViewCustomAttributes = "";

		// tanggal_pembayaran
		$this->tanggal_pembayaran->ViewValue = $this->tanggal_pembayaran->CurrentValue;
		$this->tanggal_pembayaran->ViewValue = ew_FormatDateTime($this->tanggal_pembayaran->ViewValue, 7);
		$this->tanggal_pembayaran->ViewCustomAttributes = "";

		// rek_kas
		if (strval($this->rek_kas->CurrentValue) <> "") {
			$sFilterWrk = "`Norek` = '" . ew_AdjustSql($this->rek_kas->CurrentValue) . "'";
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
				$this->rek_kas->ViewValue = $rswrk->fields('Norek');
				$this->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$this->rek_kas) . $rswrk->fields('Keterangan');
				$rswrk->Close();
			} else {
				$this->rek_kas->ViewValue = $this->rek_kas->CurrentValue;
			}
		} else {
			$this->rek_kas->ViewValue = NULL;
		}
		$this->rek_kas->ViewCustomAttributes = "";

		// rek_pendapatan
		if (strval($this->rek_pendapatan->CurrentValue) <> "") {
			$sFilterWrk = "`Norek` = '" . ew_AdjustSql($this->rek_pendapatan->CurrentValue) . "'";
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
				$this->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
				$this->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$this->rek_pendapatan) . $rswrk->fields('Keterangan');
				$rswrk->Close();
			} else {
				$this->rek_pendapatan->ViewValue = $this->rek_pendapatan->CurrentValue;
			}
		} else {
			$this->rek_pendapatan->ViewValue = NULL;
		}
		$this->rek_pendapatan->ViewCustomAttributes = "";

		// kode_otomatis
		$this->kode_otomatis->ViewValue = $this->kode_otomatis->CurrentValue;
		$this->kode_otomatis->ViewCustomAttributes = "";

		// kode_otomatis_tanggungan
		$this->kode_otomatis_tanggungan->ViewValue = $this->kode_otomatis_tanggungan->CurrentValue;
		$this->kode_otomatis_tanggungan->ViewCustomAttributes = "";

		// kode_otomatis_master
		$this->kode_otomatis_master->ViewValue = $this->kode_otomatis_master->CurrentValue;
		$this->kode_otomatis_master->ViewCustomAttributes = "";

		// cicilan
		$this->cicilan->LinkCustomAttributes = "";
		$this->cicilan->HrefValue = "";
		$this->cicilan->TooltipValue = "";

		// tanggal_pembayaran
		$this->tanggal_pembayaran->LinkCustomAttributes = "";
		$this->tanggal_pembayaran->HrefValue = "";
		$this->tanggal_pembayaran->TooltipValue = "";

		// rek_kas
		$this->rek_kas->LinkCustomAttributes = "";
		$this->rek_kas->HrefValue = "";
		$this->rek_kas->TooltipValue = "";

		// rek_pendapatan
		$this->rek_pendapatan->LinkCustomAttributes = "";
		$this->rek_pendapatan->HrefValue = "";
		$this->rek_pendapatan->TooltipValue = "";

		// kode_otomatis
		$this->kode_otomatis->LinkCustomAttributes = "";
		$this->kode_otomatis->HrefValue = "";
		$this->kode_otomatis->TooltipValue = "";

		// kode_otomatis_tanggungan
		$this->kode_otomatis_tanggungan->LinkCustomAttributes = "";
		$this->kode_otomatis_tanggungan->HrefValue = "";
		$this->kode_otomatis_tanggungan->TooltipValue = "";

		// kode_otomatis_master
		$this->kode_otomatis_master->LinkCustomAttributes = "";
		$this->kode_otomatis_master->HrefValue = "";
		$this->kode_otomatis_master->TooltipValue = "";

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
					$XmlDoc->AddField('cicilan', $this->cicilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_pembayaran', $this->tanggal_pembayaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rek_kas', $this->rek_kas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rek_pendapatan', $this->rek_pendapatan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis_tanggungan', $this->kode_otomatis_tanggungan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis_master', $this->kode_otomatis_master->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('cicilan', $this->cicilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_pembayaran', $this->tanggal_pembayaran->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rek_kas', $this->rek_kas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rek_pendapatan', $this->rek_pendapatan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis_tanggungan', $this->kode_otomatis_tanggungan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis_master', $this->kode_otomatis_master->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->cicilan);
				$Doc->ExportCaption($this->tanggal_pembayaran);
				$Doc->ExportCaption($this->rek_kas);
				$Doc->ExportCaption($this->rek_pendapatan);
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->kode_otomatis_tanggungan);
				$Doc->ExportCaption($this->kode_otomatis_master);
			} else {
				$Doc->ExportCaption($this->cicilan);
				$Doc->ExportCaption($this->tanggal_pembayaran);
				$Doc->ExportCaption($this->rek_kas);
				$Doc->ExportCaption($this->rek_pendapatan);
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->kode_otomatis_tanggungan);
				$Doc->ExportCaption($this->kode_otomatis_master);
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
					$Doc->ExportField($this->cicilan);
					$Doc->ExportField($this->tanggal_pembayaran);
					$Doc->ExportField($this->rek_kas);
					$Doc->ExportField($this->rek_pendapatan);
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->kode_otomatis_tanggungan);
					$Doc->ExportField($this->kode_otomatis_master);
				} else {
					$Doc->ExportField($this->cicilan);
					$Doc->ExportField($this->tanggal_pembayaran);
					$Doc->ExportField($this->rek_kas);
					$Doc->ExportField($this->rek_pendapatan);
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->kode_otomatis_tanggungan);
					$Doc->ExportField($this->kode_otomatis_master);
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

		function Row_Inserting($rsold, &$rsnew) 
	{   

		// Bismillaah
		if($rsnew["cicilan"]==0)
		{                          
			 $this->CancelMessage="Nilai Cicilan Tidak Boleh 0 !";   
			 return FALSE;
		}     

		// pengecekan apakah melebihi
		$sql = "SELECT  kekurangan_pembayaran FROM   keu_laporan_keuangan WHERE   
		   kode_otomatis = '" . $rsnew["kode_otomatis_tanggungan"] . "' ";
		$kekurangan =ew_ExecuteScalar($sql);
		if($rsnew["cicilan"]>$kekurangan)
		{                          
			 $this->CancelMessage="Nilai Cicilan Tidak Boleh Melebihi " . 
				 "Nilai Kekurangan Tanggungan...";
			 return FALSE;        
		}   
		global $pemakai,$sandi,$teratur;
		$connection = mysqli_connect('localhost', $pemakai, $sandi, $teratur)
		  or die ("ERROR:11 Cannot connect $pemakai ");

		// turn off transaction auto-commit
		mysqli_autocommit($connection, FALSE);

		// entri ke tabel master_transaksi   
		// cari nama

		$sql="SELECT identitas FROM keu_tanggungan WHERE kode_otomatis='" .
			$rsnew["kode_otomatis_tanggungan"] . "' ";
		$nama=ew_ExecuteScalar($sql);
		$kode_master=unik();
		$sql = "INSERT INTO master_transaksi(kode_otomatis,penjelasan,tipe_transaksi," . 
			 "tanggal,kode_otomatis_tingkat) VALUES('" . $kode_master . "','Entri Cicilan Identitas: $nama"  .
			 " " . "','cicilan','" .      
			 $rsnew["tanggal_pembayaran"] ."','" . $_SESSION["kode_otomatis_tingkat"] . 
			 "')" ;
		if (mysqli_query($connection, $sql) !== TRUE) 
		{             

			//echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
			mysqli_rollback($connection); 
			mysqli_close($connection);  
			die("Terjadi Kesalahan Tabel Master");

			//exit();                
		}  

		/////////////////////////////////   cicilan
		// Entri ke tabel keu_cicilan         

		$sql = "INSERT INTO keu_cicilan (kode_otomatis,kode_otomatis_tanggungan," .
			"cicilan,tanggal_pembayaran,kode_otomatis_master,rek_kas,rek_pendapatan) VALUES ('" . $rsnew["kode_otomatis"] . "','" .
			$rsnew["kode_otomatis_tanggungan"] . "'," . $rsnew["cicilan"] . ",'" .
			$rsnew["tanggal_pembayaran"] . "','" . $kode_master . 
			"','" . $rsnew["rek_kas"] . "','" . $rsnew["rek_pendapatan"] . "' ) ";
		if (mysqli_query($connection, $sql) !== TRUE) 
		{

			//echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
			mysqli_rollback($connection);           
			mysqli_close($connection);     
			die("Terjadi Kesalahan Tabel Cicilan");

			//exit();
		}

		//////bbbbbbbbbbbbbbbbb
		// Entri ke tabel rekeningju  
		// Yang bersaldo normal dulu 

		global $keu_cicilan; 
		$sql="INSERT INTO rekeningJU(kode_otomatis,kode_otomatis_master,NoRek," .
			"keterangan,debet,tanggal,kode_otomatis_tingkat) VALUES('" . unik() . "','" . 
			$kode_master ."','" .  $rsnew["rek_kas"] . 
			"','" . "Cicilan Tanggungan" . "'," . $rsnew["cicilan"] . ",'" .
			ew_CurrentDate() . "','" . $_SESSION["kode_otomatis_tingkat"] . "' ) "  ;
		if (mysqli_query($connection, $sql) !== TRUE) 
		{

			//echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
			mysqli_rollback($connection); 
			mysqli_close($connection);  
			die("Terjadi Kesalahan Tabel debet");

			//exit();                
		}       

		/// kredit
		$sql="INSERT INTO rekeningJU(kode_otomatis,kode_otomatis_master,NoRek," .
			"keterangan,kredit,tanggal,kode_otomatis_tingkat) VALUES('" . unik() . "','" . 
			$kode_master ."','" .  $rsnew["rek_pendapatan"] . 
			"','" . "Cicilan Tanggungan" . "'," . $rsnew["cicilan"] . ",'" .
			ew_CurrentDate() . "','" . $_SESSION["kode_otomatis_tingkat"] . "' ) "  ;
		if (mysqli_query($connection, $sql) !== TRUE) 
		{

			//echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
			mysqli_rollback($connection); 
			mysqli_close($connection);  
			die("Terjadi Kesalahan Tabel kredit");

			//exit();                
		}  

		// menghapus transaksi bila ada yang o       
		$sql="DELETE FROM keu_cicilan WHERE cicilan=0 AND " . 
		  " kode_otomatis_tanggungan='" .   $rsnew["kode_otomatis_tanggungan"] . "' "   ;
		mysqli_query($connection, $sql);    
		mysqli_commit($connection);
		mysqli_close($connection);  
		header("Location: keu_cicilanlist.php?showmaster=keu_laporan_keuangan&kode_otomatis=" .
			$rsnew["kode_otomatis_tanggungan"] );
		return FALSE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

		// Row Updating event
function Row_Updating($rsold, &$rsnew) {
	// Enter your code here
	// To cancel, set return value to FALSE   
	
	if($rsold["cicilan"]==0)
	{
		$this->CancelMessage="Nilai Cicilan 0 Tidak Bisa Diupdate/Diedit";
		return FALSE;
	}        
	
	// pengecekan apakah melebihi
	$sql = "SELECT  kekurangan_pembayaran FROM   keu_laporan_keuangan WHERE   
	   kode_otomatis = '" . $rsnew["kode_otomatis_tanggungan"] . "' ";
	$kekurangan =ew_ExecuteScalar($sql);
	
	   
	if( ($rsnew["cicilan"]-$rsold["cicilan"]) > $kekurangan)
	{                          
		 $this->CancelMessage="Nilai Cicilan Tidak Boleh Melebihi " . 
			 "Nilai Kekurangan Tanggungan...";
		 return FALSE;
	}   
	
	
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
	function Row_Deleting(&$rs) 
	{

		// Bismillaah
		$katasql="SELECT COUNT(kode_otomatis) FROM keu_cicilan WHERE kode_otomatis_tanggungan='" .
		 $rs["kode_otomatis_tanggungan"] . "' "   ;

		 //global $conn;
		 $nilai=ew_ExecuteScalar($katasql);
		 if ($nilai>1)               
		 {

			//return TRUE; 
		 }                   
		 else                                   
		 {                      
			 $this->CancelMessage="Banyaknya Cicilan Hanya Ada 1, Data Tidak Bisa Dihapus !";
			 return FALSE;              
		 }                             

		 // membalik semua transaksi rekeningju yang berkaitan       
		 global $pemakai,$sandi,$teratur;     
		$connection = mysqli_connect('localhost', $pemakai, $sandi, $teratur)
		  or die ("ERROR:11 Cannot connect  ");

		// turn off transaction auto-commit          
		mysqli_autocommit($connection, FALSE);   

		// looping         0000000000000000000000000000000
		$sql = "SELECT kode_otomatis,kode_otomatis_master,kode_otomatis_tingkat," . 
			" NoRek,keterangan,debet,kredit,tanggal FROM rekeningJU WHERE " . 
			" kode_otomatis_master='" . $rs["kode_otomatis_master"] . "' AND apakah_original='y' "   ;
		if ($result=mysqli_query($connection, $sql)) 
		{             
		}  
		else
		{

				//echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
				mysqli_rollback($connection); 
				mysqli_close($connection);  
				die("Terjadi Kesalahan Tabel looping ");// . "----" . mysqli_error($connection));
		}
		if (mysqli_num_rows($result) > 0)
		{           
			while($row = mysqli_fetch_row($result))
			{ 
			   $sql="INSERT INTO rekeningJU(kode_otomatis,kode_otomatis_master,kode_otomatis_tingkat," . 
				" NoRek,keterangan,debet,kredit,tanggal,apakah_original ) VALUES('" . 
				unik() . "','" . $rs["kode_otomatis_master"] . "','" . 
				$_SESSION["kode_otomatis_tingkat"] . "','" .
				$row[3] . "','Hapus Cicilan'," . $row[6] . "," . $row[5] . ",'" . ew_CurrentDate() .
				"','t')"       ;  
				if (mysqli_query($connection, $sql) !== TRUE) 
				{      
					echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
					mysqli_rollback($connection); 
					mysqli_close($connection);  
					die("Terjadi Kesalahan Tabel Insert");    
				}    

				// Update apakah original
				$sql="UPDATE rekeningJU set apakah_original='t' WHERE kode_otomatis='" . 
					$row[0] . "' "   ;  
				if (mysqli_query($connection, $sql) !== TRUE) 
				{      
					mysqli_rollback($connection); 
					mysqli_close($connection);  
					die("Terjadi Kesalahan Tabel Update Ori...");    
				}   
			 }
		}       
		else 
		{          

		  //echo "No records found!";   
		}     

		 // menghapus transaksi
		$sql="DELETE FROM keu_cicilan WHERE  " . 
		  " kode_otomatis='" .   $rs["kode_otomatis"] . "' "   ;
		if (mysqli_query($connection, $sql) !== TRUE) 
		{             
			echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
			mysqli_rollback($connection); 
			mysqli_close($connection);  
			die("Terjadi Kesalahan Tabel Cicilan Hapus");
		}     

		// menghapus master_transaksi

		/*
		$sql="DELETE FROM master_transaksi WHERE  " . 
		  " kode_otomatis='" .   $rs["kode_otomatis_master"] . "' "   ;
		if (mysqli_query($connection, $sql) !== TRUE) 
		{             
			echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
			mysqli_rollback($connection); 
			mysqli_close($connection);  
			die("Terjadi Kesalahan Tabel  Transaksi Hapus");
		} 
		*/
		mysqli_commit($connection);
		mysqli_close($connection); 
		$this->CancelMessage="Data Berhasil Dihapus !";                   
		header("Location: keu_cicilanlist.php?showmaster=keu_laporan_keuangan&kode_otomatis=" .
			$rsnew["kode_otomatis_tanggungan"] ); 
		return FALSE;                     
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
	function Row_Rendered() 
	{
		if(CurrentPageID() == "list" && CurrentTable()->IsEdit()==1) 
			{
				if ($this->cicilan->CurrentValue==0)
				{
					global $pemakai,$sandi,$teratur;       
					global $keu_cicilan; 
					$connection = mysqli_connect('localhost', $pemakai, $sandi, $teratur) 
						or die ("ERROR:11 Cannot connect $pemakai ");
					$sql = "SELECT  kekurangan_pembayaran FROM   keu_laporan_keuangan WHERE   
						kode_otomatis = '" . $keu_cicilan->kode_otomatis_tanggungan->getSessionValue() 
						 . "' ";
					$result =mysqli_query($connection, $sql) or die ("ERROR: " .
					mysqli_error($connection) . " (----)");
					$nilai=0;
					if (mysqli_num_rows($result) > 0)
					{
						$row = mysqli_fetch_row($result);
						$nilai=$row[0];      
					}               
					 else 
					{          

						//echo "No records found!";
					}

					// close connection
					mysqli_close($connection);
					 $this->cicilan->EditValue = $nilai;
				}
			} 

			//////
			if(CurrentPageID() == "list" && CurrentTable()->IsAdd()==1) 
			{       
					global $pemakai,$sandi;
					global $keu_cicilan; 
					$connection = mysqli_connect('localhost', $pemakai, $sandi, $teratur) 
						or die ("ERROR:11 Cannot connect $pemakai ");
					$sql = "SELECT rek_kas,rek_pendapatan,kode_otomatis_master_tanggungan FROM  keu_master_tanggungan,keu_tanggungan " .
							"WHERE  keu_tanggungan.kode_otomatis='" .  $keu_cicilan->kode_otomatis_tanggungan->getSessionValue() 
							 . "' AND keu_master_tanggungan.kode_otomatis=keu_tanggungan.kode_otomatis_master_tanggungan "; 
					$result =mysqli_query($connection, $sql) or die ("ERROR: " .
					 " (----)");
					$nilai="";    
					$nilai1="";  
					$keterangan="";    
					$keterangan1=""; 
					if (mysqli_num_rows($result) > 0)
					{
						$row = mysqli_fetch_row($result);
						$nilai=$row[0];   
						$nilai1=$row[1];
					}
					 else 
					{          

						//echo "No records found!";
					}

					// close connection
					mysqli_close($connection);      
					$keterangan=ew_ExecuteScalar("SELECT keterangan FROM rekening2 WHERE NoRek='" . 
						$nilai . "' ");    
					$keterangan1=ew_ExecuteScalar("SELECT keterangan FROM rekening2 WHERE NoRek='" . 
						$nilai1 . "' ");
					$this->rek_kas->CurrentValue = "$nilai";
					$this->rek_pendapatan->CurrentValue = "$nilai1";                 
			}
	 }
}
?>
