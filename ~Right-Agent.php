<Script Language="JavaScript">			
function cityother()
{
	if(document.agent_frm.city.value=="Others")
	{
	   document.agent_frm.city_other.disabled = false;
	   document.agent_frm.city_other.focus();

	}
	else
	{
		document.agent_frm.city_other.disabled = true;
	}
}

function valButton3() {
    var cnt = -1;
	var i;
    for(i=0; i<document.agent_frm.Product.length; i++) 
	{
        if(document.agent_frm.Product[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}		



function validateMe(theFrm){

					var btn3;
					btn3=valButton3();
				if(theFrm.From_Name.value=="")
				{
					alert("Please enter Your Name");
					theFrm.From_Name.focus();
					return false;
				}
				
				
				if(theFrm.From_Email.value=="")
					{
						alert("Please enter  Email Address");
						theFrm.From_Email.focus();
						return false;
					}
				var str=theFrm.From_Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
					
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
					return false;
					}
				
				if (theFrm.query_type.selectedIndex==0)
					{
						alert("Please enter you are ");
						theFrm.query_type.focus();
						return false;
					}
					if (theFrm.city.selectedIndex==0)
					{
						alert("Please enter City Name to Continue");
						theFrm.city.focus();
						return false;
					}
					if((theFrm.city.value=="Others") && (theFrm.city_other.value=="" || theFrm.city_other.value=="Other City"  ) || !isNaN(theFrm.city_other.value))
					{
						alert("Kindly fill your Other City!");
						theFrm.city_other.focus();
						return false;
					}
					
					if(theFrm.Mobile.value=="")
					{
						alert("Please Enter Mobile Number");
						theFrm.Mobile.focus();
					return false;
					}
					  if(isNaN(theFrm.Mobile.value)|| theFrm.Mobile.value.indexOf(" ")!=-1)
					{
						  alert("Enter numeric value");
						  theFrm.Mobile.focus();
						  return false;  
					}
					if (theFrm.Mobile.value.length < 10 )
					{
							alert("Please Enter 10 Digits"); 
							 theFrm.Mobile.focus();
							return false;
					}
					if ((theFrm.Mobile.value.charAt(0)!="9") && (theFrm.Mobile.value.charAt(0)!="8"))
					{
							alert("The number should start only with 9 or 8");
							 theFrm.Mobile.focus();
							return false;
					}
					if (theFrm.query_type.selectedIndex==1)
					{
						if (theFrm.product_type.selectedIndex==0)
					{
						alert("Please enter Product Type to continue");
						theFrm.product_type.focus();
						return false;
					}
					}
					else
	{
					if(!btn3)
					{
						alert('Please Select Product you deal in.');
						return false;
					}
					
					if(theFrm.Company.value=="")
					{
						alert("Please Enter Bank Name");
						theFrm.Company.focus();
					return false;
					}
						
	}
									
		return true;
    }


	function hidefewthings()
{
	//alert(document.getElementById('Employment_Status').value);
	 if ((agent_frm.query_type.value=="1"))
       {
               document.getElementById('producttype').style.visibility = 'visible';
			    document.getElementById('producttype1').style.visibility = 'visible';
				document.getElementById('productdeal').style.visibility = 'hidden';
				document.getElementById('productdeal1').style.visibility = 'hidden';
				document.getElementById('associatedbank').style.visibility = 'hidden';
				document.getElementById('associatedbank1').style.visibility = 'hidden';
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
                document.getElementById('productdeal').style.visibility = 'visible';
				document.getElementById('productdeal1').style.visibility = 'visible';
				document.getElementById('associatedbank').style.visibility = 'visible';
				document.getElementById('associatedbank1').style.visibility = 'visible';
			   document.getElementById('producttype').style.visibility = 'hidden';
			    document.getElementById('producttype1').style.visibility = 'hidden';
       }

       return true;
}   

function showDivs(prefix,chooser) {
        for(var i=0;i<chooser.options.length;i++) {
                var div = document.getElementById(prefix+chooser.options[i].value);
                div.style.display = 'none';
        }
        var div = document.getElementById(prefix+chooser.value);
        div.style.display = 'block';
}
window.onload=function() {
  document.getElementById('query_type').value='0';//set value to your default
}
    </Script>

<div id="rgtbar">

<form name="agent_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
  <table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#f4e46c">
        
       <tr>
      <td height="50" align="center" valign="middle" class="frmtp"  style=" background-image:url(http://www.bimadeals.com/new-images/frm-tp.gif); background-repeat:no-repeat;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px; text-align:center;	font-weight:bold;	color:#063149;">DSA’s/Banks Registration form </td>
    </tr>
    <tr>
         <tr>
      <td align="right" style="padding-top:10px;"><table width="95%" align="right" cellpadding="0" cellspacing="0">
            <tr>
            <tr>
              <td width="40%" height="25" class="frmbldtxt">Name<font size="1" color="#FF0000">*</font></td>
              <td width="60%" align="left"><input name="From_Name" type="text" class="form" style="width:120px;"/></td>
            </tr>
            <tr>
              <td height="25" class="frmbldtxt">Email ID<font size="1" color="#FF0000">*</font></td>
              <td align="left"><input name="From_Email" type="text" class="form" style="width:120px;"/></td>
            </tr>
            <tr>
              <td height="25" class="frmbldtxt">I am <font size="1" color="#FF0000">*</font></td>
              <td align="left"><select size="1" name="query_type" id="query_type" onChange="showDivs('div',this);" style="width:124px;">
                  <option value="0">Please Select</option>
                  <option value="1">Looking for Loan</option>
                  <option value="2">Running Loan Business</option>
              </select>              </td>
            </tr>
            <tr>
              <td height="25" class="frmbldtxt">City <font size="1" color="#FF0000">*</font></td>
              <td align="left"><select size="1" name="city" id="city" onChange="cityother()"  style="width:124px;">
                  <?=getCityList($city)?>
              </select>              </td>
            </tr>
            <tr>
              <td height="25" class="frmbldtxt">Other City<font size="1" color="#FF0000">*</font></td>
              <td width="60%" align="left"><input type="text" name="city_other" id="city_other" disabled value="Other City" onFocus="this.select();"  style="width:120px;"/></td>
            </tr>
            <tr>
              <td height="25" valign="top" class="frmbldtxt">Mobile<font size="1" color="#FF0000">*</font></td>
              <td align="left" class="frmbldtxt">+91
              <input name="Mobile" id="Mobile" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; type="text" class="form" style="width:92px;" maxlength="10"/></td>
            </tr>
            <tr>
              <td valign="middle"  class="frmbldtxt" colspan="2"><div id="div0" style="display:block;">
                  <table border="0"  cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td valign="top"   class="frmbldtxt">Product you <br>
                        deal in<font size="1" color="#FF0000">*</font></td>
                      <td align="left" valign="middle"  class="frmbldtxt"><input type="checkbox" value='Personal Loan'class="NoBrdr" id="Product" name="Product[]" style="border:none;" />
                        Personal Loan<br>
                        <input type="checkbox" value='Home Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                        Home Loan <br>
                        <input type="checkbox" value='Car Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                        Car Loan <br>
                        <input type="checkbox" value='Loan Against Property' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                        Loan Against Property<br>
                        <input type="checkbox" value='Business Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                        Business Loan <br>
                        <input type="checkbox" value='Credit Card' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                        Credit Card</td>
                    </tr>
                    <tr>
                      <td  class="frmbldtxt">Association with which Bank<font size="1" color="#FF0000">*</font></td>
                      <td align="left"><input name="Company" type="text" class="form"  style="width:120px;"/></td>
                    </tr>
                  </table>
              </div>
                  <div id="div1" style="display:none;">
                    <table border="0"  cellpadding="0" cellspacing="0" width="220"   >
                      <tr>
                        <td valign="middle"  class="frmbldtxt">Product Type <font size="1" color="#FF0000">*</font></td>
                        <td align="left" valign="middle"  class="frmbldtxt" width="60%" ><select size="1" name="product_type" id="product_type" style="width:120px;" >
                            <option value="-1">Please Select</option>
                            <option value="Req_Loan_Personal">Personal Loan</option>
                            <option value="Req_Loan_Home">Home Loan</option>
                            <option value="Req_Loan_Car">Car Loan</option>
                            <option value="Req_Credit_Card">Credit Card</option>
                            <option value="Req_Loan_Against_Property">Loan Against Property</option>
                            <option value="Req_Business_Loan">Business Loan</option>
                          </select>                        </td>
                      </tr>
                    </table>
                  </div>
                <div id="div2" style="display:none;">
                    <table border="0"  cellpadding="0" cellspacing="0" width="220">
                      <tr>
                        <td valign="top"  class="frmbldtxt">Product you <br>
                          deal in<font size="1" color="#FF0000">*</font></td>
                        <td align="left" valign="middle"  class="frmbldtxt"><input type="checkbox" value='Personal Loan'class="NoBrdr" id="Product" name="Product[]"  style="border:none;" />
                          Personal Loan <br>
                          <input type="checkbox" value='Home Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                          Home Loan <br>
                          <input type="checkbox" value='Car Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                          Car Loan <br>
                          <input type="checkbox" value='Loan Against Property' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                          Loan Against Property<br>
                          <input type="checkbox" value='Business Loan' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                          Business Loan <br>
                          <input type="checkbox" value='Credit Card' class="NoBrdr"  id="Product" name="Product[]"  style="border:none;" />
                          Credit Card</td>
                      </tr>
                      <tr>
                        <td  class="frmbldtxt">Association with which Bank<font size="1" color="#FF0000">*</font></td>
                        <td align="left"><input name="Company" type="text" class="form"  style="width:120px;"/></td>
                      </tr>
                    </table>
                </div></td>
            </tr>
            <tr>
              <td height="40" colspan="2" align="center" valign="middle"><input name="image" type="image" style="width:101px; height:33px; border:none;" src="<?php echo $WebsitePath;?>new-images/sbtn1.gif" /></td>
            </tr>
          </table></td>
        </tr>
		 <tr>
          <td height="13" ><div id="frmbt"></div></td>
    </tr>
    </table>
  </form>
<div align="center">

<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#333333; line-height:22px;">Advertisement</span><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 10/26/09 */
google_ad_slot = "1962172606";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>


</div>