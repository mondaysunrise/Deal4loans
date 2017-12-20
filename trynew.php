<?php
//This file is not required
define("_TOTAL","4");//number of maximum bidders

require 'scripts/db_init.php';
require 'scripts/functions.php';

  function getforsms($pKey){
    $titles = array(
        'Req_Loan_Personal' => 'pl',
        'Req_Loan_Home' => 'hl',
        'Req_Loan_Car' => 'cl',
        'Req_Credit_Card' => 'cc',
        'Req_Loan_Against_Property' => 'lap',
        'Req_Business_Loan' => 'bl'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

	
	
	function getReqValue($pKey){
    $titles = array(
        'Req_Loan_Personal' => 'personal',
        'Req_Loan_Home' => 'home',
        'Req_Loan_Car' => 'car',
        'Req_Credit_Card' => 'cc',
        'Req_Loan_Against_Property' => 'property',
        'Req_Business_Loan' => 'business'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

 function getReqnumval($pKey){
    $titles = array(
       '1' => 'Req_Loan_Personal', 
       '2' =>'Req_Loan_Home', 
       '3' => 'Req_Loan_Car',
       '4' => 'Req_Credit_Card', 
       '5' => 'Req_Loan_Against_Property',
       '6' => 'Req_Business_Loan', 
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function getRequestidpl()
{
	 //$search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Personal where (Allocated=2) ";
   //$search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Personal where (RequestID in ('111172','110168','110784','110560','111172')) ";
     $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Personal where (Allocated =2  and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 1 DAY)))  ";
	 //  $search_11query="Select * from Req_Loan_Personal";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        $Bidderid_details= $row["Bidderid_Details"];
        if(($row["City"]=="Others") && (strlen($row["City_Other"])>0))
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Loan_Personal"),$Customerid,$City,$Bidderid_details);       

    }
}

function getRequestidhl()
{
    $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Home where (Allocated=2 and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 1 DAY))) ";
    // $search_query="Select * from Req_Loan_Home where Allocated=0";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        $Bidderid_details= $row["Bidderid_Details"];
        if(($row["City"]=="Others") && (strlen($row["City_Other"])>0))
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }
        //$Other_City= $row["City_Other"];
        getBiddersList(getReqValue("Req_Loan_Home"),$Customerid,$City,$Bidderid_details);       
    }
}

function getRequestidcl()
{
   
    $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Car where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY))";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        $Bidderid_details= $row["Bidderid_Details"];
        if(($row["City"]=="Others") && (strlen($row["City_Other"])>0))
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Loan_Car"),$Customerid,$City,$Bidderid_details);       

    }
}

function getRequestidlap()
{
    $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Against_Property where (Allocated =2  and ( Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 1 DAY))) ";
   // $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Loan_Against_Property where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY)) ";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        $Bidderid_details= $row["Bidderid_Details"];
        if(($row["City"]=="Others") && (strlen($row["City_Other"])>0))
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Loan_Against_Property"),$Customerid,$City,$Bidderid_details);       

    }
}

function getRequestidcc()
{
   // $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Credit_Card where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY)) ";
   $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Credit_Card where (Allocated =2  and ( Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 1 DAY))) ";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        $Bidderid_details= $row["Bidderid_Details"];
       if(($row["City"]=="Others") && (strlen($row["City_Other"])>0))
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }
        getBiddersList(getReqValue("Req_Credit_Card"),$Customerid,$City,$Bidderid_details);       

    }
}

function getRequestidbl()
{
   
     $search_query="Select RequestID,Bidderid_Details,City,City_Other from Req_Business_Loan where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY))  ";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        $Bidderid_details= $row["Bidderid_Details"];
        if(($row["City"]=="Others") && (strlen($row["City_Other"])>0))
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Business_Loan"),$Customerid,$City,$Bidderid_details);       

    }
}

function getBiddersList($strProduct,$strRequestID,$strCity,$strritebidder)
{   
    $eligiblebidderarr=$strritebidder;
    $RequestID = $strRequestID;
    $mvarCity = $strCity;
    $mvarType = getCodeValue("ReplyType_$strProduct");
	if($mvarType==2 || $mvarType==1 || $mvarType==4 || $mvarType==5)
	{
	 $qry = "SELECT * FROM Bidders_List WHERE BidderID in (".$strritebidder.") and Reply_Type='".$mvarType."' and  Restrict_Bidder=1";
	}
	else
	{
    $qry = "SELECT * FROM Bidders_List WHERE Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1";
	}
    $result = ExecQuery($qry);
    $firstcount = mysql_num_rows($result);
    echo "<br>Query I::".$qry."<br>";
    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;

   
    while ($row = mysql_fetch_array($result))
    {
        $query = $row["Query"];
        $table = $row["Table_Name"];
      		
		        //$Bidderid = $row["BidderID"];
		echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row["Cap_MinDate"];
	
	$CapLead_Count = $row["CapLead_Count"];
	$FBidderID = $row["BidderID"];	
	//echo "BidderID : ".$FBidderID."<br>";
	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	 $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	$CheckDateQuery = ExecQuery($CheckDateSql);
	$row_result_D=@mysql_fetch_array($CheckDateQuery);
	$DayCount = $row_result_D['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	$CheckWeekQuery = ExecQuery($CheckWeekSql);
	$row_result_W=@mysql_fetch_array($CheckWeekQuery);
	$Total4Week = $row_result_W['SumWeek'];
	//echo "Total4Week : ".$Total4Week;
//	echo "<br>";
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	$CheckMonthQuery = ExecQuery($CheckMonthSql);
	$row_result_M=@mysql_fetch_array($CheckMonthQuery);
	$Total4Month = $row_result_M['SumMonth'];
	//echo "Total4Month : ".$Total4Month;
	//echo "<br>";
	
	
	//$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."' and BookEntryTime > '".$Cap_MinDate."'";
	//Changed on 27-02-08 as per discussion with wribhu sir
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	
	$CheckLifeTimeQuery = ExecQuery($CheckLifeTimeSql);
	$row_result_LT=@mysql_fetch_array($CheckLifeTimeQuery);
	$Total4LifeTime = $row_result_LT['SumLifeTime'];
//	echo "Total4SumLifeTime : ".$Total4LifeTime;
//	echo "<br>";
	
		//Start Check for Day Cap Lead
		if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
		{
			//echo "(if)DayCount : ".$DayCount." CapDay : ". $CapDay; echo "<br>";
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
				//echo "(else)DayCount : ".$DayCount." CapDay : ". $CapDay;echo "<br>";
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			//echo "(if)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 1;
		}
		else
		{
			//echo "(else)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			//echo "(if)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 1;
		}
		else
		{
			//echo "(else)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			//echo "(if)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 1;
		}
		else
		{
			//echo "(else)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 0;
		}
		//End Check for LifeTime Cap Lead
		
		if($ValidBidder_Day!=1 || $ValidBidder_Week!=1 || $ValidBidder_Month!=1 || $ValidBidder_LT!=1)
		{
			$message = "BidderID : ".$FBidderID;
			$message .= "\nDayCount : ".$DayCount." CapDay : ". $CapDay."\n";
			$message .= "Total4Week : ".$Total4Week." CapWeek : ". $CapWeek."\n";
			$message .= "Total4Month : ".$Total4Month." CapMonth : ". $CapMonth."\n";
			$message .= "Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime."\n";
			
			//mail("", "Cap Function Testing", $message);
			
		}
		
		
			//echo "<br>";
		if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
		{
			$Bidderid = $FBidderID;
		}
		else 
			 $Bidderid = "Not Valid";
			
			
			
			//echo "<br>////////////////////////////////////";
//echo "Valid Bidder after Cap Function : ".$Bidderid;
//echo "//////////////////////////<br>";		
		//End For Cap Function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		
		
        $reyrieveBidderid[] = $Bidderid;
       
        $always = $row["Always"];
        $conflict = $row["Conflict_bidder"];
        $last_selection = $row["Last_set_select"];
        $last_allocation = $row["Last_allocation"];
       
        $qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
        //echo "ff".$qry2;
        $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
        if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
        {
           
            while($row1=mysql_fetch_array($result1))
            {
               
                    $allBidders[$z] = $Bidderid;
                    $z=$z+1;
                
                $Request= $row1["RequestID"];
                //echo "RequestID::".$Request."<br>";
           
               
               
               // echo "eligible bidders::".$allBidders;
                if($always == 1)
                {
                    $arr1[$i]  = $Bidderid; //forms an array for bidders Always ==1
                    $i=$i+1;
                   
                   
                }//close if($always == 1)
                //if($always != 1)
                //{
                                   
                    if((strlen(trim($conflict))>0) && ($always!=1) )
                    {
                        $alwaznt[$z] =$Bidderid; //forms an array for bidders Always ==1
                        $z=$z+1;
                       
                         if(count($arr2)>0)
                         {
                                               
                            $flag=0;
                            $l=0;
                            while($l<count($arr2))
                            {
                                if(strlen(strpos($arr2[$l],$Bidderid)) > 0 )
                                {
                                    $flag=0;
                                    break;    //break while loop   
                                }
                                else
                                {
                                    $flag=1;
                                }
                               
                                $l++;
                            }//close while($l<count($arr2))
                           
                           
                            if($flag==1)
                            {
                               if($Bidderid>0)
								{
									$arr2[count($arr2)]=$Bidderid.",".trim($conflict);
								}	

                                //print_r ($arr2);
                                //echo "Before conflict Check<br>";

                        }//close if($flag==1)

                        }//close if(count($arr2)>0)
                        else
                        {                       
                            $j=0;
							if($Bidderid>0)
							{
								$arr2[$j]=$Bidderid.",".trim($conflict);
							}
                           

                            }
                       
                    }//close if(strlen(trim($conflict))>0)

                    if((strlen(trim($conflict))<=0) && ($always != 1) )
                    {
                        $arr3[$k]=$Bidderid;
                        $k=$k+1;
                        //echo "bidderid:last".$Bidderid."<br>";
                      
                    }//close else if(strlen(trim($conflict))<=0)

                //}//close else if($always != 1)

            }//close while($row1=mysql_fetch_array($result1))

        }//close if($recordcount>0)

    }//close while ($row = mysql_fetch_array($result))

echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;arry allbidders:: ";
//total eligible and clicked bidder

print_r ($allBidders);
echo "<br>First Array";
//total alwaz =1 bidder
print_r ($arr1);
echo "<br>Second Array";
//total Conflicting bidder
print_r ($arr2);
//total No condition bidder
echo "<br>Third Array :: ";
print_r ($arr3); echo "<br>";
echo "<br>";

echo "count of conflictting::".count($arr2);



    $i=0;
    $z=0;
    $q=0;
    $ks=0;
    $bb=0;
    $str1=" ";
    $str2=" ";
    $str_final="";
	$arrr= "";
	$arrt="";
	$arrq = "";
	$newlast="";
       

	// working on cinflicting bidder its individual element
 

 for($j=0;$j<count($arr2);$j++)
    {
		echo "count of counter::".$j."<br>";
		echo "count of conflictting::".count($arr2)."<br>";
        $pieces = explode(",", $arr2[$j]);
	
        $splitarray = array_intersect($pieces, $allBidders);
   
             $arrz = $splitarray;
          
            $a = array_keys($arrz);
        
            for($i=0;$i<count($a);$i++)
            {
                $coun = $a[$i];
                $arrq[] = $arrz[$coun];
            }
    
       
		//$arrq = array_unique($arrq);
           //total mapping bidderID with sequence no:
        for($l=0;$l<count($arrq);$l++)
        {                   
            $qry1="select Sequence_no,BidderID from Bidders_List where BidderID='".$arrq[$l]."' and Reply_Type=".$mvarType;
            $result1 = ExecQuery($qry1);
           
            while($row = mysql_fetch_array($result1))
            {
                $seq=$row["Sequence_no"];
                $bidder = $row["BidderID"];
				
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
                 
               } //i > j close  if($varI > $varJ)
            } //j close for($p=$i;$p<Count($arrr);$p++)
        } //i close for($i=0;$i<Count($arrr);$i++)
 
    for($q=0;$q<count($arrt);$q++)
        {
            $qry2="select Sequence_no,Last_allocation,BidderID from Bidders_List where BidderID='".$arrt[$q]."' and Reply_Type=".$mvarType;
            $result2 = ExecQuery($qry2);
			//echo "ss".$qry2;
            while($row = mysql_fetch_array($result2))
            {
                $last= $row["Last_allocation"];
				$newlast[]=$last;
			}
		}
        $id="";
        $existflag = 0 ;
		$lastarray="";
echo "<br>sequence array::";
		print_r($arrr);
		echo "<br>array of ids::";
		print_r($arrt);
		
//trying to handle set of bidders Last allocation is zero
echo "<br>last allocation check::";
print_r($newlast);
$lastarray=@array_search(1,$newlast);
		echo "lastarray::".$lastarray."<br>";
		if((strlen($lastarray)>0) || ($lastarray>0)) {
		
$checkforposition=((count($newlast))- $lastarray);
echo "count of last array".count($newlast)."<br>";
echo "check position::".$checkforposition;
if($checkforposition>1)
			{
					$pos=$lastarray+1;
				$str_final=$str_final.$arrt[$pos].",";
					echo "one clause::".$str_final."<br>";
                   // break;
}
else
			{
				$pos=0;
				$str_final=$str_final.$arrt[$pos].",";
					echo "experiment string::".$str_final."<br>";
                    //break;
			}
		

       $arrr= "";
        $arrt="";
		$arrq = "";
		$newlast="";
       
        $z=0;
        $q=0;
        $bb=0;
        $ll=0;   

		}
		else
		{

			
				$pos=0;
				$str_final=$str_final.$arrt[$pos].",";
					echo "zero clausestring::".$str_final."<br>";
                   
		$arrr= "";
        $arrt="";
		$arrq = "";
		$newlast="";
       
        $z=0;
        $q=0;
        $bb=0;
        $ll=0;   
		
		}//END
		

		//echo "ENDcount of counter::".$j."<br>";
		//echo "ENDcount of conflictting::".count($arr2)."<br>";
			}
			
			
 //END of working for conflicting bidders
        

 echo "count of conflictting::".count($arr2);



    for($z=0;$z<count($arr1);$z++)
    {
        $final= $final.$arr1[$z].",";
    }
    //Concat
   
    $final_str = $final.":::".$str_final;
   
   
    $str_final1 = array_unique(explode(",", $str_final));

    //array used for the final set allocation
    
    $concate_array = array_unique(array_merge($arr3, $str_final1));

    $finalbiddercount = count($concate_array)-1;
    $arr1count = count($arr1);
      

        if($arr1count > _TOTAL)
        {
            //    echo "Hi inside if condition";
            //Constant _TOTAL is defined at the top of this file
            //condition for bidders if always 1 greater than number of maximum bidders         
       

            $rand_keys = shuffle($arr1);

            
            for($z=0;$z<_TOTAL;$z++)
            {
                $a19 =$arr1[$z];
                $finalvalue[] = $a19;
            }
            $final = $finalvalue;
           // print_r ($finalvalue);
           
        }
       
        else if($arr1count == _TOTAL)
        {
            //Constant _TOTAL is defined at the top of this file
            //condition for bidders if always 1 equal to the number of maximum bidders    
               
            $final=$arr1;
        }
        else
        {
            //condition for bidders if always 1 less than the number of maximum bidders    
           
            $leftbidder = _TOTAL - count($arr1);
           
            if(($finalbiddercount < $leftbidder) || ($finalbiddercount == $leftbidder))
            {
                
                $final = array_merge($arr1, $concate_array);
           
            }
            else
            {
                $l=$i=$j=0;
                
                //For Sets add code
                for($l=0;$l<count($concate_array)-1;$l++)
                {
                     $qry ="select Last_set_select,BidderID from Bidders_List where  BidderID ='".$concate_array[$l]."' and Reply_Type=".$mvarType;
                    //echo "query::".$qry."<br>";
                    $result = ExecQuery($qry);
                   
                    while($row = mysql_fetch_array($result))
                    {
                        $last_set_select = $row["Last_set_select"];
                        //$conflict_bidder = $row["Conflict_bidder"];
                        $bidder = $row["BidderID"];
                    }
                    if($last_set_select==0)
                    {
                        $arrbid[$i]=$bidder;
                        $i=$i+1;
                    
                    }
                    if($last_set_select==1)
                    {
                        $arrbidder[$j]=$bidder;
                         $j=$j+1;
                        // echo "last set:".$bidder."<br>";
                    }
                }
               
                $finalbid = count($arrbid);
               
                if($finalbid == $leftbidder)
                {
                    $final = array_merge($arr1, $arrbid);

                }//close if($finalbid == $leftbidder)
                elseif($finalbid < $leftbidder)
                {
                   
                   $both = array_merge($arrbid, $arrbidder);
                    $merge_array = count($both);
                    if(($merge_array == $leftbidder) && ($merge_array < $leftbidder))
                    {
                        $final = array_merge($arr1, $both);
                    }
                    elseif($merge_array > $leftbidder)
                    {
                        $val = $leftbidder;
                        //echo $val."<br>";
                        if($val==1)
                            $val=2;
                        $rand_keys = array_rand($both, $val);
                       
                        for($j=0;$j<=($leftbidder-1);$j++)
                        {
                           
                                $random_no[] = $both[$rand_keys[$j]];
                               
                           
                        }
           
                        $final = array_merge($arr1, $random_no);
                        
                    }// close elseif($merge_array > $leftbidder)
                }// close elseif($finalbid < $leftbidder)
                elseif ($finalbid > $leftbidder)
                {
                   
                    $val = $leftbidder;
                    $both = $arrbid;//will have to look while checking this condition while update for last_set_select
                   
                    //echo $val."<br>";
                    if($val==1)
                        $val=2;

                    $rand_keys = array_rand($arrbid, $val);
                   
                   
                    
                    for($j=0;$j<=($leftbidder-1);$j++)
                    {
                       
                            $random_no[] = $arrbid[$rand_keys[$j]];
                           
                       
                    }
                    
                   
                    $final = array_merge($arr1, $random_no);

                   
                   

                }//close elseif ($finalbid > $leftbidder)
                       
                //else {}
            }
                           
    }

                for($i=0;$i<=count($arrbidder);$i++)
                {
                   
                    $qry11 = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$arrbidder[$i]."' and Reply_Type=".$mvarType;
                    ExecQuery($qry11);
                   
                    //echo "<br>".$qry11."<br>";
                   
                    $queryGetBidderID = ExecQuery("select Conflict_bidder from Bidders_List where  BidderID ='".$arrbidder[$i]."' and Reply_Type='".$mvarType);
                    $fetchBidderID = @mysql_fetch_array($queryGetBidderID);

                    $explodeBidderID = explode(",",$fetchBidderID[0]);
                    for($j=0;$j<=count($explodeBidderID);$j++)
                    {
                        $qry12 = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$explodeBidderID[$j]."' and Reply_Type=".$mvarType;
                        //echo "<br>".$qry12."<br>";
                          ExecQuery($qry12);
                   
                    }
                   
                }

       
//Ended
echo "count of conflictting::".count($arr2);
//Condition for choosing the bidders
$count = count($final);
    $recordcountA ="";
	
        //for($l=0;$l<count($final);$l++)
        for($l=0;$l<_TOTAL;$l++)
        {   
            $toInsert = ExecQuery("select Restrict_Bidder from Bidders_List where  BidderID ='".$final[$l]."' and Reply_Type ='".$mvarType."'");
            $toInsertBidderID = mysql_fetch_array($toInsert);   
            if($toInsertBidderID[0]==1)
            {   
           
                //Start Book Keeping Code 2008-01-04 18:29:09
                // Code Execution Start Time 2008-01-04 18:45:00   
                $BK_Year = date('Y');
                $BK_Month = date('m');
                $BK_Week = date('W');
                $BK_Day = date('d');
               
                $BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$final[$l]." and BookProduct=".$mvarType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
                $BookKeepingQuery = ExecQuery($BookKeepingSql);
               
                $BookLeadCountExisting = @mysql_result($BookKeepingQuery,0,'BookLeadCount');
                $BookDate = @mysql_result($BookKeepingQuery,0,'BookDate');//added
                $BookMonth = @mysql_result($BookKeepingQuery,0,'BookMonth');//added
                $BookYear = @mysql_result($BookKeepingQuery,0,'BookYear');//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    $IncrementLeadCount = $BookLeadCountExisting + 1;
                    $UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$IncrementLeadCount.", BookEntryTime = Now()  where BidderID = ".$final[$l]." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$mvarType."";
                    ExecQuery($UpdateBKSql);
                 }
                 else
                 {
                     //Insert
                    $InitialCount = 1;
                    $InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$final[$l].", ".$mvarType.", ".$BK_Day.",".$BK_Week.", ".$BK_Month.", ".$BK_Year.", ".$InitialCount.",Now())";
                    ExecQuery($InsertBKSql);
                 }
                 //End Book Keeping Code
                       
                $queryA="Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$Request', '$final[$l]','$mvarType', Now())";
                $resultA = ExecQuery($queryA);
                $recordcount = @mysql_num_rows($resultA);
                $recordcountA[] = $recordcount;
                echo "<br>Final Insert Query:::".$queryA."<br>";
               
                $qry9 = "UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '".$final[$l]."' and Reply_Type=".$mvarType;
                //echo $qry9."<br>";
                ExecQuery($qry9);
                $getConflictBidderSql = ExecQuery("select Conflict_Bidder from Bidders_List where  BidderID ='".$final[$l]."' and Reply_Type=".$mvarType);
                $getConflictBidderFetch = mysql_fetch_array($getConflictBidderSql);   
               
                $getConflictBidder = $getConflictBidderFetch[0];
               
                $arrayConflictBidder = explode(",",$getConflictBidder);
                
               
                for($i=0;$i<count($arrayConflictBidder);$i++)
                {
                    $qry10 = "UPDATE `Bidders_List` SET `Last_allocation` = '0', `Last_set_select` = '1' WHERE `BidderID` = '".$arrayConflictBidder[$i]."' and Reply_Type=".$mvarType;
                    //echo $qry10."<br>";
                      ExecQuery($qry10);
                }

//if($final[$l]=="873")
				//{
	$bidderquery="Select * from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$mvarType." and BidderID=".$final[$l];
	echo "query1".$bidderquery."<br>";
	$getbidderresult=ExecQuery($bidderquery);
	$Bidderrecorcount = mysql_num_rows($getbidderresult);
	if($Bidderrecorcount>0)
	{
		$ShowDate = date("H:i:s");
		$StartTime = "09:00:00";
		$EndTime = "18:30:00";	

		for($i=0;$i<$Bidderrecorcount;$i++)
		{
			 $Reply_Type = mysql_result($getbidderresult,$i,'Reply_Type');
			 $Bank_Name = mysql_result($getbidderresult,$i,'Bank_Name');
			 $BidderID = mysql_result($getbidderresult,$i,'BidderID');
			 $RequestID = mysql_result($getbidderresult,$i,'RequestID');
			 $Start_Date = mysql_result($getbidderresult,$i,'Start_Date');
			 $Mobile_no = mysql_result($getbidderresult,$i,'Mobile_no');
			 	
			if($ShowDate > $StartTime && $ShowDate < $EndTime)			
			{
				getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no);
			}
		}
	}//if($Bidderrecorcount>0)
				//}
               
    }
           
        }
       
        $record = count($recordcountA);
    if($mvarType=="2")
    {
            $qry10="update Req_Loan_Home set Allocated='1', Bidder_Count='$record' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="1")
    {
            $qry10="update Req_Loan_Personal set Allocated='1', Bidder_Count='$record' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="3")
    {
            $qry10="update Req_Loan_Car set Allocated='1', Bidder_Count='$record' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="5")
    {
            $qry10="update Req_Loan_Against_Property set Allocated='1', Bidder_Count='$record' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="4")
    {
            $qry10="update Req_Credit_Card set Allocated='1', Bidder_Count='$record' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="6")
    {
            $qry10="update Req_Business_Loan set Allocated='1', Bidder_Count='$record' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }

			
		
           
}


function getleadbysms($strreply_type,$strbank_name,$strbidderid,$requestid,$strstart_date,$strmobile_no)
{
	
	$reply_type=getReqnumval($strreply_type);
	$getforsms=getforsms($reply_type);
	
	 $SMSMessage="";
	 $ctr=1;
	if((strlen(trim($requestid))<=0))
	{
	
		$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.Feedback_ID>'$requestid' and Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
	}
	//echo "query2::".$search_query."<br>";
	$result = ExecQuery($search_query);
	$recorcount = mysql_num_rows($result);

	 $currentdate=date('d-m-Y');
	$message ="Leads for ".$getforsms." as on (".$currentdate.")  :";

	
if ($myrow = mysql_fetch_array($result))
	{
	$SMSMessage="";
			
		do
		{
			//$SMSMessage="";
			$request=trim($myrow["Feedback_ID"]);
			$Name=trim($myrow["Name"]);
			$Phone=trim($myrow["Mobile_Number"]);

			$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone;
			echo $SMSMessage;
			$ctr=$ctr+1;
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
	}
	//$mobile_no="9811215138";
	if(strlen(trim($SMSMessage))>0)
	{
		if(strlen(trim($strmobile_no)) > 0)
		 SendSMS($message.$SMSMessage, $strmobile_no);
		//if(strlen(trim($mobile_no)) > 0)
		//SendSMS($message.$SMSMessage, $mobile_no);

	}
	
	if(($recorcount)>0)
	{
 ExecQuery("update Req_Compaign set RequestID='$request' where Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid );
// echo "update Req_Compaign set RequestID='$request' where Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid."";
	}

}

function captureTimeDuration($getstarttime)
{
	$getendtime=date("H:i:s");
	
	$message = "Cron Start Time : ".$getstarttime;
	$message .= " Cron End Time : ".$getendtime."\n";
	//echo "<br>captureTimeDuration( ".$message." )<br>";		
	//mail($to, "Cap Function Testing", $message);
}


main();

Function main()
{
	$getstarttime=date("H:i:s");
   // getRequestidpl();
    getRequestidhl();
    //getRequestidcl();
   // getRequestidlap();
    getRequestidcc();
   // getRequestidbl();
	//captureTimeDuration($getstarttime);
   
}

?>