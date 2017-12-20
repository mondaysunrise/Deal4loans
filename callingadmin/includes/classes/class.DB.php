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
			$this->dbDatabase = "deal4loans_primary";
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
			$this->dbLink = mysqli_pconnect($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbDatabase) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to database server!</font> ". mysqli_error());
		}else{
			$this->dbLink = mysqli_connect($this->dbHost, $this->dbUsername,  $this->dbPassword, $this->dbDatabase) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to database server!</font> " . mysqli_error());
		}
		//mysqli_select_db($this->dbDatabase, $this->dbLink) or die("<font color='#ff0000' face='verdana' face='2'>Error: Unable to select database!</font>");
	//	mysqli_select_db($this->dbDatabase, $this->dbLink) or die(mysqli_error());
	}
	
	function fun_db_query($sql){
		return @mysqli_query($this->dbLink, $sql);
	}
	
	function fun_db_get_num_rows($result){
		return @mysqli_num_rows($result);
	}
	
	function fun_db_get_affected_rows(){
		return @mysqli_affected_rows($this->dbLink);
	}
	
	function fun_db_last_inserted_id(){
		return @mysqli_insert_id($this->dbLink);
	}
	
	function fun_db_fetch_rs_array($result){
		return @mysqli_fetch_array($result);
	}
	
	function fun_db_fetch_rs_assoc($result){
		return @mysqli_fetch_assoc($result);
	}
	
	function fun_db_fetch_rs_object($result){
		return @mysqli_fetch_object($result);
	}
	
	function fun_get_mysql_result($result, $rows, $field)
		{
			return mysqli_result($result,$rows,$field);	
		}
	
	function fun_db_fetch_rs_row($result){
		return @mysqli_fetch_row($result);
	}
	
	function fun_db_free_resultset($result){
		@mysqli_free_result($result);
	}
	
	function fun_db_close_connection(){
		@mysqli_close($this->dbLink);
	}
	/* gallery */
	function createRecordset($sql) {
		$rs = $this->mysqliSafeQuery($sql);
		return($rs);
	}
	
	function mysqlSafeQuery($query) {
		$this->lastSql = $query;
		$result = FALSE;
        if ($this->dumpSql === TRUE) {
            echo "$query<br>";
        }
		$rs = @mysqli_query($this->dbLink, $query);
		$errno = mysqli_errno($this->dbLink);
		if ($errno > 0) {
			$error_text = mysqli_error($this->dbLink);
			@mysqli_query("unlock tables");  # Clear any locked tables

			trigger_error($error_text . ": " . $query, E_USER_ERROR);
		} else {
			$result = $rs;
		}
		return $result;
	}
	
	function getRecordCount($rs) {
		return mysqli_num_rows($rs);
	}
	
	function &fetchAssoc($rs) {
		$records = array();

		while ($row = mysqli_fetch_assoc($rs)) {
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



	function mysqli_result($res,$row=0,$col=0){ 
	    $numrows = mysqli_num_rows($res); 
	    if ($numrows && $row <= ($numrows-1) && $row >=0){
	        mysqli_data_seek($res,$row);
	        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
	        if (isset($resrow[$col])){
	            return $resrow[$col];
	        }
	    }
	    return false;
	}
}
?>
