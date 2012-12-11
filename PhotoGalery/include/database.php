<?php
	require_once ("config.php");
	/**
	* 
	*/
	class MySQLDatabase
	{

		private $konek;
		public $lastquery;
		
		function __construct()
		{
			$this->open_connection();
		}

		public function open_connection(){
			$this->konek = mysql_connect(DBSERVER,DBUSER,DBPASS);
			if (!$this->konek) {
			die("Koneksi Menuju Server Gagal". mysql_error());
			}else{
				$db = mysql_select_db(DBNAME, $this->konek);
				if (!$db) {
					die("Database Tidak Berfungsi". mysql_error());
				}

			}

		}

		public function close_connection(){
			if (isset($this->konek)) {
				mysql_close($this->konek);
				unset($this->konek);
			}

		}

		public function query($sql){
			$this->lastquery = $sql;
			$this->confirm_query($hasil);
			return $hasil;
		}


		public function escape_value($value){
			$magic_quotes_active = get_magic_quotes_gpc();
			$new_enough_php = function_exists("mysql_real_escape_string");
			if ($new_enough_php) {
				// undo any magic  quotes effects so mysql real escape string can do the work
				if ($magic_quotes_active) {
					$value = mysql_real_escape_string($value);
				}else{
					// if magic  quotes aren't already on then  addslhases
					if (!$magic_quotes_active) {
						$value = addslashes($value);
					}
				return $value;
				}

			}

		}


		public function mysql_fetch($hasil_set){
			return mysql_fetch_array($hasil_set);
		}

		public function num_rows($hasil_set){
			return mysql_num_rows($hasil_set);
		}

		public function insert_id(){
			return mysql_insert_id($this->konek);
		}

		public function affected_rows(){
			return mysql_affected_rows($this->konek);
		}



		private function confirm_query($hasil){
			if (!$hasil) {
				$output = "Database Query Failed : ".mysql_error(). "<br>";
				$output .= "Last Sql Query : ". $this->lastquery;
				die($output);
			}
		}
	}




	$database = new MySQLDatabase();
	$db =& $database;

?>