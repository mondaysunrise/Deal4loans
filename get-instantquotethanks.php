<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

		  $permonemi = $_POST['permonemi'];
	  	  $tene = $_POST['tene'];
		  	  $max_loanamt = $_POST['max_loanamt'];
	$address_apt = $_REQUEST['address_apt'];
	$RequestIDVal= $_REQUEST['RequestID'];
	$appdate= $_REQUEST['appdate'];
	$changeapp_time=$_REQUEST['changeapp_time'];
	$product = 1;
	
$Dated = ExactServerdate();
		$data = array("address_apt"=>$address , "RequestID"=>$RequestIDVal , "appdate"=>$appdate , "changeapp_time"=>$changeapp_time , "Reply_Type"=>$product );
		$table = 'fil_appointments';
		$insert = Maininsertfunc ($table, $data);
	//echo "Our Representative will call and come to you to collect the documents.";



$sql = "select AppID from Req_Loan_Personal where RequestID='".$RequestID."'";
list($firstcount,$query)=MainselectfuncNew($sql,$array = array());
$AppID = $query[0]['AppID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Personal Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, compare personal loans, personal loans comparision, online personal loans, Personal Loans India, Personal loans Online">
<meta name="description" content="Personal Loan – Get Personal loan quotes, compare personal loans online, Best interest rates and EMI from all major personal loan banks.">
<style type="text/css">
body{	margin:0px;	padding:0px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/bgn.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:0px 0px 0px 10px;	padding:0px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:18px; }.imgpostn{	padding-left:31px;	padding-top:10px;	padding-bottom:4px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 

    .btnclr1 {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: bold;
    height: 40px;
    width: 210px;
}
</style>



<script language="javascript">
	
function initUpload_1() {
	document.getElementById('uploadform_1').onsubmit=function() {
	document.getElementById('uploadform_1').target = 'target_iframe_1';
	document.getElementById('status_1').style.display="block"; 
	}
}

function uploadComplete_1(status){
   document.getElementById('status_1').innerHTML=status;
}

function initUpload_2() {
	document.getElementById('uploadform_2').onsubmit=function() {
	document.getElementById('uploadform_2').target = 'target_iframe_2';
    document.getElementById('status_2').style.display="block"; 
	}
}

function uploadComplete_2(status){
   document.getElementById('status_2').innerHTML=status;
}

function initUpload_3() {
	document.getElementById('uploadform_3').onsubmit=function() {
	document.getElementById('uploadform_3').target = 'target_iframe_3';
    document.getElementById('status_3').style.display="block"; 
	}
}

function uploadComplete_3(status){
   document.getElementById('status_3').innerHTML=status;
}

function initUpload_4() {
	document.getElementById('uploadform_4').onsubmit=function() {
	document.getElementById('uploadform_4').target = 'target_iframe_4';
    document.getElementById('status_4').style.display="block"; 
	}
}

function uploadComplete_4(status){
   document.getElementById('status_4').innerHTML=status;
}



</script>

  <script>

var ajaxRequest;  // The variable that makes Ajax possible!

		function ajaxFunction(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
		
function getFeedBack()
{
	var address_apt = document.getElementById('address_apt').value;
	var RequestIDVal = document.getElementById('RequestID').value;
	var appdate = document.getElementById('appdate').value;
	var changeapp_time = document.getElementById('changeapp_time').value;
	//alert(fieldName);
//	var queryString = "?fieldName=" + fieldName + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
	var queryString = "?address_apt=" + address_apt + "&RequestIDVal="+ RequestIDVal + "&appdate="+ appdate + "&changeapp_time=" + changeapp_time;
	alert(queryString); 
	ajaxRequest.open("GET", "getFILAPT.php" + queryString, true);
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4)
		{		
			//alert(ajaxRequest.responseText);
			var ajaxDisplay = document.getElementById('ajaxFeedback');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
			
			
		
		}
	}

	ajaxRequest.send(null); 
	
}

		
	window.onload = ajaxFunction;
</script>
<script language="javascript" type="text/javascript" src="http://www.bimadeals.com/scripts/datetime.js"></script>
</head>

<body>

<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td height="75" >
    <table width="1004" border="0" cellspacing="0" cellpadding="0">



  <tr>



    <td width="450" height="75" align="left" valign="top"><a href="http://www.fullertonindia.com/" target="_blank"><img src="images/lft-fullrtonlogo.gif" width="450" height="75" border="0" /></a></td>

    <td colspan="2" height="75">

		<table height="75" width="100%" style="border:#7F6B53 solid 1px;">

		

		<tr>

				<td bgcolor="#E1DAD2" colspan="3" style="font-size:12px; color:#DE6020; border-bottom:#7F6B53 solid 1px;" align="center"><b>Fullerton India Personal Loan Quote</b></td>

			</tr>

			<tr>

				<td style="color:#7F6B53; font-size:11px; border-right:#7F6B53 solid 1px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Max Loan Amount</b></td><td style="color:#7F6B53; font-size:11px; border-right:#7F6B53 solid 1px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Per Month EMI </b></td><td style="color:#7F6B53; font-size:11px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Tenure</b></td>

			</tr>

			<tr>
       
				<td style=" border-right:#7F6B53 solid 1px; font-weight:normal; font-size:11px;" align="center"><? echo $max_loanamt; ?></td><td style=" border-right:#7F6B53 solid 1px; font-weight:normal; font-size:11px;" align="center"><? echo $permonemi; ?></td><td align="center" style="font-size:11px;"><? echo $tene; ?> yrs</td>

			</tr>

		</table>

	</td>



  </tr>



</table>



</td>

  </tr>

  <tr>

    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="94%" align="right" valign="right" class="hdng-bg"><strong>Dear <?php echo $Name;?></strong></td>

          </tr>

      

        </table></td>



      </tr>

    </table></td>

  </tr>
<tr><td>&nbsp;

</td>
</tr>
<tr><td width="751" height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;"><p>&nbsp;</p>
	   <p>Your Application  is under process. Our Representative will call and come to you to collect the documents.</p></td>
	    </tr>
     

        
      </table>
  </td></tr>

</table>

</body>

</html>