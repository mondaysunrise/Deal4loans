<div class="cc-form-wrapper">
  <div class="cc_terms_box">
    <h2 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong><? //echo $subjectLine;?></strong></h2>
  </div>
  <div style="clear:both;"></div>
  <form  name="creditcard_form" id="creditcard_form" action="credit-card-continue_100616.php?rqid=<? echo $_REQUEST['rqid']; ?>&category_tag=<?php echo $card_category;?>" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
  
    <div style="clear:both;"></div>
    <div class="p-details"><strong>Personal Details</strong></div>
    <div style="clear:both;"></div>
    
    <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="cc-form-text">Date of Birth <span class="red">*</span></td>
          </tr>
          <tr>
<td height="25"><select name="day" id="day" class="ccdob" onchange="validateDiv('dayVal');">
                  <option value="">Day</option>
                  <option value="01">01</option>
                  <option value="02">02</option>
                  <option value="03">03</option>
                  <option value="04">04</option>
                  <option value="05">05</option>
                  <option value="06">06</option>
                  <option value="07">07</option>
                  <option value="08">08</option>
                  <option value="09">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select>
                <select name="month" id="month" class="ccdob" onchange="validateDiv('monthVal');">
                  <option value="">Month</option>
                  <option value="01">Jan</option>
                  <option value="02">Feb</option>
                  <option value="03">Mar</option>
                  <option value="04">Apr</option>
                  <option value="05">May</option>
                  <option value="06">Jun</option>
                  <option value="07">Jul</option>
                  <option value="08">Aug</option>
                  <option value="09">Sep</option>
                  <option value="10">Oct</option>
                  <option value="11">Nov</option>
                  <option value="12">Dec</option>
                </select>
                <select name="year" id="year" class="ccdob" onchange="validateDiv('yearVal'); showhidePersonalDetails(event)">
                  <option value="">Year</option>
                  <?php for($y=$minage; $y>=$maxage; $y--) {?>
                  <option value="<?php echo $y;?>"><?php echo $y;?></option>
                  <?php }?>
                </select>
            </td>
          </tr>
        </table>
		
    </div>
          <div class="new-input-box">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="cc-form-text">Credit Card Holder? <span class="red">*</span></td>
          </tr>
          <tr>
            <td height="25"> <input type="radio" name="CC_Holder" id="radio-one" value="1" class="css-checkbox" onclick="addElement(this.value);" />
                 <label for="radio-one" class="css-label radGroup2" >Yes</label>
                
                  <input type="radio" name="CC_Holder" id="radio-two" value="2" class="css-checkbox" onclick="removeElement(this.value);"/>
                   <label for="radio-two" class="css-label radGroup2">No</label></td>
          </tr>
        </table>
    </div>
    
    <div class="new-input-box"  id="NmBank" style="display:none;">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Credit Card Holder? <span class="red">*</span></td>
        </tr>
        <tr>
          <td height="25"><select class="d4l-select" name="No_of_Banks" id="No_of_Banks"  onchange="validateDiv('NumOfBankVal');">
                  <option value="">Please Select</option>
                  <option value="HDFC Bank">HDFC Bank</option>
                  <option value="Standard Chartered">Standard Chartered</option>
                  <option value="Kotak Bank">Kotak Bank</option>
                  <option value="RBL Bank">RBL Bank</option>
                  <option value="ICICI Bank">ICICI Bank</option>
                  <option value="SBI">State Bank of India (SBI)</option>
                  <option value="Other">Other</option>
                </select>
                <div id="NumOfBankVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box" id="loanrunning" style="display:none;">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Are you running any loan?</td>
        </tr>
        <tr>
          <td height="25">
                  <input type="radio" name="loanrunning" id="radio-loans-one" class="css-checkbox" value="3"/>
                  <label for="radio-loans-one" class="css-label radGroup2" >Yes</label>
                  <input type="radio" name="loanrunning" id="radio-loans-two" class="css-checkbox" value="4"/>
                  <label for="radio-loans-two"  class="css-label radGroup2">No</label></td>
        </tr>
      </table>
    </div>
    
     <div style="clear:both; height:10px;">    </div>
       
  
     <label for="check-one">
          <input type="checkbox" name="accept" id="check-one" value="1" onClick="validateDiv('acceptVal');" />
          <span style="color:#FFF;">I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to Privacy policy and Terms and Conditions.</span> </label>
    
    
           <div class="new-input-box">
        <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text" style="float:right !important;"><input type="submit" class="cc-get-quotebtn" value="Get Quote"/>
            </td>
        </tr>
      </table></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
        </table>
           </div>
                  
    <div style="clear:both;"></div><div class="cc_bnt_b"> </div> <div style="clear:both;"><div style="clear:both;"></div></div>
  </form> 
</div>
 <div style="clear:both; height:10px;"></div>