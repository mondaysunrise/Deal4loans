<?php
	header("Location: home-loans-interest-rates.php");
	require 'scripts/functions.php';
	
	?>
<html>
<head>

<title>Home loan interest rates Comparison Chart | Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Best Home Loan Rates, Best Interest Rates, Home loans, Home loan, Home loans India, Home loan in India, Home loan interest rates,  Home loan rates in India, Home finance loans, compare Home loan rates, Home loans at least interest rate">
<meta name="Description" content="Complete Personal Loan interest rate chart. Compare Home loan interest rates from Allahabad Bank, AXIS Bank , Barclays Bank, Corporation Bank, Dena Bank, DHFL HFC, Deutsche Post, Federal Bank, HDFC, ICICI Home Finance, Bank of Baroda, IDBI Bank, ING VYSYA, Oriental Bank of Commerce, Kotak, LIC housing, Punjab National Bank, Standard Chartered, SBI, Union Bank of India, Vijaya Bank.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<style type="text/css">

#topbar{
position:absolute;
margin: 502px 0px 0px 155px ;
padding: 4px ;
background-color: #E8F0F6;
width: 620px;
visibility: hidden;
}

.tbletext
{

	font-family:verdana, Helvetica, sans-serif;
	text-align:center;
	font-size:11px;
	color:#181A13;
	margin:2px;
}

</style>
<script src="scripts/scroller1.js" type="text/javascript"></script>

<?php include '~Top.php';?>
<div id="dvMainbanner">
    <?php include '~Upper.php';?>
   
                    <div id="dvbannerContainer"><?php include 'header_hl.php';?></div>

  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent" style="margin-top:0px;">
	     <?php if(isset($_SESSION['UserType']))
	{?>
	   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td>
<? }?>   
	  
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
      
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  valign="top" align="center"> <H1 class="head2" align="center">Interest Rates for Home Loans</H1><font face="Verdana" size="2" color="#0F74D4">( Last edited on : <? echo $currentdate; ?> )</font>  
      <p>Buying your first home can seem intimidating, especially when faced 
            with many different loan types. Don't worry. Use this list to compare 
            and narrow down the choices to know which is the best.
</p> 
<p>To help its customers get the best interest rates on <a href="home-loans.php">home loans</a> deal4loans has consolidated all the information regarding current rate of interest for all the banks at one place. Please keep visiting this section to check updated rate of interest for home loans.</p></td>
    <td width="237" align="right" valign="top"><? if(!isset($_SESSION['UserType'])) 
  {
  include 'right-interestrate.php';
  }
  ?><br>
</td>
  </tr>
  <tr>
    <td colspan="2"><!--<div id="topbar">
<table width="684"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="415" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF" >
      <tr>
        <td colspan="7" align="center" valign="top" bgcolor="#E8F0F6" class="tbletext"><b>Floating Rate</b></td>
      </tr>
      <tr bgcolor="#FFFFFF" >
        <td height="17" align="center" bgcolor="#E8F0F6"  class="tbletext">Below 15    lac</td>
        <td align="center" bgcolor="#E8F0F6" class="tbletext">Between 15lacs to 20lacs</td>
        <td align="center" bgcolor="#E8F0F6" class="tbletext">Between 20lacs to 30lacs</td>
        <td align="center" bgcolor="#E8F0F6" class="tbletext">Above 30lacs</td>
        <td align="center" bgcolor="#E8F0F6" class="tbletext">Above 70lacs</td>
        <td align="center" bgcolor="#E8F0F6" class="tbletext">Below 1crore</td>
        <td align="center" bgcolor="#E8F0F6" class="tbletext">Above 1crore</td>
      </tr>
    </table></td>
	<td align="center" bgcolor="#E8F0F6" class="tbletext" width="118"><b>Processing
 Fees</b></td>
	<td bgcolor="#FFFFFF" width="2"></td>
    <td align="center" bgcolor="#E8F0F6" class="tbletext" width="152"><b>Pre-
Closure 
Charges</b></td>
  </tr>
</table>
</div>
<table width="760"   border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF" >
               <tr>
                 <td width="79" height="40" bgcolor="#E8F0F6" class="tbletext"><b>Bank    Name</b></td>
                 <td width="119" bgcolor="#E8F0F6" class="tbletext" ><b>Tenure</b></td>
                 <td width="79" bgcolor="#E8F0F6" class="tbletext" ><b>Upto 
                   20lacs</b></td>
                 <td width="93" bgcolor="#E8F0F6"  class="tbletext" ><b>Upto 30lacs</b></td>
                 <td width="94" bgcolor="#E8F0F6" class="tbletext" ><b>Above 30lacs<br>
                 to 75lacs</b></td>
                 <td width="91" bgcolor="#E8F0F6" class="tbletext" ><b>Above 75lacs<br />
                   to 
                 1.5crores</b></td>
                 <td width="83" bgcolor="#E8F0F6" class="tbletext" ><b>Prepayment <br>
                 Charges</b></td>
                 <td width="104" bgcolor="#E8F0F6" class="tbletext" ><b>Processing<br />
                 Fee</b></td>
               </tr>
          </table>-->
	    <table width="760"   border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
	      <tr bgcolor="#E8F0F6">
	        <td height="40" align="center" valign="middle" class="tbletext"><b>Bank Name </b></td>
            <td align="center" ><b>Tenure</b></td>
            <td align="center" class="tbletext"><b>Upto 
              20lacs</b></td>
            <td align="center" class="tbletext"><b>Upto 30lacs</b></td>
            <td align="center" class="tbletext"><b>Above 30lacs<br>
              to 75lacs</b></td>
            <td align="center" class="tbletext"><b>Above 75lacs<br />
              to 
              1.5crores</b></td>
            <td align="center" class="tbletext"><b>Prepayment<br>
              Charges</b></td>
            <td align="center" class="tbletext"><b>Processing<br />
              Fee</b></td>
   	       </tr>
	      <tr bgcolor="#F6F4ED">
	        <td width="80"  rowspan="5" align="center" valign="middle" class="tbletext"><b>Allahabad Bank
	          </b></td>
   	          <td width="120" height="30" align="center" bgcolor="#F6F4ED" class="tbletext"><b>upto 5yrs</b></td>
   	          <td width="79" height="30" align="center" class="tbletext">9.25%</td>
   	          <td width="91" align="center" class="tbletext">9.25%</td>
   	          <td align="center" class="tbletext">9.75%</td>
   	          <td align="center" class="tbletext">9.75%</td>
   	          <td width="85" rowspan="5" align="center" class="tbletext">2%</td>
   	          <td rowspan="5" align="center" class="tbletext">0.5% of loan amount or Rs.10,000 whichever is higher</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#F6F4ED" ><b>5yrs to 10yrs</b> </td>
   	          <td  align="center" class="tbletext">9.75%</td>
   	          <td align="center" class="tbletext">9.75%</td>
   	          <td align="center" class="tbletext">10.25%</td>
   	          <td align="center" class="tbletext">10.25%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#F6F4ED" ><b>10yrs to 15yrs</b></td>
   	          <td height="30" align="center" class="tbletext">10%</td>
   	          <td align="center" class="tbletext">10%</td>
   	          <td align="center" class="tbletext">10.50%</td>
   	          <td align="center" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#F6F4ED" ><b>15yrs to 20yrs</b></td>
   	          <td height="30" align="center" class="tbletext">10.25</td>
   	          <td align="center" class="tbletext">10.25%</td>
   	          <td align="center" class="tbletext">10.75%</td>
   	          <td align="center" class="tbletext">10.75%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#F6F4ED"  ><b>20yrs to 25yrs</b></td>
   	          <td height="30" align="center" class="tbletext">10.25%</td>
   	          <td align="center" class="tbletext">10.25%</td>
   	          <td align="center" class="tbletext">10.75%</td>
   	          <td align="center" class="tbletext">10.75%</td>
            </tr>
	      
	      <tr bgcolor="#EFEEEE">
	        <td height="40" align="center" valign="middle" bgcolor="#EFEEEE" class="tbletext"><b>AXIS Bank </b></td>
            <td align="center" class="tbletext">-</td>
            <td align="center" class="tbletext">9%</td>
            <td align="center" bgcolor="#EFEEEE" class="tbletext">9%</td>
            <td align="center" class="tbletext">9.50%</td>
            <td align="center" class="tbletext">9.50%</td>
            <td align="center" class="tbletext">-</td>
            <td align="center" class="tbletext">0.50%</td>
   	       </tr>
	      
	      <tr bgcolor="#F6F4ED">
	        <td height="40" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext" ><b>Barclays Bank </b></td>
              <td align="center" bgcolor="#F6F4ED" class="tbletext">-</td>
              <td height="48" align="center" bgcolor="#F6F4ED" class="tbletext">10%</td>
              <td align="center" class="tbletext">10.50%</td>
              <td align="center" class="tbletext">10.50%</td>
              <td align="center" class="tbletext">-</td>
              <td align="center" class="tbletext">2%</td>
              <td align="center" class="tbletext">0.25%</td>
      </tr>
	      
	      
	      <tr bgcolor="#EFEEEE">
	        <td rowspan="6" align="center" valign="middle" bgcolor="#EFEEEE" class="tbletext"><b>Bank of<br> 
	          Baroda</b> </td>
              <td height="35" colspan="5" align="center" bgcolor="#EFEEEE" class="tbletext"><b style="color:#013972;">Special Rate of Interest for 20yrs tenure till June'09<br>
              8.50%(upto 5lacs) & 9.25%( above 5 lacs & upto 20lacs)</b></td>
              <td rowspan="6" align="center" bgcolor="#EFEEEE" class="tbletext">2%</td>
              <td rowspan="6" align="center" bgcolor="#EFEEEE" class="tbletext">-</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td align="center" bgcolor="#EFEEEE" class="tbletext"><b>upto 5yrs</b></td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">8%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">8%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">-</td>
              <td bgcolor="#EFEEEE" class="tbletext">9.75%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td align="center" bgcolor="#EFEEEE" ><b>5yrs to 10yrs</b></td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">8.75%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">8.75%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">-</td>
              <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td align="center" bgcolor="#EFEEEE" class="style1">10yrs to 15yrs</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">8.75%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">8.75%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">-</td>
              <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td align="center" bgcolor="#EFEEEE" class="style1">15yrs to 20yrs</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">9%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">9%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">-</td>
              <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td align="center" bgcolor="#EFEEEE" class="style1">20yrs to 25yrs</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">9%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">9%</td>
              <td height="29" bgcolor="#EFEEEE" class="tbletext">-</td>
              <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
            </tr>
	      
	      <tr bgcolor="#F6F4ED">
	        <td rowspan="5" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>Corporation<br> 
	          Bank</b></td>
              <td align="center" class="tbletext"><b>upto 5yrs</b></td>
              <td height="29" align="center" class="tbletext">8.75%</td>
              <td align="center" class="tbletext">9.50%</td>
              <td align="center" class="tbletext">10%</td>
              <td align="center" class="tbletext">10%</td>
              <td rowspan="5" align="center" bgcolor="#F6F4ED" class="tbletext">0.5% -  3%</td>
              <td rowspan="5" align="center" bgcolor="#F6F4ED" class="tbletext" >0.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" class="style1">5yrs to 10yrs </td>
              <td height="29" align="center" class="tbletext">9.50%</td>
              <td align="center" class="tbletext">10%</td>
              <td align="center" class="tbletext">10.50%</td>
              <td align="center" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" class="style1">10yrs to 15yrs</td>
              <td height="29" align="center" class="tbletext">9.50%</td>
              <td align="center" class="tbletext">10%</td>
              <td align="center" class="tbletext">10.50%</td>
              <td align="center" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" class="style1">15yrs to 20yrs</td>
              <td height="29" align="center" class="tbletext">9.75%</td>
              <td align="center" class="tbletext">10.50%</td>
              <td align="center" class="tbletext">10.75%</td>
              <td align="center" class="tbletext">10.75%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" class="style1">20yrs to 25yrs</td>
              <td height="29" align="center" class="tbletext">10.25%</td>
              <td align="center" class="tbletext">10.75%</td>
              <td align="center" class="tbletext">11%</td>
              <td align="center" class="tbletext">11%</td>
            </tr>
	      
	      <tr bgcolor="#EFEEEE">
	        <td height="40" align="center" valign="middle" class="tbletext"><b>Dena Bank </b></td>
            <td align="center" class="tbletext">&nbsp;</td>
            <td height="29" align="center" class="tbletext">11.75%</td>
            <td height="29" align="center" class="tbletext">11.75%</td>
            <td height="29" align="center" class="tbletext">11.75%</td>
            <td align="center" class="tbletext">-</td>
            <td align="center" class="tbletext">2%</td>
            <td align="center" class="tbletext">0.50%</td>
	      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td rowspan="4" align="center" valign="middle" class="tbletext"><b>DHFL HFC</b></td>
	        <td height="17" colspan="4" align="center" bgcolor="#F6F4ED" class="tbletext" ><b>Salaried</b></td>
	        <td rowspan="4" align="center" class="tbletext">-</td>
	        <td rowspan="4" align="center" class="tbletext">5%(upto 5<br> 
	          years),	      2%<br>
	          (above 5 years),<br>
	          If balance<br>
	          transfer 5%</td>
	        <td rowspan="4" align="center" class="tbletext">1%</td>
      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td class="tbletext">&nbsp;</td>
	        <td height="17" class="tbletext">9.75%</td>
	        <td class="tbletext">9.75%</td>
	        <td class="tbletext">10.75%</td>
      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="17" colspan="4" class="tbletext" ><b>Self employed</b></td>
      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td class="tbletext">&nbsp;</td>
	        <td height="17" class="tbletext">12.25%</td>
	        <td height="17" class="tbletext">12.25%</td>
	        <td height="17" class="tbletext">12.25%</td>
		    </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="62" align="center" valign="middle" class="tbletext"><b>Deutsche <br>
	          Post </b></td>
            <td height="62" colspan="5" align="center" class="tbletext">10.50%- 11% (up to 75% of funding),<br> 
              11% - 11.50% (above 75% - 80% of funding)</td>
            <td align="center" class="tbletext">2%-4%</td>
            <td align="center" class="tbletext">
			Lower of 0.5% <br>
			or Rs.10,000/ + <br>
			Taxes 0.5% + Taxes</td>
	      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="40" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>Federal Bank </b></td>
            <td align="center" class="tbletext">&nbsp;</td>
            <td height="30" align="center" class="tbletext">11%</td>
              <td height="30" align="center" class="tbletext">11%</td>
    
        <td height="30" align="center" class="tbletext">11%</td>
    
        <td align="center" class="tbletext">-</td>
            <td align="center" class="tbletext">2%</td>
            <td align="center" class="tbletext">0.50%</td>
          </tr>
	      <!--<tr bgcolor="#F6F4ED">
	    <td height="35" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>DHFL</b></td>
	    <td height="30" align="center" class="tbletext">N.A
</td>
	    <td height="30" align="center" class="tbletext">For Salaried 9.75%(below15 lacs) & 10.75%(above 15 lacs),For Self Employed: 10.75%(below 15 lacs)</td>
	    <td align="center" class="tbletext">0.50%
</td>
	    <td align="center" class="tbletext">2%
</td>
	    <td align="center" class="tbletext">-</td>
	    <td align="center" class="tbletext">-</td>
	    </tr>-->
	      <tr bgcolor="#EFEEEE">
	        <td rowspan="4" align="center" valign="middle" bgcolor="#EFEEEE" class="tbletext"><b>HDFC Ltd. </b></td>
	         <td colspan="4" align="center" bgcolor="#EFEEEE" class="tbletext" ><b>Salaried & Self Employed Professional </b></td>
	         <td align="center" bgcolor="#EFEEEE" class="tbletext">-</td>
	         <td rowspan="4" align="center" bgcolor="#EFEEEE" class="tbletext">If 25% of<br> 
	           outstanding<br> 
	           amount is <br>
	           paid every 
	           <br>
	           year till 3 <br>
	           years 
	           - No <br>
	           penalty, <br>
	           otherwise 
	           <br>
	           2% of <br>
	           outstanding<br> 
              amount</td>
	         <td rowspan="4" align="center" bgcolor="#EFEEEE" class="tbletext">Rs.10,000/- <br>
	           or 0.5% of <br>
	           loan amount<br>
	           (whichever is <br>
	           lesser) + <br>
              Service Tax</td>
      </tr>
	      <tr bgcolor="#EFEEEE">
	        <td bgcolor="#EFEEEE" class="tbletext">&nbsp;</td>
	         <td bgcolor="#EFEEEE" class="tbletext">9.25%</td>
	         <td height="17" bgcolor="#EFEEEE" class="tbletext">9.25%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">9.50% - 10.50% </td>
	         <td bgcolor="#EFEEEE" class="tbletext">-</td>
      </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="17" colspan="4" bgcolor="#EFEEEE" class="tbletext" ><b>For Self Employed</b></td>
	         <td bgcolor="#EFEEEE" class="tbletext">-</td>
      </tr>
	      <tr bgcolor="#EFEEEE">
	        <td bgcolor="#EFEEEE" class="tbletext">&nbsp;</td>
	         <td height="17" bgcolor="#EFEEEE" class="tbletext">-</td>
	         <td bgcolor="#EFEEEE" class="tbletext">9.75%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.75%</td>
            <td bgcolor="#EFEEEE" class="tbletext">-</td>
           </tr>
	      
	      <tr bgcolor="#F6F4ED">
	        <td height="39" align="center" valign="middle" class="tbletext"><b>ICICI Home<br> 
	          Finance</b> </td>
	        <td align="center" class="tbletext">&nbsp;</td>
	        <td height="39" align="center" class="tbletext">9.25%</td>
	        <td align="center" class="tbletext">9.25% - 9.50%<br></td>
	        <td align="center" class="tbletext">9.75%</td>
	        <td align="center" class="tbletext">9.75% - 10%</td>
	        <td align="center" class="tbletext">2% (Full<br> 
	          payment) 
	          <br>
	          No Penalty    <br>
	          (Part <br>
	          Payment)</td>
	        <td align="center" class="tbletext">0.50%</td>
	      </tr>
	      
	      <tr bgcolor="#EFEEEE">
	        <td height="43" align="center" valign="middle" class="tbletext"><b>IDBI Bank </b></td>
            <td align="center" class="tbletext">&nbsp;</td>
            <td height="43" align="center" class="tbletext">9.25%</td>
            <td align="center" class="tbletext">9.25%</td>
            <td align="center" class="tbletext">9.75%</td>
            <td align="center" class="tbletext">-</td>
            <td align="center" class="tbletext">-</td>
            <td align="center" class="tbletext">10,000 (upto 20 lacs)</td>
	       </tr>
	      
	      <tr bgcolor="#F6F4ED">
	        <td height="35" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>ING VYSYA </b></td>
	        <td align="center" class="tbletext">&nbsp;</td>
	        <td height="35" align="center" class="tbletext">9.25%</td>
	        <td align="center" class="tbletext">9.75%</td>
	        <td align="center" class="tbletext">10.75%</td>
	        <td align="center" class="tbletext">-</td>
	        <td align="center" class="tbletext">2%</td>
	        <td align="center" class="tbletext">0.5% of Loan    amount +<br> 
	          Rs.500 + <br>
	          Service Tax<br>
	          (10.30%)</td>
	      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td rowspan="6" align="center" valign="middle" bgcolor="#EFEEEE" class="tbletext"><b>Oriental Bank<br> 
	          of Commerce </b></td>
	        <td height="35" colspan="5" align="center" bgcolor="#EFEEEE" class="tbletext"><b style="color:#013972;">Special Rate of Interest for 20yrs tenure till June'09<br>
	          8.50%(upto 5lacs) & 9.25%( above 5 lacs & upto 20lacs)</b></td>
	        <td rowspan="6" align="center" bgcolor="#EFEEEE" class="tbletext">2% of <br>
	          outstanding<br> 
	          balance</td>
	        <td rowspan="6" align="center" bgcolor="#EFEEEE" class="tbletext"> 0.50% of loan<br> 
	          amount <br>
	          maximum <br>
	          Rs. 12,500/- </td>
	        </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" bgcolor="#EFEEEE" class="tbletext"><b>upto 5yrs</b></td>
	        <td height="35" bgcolor="#EFEEEE" class="tbletext">-</td>
	        <td bgcolor="#EFEEEE" class="tbletext">-</td>
	        <td bgcolor="#EFEEEE" class="tbletext">-</td>
	        <td bgcolor="#EFEEEE" class="tbletext">-</td>
	        </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" bgcolor="#EFEEEE" class="style1">5yrs to 10yrs </td>
	        <td height="35" bgcolor="#EFEEEE" class="tbletext">9.25%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">9.75%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
	        </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" bgcolor="#EFEEEE" class="style1">10yrs to 15yrs</td>
	        <td height="35" bgcolor="#EFEEEE" class="tbletext">9.50%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	        </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" bgcolor="#EFEEEE" class="style1">15yrs to 20yrs</td>
	        <td height="35" bgcolor="#EFEEEE" class="tbletext">9.50%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	        </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" bgcolor="#EFEEEE" class="style1">20yrs to 25yrs</td>
	        <td height="35" bgcolor="#EFEEEE" class="tbletext">9.50%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	        <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	        </tr>
	      
	      
	      <tr bgcolor="#EFEEEE">
	        <td rowspan="4" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>Kotak</b></td>
	        <td colspan="4" align="center" bgcolor="#F6F4ED" class="tbletext" ><b>Salaried  </b></td>
	        <td align="center" bgcolor="#F6F4ED" class="tbletext">&nbsp;</td>
	        <td rowspan="4" align="center" bgcolor="#F6F4ED" class="tbletext">2%</td>
	        <td rowspan="4" align="center" bgcolor="#F6F4ED" class="tbletext">0.50%</td>
      </tr>
	      <tr bgcolor="#EFEEEE">
	        <td bgcolor="#F6F4ED" class="tbletext">&nbsp;</td>
	        <td height="17" bgcolor="#F6F4ED" class="tbletext">10.75%</td>
	          <td height="17" bgcolor="#F6F4ED" class="tbletext">10.75%</td>
			          <td height="17" bgcolor="#F6F4ED" class="tbletext">10.75%</td>
	        <td bgcolor="#F6F4ED" class="tbletext">-</td>
      </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="17" colspan="4" bgcolor="#F6F4ED" class="tbletext" ><b>Self Employed</b></td>
	        <td bgcolor="#F6F4ED" class="tbletext">&nbsp;</td>
      </tr>
	      <tr bgcolor="#EFEEEE">
	        <td  bgcolor="#F6F4ED" class="tbletext">&nbsp;</td>
	        <td height="17"  bgcolor="#F6F4ED" class="tbletext">11%</td>
	          <td height="17"  bgcolor="#F6F4ED" class="tbletext">11%</td>
			          <td height="17"  bgcolor="#F6F4ED" class="tbletext">11%</td>
	        <td bgcolor="#F6F4ED" class="tbletext">-</td>
          </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="40" class="tbletext" ><b>LIC</b></td>
	        <td align="center" class="tbletext">&nbsp;</td>
	        <td align="center" class="tbletext">8.75%</td>
	        <td align="center" class="tbletext">8.75%</td>
	        <td align="center" class="tbletext">9.75%</td>
	        <td align="center" class="tbletext">10.75%</td>
	        <td align="center" class="tbletext">2%</td>
	        <td align="center" class="tbletext">1%</td>
      </tr>
	      
	      <tr bgcolor="#EFEEEE">
	        <td rowspan="5" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>Punjab<br> 
	          National Bank </b></td>
	         <td height="51" align="center" bgcolor="#F6F4ED" class="tbletext"><b>upto 5yrs</b></td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">-</td>
	         <td width="95" height="51" rowspan="5" align="center" bgcolor="#F6F4ED" class="tbletext">-</td>
	         <td width="97" rowspan="5" align="center" bgcolor="#F6F4ED" class="tbletext">-</td>
	         <td width="85" rowspan="5" align="center" bgcolor="#F6F4ED" class="tbletext">2.50%</td>
	         <td width="95" rowspan="5" align="center" bgcolor="#F6F4ED" class="tbletext">0.50%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="30" align="center" bgcolor="#F6F4ED" ><b>5yrs to 10yrs</b> </td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9.25%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9.75%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="30" align="center" bgcolor="#F6F4ED"><b>10yrs to 15yrs</b></td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9.50%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">10%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="30" align="center" bgcolor="#F6F4ED"  ><b>15yrs to 20yrs</b></td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9.50%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">10%</td>
            </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="30" align="center" bgcolor="#F6F4ED" ><b>20yrs to 25yrs</b></td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9.50%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">10.25%</td>
            </tr>
	      
	      
	      <tr bgcolor="#F6F4ED">
	        <td rowspan="6" align="center" valign="middle" bgcolor="#EFEEEE" class="tbletext"><b>SBI</b></td>
	         <td height="30" colspan="5" align="center" bgcolor="#EFEEEE" class="tbletext"><b style="color:#013972;">Special Rate of Interest-8% for 1 Year</b></td>
	         <td rowspan="6" align="center" bgcolor="#EFEEEE" class="tbletext">2%</td>
	         <td rowspan="6" align="center" bgcolor="#EFEEEE" class="tbletext">1%</td>
      </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#EFEEEE" class="tbletext"><b>upto 5yrs</b></td>
	         <td height="30" bgcolor="#EFEEEE" class="tbletext">9.25%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">9.75%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#EFEEEE" ><b>5yrs to 10yrs </b></td>
	         <td height="30" bgcolor="#EFEEEE" class="tbletext">-</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#EFEEEE" ><b>10yrs to 15yrs</b></td>
	         <td height="30" bgcolor="#EFEEEE" class="tbletext">-</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#EFEEEE" ><b>15yrs to 20yrs</b></td>
	         <td height="30" bgcolor="#EFEEEE" class="tbletext">-</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.75%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">11%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td height="30" align="center" bgcolor="#EFEEEE"  ><b>20yrs to 25yrs</b></td>
	         <td height="30" bgcolor="#EFEEEE" class="tbletext">-</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.25%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">10.75%</td>
	         <td bgcolor="#EFEEEE" class="tbletext">11%</td>
            </tr>
	      
	      <tr bgcolor="#F6F4ED">
	        <td height="40" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>Standard<br> 
	          Chartered         </b></td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">&nbsp;</td>
	         <td height="30" align="center" bgcolor="#F6F4ED" class="tbletext">9.50% - 10%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">9.50% - 10%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">-</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">-</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">2%</td>
	         <td align="center" bgcolor="#F6F4ED" class="tbletext">0.25% - 0.50%&nbsp;</td>
	       </tr>
	      <tr bgcolor="#EFEEEE">
	        <td height="40" align="center" valign="middle" class="tbletext"><b>Union Bank<br> 
	          of India
	          </b></td>
	         <td align="center" class="tbletext">&nbsp;</td>
	         <td align="center" class="tbletext">10.75%</td>
 	         <td align="center" class="tbletext">10.75%</td>
	         <td align="center" class="tbletext">10.75%</td>
	         <td height="30" align="center" class="tbletext">-</td>
	         <td align="center" class="tbletext">2%</td>
	         <td align="center" class="tbletext">0.50%</td>
	       </tr>
	      <tr bgcolor="#F6F4ED">
	        <td rowspan="4" align="center" valign="middle" bgcolor="#F6F4ED" class="tbletext"><b>Vijaya Bank </b></td>
	         <td align="center" class="tbletext"><b>upto 5yrs</b></td>
	         <td height="30" align="center" class="tbletext">9.25%</td>
	         <td align="center" class="tbletext">9.25%</td>
	         <td align="center" class="tbletext">10%</td>
	         <td align="center" class="tbletext">10%</td>
	         <td rowspan="4" align="center" class="tbletext">-</td>
	         <td rowspan="4" align="center" class="tbletext">-</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" ><b>5yrs to 10yrs</b> </td>
	         <td height="30" align="center" class="tbletext">9.50%</td>
	         <td align="center" class="tbletext">9.50%</td>
	         <td align="center" class="tbletext">10.25%</td>
	         <td align="center" class="tbletext">10.25%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center" ><b>10yrs to 15yrs</b></td>
	         <td height="30" align="center" class="tbletext">9.75%</td>
	         <td align="center" class="tbletext">9.75%</td>
	         <td align="center" class="tbletext">10.50%</td>
	         <td align="center" class="tbletext">10.50%</td>
            </tr>
	      <tr bgcolor="#F6F4ED">
	        <td align="center"  ><b>15yrs to 20yrs</b></td>
	         <td height="30" align="center" class="tbletext">10%</td>
	         <td align="center" class="tbletext">10%</td>
	         <td align="center" class="tbletext">10.75%</td>
	         <td align="center" class="tbletext">10.70%</td>
            </tr>
	      
	      
	      <!--   <tr bgcolor="#EFEEEE">
	     <td height="28" align="center" valign="middle" >SBI</td>
	     <td height="30" align="center" class="tbletext">upto 20 lacs-9.25%; 20 to 30 lacs-9.75%(for 5 years),10%(for 5-15 years),10.25%(for 15-25 years);30 to 70 lacs-10.25%(for 5 years),10.50%(for 5-15 years),10.75%(for 15-25 years);Above 70 lacs-10.25%(for 5 years),10.50%(for 5-15 years),11%(for 15-25 years)
</td>
	     <td align="center" class="tbletext">A fixed rate of interest of 8% for a period of one year. The rate will be reset after one year.upto 5 lacs - 8.50%
</td>
	     <td align="center" class="tbletext">0.50%</td>
	     <td align="center" class="tbletext">2%</td>
	     <td align="center" class="tbletext">-</td>
	     <td align="center" class="tbletext">-</td>
	     </tr>-->
	        </table></td></tr>
</table><br>

<div style="width:750px; float:left;">   
                              
    </p>		 <p> <b>Disclaimer:</b> Please note that the interest rates given here are based 
            on the market research. To enable the comparisons certain set of data 
            has been reorganized / restructured / tabulated. Users are advised 
            to recheck the same with the individual companies / organizations. 
            This site does not take any responsibility for any sudden / uninformed 
            changes in interest rates.<br><br>

            Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> 
            for inclusions or updates </p>
	</div>
    </div>


  </div>
<?php include '~Bottom.php';?>
  </body>
</html>