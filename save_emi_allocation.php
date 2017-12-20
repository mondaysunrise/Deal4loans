 <?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);


$fetchleadid="Select * from  Req_Compaign Where (BidderID=766)";
	 list($recorcount,$row1)=Mainselectfunc($fetchleadid,$array = array());

$RequestID = $row1["RequestID"];
$RequestID=5;

if($RequestID>0)
{
	$validlead="Select * from saveemicalc_tbl Where (Allocate=0 and Is_Valid=1 and saveemiid=".$RequestID.")";
}
else
{
	$validlead="Select * from saveemicalc_tbl Where (Allocate=0 and Is_Valid=1 and (dated between '".$min_date."' and '".$max_date."'))";
}
echo $validlead;
 list($recordcount,$rows)=MainselectfuncNew($validlead,$array = array());

$bidderslist="";
for($ii=0;$ii<$recordcount;$ii++)
{
	echo "<br><br>hello<br><br>";
	  	$Name= $rows[$ii]["Name"];
		$Email= $rows[$ii]["Email"];
		$Mobile_No= $rows[$ii]["Mobile_No"];
		$Net_Salary= $rows[$ii]["Net_Salary"];
		$DOB= $rows[$ii]["DOB"];	
		$Employment_Status= $rows[$ii]["Employment_Status"];
		$Loan_Amount= $rows[$ii]["Loan_Amount"];	
		$City= $rows[$ii]["City"];
		$City_Other= $rows[$ii]["City_Other"];	
		$Company_Name= $rows[$ii]["Company_Name"];	
		$Total_Experience= $rows[$ii]["Total_Experience"];	
		$Years_In_Company= $rows[$ii]["Years_In_Company"];
		$CC_Holder= $rows[$ii]["CC_Holder"];
		$Card_Vintage= $rows[$ii]["Card_Vintage"];
		$CC_Age= $rows[$ii]["CC_Age"];
		$EMI_Paid= $rows[$ii]["EMI_Paid"];
		$Primary_Acc = $rows[$ii]["Primary_Acc"];
	 	$IP = $_SERVER["HTTP_X_REAL_IP"];

	$DataArray = array("RequestID"=>$rows[$ii]["saveemiid"], 'Dated'=>$Dated);
		$wherecondition ="(BidderID=766)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
}

?>