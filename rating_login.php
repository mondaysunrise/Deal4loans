<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$URL=$_REQUEST['url'];
	$ip =$_REQUEST['ip'];
 //echo "ppp".$URL;
	$Msg = "";

	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;
$Email=$_REQUEST['rating_email'];
$Contact=$_REQUEST['rating_contact'];

		$result = ("select * from wUsers where Email='$Email' ");
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;

		if($num_rows > 0){
		$titles = array(
				'Req_Loan_Personal',
				'Req_Loan_Home',
				'Req_Loan_Car',
				'Req_Credit_Card' ,
				'Req_Loan_Against_Property',
				
			);
			
			
while($cntr<count($row))
        {
	//echo "heelo";
		$qry="select RequestID,City, Mobile_Number  from ".$titles[$k]." where Email like '%".$Email."%'" ;
		 list($qrynum_rows,$qryrow)=MainselectfuncNew($qry,$array = array());
		$i=0;
		
		if($qrynum_rows > 0)
		{
$dataInsert = array("T_RequestID"=>$qryrow[$i]['RequestID'], "T_Product"=>getProductCode($titles[$k]), "T_City"=>$qryrow[$i]['City'], "T_Dated"=>$Dated, "Mobile_Number"=>$qryrow[$i]['Mobile_Number']);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);

		 }
	  $cntr=$cntr+1;
	  }
			
  
			 /* Create Session Variables */
			setSessionUser($Email, $row);

			
			 /* Dump Resultset */
			mysql_free_result($result);
			 /* Redirect browser */
			// $strDir = dir_name();
		

		 
			

			 echo "<script>window.close()"."</script>";
			//header("Location: //http://".$_SERVER['HTTP_HOST'].$strDir."rate-your-banks.php?sessid='".$URL."'");
			//exit;
		}
		else
			{
			echo " Invalid Email. Please try again ";
		}
	}


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<STYLE>

a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}</style>
<script>


window.resizeTo(310,500)


function refreshParent() {
 window.opener.location.href = window.opener.location.href;

 if (window.opener.progressWindow)
               
{
   window.opener.progressWindow.close()
 }
 window.close();
}
//-->

/*function HandleOnClose() {
   if ((event.clientY < 0)) {
   
	  //myWindow = window.open("Commonmailer.html", "tinyWindow", 'resizable height=350, scrollbars' )
	  alert("hello");
	   myWindow.document.bgColor="";
	   myWindow.document.close(); 
   }
}
*/
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function ratingchkform()
{  
		if(document.rating_form.rating_name.value=="")
	{
			alert("please enter your Name!");
			document.rating_form.rating_name.focus();
				return false;
	}
		if(document.rating_form.rating_email.value=="")
	{
			alert("please enter your email id!");
			document.rating_form.rating_email.focus();
				return false;
	}
	if(document.rating_form.rating_email.value!="")
	{
		if (!validmail(document.rating_form.rating_email.value))
		{
			//alert("Please enter your valid email address!");
			document.rating_form.rating_email.focus();
			return false;
		}

	}
	if(document.rating_form.rating_contact.value=="")
	{   
		alert("Please enter Mobile no");
		document.rating_form.rating_contact.focus();
		return false;
	}
	
	}

	function intOnly(i) {
		if(i.value.length>0) {
			i.value = i.value.replace(/[^\d]+/g, ''); 
		}
	}
</script>
</head>

<body onUnload="opener.location=('<?php echo $URL;?>')">
<form name="rating_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return ratingchkform();">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #246FE2;">
  <tr>
    <td style="color:#1074D5;font-family:verdana;font-size:11px; text-align:center; font-weight:bold; padding:8px 0px;">If you are already registered with Deal4loans.com, then please sign in to Rate your Bank and avail a FREE Insurance.</td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#246FE2" style="color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">Sign In </td>
  </tr>

  <tr>
    <td bgcolor="#DAEAF9"><table width="100%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td width="37%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Name</td>
        <td width="63%"><input type='text' name='rating_name' id='rating_name' /></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Email Id </td>
        <td><input type='text' name='rating_email' id='rating_email'/></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Mobile No. </td>
        <td><input name='rating_contact3' type='text' id='rating_contact' size="1" value="+91" />
          <input  type='text' name='rating_contact' id='rating_contact' size="14" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30" align="center" valign="middle" bgcolor="#DAEAF9"><input type='submit' value='submit' class='bluebutton'></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><img src="images/insurance-ban.gif" width="226" height="107" /></td>
  </tr>
  <tr>
    <td style="color:#1074D5;font-family:verdana;font-size:11px; text-align:center; font-weight:bold; padding:8px 0px;">If you are NOT registered with Deal4loans.com, then register here to Rate your Bank and avail a free Insurance.<br/>      <font color="#ff0000"><a href="register_for_rating.php?url=<? echo $URL;?>"> Register Now!!</a></font></td>
  </tr>
</table>
</body>
</html>
