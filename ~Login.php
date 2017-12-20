<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 6))
		return false;
	if(!checkData(theFrm.PWD, 'PWD', 1))
		return false;
	return true;
    }
     </Script>
<form method="post" action="Login.php" onSubmit="return validateMe(this);">
	 <label for="txtUserID">User ID :</label>
            <input type="text" id="Email" name="Email"  value="" class="formfield"/>
&nbsp;
            <label for="txtPassword"> &nbsp;Password :</label>
            <input type="password" id="PWD" name="PWD" value="" class="formfield"/>
            <input type="image" src="images/btn_go.gif" name="imagefield" id="btnLoginGO" />
 
     

</form>