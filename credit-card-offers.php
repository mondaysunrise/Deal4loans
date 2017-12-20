<?php
	header("Location: credit-card-n-debit-card-offers.php");
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$Bank_name= $_REQUEST["Bank_name"];
		$CC_Holder=$_REQUEST["CC_Holder"];


	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card Offers | Debit Card Offers | Eligibility on Credit Cards</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, apply online for credit cards, credit cards, credit card plans, online credit card, convenient credit card, Co branded credit cards, free credit cards" >

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>

	<script type="text/javascript" src="ajax-dynamic-list_cc.js"></script>
<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:175px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:11px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>


	<style type="text/css">
.content{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	vertical-align:top; }

.content table td
	{ font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	vertical-align:top; }


.nrmltxt{
	text-decoration:none;
	color:#4d4d4d;
	font-weight:normal;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}
.bldtxt img{
	margin-right:6px;
	vertical-align:middle;
}

.bldtxt{
	text-decoration:none;
	line-height:20px;
	padding-left:8px;
	color:#7b4501;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}

.bnkbg{
	background-color:#f4f4f4; 
	border-left:5px solid #b2b2b2; 
	padding-left:8px;
	margin-top:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#444444;
	font-weight:bold;
	line-height:30px;

}
	.bldtxt1 {	text-decoration:none;
	line-height:20px;
	padding-left:8px;
	color:#7b4501;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}
    </style>


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


function addCC()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
	
				//alert(document.home_insurance_form.CC_Holder.value);
				ni.innerHTML ='<table width="400" border="0" align="center" cellspacing="0" cellpadding="0"  ><tr><td class="bldtxt" align="center" valign="middle" height="30" width="200" style="font-size:12px;">Card Name</td><td align="left" valign="middle" style="width:160px;"><input type=text" name="card" value=""/> </td></tr></table>';
				

		}
		
		return true;

	}


function removeCC()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
		
				
				ni.innerHTML = '';
				
		}
		
		return true;

	}


function getdetails(r)
		{
		//alert('cetogary_'+ r );	
			var new_CC_details=document.getElementById('cetogary_'+ r ).value;		
		//alert(document.getElementById('cetogary_'+ r ).value);

			if((new_CC_details!=""))
			{
				var queryString = "?cardcontent=" + new_CC_details;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_cardcontentdetails.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						var ajaxDisplay = document.getElementById('get_details');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;

					   
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	window.onload = ajaxFunction;
</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
 
  <div id="txt">	

   <h1 class="pg_heading" align="center">Credit Card and Debit Card Offers for <?php echo date("F, Y"); ?></h1>
   
   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
    <td colspan="3" align="center" valign="middle" style="padding-bottom:15px;"><table width="100%" align="left" cellpadding="0" cellspacing="0"  style="border:1px dashed #7b4501;">
						  
						  <tr>
						    <td height="60" colspan="3" valign="top"><form name="health_insurance_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" >
                              <table width="100%" align="center" cellpadding="0" cellspacing="0" class="quick1">
                                <input type="hidden" name="section" value="">
                                <input type="hidden" name="Source" value="health-insurance">
                                <tr>
                                  <td width="210" height="35" class="bldtxt">Select your Type of Card</td>
                                  <td width="23" align="center" valign="middle">                                    <input name="CC_Holder" id="CC_Holder" value="1" <? if($CC_Holder==1){ echo "checked";}?> type="radio"  style="border:none;"/>                                  </td>
                                  <td width="140" height="20" align="left" class="bldtxt">                                    Credit Card                                    </td>
                                  <td width="24" align="center" valign="middle">                                    <input name="CC_Holder" id="CC_Holder" value="2"  <? if($CC_Holder==2){ echo "checked";}?> type="radio"  style="border:none;"/>                                  </td>
                                  <td width="264" align="left" class="bldtxt">                                  Debit Card</td>
                                  <td width="80" align="left" >&nbsp;</td>
                                </tr>
								

								 <tr>
                                  <td width="210" height="35" class="bldtxt">Bank Name</td>
                                  <td width="23" align="left" valign="middle" colspan="5"> <input name="Bank_name" id="Bank_name"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Bank_name;?>"/>                                                                         </td>
                                </tr>
								<tr><td colspan="7">&nbsp;</td></tr>
                                <tr>
                                  <td colspan="7" id="myDiv" bgcolor="#fffbf6" align="center"><input name="Submit" class="btnclr" type="Submit" value="Submit" /></td></tr></table>
					        </form></td>
		    </tr>
						 					
    </table></td>
  </tr>
  <tr><td colspan="7"><div id="getdetails"><table width="100%" cellpadding="0" cellspacing="0">

  <? if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	?>
  <tr>
			<td colspan="2" class="bnkbg"><? echo $Bank_name;?></td>
		</tr>
		<?
		if($CC_Holder>0)
	{
			//echo $CC_Holder."dd";
		$selectcard=("select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name='".$Bank_name."' and ccndc_approval=1)");
		//echo "select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name='".$Bank_name."' and ccndc_approval=1)";
		
		list($recordcount,$row)=MainselectfuncNew($selectcard,$array = array());
	//$Cctr=0;
		

	}
$i=0;
while($i<count($row))
		{

	//echo $i;
?>


		<tr>
			<td width="25" align="left"><input type="radio" value="<? echo $row[$i]["ccndc_offerid"];?>" name="cetogary" id="cetogary_<? echo $i;?>" style="border:none"   <?php if((strlen(strpos($strcategory, $row[$i]["ccndc_offerid"])) > 0)) echo "checked"; ?> onClick="getdetails(<? echo $i;?>);"/></td><td height="26" class="nrmltxt"><b><? echo $row[$i]["card_name"];?></b></td>
		</tr>
				
					
					<?  $i=$i+1;
					} ?>	
<? 
} ?>
</table></div>
	</td>
	</tr>
	<tr>
	<td colspan="7"><div id="get_details"></div></td>
		</tr>
  
  <tr>
    <td colspan="3"  height="8" ></td>
  </tr>
</table>






   </div>
	
 
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom-new.php';?><? } ?> </div>
  </body>
</html>