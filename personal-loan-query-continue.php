<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	if(isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Name = $_POST['Name2'];
		$Phone = $_POST['Phone2'];
		$Email = $_POST['Email2'];
		$source = $_POST['source'];
		$City = $_POST['City2'];
		$Type_Loan = "Req_Loan_Home";
		$IP = getenv("REMOTE_ADDR");
		$validMobile = is_numeric($Phone);	
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
		{
		  $validname=0;
		}
		else
		{
			$validname=1;
		}
		
		if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
		{
			$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Reference_Code'=>$Reference_Code, 'Direct_Allocation'=>$Direct_Allocation, 'IsProcessed'=>$IsProcessed, 'Edelweiss_Compaign'=>$edelweiss, 'Cpp_Compaign'=>$cpp_card_protect, 'Annual_Turnover'=>$Annual_Turnover, 'Privacy'=>$accept);

				//echo "<br>else".$InsertProductSql;
				$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
			}
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<link href="get-pl1.css" rel="stylesheet" type="text/css">
<link href="media-queries1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script src="jscript-marquee.js" type="text/javascript" ></script>
<link href="marquee.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<style>


/* Big box with list of options */
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:350px;	/* Width of box */
	height:160px;	/* Height of box */
	overflow:auto;	/* Scrolling features */
	border:1px solid #317082;	/* Dark green border */
	background-color:#FFF;	/* White background color */
	color: black;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-align:left;
	font-size:10px;
	z-index:50;
}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
	margin:1px;		
	padding:1px;
	cursor:pointer;
	font-size:10px;
}

#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
	background-color:#2375CB;
	color:#FFF;
}
#ajax_listOfOptions_iframe{
	background-color:#F00;
	position:relative;
	z-index:5;
}

form{
		display:inline;
	}
select:focus, input:focus
{
border:#FF9122 1px solid; 
}
</style>
<script type="text/javascript">


function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}



function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

function prepareInputsForHints() {
	var inputs = document.getElementsByTagName("input");
	for (var i=0; i<inputs.length; i++){
		// test to see if the hint span exists first
		if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
			// the span exists!  on focus, show the hint
			inputs[i].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			// when the cursor moves away from the field, hide the hint
			inputs[i].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
	// repeat the same tests as above for selects
	var selects = document.getElementsByTagName("select");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[0]) {
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
}
addLoadEvent(prepareInputsForHints);
</script>
<script language="javascript">
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

</script>
<style type="text/css">
.sagscroller {
width: 100%!important;
height: 150px;
overflow: hidden;
position: relative;
border: 2px solid black;
border-radius: 8px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
}

#mysagscroller2 ul li{
border-width:0;
display:block; /*this causes each image to be flush against each other*/
}

</style>

<script>
var sagscroller1=new sagscroller({
	id:'mysagscroller',
	mode: 'manual' })

var sagscroller2=new sagscroller({
	id:'mysagscroller2',
	mode: 'auto',
	pause: 2500,
	animatespeed: 400 //<--no comma following last option
})

</script>
</head>
<body>
<div id="pagewrap">
<div id="header">
<div class="top_container">
<div class="logo_get-pl"><img src="images/gpl_logo.png"></div>
<div class="text_box">Compare Personal Loan, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get your eligibility & Quotes 
  from different Banks</div>
</div>
</div>
<div class="Sbi_home-laon-top_ad_box" style="margin-top:-5px; width:1024px; text-align:right; color:#fff; font-weight:bold; font-size:18px;">&nbsp;</div>
<div class="second_wrapper">
<div style="clear:both;"></div>
	<div class="right-box-c" ><h4 class="heading_text_b">Top Personal loan Banks in India - </h4>
			<span class="hdfc-bank
"><span class="sbi-bank">Sbi (State Bank)</span>, Hdfc Bank</span>,	<span class="bajaj-finserv">			Bajaj Finserv</span>, <span class="kotak">Kotak</span>, <span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">PNB</span>  <strong>and </strong><span class="Standard-Chart">Standard Chartered.</span></div>
  <div id="content">
          <div class="mobilecontentbox">
           
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td height="165" valign="top" bgcolor="#FFFFFF" class="sbi_text_c">Thank You for applying. <br />We will get back to you shortly</td>
  </tr>

</table>
          </div>
<div style="width:100%; max-width:550px;"> 
<div id="mysagscroller2" class="sagscroller" style="width:100%; max-width:550px;">
<ul>
<?php
$sql = "SELECT Company_Name, Net_Salary, City,City_Other FROM Req_Loan_Personal WHERE Net_Salary >400000 AND Employment_Status =1 AND Allocated =1 and Company_Name!='' ORDER BY RequestID DESC  LIMIT 0 , 6";
	list($count,$query)=MainselectfuncNew($sql,$array = array());
	$final = '';
	$offers =array ("2 Offers", "3 Offers", "4 Offers", "2 Offers", "3 Offers", "4 Offers");
	for($i=0;$i<$count;$i++)
	{
		$company = $query[$i]['Company_Name'];
		$salary = $query[$i]['Net_Salary'];
		$city = $query[$i]['City'];
		if($city=="Others")
		{
			$city = $query[$i]['City_Other'];
		}
		
	
	?>
    	<li style="padding:2px;">An Employee of<strong><span style="color:#0f8eda;"> <?php echo $company; ?></span></strong> with Income <strong  style="color:#0f8eda;">Rs. <?php echo round($salary); ?></strong> of City <strong  style="color:#0f8eda;"><?php echo $city; ?> </strong>got <strong  style="color:#0f8eda;"><?php echo $offers[$i];?></strong><br /></li>

    <?php
	}

?>


	
	</ul>
</div>

</div>
	</div>
	
	
	
	<div id="sidebar">

		<div class="widget">
		 	  <div class="right-box-d">
			<h4 class="heading_text_b">Top Personal loan Banks in India - </h4>
			<span class="hdfc-bank
"><span class="sbi-bank"> Sbi (State Bank)</span>, Hdfc Bank</span>, 
			<span class="bajaj-finserv">
			Bajaj Finserv</span>, <span class="kotak">Kotak</span>, 
<span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">ICICI Bank</span>  <strong>&amp; </strong><span class="Standard-Chart">Standard Chartered.</span></div>

<div class="right-box">
  <span class="heading_text_b">Get Info on Interest Rates from -<br> Sbi (State Bank)</span>,<span class="hdfc-bank
">Hdfc Bank</span>, <span class="bajaj-finserv">
		Bajaj Finserv</span>, <span class="kotak">Kotak</span>, 
        <span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">ICICI Bank</span>  <strong>&amp;</strong> <span class="Standard-Chart">Standard Chartered.</span>
</div>


<div class="sbi_text_bullet">
<h4 class="heading_text_b">Why Deal4loans.com</h4>
<ul>
<li>Get instant quote on Rates, Emi, Eligibility, Fees & Documents from all Banks.</li>
<li>Pick best Bank as per your requirement.</li>
<li>Deal4loans.com has serviced 21 lac customers till now & it's a totally free service.</li>
<li>Your Information is secure with us and will not be shared without your consent.</li>
<li>Personal Loan Quotes are free for customers. It's a totally free service for customers.</li>
<li>All loans repayment period are over 6 months. No short term loans.</li>

</ul>
  
</div>

		</div>
		

		<div class="widget clearfix">
			<h4 class="heading_text_b">You Need Personal Loan for</h4>
			
        <img src="images/loan-planing_img-new.jpg"></div>
		
						
  </div>
	
	
</div>
</div>
<div style="clear:both;"></div>
<?php include 'footer_landingpage1.php'; ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>