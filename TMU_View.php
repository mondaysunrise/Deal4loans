<?php
//session_start();
	require 'scripts/session_checkTM.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/ajaxcodeTMU.js"></script>
<script Language="JavaScript" Type="text/javascript" >
</script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~TopTM.php';?>


  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

 <br>
 <br>
  <table width="712" border="0">
 <tr><td align="center" width="100%">
 
 <div align="center">
 <?php
		//
	
    @ $rpp;        //Records Per Page
    @ $cps;        //Current Page Starting row number
    @ $lps;        //Last Page Starting row number
    @ $a;        //will be used to print the starting row number that is shown in the page
    @ $b;         //will be used to print the ending row number that is shown in the page
    /////////////////////////////////////////////////////////////////////////////////
    //Database connection
    /////////////////////////////////////////////////////////////////////////////////
    
	
    /////////////////////////////////////////////////////////////////////////////////
    //Following IF Statement is used to make sure when the page is loaded for the
    //first time, Current Page's Starting row number is 0, i.e. 1st row from the
    //table is being printed. It will change as the user will click on next.
    /////////////////////////////////////////////////////////////////////////////////   
    if(empty($_GET["cps"]))
    {
        $cps = "0";
    }
    else
    {
        $cps = $_GET["cps"];
    }
    /////////////////////////////////////////////////////////////////////////////////

    $a = $cps+1;

    $rpp = "50";

    $lps = $cps - $rpp; //Calculating the starting row number for previous page

    /////////////////////////////////////////////////////////////////////////////////
    //Following IF Statement is used to make sure whether a link to Previous page is
    //needed or not. If the user is viewing the first set of data then the link will
    //be disabled, if on the next set then it will carry the $lps in its link and
    //enable the link
    if ($cps <> 0)
    {
        $prv =  "<a href='TMU_View.php?cps=$lps'>Previous</a>";
    }
    else   
    {
        $prv =  "<font color='cccccc'>Previous</font>";
    }
$search_qry = "Select * from Telecaller_Mgmt_Entry where  TME_Name!=''"; 
    $q="Select SQL_CALC_FOUND_ROWS * from Telecaller_Mgmt_Entry where  TME_Name!='' ORDER BY `TME_ID` DESC limit $cps, $rpp";
   
    list($nr,$row)=MainselectfuncNew($q,$array = array());
		$cntr=0;

    $q0="Select FOUND_ROWS()";
	list($nr,$row0)=MainselectfuncNew($q0,$array = array());
    $nr0 = $row0["FOUND_ROWS()"]; //Number of rows found without LIMIT in action

    /////////////////////////////////////////////////////////////////////////////////
    //Following IF Statement is used to determine whether the user has reached the
    //last page of the records. For example, if we have 27 rows to print and we show
    //10 rows per page, then on the third and the last page it will show seven rows
    //and will say at the top that SHOWING RECORDS FROM 21 to 27. If the following
    //validator is not used then it shows SHOWING RECORDS FROM 21 to 30.
    /////////////////////////////////////////////////////////////////////////////////   
    if (($nr0 < 10) || ($nr < 10))
    {
           $b = $nr0;
    }
    else
    {
        $b = ($cps) + $rpp;
    }
 
    ?>
<br>
<table border="0" cellpadding="4" cellspacing="1" width="100%" align="center" class="blueborder">
  <tr><td align=left colspan="7"><b><font face="verdana" size=1 color="#9999CC"><? echo "$nr0 Records Found"; ?></font></b></td></tr>
  <tr><td align='left' colspan="7"><b><font face="verdana" size=1 color="#9999CC"><? echo "Showing Records from $a to $b"; ?></font></b></td></tr>
  <tr>
  <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">SL</font></b></td>
  <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">Name</font></b></td>
  <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">Mobile</font></b></td>
  <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">Pancard</font></b></td>
  <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">TeleCaller Name</font></b></td>
  <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">Bank Unique ID</font></b></td>
    <td class="head1" align='Center'><b><font face="verdana" color="#FFFFFF">Date of Entry</font></b></td>
  </tr>
    <?
  while($cntr<count($row))
        {
       
        $cps = $cps +1;

        $Name=$row[$cntr]["TME_Name"];
		$Mobile=$row[$cntr]["TME_Mobile"];
		$Pancard=$row[$cntr]["TME_Pancard"];
		$TCaller_Name=$row[$cntr]["TME_TCaller_Name"];
		$UniqueID=$row[$cntr]["TME_UniqueID"];
		$EntryDate = $row[$cntr]["TME_Date"]; 
		
        echo "<tr><td align='Left'  class='bodyarial11'><font face=verdana>$cps</font></td><td align='Left' class='bodyarial11'><font fave=verdana>$Name</font></td><td align='Left' class='bodyarial11'><font fave=verdana>$Mobile</font></td><td align='Left' class='bodyarial11'><font fave=verdana>$Pancard</font></td><td align='Left' class='bodyarial11'><font fave=verdana>$TCaller_Name</font></td><td align='Left' class='bodyarial11'><font fave=verdana>$UniqueID</font></td><td align='Left' class='bodyarial11'><font fave=verdana>$EntryDate</font></td></tr>"; 
    }
   
    echo "<tr><td align='right' colspan=7 class='head1'>$prv";

    if ($cps == $nr0)
    {     
        echo "  |  <font color='CCCCCC'>Next</font>";
    }
    else
    {
        if ($nr0 > 5)
        {
            echo "  |  <a href='TMU_View.php?cps=$cps&lps=$lps'>Next</a>";
        }
    }
 
    ?>
</td>
</tr>
</table>

    </div>
 </td></tr></table>
  <br>
 <!-- <table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="TMU_Download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? // echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table> -->
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>

