<?php
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$addUser = $objAdmin->processAddUser();
	if($addUser)
	{
		if($addUser=="User Exists")
		{
			$rUrl = SITE_URL."add-user.php?msg=no";
		}
		else 
		{
			$rUrl = SITE_URL."add-user.php?msg=yes";	
		}
		$objAdmin->redirectURL($rUrl);
	}
}

?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	    $("#UserType").change(function(){
		 $(this).find("option:selected").each(function(){
				var ni1 = document.getElementById('utlabel');
				var ni2 = document.getElementById('utfield');

				if($(this).attr("value")=="2"){
				ni1.innerHTML = 'Products';
				ni2.innerHTML = '<table width="292" cellpadding="1" cellspacing="2"><tr><td><input type="checkbox" value="1" class="NoBrdr" id="Product_pl" name="Product_pl" style="border:none;"/> Personal Loan</td><td><input type="checkbox" value="1" class="NoBrdr"  id="Product_hl" name="Product_hl" style="border:none;"/>Home Loan</td></tr><tr><td><input type="checkbox" value="1" class="NoBrdr"  id="Product_cl" name="Product_cl" style="border:none;"/> Car Loan</td><td><input type="checkbox" value="1" class="NoBrdr"  id="Product_lap" name="Product_lap" style="border:none;"/> Loan Against Property</td></tr><tr><td><input type="checkbox" value="1" class="NoBrdr"  id="Product_bl" name="Product_bl" style="border:none;"/> Business Loan</td><td><input type="checkbox" value="1" class="NoBrdr"  id="Product_cc" name="Product_cc" style="border:none;"/> Credit Card</td></tr></table>';
				}
				else if($(this).attr("value")=="3"){
					ni1.innerHTML = 'VSTS Code';
					ni2.innerHTML = '<input name="vsts_code" type="text" id="vsts_code" value=" "  />';
				}
				else {
					ni1.innerHTML = '';
					ni2.innerHTML = '';
				}
		 });
	});
});

</script>

<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <div class="content-outer_form">
      <h1>Add User</h1>
      <div class="contentBox">
      <form action="" method="post" name="UserFrm" onsubmit="return valAddUser();">
   
        <div class="field_text2">Please fill the folllowing fields: <span class="require_fields">* Required Fields</span></div>
        <?php
		
		 if($_REQUEST['msg']=='yes')
			{
		?>
        <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/>
          <?php  echo "Record Added";?>
        </div>
        <?php }
        if($_REQUEST['msg']=='no')
			{
		?>
        <div class="msg_payee"><img src="./images/error.png" align="absmiddle"/>
          <?php  echo "Duplicate Record";?>
        </div>
        <?php }?>
        <table width="100" border="0">
         <tr>
          <td> Name:</td>
          <td><input name="Name" type="text" id="Name" value="" onkeypress="return isCharsetKey(event)"  onkeydown="validateDiv('NameVal');" /><br />
          <span id="NameVal"></span></td>
        </tr>
        
        <tr>
          <td>Email:</td>
          <td>
          <input name="Email" type="text" id="Email" value=" " onkeydown="validateDiv('EmailVal');" /><br />
          <span id="EmailVal"></span></td>
        </tr>
<?php if($_SESSION['UserType']==1) {  ?>
        <tr>
          <td>Password:</td>
          <td><input name="pwd" type="password" id="pwd" value="" onkeydown="validateDiv('PasswordVal');" /><br />
          <span id="PasswordVal"></span></td>
        </tr>
      <?php } else { ?> <input name="pwd" type="hidden" id="pwd" value="123456"  /><?php } ?>
       <tr>
          <td>Mobile Number: </td>
          <td>
          <input name="Mobile_Number" type="text" id="Mobile_Number" value="" maxlength="10" onkeypress="return numOnly(event)"  onkeydown="validateDiv('MobileNumVal');" /><br />
          <span id="MobileNumVal"></span></td>
        </tr>
        
      
        <tr>
          <td>City:</td>
          <td>
          <?php //print_r($_SESSION['UserCityList']); ?>
          <select name="City[]" id="City" multiple onchange="validateDiv('CityVal');" >
              <?php if($_SESSION['UserType']==1) { ?>
               <?=plgetCityList($City)?>
               <?php } else {
					   $explodeCity = explode(",", $_SESSION['UserCityList']);
					   for($z=0;$z<count($explodeCity);$z++)
					   {
							echo "<option value='".$explodeCity[$z]."'>".$explodeCity[$z]."</option>";
					   }
				   }?>
          </select>
          <br />
          <span id="CityVal"></span></td>
        </tr>
          <tr>
          <td> User Type:</td>
          <td>
            <select name="UserType" id="UserType">
            <option value="">Select User Type</option>
         <?php if($_SESSION['UserType']==1) { ?>
            <option value="2">Adminintrator</option>
          <?php } ?>  
            <option value="3" <?php if($_SESSION['UserType']==2) { echo "selected"; } ?>>Docs Picker</option>
            </select><br />
          <span id="UserTypeVal"></span></td>
        </tr>
        
        
       <tr>
          <td id="utlabel"></td><td id="utfield"></td>
         </tr>
        
       <tr>
          <td>
         Status:</td>
          <td>
          <input type="checkbox" name="Status" id="Status" value="1" checked="checked" style="float:none;" />
          <span> Checked :Active &nbsp;&nbsp; Uncheck :Inactive </span> 
          </td>
        </tr>
        
        <tr>
          <td>
       
            <input type="hidden" name="Reply_Type" value="1" />
            <input type="hidden" name="Owner" value="<?php echo $_SESSION['UID']; ?>" />
            <input name="Submit" type="submit" class="button" value="Submit" border="0">
          </td>
        </tr>
        </table>
        
      </form>
    </div>
  </div>
</div>
</div>
</body></html>