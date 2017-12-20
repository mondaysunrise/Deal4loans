<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="jsj/stylecal.css" type="text/css" media="screen" />
<script type='text/javascript' src='jsj/jquery.min.js'></script>
<script type='text/javascript' src='jsj/jquery-ui-slider.min.js'></script>
<script type='text/javascript' src='jsj/globalize.min.js'></script>
<script type='text/javascript' src='jsj/jquery.color.js'></script>
<script type='text/javascript' src='jsj/superfish.js'></script>
<script type='text/javascript' src='jsj/highcharts.js'></script>
<script type='text/javascript' src='jsj/jquery.custom.min.js'></script>
</head>
<body >
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td>			
<form id="calc_Form">
<div class="lamount">
<strong>Principal Car Loan Amount</strong>
Rs.
<input id="Loan_Amount" name="Loan_Amount" value="3,00,000" type="text"/>
</div>

<div id="loanamountslider"></div>
<div style="height:5px;">&nbsp;</div>
<div ><strong>Interest Rate</strong><input id="loan_intr" name="loan_intr" value="14.5" type="text"/><span><strong> % Per Annum</strong></span></div>

<div id="loan_intrslider"></div>
<div style="height:5px;">&nbsp;</div>
<div ><strong>Loan Term</strong><input id="tenure" name="tenure" value="5" type="text"/><input name="loantenure" id="tenure_years" value="tenure_years" checked type="radio" style="display:none;"/><span><strong> Years</strong></span></div>
<div class="clear"></div>
<div id="tenureslider"></div>
</form>
</td><td align="center" valign="bottom">
<div id="emipaymentdetails">
	<div id="emisum">
		<div id="emiamount"><h4>Monthly Instalment (EMI)</h4><p>Rs. <span>7,058</span></p></div>
        <div id="emitotalinterest"><h4>Total Interest Amount</h4><p>Rs. <span>1,23,509</span></p></div>
        <div id="emitotalamount" class="column-last"><h4>Total Amount<br/>(Principal + Interest)</h4><p>Rs. <span>4,23,509</span></p></div>
    </div>
</div>
</td></tr>
<tr><td>
<div id="emibarchart"  class="highcharts-container"></div>
</td><td>
<div id="emipiechart" class="highcharts-container"></div> </td></tr>
<tr><td colspan="2">
<div id="emipaymenttable"></div>
</td></tr></table>

<script type='text/javascript' src='jsj/ui.tabs.js'></script>
</body>
</html>
