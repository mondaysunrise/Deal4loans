<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$bank_name=$_REQUEST["bank_name"];

	$selectresult="select * from personal_loan_interest_rate_chart where bank_name='".$bank_name."'";
	$getbank_result=ExecQuery($selectresult);
	$get=mysql_fetch_array($getbank_result);
	$msg="valid";
	}

?>
<html>
<head>
<script type="text/javascript" src="scripts/ajax.js"></script>
	<script type="text/javascript" src="scripts/ajax-dynamic-list.js">

	
function insRow()
  {
	
		 var i=document.getElementById('myTable').rows.length;
		  var ni = document.getElementById('countoftable');
	ni.innerHTML ="<input type='hidden' name='CountOfTable' value='"+ i +"'>";
  var x=document.getElementById('myTable').insertRow(document.getElementById('myTable').rows.length)
  var y=x.insertCell(0)
  //var z=x.insertCell(1)
  
  y.innerHTML='<select name="bank_name" id="bank_name">
		<?php
		$selectbank="select bank_name from personal_loan_interest_rate_chart where flag=1";
		
		$getbank_name=ExecQuery($selectbank);
		$recordcount = mysql_num_rows($getbank_name);
		for($i=0;$i<$recordcount;$i++)
		{
			$bank_name = mysql_result($getbank_name,$i,"bank_name");
		?>
		<option value="<? echo $bank_name;?>" <? if($bank_name==$get["bank_name"])
			{ echo "selected";
			}?>> <? echo $bank_name;?></option>
			<? }?>
			</select>'
//  z.innerHTML="NEW CELL2"
 // }
  }
  function deleteRow(r)
  {
	  
  var i=r.parentNode.parentNode.rowIndex
	  i=i+1;
   document.getElementById('myTable').deleteRow(i)
 var j=document.getElementById('myTable').rows.length;
   j=j-1;
	    var ni = document.getElementById('countoftable');
	ni.innerHTML ="<input type='hidden' name='CountOfTable' value='"+ j +"'>";
  }
  </script>


</head>
<body>
<div>Personal Loan</div>
<form name="rate_intesrest" method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>">
<table>
	<tr>
		<td>bank name</td>
		<td>

<input type="text" id="country" name="country" value="" onkeyup="ajax_showOptions(this,'bank_name',event)">
					<input type="hidden" id="country_hidden" name="country_ID">
	
			</td>
	</tr>
	<? if(isset($msg))
	{?>
	<tr><td colspan="2">
	<table width="777"  border="0" cellpadding="1" cellspacing="2">
       <tr bgcolor="#E8F0F6">
         <td width="99"align="center" class="tbletext" ><b>Banks/Rates</b></td>
         <td height="25" colspan="5" align="center" bgcolor="#E8F0F6" class="tbletext"><b>Salaried</b></td>
         </tr>
       <tr bgcolor="#E8F0F6" >
         <td  height="30" align="center" class="tbletext">&nbsp;</td>
         <td width="131"  height="30" align="center" class="tbletext"><b>CAT A</b></td>
         <td width="134"  height="30" align="center" class="tbletext"><b>CAT B</b></td>
         <td width="139" align="center" class="tbletext"><b>Others</b></td>
         <td width="107" align="center" class="tbletext"><b>Pre-Payment Charges</b></td>
		   <td width="141" align="center" class="tbletext"><b>Processing Fees</b></td>
       </tr>
	    <tr bgcolor="#E8F0F6" >
         <td  height="30" align="center" class="tbletext"><? echo $get["bank_name"]; ?></td>
         <td width="131"  height="30" align="center" class="tbletext"><? echo $get["cat_a"]; ?></td>
         <td width="134"  height="30" align="center" class="tbletext"><? echo $get["cat_b"]; ?></td>
         <td width="139" align="center" class="tbletext"><? echo $get["others"]; ?></td>
         <td width="107" align="center" class="tbletext"><? echo $get["pre_payment"]; ?></td>
		   <td width="141" align="center" class="tbletext"><? echo $get["processing_fee"]; ?></td>
       </tr>

	<?}?>
	</td></tr>
	<tr>
		<td>Compare</td>
		<td><input type="text" name="compare" id="compare"><table id="myTable" width='100%'><tr><td width='100%'><input type="button" value="Add bank"  onClick="insRow()"></td></tr></table></td>
	</tr>
	
	<tr><td colspan="2" id="countoftable"></td></tr>
	<tr><td colspan="2"><input type="submit" value="submit" name="submit"></td></tr>
</form>
</body>
</html>