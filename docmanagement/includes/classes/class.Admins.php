<?php
class Admins{
	var $dbObj;
	
	function Admins(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function fun_verify_admins($username, $password){
		$sqlCheck = "SELECT Email, pwd FROM " . TABLE_USER . " WHERE Email='".fun_db_input($username)."' AND pwd='".fun_db_input($password)."'";
		 $result = $this->dbObj->fun_db_query($sqlCheck) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return false; // ADMIN does not exists
		}
		
		$rowsPass = $this->dbObj->fun_db_fetch_rs_object($result);
		$adminPass = fun_db_output($rowsPass->pwd);
		$this->dbObj->fun_db_free_resultset($result);
		if($adminPass == $password){
			return true; // ADMIN exists
		}else{
			return false; // ADMIN does not exists
		}
	}
	
	function fun_getAdminUserInfo($ID=0, $Username='',$Password=''){
		$sql = $sqlCheck = "SELECT * FROM " . TABLE_USER;
		if($Username==""){
			$sql .= " WHERE id='".(int)$ID."'";
		}else{
			$sql .= " WHERE Email='".fun_db_input($Username)."' AND pwd='".$Password."'";
		}
		$sql;
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!</font>");
		$rowsAdmin = $this->dbObj->fun_db_fetch_rs_object($result);
		$adminArray = array(
							"id" => fun_db_output($rowsAdmin->id),
							"username" => fun_db_output($rowsAdmin->username),
							"pwd" => fun_db_output($rowsAdmin->pwd),
							"Name" => fun_db_output($rowsAdmin->Name),
							"Email" => fun_db_output($rowsAdmin->Email),
							"Mobile_Number" => fun_db_output($rowsAdmin->Mobile_Number),
							"City" => fun_db_output($rowsAdmin->City),
							"City_List" => fun_db_output($rowsAdmin->City_List),
							"Dated" => fun_db_output($rowsAdmin->Dated),
							"Reply_Type" => fun_db_output($rowsAdmin->Reply_Type),
							"Status" => fun_db_output($rowsAdmin->Status),
							"UserType" => fun_db_output($rowsAdmin->UserType),
							"GlobalID" => fun_db_output($rowsAdmin->GlobalID),
							"Product_pl" => fun_db_output($rowsAdmin->Product_pl),
							"Product_hl" => fun_db_output($rowsAdmin->Product_hl),
							"Product_cl" => fun_db_output($rowsAdmin->Product_cl),
							"Product_bl" => fun_db_output($rowsAdmin->Product_bl),
							"Product_lap" => fun_db_output($rowsAdmin->Product_lap),
							"Product_cc" => fun_db_output($rowsAdmin->Product_cc),
							"agent_ids" => fun_db_output($rowsAdmin->agent_id),
							"BankID" => fun_db_output($rowsAdmin->bank_id),
						);
		$this->dbObj->fun_db_free_resultset($result);
		return $adminArray;
	}
	
	function processAddUser($testiID=0, $actionMode='ADD'){
		$CityV = $_POST['City'];
		$CityVal = $CityV[0];
		$City_List = implode(",", $CityV);
		$cateArray = array(
						"username" => $_POST['Email'],
						"pwd" => $_POST['pwd'],
						"Name" => $_POST['Name'],
						"Email" => $_POST['Email'],
						"Mobile_Number" => $_POST['Mobile_Number'],
						"City" => $CityVal,
						"City_List" => $City_List,
						"Reply_Type" => $_POST['Reply_Type'],
						"Status" => $_POST['Status'],
						"UserType" => $_POST['UserType'],
						"GlobalID" => '1',
						"Owner" => $_POST['Owner'],
						"Product_pl" => $_POST['Product_pl'],
						"Product_hl" => $_POST['Product_hl'],
						"Product_cl" => $_POST['Product_cl'],
						"Product_lap" => $_POST['Product_lap'],
						"Product_cc" => $_POST['Product_cc'],
						"Product_bl" => $_POST['Product_bl'],
						"vsts_code" => $_POST['vsts_code']
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
			 	$sqlUpdate = "UPDATE " . TABLE_USER . " SET " . $fields . " WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_USER . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$checkInsert = "select id from " . TABLE_USER . " where username='".$_POST['Email']."'";
			$result = $this->dbObj->fun_db_query($checkInsert);
			$rowsCon = $this->dbObj->fun_db_fetch_rs_object($result);
			$NumRows = $this->dbObj->fun_db_get_num_rows($result);
			
			if($NumRows>0)
			{
				return "User Exists";
			}
			else
			{
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_USER . "(id, ".$fields." Dated) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_USER . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
			}
		
		}
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
	
	
	
	
	
	function fun_authenticate_admin(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"index.php?msg=".urlencode($msg)."\";</script>";die;
	}
	
	

function processEditPickup($testiID=0, $actionMode='EDIT'){
		$cateArray = array(
						"Landmark" => $_POST['Landmark'],
						"docpickerid" => $_POST['pickup_person'],
						"assigned_remark" => $_POST['assigned_remark'],
						"updated_date" => date("Y-m-d H:i:s")
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
		echo	 	$sqlUpdate = "UPDATE " . TABLE_APPT_DOCS . " SET " . $fields . " WHERE id='".(int)$testiID."'"; //die();
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_APPT_DOCS . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
}

function processEditDocProcess($testiID=0, $actionMode='EDIT'){
                if($_POST['DocStatus']==7)
                {
                    $disbursedDate = $_POST['disbursalMonth'];
                }
		$cateArray = array(
						"IDProof_Status" => $_POST['IDProof_Status'],
						"AddressProof_Status" => $_POST['AddressProof_Status'],
						"PanCard_Status" => $_POST['PanCard_Status'],
						"SalSlip_Status" => $_POST['SalSlip_Status'],
						"BankStmnt_Status" => $_POST['BankStmnt_Status'],
						"PassSizePhoto_Status" => $_POST['PassSizePhoto_Status'],
						"DocStatus" => $_POST['DocStatus'],
                                                "disbursed_date" => $disbursedDate,
                                                "feedback_date" => date("Y-m-d h:i:s"),
						"doc_pickup_remark" => $_POST['doc_pickup_remark']
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
			 	$sqlUpdate = "UPDATE " . TABLE_APPT_DOCS . " SET " . $fields . " WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_APPT_DOCS . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
}

function processReSchedule($testiID=0, $actionMode='ADD'){
$cateArray = array(
				"caller_id"=>$_POST["caller_id"],
				"RequestID"=>$_POST["RequestID"],
				"Reply_Type"=>$_POST["Reply_Type"],
				"special_remarks" => $_POST['special_remarks'],
				"appt_date" => $_POST['appointment_date'],
				"appt_time" => $_POST['appointment_time'],
				"Address" => $_POST['Address'],
				"IDProof" => $_POST['IDProof'],
				"AddressProof" => $_POST['AddressProof'],
				"PanCard" => $_POST['PanCard'],
				"SalSlip" => implode(',',$_REQUEST["SalSlip"]),
				"BankStmnt" => implode(',',$_REQUEST["BankStmnt"]),
				"PassSizePhoto" => $_POST['PassSizePhoto'],
				"rescheduled" => $_POST['rescheduled'],
				"special_remarks" => $_POST['special_remarks'],
				"Feedback_ID" => $_POST['Feedback_ID'],
				"BidderID" => $_POST['BidderID'],
				"BankID" => $_POST['BankID'],
				"viewstatus"=> 1,
				"AgentFeedback"=> 1
			);
	if($actionMode=='ADD'){
		
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
		$updateSql = "update zexternal_appointment_docs set viewstatus=0 where RequestID='".$_POST["RequestID"]."' and Reply_Type='".$_POST["Reply_Type"]."'";
		$this->dbObj->fun_db_query($updateSql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_APPT_DOCS . " table.</font>");
		
		$sqlInsert = "INSERT INTO " . TABLE_APPT_DOCS . "(id, ".$fields." dated, updated_date  ) " ;
		$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."' )";
		echo $sqlInsert;
		$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_APPT_DOCS . " table.</font>");
		return $this->dbObj->fun_db_last_inserted_id();
	}
	if($actionMode=='EDIT'){
				
	}

}

//Redirect Url
function redirectURL($rurl){
	header("Location: " . $rurl);
	exit;
}



}
?>