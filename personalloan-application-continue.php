<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	

	$sql = "select RequestID,source,Name,City,City_Other,Mobile_Number from Req_Loan_Personal where RequestID = '".$_SESSION['Temp_LID']."'";
	list($CheckNumRows,$query)=MainselectfuncNew($sql,$array = array());
	$source = $query[0]['source'];
	$Name = $query[0]['Name'];
	$City = $query[0]['City'];
	$City_Other = $query[0]['City_Other'];
	$Phone =$query[0]['Mobile_Number'];
	$lastInserted=$query[0]['RequestID'];
	if($City=="Others" && strlen($City_Other)>0)
	{
		$strcity = $City_Other;
	}
	else
	{
		$strcity = $City;
	}
	
 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="5;URL=apply_personal_loan_step2.php">  -->
<title>Personal Loan Processing</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<Script Language="JavaScript">
function onclick_proceedVal()
    {
		//alert("dfddfsd");
          jQuery.post(
                    "VerifyZipDial.php",

                    {get_RequestID: document.getElementById('RequestID').value , get_proid: 1},

                    function(data){
						//alert(data);
						if(data=="yes")
						{
								window.open("personalloans-applicationcontinue.php","_self");
						}
						else
						{
							alert("We haven't yet received your call,Please wait for 10 seconds and try again.");
						}
   
 }
        );
    }</script>
</head>
<body style="margin:0px; padding:0px;">
<?php include '~Top-new.php';?>
<?php //include '~menu.php';?>
<div id="container"  >  
   <span><a href="index.php">Home</a> > <a href="home-loans.php">Personal Loan</a> > Apply Personal Loan</span>
   <div style="padding-top:15px; ">
    
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	
      <tr>
     <td>
 <!--    <form action="apply-personal-loans-continue.php" method="post" name="pl"> -->
     <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
	 <input type="hidden" name="leadid" id="leadid"  value="<? echo $leadid; ?>" >
     <input type="hidden" name="strcity" id="strcity"  value="<? echo $strcity; ?>" >
     <input type="hidden" name="Name" id="Name"  value="<? echo $Name; ?>" >
       <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	   <tr>
        <td style=" padding:12px;" colspan="2"><table width="539" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="489" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"> Persoanl Loan Application</h1></td>
  </tr>
</table></td>
 </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Dear <?php echo $Name ; ?>, </td>
                     
                     <td width="24%" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
                   </tr>
                     <tr valign="middle">
                     <td height="28" colspan="2" class="frmbldtxt" style="padding-top:3px; font-weight:normal; " align="center">To get quotes and Compare offers from all Banks. Please verify your Mobile Number.	</td>                   
              </tr>
  <tr><td colspan="2" style="color: #D02037; font-size:12px;" height="20" align="center"><b>To Verify, Please Initiate A Miss Call From your Mobile "<span style="color:#000000;" ><? echo $Phone; ?></span>" , To The Below Mentioned TOLL-FREE Number</b></td></tr>
                   <tr><td colspan="2" align="center">
                   <?php
				   $client_transaction_id = $lastInserted."_PL";
				   $zipdimage = mobile_verify($Phone,$client_transaction_id);
				   
                   ?>
                   <img src="<? echo $zipdimage; ?>" /></td></tr>
				    <tr><td style="color: #D02037; font-size:12px; padding-left:250px;" height="30" align="center">Will auto disconnect after 1 ring </td><td colspan="3"><input name="submit" type="button" style="width:240px; background-color: #D02037; color:#FFFFFF; font-weight:700" value="Click After 10 secs of Missed Call" onclick="onclick_proceedVal();" /></td></tr>
                 </table>
<!--        </form> -->
     
     </td>
      </tr>
       <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal;" colspan="2" >
			1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span>. <br />
2) Compare EMI and <span style="color: #D02037;">save Upto Rs. 50000 on interest</span>.<br />
3) Provides you with the best suitable offers.<br /> 
4) Help in processing your loan faster.         </td>
           
      </tr>
		   <tr><td>&nbsp;</td></tr>
		 
       <tr><td>&nbsp;</td></tr>
	   
    </table>

   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php //include '~Bottom-new.php';?> <? } ?>
</div>
<script type='text/javascript'><!--//<![CDATA[

    var OA_p=location.protocol=='https:'?'https:':'http:';
    var OA_r=Math.floor(Math.random()*999999);
    document.write ("<" + "script language='JavaScript' ");
    document.write ("type='text/javascript' src='"+OA_p);
    document.write ("//n.admagnet.net/panda/www/delivery/tjs.php");
    document.write ("?trackerid=10&amp;r="+OA_r+"'><" + "/script>");
//]]>--></script><noscript><div id='m3_tracker_10' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://n.admagnet.net/panda/www/delivery/ti.php?trackerid=10&amp;adid=&amp;sname=%%SNAME_VALUE%%&amp;Order_ID=%%ORDER_ID_VALUE%%&amp;OrderID=%%ORDERID_VALUE%%&amp;Quantity=%%QUANTITY_VALUE%%&amp;Value=%%VALUE_VALUE%%&amp;Transactionid=%%TRANSACTIONID_VALUE%%&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div></noscript>
</body>
</html>