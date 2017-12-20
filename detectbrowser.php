<?php
echo $useragent=$_SERVER['HTTP_USER_AGENT'];
?>
<html>
<head>

<script>
function chkbrwser()
{
	var ni1 = document.getElementById('creative').value;
	var android = (ni1.indexOf("Android")>=0);
	var blackBerry = (ni1.indexOf("BlackBerry")>=0);
	var iPhone = (ni1.indexOf("iPhone")>=0);
	var IEMobile = (ni1.indexOf("IEMobile")>=0);
	if (android || IEMobile || iPhone || blackBerry) {
	   alert("done");
	}
	else
	{
		alert("not");
	}
}

</script>
</head>
<body>
 <input type="text" name="creative" id="creative" value="<? echo $useragent; ?>">
<input type="button" name="name" id="name" onclick="chkbrwser();">
</body>
</html>
