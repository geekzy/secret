<?php

// Global variable for table object
$pemilihan_jenis_biaya = NULL;

//
// Table class for pemilihan_jenis_biaya
//
class cpemilihan_jenis_biaya {
	var $TableVar = 'pemilihan_jenis_biaya';
	var $TableName = 'pemilihan_jenis_biaya';
	var $TableType = 'CUSTOMVIEW';
	var $apakah_disembunyikan;
	var $kode_biaya;
	var $nama_kelas_kelompok;
	var $kode_kelompok;
	var $tanggal_bayar1;
	var $diskon_sosial;
	var $diskon_waktu;
	var $diskon_prestasi;
	var $diskon_internal;
	var $diskon_lain;
	var $langkah;
	var $jumlah;
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
	function cpemilihan_jenis_biaya() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// apakah_disembunyikan
		$this->apakah_disembunyikan = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_apakah_disembunyikan', 'apakah_disembunyikan', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['apakah_disembunyikan'] =& $this->apakah_disembunyikan;

		// kode_biaya
		$this->kode_biaya = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_kode_biaya', 'kode_biaya', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_biaya'] =& $this->kode_biaya;

		// nama_kelas_kelompok
		$this->nama_kelas_kelompok = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_nama_kelas_kelompok', 'nama_kelas_kelompok', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nama_kelas_kelompok'] =& $this->nama_kelas_kelompok;

		// kode_kelompok
		$this->kode_kelompok = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_kode_kelompok', 'kode_kelompok', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_kelompok'] =& $this->kode_kelompok;

		// tanggal_bayar1
		$this->tanggal_bayar1 = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_tanggal_bayar1', 'tanggal_bayar1', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->tanggal_bayar1->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['tanggal_bayar1'] =& $this->tanggal_bayar1;

		// diskon_sosial
		$this->diskon_sosial = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_diskon_sosial', 'diskon_sosial', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_sosial->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['diskon_sosial'] =& $this->diskon_sosial;

		// diskon_waktu
		$this->diskon_waktu = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_diskon_waktu', 'diskon_waktu', 'keu_master_tanggungan.apakah_disembunyikan', 200, 7, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_waktu->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['diskon_waktu'] =& $this->diskon_waktu;

		// diskon_prestasi
		$this->diskon_prestasi = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_diskon_prestasi', 'diskon_prestasi', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_prestasi->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['diskon_prestasi'] =& $this->diskon_prestasi;

		// diskon_internal
		$this->diskon_internal = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_diskon_internal', 'diskon_internal', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_internal->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['diskon_internal'] =& $this->diskon_internal;

		// diskon_lain
		$this->diskon_lain = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_diskon_lain', 'diskon_lain', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_lain->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['diskon_lain'] =& $this->diskon_lain;

		// langkah
		$this->langkah = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_langkah', 'langkah', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->langkah->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['langkah'] =& $this->langkah;

		// jumlah
		$this->jumlah = new cField('pemilihan_jenis_biaya', 'pemilihan_jenis_biaya', 'x_jumlah', 'jumlah', 'keu_master_tanggungan.apakah_disembunyikan', 200, -1, FALSE, 'keu_master_tanggungan.apakah_disembunyikan', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['jumlah'] =& $this->jumlah;
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
		return "pemilihan_jenis_biaya_Highlight";
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

	// Table level SQL
	function SqlFrom() { // From
		return "keu_master_tanggungan";
	}

	function SqlSelect() { // Select
		return "SELECT keu_master_tanggungan.apakah_disembunyikan, keu_master_tanggungan.apakah_disembunyikan AS kode_biaya, keu_master_tanggungan.apakah_disembunyikan AS nama_kelas_kelompok, keu_master_tanggungan.apakah_disembunyikan AS kode_kelompok, keu_master_tanggungan.apakah_disembunyikan AS tanggal_bayar1, keu_master_tanggungan.apakah_disembunyikan AS diskon_sosial, keu_master_tanggungan.apakah_disembunyikan AS diskon_waktu, keu_master_tanggungan.apakah_disembunyikan AS diskon_prestasi, keu_master_tanggungan.apakah_disembunyikan AS diskon_internal, keu_master_tanggungan.apakah_disembunyikan AS diskon_lain, keu_master_tanggungan.apakah_disembunyikan AS langkah, keu_master_tanggungan.apakah_disembunyikan AS jumlah FROM " . $this->SqlFrom();
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
		return "INSERT INTO keu_master_tanggungan ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE keu_master_tanggungan SET ";
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
		$SQL = "DELETE FROM keu_master_tanggungan WHERE ";
		$SQL .= ew_QuotedName('apakah_disembunyikan') . '=' . ew_QuotedValue($rs['apakah_disembunyikan'], $this->apakah_disembunyikan->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "keu_master_tanggungan.apakah_disembunyikan = '@apakah_disembunyikan@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@apakah_disembunyikan@", ew_AdjustSql($this->apakah_disembunyikan->CurrentValue), $sKeyFilter); // Replace key value
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
			return "pemilihan_jenis_biayalist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "pemilihan_jenis_biayalist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("pemilihan_jenis_biayaview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "pemilihan_jenis_biayaadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("pemilihan_jenis_biayaedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("pemilihan_jenis_biayaadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("pemilihan_jenis_biayadelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->apakah_disembunyikan->CurrentValue)) {
			$sUrl .= "apakah_disembunyikan=" . urlencode($this->apakah_disembunyikan->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=pemilihan_jenis_biaya" : "";
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
			$arKeys[] = @$_GET["apakah_disembunyikan"]; // apakah_disembunyikan

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
			$this->apakah_disembunyikan->CurrentValue = $key;
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
		$this->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$this->kode_biaya->setDbValue($rs->fields('kode_biaya'));
		$this->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$this->kode_kelompok->setDbValue($rs->fields('kode_kelompok'));
		$this->tanggal_bayar1->setDbValue($rs->fields('tanggal_bayar1'));
		$this->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$this->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$this->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$this->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$this->diskon_lain->setDbValue($rs->fields('diskon_lain'));
		$this->langkah->setDbValue($rs->fields('langkah'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// apakah_disembunyikan
		// kode_biaya
		// nama_kelas_kelompok
		// kode_kelompok
		// tanggal_bayar1
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain
		// langkah
		// jumlah
		// apakah_disembunyikan

		if (strval($this->apakah_disembunyikan->CurrentValue) <> "") {
			$sFilterWrk = "`nama_biaya` = '" . ew_AdjustSql($this->apakah_disembunyikan->CurrentValue) . "'";
		$sSqlWrk = "SELECT `nama_biaya` FROM `keu_master_tanggungan`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->apakah_disembunyikan->ViewValue = $rswrk->fields('nama_biaya');
				$rswrk->Close();
			} else {
				$this->apakah_disembunyikan->ViewValue = $this->apakah_disembunyikan->CurrentValue;
			}
		} else {
			$this->apakah_disembunyikan->ViewValue = NULL;
		}
		$this->apakah_disembunyikan->ViewCustomAttributes = "";

		// kode_biaya
		if (strval($this->kode_biaya->CurrentValue) <> "") {
			$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($this->kode_biaya->CurrentValue) . "'";
		$sSqlWrk = "SELECT `kode_otomatis` FROM `keu_master_tanggungan`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->kode_biaya->ViewValue = $rswrk->fields('kode_otomatis');
				$rswrk->Close();
			} else {
				$this->kode_biaya->ViewValue = $this->kode_biaya->CurrentValue;
			}
		} else {
			$this->kode_biaya->ViewValue = NULL;
		}
		$this->kode_biaya->ViewCustomAttributes = "";

		// nama_kelas_kelompok
		if (strval($this->nama_kelas_kelompok->CurrentValue) <> "") {
			$sFilterWrk = "`nama_kelas_kelompok` = '" . ew_AdjustSql($this->nama_kelas_kelompok->CurrentValue) . "'";
		$sSqlWrk = "SELECT `nama_kelas_kelompok` FROM `st_master_kelas_kelompok`";
		$sWhereWrk = "";
		$lookuptblfilter = " kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND apakah_valid='y' ";
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
				$this->nama_kelas_kelompok->ViewValue = $rswrk->fields('nama_kelas_kelompok');
				$rswrk->Close();
			} else {
				$this->nama_kelas_kelompok->ViewValue = $this->nama_kelas_kelompok->CurrentValue;
			}
		} else {
			$this->nama_kelas_kelompok->ViewValue = NULL;
		}
		$this->nama_kelas_kelompok->ViewCustomAttributes = "";

		// kode_kelompok
		if (strval($this->kode_kelompok->CurrentValue) <> "") {
			$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($this->kode_kelompok->CurrentValue) . "'";
		$sSqlWrk = "SELECT `kode_otomatis` FROM `st_master_kelas_kelompok`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->kode_kelompok->ViewValue = $rswrk->fields('kode_otomatis');
				$rswrk->Close();
			} else {
				$this->kode_kelompok->ViewValue = $this->kode_kelompok->CurrentValue;
			}
		} else {
			$this->kode_kelompok->ViewValue = NULL;
		}
		$this->kode_kelompok->ViewCustomAttributes = "";

		// tanggal_bayar1
		$this->tanggal_bayar1->ViewValue = $this->tanggal_bayar1->CurrentValue;
		$this->tanggal_bayar1->ViewCustomAttributes = "";

		// diskon_sosial
		$this->diskon_sosial->ViewValue = $this->diskon_sosial->CurrentValue;
		$this->diskon_sosial->ViewCustomAttributes = "";

		// diskon_waktu
		$this->diskon_waktu->ViewValue = $this->diskon_waktu->CurrentValue;
		$this->diskon_waktu->ViewValue = ew_FormatDateTime($this->diskon_waktu->ViewValue, 7);
		$this->diskon_waktu->ViewCustomAttributes = "";

		// diskon_prestasi
		$this->diskon_prestasi->ViewValue = $this->diskon_prestasi->CurrentValue;
		$this->diskon_prestasi->ViewCustomAttributes = "";

		// diskon_internal
		$this->diskon_internal->ViewValue = $this->diskon_internal->CurrentValue;
		$this->diskon_internal->ViewCustomAttributes = "";

		// diskon_lain
		$this->diskon_lain->ViewValue = $this->diskon_lain->CurrentValue;
		$this->diskon_lain->ViewCustomAttributes = "";

		// langkah
		$this->langkah->ViewValue = $this->langkah->CurrentValue;
		$this->langkah->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewCustomAttributes = "";

		// apakah_disembunyikan
		$this->apakah_disembunyikan->LinkCustomAttributes = "";
		$this->apakah_disembunyikan->HrefValue = "";
		$this->apakah_disembunyikan->TooltipValue = "";

		// kode_biaya
		$this->kode_biaya->LinkCustomAttributes = "";
		$this->kode_biaya->HrefValue = "";
		$this->kode_biaya->TooltipValue = "";

		// nama_kelas_kelompok
		$this->nama_kelas_kelompok->LinkCustomAttributes = "";
		$this->nama_kelas_kelompok->HrefValue = "";
		$this->nama_kelas_kelompok->TooltipValue = "";

		// kode_kelompok
		$this->kode_kelompok->LinkCustomAttributes = "";
		$this->kode_kelompok->HrefValue = "";
		$this->kode_kelompok->TooltipValue = "";

		// tanggal_bayar1
		$this->tanggal_bayar1->LinkCustomAttributes = "";
		$this->tanggal_bayar1->HrefValue = "";
		$this->tanggal_bayar1->TooltipValue = "";

		// diskon_sosial
		$this->diskon_sosial->LinkCustomAttributes = "";
		$this->diskon_sosial->HrefValue = "";
		$this->diskon_sosial->TooltipValue = "";

		// diskon_waktu
		$this->diskon_waktu->LinkCustomAttributes = "";
		$this->diskon_waktu->HrefValue = "";
		$this->diskon_waktu->TooltipValue = "";

		// diskon_prestasi
		$this->diskon_prestasi->LinkCustomAttributes = "";
		$this->diskon_prestasi->HrefValue = "";
		$this->diskon_prestasi->TooltipValue = "";

		// diskon_internal
		$this->diskon_internal->LinkCustomAttributes = "";
		$this->diskon_internal->HrefValue = "";
		$this->diskon_internal->TooltipValue = "";

		// diskon_lain
		$this->diskon_lain->LinkCustomAttributes = "";
		$this->diskon_lain->HrefValue = "";
		$this->diskon_lain->TooltipValue = "";

		// langkah
		$this->langkah->LinkCustomAttributes = "";
		$this->langkah->HrefValue = "";
		$this->langkah->TooltipValue = "";

		// jumlah
		$this->jumlah->LinkCustomAttributes = "";
		$this->jumlah->HrefValue = "";
		$this->jumlah->TooltipValue = "";

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
					$XmlDoc->AddField('apakah_disembunyikan', $this->apakah_disembunyikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_biaya', $this->kode_biaya->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_kelas_kelompok', $this->nama_kelas_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_kelompok', $this->kode_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_bayar1', $this->tanggal_bayar1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_sosial', $this->diskon_sosial->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_waktu', $this->diskon_waktu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_prestasi', $this->diskon_prestasi->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_internal', $this->diskon_internal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_lain', $this->diskon_lain->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('langkah', $this->langkah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('jumlah', $this->jumlah->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('apakah_disembunyikan', $this->apakah_disembunyikan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_biaya', $this->kode_biaya->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_kelas_kelompok', $this->nama_kelas_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_kelompok', $this->kode_kelompok->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_bayar1', $this->tanggal_bayar1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_sosial', $this->diskon_sosial->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_waktu', $this->diskon_waktu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_prestasi', $this->diskon_prestasi->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_internal', $this->diskon_internal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_lain', $this->diskon_lain->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('langkah', $this->langkah->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('jumlah', $this->jumlah->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->apakah_disembunyikan);
				$Doc->ExportCaption($this->kode_biaya);
				$Doc->ExportCaption($this->nama_kelas_kelompok);
				$Doc->ExportCaption($this->kode_kelompok);
				$Doc->ExportCaption($this->tanggal_bayar1);
				$Doc->ExportCaption($this->diskon_sosial);
				$Doc->ExportCaption($this->diskon_waktu);
				$Doc->ExportCaption($this->diskon_prestasi);
				$Doc->ExportCaption($this->diskon_internal);
				$Doc->ExportCaption($this->diskon_lain);
				$Doc->ExportCaption($this->langkah);
				$Doc->ExportCaption($this->jumlah);
			} else {
				$Doc->ExportCaption($this->apakah_disembunyikan);
				$Doc->ExportCaption($this->kode_biaya);
				$Doc->ExportCaption($this->nama_kelas_kelompok);
				$Doc->ExportCaption($this->kode_kelompok);
				$Doc->ExportCaption($this->tanggal_bayar1);
				$Doc->ExportCaption($this->diskon_sosial);
				$Doc->ExportCaption($this->diskon_waktu);
				$Doc->ExportCaption($this->diskon_prestasi);
				$Doc->ExportCaption($this->diskon_internal);
				$Doc->ExportCaption($this->diskon_lain);
				$Doc->ExportCaption($this->langkah);
				$Doc->ExportCaption($this->jumlah);
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
					$Doc->ExportField($this->apakah_disembunyikan);
					$Doc->ExportField($this->kode_biaya);
					$Doc->ExportField($this->nama_kelas_kelompok);
					$Doc->ExportField($this->kode_kelompok);
					$Doc->ExportField($this->tanggal_bayar1);
					$Doc->ExportField($this->diskon_sosial);
					$Doc->ExportField($this->diskon_waktu);
					$Doc->ExportField($this->diskon_prestasi);
					$Doc->ExportField($this->diskon_internal);
					$Doc->ExportField($this->diskon_lain);
					$Doc->ExportField($this->langkah);
					$Doc->ExportField($this->jumlah);
				} else {
					$Doc->ExportField($this->apakah_disembunyikan);
					$Doc->ExportField($this->kode_biaya);
					$Doc->ExportField($this->nama_kelas_kelompok);
					$Doc->ExportField($this->kode_kelompok);
					$Doc->ExportField($this->tanggal_bayar1);
					$Doc->ExportField($this->diskon_sosial);
					$Doc->ExportField($this->diskon_waktu);
					$Doc->ExportField($this->diskon_prestasi);
					$Doc->ExportField($this->diskon_internal);
					$Doc->ExportField($this->diskon_lain);
					$Doc->ExportField($this->langkah);
					$Doc->ExportField($this->jumlah);
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
function Row_Inserting($rsold, &$rsnew) 
{

		$_SESSION['nama_biaya_tanggungan']=$rsnew['apakah_disembunyikan'];
		$_SESSION['kode_biaya_tanggungan']=$rsnew['kode_biaya'];  
		$_SESSION['nama_kelompok']=$rsnew['nama_kelas_kelompok'];
		$_SESSION['kode_kelompok']=$rsnew['kode_kelompok'];    

		$_SESSION['diskon_sosial']=$rsnew['diskon_sosial']; 
		$_SESSION['diskon_waktu']=$rsnew['diskon_waktu'];
		$_SESSION['diskon_prestasi']=$rsnew['diskon_prestasi'];
		$_SESSION['diskon_internal']=$rsnew['diskon_internal'];
		$_SESSION['diskon_lain']=$rsnew['diskon_lain'];
		$_SESSION['langkah']=$rsnew['langkah'];
		$_SESSION['jumlah']=$rsnew['jumlah'];
		
		$array_tanggal=explode("/",$rsnew['tanggal_bayar1']);
		
				
		$_SESSION["nilai"]=array();
		foreach ($array_tanggal as $i) 
		{
			 $_SESSION["nilai"][]=$i;
		}

		header("Location: view_pesertalist.php");
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
