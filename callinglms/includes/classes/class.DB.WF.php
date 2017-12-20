<?php
//error_reporting(0);
class DBWF{
	var $dbLink;
	var $dbHost;
	var $dbUsername;
	var $dbPassword;
	var $dbDatabase;
	var $dbConnectPersistant;
	
	function DBWF(){ // class constructor
		// local //
		if($_SERVER['SERVER_ADDR'] =='127.0.0.1'){
			$this->dbHost = "localhost";
			$this->dbUsername = "root";
			$this->dbPassword = "";
			$this->dbDatabase = "deal4loans";
		}else{			
			//$this->dbHost = "localhost";
			//	$dbuser	= "d4lwishfinprod"; 
			//	$dbserver= "172.16.245.49";
			//	$dbpass	= "VQZ6JhRZnSvA1f4K";
			//	$dbname	= "wishfinprod"; 

			$this->dbHost = "172.16.245.49";
			$this->dbUsername = "d4lwishfinprod";
			$this->dbPassword = "VQZ6JhRZnSvA1f4K";
			$this->dbDatabase = "wishfinprod";
			
			}
		$this->dbConnectPersistant = false; 
		$this->fun_db_connect();
	} 
	
	function fun_db_connect(){
		if($this->dbConnectPersistant){
			$this->dbLink = mysqli_pconnect($this->dbHost, $this->dbUsername,  $this->dbPassword, $this->dbDatabase) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to WF database server!</font> ". mysqli_error());
		}else{
			$this->dbLink = mysqli_connect($this->dbHost, $this->dbUsername,  $this->dbPassword, $this->dbDatabase) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to WF database server!</font> " . mysqli_error());
		}
		//mysqli_select_db($this->dbDatabase, $this->dbLink) or die("<font color='#ff0000' face='verdana' face='2'>Error: Unable to select database!</font>");
		//mysqli_select_db($this->dbDatabase, $this->dbLink) or die(mysqli_error());
	}
	
	function fun_get_num_rows($sql){
		$totalRows = 0;
		$selected = "";
		$sql = trim($sql);
		if($sql==""){
			die("<font color='#ff0000' face='verdana' face='2'>Error: Query is Empty!</font>");
			exit;
		}
		$result = $this->fun_db_query($sql);
		$totalRows = $this->fun_db_get_num_rows($result);
		$this->fun_db_free_resultset($result);
		return $totalRows;
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
	

}


function getWhatsappMessageDetails($Mobile,$process_name)
{
	$objWF = new DBWF();
	$qry= "SELECT message,xkyknzl5dwfyk4hg_wishfin_whatsapp.date_created FROM `xkyknzl5dwfyk4hg_wishfin_whatsapp` LEFT OUTER JOIN xkyknzl5dwfyk4hg_tms_whatsapp on xkyknzl5dwfyk4hg_tms_whatsapp.whatsapp_id=xkyknzl5dwfyk4hg_wishfin_whatsapp.id WHERE `mobile_number` = '".$Mobile."' AND `mobile_number`!='' AND process_name='".$process_name."' ORDER BY `xkyknzl5dwfyk4hg_wishfin_whatsapp`.`date_created` ASC ";
	//echo $qry."<br>";
	$num= $objWF->fun_get_num_rows($qry);
	$result = $objWF->fun_db_query($qry);
	if($num>0)
	{
		$rowDate = $objWF->fun_db_fetch_rs_object($result);
		$initialDate=$rowDate->date_created;
		
		$qry1= "SELECT * FROM `xkyknzl5dwfyk4hg_whatsapp_callback` WHERE `mobile_number`= '91".$Mobile."' AND `mobile_number`!='' AND  (message_status NOT LIKE 'read' AND message_status NOT LIKE 'delivered') AND date_created>'".$initialDate."' ORDER BY date_created DESC";
	//echo $qry1."<br>";
		$num1= $objWF->fun_get_num_rows($qry1);
		$result1 = $objWF->fun_db_query($qry1);

		$message='';
		if($num1>0)
		{
			$rowMessage = $objWF->fun_db_fetch_rs_object($result1);
			$i=0;
			$message[]='yes';
			$message[]=$rowMessage->message_text;
			$message[]=$rowMessage->date_created;
		}
		else
		{
		 	$message[] = 'no';
		}
	}
	else
	{
		 	$message[] = 'no';
	}
	return $message;
}


?>
