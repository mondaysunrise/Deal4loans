<?php
include "includes/header.php";
$sql = "SELECT * FROM " . TABLE_USER." WHERE id='".$_REQUEST['id']."'";
	$result = $obj->fun_db_query($sql);
	$rowsCon = $obj->fun_db_fetch_rs_object($result);
if(isset($_POST['Submit']))
{
	$EditUser = $objAdmin->processAddUser($_REQUEST['id'],"EDIT");
		if($EditUser)
			{
				$rUrl = SITE_URL."edit-user.php?id=".$_REQUEST['id']."&msg=edit";
				$objAdmin->redirectURL($rUrl);
			}
	}

?>
<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <div class="content-outer_form">
      <h1>Edit User</h1>
      <div class="contentBox">
        <form action="" method="post" name="UserFrm" onsubmit="return valAddUser();">
          <div class="field_text2">Please fill the folllowing fields: <span class="require_fields">* Required Fields</span></div>
          <?php if($_REQUEST['msg']=='edit')
			{
		?>
          <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/>
            <?php  echo "Record Updated";?>
          </div>
          <?php }?>
          <table width="100" border="0">
        <tr>
          <td> Name:</td>
          <td><input name="Name" type="text" id="Name" value="<?php echo $rowsCon->Name;?>" onkeypress="return isCharsetKey(event)" onkeydown="validateDiv('NameVal');" /><br />
          <span id="NameVal"></span></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td>            <input name="Email" type="text" id="Email" value="<?php echo $rowsCon->Email;?>" onkeydown="validateDiv('EmailVal');" /><br />
          <span id="EmailVal"></span></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td>
            <input name="pwd" type="password" id="pwd" value="<?php echo $rowsCon->pwd;?>" onkeydown="validateDiv('PasswordVal');" /><br />
          <span id="PasswordVal"></span></td>
        </tr>
        
       
       <tr>
          <td>Mobile Number: </td>
          <td>
            <input name="Mobile_Number" type="text" id="Mobile_Number"  maxlength="10" onkeypress="return numOnly(event)" value="<?php echo $rowsCon->Mobile_Number;?>" onkeydown="validateDiv('MobileNumVal');" /><br />
          <span id="MobileNumVal"></span></td>
        </tr>
        
        <tr>
          <td> City:</td>
          <td>
          <select name="City[]" id="City"  onchange="validateDiv('CityVal');" multiple="multiple" >
                 
                     <?php if($_SESSION['UserType']==1) { ?>
                 <?=plgetCityList($rowsCon->City)?>
               <?php } else {
				 	   $explodeCity = explode(",", $_SESSION['UserCityList']);
					   for($z=0;$z<count($explodeCity);$z++)
					   {
							echo "<option value='".$explodeCity[$z]."'>".$explodeCity[$z]."</option>";
					   }
				   }?>
          </select><br />
          <span id="CityVal"></span></td>
        </tr>
        
          <tr>
          <td> User Type:</td>
          <td>
            <select name="UserType" id="UserType">
            <option value="">Select User Type</option>
             <?php if($_SESSION['UserType']==1) { ?>
            <option value="2" <?php if($rowsCon->UserType==2) { echo "selected"; } ?>>Adminintrator</option>
          <?php } ?>  
            <option value="3" <?php if($rowsCon->UserType==3) { echo "selected"; } ?>>Docs Picker</option>
            </select><br />
          <span id="UserTypeVal"></span></td>
        </tr>
        
       <tr>
          <td>
         Status:</td>
          <td>
           <input type="hidden" name="Reply_Type" value="1" />
            <input type="hidden" name="Owner" value="<?php echo $_SESSION['UID']; ?>" />
            <input type="checkbox" name="Status" id="Status" value="1" checked="checked" style="float:none;" />
             <span> Checked :Active &nbsp;&nbsp; Uncheck :Inactive </span>
          </td>
        </tr>
        
        <tr>
          <td>
       
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