<?php
error_reporting(0);
class DB{
	var $dbLink;
	var $dbHost;
	var $dbUsername;
	var $dbPassword;
	var $dbDatabase;
	var $dbConnectPersistant;
	
	function DB(){ // class constructor
		// local //
		if($_SERVER['SERVER_ADDR'] =='::1'){
			$this->dbHost = "localhost";
			$this->dbUsername = "root";
			$this->dbPassword = "";
			$this->dbDatabase = "deal4loans";
		}else{
			//$this->dbHost = "localhost";
			$this->dbHost = "localhost";
			$this->dbUsername = "root";
			$this->dbPassword = "";
			$this->dbDatabase = "deal4loans_primary";
			
			}
		$this->dbConnectPersistant = false; 
		$this->fun_db_connect();
	} 
	
	function fun_db_connect(){
		if($this->dbConnectPersistant){
			$this->dbLink = mysql_pconnect($this->dbHost, $this->dbUsername,  $this->dbPassword) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to database server!</font> ". mysql_error());
		}else{
			$this->dbLink = mysql_connect($this->dbHost, $this->dbUsername,  $this->dbPassword) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to database server!</font> " . mysql_error());
		}
		//mysql_select_db($this->dbDatabase, $this->dbLink) or die("<font color='#ff0000' face='verdana' face='2'>Error: Unable to select database!</font>");
		mysql_select_db($this->dbDatabase, $this->dbLink) or die(mysql_error());
	}
	
	function fun_db_query($sql){
		return @mysql_query($sql, $this->dbLink);
	}
	
	function fun_db_get_num_rows($result){
		return @mysql_num_rows($result);
	}
	
	function fun_db_get_affected_rows(){
		return @mysql_affected_rows($this->dbLink);
	}
	
	function fun_db_last_inserted_id(){
		return @mysql_insert_id($this->dbLink);
	}
	
	function fun_db_fetch_rs_array($result){
		return @mysql_fetch_array($result);
	}
	
	function fun_db_fetch_rs_object($result){
		return @mysql_fetch_object($result);
	}
	
	function fun_get_mysql_result($result, $rows, $field)
		{
			return mysql_result($result,$rows,$field);	
		}
	
	function fun_db_fetch_rs_row($result){
		return @mysql_fetch_row($result);
	}
	
	function fun_db_free_resultset($result){
		@mysql_free_result($result);
	}
	
	function fun_db_close_connection(){
		@mysql_close($this->dbLink);
	}
	/* gallery */
	function createRecordset($sql) {
		$rs = $this->mySqlSafeQuery($sql);
		return($rs);
	}
	
	function mySqlSafeQuery($query) {
		$this->lastSql = $query;
		$result = FALSE;
        if ($this->dumpSql === TRUE) {
            echo "$query<br>";
        }
		$rs = @mysql_query($query, $this->dbLink);
		$errno = mysql_errno($this->dbLink);
		if ($errno > 0) {
			$error_text = mysql_error($this->dbLink);
			@mysql_query("unlock tables");  # Clear any locked tables

			trigger_error($error_text . ": " . $query, E_USER_ERROR);
		} else {
			$result = $rs;
		}
		return $result;
	}
	
	function getRecordCount($rs) {
		return mysql_num_rows($rs);
	}
	
	function &fetchAssoc($rs) {
		$records = array();

		while ($row = mysql_fetch_assoc($rs)) {
			array_push($records, $row);
		}
		return $records;
	}
	
function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;

}

}
?>