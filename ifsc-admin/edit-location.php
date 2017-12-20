<?php
include "includes/header.php";
$sql = "SELECT * FROM " . TABLE_BRANCH." WHERE id='".$_REQUEST['id']."'";
	$result = $obj->fun_db_query($sql);
	$rowsCon = $obj->fun_db_fetch_rs_object($result);
	
	$stateid  = $objAdmin->GetStateInfo($rowsCon->state_id);
	$StateInfo  = $objAdmin->GetStateInfo($stateid['sub_id']);
	
if(isset($_POST['Submit']))
{
	$addBank = $objAdmin->processAddLocation($_REQUEST['id'],"EDIT");
		if($addBank)
			{
				$rUrl = SITE_URL."edit-location.php?id=".$_REQUEST['id']."&msg=edit";
				$objAdmin->redirectURL($rUrl);
			}
	}

?>
<style type="text/css">
#cke_editor1{ width:700px !important; float:right;}
#cke_20{ display:none;}
#cke_25{ display:none;}
.cke_bottom{ clear:left;}
</style>
<script src="ckeditor/ckeditor.js"></script>

<script type="application/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }

function getCity(State)
{
   var strURL="http://www.deal4loans.com/findCity-admin.php?state="+State;
   var req = getXMLHTTP();
   
   if (req)
   {
     req.onreadystatechange = function()
     {
      if (req.readyState == 4)
      {
	 if (req.status == 200)
         {
			 
	    document.getElementById('Citydiv').innerHTML=req.responseText;
	 } else {
   	   alert("There was a problem while using XMLHTTP:\n" + req.statusText);
	 }
       }
      }
   req.open("GET", strURL, true);
   req.send(null);
   }
}
</script>

<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <div class="content-outer_form">
      <h1>Edit Location</h1>
      <div class="contentBox">
        <form action="" method="post" name="LocationFrm" onsubmit="return valAddLocation();">
          <div class="field_text2">Please fill the folllowing fields: <span class="require_fields">* Required Fields</span></div>
           <?php if($_REQUEST['msg']=='edit')
			{
		?>
             <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php  echo "Record Updated";?></div> 
             <?php }?>
          <div class="row">
            <label>Bank Name:</label>
            <select name="BankName" id="BankName">
                  <option value="">Please Select Bank</option>
                  
                  <?php echo $objAdmin->GetBankName($rowsCon->bank_id);?>
                  </select>
          </div>
           <div class="row">
            <label>State Name:</label>
         <select name="StateName" id="StateName" onchange="getCity(this.value)">
                  <option value="">Please Select State</option>
                  
                  <?php echo $objAdmin->GetStateName($StateInfo['id']);?>
                  </select>
                 
          </div>
           <div class="row">
            <label>City Name:</label>
         <span id="Citydiv">  <select name="CityName" id="CityName">
                  <option value="">Please Select City</option>
                  
                    <?php echo $objAdmin->GetCityName($stateid['id'], $stateid['sub_id']);?>
                  </select></span>
          </div>
           <div class="row">
            <label>Location Name:</label>
           <input name="locationName" type="text" id="locationName" value="<?php echo $rowsCon->branch_name;?>" />
          </div>
           <div class="row">
            <label>Address:</label>
        
           <textarea name="Address" id="Address"><?php echo $rowsCon->address;?></textarea>
          </div>
           <div class="row">
            <label>Ifsc Code:</label>
           <input name="IfscCode" type="text" id="IfscCode" value="<?php echo $rowsCon->ifsc;?>" />
          </div>
          <!-- <div class="row">
            <label>Swift Bic COde:</label>
           <input name="SwiftBicCode" type="text" id="SwiftBicCode" value="<?php //echo $rowsCon->swift_bic_code;?>" />
          </div>-->
           <div class="row">
            <label>Phone:</label>
           <input name="Phone" type="text" id="Phone" value="<?php echo $rowsCon->phone;?>" />
          </div>
           <div class="row">
            <label>Branch Code:</label>
           <input name="BranchCode" type="text" id="BranchCode" value="<?php echo $rowsCon->branch_code;?>" />
          </div>
           <div class="row">
            <label>MICR Code:</label>
           <input name="MICRCode" type="text" id="MICRCode" value="<?php echo $rowsCon->micr_code;?>" />
          </div>
          
           
           <div class="row">
            <label>Pincode:</label>
           <input name="Pincode" type="text" id="Pincode" value="<?php echo $rowsCon->pincode;?>" />
          </div>
           <div class="row">
            <label>Latitude:</label>
           <input name="Latitude" type="text" id="Latitude" value="<?php echo $rowsCon->latitude;?>" />
          </div>
           <div class="row">
            <label>Longitude:</label>
           <input name="Longitude" type="text" id="Longitude" value="<?php echo $rowsCon->longitude;?>" />
          </div>
          <div class="row">
            <label>Description:</label>
           <textarea id="editor1" name="description"><?php echo $rowsCon->description;?></textarea>

		<script>

			CKEDITOR.replace( 'editor1' );

		</script>
           
          </div>
          
          
           <div class="row">
            <label>Meta Title:</label>
           <input name="MetaTitle" type="text" id="MetaTitle" value="<?php echo $rowsCon->MetaTitle;?>" />
          </div>
          
           <div class="row">
            <label>Meta Keyword:</label>
           <input name="MetaKeyword" type="text" id="MetaKeyword" value="<?php echo $rowsCon->MetaKeyword;?>" />
          </div>
           <div class="row">
            <label>Meta Description:</label>
           <input name="MetaDesc" type="text" id="MetaDesc" value="<?php echo $rowsCon->MetaDesc;?>" />
          </div>
          <div class="row">
             <label> <span><a href="view-location.php" class="button small">Back<img src="./images/back-btn.png" align="absmiddle" /></a></span></label>
             
              <input name="Submit" type="submit" class="button" value="Submit" border="0">
           
          </div>
          
        </form>
      </div>
      
    </div>
  </div>
</div>      
</body>
</html>
