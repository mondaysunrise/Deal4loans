

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function isSpecialChar(e)
{
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return ((k > 64 && k < 91) || (k > 96 && k < 123) || (k >= 48 && k <= 57) || (k == 35) || (k == 39) || (k == 124) || (k == 44) || (k == 47));
}

function isCharsetKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode > 33) && (charCode < 58))
		return false;
	return true;
}

function numOnly(evt)
{
	var charCode = (evt.which) ? evt.which : window.event.keyCode;
	if (charCode <= 13)
	{
		return true;
	} else
	{
		var keyChar = String.fromCharCode(charCode);
		var re = /[0-9]/
		return re.test(keyChar);
	}
}
