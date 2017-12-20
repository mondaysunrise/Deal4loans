<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
 /*$(function() {
$("#activate_code").(function(){
	 $('#loadingmessage').show(); 
 $.post("checkPhone_continue.php",
  {
    phone: $("#mobile_number").val()
  },
  function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
	 if(data=="OK")
		{
	 $('#teststat').val("1");
	 $('#car_price_pop').html(data);
 $('#loadingmessage').hide(); 
		}
		else
		{
$('#teststat').val("0");
$('#car_price_pop').html(data);
 $('#loadingmessage').hide(); 
		}
  });
});
});*/
//demo_ajax_gethint.php

 $(function() {
$("#Phone").focusout(function(){
	var mobilenumber= $('#Phone').val();
	if(mobilenumber.length==10)
	{
	$.post("checkPhone_continue.php",
  {
    phone: $("#Phone").val()
  },
  function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
	 if(data>0)
		{
	 $('#teststat').val("1");
	 $( "#activate_code" ).val(data);
	 $.post("hdfccl_mobilevalidate.php",
  {
    phone: $("#Phone").val(),
	reference_code: $("#activate_code").val()
  },
  function(nwdata,nwstatus){
    alert("Data: " + nwdata + "\nStatus: " + nwstatus);
	});	 
	 //$('#car_price_pop').html(data);
		}
		else
		{
$('#teststat').val("0");
alert("Data: " + data + "\nStatus: " + status);
//$('#car_price_pop').html(data);
		}
  });
} } );
 });

 $('#activate_code').load(function() {
$('#car_price_pop').html("hello i m ready");
});
</script>
</head>
<body>

<p>Start typing a name in the input field below:</p>
First name:
<form>
<table>
<input type="input" value="" id="teststat">
<input type="input" value="" id="activate_code">
<input type="button" value="hello" id="buttondv"/>
<input type="input"  id="Phone"/>
<div id="loadingmessage" style='display:none'><p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p></div>

<div id="car_price_pop"></div>
</table>
</form>
</body>
</html>
