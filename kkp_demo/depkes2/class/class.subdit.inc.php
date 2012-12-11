<?php


if (class_exists('subdit')) {
	return 0;
} else if (defined('CLASS_subdit_INC')) {
	return 0;
} else {
	define('CLASS_subdit_INC', TRUE);
}
	

/*
 * Class subdit
 * generate by class_gen.php on Tue Jan 6 8:36:52 WIT 2004
 * created by chimera <rudych@yahoo.com>
 * PT Linuxindo Total Solusi, http://www.linuxindo.com
 * Comment and Suggestion please email rudi@linuxindo.com, cs@linuxindo.com
 * Contributor fadly@linuxindo.com, martin@linuxindo.com, khad@linuxindo.com
 */
 
/* $id_subdit: class.subdit.inc.php,v 1.1 2004/01/06 02:40:40 rudi Exp $*/

if (class_exists('subdit')) {
	return 0;
} else if (defined('CLASS_subdit_INC')) {
	return 0;
} else {
	define('CLASS_subdit_INC', TRUE);
}
	

//include ('class.adodb.inc.php');

class subdit {

	var $id_subdit;
	var $subdit;
	var $keterangan;
	var $insert_by;
	var $date_insert;

	
	// constructor
	function subdit() {
		$this->id_subdit_subdit = '';
		$this->subdit = '';
		$this->keterangan = '';
		$this->insert_by = '';
		$this->date_insert = '';

	}
	
	function insert($record) {
		global $adodb;
		
		$sql = 'SELECT * FROM subdit LIMIT 1';
		$recordSet = $adodb->Execute($sql);
		$insertSQL = $adodb->GetInsertSQL($recordSet, $record);
		$recordSet2 = $adodb->Execute($insertSQL);

		if (! $recordSet2) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function update($record) {
		global $adodb;
	
		$sql = 'SELECT * FROM subdit WHERE '.
			' id_subdit_subdit='.$adodb->qstr(str_pad($record['id_subdit_subdit'], 1, '0')).' AND '.
			' 1=1 '.
			' LIMIT 1 ';
		$recordSet = $adodb->Execute($sql);
		$updateSQL = $adodb->GetUpdateSQL($recordSet, $record, TRUE);
		$recordSet2 = $adodb->Execute($updateSQL);

		if (! $recordSet2) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function select($sql='') {
		global $adodb;

		if (empty($sql)) {
			$sql = 'SELECT * FROM subdit ';
		}
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return $recordSet->GetRows();
		}
	}

	function lock($type='READ') {
		global $adodb;

		if ($type=='READ') {
			$sql = 'LOCK TABLES subdit READ';
		} else if ($type=='WRITE') {
			$sql = 'LOCK TABLES subdit WRITE';
		}
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function unlock() {
		global $adodb;

		$sql = 'UNLOCK TABLES';
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function delete($record) {
		global $adodb;

		$sql = 'DELETE FROM subdit WHERE '.
			' id_subdit_subdit='.$adodb->qstr(str_pad($record['id_subdit_subdit'], 1, '0')).' AND '.
			' 1=1 '.
			'';
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function add($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! subdit::insert($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return subdit::insert($record);
			}
		}
		return FALSE;
	}

	function modify($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! subdit::update($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return subdit::update($record);
			}
		}
		return FALSE;
	}

	function get($record) {
		global $adodb;

		return subdit::select('SELECT * FROM subdit WHERE '.
			' id_subdit_subdit='.$adodb->qstr(str_pad($record['id_subdit_subdit'], 1, '0')).' AND '.
			' 1=1 '.
			'');
	}

	function remove($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! subdit::delete($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return subdit::delete($record);
			}
		}
		return FALSE;
	}

	function get_field_set() {
		global $adodb;

		$recordSet = $adodb->Execute('SELECT * FROM subdit LIMIT 1');
		for ($i=0;$i<$recordSet->FieldCount();$i++) {
			$fld = $recordSet->FetchField($i);
			$field_arr[$i]['name'] = $fld->name;
			$field_arr[$i]['type'] = $recordSet->MetaType($fld->type);
			$field_arr[$i]['max_length'] = $fld->max_length;
		}
		return $field_arr;
	}
}
?>

//include ('class.adodb.inc.php');

class subdit {

	var $id_subdit_subdit;
	var $subdit;
	var $insert_by;
	var $date_insert;

	
	// constructor
	function subdit() {
		$this->id_subdit_subdit = '';
		$this->subdit = '';
		$this->insert_by = '';
		$this->date_insert = '';

	}
	
	function insert($record) {
		global $adodb;
		
		$sql = 'SELECT * FROM subdit LIMIT 1';
		$recordSet = $adodb->Execute($sql);
		$insertSQL = $adodb->GetInsertSQL($recordSet, $record);
		$recordSet2 = $adodb->Execute($insertSQL);

		if (! $recordSet2) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function update($record) {
		global $adodb;
	
		$sql = 'SELECT * FROM subdit WHERE '.
			' id_subdit_subdit='.$adodb->qstr(str_pad($record['id_subdit_subdit'], 1, '0')).' AND '.
			' 1=1 '.
			' LIMIT 1 ';
		$recordSet = $adodb->Execute($sql);
		$updateSQL = $adodb->GetUpdateSQL($recordSet, $record, TRUE);
		$recordSet2 = $adodb->Execute($updateSQL);

		if (! $recordSet2) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function select($sql='') {
		global $adodb;

		if (empty($sql)) {
			$sql = 'SELECT * FROM subdit ';
		}
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return $recordSet->GetRows();
		}
	}

	function lock($type='READ') {
		global $adodb;

		if ($type=='READ') {
			$sql = 'LOCK TABLES subdit READ';
		} else if ($type=='WRITE') {
			$sql = 'LOCK TABLES subdit WRITE';
		}
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function unlock() {
		global $adodb;

		$sql = 'UNLOCK TABLES';
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function delete($record) {
		global $adodb;

		$sql = 'DELETE FROM subdit WHERE '.
			' id_subdit_subdit='.$adodb->qstr(str_pad($record['id_subdit_subdit'], 1, '0')).' AND '.
			' 1=1 '.
			'';
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function add($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! subdit::insert($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return subdit::insert($record);
			}
		}
		return FALSE;
	}

	function modify($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! subdit::update($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return subdit::update($record);
			}
		}
		return FALSE;
	}

	function get($record) {
		global $adodb;

		return subdit::select('SELECT * FROM subdit WHERE '.
			' id_subdit_subdit='.$adodb->qstr(str_pad($record['id_subdit_subdit'], 1, '0')).' AND '.
			' 1=1 '.
			'');
	}

	function remove($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! subdit::delete($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return subdit::delete($record);
			}
		}
		return FALSE;
	}

	function get_field_set() {
		global $adodb;

		$recordSet = $adodb->Execute('SELECT * FROM subdit LIMIT 1');
		for ($i=0;$i<$recordSet->FieldCount();$i++) {
			$fld = $recordSet->FetchField($i);
			$field_arr[$i]['name'] = $fld->name;
			$field_arr[$i]['type'] = $recordSet->MetaType($fld->type);
			$field_arr[$i]['max_length'] = $fld->max_length;
		}
		return $field_arr;
	}
}
?>
