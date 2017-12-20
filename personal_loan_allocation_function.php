<?php
define("_TOTAL","4");
	function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan'
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
 

function getBidders($strProduct,$strRequestID,$strCity)
{   
    $eligiblebidderarr=$strritebidder;
    $RequestID = $strRequestID;
    $mvarCity = $strCity;
//	echo $strProduct;
   $mvarType = getCodeValue("ReplyType_$strProduct");

   $qry = "SELECT * FROM Bidders_List WHERE Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1";
	  	list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
      		
		        //$Bidderid = $row[$fc]["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$fc]["Cap_MinDate"];
	
	$CapLead_Count = $row[$fc]["CapLead_Count"];
	$FBidderID = $row[$fc]["BidderID"];	
	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

   $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	list($daycount,$row_result_D)=MainselectfuncNew($CheckDateSql,$array = array());
	$DayCount = $row_result_D[0]['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($weekcount,$row_result_W)=MainselectfuncNew($CheckWeekSql,$array = array());
	$Total4Week = $row_result_W[0]['SumWeek'];
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($monthcount,$row_result_M)=MainselectfuncNew($CheckMonthSql,$array = array());
	$Total4Month = $row_result_M[0]['SumMonth'];
	
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	list($lifetimecount,$row_result_LT)=MainselectfuncNew($CheckLifeTimeSql,$array = array());
	$Total4LifeTime = $row_result_LT[0]['SumLifeTime'];
	
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
		//	echo "(if)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 1;
		}
		else
		{
		//	echo "(else)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
		//	echo "(if)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
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
			
			
			
		}
		
		
			//echo "<br>";
		if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
		{
			$Bidderid = $FBidderID;
			
		}
		else 
			$Bidderid = "Not Valid";
			
		$pos = strpos($query, "Req_Loan_Personal.Is_Valid");
		if ($pos === false) { // note: three equal signs
			// not found...
			$isValidBidder = "Not Found";
		}
		else {
			$isValidBidder = "Found";
		}	
			
			//echo "<br>////////////////////////////////////";
//echo "Valid Bidder after Cap Function : ".$Bidderid;
//echo "//////////////////////////<br>";		
		//End For Cap Function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 			
		$order = "Req_Loan_Personal.Is_Valid";
			
		$newquery = str_replace($order, "1", $query);
 
        $always = $row[$fc]["Always"];
        $conflict = $row[$fc]["Conflict_bidder"];
        $last_selection = $row[$fc]["Last_set_select"];
        $last_allocation = $row[$fc]["Last_allocation"];
        //$id1 = $id1."'".$conflict."',";
        //echo "ll".$query."<br>";
        $qry2 = $newquery." and ".$table.".RequestID ='".$RequestID."'";
		list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
        if($recordcount>0 && $Bidderid!="Not Valid" && $isValidBidder == "Found" ) //(result1)
        {
           		   
				  $GetBid[] = $Bidderid; 
				 $Customerid= $Bidderid;
				 
				 $strBidders =	$Customerid.", ".$strBidders;	
			
		      
        }//close if($recordcount>0)

    }//close while ($row = mysql_fetch_array($result))
//	echo  $strBidders;	
//	print_r($reyrieveBidderid);
	return $GetBid;

}//Function Close


function getBiddersListModule($strProduct,$strRequestID,$strCity,$strritebidder,$CountLeadSend) {   
  
  // echo $CountLeadSend;
   //echo "<br>";
    $CountDefined = 4 - $CountLeadSend;
    $eligiblebidderarr=$strritebidder;
    $RequestID = $strRequestID;
    $mvarCity = $strCity;
    $mvarType = getCodeValue("ReplyType_$strProduct");
	
	 $qry = "SELECT * FROM Bidders_List WHERE BidderID in (".$strritebidder.")";
		  	list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
      		
		        //$Bidderid = $row[$fc]["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$fc]["Cap_MinDate"];
	
	$CapLead_Count = $row[$fc]["CapLead_Count"];
	$FBidderID = $row[$fc]["BidderID"];	
	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	  $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	list($daycount,$row_result_D)=MainselectfuncNew($CheckDateSql,$array = array());
	$DayCount = $row_result_D[0]['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($weekcount,$row_result_W)=MainselectfuncNew($CheckWeekSql,$array = array());
	$Total4Week = $row_result_W[0]['SumWeek'];
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($monthcount,$row_result_M)=MainselectfuncNew($CheckMonthSql,$array = array());
	$Total4Month = $row_result_M[0]['SumMonth'];
	
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	list($lifetimecount,$row_result_LT)=MainselectfuncNew($CheckLifeTimeSql,$array = array());
	$Total4LifeTime = $row_result_LT[0]['SumLifeTime'];
	
		//Start Check for Day Cap Lead
		if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
		{
		//	echo "(if)DayCount : ".$DayCount." CapDay : ". $CapDay; echo "<br>";
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
			//	echo "(else)DayCount : ".$DayCount." CapDay : ". $CapDay;echo "<br>";
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
//exit();		
		//End For Cap Function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		 $query = $row["Query"];
        $table = $row["Table_Name"];
		
        $reyrieveBidderid[] = $Bidderid;
       
        $always = $row[$fc]["Always"];
        $conflict = $row[$fc]["Conflict_bidder"];
        $last_selection = $row[$fc]["Last_set_select"];
        $last_allocation = $row[$fc]["Last_allocation"];
        //$id1 = $id1."'".$conflict."',";
        //echo "ll".$query."<br>";
		
		$order = "Req_Loan_Personal.Is_Valid";
			
		$newquery = str_replace($order, "1", $query);
		
		
		
        $qry2 = $newquery." and ".$table.".RequestID ='".$RequestID."'";
      // echo "ff".$qry2;
     list($recordcount,$row1)=MainselectfuncNew($qry2,$array = array());
        if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
        {
          	for($kk=0;$kk<$recordcount;$kk++)
			{
               
                    $allBidders[$z] = $Bidderid;
                    $z=$z+1;
                
                $Request= $row1[$kk]["RequestID"];
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
                               
                                $arr2[count($arr2)]=$Bidderid.",".trim($conflict);


                                //print_r ($arr2);
                                //echo "Before conflict Check<br>";

                        }//close if($flag==1)

                        }//close if(count($arr2)>0)
                        else
                        {                       
                            $j=0;
                            $arr2[$j]=$Bidderid.",".trim($conflict);
                        }
                       
                    }//close if(strlen(trim($conflict))>0)

                    if((strlen(trim($conflict))<=0) && ($always != 1) )
                    {
                        $arr3[$k]=$Bidderid;
                        $k=$k+1;
                        //echo "bidderid:last".$Bidderid."<br>";
                      
                    }//close else if(strlen(trim($conflict))<=0)

                //}//close else if($always != 1)

            }//close while($row1[$kk]=mysql_fetch_array($result1))

        }//close if($recordcount>0)

    }//close while ($row = mysql_fetch_array($result))
/*
echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;arry allbidders:: ";
print_r ($allBidders);
echo "<br>First Array";

print_r ($arr1);
echo "<br>Second Array";

print_r ($arr2);

echo "<br>Third Array :: ";
print_r ($arr3); echo "<br>";	
*/



/////////////////////intersect code//////////////////////////////////////////////////////////////
/*for($z=0;$z<count($arr2);$z++)
{
   
    $arr2array = explode(",", $arr2[$z]);

    $splitarray = array_intersect($arr2array, $allBidders);
     print_r($splitarray);

     $arrq = $splitarray;
   // $stringarr2[] = implode(",", $splitarray);
  
 }

$arr2="";
$a = array_keys($arrq);
//echo "gfgdfd".count($a);
for($i=0;$i<count($a);$i++)
{
    $coun = $a[$i];
    $arr2 = $arrq[$coun].",";
}
echo "hello".$arr2."<br>";*/

///////////////////////////////////////////////////////////////////////////////////////////////////////////
for($z=0;$z<count($arr2);$z++)
{                   
    $splitarr = explode(",",$arr2[$z]);
    $splitarray = array_intersect($splitarr, $allBidders);
     $arrz = $splitarray;
     // echo "changes:::";
    // print_r($arrz);
    // echo "<br>";
     $arrz = $splitarray;
   // $stringarr2[] = implode(",", $splitarray);
  
   
    //$arrq="";
    $a = array_keys($arrz);
    //echo "gfgdfd".count($a);
    for($i=0;$i<count($a);$i++)
    {
        $coun = $a[$i];
        $arrq[] = $arrz[$coun];
    }
    //echo "changes applied::";
//    print($arrq);
//echo "ggggggggggggggggggggggggggg";

    //print_r ($splitarr);
    for($i=0;$i<count($arrq);$i++)
    {
        $sql = "select Last_allocation from Bidders_List where  BidderID=".$arrq[$i];
        list($numRows1,$fetchValue)=MainselectfuncNew($sql,$array = array());
	    $Last_allocation[] = $fetchValue[0]['Last_allocation'];
    }
   
    if (!in_array(1, $Last_allocation))
    {
         $sqlupdate = "update Bidders_List set Last_allocation=1 where BidderID=".$arrq[0];
        $queryupdate = mysql_query($sqlupdate);
		$dataUpdate = array('Last_allocation'=>'1');
		$wherecondition = "(BidderID=".$arrq[0].")";
		Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
    }

}



    $i=0;
    $z=0;
    $q=0;
    $ks=0;
    $bb=0;
    $str1=" ";
    $str2=" ";
    $str_final="";
   // echo "<BR>Line No 330:::";
   // print_r ($arr2);
    for($j=0;$j<count($arr2);$j++)
    {
        $pieces = explode(",", $arr2[$j]);

    //    echo "Changess::::::::::::::";
       
        $splitarray = array_intersect($pieces, $allBidders);
    
                 //print_r($splitarray);
             $arrz = $splitarray;
           // $stringarr2[] = implode(",", $splitarray);

            //$arrq="";
            $a = array_keys($arrz);
        //    print_r($a);
            //echo "gfgdfd".count($a);
            for($i=0;$i<count($a);$i++)
            {
                $coun = $a[$i];
                $arrq[] = $arrz[$coun];
            }
     //  echo "<BR>PIECES";
        //print_r ($pieces);
       
        for($l=0;$l<count($arrq);$l++)
        {                   
            $qry1="select * from Bidders_List where BidderID='".$arrq[$l]."'";
      		list($numRows11,$row)=MainselectfuncNew($qry1,$array = array());

			for($ii=0;$ii<$numRows11;$ii++)
            {
                $seq=$row[$ii]["Sequence_no"];
                $bidder = $row[$ii]["BidderID"];
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
   
    for($kk=0;$kk<count($arrt);$kk++)
    {
    //    echo "ets formed :".$arrt[$kk]."<br>";
    }
        $id="";
        $existflag = 0 ;
        for($kk=0;$kk<count($arrt);$kk++)
        {
            $qry2="select * from Bidders_List where BidderID='".$arrt[$kk]."'";
	        list($numRows12,$row)=MainselectfuncNew($qry2,$array = array());

			for($ii=0;$ii<$numRows12;$ii++)
			{
                $seq= $row[$ii]["Sequence_no"];
                $last= $row[$ii]["Last_allocation"];
                $bidder = $row[$ii]["BidderID"];
                //echo "last".$last."<br>";
           
                if($last=='1')
                {   
                    //echo "gg".$bidder."<br>";
                    $id=$id.$bidder.",";
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

                }//close if($last=='1')
                else
                {
                $seq_find = 0;
                }

            }//while
           
        }
       
        $arrr="";
        $arrt="";
        $z=0;
        $q=0;
        $bb=0;
        $ll=0;   
                           
}//END
   
for($j=0;$j<count($arr2);$j++)
{
	 $arr2[$j];
}

    for($z=0;$z<count($arr1);$z++)
    {
        $final= $final.$arr1[$z].",";
    }
    //Concat
   
    $final_str = $final.":::".$str_final;
    //echo "final bidder:".$final_str."<br>";
   
    $str_final1 = array_unique(explode(",", $str_final));

    //array used for the final set allocation
    //$concate_arrayarr4 = array_unique(array_merge($arr4, $str_final1));
    //$concate_array = array_unique(array_merge($arr3, $concate_arrayarr4));
    $concate_array = array_unique(array_merge($arr3, $str_final1));


    /*echo "<br>ConcateArray arr3:";
    print_r ($arr3);
    echo "ConcateArray str_final1:";
    print_r ($str_final1);
    echo "ConcateArray concate array:";
    print_r ($concate_array);
    echo "<BR>";*/
   
    $finalbiddercount = count($concate_array)-1;
    $arr1count = count($arr1);
        //echo "count".$finalbiddercount."<br>";
       // echo CountDefined."Compare".$arr1count;

        if($arr1count > $CountDefined)
        {
            //    echo "Hi inside if condition";
            //Constant CountDefined is defined at the top of this file
            //condition for bidders if always 1 greater than number of maximum bidders         
       
//echo "wribhu";
            $rand_keys = shuffle($arr1);

            //$rand_keys = array_rand($arr1, CountDefined);
            //print_r ($rand_keys);
            //echo count($rand_keys);
            //code changed
            //$final[] = $arr1[$rand_keys[$z]]
            for($z=0;$z<$CountDefined;$z++)
            {
                $a19 =$arr1[$z];
                $finalvalue[] = $a19;
            }
            $final = $finalvalue;
       //    print_r ($finalvalue);
           
        }
       
        else if($arr1count == $CountDefined)
        {
            //Constant CountDefined is defined at the top of this file
            //condition for bidders if always 1 equal to the number of maximum bidders    
               
            $final=$arr1;
        }
        else
        {
            //condition for bidders if always 1 less than the number of maximum bidders    
           
            $leftbidder = $CountDefined - count($arr1);
           
            if(($finalbiddercount < $leftbidder) || ($finalbiddercount == $leftbidder))
            {
                //echo "finalbiddercount".$finalbiddercount.":: counarr".count($arr1)."jay".$leftbidder."leftbidder";
                //echo "Hi in:::";
                //print_r ($concate_array);
                $final = array_merge($arr1, $concate_array);
           
            }
            else
            {
                $l=$i=$j=0;
                //echo "Hi out:::";

                //print_r ($concate_array);
                //For Sets add code
                for($l=0;$l<count($concate_array)-1;$l++)
                {
                     $qry ="select * from Bidders_List where  BidderID ='".$concate_array[$l]."'";
                    //echo "query::".$qry."<br>";
                     list($numRows13,$row)=MainselectfuncNew($qry,$array = array());
					for($ii=0;$ii<$numRows12;$ii++)
                    {
                        $last_set_select = $row[$ii]["Last_set_select"];
                        //$conflict_bidder = $row[$ii]["Conflict_bidder"];
                        $bidder = $row[$ii]["BidderID"];
                    }
                    if($last_set_select==0)
                    {
                        $arrbid[$i]=$bidder;
                        $i=$i+1;
                    //    echo "select".$bidder."<br>";
                    }
                    if($last_set_select==1)
                    {
                        $arrbidder[$j]=$bidder;
                         $j=$j+1;
                        // echo "last set:".$bidder."<br>";
                    }
                }
               
                $finalbid = count($arrbid);
                //echo "count of array last =1::".$finalbid."<br>";
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
                        //echo "condition::<br><br>";
                        //print_r($final);
                    }// close elseif($merge_array > $leftbidder)
                }// close elseif($finalbid < $leftbidder)
                elseif ($finalbid > $leftbidder)
                {
                    //echo "helloooooooooooooooooooooo"."'".$leftbidder."'"."<br>";
                    $val = $leftbidder;
                    $both = $arrbid;//will have to look while checking this condition while update for last_set_select
                   
                    //echo $val."<br>";
                    if($val==1)
                        $val=2;

                    $rand_keys = array_rand($arrbid, $val);
                   
                   
                    //echo "<br><br>";
                    //print_r(array_rand($arrbid, $val));
                    for($j=0;$j<=($leftbidder-1);$j++)
                    {
                       
                            $random_no[] = $arrbid[$rand_keys[$j]];
                           
                       
                    }
                    // print_r($random_no);
                   
                    $final = array_merge($arr1, $random_no);
                        //print_r($final);
                   
                   

                }//close elseif ($finalbid > $leftbidder)
                       
                //else {}
            }
                           
    }

                for($i=0;$i<=count($arrbidder);$i++)
                {
            		$DataArray = array("Last_set_select"=>'0');
					$wherecondition ="(BidderID=".$arrbidder[$i].")";
					Mainupdatefunc ('Bidders_List', $DataArray, $wherecondition);
                   
                    //echo "<br>".$qry11."<br>";
                   
                    $queryGetBidderID = "select Conflict_bidder from Bidders_List where  BidderID ='".$arrbidder[$i]."'";
					 list($numRows14,$fetchBidderID)=MainselectfuncNew($queryGetBidderID,$array = array());
                    $explodeBidderID = explode(",",$fetchBidderID[0]['Conflict_bidder']);
                    for($j=0;$j<=count($explodeBidderID);$j++)
                    {
                        $qry12 = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$explodeBidderID[$j]."'";
                        //echo "<br>".$qry12."<br>";
                         $DataArray = array("Last_set_select"=>'0');
						$wherecondition ="(BidderID=".$explodeBidderID[$j].")";
						Mainupdatefunc ('Bidders_List', $DataArray, $wherecondition);
                   
                    }
                   
                }

       
//Ended
//Condition for choosing the bidders
$count = count($final);
//echo "fgfdfgfd<br>";
//echo $CountDefined;
    $recordcountA ="";
       // print_r ($final);
        //for($l=0;$l<count($final);$l++)
        for($l=0;$l<$CountDefined;$l++)
        {   
            $toInsert = "select Restrict_Bidder from Bidders_List where  BidderID ='".$final[$l]."' and Reply_Type ='".$mvarType."'";
			list($numRows15,$toInsertBidderID)=MainselectfuncNew($toInsert,$array = array());
            if($toInsertBidderID[0]['Restrict_Bidder']==1)
            {   
           
                //Start Book Keeping Code 2008-01-04 18:29:09
                // Code Execution Start Time 2008-01-04 18:45:00   
                $BK_Year = date('Y');
                $BK_Month = date('m');
                $BK_Week = date('W');
                $BK_Day = date('d');
               
                $BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$final[$l]." and BookProduct=".$mvarType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
           		list($alreadyExist,$myrow)=MainselectfuncNew($BookKeepingSql, $array = array());
				$BookKeepingQuerycontr=count($BookKeepingQuery)-1;
					   
				$BookLeadCountExisting = @$BookKeepingQuery[$BookKeepingQuerycontr]['BookLeadCount'];
				$BookDate = @$BookKeepingQuery[$BookKeepingQuerycontr]['BookDate'];//added
				$BookMonth = @$BookKeepingQuery[$BookKeepingQuerycontr]['BookMonth'];//added
				$BookYear = @$BookKeepingQuery[$BookKeepingQuerycontr]['BookYear'];//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    $IncrementLeadCount = $BookLeadCountExisting + 1;
                    $Dated = ExactServerdate();
					$DataArray = array("BookLeadCount"=>$IncrementLeadCount, "BookEntryTime"=>$Dated );
					$wherecondition ="(BidderID = ".$final[$l]." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$mvarType.")";
					Mainupdatefunc ('Bidders_Book_Keeping', $DataArray, $wherecondition);
                 }
                 else
                 {
                     //Insert
                    $InitialCount = 1;
                 	$Dated = ExactServerdate();
					$dataArray = array('BidderID'=>$final[$l], 'BookProduct'=>$mvarType, 'BookDate'=>$BK_Day, 'BookWeek'=>$BK_Week, 'BookMonth'=>$BookMonth, 'BookYear'=>$BookYear, 'BookLeadCount'=>$InitialCount, 'BookEntryTime'=>$Dated);
					//echo "<br>".$InsertBKSql."<br>";
					$insert = Maininsertfunc ("Bidders_Book_Keeping", $dataArray);

                 }
                 //End Book Keeping Code
                //Allocated =1 for lead been write in from manual process where is_Valid is re-writed       
                $Dated = ExactServerdate();
				$dataInsert = array('AllRequestID'=>$Request,'BidderID'=>$final[$l], 'Reply_Type'=>$mvarType, 'Allocation_Date'=>$Dated, 'Allocated'=>'1');
				$resultA = Maininsertfunc ("Req_Feedback_Bidder1", $dataInsert);
                $recordcount = mysql_num_rows($resultA);
                $recordcountA[] = $recordcount;
             //  echo "<br>Final Insert Query:::".$queryA."<br>";
               
				$dataUpdate = array('Last_allocation' => '1', 'Last_set_select' => '1');
				$wherecondition = "(BidderID = '".$final[$l]."')";
				Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
               
				$getConflictBidderSql =  "select Conflict_Bidder from Bidders_List where  BidderID ='".$final[$l]."'";
               				list($alreadyExist,$getConflictBidderFetch)=MainselectfuncNew($getConflictBidderSql, $array = array());
               
                $getConflictBidder = $getConflictBidderFetch[0]['Conflict_Bidder'];
               
                $arrayConflictBidder = explode(",",$getConflictBidder);
                //echo "count".count($arrayConflictBidder);
               
                for($i=0;$i<count($arrayConflictBidder);$i++)
                {
					$dataUpdate = array('Last_allocation' => '0', 'Last_set_select' => '1');
					$wherecondition = "(BidderID = '".$arrayConflictBidder[$i]."')";
					Mainupdatefunc ('Bidders_List', $dataUpdate, $wherecondition);
                }
            }
        }
       
        $record = count($recordcountA);
   
    if($mvarType=="1")
    {
		$FinalRecord = $CountLeadSend + $record;        
		$dataUpdate = array('Allocated' => '1', 'Is_Valid' => '1', 'Bidder_Count'=>$FinalRecord);
		$wherecondition = "(RequestID = '".$Request."')";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
    }
//  exit();

           
}


?>
