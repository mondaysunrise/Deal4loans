<?php
ob_start( 'ob_gzhandler');
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/ifscfunctions.php';
$BankName = $_REQUEST['bank'];
$StateName = $_REQUEST['state'];
$City = $_REQUEST['city'];
$Branch = $_REQUEST['branch'];
$GetBank = GetBankID($BankName);
$GetCityIdCity = GetCityIdCity($City);
$DistInfo = GetCityInfo($StateName);

function GetBankInfo($id){
		$Sqql = d4l_ExecQuery("SELECT * FROM ifsc_bank WHERE id=".$id);
		$rowsqlIfsc=d4l_mysql_fetch_array($Sqql);
		return $rowsqlIfsc;
	}
	function GetDistInfo($id){
		$Sqql = d4l_ExecQuery("SELECT * FROM ifsc_state_dist WHERE id=".$id." and sub_id!=0");
		$rowsql=d4l_mysql_fetch_array($Sqql);
		return $rowsql;
	}
function GetStateInfo($id){
		$Sqql = d4l_ExecQuery("SELECT * FROM ifsc_state_dist WHERE id=".$id." and sub_id=0");
		$rowsql=d4l_mysql_fetch_array($Sqql);
		return $rowsql;
	}
$GetBranchId = GetBranchId($Branch);
//echo "SELECT * FROM  ifsc_branch WHERE id='".$GetBranchId['id']."'"; die;
$sqlIfsc=("SELECT * FROM  ifsc_branch WHERE id='".$GetBranchId['id']."'");
list($Numrows,$rowsqlIfsc)=MainselectfuncNew($sqlIfsc,$array = array());
//$rowsqlIfsc=mysql_fetch_array($sqlIfsc);
$BankInfo = GetBankInfo($rowsqlIfsc[0]['bank_id']);
//print_r($BankInfo); die;
$BankDist = GetDistInfo($rowsqlIfsc[0]['state_id']);
if($BankDist['sub_id']!=0)
{
	$BankState = GetDistInfo($rowsqlIfsc[0]['state_id']);
}else{
$BankState = GetStateInfo($rowsqlIfsc[0]['state_id']);

}
$BankStateVal = GetStateInfo($BankDist['sub_id']);
if($BankName!="" and $StateName=="" and $City=="" and $Branch=="")
{
	$MetaTitle = $GetBank['bank_name']." Branch Address, IFSC Code, locator in India";	
	$MetaKeyword = $GetBank['bank_name']." ifsc code, ".$GetBank['bank_name']." micr code, ".$GetBank['bank_name']." Branch Address";
	$MetaDescription = "Find ".$GetBank['bank_name']." Branch locations with address, IFSC code, MICR code, Phone Numbers, Contact Details, Branch Code, Swift codes, Home loan, personal loan, car loan of ".$GetBank['bank_name']." by statewide list only on Deal4loans.com";	
}
if($BankName!="" and $StateName!="" and $City=="" and $Branch=="")
{
	$MetaTitle = $GetBank['bank_name']." ".$DistInfo['name']." Branch IFSC Code, MICR Code & Address.";	
	$MetaKeyword = $GetBank['bank_name']." ".$DistInfo['name']." ifsc code, ".$GetBank['bank_name']." ".$DistInfo['name']." micr code, ".$GetBank['bank_name']." ".$DistInfo['name']." Branch Address";
	$MetaDescription = "Find All ".$GetBank['bank_name']." ".$DistInfo['name']." Branches, IFSC code, MICR code, Address, Phone Numbers, Contact Details, Branch Code, Swift codes, Loans, Home loan, personal loan, car loan, bike loan from ".$GetBank['bank_name']." in ".$DistInfo['name']." only on Deal4loans.com";	
}
if($BankName!="" and $StateName!="" and $City!="" and $Branch=="")
{
	$MetaTitle = $GetBank['bank_name']." ".$GetCityIdCity['name']." Branch IFSC Code | Address | Location";	
	$MetaKeyword = $GetBank['bank_name']." ".$GetCityIdCity['name']." ifsc code, ".$GetBank['bank_name']." ".$DistInfo['name']." micr code, ".$GetBank['bank_name']." ".$GetCityIdCity['name']." Branch Address";
	$MetaDescription = "Find All ".$GetBank['bank_name']." ".$GetCityIdCity['name']." Branch IFSC code, MICR code, Address, Phone Numbers, Contact Details, Branch Code, Location map, Swift codes, details on personal loan, home loan, car loan, bike loan, credit card of ".$GetBank['bank_name']." in ".$GetCityIdCity['name']." only on Deal4loans.com";	
}
if($Branch!='')
{
	$MetaTitle = $GetBank['bank_name']." ".$GetBranchId['branch_name']." Branch IFSC Code ".$GetCityIdCity['name']." - ".$DistInfo['name'];	
	$MetaKeyword = $GetBank['bank_name']." ".$GetBranchId['branch_name']." ifsc code, ".$GetBank['bank_name']." ".$GetBranchId['branch_name']." micr code, ".$GetBank['bank_name']." ".$GetBranchId['branch_name']." Branch Address";
	$MetaDescription = $GetBank['bank_name']." ".$GetBranchId['branch_name']." branch IFSC code, MICR code, Branch Address, Phone Numbers, Contact Details, Branch Code, Swift code, Home loan, personal loan, car loan, two wheeler loan at Deal4loans.com.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-Control" content="no-store"/>
<!-- HTTP 1.0 -->
<meta http-equiv="Pragma" content="no-cache"/>
<!-- Prevents caching at the Proxy Server -->
<meta http-equiv="Expires" content="0"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php if($rowsqlIfsc[0]['MetaTitle']!="") {echo $rowsqlIfsc[0]['MetaTitle'];}else {  echo $MetaTitle;}?>
</title>
<meta property="og:title" content="<?php if($rowsqlIfsc[0]['MetaTitle']!="") {echo $rowsqlIfsc[0]['MetaTitle'];}else {  echo $MetaTitle;}?>" />
<meta name="keywords" content='<?php if($rowsqlIfsc[0]['MetaKeyword']!="") {echo $rowsqlIfsc[0]['MetaKeyword'];}else { echo $MetaKeyword;}?>' />
<meta name="description" content='<?php if($rowsqlIfsc[0]['MetaDesc']!="") {echo $rowsqlIfsc[0]['MetaDesc'];}else { echo $MetaDescription;}?>'>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
	//alert(countryId);
   var strURL="http://www.deal4loans.com/findState.php?BankName="+BankName;
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
  var strURL="http://www.deal4loans.com/findDistrict.php?BankId="+BankId+"&state="+stateId;
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
  var strURL="http://www.deal4loans.com/findBranch.php?BankId="+BankId+"&state="+stateId+"&DistId="+DistId;
  
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
<?php 
if($BankName!="" and $StateName=="") {

 $breadcrumb = " » <span >".$GetBank['bank_name']."</span>";
}

if($BankName!="" and $StateName!="" and $City=="") {

 
$breadcrumb = " » <a href="."/ifscsearch/bank/".$BankName." ><span >".$GetBank['bank_name']."</span></a>". " » ".$DistInfo['name'];
}

if($BankName!="" and $StateName!="" and $City!="" and $Branch=="") {
 
$breadcrumb = " » <a href="."/ifscsearch/bank/".$BankName." ><span >".$GetBank['bank_name']."</span></a>". " » <a href="."/ifscsearch/bank/".$BankName."/state/".$StateName." ><span >".$DistInfo['name']."</span></a>"." » ".$GetCityIdCity['name'];
}

if($BankName!="" and $StateName!="" and $City!="" and $Branch!="") {
 
$breadcrumb = " » <a href="."/ifscsearch/bank/".$BankName." ><span >".$GetBank['bank_name']."</span></a>". " » <a href="."/ifscsearch/bank/".$BankName."/state/".$StateName." >".$DistInfo['name']."</a>"." » <a href="."/ifscsearch/bank/".$BankName."/state/".$StateName."/city/".$City." ><span >".$GetCityIdCity['name']."</span></a>". " » <span >".$GetBranchId['branch_name']."</span>";
}
?>
<div><a href="http://www.deal4loans.com/"><span >Home</span></a> <?php echo $breadcrumb;?></div>
  <div class="ifsc-left">
    <div class="head-search"><a href="http://www.deal4loans.com/ifsccodebank.php">Search IFSC Code</a></div>
    <form name="hlinterest" action="" method="POST">
      <select name="bank" class="ifsc-select" onchange="getState(this.value)">
        <?php
$sqlBank=("SELECT ifsc_bank.id, ifsc_bank.bank_name, ifsc_bank.bank_url, ifsc_bank.flag, ifsc_branch.bank_id FROM ifsc_branch INNER JOIN ifsc_bank ON ifsc_branch.bank_id=ifsc_bank.id WHERE ifsc_bank.flag=1 group by ifsc_branch.bank_id ORDER BY bank_name ASC");
list($Numrows,$rowBank)=MainselectfuncNew($sqlBank,$array = array());

$cnt= 0;
while($cnt<count($rowBank))
{
$id=$rowBank[$cnt]['id'];
$data=$rowBank[$cnt]['bank_name'];
$dataUrl=$rowBank[$cnt]['bank_url'];
?>
        <option value="<?php echo $dataUrl;?>" <?php if($BankName==$dataUrl) { echo "Selected"; }?>><?php echo $data;?></option>
        <?php $cnt = $cnt+1;} ?>
      </select>
      <span id="statediv">
      <select name="state" class="ifsc-select" onchange="getDist('<?php echo $BankName?>',this.value)">
        <option value="">--Select State--</option>
        <?php 
///$QueryState = "select * from ifsc_state_dist where sub_id=0 and flag=1"; 


$QueryState ="SELECT ifsc_state_dist.id, ifsc_state_dist.name, ifsc_state_dist.state_city_url, ifsc_branch.stateid FROM ifsc_branch INNER JOIN ifsc_state_dist ON ifsc_branch.stateid=ifsc_state_dist.id WHERE ifsc_branch.bank_id=".$GetBank['id']." group by ifsc_branch.stateid";

//if($StateName!="")
//{
//$QueryState .= " and state_city_url='".$StateName."'";
//}

list($Numrows,$rowState)=MainselectfuncNew($QueryState,$array = array());

$cntState= 0;
while($cntState<count($rowState))
{
	$id=$rowState[$cntState]['id'];
$data=$rowState[$cntState]['name'];
$dataUrl=$rowState[$cntState]['state_city_url'];
?>
        <option value="<?php echo $dataUrl;?>" <?php if($StateName==$dataUrl){ echo "selected";}?>><?php echo $data;?></option>
        <?php $cntState = $cntState +1;}?>
      </select>
      </span> <span id="Distdiv">
      <select name="district" class="ifsc-select" onchange="getBranch('<?php echo $BankName?>','<?php echo $StateName;?>',this.value)">
        <option value="">--Select City--</option>
        <?php 
$QueryDist = "SELECT ifsc_state_dist.id, ifsc_state_dist.name, ifsc_state_dist.state_city_url, ifsc_state_dist.sub_id, ifsc_branch.stateid, ifsc_branch.state_id FROM ifsc_branch INNER JOIN ifsc_state_dist ON ifsc_branch.state_id=ifsc_state_dist.id WHERE ifsc_branch.bank_id=".$GetBank['id']." AND ifsc_state_dist.sub_id='".$DistInfo['id']."' group by ifsc_branch.state_id";

list($Numrows,$rowDist)=MainselectfuncNew($QueryDist,$array = array());

$cntDist= 0;
while($cntDist<count($rowDist))
{
$id=$rowDist[$cntDist]['id'];
$data=$rowDist[$cntDist]['name'];
$dataUrl=$rowDist[$cntDist]['state_city_url'];
?>
        <option value="<?php echo $dataUrl;?>" <?php if($City==$dataUrl){ echo "selected";}?>><?php echo $data;?></option>
        <?php $cntDist = $cntDist +1;}?>
      </select>
      </span> <span id="Branchdiv">
      <select name="branch" class="ifsc-select" onchange="return goSubmit('<?php echo $BankName?>','<?php echo $StateName?>','<?php echo $City?>',this.value)">
        <option value="">--Select Location--</option>
        <?php 
$QueryBranch = "select * from  ifsc_branch WHERE bank_id='".$GetBank['id']."' ";

if($City!="")
{
 $QueryBranch .= " AND state_id='".$GetCityIdCity['id']."'";
 }

list($NumrowsBr,$rowBranch)=MainselectfuncNew($QueryBranch,$array = array());

$cntBr= 0;
while($cntBr<count($rowBranch))
{
	$id=$rowBranch[$cntBr]['id'];
$data=$rowBranch[$cntBr]['branch_name'];
$dataUrl=$rowBranch[$cntBr]['branch_url'];
?>
        <option value="<?php echo $dataUrl;?>" <?php if($Branch==$dataUrl){ echo "selected";}?>><?php echo $data;?></option>
        <?php $cntBr = $cntBr +1;}?>
      </select>
      </span>
    </form>
    <br>
    <?php 
  $ArrBank = GetBankID($_REQUEST['bank']);
   $ArrState = GetCityId($_REQUEST['state']);
if($BankName!="" and $StateName=="") {
$CountBankBranch = BankBranchCount($ArrBank['id']);

 echo $ArrBank['bank_name']."(".$CountBankBranch.")";
 
 $H1Tag = $ArrBank['bank_name'];
 
}
if($BankName!="" and $StateName!="" and $City=="") {

 $CountStateBranch = StateBranchCount($ArrState['id'],$ArrBank['id']);
 
 echo $ArrBank['bank_name']. "-> ".$ArrState['name']."(".$CountStateBranch.")";
 $H1Tag = $ArrState['name']." ".$ArrBank['bank_name']; 
 
}

if($BankName!="" and $StateName!="" and $City!="" and $Branch=="") {
 $ArrCity = GetCityIdCity($_REQUEST['city']);
 $CountCityBranch = CityBranchCount($ArrCity['id'],$ArrBank['id'],$ArrState['id']);
 
 echo $ArrBank['bank_name']. "-> ".$ArrState['name']." -> ".$ArrCity['name']."(".$CountCityBranch.")";
 
 $H1Tag = $ArrCity['name']." ". $ArrState['name']." ".$ArrBank['bank_name'];
 
}

  ?>
  <br />
  <h1 class="district-name" ><span ><?php echo $H1Tag;
    if($Branch==""){ echo " IFSC Code";}?></span></h1>
  </div>
 
  <div class="ifsc-right">
    <?php include "map.php";?>
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
    <div style="clear:both;"></div>
  </div>
</div>
<?php 
 
   if($Branch!="") {?>
<div class="ifsc-clearfix"></div>
<div class="gray-wrapper-ifsc">
  <div class="gray-wrapper-ifsc-in" >
    <h1 class="sub-head-search" >Details of <?php echo $rowsqlIfsc[0]['branch_name'];?> <?php echo " - ". $BankState['name'];?>, <?php echo $BankInfo['bank_name'];?> Branch, IFSC Code and MICR Code</h1>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="18%" height="25"><strong>Bank:</strong></td>
        <td width="82%" height="25" class="table-text-ifsc"><a href="/ifscsearch/bank/<?php echo $BankName?>"><?php echo $BankInfo['bank_name'];?></a></td>
      </tr>
      <tr>
        <td height="25"><strong>Address:</strong></td>
        <td height="25" class="table-text-ifsc" ><?php echo $rowsqlIfsc[0]['address'];?></td>
      </tr>
      <tr>
        <td height="25"><strong>State:</strong></td>
        <td height="25" class="table-text-ifsc"><a href="/ifscsearch/bank/<?php echo $BankName?>/state/<?php echo $StateName?>"><?php echo $BankStateVal['name'];?></a></td>
      </tr>
      <tr>
        <td height="25"><strong>City:</strong></td>
        <td height="25" class="table-text-ifsc"><a href="/ifscsearch/bank/<?php echo $BankName?>/state/<?php echo $StateName?>/city/<?php echo $City?>"><?php echo $BankState['name'];?></a></td>
      </tr>
      <tr>
        <td height="25"><strong>Location:</strong></td>
        <td height="25" class="table-text-ifsc"><?php echo $rowsqlIfsc[0]['branch_name'];?></td>
      </tr>
      <tr>
        <td height="25"><strong>Pincode:</strong></td>
        <td height="25" class="table-text-ifsc" ><?php if($rowsqlIfsc[0]['pincode']) { echo $rowsqlIfsc[0]['pincode'];} else{ echo "N.A.";}?></td>
      </tr>
      <tr>
        <td height="25"><strong>Phone number:</strong></td>
        <td height="25"><?php echo $rowsqlIfsc[0]['phone'];?></td>
      </tr>
      <tr>
        <td height="25"><strong>IFSC Code:</strong></td>
        <td height="25" class="table-text-ifsc"><?php if($rowsqlIfsc[0]['ifsc']) {echo "<strong style=\"color:#06F\">".$rowsqlIfsc[0]['ifsc']."</strong>";}else{ echo "N.A.";}?></td>
      </tr>
      <!-- <tr>
    <td height="25"><strong>Swift Code:</strong></td>
    <td height="25" class="table-text-ifsc"><?php //if($rowsqlIfsc[0]['swift_bic_code']) {echo "".$rowsqlIfsc[0]['swift_bic_code']."";}else{ echo "N.A.";}?></td>
  </tr>-->
      
      <tr>
        <td height="25"><strong>Branch Code:</strong></td>
        <td height="25"><?php if($rowsqlIfsc[0]['branch_code']) {echo $rowsqlIfsc[0]['branch_code'];}else{ echo "N.A.";}?></td>
      </tr>
      <tr>
        <td height="25"><strong>MICR Code:</strong></td>
        <td height="25"><?php if($rowsqlIfsc[0]['micr_code']) {echo $rowsqlIfsc[0]['micr_code'];}else{ echo "N.A.";}?></td>
      </tr>
      <?php
 if(strlen($rowsqlIfsc[0]['description'])>0) {
 ?>
      <tr>
        <td height="25" valign="top"><strong>Description:</strong></td>
        <td height="25"><?php if($rowsqlIfsc[0]['description']) {echo $rowsqlIfsc[0]['description'];}else{ echo "N.A.";}?></td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>
<?php }?>

<!---Bank List-->
<div class="ifsc-clearfix">
  <div class="listing-wrapper-in">
    <?php 
if($BankName=="") {
$sqlBank=("SELECT * FROM  ifsc_bank WHERE flag=1");
list($Numban,$rowsqlBank)=MainselectfuncNew($sqlBank,$array = array());
  $w = 0; 
  while($w<count($rowsqlBank))
	{
  ?>
    <table width="30%" border="0" cellspacing="0" cellpadding="0" class="listing-wrapper">
      <tr>
        <td height="30"><a href="/ifscsearch/bank/<?php echo $rowsqlBank[$w]['id']?>"><?php echo $rowsqlBank[$w]['bank_name'];?></a></td>
      </tr>
    </table>
    <?php $w = $w+1; }?>
    <?php }?>
  </div>
</div>
<!---State List-->
<div class="ifsc-clearfix">
  <div class="listing-wrapper-in">
    <?php if($BankName!="" and $StateName=="") {
$sqlState=("SELECT ifsc_state_dist.id, ifsc_state_dist.name, ifsc_state_dist.state_city_url, ifsc_branch.stateid FROM ifsc_branch INNER JOIN ifsc_state_dist ON ifsc_branch.stateid=ifsc_state_dist.id WHERE ifsc_branch.bank_id=".$GetBank['id']." group by ifsc_branch.stateid");
list($Nums,$rowsqlState)=MainselectfuncNew($sqlState,$array = array());
  $s = 0;
   while($s<count($rowsqlState))
	{
  ?>
    <table width="30%" border="0" cellspacing="0" cellpadding="0" class="listing-wrapper">
      <tr>
        <td height="30"><a href="/ifscsearch/bank/<?php echo $BankName?>/state/<?php echo $rowsqlState[$s]['state_city_url'];?>"><?php echo $rowsqlState[$s]['name'];?></a></td>
      </tr>
    </table>
    <?php $s = $s+1; }?>
    
    
    <?php }?>
  </div>
</div>
<!---City List-->
<div class="ifsc-clearfix">
  <div class="listing-wrapper-in">
    <?php if($BankName!="" and $StateName!="" and $City=="") {
$CityId = GetCityId($StateName);
$sqlCity=("SELECT ifsc_state_dist.id, ifsc_state_dist.name, ifsc_state_dist.state_city_url, ifsc_state_dist.sub_id, ifsc_branch.stateid, ifsc_branch.state_id FROM ifsc_branch INNER JOIN ifsc_state_dist ON ifsc_branch.state_id=ifsc_state_dist.id WHERE ifsc_branch.bank_id=".$GetBank['id']." AND ifsc_state_dist.sub_id='".$CityId['id']."' group by ifsc_branch.state_id");
list($Numc,$rowsqlCity)=MainselectfuncNew($sqlCity,$array = array());
  $c = 0;
   while($c<count($rowsqlCity))
	{
  ?>
    <table width="30%" border="0" cellspacing="0" cellpadding="0" class="listing-wrapper">
      <tr>
        <td height="30"><a href="/ifscsearch/bank/<?php echo $BankName?>/state/<?php echo $StateName;?>/city/<?php echo $rowsqlCity[$c]['state_city_url']?>"><?php echo $rowsqlCity[$c]['name'];?></a></td>
      </tr>
    </table>
    <?php $c = $c+1; }?>
    
    <?php }?>
  </div>
</div>
<div class="ifsc-clearfix">
  <div class="listing-wrapper-in">
    <?php 
  $GetCityIdCity = GetCityIdCity($City);
$sqlBranch=("SELECT * FROM  ifsc_branch WHERE id not in ('".$GetBranchId['id']."') AND state_id='".$GetCityIdCity['id']."' AND bank_id='".$GetBank['id']."'");
list($Numb,$rowsqlBranch)=MainselectfuncNew($sqlBranch,$array = array());
  $b = 0;
   while($b<count($rowsqlBranch))
	{
  
?>
    <table width="30%" border="0" cellspacing="0" cellpadding="0" class="listing-wrapper">
      <tr>
        <td height="30"><a href="/ifscsearch/bank/<?php echo $BankName?>/state/<?php echo $StateName;?>/city/<?php echo $City?>/branch/<?php echo $rowsqlBranch[$b]['branch_url']?>"><?php echo $rowsqlBranch[$b]['branch_name'];?></a></td>
      </tr>
    </table>
    <?php $b = $b+1; }?>
  </div>
</div>
<div style="clear:both;"></div>
<?php include("ifsc-footer.php"); ?>
</body>
</html>