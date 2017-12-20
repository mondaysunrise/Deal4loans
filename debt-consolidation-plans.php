<?php
//This file is not in use
header("Location: http://www.deal4loans.com/");
exit();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Loan Guru India | Debt Consolidation |Personalized advice from Deal4loans </title>
<meta name="keywords" content="loan guru, debt consolidation,bank loan calculator, bank loan interest rate, loan interest rate in india , loan emi calculator, loan eligibility calculator, credit card query, home loans India, credit cards in india, personal loan emi calculator," />

<meta content="text/html; charset=<?php echo $hesklang['ENCODING']; ?>">

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">

function askamitoj(Form)
{
	if(Form.custNet_Salary.value=="")
	{
		alert("Please enter your Annual Income");
			Form.custNet_Salary.focus();
			return false;
	}
	if(Form.custQuery.value=="")
	{
		alert("Please enter your Query");
		Form.custQuery.focus();
		return false;
	}
}

    var row_no=1;
    function addRowLoans(tbl,row){
        //so that user can only add 3 rows
        if(row_no<=4){   
       
        var textbox1 = '<select name="Type_Loan[]" id="Type_Loan[]" style="width:120px;"><option value="Property Loan">Property Loan</option><option value="Twowheeler Car Loan">Car 2wheeler Loan</option><option value="Personal Loan">Personal Loan</option><option value="Other Loans">Other Loans</option></select>';//for text box
		var textbox2 = '<input type="text" name="pl_loanamount[]" id="pl_loanamount[]" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
		var textbox3 = '<input type="text" name="pl_tenure[]" id="pl_tenure[]" style="width:40px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
		var textbox4 = '<input type="text" name="pl_emi[]" id="pl_emi[]" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
		var textbox5 = '<input type="text" name="pl_roi[]" id="pl_roi[]" style="width:60px;" maxlength="30">';
		var textbox6 = '<input type="text" name="pl_emipaid[]" id="pl_emipaid[]" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
	
        var tbl = document.getElementById(tbl);//to identify the table in which the row will get insert
        var rowIndex = document.getElementById(row).value;//to identify the row after which the row will be inserted
        try {
            var newRow = tbl.insertRow(row_no);//creation of new row
          // var newCell = newRow.insertCell(0);//first  cell in the row
            //newCell.innerHTML = text;//insertion of the 'text' variable in first cell
            var newCell = newRow.insertCell(0);//second cell in the row
            newCell.innerHTML = "<table width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td width='24%'> " + textbox1 + " </td><td width='17%'> " + textbox2 + "</td><td width='10%'> " + textbox3 + "</td><td width='14%'> " + textbox4 + "</td><td width='11%'> " + textbox5 + "</td><td width='14%'> " + textbox6 + "</td></tr></table>";//insertion of the text box and the remove text using their variable
            row_no++;
        } catch (ex) {
            alert(ex); //if exception occurs
        }
           
    }
    if(row_no>4)//if the row contain 3 textbox, the add button will disapper
    {
       //alert("You can add Only 5 Rows");
	    document.getElementById("add").style.display="none";
    }                       
}

//http://www.codingforums.com/archive/index.php?t-105270.html

    var rownumber=1;
    function addRowCards(tbname,countrow){
        //so that user can only add 3 rows
        if(rownumber<=4){   
       
        var textbox10 = '<select name="card_due_payment[]" id="card_due_payment[]" style="width:120px;"><option value="M A D">M A D **</option><option value="Less than M A D">Less than M A D</option><option value="More than M A D">More than M A D</option><option value="Full Payment">Full Payment</option></select>';//for text box
		var textbox20 = '<input type="text" name="card_name[]" id="card_name[]" style="width:60px;" maxlength="30" >';
		
        var tbname = document.getElementById(tbname);//to identify the table in which the row will get insert
        var rowIndex = document.getElementById(countrow).value;//to identify the row after which the row will be inserted
        try {
            var newRowCards = tbname.insertRow(rownumber);//creation of new row
           // var newCell = newRowCards.insertCell(0);//first  cell in the row
            //newCell.innerHTML = "Heloo";//insertion of the 'text' variable in first cell
            var newCell = newRowCards.insertCell(0);//second cell in the row
            newCell.innerHTML  = "<table width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td width='24%'> " + textbox10 + " </td><td width='17%'> " + textbox20 + "</td></tr></table>";//insertion of the text box and the remove text using their variable
            rownumber++;
        } catch (ex) {
            alert(ex); //if exception occurs
        }
           
    }
    if(rownumber>4)//if the row contain 3 textbox, the add button will disapper
    {
//       alert("You can add Only 5 Rows");
    document.getElementById("addCards").style.display="none";
    }
}

</script>

<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
   <div id="lftbar">
<div class="lfttxtbar">
     <div id="txt">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td colspan="5" align="left" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td width="14" height="141" align="left" valign="top"><img src="new-images/dbt-lft.gif" width="14" height="141" /></td>
    <td width="180" align="center" valign="middle" background="new-images/dbt-bg.gif"><img src="new-images/askpic.jpg" width="79" height="91" /><br />
      <div style="line-height:20px;"><b>Amitoj Sethi</b></div> 
      (Director)</td>
    <td width="25" align="left" valign="middle" background="new-images/dbt-bg.gif"><img src="new-images/dbt-vline.gif" width="1" height="121" /></td>
    <td valign="top" background="new-images/dbt-bg.gif"><div style="font-size:17px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; margin:18px 0px;">Ask Amitoj</div> 
      <b>Profile :- </b> Masters in Marketing from JBIMS, Amitoj has worked with Citibank
        for more than 9 years in the areas of Operations, Credit, Sales and
        Marketing. He has more than 4 years of exposure to Personal Loans and more
        than 3 years to Credit Cards in the areas of product development,
        acquisition channel enhancement and credit underwriting.</td>
    <td width="14" height="141"><img src="new-images/dbt-rgt.gif" width="14" height="141" /></td>
  </tr>
</table><br />
<h1>Debt Consolidation Queries</h1>
 
 	<?	 $debt_query="select * from hesk_show_transcript where TrackFlag=1 order by HtID Desc ";
		 list($debt_query_count,$row)=MainselectfuncNew($debt_query,$array = array());

			
			 // $debt_query_result = ExecQuery($debt_query);
			 // $debt_query_count = mysql_num_rows($debt_query_result);
			  
			 //$count =106;
		// for($h=0;$h<$debt_query_count;$h++)
$cntr=0;
while($cntr<count($getrow))
        {
		
			$TrackID=$row[$cntr]['TrackID'];
			$Subject_Line=$row[$cntr]['Subject_Line'];
						
			if(strlen($Subject_Line)>0)
			 { ?>
			 
		 
		<ul>
		<li><a href="/debt-consolidation/loan-guru/<? echo $TrackID;?>/ask-amitoj/<? echo $debt_query_count;?>" ><? echo $Subject_Line; ?></a></li>
		</ul> 
		<? 
			 }
			 $debt_query_count--;
		 
		 $cntr = $cntr +1;}
		 
		 ?>
		 <div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" src="new-images/top.gif" alt="Top"/></a></div>
    </div>   </div>   </div>
   <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right-new1.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>