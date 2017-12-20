<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }




function getRequestidpl()
{
	//$Type_Loan= $product;
	//echo $Type_Loan."<br>";
	$search_query="Select * from Req_Loan_Personal where Allocated='0' and Dated between '2007-06-01 00:00:00' and '2007-06-31:23:59:59' ";
	
	 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
		
	while($cntr<count($row))
        {
		$Customerid= $row[$cntr]["RequestID"];
		if($row[$cntr]["City"]=="Others")
		{
			$City= $row[$cntr]["City_Other"];
		}
		else
		{
			$City= $row[$cntr]["City"];
		}

		getBiddersList(getReqValue("Req_Loan_Personal"),$Customerid,$City);		

	  $cntr=$cntr+1;}
}

function getRequestidhl()
{
	//$Type_Loan= $product;
	//echo $Type_Loan."<br>";
	$search_query="Select * from Req_Loan_Home where Allocated='0' and  Dated between '2007-06-01 00:00:00' and '2007-06-31:23:59:59'";
	
	 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
		
	while($cntr<count($row))
        {
		$Customerid= $row[$cntr]["RequestID"];

		if($row["City"]=="Others")
		{
			$City= $row[$cntr]["City_Other"];
		}
		else
		{
			$City= $row[$cntr]["City"];
		}
		//$Other_City= $row["City_Other"];
		getBiddersList(getReqValue("Req_Loan_Home"),$Customerid,$City);		
	$cntr=$cntr+1;}
}

function getRequestidcl()
{
	//$Type_Loan= $product;
	//echo $Type_Loan."<br>";
	$search_query="Select * from Req_Loan_Car where Allocated='0' and  Dated between '2007-06-01 00:00:00' and '2007-06-31:23:59:59' ";
	list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
		
	while($cntr<count($row))
        {
		$Customerid= $row[$cntr]["RequestID"];
		if($row[$cntr]["City"]=="Others")
		{
			$City= $row[$cntr]["City_Other"];
		}
		else
		{
			$City= $row[$cntr]["City"];
		}

		getBiddersList(getReqValue("Req_Loan_Car"),$Customerid,$City);		

	$cntr=$cntr+1;}

}

function getRequestidlap()
{
	//$Type_Loan= $product;
	//echo $Type_Loan."<br>";
	$search_query="Select * from Req_Loan_Against_Property where Allocated='0' and  Dated between '2007-06-01 00:00:00' and '2007-06-31:23:59:59' ";
	list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
		
	while($cntr<count($row))
        {
		$Customerid= $row[$cntr]["RequestID"];
		if($row[$cntr]["City"]=="Others")
		{
			$City= $row[$cntr]["City_Other"];
		}
		else
		{
			$City= $row[$cntr]["City"];
		}

		getBiddersList(getReqValue("Req_Loan_Against_Property"),$Customerid,$City);		

	$cntr=$cntr+1;}
}

function getRequestidcc()
{
	//$Type_Loan= $product;
	//echo $Type_Loan."<br>";
	$search_query="Select * from Req_Credit_Card where Allocated='0' and Dated between '2007-06-01 00:00:00' and '2007-06-31:23:59:59' ";
	list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
		
	while($cntr<count($row))
        {
		$Customerid= $row[$cntr]["RequestID"];
		if($row[$cntr]["City"]=="Others")
		{
			$City= $row[$cntr]["City_Other"];
		}
		else
		{
			$City= $row[$cntr]["City"];
		}
		getBiddersList(getReqValue("Req_Credit_Card"),$Customerid,$City);		

$cntr=$cntr+1;}
}

function getBiddersList($strProduct,$strRequestID,$strCity)
{
	$RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = getCodeValue("ReplyType_$strProduct");
	$qry = "SELECT * FROM Bidders_List WHERE Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%'";

	list($recordcount,$row)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
	//echo "ll".$qry;
    $i=0;
	$j=0;
	$k=0;
	$z=0;
	$q=0;
	while($cntr<count($row))
        {
		$query = $row[$cntr]["Query"];
		$table = $row[$cntr]["Table_Name"];
		$Bidderid = $row[$cntr]["BidderID"];
		$always = $row[$cntr]["Always"];
		$conflict = $row[$cntr]["Conflict_bidder"];
		$last_selection = $row[$cntr]["Last_set_select"];
		//$id1 = $id1."'".$conflict."',";
		//echo "ll".$query."<br>";
	    $qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
		//echo "ff".$qry2;
			list($recordcount,$row1)=MainselectfuncNew($qry2,$array = array());
		if($recordcount>0) //(result1)
		{
			for($jj=0;$jj<$recordcount;$jj++)
			{
				$Request= $row1[$jj]["RequestID"];
				
			 if($always==1)
			{
				$arr1[$i]=$Bidderid;
				 $i=$i+1;
				 //echo $Bidderid;
			 }
			 if(($always!=1) && ($last_selection!=1) &&(strlen(trim($conflict))>0))
			{ 
				 
				 $alwaznt[$z]=$Bidderid;
				 $z=$z+1;
				 //echo "bidder:".$id."<br>";
				 
				  if(count($arr2)>0)
				 {
					
					$flag=0;
					$l=0;
					while($l<count($arr2))
					{
						if(strlen(strpos($arr2[$l],$Bidderid)) > 0 )
						{
							$flag=0;
							//break while loop
							break;		
							
						}
						else
						{
							$flag=1;
						}
						$l++;
					}//while

					if($flag=="1")
					{
						$arr2[count($arr2)]=$Bidderid.",".trim($conflict);
							
					}
				}
				else
				{						
					$j=0;
					$arr2[$j]=$Bidderid.",".trim($conflict);
				}

			}
		 if(($always!=1) && ($last_selection==1))
			{
				$arr3[$k]=$Bidderid;
				$k=$k+1;
				//##echo "bidderid:last".$Bidderid."<br>";
				}
			
			}
		}

	$cntr=$cntr+1;}
	
	$i=0;
	$z=0;
	$q=0;
	$ks=0;
	$bb=0;
	$str1=" ";
	$str2=" ";
	$str_final="";
	for($j=0;$j<count($arr2);$j++)
	{
		$pieces = explode(",", $arr2[$j]);

		for($l=0;$l<count($pieces);$l++)
		{					
			$qry1="select * from Bidders_List where BidderID='".$pieces[$l]."'";
				list($rowNR,$row)=MainselectfuncNew($qry1,$array = array());
for($kk=0;$kk<$rowNR;$kk++)
			{
				$seq=$row[$kk]["Sequence_no"];
				$bidder = $row[$kk]["BidderID"];
				$arrr[$z] = $seq;
				$z= $z+1;
				$arrt[$q] = $bidder;
				$q=$q+1;
								
			}
		}
		
	
		for($i=0;$i<Count($arrr);$i++)
		{
			for($p=$i;$p<Count($arrr);$p++)
			{
			   $varI = 0;
			   $varJ = 0;
			   $varI = $arrr[$i];
			   $varJ = $arrr[$p];
			   if($varI > $varJ)
			   {
				$intTempStore = $arrr[$i]; 
				$arrr[$i] = $arrr[$p];
				$arrr[$p] = $intTempStore;

				$sTemp=$arrt[$i];
				$arrt[$i]=$arrt[$p];
				$arrt[$p]=$sTemp;
			  
			   } //i > j
			} //j
		} //i
		$id="";
		$existflag = 0 ;
		for($kk=0;$kk<count($arrt);$kk++)
		{
			$qry2="select * from Bidders_List where BidderID='".$arrt[$kk]."'";
			list($rowNR,$row)=MainselectfuncNew($qry2,$array = array());
			for($ii=0;$ii<$rowNR;$ii++)
			{
				$seq=$row[$ii]["Sequence_no"];
				$last= $row[$ii]["Last_allocation"];
				$bidder = $row[$ii]["BidderID"];
				
				if($last=='1')
				{	
					//echo "gg".$bidder."<br>";
					$id=$id.$bidder.",";
					//echo "bb".$id;
					$seq_find = $seq + 1;


					//find next allocation
					$kk1=0;
					$pos=0;
					while($kk1<count($arrr))
					{
						if($arrr[$kk1]==$seq_find)
						{
							$pos=$kk1;
							break;
						}
						else
						{
							$pos=0;
						}

						$kk1++;

					}
			
					$str_final=$str_final.$arrt[$pos].",";
					break;
					//echo ."lastallocation=0:".$bidder."<br>";

				}//if
				else
				{
					$seq_find = 0;
				}
			}//while

			
			
		}
		//for
$pieces9 = explode(",", $id);

		for($ll=0;$ll<count($pieces9);$ll++)
		{		
			$dataUpdate = array('Last_allocation'=>'0');
			$wherecondition = "(BidderID=".$pieces9[$ll].")";
			Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
		}
		
		$arrr="";
		$arrt="";
		$z=0;
		$q=0;
		$bb=0;
		$ll=0;	
							
}//END
//echo "str:".$str_final."<br>";
	
for($j=0;$j<count($arr2);$j++)
	{
		echo "unique sets formed :".$arr2[$j]."<br>";
	}

	for($z=0;$z<count($arr1);$z++)
		{
	$final= $final.$arr1[$z].",";

		}
	//Concat
		
	//echo "Final Bidderids :".$final_str=$final."".$str_final;
	$final_str=$final."".$str_final;
	//$request=$RequestID;
	if(strlen(trim($final_str))>0)
	{
	$pieces1 = explode(",", $final_str);

		for($l=0;$l<count($pieces1);$l++)
		{	
			
			$data = array("AllRequestID"=>$Request , "BidderID"=>$pieces1[$l], "Reply_Type"=>$mvarType);
			$table = 'Req_Feedback_Bidder1';
			$insert = Maininsertfunc ($table, $data);
		
			$dataUpdate = array('Last_allocation'=>'1');
			$wherecondition = "(BidderID=".$pieces1[$l].")";
			Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
		}
	}
			
	for($q=0;$q<count($arr3);$q++)
		{
			$dataUpdate = array('Last_set_select'=>'0');
			$wherecondition = "(BidderID=".$arr3[$q].")";
			Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
		}
	for($z=0;$z<count($alwaznt);$z++)
		{
			$dataUpdate = array('Last_set_select'=>'1');
			$wherecondition = "(BidderID=".$alwaznt[$z].")";
			Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
		}

//echo "cc".$Request;
		if($mvarType=="2")
	{
			$dataUpdate = array('Allocated'=>'1');
			$wherecondition = "(RequestID=".$Request.")";
			Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
	}
			if($mvarType=="1")
	{
			$dataUpdate = array('Allocated'=>'1');
			$wherecondition = "(RequestID=".$Request.")";
			Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
	}
			if($mvarType=="3")
	{
			$dataUpdate = array('Allocated'=>'1');
			$wherecondition = "(RequestID=".$Request.")";
			Mainupdatefunc ('Req_Loan_Car', $dataUpdate, $wherecondition);
	}
			if($mvarType=="5")
	{
			$dataUpdate = array('Allocated'=>'1');
			$wherecondition = "(RequestID=".$Request.")";
			Mainupdatefunc ('Req_Loan_Against_Property', $dataUpdate, $wherecondition);
	}
			if($mvarType=="4")
	{
			$dataUpdate = array('Allocated'=>'1');
			$wherecondition = "(RequestID=".$Request.")";
			Mainupdatefunc ('Req_Credit_Card', $dataUpdate, $wherecondition);
	}
			
}


main();

Function main()
{
    getRequestidpl();
	  getRequestidhl();
	  getRequestidcl();
	  getRequestidlap();
	  getRequestidcc();
	
}

?>
