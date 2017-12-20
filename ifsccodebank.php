<?php
ob_start( 'ob_gzhandler');
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="Content-Language" content="en-us" />
<title>IFSC Code - Find All Banks of India IFSC, MICR, Swift Codes in India</title>
<meta property="og:title" content=" IFSC Code - Find All Banks of India IFSC, MICR, Swift Codes in India " />
<meta name="description" content="List of all banks IFSC and MICR codes with branch address details online. &#10004; Verified IFSC Codes for NEFT & RTGS &#10004; Branch Address &#10004; Branch codes &#10004; Phone Numbers &#10004; Contact Details &#10004; Fax Numbers, Location Maps etc.">
<meta name="keywords" content="bank ifsc codes, ifsc code, micr code, indian financial system code, Find IFSC, MICR Codes, Address, All Bank Branches in India, for NEFT, RTGS, ECS Details." />

<link href="http://www.deal4loans.com/css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<link href="http://www.deal4loans.com/css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="http://www.deal4loans.com/css/search-ifsc-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }

function getState(BankName)
{
   var strURL="findState.php?BankName="+BankName;
   var req = getXMLHTTP();
   if (req)
   {
     req.onreadystatechange = function()
     {
      if (req.readyState == 4)
      {
	 // only if "OK"
	 if (req.status == 200)
         {
			 
	    document.getElementById('statediv').innerHTML=req.responseText;
	 } else {
   	   alert("There was a problem while using XMLHTTP:\n" + req.statusText);
	 }
       }
      }
   req.open("GET", strURL, true);
   req.send(null);
   }
}
</script>
<script type="text/javascript">
function getDist(BankId,stateId)
{
  var strURL="findDistrict.php?BankId="+BankId+"&state="+stateId;
  var req = getXMLHTTP();
  if (req)
  {
    req.onreadystatechange = function()
    {
      if (req.readyState == 4) // only if "OK"
      {
        if (req.status == 200)
        {
          document.getElementById('Distdiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}
</script>
<script type="text/javascript">
function getBranch(BankId,stateId,DistId)
{
  var strURL="findBranch.php?BankId="+BankId+"&state="+stateId+"&DistId="+DistId;
  var req = getXMLHTTP();
  if (req)
  {
    req.onreadystatechange = function()
    {
      if (req.readyState == 4) // only if "OK"
      {
        if (req.status == 200)
        {
          document.getElementById('Branchdiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}
function goSubmit(bank,state,dist,branch)
	{
		window.location.href="/ifscsearch/bank/"+bank+"/state/"+state+"/city/"+dist+"/branch/"+branch;
	}
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="ifsc-main">
<div class="ifsc-left">
<h1 class="head-search" >Search IFSC Code</h1>
  <form name="hlinterest" action="" method="POST">
<select name="Bank" class="ifsc-select" onchange="getState(this.value)">
<option selected="selected">--Select Bank Name--</option>
<?php
$sql="SELECT ifsc_bank.id, ifsc_bank.bank_name, ifsc_bank.bank_url, ifsc_bank.flag, ifsc_branch.bank_id FROM ifsc_branch INNER JOIN ifsc_bank ON ifsc_branch.bank_id=ifsc_bank.id WHERE ifsc_bank.flag=1 group by ifsc_branch.bank_id  ORDER BY bank_name ASC";

list($Numrows,$row)=MainselectfuncNew($sql,$array = array());

$cntr= 0;
//$sql=ExecQuery("select * from ifsc_bank where flag='1'");
while($cntr<count($row))
{
$id=$row[$cntr]['id'];
$data=$row[$cntr]['bank_name'];
$dataURL=$row[$cntr]['bank_url'];
?>
<option value="<?php echo $dataURL;?>" <?php if($_REQUEST['bank']==$dataURL) { echo "Selected"; }?>><?php echo $data;?></option>
 <?php $cntr = $cntr +1;} ?>
</select><span id="statediv"> <select name="state" class="ifsc-select">
<option selected="selected">--Select State Name--</option>

</select>
</span>
<span id="Distdiv"> <select name="district" class="ifsc-select">
<option selected="selected">--Select City--</option>
</select>
</span>
<span id="Branchdiv"><select name="Branch" class="ifsc-select">
<option selected="selected">--Select Location--</option>
</select>
</span>
  </form>
</div>
<div class="ifsc-right">
 <?php include "mapifsc.php";?>
<br />
<!--Facebook-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
<!--google plus-->
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" style="width:178px;"></div>
<!--twitter-->
<a href="https://twitter.com/share" class="twitter-share-button" data-size="large" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>

<br />
<div style="clear:both;"></div>
   <?php
$sql2="SELECT ifsc_bank.id, ifsc_bank.bank_name, ifsc_bank.bank_url, ifsc_bank.flag, ifsc_branch.bank_id FROM ifsc_branch INNER JOIN ifsc_bank ON ifsc_branch.bank_id=ifsc_bank.id WHERE ifsc_bank.flag=1 group by ifsc_branch.bank_id ORDER BY RAND() LIMIT 0,18";
list($Numrows,$rowBank)=MainselectfuncNew($sql2,$array = array());
$cnt= 0;
while($cnt<count($rowBank))
{
$id=$rowBank[$cnt]['id'];
$data=$rowBank[$cnt]['bank_name'];
$dataUrl=$rowBank[$cnt]['bank_url'];
?>
 <table width="30%" border="0" cellspacing="0" cellpadding="0" class="listing-wrapper">
  <tr>
    <td height="30"><a href="/ifscsearch/bank/<?php echo $dataUrl?>"><?php echo $data;?></a></td>
  </tr>
</table>
<?php $cnt=$cnt+1;}?> 
</div>
<div style="clear:both;"></div>

<?php include("ifsc-footer.php"); ?>
</body>
</html>