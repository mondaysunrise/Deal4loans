function valAddUser()
{
	
	var i;
	
	if (document.UserFrm.Name.value=="")
		{
			document.getElementById('NameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name!</span>";
			document.UserFrm.Name.focus();
			return false;
		}
		
	var str=document.UserFrm.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
		{
			document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			document.UserFrm.Email.focus();
			return false;
		}
	else if(bb==-1)
		{
			document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			document.UserFrm.Email.focus();
			return false;
		}
	
	if (document.UserFrm.pwd.value=="")
	{
		document.getElementById('PasswordVal').innerHTML = "<span  class='hintanchor'>Enter Password!</span>";	
		document.UserFrm.pwd.focus();
		return false;
	}	
	
	
			
		if (document.UserFrm.Mobile_Number.value=="")
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
				document.UserFrm.Mobile_Number.focus();
				return false;
			}
			
		if (document.UserFrm.Mobile_Number.value.length < 10 )
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
				document.UserFrm.Mobile_Number.focus();
				return false;
			}
		if ((document.UserFrm.Mobile_Number.value.charAt(0)!="9") && (document.UserFrm.Mobile_Number.value.charAt(0)!="8") && (document.UserFrm.Mobile_Number.value.charAt(0)!="7"))
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
				document.UserFrm.Mobile_Number.focus();
				return false;
			}
								
		if ((document.UserFrm.City.value==""))
			{
				document.getElementById('CityVal').innerHTML = "<span  class='hintanchor'>Enter City!</span>";	
				document.UserFrm.City.focus();
				return false;
			}	
	if (document.UserFrm.UserType.value=="")
			{
				document.getElementById('UserTypeVal').innerHTML = "<span  class='hintanchor'>Select User Type!</span>";	
				document.UserFrm.UserType.focus();
				return false;
			}
	
	
}
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function isCharsetKey(evt)
{
	var charCode=(evt.which)?evt.which:event.keyCode
	if((charCode>33)&&(charCode<58))
	return false;
	return true;
}

function numOnly(evt)
	{
		
		var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 46 || charCode > 57))
            return false;

         return true;
		
	}