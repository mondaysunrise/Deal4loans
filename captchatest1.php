<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
<input type="text" id="reference_captcha" name="reference_captcha" value="">
<div style="width:100px; height:30px; background-color:#ACBFE3; font-size:15px; color:#000000; text-align:center; padding-top:10px;" id="place4Captcha" contentEditable='false' unselectable='true'>qawsef</div><br>
<span style="font-size:11px;">Can't read the image? <a id="clickhr" style="cursor:pointer;">click here</a> to refresh</span>

<script language="javascript" type="text/javascript">
/*$("#clickhr").click(function(){
$.ajax({
url: "captchatest.php",
})
.done(function( msg ) {
 $('#place4Captcha').html(msg);
//alert( "Data Saved: " + msg );
});
});
*/
$(function() {
$( window ).load(function() {
 $.post("captchatest.php",
  {  },
  function(data,status){
 	 $('#place4Captcha').html(data);
	  	 $('#reference_captcha').val(data);
	 });
});
});

$(function() {
$("#clickhr").click(function(){
 $.post("captchatest.php",
  {  },
  function(data,status){
 	 $('#place4Captcha').html(data);
	  	 $('#reference_captcha').val(data);
  });
});
});
</script>
</body>
</html>
