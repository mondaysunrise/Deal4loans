<?php
define("_TOTAL","4");//number of maximum bidders

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
   
     $search_query="Select * from Req_Loan_Personal where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 7 DAY) or (Dated >='2007-08-29 00:00:00'))  ";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Loan_Personal"),$Customerid,$City);       

    }
}

function getRequestidhl()
{
   
    //$search_query="Select * from Req_Loan_Home where Allocated IS Null and  ( Dated >=DATE_SUB(CURDATE(),INTERVAL 7 DAY) or (Dated >='2007-06-19 00:00:00')) ";
    $search_query="Select * from Req_Loan_Home where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 7 DAY) or (Dated >='2007-08-29 00:00:00')) ";
    // $search_query="Select * from Req_Loan_Home where Allocated=0";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];

        if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }
        //$Other_City= $row["City_Other"];
        getBiddersList(getReqValue("Req_Loan_Home"),$Customerid,$City);       
    }
}

function getRequestidcl()
{
    //$Type_Loan= $product;
    //echo $Type_Loan."<br>";
    $search_query="Select * from Req_Loan_Car where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 7 DAY) or (Dated >='2007-08-29 00:00:00'))";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Loan_Car"),$Customerid,$City);       

    }
}

function getRequestidlap()
{
    //$Type_Loan= $product;
    //echo $Type_Loan."<br>";
    $search_query="Select * from Req_Loan_Against_Property where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 7 DAY) or (Dated >='2007-08-29 00:00:00')) ";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

        getBiddersList(getReqValue("Req_Loan_Against_Property"),$Customerid,$City);       

    }
}

function getRequestidcc()
{
    //$Type_Loan= $product;
    //echo $Type_Loan."<br>";
    $search_query="Select * from Req_Credit_Card where (Allocated IS Null or Allocated=0 ) and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 7 DAY) or (Dated >='2007-08-29 00:00:00')) ";
    $result = ExecQuery($search_query);
    //echo "hello".$search_query."<br>";
    while($row = mysql_fetch_array($result))
    {
        $Customerid= $row["RequestID"];
        if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }
        getBiddersList(getReqValue("Req_Credit_Card"),$Customerid,$City);       

    }
}

function getBiddersList($strProduct,$strRequestID,$strCity)
{
    $RequestID = $strRequestID;
    $mvarCity = $strCity;
    $mvarType = getCodeValue("ReplyType_$strProduct");
//for adding Restrict Bidder    $qry = "SELECT * FROM Bidders_List WHERE Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' ";
    $qry = "SELECT * FROM Bidders_List WHERE Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1";
    $result = ExecQuery($qry);
    $firstcount = mysql_num_rows($result);
    echo "ll".$qry;
    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;

   
    while ($row = mysql_fetch_array($result))
    {
        $query = $row["Query"];
        $table = $row["Table_Name"];
        $Bidderid = $row["BidderID"];
        $reyrieveBidderid[] = $Bidderid;
       
        $always = $row["Always"];
        $conflict = $row["Conflict_bidder"];
        $last_selection = $row["Last_set_select"];
        $last_allocation = $row["Last_allocation"];
        //$id1 = $id1."'".$conflict."',";
        //echo "ll".$query."<br>";
        $qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
        //echo "ff".$qry2;
        $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
        if($recordcount>0) //(result1)
        {
           
            while($row1=mysql_fetch_array($result1))
            {
                $Request= $row1["RequestID"];
           
                $allBidders[$z] = $Bidderid;
                $z=$z+1;
                echo "TOOOOOOOOOOtal ELIGIBLE BIDDERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR";
                print_r($allBidders);
               
                echo "<br>biddddddddders".$Bidderid."Conflict".$conflict."<br>";

                if($always == 1)
                {
                    $arr1[$i]  = $Bidderid; //forms an array for bidders Always ==1
                    $i=$i+1;
                    print_r ($arr1);
                   
                }//close if($always == 1)
                if($always != 1)
                {
                   
                    if(strlen(trim($conflict))>0)
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
                           
                           
                            //if($flag==1)
                            //{
                               
                                $arr2[count($arr2)]=$Bidderid.",".trim($conflict);


                                //print_r ($arr2);
                                echo "Before conflict Check";

                                $qryinside = "SELECT * FROM Bidders_List WHERE Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1";
                                $resultinside = ExecQuery($qryinside);
                                $firstcount = mysql_num_rows($resultinside);
                                for($i=0;$i<$firstcount;$i++)
                                {
                                    $TotalBidderid[] = mysql_result($resultinside,$i,'BidderID');
                                }
                                //echo "Total Eligible Bidders";
                                //print_r ($TotalBidderid);
                                //echo "<br>Conflict Set";
                                //print_r ($arr2);
                                for($z=0;$z<count($arr2);$z++)
                                {
                                   
                                    $arr2array = explode(",", $arr2[$z]);
                                   
                                    //print_r ($arr2array);

                                    $splitarray = array_intersect($arr2array, $TotalBidderid);
                                    echo "Splitarray";
                                    print_r($splitarray);
                                    $stringarr2[] = implode(",", $splitarray);
                                   
                                    if($splitarray == $arr2array)
                                    {
                                        //Logically count($arr2)-1 should be count($arr2)
                                         $arr2[count($arr2)-1]=$Bidderid.",".trim($conflict);
                                    }
                                    else
                                    {
                                        //write for variable casting
                                       

                                 $arr2[$z] = $stringarr2[$z];    
                                    }
                                   
                                       
                                }
                           
                               
                               
                                   


                            //}//close if($flag==1)

                        }//close if(count($arr2)>0)
                        else
                        {                       
                            $j=0;
                            $arr2[$j]=$Bidderid.",".trim($conflict);
                        }
                       
                    }//close if(strlen(trim($conflict))>0)

                    else if(strlen(trim($conflict))<=0)
                    {
                        $arr3[$k]=$Bidderid;
                        $k=$k+1;
                        //echo "bidderid:last".$Bidderid."<br>";

                    }//close else if(strlen(trim($conflict))<=0)

                }//close else if($always != 1)

            }//close while($row1=mysql_fetch_array($result1))

        }//close if($recordcount>0)

    }//close while ($row = mysql_fetch_array($result))


echo "chal jaa bhai";
print_r ($arr2);

for($z=0;$z<count($arr2);$z++)
{                   
    $splitarr = explode(",",$arr2[$z]);
    print_r ($splitarr);
    for($i=0;$i<count($splitarr);$i++)
    {
        $sql = "select Last_allocation from Bidders_List where  BidderID=".$splitarr[$i];
        $query = ExecQuery($sql);
        $fetchValue = mysql_fetch_array($query);
        //$Last_allocation = $fetchValue[0];
       
        $Last_allocation[] = $fetchValue[0];
    }
   
    if (!in_array(1, $Last_allocation))
    {
        echo $sqlupdate = "update Bidders_List set Last_allocation=1 where BidderID=".$splitarr[0];
        $queryupdate = mysql_query($sqlupdate);
    }

}
















echo "heloooooooooooooooo<br>";
//print_r ($splitarray);
for($z=0;$z<count($arr2);$z++)
{                   
    echo $splitarr = $stringarr2[$z];
}
//print_r ($splitarr);
echo "byeeeeeeeeeeeeeeeeee<br>";


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
            $result1 = ExecQuery($qry1);
            //echo "ggg".$qry1."<br>";
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
   
    for($kk=0;$kk<count($arrt);$kk++)
    {
    //    echo "ets formed :".$arrt[$kk]."<br>";
    }
        $id="";
        $existflag = 0 ;
        for($kk=0;$kk<count($arrt);$kk++)
        {
            $qry2="select * from Bidders_List where BidderID='".$arrt[$kk]."'";
            $result2 = ExecQuery($qry2);
            //echo $qry2."<br>";
            while($row = mysql_fetch_array($result2))
            {
                $seq= $row["Sequence_no"];
                $last= $row["Last_allocation"];
                $bidder = $row["BidderID"];
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
                    //echo "below Value str_final<br>";
                    //print_r($str_final);
                    //echo "above Value str_final<br>";
               
               
                    break;
                   

                }//close if($last=='1')
                else
                {
                $seq_find = 0;
                }

/*
In a set the last_allocation is zero in every case if it is more than 1 value in the $arr2
        for($m=0;$m<count($arr2);$m++)
        {
            $records = explode(",", $arr2[$m]);
            for($k=0;$k<count($records);$k++)
            {
                echo $sql2 = "select Last_allocation from bidders_list where BidderID='".$records[$k]."'";
                $query2=mysql_query($sql2);
                $fetchqueryLastAllocation = mysql_fetch_array($query2);
                echo "fetchLastAllocation::".$fetchLastAllocation = $fetchqueryLastAllocation[0];
               
                if($fetchLastAllocation==0 || $fetchLastAllocation==NULL) {
                    $value = explode(",", $str_final);
                    $result1 = array_diff($arr2, $value);

                    echo "<br><br><br>Inside $last==0::";
                   
                    echo "arr2";
                    print_r($arr2);
                    echo "<br>";
                   

                   
                    echo "value";
                    print_r($value);
                    echo "<br>";
                   
                   
                    echo "result1";
                    print_r($result1);
                    count($result1);
                    echo "<br>";

                    if(count($result1)!=NULL || count($result1)!=0)
                    {
                        $i=$j=0;
                        for($i=0;$i<count($arr2);$i++)
                        {
                            $pieces = explode(",", $arr2[$i]);
                            for($j=0;$j<count($pieces);$j++)
                            {
                           
                                $sql = "select BidderID from bidders_list where BidderID='".$pieces[$j]."' and         Sequence_no=1 and Last_allocation=0";
                                $query=mysql_query($sql);
                                echo "<br>";
                                $fetchquery = mysql_fetch_array($query);
                                echo $fetchfinalvalue = $fetchquery[0];
                               
                                $str_final=$str_final.$fetchfinalvalue.",";   

                            }
                        }
                        //print_r ($str_final);
                       
                    }

                   echo "::$last==0 End<br><br><br>";
            }
        }//close for($k=0;$k<count($records);$k++))
    }//close for($m=0;$m<count($arr2);$m++
*/
        /*if (strlen(trim($str_final)<=0))
            {
                if((strlen(trim($last))<0) || ($last==0))
                {
                    //echo "lastdddddddddddddddd".$bidder."<br>";
                    if($seq==1){
                        //echo "hellllo".$seq;
                        $str_final=$str_final.$bidder.",";
                    }
               
                }
            }*/
           

           

            }//while
           
           
           
        }
        //for
///14-august-2007
        /*$pieces9 = explode(",", $id);

        for($ll=0;$ll<count($pieces9)-1;$ll++)
        {       
            //echo "helluuuo".$pieces9[$ll]."<br>";
            $qry="update  Bidders_List set Last_allocation='0' where BidderID='".$pieces9[$ll]."'";
            ExecQuery($qry);
            echo $qry;

        }*/

        $arrr="";
        $arrt="";
        $z=0;
        $q=0;
        $bb=0;
        $ll=0;   
                           
}//END
   
    //$arr2 = $stringarr2;
    //print_r ($arr2);
for($j=0;$j<count($arr2);$j++)
{
    echo "unique sets formed :".$arr2[$j]."<br>";
}








    for($z=0;$z<count($arr1);$z++)
    {
        $final= $final.$arr1[$z].",";
    }
    //Concat
   
    $final_str = $final.":::".$str_final;
    echo "final bidder:".$final_str."<br>";
   
    $str_final1 = explode(",", $str_final);

    //array used for the final set allocation
    $concate_array = array_merge($arr3, $str_final1);
   
   
   
    $finalbiddercount = count($concate_array)-1;
    //echo "arr1count".$arr1count = count($arr1).":::TOTAL"._TOTAL."<br>";
        //echo "count".$finalbiddercount."<br>";
       
        if($arr1count > _TOTAL)
        {
            //    echo "Hi inside if condition";
            //Constant _TOTAL is defined at the top of this file
            //condition for bidders if always 1 greater than number of maximum bidders         
       
            $rand_keys = array_rand($arr1, 4);
            //print_r ($rand_keys);
            //echo count($rand_keys);
            //code changed
            //$final[] = $arr1[$rand_keys[$z]]
            for($z=0;$z<_TOTAL;$z++)
            {
                $a19 =$arr1[$rand_keys[$z]];
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
                //echo "finalbiddercount".$finalbiddercount.":: counarr".count($arr1)."jay".$leftbidder."leftbidder";
                //echo "Hi in:::";
                //print_r ($concate_array);
                $final = array_merge($arr1, $concate_array);
           
            }
            else
            {
                $l=$i=$j=0;
                echo "Hi out:::";

                //print_r ($concate_array);
                //For Sets add code
                for($l=0;$l<count($concate_array)-1;$l++)
                {
                     $qry ="select * from Bidders_List where  BidderID ='".$concate_array[$l]."'";
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
                    //    echo "select".$bidder."<br>";
                    }
                    if($last_set_select==1)
                    {
                        $arrbidder[$j]=$bidder;
                         $j=$j+1;
                        // echo "last set:".$bidder."<br>";
                    }
                }
               
                echo "finalbid::".$finalbid = count($arrbid);
                //echo "count of array last =1::".$finalbid."<br>";
                if($finalbid == $leftbidder)
                {
                    /*for($z=0;$z<count($arrbid);$z++)
                    {
                        $final[]= $arrbid[$z];
                    }*/
                    echo "ONE";
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
                        echo "condition::<br><br>";
                        print_r($final);
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
                   
                   
                    echo "<br><br>";
                    print_r(array_rand($arrbid, $val));
                    for($j=0;$j<=($leftbidder-1);$j++)
                    {
                       
                            $random_no[] = $arrbid[$rand_keys[$j]];
                           
                       
                    }
                     print_r($random_no);
                   
                    $final = array_merge($arr1, $random_no);
                        print_r($final);
                   
                   

                }//close elseif ($finalbid > $leftbidder)
                       
                //else {}
            }
           
                    /*$val = $finalbiddercount-1;

                if($val==1)
                    $val=2;

                $rand_keys = array_rand($concate_array, $val);
                                               
                for($i=0;$i<($finalbiddercount-1);$i++)
                        $final[] = $str_final[$rand_keys[$i]];*/

               
    }
           







                for($i=0;$i<=count($arrbidder);$i++)
                {
                   
                    $qry11 = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$arrbidder[$i]."'";
                    ExecQuery($qry11);
                   
                    echo "<br>".$qry11."<br>";
                   
                    $queryGetBidderID = ExecQuery("select Conflict_bidder from Bidders_List where  BidderID ='".$arrbidder[$i]."'");
                    $fetchBidderID = mysql_fetch_array($queryGetBidderID);

                    $explodeBidderID = explode(",",$fetchBidderID[0]);
                    for($j=0;$j<=count($explodeBidderID);$j++)
                    {
                        $qry12 = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$explodeBidderID[$j]."'";
                        //echo "<br>".$qry12."<br>";
                          ExecQuery($qry12);
                   
                    }
                   
                }









       
//Ended
//Condition for choosing the bidders
$count = count($final);
   
        print_r ($final);
        //for($l=0;$l<count($final);$l++)
        for($l=0;$l<_TOTAL;$l++)
        {   
            $toInsert = ExecQuery("select Restrict_Bidder from Bidders_List where  BidderID ='".$final[$l]."'");
            $toInsertBidderID = mysql_fetch_array($toInsert);   
            if($toInsertBidderID[0]==1)
            {               
                $queryA="Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type) Values ('$Request', '$final[$l]','$mvarType')";
                ExecQuery($queryA);
                echo "helo".$queryA."<br>";
               
                $qry9 = "UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '".$final[$l]."'";
                echo $qry9."<br>";
                ExecQuery($qry9);
                $getConflictBidderSql = ExecQuery("select Conflict_Bidder from Bidders_List where  BidderID ='".$final[$l]."'");
                $getConflictBidderFetch = mysql_fetch_array($getConflictBidderSql);   
               
                $getConflictBidder = $getConflictBidderFetch[0];
               
                $arrayConflictBidder = explode(",",$getConflictBidder);
                echo "count".count($arrayConflictBidder);
               
                for($i=0;$i<count($arrayConflictBidder);$i++)
                {
                    $qry10 = "UPDATE `Bidders_List` SET `Last_allocation` = '0', `Last_set_select` = '1' WHERE `BidderID` = '".$arrayConflictBidder[$i]."'";
                    echo $qry10."<br>";
                      ExecQuery($qry10);
                }


               
            }
           
        }
       
       
        /*for($l=0;$l<count($final);$l++)
        {   
            $toInsert = ExecQuery("select * from Bidders_List where  BidderID ='".$final[$l]."'");
            $toInsertBidderID = mysql_fetch_array($toInsert);
            while($row = mysql_fetch_array($toInsertBidderID))
            {
                $restrict_bidder = $row["Restrict_Bidder"];
                $last_set_select = $row["Last_set_select"];
                $conflict_bidder = $row["Conflict_bidder"];
                $bidder = $row["BidderID"];
            }
if($restrict_bidder==1)
            {
                $queryA="Insert into Req_Feedback_Bidder (AllRequestID,BidderID,Reply_Type) Values ('$Request', '$final[$l]','$mvarType')";
                ExecQuery($queryA);
                //echo "insert::".$queryA."<br>";
               $qry9="update Bidders_List set Last_allocation='1' and  Last_set_select='1' where BidderID='".$final[$l]."'";
                ExecQuery($qry9);
                echo "update::".$qry9."<br>";
           
            }
       

           
           
if(strlen(trim($conflict))>0)
                {
                    $j=0;
                    $arrnew[$j]=$bidder.",".trim($conflict_bidder);
                }



                $j=$l=0;
                for($j=0;$j<count($arrnew);$j++)
                {
                $pieces = explode(",", $arrnew[$j]);
                    for($l=0;$l<count($pieces)-1;$l++)
                    {                   
                    $qry1="update Bidders_List Last_set_select='1' and Last_allocation='0' where BidderID='".$pieces[$l]."'";
                    $result1 = ExecQuery($qry1);
                    }

           
        }
       
        }*/
    if($mvarType=="2")
    {
            $qry10="update Req_Loan_Home set Allocated='1' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="1")
    {
            $qry10="update Req_Loan_Personal set Allocated='1' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="3")
    {
            $qry10="update Req_Loan_Car set Allocated='1' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="5")
    {
            $qry10="update Req_Loan_Against_Property set Allocated='1' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }
    if($mvarType=="4")
    {
            $qry10="update Req_Credit_Card set Allocated='1' where RequestID='".$Request."'";
            ExecQuery($qry10);
    }

           
}

main();

Function main()
{
      //  getRequestidpl();
     getRequestidhl();
    // getRequestidcl();
    // getRequestidlap();
    // getRequestidcc();
   
}

?>