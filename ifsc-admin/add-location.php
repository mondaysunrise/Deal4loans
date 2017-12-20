<?php
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$addBank = $objAdmin->processAddLocation();
		if($addBank)
			{
				$rUrl = SITE_URL."add-location.php?msg=yes";
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
<script type="application/javascript" language="javascript">
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
      <h1>Add Location</h1>
      <div class="contentBox">
        <form action="" method="post" name="LocationFrm" onsubmit="return valAddLocation();">
          <div class="field_text2">Please fill the folllowing fields: <span class="require_fields">* Required Fields</span></div>
           <?php if($_REQUEST['msg']=='yes')
			{
		?>
             <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php  echo "Record Added";?></div> 
             <?php }?>
          <div class="row">
            <label>Bank Name:</label>
            <select name="BankName" id="BankName">
                  <option value="">Please Select Bank</option>
                  
                  <?php echo $objAdmin->GetBankName($_REQUEST['BankName']);?>
                  </select>
          </div>
            <div class="row">
            <label>State Name:</label>
         <select name="StateName" id="StateName" onchange="getCity(this.value)">
                  <option value="">Please Select State</option>
                  
                  <?php echo $objAdmin->GetStateName($_REQUEST['StateName']);?>
                  </select>
                 
          </div>
           <div class="row">
          
           <label>City Name:</label>
          <span id="Citydiv"> <select name="CityName" id="CityName">
                  <option value="">Please Select City</option>
                  
                  <?php //echo $objAdmin->GetCityName($_REQUEST['CityName']);?>
                  </select>
                  </span>
          </div>
           <div class="row">
            <label>Location Name:</label>
           <input name="locationName" type="text" id="locationName" value="" />
          </div>
           <div class="row">
            <label>Address:</label>
           <textarea
           <textarea name="Address" id="Address"></textarea>
          </div>
           <div class="row">
            <label>Ifsc Code:</label>
           <input name="IfscCode" type="text" id="IfscCode" value="" />
          </div>
           <!--<div class="row">
            <label>Swift Bic COde:</label>
           <input name="SwiftBicCode" type="text" id="SwiftBicCode" value="" />
          </div>-->
           <div class="row">
            <label>Phone:</label>
           <input name="Phone" type="text" id="Phone" value="" />
          </div>
           <div class="row">
            <label>Branch Code:</label>
           <input name="BranchCode" type="text" id="BranchCode" value="" />
          </div>
           <div class="row">
            <label>MICR Code:</label>
           <input name="MICRCode" type="text" id="MICRCode" value="" />
          </div>
          
           <div class="row">
            <label>Pincode:</label>
           <input name="Pincode" type="text" id="Pincode" value="" />
          </div>
           <div class="row">
            <label>Latitude:</label>
           <input name="Latitude" type="text" id="Latitude" value="" />
          </div>
           <div class="row">
            <label>Longitude:</label>
           <input name="Longitude" type="text" id="Longitude" value="" />
          </div>
          
           <div class="row">
            <label>Description:</label>
           <textarea id="editor1" name="description"></textarea>

		<script>

			CKEDITOR.replace( 'editor1' );

		</script>
           
          </div>
          
           <div class="row">
            <label>Meta Title:</label>
           <input name="metaTitle" type="text" id="metaTitle" value="" />
          </div>
          
           <div class="row">
            <label>Meta Keyword:</label>
           <input name="MetaKeyword" type="text" id="MetaKeyword" value="" />
          </div>
           <div class="row">
            <label>Meta Description:</label>
           <input name="MetaDesc" type="text" id="MetaDesc" value="" />
          </div>
         
          <div class="row">
            <div class="submit_btn2" >
              <input name="Submit" type="submit" class="button" value="Submit" border="0">
            </div>
          </div>
          
        </form>
      </div>
      
    </div>
  </div>
</div>      
</body>
</html>
