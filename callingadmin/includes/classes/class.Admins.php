<?php
class Admins{
	var $dbObj;
	
	function Admins(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	
	function fun_check_page_access($BidderID, $file_name, $leadidentifier=''){ // this function checked specific page can be accessed by the bidder for current session or not
		$unameFound = false;
		$sqlCheck = "SELECT login_url FROM  lms_access_attributes WHERE status=1 AND file_name='".$file_name."' ";
		if($leadidentifier!="" && $BidderID!=""){
			$sqlCheck .= " AND (BidderID='".$BidderID."' OR leadidentifier='".$leadidentifier."')";
		}
		else if($leadidentifier==""){
			$sqlCheck .= " AND BidderID='".$BidderID."'";
		}
		else if($BidderID==""){
			$sqlCheck .= " AND leadidentifier='".$leadidentifier."'";
		}
		//echo $sqlCheck;
		if($this->fun_get_num_rows($sqlCheck) > 0) {
			$unameFound = true;
		}
		return $unameFound;
	}

	
	function processAddBankName($testiID=0, $actionMode='ADD')
	{
		$cateArray = array(
						"bank_name" => $_POST['bankName']
					);
					
		if($actionMode=='EDIT'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
			 	$sqlUpdate = "UPDATE " . TABLE_BANK . " SET " . $fields . ", flag='".$_REQUEST['flag']."'  WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BANK . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_BANK . "(id, ".$fields." flag) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".$_REQUEST['flag']."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BANK . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
		}
		
	}

function GetStateName($conName)
		{
		
			$selected = "";
			$sql = trim($sql);
			$sql .= "SELECT * FROM ".TABLE_STATE_LOC." WHERE sub_id=0 and flag=1";
			
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->id==$conName && $conName!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->id)."\" ".$selected.">";
					echo fun_db_output($rowsCon->name);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}
	
	
	function processAddCity($testiID=0, $actionMode='ADD'){
		$cateArray = array(
						"name" => $_POST['CityName']
					);
					
		if($actionMode=='EDIT'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
			 	$sqlUpdate = "UPDATE " . TABLE_STATE_LOC . " SET " . $fields . ", sub_id='".$_REQUEST['stateName']."'  WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_STATE_LOC . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_STATE_LOC . "(id, ".$fields." sub_id) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".$_REQUEST['stateName']."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_STATE_LOC . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
		}
	}
	
function GetStateInfo($id)
{
	$sql = "SELECT * FROM ".TABLE_STATE_LOC. " WHERE  id='".(int)$id."'";
			$result = $this->dbObj->fun_db_query($sql);
			$rowsCon = $this->dbObj->fun_db_fetch_rs_object($result);
			$Array = array(
					"id"=>fun_db_output($rowsCon->id),
					"name"=>fun_db_output($rowsCon->name),
					"sub_id"=>fun_db_output($rowsCon->sub_id)
				);
			return $Array;	
}

function GetBankInfo($id)
{
	$sql = "SELECT * FROM ".TABLE_BANK. " WHERE  id='".(int)$id."'";
			$result = $this->dbObj->fun_db_query($sql);
			$rowsCon = $this->dbObj->fun_db_fetch_rs_object($result);
			$Array = array(
					"id"=>fun_db_output($rowsCon->id),
					"bank_name"=>fun_db_output($rowsCon->bank_name),
					"flag"=>fun_db_output($rowsCon->flag)
				);
			return $Array;	
}

function GetBankName($conName)
		{
		
			$selected = "";
			$sql = trim($sql);
			$sql .= "SELECT * FROM ".TABLE_BANK;
			
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->id==$conName && $conName!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->id)."\" ".$selected.">";
					echo fun_db_output($rowsCon->bank_name);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}

	function GetCityName($conName)
		{
		
			$selected = "";
			$sql = trim($sql);
			$sql .= "SELECT * FROM ".TABLE_STATE_LOC." WHERE sub_id!=0";
			
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->id==$conName && $conName!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->id)."\" ".$selected.">";
					echo fun_db_output($rowsCon->name);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}
	
	
	function processAddLocation($testiID=0, $actionMode='ADD'){
		$cateArray = array(
						"bank_id" => $_POST['BankName'],
						"state_id" => $_POST['CityName'],
						"address" => $_POST['Address'],
						"ifsc" => $_POST['IfscCode'],
						"swift_bic_code" => $_POST['SwiftBicCode'],
						"phone" => $_POST['Phone'],
						"branch_code" => $_POST['BranchCode'],
						"micr_code" => $_POST['MICRCode'],
					);
					
		if($actionMode=='EDIT'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
			 	$sqlUpdate = "UPDATE " . TABLE_BRANCH . " SET " . $fields . ", branch_name='".$_REQUEST['locationName']."'  WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BRANCH . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_BRANCH . "(id, ".$fields." branch_name) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".$_REQUEST['locationName']."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BRANCH . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
		}
	}
	
	
	
	function fun_authenticate_admin(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"index.php?msg=".urlencode($msg)."\";</script>";die;
	}


	function fun_authenticate_adminappt(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"appointmentslogin.php?msg=".urlencode($msg)."\";</script>";die;
	}

	function fun_authenticate_admin_plagent(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"appointmentslogin.php?msg=".urlencode($msg)."\";</script>";die;
	}

	
	function fun_get_num_rows($sql){
		$totalRows = 0;
		$selected = "";
		$sql = trim($sql);
		if($sql==""){
			die("<font color='#ff0000' face='verdana' face='2'>Error: Query is Empty!</font>");
			exit;
		}
		$result = $this->dbObj->fun_db_query($sql);
		$totalRows = $this->dbObj->fun_db_get_num_rows($result);
		$this->dbObj->fun_db_free_resultset($result);
		return $totalRows;
	}
	
	

//Redirect Url
function redirectURL($rurl){
	header("Location: " . $rurl);
	exit;
}

}
?>