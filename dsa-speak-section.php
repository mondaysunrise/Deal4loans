<?php
header("Location: index.php");
exit();

	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();
	
	function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'applyhere_pl.php',
		'Req_Loan_Home' => 'applyhere_hl.php',
		'Req_Loan_Car' => 'applyhere.php',
		'Req_Credit_Card' => 'applyhere_cc.php',
		'Req_Loan_Against_Property' => 'applyhere.php',
		'Req_Business_Loan' => 'Req_Business_Loan_New.php',

	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	$msg = "Thank You, You will be soon contacted by our Executive";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		$From_City = $_REQUEST['city'];
		$From_City_Other = $_REQUEST['city_other'];
		
		$Mobile = $_REQUEST['Mobile'];
		$Products = $_REQUEST['Product'];
		$Company = $_REQUEST['Company'];
		$query_type = $_REQUEST['query_type'];
		$product_type =$_REQUEST['product_type'];
		$n        = count($Products);
	   $i        = 0;
	   while ($i < $n)
	   {
		  $Product .= "$Products[$i], ";
		  $i++;
	   }

		if($query_type==2)	
		{
			$Dated = ExactServerdate();
			$dataInsert = array('A_Name'=>$From_Name, 'A_Email'=>$From_Email, 'A_City'=>$From_City, 'A_City_Other'=>$From_City_Other, 'A_Mobile'=>$Mobile, 'A_Product'=>$Product, 'A_Company'=>$Company, 'A_Date'=>$Dated, 'A_Query_Type'=>$Product);
			$insert = Maininsertfunc ('Req_Agent', $dataInsert);
$SMSMessage="";

if($From_City=='Others' || strlen($From_City_Other)>0)
		{
			$Message2 = "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $From_Name,</b></font></td><td align='right' ><img src='http://www.deal4loans.com/images/logo.gif'/></td></tr><tr><td colspan='2'><p><font face='Verdana' size='2'>Thanks for registering with Deal4Loans.com; we have customers all over India who are willing to take loans.</font></p><p><font face='Verdana' size='2'>We would like to partner with you &amp; help you increase your business but currently we are not generating much leads from your city, as soon as we start getting leads from your city we will contact you immediately.</font></p><p><font face='Verdana' size='2'></p><tr><td><p><font face='Verdana' size='2'> <b>For further Query Email us at priyanka.sharma@deal4loans.com</font>  </p><p><font face='Verdana' size='2'><b>Regards</b><br>  Team <a href='www.deal4loans.com'>Deal4loans.com</a><br>Loans by Choice not by Chance! </font></p> <font face='Verdana' size='2'><b><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank'> Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'>Testimonials</a> | <a href='http://www.deal4loans.com/mediarelease.php' target='_blank'>Press Release</a></b></font></td><td width='40%'><p></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		
		}
		else {


	$Message2= "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $From_Name,</b></font></td><td align='right' ><img src='http://www.deal4loans.com/images/logo.gif'/></td></tr><tr><td colspan='2'><p><font face='Verdana' size='2'>Thanks for showing your interest in tying up with <b> Deal4Loans.com.</b> </p><p><font face='Verdana' size='2'>Deal4Loans.com can help you increase your loans business by providing you leads of interested and eligible customers. Partnering with d4l would save you from the troubles of :<ul><li> Searching new loan seekers </li><li> Scrubbing the database to avoid calling existing DNC Customers.</li></ul></font>  </p> <p><font face='Verdana' size='2'>We follow a <b>Cost per Lead (CPL)</b> model with a Pre-paid billing agreement. Your very own Deal4loans account will be activated upon receipt of payment from your end. </p><p>You can choose to buy a specific package based on the size of your business. We currently have 2 packages:<ul><li> Normal pack: 50 Leads </li><li> Century pack: 100 leads</li></ul> </p><tr><td><p><font face='Verdana' size='2'> <b>For further Query Email us at priyanka.sharma@deal4loans.com</font>  </p><p><font face='Verdana' size='2'><b>Regards</b><br>  Team <a href='www.deal4loans.com'>Deal4loans.com</a><br>Loans by Choice not by Chance! </font></p> <font face='Verdana' size='2'><b><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank'> Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank'>Testimonials</a> | <a href='http://www.deal4loans.com/mediarelease.php' target='_blank'>Press Release</a></b></font></td><td width='40%'><p>   <FIELDSET>   <LEGEND><FONT SIZE='3' color='#529BE4' face='Verdana' ><B>Testimonial</B></FONT></LEGEND><font face='Verdana' size='2'>   We are glad to say that this unique site, perhaps the only one of its kind, has helped us to get very valuable leads in sourcing good clients and expand our business<br><b>By M.Nalini Ezee Loans(Home loans)</b></font> </p>		</FIELDSET></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";

}
		$headers  = 'From: Deal4loans<no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($From_Email,'Welcome to Deal4loans - '.$From_Name, $Message2, $headers);
	
	echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";

if($From_City=='Delhi' || $From_City=='Noida' || $From_City=='Gaziabad' || $From_City=='Gurgaon' || $From_City=='Sahibabad' || $From_City=='Kolkata' ||  $From_City=='Chennai') 
	{
		$strmobile_no="9899405626";
	}
	elseif($From_City=='Mumbai' || $From_City=='Navi Mumbai' || $From_City=='Thane' || $From_City=='Ahmedabad' || $From_City=='Pune') 
	{
		$strmobile_no="9899492555";
	}
	elseif($From_City=='Bangalore' || $From_City=='Hyderabad')
	{
		$strmobile_no="9899278555";
	}
	else
			{
				$strmobile_no="9899492555";
			}

//echo "city".$From_City."<br>";
$SMSMessage=$SMSMessage."".$From_Name."(".$From_City.")-".$Mobile." ";
//echo "".$SMSMessage;
	if(strlen(trim($SMSMessage))>0)
	{
		if(strlen(trim($strmobile_no)) > 0)
		 SendSMS($SMSMessage, $strmobile_no);
		

	}
	//exit();
		}
	else
	{
			$_SESSION['Temp_Name'] = $From_Name  ;
			$_SESSION['Temp_mobile'] = $Mobile ;
			$_SESSION['Temp_email'] = $From_Email;
			$_SESSION['Temp_loan_type'] = $product_type ;
		if(strlen($product_type)>0)
		{
		echo "<script language=javascript>location.href='".getTransferURL($product_type)."?source=agent'"."</script>";
		}
		else
			{
			echo "<script language=javascript>location.href='index.php?source=agent'"."</script>";
		}


		}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<Script Language="JavaScript">
function HandleAgent2()
{
 myWindow = window.open("PlayEditor/agent(may09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}
function HandleAgent1()
{
 myWindow = window.open("PlayEditor/agent(march09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 

}


function HandleAgent3()
{
 myWindow = window.open("PlayEditor/agent(june09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 
}

function HandleAgent4()
{
 myWindow = window.open("PlayEditor/agent(oct10).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 
}


    </Script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
<span><a href="index.php">Home</a> >DSA's Speak Section</span>
<div id="txt">
<h1>DSA's Speak Section</h1>   

<div style="float:left;">
	        <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#F4F9FD">
          
			  <tr>
			  
                <td width="150" height="190" align="center" valign="top"><img src="images/rajesh-agent.jpg" width="150" height="189"></td>
                <td align="left" style="line-height:18px;"><a name="oct"></a>
                <p><b>Mr.Rajesh, DSA of the Month October 2010, </b>  has active association with Deal4Loans for sourcing Home Loan Leads since November’09 & disbursed 1 crore out of 150 leads. Mr. Rajesh is currently tied up with ICICI Bank Delhi. He has shared his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
He has sourced leads from Deal4loans.com through the prepaid model and the association has been profitable for him.
Here is the snippet of the conversation we had with him on Dated 12th Oct 2010
</p></td>
              </tr>
			   <tr><td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="middle" ><a onClick="HandleAgent4();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
              <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent4();"/></td>
            </tr>
          </table></td>
		  </tr>
			  
        </table> 
			 <p><font color="#0F74D4">Since when you are in a business of sourcing home Loan customers?</font><br>
<font style="color:#AC640A;">Rajesh Says:</font> From 2000</p>
			 <p><font color="#0F74D4">You are dealing in Home loans or other product also?</font><br>
<font style="color:#AC640A;">Rajesh Says:</font> I am dealing in Home Loan & Loan against property</p>
			 <p><font color="#0F74D4">You are associated with which bank?</font><br>
<font style="color:#AC640A;">Rajesh Says:</font> I am associated with ICICI Bank since inception and recently started working with Kotak bank as well. </p>
	    <p><font color="#0F74D4">How much volume do you disburse with ICICI Bank?</font> <br>
<font style="color:#AC640A;">Rajesh Says:</font> Around 15 Cr. every month<br>
<br>

<font color="#0F74D4">What are the other sources through which you generate business?</font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
Referrals business <br>
<br>

<font color="#0F74D4">How you came to know about deal4loans? </font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
	I had applied on the Internet on your site and then received a call from your representative.<br>
<br>

<font color="#0F74D4">How has Deal4Loans helped you in the growth of your business?</font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
Quality of leads is really good but due to some policy norms in ICICI Bank the conversion was not as desired. The properties selected by your customers were not listed with ICICI so we were not able to service them. But overall the customers are genuine. <br>
<br>

<font color="#0F74D4">How much Deal4loans.com has contributed to your business?</font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
I have taken 3 package from deal4loans.com and matured <b>4 leads</b> and disbursed More <b>Than 1 Crore</b> from deal4loans.com leads <br>
<br>

<font color="#0F74D4">What is the normal turn around time for deal4loans.com leads?</font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
Customers who want home loan with ICICI Bank than they will convert in <b>2-3 days</b>.<br>
<br>

<font color="#0F74D4">What is the main advantage in ICICI Bank? </font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
Our bank is transparent, no hidden charges, communication is better and customer get quality service from application till disbursement.<br>
<br>

<font color="#0F74D4">Did you had any apprehensions about pre-paid model which Deal4Loans team follows for offering their services to DSAs? </font> <br>
<font style="color:#AC640A;">Rajesh Says:</font>
No I didn’t had any issue and will give you 2-3 references who want to get associated with deal4loans.com<br>
<br>

We at deal4loans.com work closely with each of our DSAs to make sure that it is a win–win situation for all. The success of <b>Mr. Rajesh</b> association proves that lead sourcing from Deal4loans.com is a good move for small and large DSAs.</p>

	         </td>
     </tr>
      </table></div>
<!--<div style="float:left;">
	        <table width="535"  border="0" cellpadding="0" cellspacing="0" bgcolor="#F4F9FD">
              <tr>
			  <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
			  </tr>
			  <tr>
			  
                <td width="150" height="190" align="center" valign="top"><img src="images/agent-prthima.jpg" width="150" height="190"></td>
                <td align="left" style="line-height:18px;"><a name="june"></a>
                <p><b>Ms Prathima, DSA of the Month, June </b>  has active association with Deal4Loans for sourcing Personal Loan Leads since Dec ’08 and has disbursed maximum loan amounting Rs.40 Lacs in a month from Deal4loans leads. Ms Prathima is currently tied up with HDFC Bank Bangalore. She has shared her experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
                <br>
Here is the snippet of the conversation we had with him on Dated 8th June 09: 
</p></td>
              </tr>
			   <tr><td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="middle" ><a onClick="HandleAgent3();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
              <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent3();"/></td>
            </tr>
          </table></td>
		  </tr>
			  
        </table> 
			 <p><font color="#0F74D4">First of all, we would like to know since when you are in the same industry of sourcing Personal Loan customers?</font><br>
<font style="color:#AC640A;">Prathima says: </font>I am there in Personal Loan business from past 6 years, with a team size of 11 people.</p>
			 <p><font color="#0F74D4">What is the major source of generating business?</font><br>
<font style="color:#AC640A;">Prathima says:</font>Major source is Deal4loans and other is Paper Insertions</p>
		
			 <p><font color="#0F74D4">Prior association with Deal4loans, what was the source of business generation?</font><br>
<font style="color:#AC640A;">Prathima says:</font> Earlier I had tie up with other lead aggregators. But due to some problem was unable to carry the association further and had discontinued availing their services.</p>

	    <p><font color="#0F74D4">As you are associated with Deal4loans for last 7 months, so what was the maximum loan amount you had disbursed in a month and how much Deal4loans has contributed to it?</font> <br>
<font style="color:#AC640A;">Prathima says:</font> In one month able to disburse to highest loan amounting Rs.65 lacs. The contribution of Deal4loans was 40 lacs out of 100 leads plus prior follow up with Deal4loans customers.<br>
<br>

<font color="#0F74D4">What process exactly you follow to convert Deal4loans customers?</font> <br>
<font style="color:#AC640A;">Prathima says:</font>
Rigorous follow up and passing on correct information to the customer is the ‘Mantra’ to get the customer ‘In’<br>
</p>
	    <p><font color="#0F74D4">Is the concept of Real Time sharing of leads by Deal4loans helpful for you and in what manner?</font> <br>
          <font style="color:#AC640A;">Prathima says:</font>
		   In a competitive world, you have to be on your toes to reach the customers as there are multiple banks in the market. It is difficult to convince the costumer after he gets the information from other banks as customer requires instant services. So the concept of real time allocation is really helpful. <br>
          <b>"The quicker you serve, the better customer  you'll get."</b></p>
	    <p><font color="#0F74D4">What you think, will the Personal Loan industry will revive again or not?</font> <br>
          <font style="color:#AC640A;">Prathima says:</font> Of course yes. There was the boom of Personal Loans a way back in 2007-2008, so there are the chances that Personal Loan industry will revive again sometime later but not near in future.<br>
          <br>
         We at Deal4loans.com works closely with each of over DSA’s to make sure that it is a win - win situation for all. The success of <b>Ms Prathima</b> association proves that lead sourcing from Deal4loans.com is a good move for small and large DSA’s.</p>
	
	    </td>
     </tr>
      </table></div> -->
	  
<div style="float:left;">
	        <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#F4F9FD">
          
			  <tr>
			  
                <td width="150" height="190" align="center" valign="top"><img src="images/mohit-agent.jpg" width="150" height="190"></td>
                <td align="left" style="line-height:18px;"><a name="aprl"></a>
                <p><b>Mr. Mohit Gokhale, DSA of the Month, April </b>  has active association with Deal4Loans for sourcing Home Loan Leads since Mar’09 & has converted maximum no. of leads in short span. Mr Mohit is currently tied up with LICHFL Mumbai. He has shared his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
He has sourced leads from Deal4loans.com through the prepaid model and the association has been profitable for him.<br>
Here is the snippet of the conversation we had with him on Dated 28th April 09: 
</p></td>
              </tr>
			   <tr><td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="middle" ><a onClick="HandleAgent2();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
              <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent2();"/></td>
            </tr>
          </table></td>
		  </tr>
			  
        </table> 
			 <p><font color="#0F74D4">Since when you are in a business of sourcing Home Loan customers?</font><br>
<font style="color:#AC640A;">Mohit Says:</font> For last 10 years I am sourcing home loan customers. Initially I was associated with PNB & since 2002 with LICHFL.</p>
			 <p><font color="#0F74D4">How does LICHFL as a brand helps you in getting conversions?</font><br>
<font style="color:#AC640A;">Mohit Says:</font> In recent years, LICHFL branding initiatives has helped us in gaining more conversion. Also, average ticket-size has increased from 5 Lacs to 25 Lacs</p>
			 <p><font color="#0F74D4">How Deal4Loans leads have been performing for you.</font><br>
<font style="color:#AC640A;">Mohit Says:</font> Lead Quality is upto the filters I had asked. I am able to disburse file amounting Rs.1.5 crore out of 50 leads allocated & other couple of files are in a process amounting Rs.2 crore. </p>
	    <p><font color="#0F74D4">What are the other sources through which you generate business?</font> <br>
<font style="color:#AC640A;">Mohit Says:</font> Builder Tie-ups & Referrals<br>
<br>

<font color="#0F74D4">Did you had any apprehensions about pre-paid model which Deal4Loans team follows for offering their services to DSAs?</font> <br>
<font style="color:#AC640A;">Mohit Says:</font>
Yes, initially I had concerns with the model as there was no representative in the city but later with rigorous follow up & reasonable solution by account manager I was convinced to make the payments.<br>
<br>

We at deal4loans.com work closely with each of our dsa s to make sure that it is a win –win situation for all. The success of <b>Mr Mohit</b> association proves that lead sourcing from Deal4loans.com is a good move for small and large Dsa's.</p>

	         </td>
     </tr>
      </table></div>

  	<div style="float:left;">
	        <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#F4F9FD">
             
                           <tr>
                <td width="150" height="186" align="center" valign="top"><img src="images/agent-pic.jpg" width="150" height="189"></td>
                <td align="left" style="line-height:18px;"><a name="mrch"></a>
				<p><b>Mr.Anil Yadav, DSA of the Month, March </b> has active association with Deal4Loans for sourcing Home Loan Leads since July’08.Mr Anil is currently tied up with Mumbai branch of Hdfc ltd. He has shared  his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
He has sourced more than <b>500 leads from Deal4loans.com in the prepaid model</b>  and the association has been profitable for him .<br>
Here is the snippet of the conversation we had with him on Dated 13th Mar 09: 
</p></td>
              </tr>
			  <tr><td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="middle" ><a onClick="HandleAgent1();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
              <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent1();"/></td>
            </tr>
          </table></td>
		  </tr>
        </table> 
			 <p><font color="#0F74D4">We would like to know since when you are in a business of sourcing Home Loan customers? </font><br>
<font style="color:#AC640A;">Anil Says:</font> I have been in Home Loans business since last 11 years. I started with ICICI bank & for last six years I am with HDFC Ltd.</p>
			 <p><font color="#0F74D4">Which is the major source you generate your business through? </font><br>
<font style="color:#AC640A;">Anil Says:</font> Major business comes through Builder & Real-Estate tie-ups, references & leads.</p>
			 <p><font color="#0F74D4">How has been your experience with Deal4loans leads? </font><br>
<font style="color:#AC640A;">Anil Says:</font> Initially, leads quality was low but with rigorous follow up by the account manager things stream-lined & now the lead quality is good & delivering up to my expectations. Out of 50 leads I am able to convert 30-35 leads on a monthly basis.</p>
			 <p><font color="#0F74D4">Rate response  of customers through various medium i.e. Newspaper,  Radio, SMS & Internet?</font> <br>
<font style="color:#AC640A;">Anil Says:</font><br>
&nbsp;&nbsp;&nbsp;&nbsp;1) SMS<br>
&nbsp;&nbsp;&nbsp;&nbsp;2) Newspaper<br>
&nbsp;&nbsp;&nbsp;&nbsp;3) Radio<br>
&nbsp;&nbsp;&nbsp;&nbsp;4) Internet
</p>
	  <p><font color="#0F74D4">What is the key to success for  Deal4loans Leads?</font> <br>
<font style="color:#AC640A;">Anil Says:</font>
Follow up is the Mantra. Call the customer on the exact date & time as asked.
-Offer customized solutions as rates is not the key factor service & other factors like eligibility, turn around time etc., matters.</p>
	  <p><font color="#0F74D4">What is the USP of HDFC Home Loans?</font> <br>
<font style="color:#AC640A;">Anil Says:</font>
HDFC offer customized services to customers.
<br>
<br>
We at deal4loans.com work closely with each of our dsa s to make sure that it is a win –win situation for all. The success of <b>Mr Anil</b> association proves that lead sourcing from Deal4loans.com is a good move for small and large Dsa's.</p>

	         </td>
     </tr>
      </table></div>
  	
 	 <div align="right"><a class="blue-text" style="font-weight: normal; font-size: 11px;" href="#top">Top <img width="12" height="18" border="0" src="images/top.gif"/></a>
</div> 
   
    </div>
	</div>
</div>
<?php include '~Right-Agent.php';?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>