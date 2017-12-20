<?php
@set_time_limit(2000);
require 'scripts/db_init.php';
require 'sendcreditcardmail.php';

$custid = $_REQUEST["custid"];

$getInitialDetailsSql = "select * from Req_Credit_Card_Sms where RequestID = '".$custid."'";
$getInitialDetailsQuery = ExecQuery($getInitialDetailsSql);


$UserID = mysql_result($getInitialDetailsQuery,0,'UserID');
$Name = mysql_result($getInitialDetailsQuery,0,'Name');
$Mobile_Number = mysql_result($getInitialDetailsQuery,0,'Mobile_Number');
$City = mysql_result($getInitialDetailsQuery,0,'City');
$Net_Salary = mysql_result($getInitialDetailsQuery,0,'Net_Salary');
$source = mysql_result($getInitialDetailsQuery,0,'source');
$Employment_Status = mysql_result($getInitialDetailsQuery,0,'Employment_Status');
$Dated = mysql_result($getInitialDetailsQuery,0,'Dated');
$Updated_Date = mysql_result($getInitialDetailsQuery,0,'Updated_Date');
$DOB = mysql_result($getInitialDetailsQuery,0,'DOB');
$Company_Name = mysql_result($getInitialDetailsQuery,0,'Company_Name');
$Std_Code = mysql_result($getInitialDetailsQuery,0,'Std_Code');
$Landline = mysql_result($getInitialDetailsQuery,0,'Landline');
$Email = mysql_result($getInitialDetailsQuery,0,'Email');
$Gender = mysql_result($getInitialDetailsQuery,0,'Gender');

$Residence_Address = mysql_result($getInitialDetailsQuery,0,'Residence_Address');
$State = mysql_result($getInitialDetailsQuery,0,'State');
$Office_Address = mysql_result($getInitialDetailsQuery,0,'Office_Address');
$Pancard = mysql_result($getInitialDetailsQuery,0,'Pancard');
$Pincode = mysql_result($getInitialDetailsQuery,0,'Pincode');
$Email = mysql_result($getInitialDetailsQuery,0,'Email');
$City_Other = mysql_result($getInitialDetailsQuery,0,'City_Other');
$CC_Holder = mysql_result($getInitialDetailsQuery,0,'CC_Holder');
$IsPublic = mysql_result($getInitialDetailsQuery,0,'IsPublic');
$IP_Address = mysql_result($getInitialDetailsQuery,0,'IP_Address');
$Pancard = mysql_result($getInitialDetailsQuery,0,'Pancard');
$applied_card_name = mysql_result($getInitialDetailsQuery,0,'applied_card_name');
$Pancard = mysql_result($getInitialDetailsQuery,0,'Pancard');
$Privacy = 1;

if($UserID>0)
{
	//Update
	$insertMainTableSql = "update Req_Credit_Card set Name= '".$Name."', Mobile_Number= '".$Mobile_Number."', City= '".$City."', Net_Salary= '".$Net_Salary."', Employment_Status= '".$Employment_Status."', Dated= '".$Dated."', DOB= '".$DOB."', Company_Name= '".$Company_Name."', Std_Code= '".$Std_Code."', Landline= '".$Landline."', Email= '".$Email."', Gender= '".$Gender."', Residence_Address= '".$Residence_Address."', State= '".$State."', Office_Address= '".$Office_Address."', Pancard= '".$Pancard."', Pincode= '".$Pincode."', City_Other= '".$City_Other."', CC_Holder= '".$CC_Holder."', IsPublic= '".$IsPublic."' where RequestID = '".$UserID."'";
	$updateQuery = ExecQuery($insertMainTableSql);	
	$LastID = $UserID;
}
else
{
//Insert
	$insertMainTableSql = "insert into Req_Credit_Card (Name, Mobile_Number, City, Net_Salary, source, Employment_Status, Dated, Updated_Date, DOB, Company_Name, Std_Code, Landline, Email, Gender, Residence_Address, State, Office_Address, Pancard, Pincode, City_Other, CC_Holder, IsPublic, IP_Address, applied_card_name, Privacy) VALUES ('".$Name."' , '".$Mobile_Number."' , '".$City."' , '".$Net_Salary."' , '".$source."' , '".$Employment_Status."' , '".$Dated."' , '".$Updated_Date."' , '".$DOB."' , '".$Company_Name."' , '".$Std_Code."' , '".$Landline."' , '".$Email."' , '".$Gender."' , '".$Residence_Address."' , '".$State."' , '".$Office_Address."' , '".$Pancard."' , '".$Pincode."' , '".$City_Other."' , '".$CC_Holder."' , '".$IsPublic."' , '".$IP_Address."' , '".$applied_card_name."' , '".$Privacy."') ";

	$insertMainTableQuery = ExecQuery($insertMainTableSql);
	$LastID = mysql_insert_id();
	$updateSql = "update Req_Credit_Card_Sms set UserID='".$LastID."' where RequestID = '".$custid."'";
	$updateQuery = ExecQuery($updateSql);
}
//echo $insertMainTableSql;

$getSubTableSql = "select * from sbi_credit_card_5633 where (RequestID = '".$custid."' ) and CardName!='' ORDER BY  sbiccid DESC limit 0,1";
$getSubTableQuery = ExecQuery($getSubTableSql);
$sbiccid = mysql_result($getSubTableQuery,0,'sbiccid');
$Company_Name = mysql_result($getSubTableQuery,0,'CompanyName');
$OfficeAddress1 = mysql_result($getSubTableQuery,0,'OfficeAddress1');
$OfficeAddress2 = mysql_result($getSubTableQuery,0,'OfficeAddress2');
$Office_Addressstr = mysql_result($getSubTableQuery,0,'OfficeAddress3');
$OfficePin = mysql_result($getSubTableQuery,0,'OfficePin');
$OfficeCity = mysql_result($getSubTableQuery,0,'OfficeCity');
$Phone_Number = mysql_result($getSubTableQuery,0,'LandlineNo');
$OfficeState = mysql_result($getSubTableQuery,0,'OfficeState');
$Qualification = mysql_result($getSubTableQuery,0,'Qualification');
$card_name = mysql_result($getSubTableQuery,0,'CardName');
$Designation = mysql_result($getSubTableQuery,0,'Designation');
$Dated = mysql_result($getSubTableQuery,0,'Dated');
$pushflag = 1;

$getCheckTableSql = "select * from sbi_credit_card_5633 where RequestID = '".$LastID."' and CardName!=''  ORDER BY  sbiccid DESC limit 0,1";
//echo "<br>".$getCheckTableSql;
$getCheckTableQuery = ExecQuery($getCheckTableSql);
$CheckRequestID = mysql_result($getCheckTableQuery,0,'RequestID');

if($CheckRequestID>0)
	{
		$sbiccid = mysql_result($getCheckTableQuery,0,'sbiccid');
		$Company_Name = mysql_result($getCheckTableQuery,0,'CompanyName');
		$OfficeAddress1 = mysql_result($getCheckTableQuery,0,'OfficeAddress1');
		$OfficeAddress2 = mysql_result($getCheckTableQuery,0,'OfficeAddress2');
		$Office_Addressstr = mysql_result($getCheckTableQuery,0,'OfficeAddress3');
		$OfficePin = mysql_result($getCheckTableQuery,0,'OfficePin');
		$OfficeCity = mysql_result($getCheckTableQuery,0,'OfficeCity');
		$Phone_Number = mysql_result($getCheckTableQuery,0,'LandlineNo');
		$OfficeState = mysql_result($getCheckTableQuery,0,'OfficeState');
		$Qualification = mysql_result($getCheckTableQuery,0,'Qualification');
		$card_name = mysql_result($getCheckTableQuery,0,'CardName');
		$Designation = mysql_result($getCheckTableQuery,0,'Designation');
		$Dated = mysql_result($getCheckTableQuery,0,'Dated');

		$ccupqry="Update sbi_credit_card_5633 set pushflag='".$pushflag."',RequestID='".$LastID."',CompanyName='".$Company_Name."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$Office_Addressstr."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',Dated='".$Dated."' Where (sbiccid='".$sbiccid."')";
	}
	else
	{
		$ccupqry="INSERT INTO sbi_credit_card_5633 set RequestID='".$LastID."',CompanyName='".$Company_Name."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$Office_Addressstr."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',Dated='".$Dated."', pushflag='".$pushflag."', productflag='44' ";
	}
//echo "<br>".$ccupqry;
$ccupQuery = ExecQuery($ccupqry);



//Put a check for SBI Validation
sebisent($LastID,$custid);

$getCardSql = "select CardName from sbi_credit_card_5633 where RequestID = '".$LastID."' and CardName!='' order by first_dated desc limit 0,1";
$getCardQuery = ExecQuery($getCardSql);
$getCardName = mysql_result($getCardQuery,0,'CardName');

//Send Mail to customer

$detailsArr = array();
$detailsArr['request_id'] = $LastID;
$detailsArr['customer_name'] = $Name;
$detailsArr['customer_email'] = $Email;
$detailsArr['bank_name'] = 'SBI';
$detailsArr['customer_phone'] = $Mobile_Number;
$detailsArr['customer_location'] = $City;
$detailsArr['card_name'] = $getCardName;

/*
$detailsArr = array();
$detailsArr['request_id'] = '945612';
$detailsArr['customer_name'] = 'Test';
$detailsArr['customer_email'] = 'rachit2264@gmail.com';
$detailsArr['bank_name'] = 'SBI';
$detailsArr['customer_phone'] = '8566463214';
$detailsArr['customer_location'] = 'Noida';
$detailsArr['card_name'] = 'Simply Save';
*/
$mailres = SendMailToCustomers($detailsArr);


function GetStatecCode($pKey){
    $titles = array(
	'Andhra Pradesh' => 'APR',
	'Arunachal Pradesh' => 'AR',
	'Assam' => 'AS',
	'Bihar' => 'BIH',
	'Chhattisgarh' => 'CT',
	'Chandigarh' => 'CHD',
	'Delhi' => 'DEL',
	'Goa' => 'GA',
	'Gujarat' => 'GUJ',
	'Haryana' => 'HAR',
	'Himachal Pradesh' => 'HP',
	'Jammu and Kashmir' => 'JK',
	'Jharkhand' => 'JH',
	'Karnataka' => 'KTK',
	'Kerala' => 'KER',
	'Madhya Pradesh' => 'MAD',
	'Maharashtra' => 'MAH',
	'Manipur' => 'MN',
	'Meghalaya' => 'ML',
	'Mizoram' => 'MZ',
	'Nagaland' => 'NL',
	'Odisha' => 'ORI',
	'Punjab' => 'PUN',
	'Rajasthan' => 'RAJ',
	'Sikkim' => 'SK',
	'Tamil Nadu' => 'TMN',
	'Telangana' => 'TG',
	'Tripura' => 'TR',
	'Uttar Pradesh' => 'UP',
	'Uttarakhand' => 'UT',
	'West Bengal' => 'WBG'
	  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function GetSourceCode($pKey){
    $titles = array(
	 'Ahmedabad' => 'AI01',
	'Baroda' => 'AE01',
	'Bhopal' => 'BNMO18',
	'Bhubneshwar' => 'BNMO3',
	'Coimbatore' => 'AQ01',
	'Indore' => 'AU01',
	'Jaipur' => 'AG01',
	'Lucknow' => 'AL01',
	'Nagpur' => 'AS11',
	'Pune' => 'AN21',
	'Surat' => 'AS12',
	'Bangalore' => 'BANEAP',
	'Chennai' => 'CHENEAP',
	'Faridabad' => 'DELHIEAP',
	'Gaziabad' => 'DELHIEAP',
	'Gurgaon' => 'DELHIEAP',
	'Hyderabad' => 'HYDEAP',
	'Kolkata' => 'KOLEAP',
	'Mumbai' => 'MUMTEMP',
	'Delhi' => 'DELHIEAP',
	'Noida' => 'DELHIEAP',
	'Chandigarh' => 'AJ01',
	'Ludhiana' => 'AO01',
	'Jalandhar' => 'AM01',
	'Aurangabad' => 'BJ01',
	'Nasik' => 'AB81',
	'Jamnagar' => 'AI12',
	'Rajkot' => 'AI12',
	'Tirupur' => 'AQ01'
	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
  function sebisent($RequestID,$lastid)
  {
	  //echo $RequestID."--".$lastid;
	 // $sbiccdetails="Select * from sbi_credit_card_5633 Where (RequestID='".$lastid."') group by RequestID order by sbiccid DESC LIMIT 0,1"; Commented on 011016 
	   $sbiccdetails="Select * from sbi_credit_card_5633 Where (RequestID='".$RequestID."') group by RequestID order by sbiccid DESC LIMIT 0,1";
	  $sbiccqry=ExecQuery($sbiccdetails);
	  while($ccrow=mysql_fetch_array($sbiccqry))
	  {
	  $sbiccid = $ccrow["sbiccid"];
	  $RequestID = $ccrow["RequestID"];
	  $CompanyName = $ccrow["CompanyName"];
	  $OfficeAddress1 = $ccrow["OfficeAddress1"];
	  $OfficeAddress2 = $ccrow["OfficeAddress2"];
	  $OfficePin = $ccrow["OfficePin"];
	  $OfficeCity = $ccrow["OfficeCity"];
	  $OfficePhone = $ccrow["LandlineNo"];
	  $OfficeState = $ccrow["OfficeState"];
	  $Qualification = $ccrow["Qualification"];
	  $Designation = $ccrow["Designation"];
	  $CardName = trim($ccrow["CardName"]);
	 $LeadRefNumber = $ccrow["LeadRefNumber"];
	  $Dated=ExactServerdate();
	  if($OfficeCity=="Kolkata")
			{
				$offslct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
			}
			else if($OfficeCity=="Gaziabad")
			{
				$offslct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
			}
			else
			{
			$offslct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($OfficeCity)."%') group by city Limit 0,1";
			}
			$offslct=ExecQuery($offslct);
			$crow=mysql_fetch_array($offslct);
			$offstd = "0".$crow["std"];
			$OfficeState = $crow["state"];
	  
	 $slct="select * from Req_Credit_Card Where (RequestID='".$RequestID."')";
		$slctqry=ExecQuery($slct);
		$row=mysql_fetch_array($slctqry);
		$Gender = $row["Gender"];
		$ResiPhone = $row["Landline"];
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		if($City=="Others" && Strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}
		$resistd = "";
		if($resistd=="")
		  {
			if($strcity=="Kolkata")
			{
				$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
			}
			else if($strcity=="Gaziabad")
			{
				$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
			}
			else
			{
			$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($strcity)."%') group by city Limit 0,1";
			}
			$resislct=ExecQuery($resislct);
			$rsrow=mysql_fetch_array($resislct);
			$resistd = "0".$rsrow["std"];
			$residencestate = $rsrow["state"];
			$SourceCode = $rsrow["source_code"];
		  }
		if($Gender=="Male")
		{
			$strgender="M";
		}
		elseif($Gender=="Female")
		{
			$strgender="F";
		}
		else
		{
			$strgender="M";
		}
		$Mobile = $row["Mobile_Number"];
		$Email = $row["Email"];
		
		$ResiState = $residencestate;
	  
		$Pancard = $row["Pancard"];
		$CompanyName = substr(trim($CompanyName),0,30);
		$ResiAddress3 = str_replace("@", "", $Email);
		$Pincode = $row["Pincode"];
		$Employment_Status = $row["Employment_Status"];
		if($Employment_Status==1)
		{
			$OccupationType = "S";
		}
		else
		{
			$OccupationType = "E";
		}
		list($year,$month,$day) = split("[-]",$row["DOB"]);
		list($first_name,$middle_name,$last_name) = split("[ ]",$row["Name"]);
		if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
			{
				$last_name= $middle_name;
				$middle_name="";
			}
			else
			{
				if($last_name=="")
					{ $last_name= "Kumar";	}
			}
			
		if($middle_name=="Middle Name")
			{
				$middle_name="";
			}
		
		$Residence_Address = $row["Residence_Address"];
		$Residence_Address = str_ireplace('|','',$Residence_Address);
		 $strresieadd = round((strlen($Residence_Address)/3));
		$residenceadd = str_split($Residence_Address, $strresieadd);
		$resiaddress1 = $residenceadd[0];
		$resiaddress2 = $residenceadd[1];
		$resiaddress3 = $residenceadd[2];
					
		if($CardName=="SBI SimplySave") { $card_type="SSU2"; $PromoCode="SCEA";} elseif($CardName=="SBI Platinum Card"){ $card_type="VPTL"; $PromoCode="SCEA";} elseif($CardName=="SBI Signature Card"){ $card_type="VISC"; $PromoCode="SCEA";} elseif($CardName=="SimplyCLICK SBI Card"){ $card_type="SCU2"; $PromoCode="SCEA";} elseif($CardName=="Air India SBI Platinum Card"){ $card_type="AIPU"; $PromoCode="SCEA";} elseif($CardName=="Air India SBI Signature Card"){ $card_type="AISU"; $PromoCode="SCEA";} elseif($CardName=="Fbb SBI STYLEUP Card"){ $card_type="SCU2"; $PromoCode="SCEA";}elseif($CardName=="IRCTC SBI Platinum Card"){ $card_type="IRCP";  $PromoCode="IREA";}elseif($CardName=="Mumbai Metro SBI Card"){ $card_type="MMSU";  $PromoCode="SCEA";}elseif($CardName=="Yatra SBI Card"){ $card_type="SYT1"; $PromoCode="YAEA"; }elseif($CardName=="SimplyCLICK Contactless SBI Card"){ $card_type="CSC2"; $PromoCode="SCEA";} else  { $card_type="SSU2"; $PromoCode="SCEA";}

		//echo $strcity;
		//$SourceCode = GetSourceCode(ucwords(strtolower($strcity)));
		$CardType = $card_type;
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
		$DateSpareField=date('m/d/Y',$yesterday);
		$strdob = $day."/".$month."/".$year;
		$FirstName = substr($first_name,0,12);//mandatory 
		$MiddleName = substr($middle_name,0,10);//mandatory
		$LastName = substr($last_name,0,16);//mandatory
		$Mobile = $Mobile;//mandatory
		$Qualification = $Qualification;
		$PAN = $Pancard;//mandatory
		$ResiAddress1 = trim(substr($resiaddress1,0,40));//mandatory
		$ResiAddress2 = trim(substr($resiaddress2,0,40));//mandatory
		$ResiAddress3 = trim(substr($resiaddress3,0,40));;//mandatory
		$EmailAddress = $Email;//mandatory
		$ResiCity = $strcity;//mandatory
		$ResiState = $ResiState;//mandatory
		$ResiPin = $Pincode;//mandatory
		$OccupationType = $OccupationType;//mandatory
		$CompanyName = $CompanyName;
		$OfficeAddress1 = trim(substr($OfficeAddress1,0,40));//mandatory
		$OfficeAddress2 =trim(substr($OfficeAddress2,0,40));//mandatory
		$EmployeePFNumber="";
		$BranchManagerPFNumber="";

if($LeadRefNumber>0)
		  {
				$LeadRefNumberfinal=$LeadRefNumber;
		  }
		  else
		  {
			  $LeadRefNumberfinal="";
		  }
		 $xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
		   <soapenv:Header/>
		   <soapenv:Body>
			  <qde:invoke>         
				 <qde:losRequest>           
					<xsd:data>
		<![CDATA[
		<ApplicationIngestionRequest>
		<LeadRefNo>'.$LeadRefNumberfinal.'</LeadRefNo>
		<BranchCode></BranchCode>
		<SourceCode>'.$SourceCode.'</SourceCode>
		<SECode>DEAl4LOANS</SECode>
		<PromoCode>'.$PromoCode.'</PromoCode>
		<CardType>'.$CardType.'</CardType>
		<PromoGroup>EA</PromoGroup>
		<ChannelCode>EAPL</ChannelCode>
		<Salutation>1</Salutation>
		<FirstName>'.trim(strtoupper($FirstName)).'</FirstName>
		<MiddleName>'.strtoupper($MiddleName).'</MiddleName>
		<LastName>'.trim(strtoupper($LastName)).'</LastName>
		<DOB>'.$strdob.'</DOB>
		<Mobile>'.$Mobile.'</Mobile>
		<Gender>'.$strgender.'</Gender>
		<Qualification>'.strtoupper($Qualification).'</Qualification>
		<PAN>'.strtoupper($PAN).'</PAN>
		<EmailAddress>'.trim($EmailAddress).'</EmailAddress>
		<ResiAddress1>'.strtoupper($ResiAddress1).'</ResiAddress1>
		<ResiAddress2>'.strtoupper($ResiAddress2).'</ResiAddress2>
		<ResiAddress3>'.strtoupper($ResiAddress3).'</ResiAddress3>
		<ResiCity>'.$ResiCity.'</ResiCity>
		<ResiState>'.$ResiState.'</ResiState>
		<ResiPin>'.$ResiPin.'</ResiPin>
		<ResiPhone>'.trim($ResiPhone).'</ResiPhone>
		<ResiStdCode>'.$resistd.'</ResiStdCode>
		<OccupationType>'.$OccupationType.'</OccupationType>
		<AlternateCardNo></AlternateCardNo>
		<Designation>'.$Designation.'</Designation>
		<CompanyName>'.trim($CompanyName).'</CompanyName>
		<NatureOfBusiness>A</NatureOfBusiness>
		<OfficeAddress1>'.strtoupper($OfficeAddress1).'</OfficeAddress1>
		<OfficeAddress2>'.strtoupper($OfficeAddress2).'</OfficeAddress2>
		<OfficeAddress3></OfficeAddress3>
		<OfficePhone>'.trim($OfficePhone).'</OfficePhone>
		<OfficeStdCode>'.trim($offstd).'</OfficeStdCode>
		<OfficeState>'.$OfficeState.'</OfficeState>
		<OfficeCity>'.$OfficeCity.'</OfficeCity>
		<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
		<OfficePin>'.$OfficePin.'</OfficePin>
		<TextSpareField1>D4L'.$RequestID.'</TextSpareField1>
		<TextSpareField2>assisted</TextSpareField2>
		<TextSpareField3>1</TextSpareField3>
		<TextSpareField4>1</TextSpareField4>
		<TextSpareField5>1</TextSpareField5>
		<NumericSpareField1>1</NumericSpareField1>
		<NumericSpareField2>1</NumericSpareField2>
		<NumericSpareField3>1</NumericSpareField3>
		<NumericSpareField4>1</NumericSpareField4>
		<NumericSpareField5>1</NumericSpareField5>
		<DateSpareField1>'.$DateSpareField.'</DateSpareField1>
		<DateSpareField2>'.$DateSpareField.'</DateSpareField2>
		<DateSpareField3>'.$DateSpareField.'</DateSpareField3>
		<DateSpareField4>'.$DateSpareField.'</DateSpareField4>
		<DateSpareField5>'.$DateSpareField.'</DateSpareField5>
		<EmployeePFNumber></EmployeePFNumber>
		<BranchManagerPFNumber></BranchManagerPFNumber>
		<PriorityFlag>1</PriorityFlag>
		<DateOfPickup></DateOfPickup>
		<TimeOfPickup></TimeOfPickup>
		<StatementPreference>E</StatementPreference>
		<LoyaltyChannel></LoyaltyChannel>
		<LoyaltyNumber></LoyaltyNumber>
		<ActualFulfillmentDeviation>N</ActualFulfillmentDeviation>
		<PhysicalAlreadyReceived>N</PhysicalAlreadyReceived>
		<FathersName></FathersName>
		<MothersMaidenName></MothersMaidenName>
		<ResiLandmark></ResiLandmark>
		<OfficeLandmark></OfficeLandmark>
		</ApplicationIngestionRequest>
		]]>
		</xsd:data>
				   <xsd:requestid></xsd:requestid>            
					<xsd:userCtx>               
					   <xsd:password>Los@123</xsd:password>              
					   <xsd:userId>555555555</xsd:userId>
					</xsd:userCtx>
				 </qde:losRequest>
			  </qde:invoke>
		   </soapenv:Body>
		</soapenv:Envelope>'; 
		//echo $xmlstr;
		
		 $DataArray_Request = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
//		 $wherecondition ="(sbiccid='".$sbiccid."')";
		 $wherecondition ="(RequestID='".$RequestID."')"; //RequestID='".$RequestID."'
		 
		 //Insert log
		$dataArr = array("Crossword_Solution" => json_encode($DataArray_Request), "Crossword_Option" => $wherecondition);
		
		//echo '<pre>';
		//print_r($DataArray_Request);
		//print_r(json_encode($DataArray_Request));
		//exit;
		Maininsertfunc("Crossword_Details", $dataArr);
			
		Mainupdatefunc ('sbi_credit_card_5633', $DataArray_Request, $wherecondition);
	 	 
	 	$sbilogqry="select sbicclogid from sbi_credit_card_5633_log Where (cc_requestid=".$RequestID.")";
		$sbilogresult=ExecQuery($sbilogqry);
		$lgrow=mysql_fetch_array($sbilogresult);
		if($lgrow["sbicclogid"]>0)
	  	{
			$insertDataArray_Request = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$wherecondition_Request ="(sbicclogid='".$lgrow["sbicclogid"]."')";
			
			//Insert log
			$dataArr = array("Crossword_Solution" => json_encode($insertDataArray_Request), "Crossword_Option" => $wherecondition_Request);
			Maininsertfunc("Crossword_Details", $dataArr);
			
			Mainupdatefunc ('sbi_credit_card_5633_log', $insertDataArray_Request, $wherecondition_Request);
		}
		else
		{
			$insertDataArray_Request = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			
			//Insert log
			$dataArr = array("Crossword_Solution" => json_encode($insertDataArray_Request));
			Maininsertfunc("Crossword_Details", $dataArr);
			
			$ProductValuelog = Maininsertfunc("sbi_credit_card_5633_log", $insertDataArray_Request);
		}	
		
		$username=79584822;
		$password="de@l4loan5";
		//$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/ApplicationIngestionService?wsdl';
		$url ='http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl';
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 

		//echo $output;
	//print_r($output);
		$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string =  str_replace("&lt;", "<", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);

		echo "LeadRef Numbner: ".$LeadRefNumber = $xml->LeadRefNumber; echo "<br>";
		echo "Application Number: ".$ApplicationNumber = $xml->ApplicationNumber;echo "<br>";
		echo "STatus Code: ".$StatusCode = $xml->StatusCode;echo "<br>";
		echo "Processing Statusr: ".$ProcessingStatus = $xml->ProcessingStatus;echo "<br>";
		echo "CreditLimit: ".$CreditLimit = $xml->CreditLimit;echo "<br>";
		echo "Message: ".$Message = $xml->Messages->Message;echo "<br>";
		echo "code: ".$code = $xml->code;echo "<br>";
		echo "message: ".$message = $xml->message;echo "<br>";
		$pushflag=0;
	/*	$output="0";
		$LeadRefNumber = "19086000000AI0103049";
		$ApplicationNumber = "1908601003191";
		$StatusCode = "FD";
		$ProcessingStatus = "7";*/
			
		if($ProcessingStatus==1 || $ProcessingStatus==2)
	  {
		$secondpushflag=1;
	  }
	  else
	  {
		$secondpushflag=0;
	  }
			 $DataArray = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "secondpushflag"=>$secondpushflag, "pushflag"=>$pushflag, "webservice_flag"=>2);
		//	$wherecondition ="(sbiccid='".$sbiccid."')";
			$wherecondition ="(RequestID='".$RequestID."')"; //RequestID='".$RequestID."'
			//print_r($DataArray);
			//Insert log
			$dataArr = array("Crossword_Solution" => json_encode($DataArray), "Crossword_Option" => $wherecondition);
			Maininsertfunc("Crossword_Details", $dataArr);
			
			Mainupdatefunc ('sbi_credit_card_5633', $DataArray, $wherecondition);
		
		$sbilogqry="select sbicclogid from sbi_credit_card_5633_log Where (cc_requestid=".$RequestID.")";
		$sbilogresult=ExecQuery($sbilogqry);
		$lgrow=mysql_fetch_array($sbilogresult);
		if($lgrow["sbicclogid"]>0)
	  {
			$insertDataArray = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated,  "webservice_flag"=>2);
			$wherecondition ="(sbicclogid='".$lgrow["sbicclogid"]."')";
			
			//Insert log
			$dataArr = array("Crossword_Solution" => json_encode($insertDataArray), "Crossword_Option" => $wherecondition);
			Maininsertfunc("Crossword_Details", $dataArr);
			
			Mainupdatefunc ('sbi_credit_card_5633_log', $insertDataArray, $wherecondition);
	  }
	  else
	  {
		  $insertDataArray = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated,  "webservice_flag"=>'3' );
		  
			//Insert log
			$dataArr = array("Crossword_Solution" => json_encode($insertDataArray));
			Maininsertfunc("Crossword_Details", $dataArr);
			
			$ProductValuelog = Maininsertfunc("sbi_credit_card_5633_log", $insertDataArray);
	  }
	  //print_r($insertDataArray);
	  }
  }

  function GetCityStatecCode($pKey){
    $titles = array(
	'AHMEDABAD' => 'GUJ',
	'AURANGABAD' => 'MAH',
	'BANGALORE' => 'KTK',
	'BARODA' => 'GUJ',
	'BHOPAL' => 'MAD',
	'BHUBANESHWAR' => 'ORI',
	'BHUBNESHWAR' => 'ORI',
	'CALCUTTA' => 'WGB',
	'KOLKATA' => 'WGB',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'TMN',
	'COIMBATORE' => 'KTK',
	'FARIDABAD' => 'HAR',
	'GHAZIABAD' => 'UP',
	'GURGAON' => 'HAR',
	'HYDERABAD' => 'APR',
	'INDORE' => 'MAD',
	'JAIPUR' => 'RAJ',
	'JALANDHAR' => 'PUN',
	'JAMNAGAR' => 'MAD',
	'LUCKNOW' => 'UP',
	'LUDHIANA' => 'PUN',
	'MUMBAI' => 'MAH',
	'NAGPUR' => 'MAH',
	'NASIK' => 'MAD',
	'NEW DELHI' => 'DEL',
	'NOIDA' => 'UP',
	'PATNA' => 'BIH',
	'PUNE' => 'MAH',
	'RAJKOT' => 'MAD',
	'SURAT' => 'GUJ',
	'TIRUPUR' => 'TMN',
	'TRIVANDRUM' => 'KER'
);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>
