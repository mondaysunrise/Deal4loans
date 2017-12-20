<Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 6))
		return false;
	if(!checkData(theFrm.PWD, 'PWD', 2))
		return false;
	return true;
    }
     </Script>
<form method="post" action="Login.php" onSubmit="return validateMe(this);">
	<table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="103"><img src="images/login.gif" width="103" height="16" /></td>
        <td width="15"><img src="images/spacer.gif" width="15" height="8" /></td>
      </tr>
      <tr>
        <td><input name="Email" type="text" class="formfield" id="Email" size="13" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input name="PWD" type="password" class="formfield" id="PWD"  size="13" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><a href="#">
          <input type="image" name="imageField" src="images/submit.gif" />
        </a></td>
        <td>&nbsp;</td>
      </tr>
	  </table>
</form>
<table width="202"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15">&nbsp;</td>
    <td width="103">&nbsp;</td>
    <td width="15">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="images/arrow.gif" width="11" height="9" /></td>
    <td align="center" class="border"><a href="register.php" class="leftlink">Register Here!</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><img src="images/spacer.gif" width="1" height="5" /></td>
  </tr>
  <tr>
    <td><img src="images/arrow.gif" width="11" height="9" /></td>
    <td align="center" class="border"><a href="bidders_registration.php" class="leftlink">Bidders<br />
    Registration!</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><img src="images/spacer.gif" width="1" height="5" /></td>
  </tr>
  <tr>
    <td><img src="images/arrow.gif" width="11" height="9" /></td>
    <td align="center" class="border"><a href="bidder_login.php" class="leftlink">Bidder Login!</a></td>
    <td>&nbsp;</td>
  </tr>
</table>
