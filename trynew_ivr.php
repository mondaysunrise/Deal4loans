<?php
define("_TOTAL","4");//number of maximum bidders

function getBiddersList($strProduct,$strRequestID,$strCity,$CustomerMobile)
{   
     $Dated = ExactServerdate();
	$eligiblebidderarr=$strritebidder;
    $RequestID = $strRequestID;
    $mvarCity = $strCity;
	$mvarType = $strProduct;
	$qry = "SELECT * FROM Bidders_List_ivr WHERE Reply_Type='".$strProduct."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1";
   list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
  
    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;
   if($firstcount>0)
   {
		while($cntr<count($row))
		{
        $query = $row[$cntr]["Query"];
        $table = $row[$cntr]["Table_Name"];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$cntr]["Cap_MinDate"];
	$CapLead_Count = $row[$cntr]["CapLead_Count"];
	$FBidderID = $row[$cntr]["BidderID"];	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	$CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping_ivr where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."' and BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	 list($recordcount,$row_result_D)=MainselectfuncNew($CheckDateSql,$array = array());
		$d=0;
	
	$DayCount = $row_result_D[$d]['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping_ivr where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	 list($recordcount,$row_result_W)=MainselectfuncNew($CheckWeekSql,$array = array());
		$w=0;
	
	$Total4Week = $row_result_W[$w]['SumWeek'];
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping_ivr where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	
	list($recordcount,$row_result_M)=MainselectfuncNew($CheckMonthSql,$array = array());
		$m=0;
	
	$Total4Month = $row_result_M[$m]['SumMonth'];
	
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping_ivr where BidderID = ".$FBidderID." and BookProduct='".$mvarType."' and BookEntryTime > '".$Cap_MinDate."'";
	list($recordcount,$row_result_LT)=MainselectfuncNew($CheckLifeTimeSql,$array = array());
		$lt=0;
	
	$Total4LifeTime = $row_result_LT[$lt]['SumLifeTime'];
	
		//Start Check for Day Cap Lead
		if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
		{
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			$ValidBidder_Week = 1;
		}
		else
		{
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			$ValidBidder_Month = 1;
		}
		else
		{
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			$ValidBidder_LT = 1;
		}
		else
		{
			$ValidBidder_LT = 0;
		}
		//End Check for LifeTime Cap Lead
		if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
		{
			$Bidderid = $FBidderID;
		}
		else 
			$Bidderid = "Not Valid";
			
//End For Cap Function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $always = $row["Always"];
        $conflict = $row["Conflict_bidder"];
        $last_selection = $row["Last_set_select"];
        $last_allocation = $row["Last_allocation"];

        $qry2 = $query." and (".$table.".RequestID ='".$RequestID."')";
 /* echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;arry allbidders:: ";
print_r ($allBidders);
echo "<br>First Array";
print_r ($arr1);
echo "<br>Second Array";
print_r ($arr2);
echo "<br>Third Array :: ";
print_r ($arr3); echo "<br>";*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
for($z=0;$z<count($arr2);$z++)
{                   
    $splitarr = explode(",",$arr2[$z]);
    $splitarray = array_intersect($splitarr, $allBidders);
     $arrz = $splitarray;
     $arrz = $splitarray;
    $a = array_keys($arrz);
    for($i=0;$i<count($a);$i++)
    {
        $coun = $a[$i];
        $arrq[] = $arrz[$coun];
    }
    for($i=0;$i<count($arrq);$i++)
    {
        $sql = "select Last_allocation from Bidders_List_ivr where  BidderID=".$arrq[$i];
        list($recordcount,$fetchValue)=MainselectfuncNew($sql,$array = array());
		$s=0;
	   
        $Last_allocation[] = $fetchValue[$s][0];
    }
    if (!in_array(1, $Last_allocation))
    {
        
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
    for($j=0;$j<count($arr2);$j++)
    {
        $pieces = explode(",", $arr2[$j]);
        $splitarray = array_intersect($pieces, $allBidders);
             $arrz = $splitarray;
            $a = array_keys($arrz);
            for($i=0;$i<count($a);$i++)
            {
                $coun = $a[$i];
                $arrq[] = $arrz[$coun];
            }
        for($l=0;$l<count($arrq);$l++)
        {                   
            $qry1="select * from Bidders_List_ivr where BidderID='".$arrq[$l]."'";
			list($recordcount,$row)=MainselectfuncNew($qry1,$array = array());
			$n=0;
		   

            while($n<count($row))
       		 {
                $seq=$row[$n]["Sequence_no"];
                $bidder = $row[$n]["BidderID"];
                $arrr[$z] = $seq;
                $z= $z+1;
                $arrt[$q] = $bidder;
                $q=$q+1;
           	 $n = $n+1;
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
            $qry2="select * from Bidders_List_ivr where BidderID='".$arrt[$kk]."'";
         
		  list($recordcount,$row)=MainselectfuncNew($qry2,$array = array());
			$x=0;
           while($x<count($row))
        {
                $seq= $row[$x]["Sequence_no"];
                $last= $row[$x]["Last_allocation"];
                $bidder = $row[$x]["BidderID"];
                if($last=='1')
                {   
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
           $x=$x+1;}//while
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
 //   echo "unique sets formed :".$arr2[$j]."<br>";
}

    for($z=0;$z<count($arr1);$z++)
    {
        $final= $final.$arr1[$z].",";
    }
    //Concat
    $final_str = $final.":::".$str_final;
    $str_final1 = array_unique(explode(",", $str_final));

    //array used for the final set allocation
    //$concate_arrayarr4 = array_unique(array_merge($arr4, $str_final1));
    //$concate_array = array_unique(array_merge($arr3, $concate_arrayarr4));
    $concate_array = array_unique(array_merge($arr3, $str_final1));

    $finalbiddercount = count($concate_array)-1;
    $arr1count = count($arr1);

        if($arr1count > _TOTAL)
        {
            //Constant _TOTAL is defined at the top of this file
            //condition for bidders if always 1 greater than number of maximum bidders         

            $rand_keys = shuffle($arr1);

            for($z=0;$z<_TOTAL;$z++)
            {
                $a19 =$arr1[$z];
                $finalvalue[] = $a19;
            }
            $final = $finalvalue;
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
                     $qry ="select * from Bidders_List_ivr where  BidderID ='".$concate_array[$l]."'";
                    list($recordcount,$row)=MainselectfuncNew($qry,$array = array());
					$y=0;
				   

                   
                   while($y<count($row))
                    {
                        $last_set_select = $row[$y]["Last_set_select"];
                        $bidder = $row[$y]["BidderID"];
                   		$y = $y +1;
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
                    if($val==1)
                        $val=2;
                    $rand_keys = array_rand($arrbid, $val);
                    for($j=0;$j<=($leftbidder-1);$j++)
                    {                 
                            $random_no[] = $arrbid[$rand_keys[$j]];
                    }
                    $final = array_merge($arr1, $random_no);
                }//close elseif ($finalbid > $leftbidder)
            }
    }
                for($i=0;$i<=count($arrbidder);$i++)
                {
                  
                }

//Ended
//Condition for choosing the bidders

//log entry
$LogFinalBidders = implode(",", $final);
$dataInsert = array("LeadID"=>$RequestID, "EligibleBidders"=>$LogFinalBidders, "Product_Type"=>$mvarType, "Dated"=>$Dated);
$table = 'Log_ivr';
$insert = Maininsertfunc ($table, $dataInsert);


//End log entry
$count = count($final);
//print_r($final);
    $recordcountA ="";
	//echo "Total Defined : "._TOTAL;
        for($l=0;$l<_TOTAL;$l++)
        {   
		
	//		echo "<br>select Restrict_Bidder from Bidders_List_ivr where  BidderID ='".$final[$l]."' and Reply_Type ='".$mvarType."'<br>";
    
            if($toInsertBidderID[0]==1)
            {   
                //Start Book Keeping Code 2008-01-04 18:29:09
                // Code Execution Start Time 2008-01-04 18:45:00   
                
				$BK_Year = date('Y');
                $BK_Month = date('m');
                $BK_Week = date('W');
                $BK_Day = date('d');
               
                $BookKeepingSql = "select * from Bidders_Book_Keeping_ivr where BidderID=".$final[$l]." and BookProduct=".$mvarType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
                list($recordcount,$getrow)=MainselectfuncNew($BookKeepingSql,$array = array());
				$z=0;
				

               
                $BookLeadCountExisting = $getrow[$z]['BookLeadCount'];
                $BookDate = $getrow[$z]['BookDate'];//added
                $BookMonth = $getrow[$z]['BookMonth'];//added
                $BookYear = $getrow[$z]['BookYear'];//added
				
                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                   $IncrementLeadCount = $BookLeadCountExisting + 1;

				  $DataArray = array("BookLeadCount"=>$IncrementLeadCount, "BookEntryTime"=>$Dated );
		$wherecondition ="BidderID = ".$final[$l]." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$mvarType."";
		Mainupdatefunc ('Bidders_Book_Keeping_ivr', $DataArray, $wherecondition);
                 }
                 else
                 {
                     //Insert
                    $InitialCount = 1;

				   $dataInsert = array("BidderID"=>$final[$l], "BookProduct"=>$mvarType, "BookDate"=>$BK_Day, "BookWeek"=>$BK_Week, "BookMonth"=>$BK_Month, "BookYear"=>$BK_Year, "BookLeadCount"=>$InitialCount, "BookEntryTime"=>$Dated);
$table = 'Bidders_Book_Keeping_ivr';
$insert = Maininsertfunc ($table, $dataInsert);
                 }
                 //End Book Keeping Code
          	  
				//echo "<br>".$sql_bidders."<br>";


		   // $Contact_Num = "0".$Contact_Num;	

			
		   //End
		   
     echo "<br>".$sql_call."<br>";
//exit();
              
            }
        }
		//code to insert into call_log
		
		
}
?>