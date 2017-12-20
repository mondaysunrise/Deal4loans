<?php

$primary_acc =$_REQUEST["primary_acc"];

if($primary_acc=="Citibank")
{
	echo "<a href='https://www.citibank.co.in/ibank/login/IQPin.jsp' target='_blank'>Download 6 months Bank Statement.</a>";
}
elseif($primary_acc=="HDFC")
{
	echo "<a href='http://www.hdfcbank.com/common/onlineservices/netbankingloginsafe.htm' target='_blank'>Download 6 months Bank Statement.</a>";
}
elseif($primary_acc=="Axis Bank")
{
	echo "<a href='https://www.axisbank.co.in/' target='_blank'>Download 6 months Bank Statement.</a>";
}
elseif($primary_acc=="ICICI")
{
	echo "<a href='https://infinity.icicibank.co.in/BANKAWAY?Action.RetUser.Init.001=Y&AppSignonBankId=ICI&AppType=corporate&abrdPrf=N' target='_blank'>Download 6 months Bank Statement.</a>";
}
elseif($primary_acc=="SBI")
{
	echo "<a href='https://www.onlinesbi.com/retail/login.htm' target='_blank'>Download 6 months Bank Statement.</a>";
}
elseif($primary_acc=="Kotak Bank")
{
	echo "<a href='https://www.kotak.com/j1001mp/netapp/MainPage.jsp' target='_blank'>Download 6 months Bank Statement.</a>";
}
else
{
	echo "";
}
?>