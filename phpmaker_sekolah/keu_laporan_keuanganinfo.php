<?php

// Global variable for table object
$keu_laporan_keuangan = NULL;

//
// Table class for keu_laporan_keuangan
//
class ckeu_laporan_keuangan {
	var $TableVar = 'keu_laporan_keuangan';
	var $TableName = 'keu_laporan_keuangan';
	var $TableType = 'VIEW';
	var $kode_otomatis;
	var $identitas;
	var $A_nama_lengkap;
	var $nama_biaya;
	var $nilai_tanggungan_bruto;
	var $tanggal_rencana_bayar;
	var $diskon_sosial;
	var $diskon_waktu;
	var $diskon_prestasi;
	var $diskon_internal;
	var $diskon_lain_lain;
	var $nilai_tanggungan_netto;
	var $jum_cicilan;
	var $kekurangan_pembayaran;
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
	function ckeu_laporan_keuangan() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// kode_otomatis
		$this->kode_otomatis = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_kode_otomatis', 'kode_otomatis', '`kode_otomatis`', 200, -1, FALSE, '`kode_otomatis`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis'] =& $this->kode_otomatis;

		// identitas
		$this->identitas = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_identitas', 'identitas', '`identitas`', 200, -1, FALSE, '`identitas`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['identitas'] =& $this->identitas;

		// A_nama_lengkap
		$this->A_nama_lengkap = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_A_nama_lengkap', 'A_nama_lengkap', '`A_nama_lengkap`', 200, -1, FALSE, '`A_nama_lengkap`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['A_nama_lengkap'] =& $this->A_nama_lengkap;

		// nama_biaya
		$this->nama_biaya = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_nama_biaya', 'nama_biaya', '`nama_biaya`', 200, -1, FALSE, '`nama_biaya`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nama_biaya'] =& $this->nama_biaya;

		// nilai_tanggungan_bruto
		$this->nilai_tanggungan_bruto = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_nilai_tanggungan_bruto', 'nilai_tanggungan_bruto', '`nilai_tanggungan_bruto`', 5, -1, FALSE, '`nilai_tanggungan_bruto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->nilai_tanggungan_bruto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['nilai_tanggungan_bruto'] =& $this->nilai_tanggungan_bruto;

		// tanggal_rencana_bayar
		$this->tanggal_rencana_bayar = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_tanggal_rencana_bayar', 'tanggal_rencana_bayar', '`tanggal_rencana_bayar`', 135, 7, FALSE, '`tanggal_rencana_bayar`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->tanggal_rencana_bayar->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['tanggal_rencana_bayar'] =& $this->tanggal_rencana_bayar;

		// diskon_sosial
		$this->diskon_sosial = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_diskon_sosial', 'diskon_sosial', '`diskon_sosial`', 5, -1, FALSE, '`diskon_sosial`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_sosial->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['diskon_sosial'] =& $this->diskon_sosial;

		// diskon_waktu
		$this->diskon_waktu = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_diskon_waktu', 'diskon_waktu', '`diskon_waktu`', 5, -1, FALSE, '`diskon_waktu`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_waktu->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['diskon_waktu'] =& $this->diskon_waktu;

		// diskon_prestasi
		$this->diskon_prestasi = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_diskon_prestasi', 'diskon_prestasi', '`diskon_prestasi`', 5, -1, FALSE, '`diskon_prestasi`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_prestasi->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['diskon_prestasi'] =& $this->diskon_prestasi;

		// diskon_internal
		$this->diskon_internal = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_diskon_internal', 'diskon_internal', '`diskon_internal`', 5, -1, FALSE, '`diskon_internal`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_internal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['diskon_internal'] =& $this->diskon_internal;

		// diskon_lain_lain
		$this->diskon_lain_lain = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_diskon_lain_lain', 'diskon_lain_lain', '`diskon_lain_lain`', 5, -1, FALSE, '`diskon_lain_lain`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->diskon_lain_lain->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['diskon_lain_lain'] =& $this->diskon_lain_lain;

		// nilai_tanggungan_netto
		$this->nilai_tanggungan_netto = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_nilai_tanggungan_netto', 'nilai_tanggungan_netto', '`nilai_tanggungan_netto`', 5, -1, FALSE, '`nilai_tanggungan_netto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->nilai_tanggungan_netto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['nilai_tanggungan_netto'] =& $this->nilai_tanggungan_netto;

		// jum_cicilan
		$this->jum_cicilan = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_jum_cicilan', 'jum_cicilan', '`jum_cicilan`', 5, -1, FALSE, '`jum_cicilan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->jum_cicilan->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['jum_cicilan'] =& $this->jum_cicilan;

		// kekurangan_pembayaran
		$this->kekurangan_pembayaran = new cField('keu_laporan_keuangan', 'keu_laporan_keuangan', 'x_kekurangan_pembayaran', 'kekurangan_pembayaran', '`kekurangan_pembayaran`', 5, -1, FALSE, '`kekurangan_pembayaran`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->kekurangan_pembayaran->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['kekurangan_pembayaran'] =& $this->kekurangan_pembayaran;
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
		return "keu_laporan_keuangan_Highlight";
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

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
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

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function getDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "keu_cicilan") {
			$sDetailUrl = $GLOBALS["keu_cicilan"]->ListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&kode_otomatis_tanggungan=" . $this->kode_otomatis->CurrentValue;
		}
		return $sDetailUrl;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`keu_laporan_keuangan`";
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
		return "INSERT INTO `keu_laporan_keuangan` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `keu_laporan_keuangan` SET ";
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
		$SQL = "DELETE FROM `keu_laporan_keuangan` WHERE ";
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
			return "keu_laporan_keuanganlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "keu_laporan_keuanganlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("keu_laporan_keuanganview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "keu_laporan_keuanganadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("keu_laporan_keuanganedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("keu_laporan_keuanganedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("keu_laporan_keuanganadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("keu_laporan_keuanganadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("keu_laporan_keuangandelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=keu_laporan_keuangan" : "";
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
		$this->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$this->identitas->setDbValue($rs->fields('identitas'));
		$this->A_nama_lengkap->setDbValue($rs->fields('A_nama_lengkap'));
		$this->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$this->nilai_tanggungan_bruto->setDbValue($rs->fields('nilai_tanggungan_bruto'));
		$this->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
		$this->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$this->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$this->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$this->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$this->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$this->nilai_tanggungan_netto->setDbValue($rs->fields('nilai_tanggungan_netto'));
		$this->jum_cicilan->setDbValue($rs->fields('jum_cicilan'));
		$this->kekurangan_pembayaran->setDbValue($rs->fields('kekurangan_pembayaran'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// kode_otomatis
		// identitas
		// A_nama_lengkap
		// nama_biaya
		// nilai_tanggungan_bruto
		// tanggal_rencana_bayar
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan_netto
		// jum_cicilan
		// kekurangan_pembayaran
		// kode_otomatis

		$this->kode_otomatis->ViewValue = $this->kode_otomatis->CurrentValue;
		$this->kode_otomatis->ViewCustomAttributes = "";

		// identitas
		$this->identitas->ViewValue = $this->identitas->CurrentValue;
		$this->identitas->ViewCustomAttributes = "";

		// A_nama_lengkap
		$this->A_nama_lengkap->ViewValue = $this->A_nama_lengkap->CurrentValue;
		$this->A_nama_lengkap->ViewCustomAttributes = "";

		// nama_biaya
		$this->nama_biaya->ViewValue = $this->nama_biaya->CurrentValue;
		$this->nama_biaya->ViewCustomAttributes = "";

		// nilai_tanggungan_bruto
		$this->nilai_tanggungan_bruto->ViewValue = $this->nilai_tanggungan_bruto->CurrentValue;
		$this->nilai_tanggungan_bruto->ViewCustomAttributes = "";

		// tanggal_rencana_bayar
		$this->tanggal_rencana_bayar->ViewValue = $this->tanggal_rencana_bayar->CurrentValue;
		$this->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($this->tanggal_rencana_bayar->ViewValue, 7);
		$this->tanggal_rencana_bayar->ViewCustomAttributes = "";

		// diskon_sosial
		$this->diskon_sosial->ViewValue = $this->diskon_sosial->CurrentValue;
		$this->diskon_sosial->ViewCustomAttributes = "";

		// diskon_waktu
		$this->diskon_waktu->ViewValue = $this->diskon_waktu->CurrentValue;
		$this->diskon_waktu->ViewCustomAttributes = "";

		// diskon_prestasi
		$this->diskon_prestasi->ViewValue = $this->diskon_prestasi->CurrentValue;
		$this->diskon_prestasi->ViewCustomAttributes = "";

		// diskon_internal
		$this->diskon_internal->ViewValue = $this->diskon_internal->CurrentValue;
		$this->diskon_internal->ViewCustomAttributes = "";

		// diskon_lain_lain
		$this->diskon_lain_lain->ViewValue = $this->diskon_lain_lain->CurrentValue;
		$this->diskon_lain_lain->ViewCustomAttributes = "";

		// nilai_tanggungan_netto
		$this->nilai_tanggungan_netto->ViewValue = $this->nilai_tanggungan_netto->CurrentValue;
		$this->nilai_tanggungan_netto->ViewCustomAttributes = "";

		// jum_cicilan
		$this->jum_cicilan->ViewValue = $this->jum_cicilan->CurrentValue;
		$this->jum_cicilan->ViewCustomAttributes = "";

		// kekurangan_pembayaran
		$this->kekurangan_pembayaran->ViewValue = $this->kekurangan_pembayaran->CurrentValue;
		$this->kekurangan_pembayaran->ViewCustomAttributes = "";

		// kode_otomatis
		$this->kode_otomatis->LinkCustomAttributes = "";
		$this->kode_otomatis->HrefValue = "";
		$this->kode_otomatis->TooltipValue = "";

		// identitas
		$this->identitas->LinkCustomAttributes = "";
		$this->identitas->HrefValue = "";
		$this->identitas->TooltipValue = "";

		// A_nama_lengkap
		$this->A_nama_lengkap->LinkCustomAttributes = "";
		$this->A_nama_lengkap->HrefValue = "";
		$this->A_nama_lengkap->TooltipValue = "";

		// nama_biaya
		$this->nama_biaya->LinkCustomAttributes = "";
		$this->nama_biaya->HrefValue = "";
		$this->nama_biaya->TooltipValue = "";

		// nilai_tanggungan_bruto
		$this->nilai_tanggungan_bruto->LinkCustomAttributes = "";
		$this->nilai_tanggungan_bruto->HrefValue = "";
		$this->nilai_tanggungan_bruto->TooltipValue = "";

		// tanggal_rencana_bayar
		$this->tanggal_rencana_bayar->LinkCustomAttributes = "";
		$this->tanggal_rencana_bayar->HrefValue = "";
		$this->tanggal_rencana_bayar->TooltipValue = "";

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

		// diskon_lain_lain
		$this->diskon_lain_lain->LinkCustomAttributes = "";
		$this->diskon_lain_lain->HrefValue = "";
		$this->diskon_lain_lain->TooltipValue = "";

		// nilai_tanggungan_netto
		$this->nilai_tanggungan_netto->LinkCustomAttributes = "";
		$this->nilai_tanggungan_netto->HrefValue = "";
		$this->nilai_tanggungan_netto->TooltipValue = "";

		// jum_cicilan
		$this->jum_cicilan->LinkCustomAttributes = "";
		$this->jum_cicilan->HrefValue = "";
		$this->jum_cicilan->TooltipValue = "";

		// kekurangan_pembayaran
		$this->kekurangan_pembayaran->LinkCustomAttributes = "";
		$this->kekurangan_pembayaran->HrefValue = "";
		$this->kekurangan_pembayaran->TooltipValue = "";

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
					$XmlDoc->AddField('identitas', $this->identitas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nama_lengkap', $this->A_nama_lengkap->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_biaya', $this->nama_biaya->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nilai_tanggungan_bruto', $this->nilai_tanggungan_bruto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_rencana_bayar', $this->tanggal_rencana_bayar->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_sosial', $this->diskon_sosial->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_waktu', $this->diskon_waktu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_prestasi', $this->diskon_prestasi->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_internal', $this->diskon_internal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_lain_lain', $this->diskon_lain_lain->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nilai_tanggungan_netto', $this->nilai_tanggungan_netto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('jum_cicilan', $this->jum_cicilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kekurangan_pembayaran', $this->kekurangan_pembayaran->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('identitas', $this->identitas->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('A_nama_lengkap', $this->A_nama_lengkap->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nama_biaya', $this->nama_biaya->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nilai_tanggungan_bruto', $this->nilai_tanggungan_bruto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_rencana_bayar', $this->tanggal_rencana_bayar->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_sosial', $this->diskon_sosial->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_waktu', $this->diskon_waktu->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_prestasi', $this->diskon_prestasi->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_internal', $this->diskon_internal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('diskon_lain_lain', $this->diskon_lain_lain->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nilai_tanggungan_netto', $this->nilai_tanggungan_netto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('jum_cicilan', $this->jum_cicilan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kekurangan_pembayaran', $this->kekurangan_pembayaran->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->identitas);
				$Doc->ExportCaption($this->A_nama_lengkap);
				$Doc->ExportCaption($this->nama_biaya);
				$Doc->ExportCaption($this->nilai_tanggungan_bruto);
				$Doc->ExportCaption($this->tanggal_rencana_bayar);
				$Doc->ExportCaption($this->diskon_sosial);
				$Doc->ExportCaption($this->diskon_waktu);
				$Doc->ExportCaption($this->diskon_prestasi);
				$Doc->ExportCaption($this->diskon_internal);
				$Doc->ExportCaption($this->diskon_lain_lain);
				$Doc->ExportCaption($this->nilai_tanggungan_netto);
				$Doc->ExportCaption($this->jum_cicilan);
				$Doc->ExportCaption($this->kekurangan_pembayaran);
			} else {
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->identitas);
				$Doc->ExportCaption($this->A_nama_lengkap);
				$Doc->ExportCaption($this->nama_biaya);
				$Doc->ExportCaption($this->nilai_tanggungan_bruto);
				$Doc->ExportCaption($this->tanggal_rencana_bayar);
				$Doc->ExportCaption($this->diskon_sosial);
				$Doc->ExportCaption($this->diskon_waktu);
				$Doc->ExportCaption($this->diskon_prestasi);
				$Doc->ExportCaption($this->diskon_internal);
				$Doc->ExportCaption($this->diskon_lain_lain);
				$Doc->ExportCaption($this->nilai_tanggungan_netto);
				$Doc->ExportCaption($this->jum_cicilan);
				$Doc->ExportCaption($this->kekurangan_pembayaran);
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
					$Doc->ExportField($this->identitas);
					$Doc->ExportField($this->A_nama_lengkap);
					$Doc->ExportField($this->nama_biaya);
					$Doc->ExportField($this->nilai_tanggungan_bruto);
					$Doc->ExportField($this->tanggal_rencana_bayar);
					$Doc->ExportField($this->diskon_sosial);
					$Doc->ExportField($this->diskon_waktu);
					$Doc->ExportField($this->diskon_prestasi);
					$Doc->ExportField($this->diskon_internal);
					$Doc->ExportField($this->diskon_lain_lain);
					$Doc->ExportField($this->nilai_tanggungan_netto);
					$Doc->ExportField($this->jum_cicilan);
					$Doc->ExportField($this->kekurangan_pembayaran);
				} else {
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->identitas);
					$Doc->ExportField($this->A_nama_lengkap);
					$Doc->ExportField($this->nama_biaya);
					$Doc->ExportField($this->nilai_tanggungan_bruto);
					$Doc->ExportField($this->tanggal_rencana_bayar);
					$Doc->ExportField($this->diskon_sosial);
					$Doc->ExportField($this->diskon_waktu);
					$Doc->ExportField($this->diskon_prestasi);
					$Doc->ExportField($this->diskon_internal);
					$Doc->ExportField($this->diskon_lain_lain);
					$Doc->ExportField($this->nilai_tanggungan_netto);
					$Doc->ExportField($this->jum_cicilan);
					$Doc->ExportField($this->kekurangan_pembayaran);
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
	function Row_Deleting(&$rs) 
	{  

		// Bismillaah
		 // membalik semua transaksi rekeningju yang berkaitan       

		 global $pemakai,$sandi;     
		$connection = mysqli_connect('localhost', $pemakai, $sandi, $teratur)
		  or die ("ERROR:11 Cannot connect  ");

		// turn off transaction auto-commit          
		mysqli_autocommit($connection, FALSE);   

		// looping         0000000000000000000000000000000 
		$sql="SELECT kode_otomatis_master FROM keu_cicilan WHERE " .
			" kode_otomatis_tanggungan='" . $rs["kode_otomatis"] . "' ";     
		if ($cicilan=mysqli_query($connection, $sql)) 
		{             
		}  
		else
		{
				mysqli_rollback($connection); 
				mysqli_close($connection);  
				die("Terjadi Kesalahan Tabel looping Cicilan ");// . "----" . mysqli_error($connection));
		}
		 if (mysqli_num_rows($cicilan) > 0)
		{           
			while($row_cicilan = mysqli_fetch_row($cicilan))
			{ 
				   $sql = "SELECT kode_otomatis,kode_otomatis_master,kode_otomatis_tingkat," . 
					" NoRek,keterangan,debet,kredit,tanggal FROM rekeningJU WHERE " . 
					" kode_otomatis_master='" . $row_cicilan[0] . "' AND apakah_original='y'  "   ;
				if ($result=mysqli_query($connection, $sql)) 
				{             
				}  
				else
				{
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
						unik() . "','" . $row_cicilan[0] . "','" . 
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
			}
			 $sql="DELETE FROM keu_cicilan WHERE  " . 
				" kode_otomatis_master='" .   $row_cicilan[0] . "' "   ;
			if (mysqli_query($connection, $sql) !== TRUE) 
			{             
				echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
				mysqli_rollback($connection); 
				mysqli_close($connection);  
				die("Terjadi Kesalahan Tabel Cicilan Hapus");
			}     
		}  // dari if (mysqli_num_rows($cicilan) > 0)

		// sekarang menghapus     tabel keu_tanggungan
		$sql="DELETE FROM keu_tanggungan WHERE  " . 
				" kode_otomatis='" .   $rs["kode_otomatis"] . "' "   ;
			if (mysqli_query($connection, $sql) !== TRUE) 
			{             
				echo "ERROR: " . mysqli_error($connection) ;//. " (query was $sql)";
				mysqli_rollback($connection); 
				mysqli_close($connection);  
				die("Terjadi Kesalahan Tabel tanggungan");
			}         
		mysqli_commit($connection);
		mysqli_close($connection); 
		$this->CancelMessage="Data Berhasil Dihapus !";                   
		header("Location: keu_laporan_keuanganlist.php"); 
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
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
