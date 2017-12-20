<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);

//Delhi,Noida,Gurgaon,Gaziabad,Faridabad,Munbai,Navi Mumbai,Thane

function GetStatecCode($pKey){
    $titles = array(
	'Delhi' => '7',
	'Noida' => '9',
	'Gurgaon' => '6',
	'Gaziabad' => '9',
	'Faridabad' => '6',
	'Mumbai' => '27',
	'Navi Mumbai' => '27',
	'Thane' => '27'
	
	  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function apidetails($productid, $api_name, $api_version, $api_request, $api_response)
{
	$apifeedbackarr = json_decode($api_response,true);
	if($api_name=="applicationCreate")
	{
		$APPLICATION_ID=$apifeedbackarr["response"]["APPLICATION_ID"];
	}
	else
	{
		$APPLICATION_ID=$apifeedbackarr["APPLICATION_ID"];
	}
	if($apifeedbackarr["status"]==1 && strlen($APPLICATION_ID)>2)
	{
		$finalstatus=1;
	}
	else
	{
		$finalstatus=0;
	}
	$incredlog = array('product'=>"PL", 'productid'=>$productid, 'bankid'=>"86", 'api_name'=>$api_name, 'api_version'=>$api_version, 'api_request'=>$api_request, 'api_response'=>$api_response, 'api_response_status'=>$finalstatus);
	//print_R($incredlog);
	
	$insert = Maininsertfunc ('webservice_details_pl', $incredlog);

	
	return($APPLICATION_ID);
}

//applicationCreate API1
function IncredApplicationCreate($PostArray) {
    $requestid = $PostArray["requestid"];
    $loan_amount = round($PostArray["loan_amount"]);
    $name = $PostArray["name"];
    $NameArr = explode(" ", $name);
    $FirstName = current($NameArr);
    $midName = next($NameArr);
    $EndName = end($NameArr);
    $LastName = $midName." ".$EndName;
    $source = $PostArray["source"];
    $dob = $PostArray["dob"];
    $DObVal = date("d/m/Y", strtotime($dob));
    $City = $PostArray["City"];
	$Resi_state=GetStatecCode($City);
    $Email = $PostArray["Email"];
    $Mobile_Number = $PostArray["Mobile_Number"];
    $gender = $PostArray["gender"];
    if ($gender == 2) {
        $GenderVal = "F";
    } else {
        $GenderVal = "M";
    }
    $panno = $PostArray["panno"];
    $ResAddress = $PostArray["ResAddress"];
    $Respincode = $PostArray["Respincode"];
    $company_name = $PostArray["company_name"];
    $salary = $PostArray["GrossMonthly"];
    $pl_bank_name = $PostArray["pl_bank_name"];
    $net_salary = $salary * 12;
    $BankName = $PostArray["BankName"];
    $city = $City;
    $designation = $PostArray["designation"];
    $joinmonth = $PostArray["joinmonth"];
    $joinyear = $PostArray["joinyear"];
    $FromDate = $joinmonth . "/" . $joinyear;
    $OfficeAddress = $PostArray["OfficeAddress"];
    $OfficeCity = $PostArray["OfficeCity"];
    $office_state = $PostArray["office_state"];
    $OfficePincode = $PostArray["OfficePincode"];
    $salary_type = $PostArray["salary_type"];
    $fathername=$FirstName." Father";
	
	$jsonStr="{  \r\n\t\"MOBILE\":\"".$Mobile_Number."\",\r\n\t\"LOAN_TYPE\":\"PL\",\r\n\t\"LOAN_AMOUNT\":\"".$loan_amount."\",\r\n\t\"LOAN_TENURE\":12, \r\n\t\"EXISTING_EMI\":1000,\r\n\t\"FNAME\":\"".$FirstName."\",\r\n\t\"LNAME\":\" ".$LastName."\",\r\n\t\"GENDER\":\"".$GenderVal."\",\r\n\t\"DOB\":\"".$DObVal."\",\r\n\t\"ADDRESS\":\"".$ResAddress."\",\r\n\t\"LOCALITY\":\"".$City."\",\r\n\t\"PINCODE\":\"".$Respincode."\",\r\n\t\"STATE\":\"".$office_state."\",\r\n\t\"PAN\":\"".$panno."\",\r\n\t\"FATHER_NAME\": \"".$fathername."\",\r\n\t\"EMPLOYMENT\":{  \r\n\t  \"ADDRESS\":\"".$OfficeAddress."\",\r\n\t  \"LOCALITY\":\"".$OfficeCity."\",\r\n\t  \"PINCODE\":\"".$OfficePincode."\",\r\n\t  \"STATE\":\"".$Resi_state."\",\r\n\t  \"COMPANY\":\"".$company_name."\",\r\n\t  \"COMPANY_CATEGORY\":\"SALARIED\",\r\n\t  \"INDUSTRY\":\"25\",\r\n\t  \"NATURE_OF_BUSINESS\":\"231\",\r\n\t  \"EMPLOYMENT_TYPE\":\"SALARIED\",\r\n\t  \"DESIGNATION\":\"".$designation."\",\r\n\t  \"EMAIL\":\"".$Email."\",\r\n\t  \"FROM_DATE\":\"".$FromDate."\",\r\n\t  \"SALARY\":{  \r\n\t\t \"MONTHLY\":\"".$salary."\",\r\n\t\t \"NET_MONTHLY\":\"".$salary."\",\r\n\t\t \"TYPE\":\"".$salary_type."\"\r\n\t  }\r\n\t}\r\n\t}";
	//echo "<br>".$jsonStr."<br>";
    $curl = curl_init();
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.incred.com/applicationCreate",
	//	CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 100,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $jsonStr,
	  CURLOPT_HTTPHEADER => array(
		"api-key: f72a08fcae3e1710acf678f5e9db4789c84733fbcb281af63020350cecbc42",
		"cache-control: no-cache",
		"content-type: application/json",
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  $responsefinal= "cURL Error #:" . $err;
	} else {
	  $responsefinal= $response;
	}
$APPLICATION_ID=apidetails($requestid, "applicationCreate", "Prod", $jsonStr, $responsefinal);
	if(isset($APPLICATION_ID))
	{
		IncredFinancProfileCreate($PostArray,$APPLICATION_ID,$requestid);
	}
	else
	{
		$FILE_TYPE = $PostArray["FILE_TYPE"];
		$FILE_TYPE_ANOTHER = $PostArray["FILE_TYPE_ANOTHER"];
		$doc_type= $PostArray["doc_type"];
		document_upload($FILE_TYPE, "", "", "1", $requestid);//for first document Bank statement
		document_upload("", $FILE_TYPE_ANOTHER, $doc_type, "2", $requestid);//for Second document upload
	}
}

//financialProfileCreate  API2
function IncredFinancProfileCreate($PostArray,$ApplicationID,$requestid) {
 	//$DataEntryType = $fileExxplode[1];
	$BankName = $PostArray["BankName"];
    $AccHolderName = $PostArray["AccHolderName"];
    $AccNumber = $PostArray["AccNumber"];
    $account_type = $PostArray["account_type"];
    $PrimaryFlag = $PostArray["PrimaryFlag"];
	$FILE_PATH = $PostArray["FILE_PATH"];
	$fileExxplode = explode("/",$FILE_PATH);
	$FILE_TYPE = $PostArray["FILE_TYPE"];
	$UploadFileDetails = explode(",",$FILE_TYPE);
	$filetmp_name= $UploadFileDetails[0];
	$file_type= $UploadFileDetails[1];
	$file_name= $UploadFileDetails[2];
	$filesize= $UploadFileDetails[3];
	if($file_type == "application/pdf"){
	$DATA_ENTRY_TYPE="PDF";}
	else
	{
		$DATA_ENTRY_TYPE="OTHERS";
	}	
	$FILE_TYPE_ANOTHER = $PostArray["FILE_TYPE_ANOTHER"];
	$Operatemonth = $PostArray["Operatemonth"];
	$Operateyear = $PostArray["Operateyear"];
	$OperateSince = $Operatemonth . "/" . $Operateyear;

	$PrimaryFlagstr="";
	if($PrimaryFlag==1)
	{
		$PrimaryFlagstr="YES";
	}else
	{
		$PrimaryFlagstr="NO";
	}
	$file_parts = pathinfo($FILE_PATH);
	$filename=$file_parts['filename'];
	
	$cfile = new CURLFile($filetmp_name, $file_type, $fileBaseName);
	
	$headers = array("api-key: f72a08fcae3e1710acf678f5e9db4789c84733fbcb281af63020350cecbc42","Content-Type:multipart/form-data");

	$postfields = array("ACCOUNT_HOLDER_NAME" => $AccHolderName, "ACCOUNT_NUM" => $AccNumber, "ACCOUNT_TYPE" =>$account_type, "BANK_CODE" =>$BankName, "DATA_ENTRY_TYPE" =>$DATA_ENTRY_TYPE, "OPERATING_SINCE" => $OperateSince, "PRIMARY_FLAG" => $PrimaryFlagstr, "APPLICATION_ID" => $ApplicationID, "FILE" => $cfile );
	
	//url="https://uat-api.incred.com/?financialProfileCreate";//UAT
	$url="https://api.incred.com/financialProfileCreate";//Prod
   $ch = curl_init();
		$options = array(
			CURLOPT_URL => $url,
			//CURLOPT_HEADER => true,
			CURLOPT_TIMEOUT => 200,
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => $postfields,
		  // CURLOPT_INFILESIZE => $filesize,
			CURLOPT_RETURNTRANSFER => true
		); // cURL options
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		$err = curl_error($ch);
		if ($err) {
			  $finalresponse= "cURL Error #:" . $err;
			} else {
			  $finalresponse= $response;
			}
		  //$info = curl_getinfo($ch);
		curl_close($ch);

	$jsonstr=json_encode($postfields);

	$APPLICATION_ID=apidetails($requestid, "financialProfileCreate", "Prod", $jsonstr, $finalresponse);
	if(isset($APPLICATION_ID))
	{
		//echo "<br> herefor upload<br>";
		$FILE_TYPE = $PostArray["FILE_TYPE"];
		document_upload($FILE_TYPE, "", "", "1", $requestid);//for first document Bank statement

		$doc_type= $PostArray["doc_type"];
		$doc_name= $PostArray["doc_name"];
		$FILE_PATH_ANOTHER = $PostArray["FILE_PATH_ANOTHER"];
		fileupload($APPLICATION_ID, $filepath, $FILE_TYPE_ANOTHER, $filename, $requestid, $doc_name, $doc_type, $FILE_PATH_ANOTHER );		
	}
	else
	{	
		$doc_type= $PostArray["doc_type"];
		$FILE_TYPE_ANOTHER = $PostArray["FILE_TYPE_ANOTHER"];
		document_upload("", $FILE_TYPE_ANOTHER, $doc_type, "2", $requestid);//for Second document upload
	}

}

//fileupload API3
function fileupload($ApplicationID, $filepath, $FILE_TYPE_ANOTHER, $filename,$requestid, $doc_name, $doc_type, $FILE_PATH_ANOTHER) {
		$DocType= $doc_type;
		$DocName= $doc_name;
		$DocNum = substr(trim($requestid),0,7);
		$UploadFileDetails = explode(",",$FILE_TYPE_ANOTHER);
		$DocNum = substr(trim($requestid),0,7);
		$filetmp_name= $UploadFileDetails[0];
		$file_type= $UploadFileDetails[1];
		$file_name= $UploadFileDetails[2];
		$filesize= $UploadFileDetails[3];

		$cfile = new CURLFile($filetmp_name, $file_type, $file_name);
		$headers = array("api-key: f72a08fcae3e1710acf678f5e9db4789c84733fbcb281af63020350cecbc42","Content-Type:multipart/form-data"); 
	
		$postfields = array("FILE" => $cfile, "APPLICATION_ID" => $ApplicationID, "DOC_TYPE" =>$DocType, "DOC_NAME" =>$DocName, "DOC_NUM" =>$DocNum);
		$url="https://api.incred.com/fileupload";//UAT
		//$url="https://api.incred.com/fileupload";//Prod
		$ch = curl_init();

		$options = array(
			CURLOPT_URL => $url,
			//CURLOPT_HEADER => true,
			CURLOPT_TIMEOUT => 200,
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => $postfields,
		  // CURLOPT_INFILESIZE => $filesize,
			CURLOPT_RETURNTRANSFER => true
		); // cURL options
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		$err=curl_errno($ch);
		if ($err) {
		   $finalresponse=$err;
		} else {
			$finalresponse=$response;
		}
		curl_close($ch);
		$jsonstr=json_encode($postfields);
		//document upload
		document_upload("", $FILE_TYPE_ANOTHER, $doc_type, "2", $requestid);//for Second document upload
		//end of document
	$APPLICATION_ID=apidetails($requestid, "fileupload", "Prod", $jsonstr, $finalresponse);
}


function document_upload($FILE_TYPE, $FILE_TYPE_ANOTHER, $doc_type, $doc_turn, $requestid)
{
	if($doc_turn==2)
	{
		
		//$secondFileUploadDetails=$fileTmpNameAnother.",".$fileTypeAnother.",".$uploadFile_another.",".$fileSizeAnother;
		$UploadFileDetails = explode(",",$FILE_TYPE_ANOTHER);
		$uploadFile_another = $UploadFileDetails[2];
		$fileSizeAnother = $UploadFileDetails[3];
		$fileTypeAnother = $UploadFileDetails[1];
		$fileTmpNameAnother = $UploadFileDetails[0];

		$file_basenameAnother = substr($uploadFile_another, 0, strripos($uploadFile_another, '.')); // strip extention
		$file_extAnother = strtolower(substr($uploadFile_another, strripos($uploadFile_another, '.'))); // strip name
		if($doc_type=="PL_IN_ADR_PRF")
		{
			$fileBaseNameAnother = "incredAddress".$requestid."pl". $file_extAnother;
		}
		else
		{
			$fileBaseNameAnother = "incredIdentity".$requestid."pl". $file_extAnother;
		}
		//die;
		if (($fileTypeAnother == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($fileTypeAnother == "application/msword") || ($fileTypeAnother == "application/pdf") || ($fileTypeAnother == "image/png") || ($fileTypeAnother == "image/jpg") || ($fileTypeAnother == "image/gif")) {
			if ($fileSizeAnother <= 2048) {
				$uploadPathAnother = "upload/uploads_incred/" . $fileBaseNameAnother;
				move_uploaded_file($fileTmpNameAnother, $uploadPathAnother);
			}
		}
	}
	elseif($doc_turn==1)
	{
		$firstUploadFileDetails = explode(",",$FILE_TYPE);
		$UploadFile = $firstUploadFileDetails[2];
		$fileSize = $firstUploadFileDetails[3];
		$fileType = $firstUploadFileDetails[1];
		$fileTmpName = $firstUploadFileDetails[0];
		//$FirstFileUploadDetails=$fileTmpName.",".$fileType.",".$UploadFile.",".$fileSize;

		$file_basename = substr($UploadFile, 0, strripos($UploadFile, '.')); // strip extention
		$file_ext = strtolower(substr($UploadFile, strripos($UploadFile, '.'))); // strip name
		$fileBaseName = "incred".$requestid."pl". $file_ext;
		//die;
		if (($fileType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($fileType == "application/msword") || ($fileType == "application/pdf") || ($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/gif")) {
			if ($fileSize <= 2048) {

				$uploadPath = "upload/uploads_incred/" . $fileBaseName;
				move_uploaded_file($fileTmpName, $uploadPath);
			}
			
		}
	}
}
?>