<div class="section_poll">
<form name="frmPollForLoan" action="http://www.deal4loans.com/poll-for-loan-save.php" method="POST" onSubmit="return checkFormPoll();">
<input type="hidden" name="submit_poll" value="Submit_Poll_Content" />
<div class="column1_poll">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="56%" height="35" class="body-textpoll" scope="row"><input name="employment_status" type="radio" value="0" />Self Employed</td>
      <td width="44%" height="35" align="right" class="body-textpoll"><input name="employment_status" type="radio" value="1" />Salaried</td>
    </tr>
  </table>
</div>
<div class="column2_poll">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="body-textpoll" scope="row">Annual Income</td>
      <td align="center">
      <select name="annual_income" class="select_bank_poll">
        <option value="">Select Annual Income</option>
        <option value="1">1 - 3 lacs</option>
        <option value="2">3 - 5 lacs</option>
        <option value="3">5 - 7 lacs</option>
        <option value="4">7 lacs & above</option>
      </select>
      </td>
    </tr>
  </table>
</div>
</p>
<div style="clear:both; height:15px;"></div>
<p>
<div class="column1_poll">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%" height="35" class="body-textpoll" scope="row">Type of Loan </td>
      <td width="60%" align="right" class="body-textpoll" scope="row">
      <select name="loan_type" class="select_bank_poll"> 
            <option value="">Select Loan Type</option>
            <option value="1">Personal Loan</option>
            <option value="2">Home Loan</option>
            <option value="3">Car Loan</option>
            <option value="5">Loan Against Property</option>
      </select>
      </td>
    </tr>
  </table>
</div>
<div class="column2_poll">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="39%" class="body-textpoll" scope="row">Loan Amount</td>
      <td width="61%" align="center">
      <select name="loan_amount" class="select_bank_poll"> 
        <option value="">Select Loan Amount</option>
        <option value="1">1 - 3 lacs</option>
        <option value="2">3 - 5 lacs</option>
        <option value="3">5 - 7 lacs</option>
        <option value="4">7 lacs &amp; above</option>
      </select>
      </td>
    </tr>
  </table>
</div>
</p>
<div style="clear:both; height:15px;"></div>
<p>
<div class="column3-poll">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="28%" scope="row">Preferred Banks </td>
      <td width="72%"><div class="bank_logo-icon_poll">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="20%" scope="row"><input id="city-bank" name="preferred_bank[]" type="checkbox" value="Citibank" /></th>
            <td width="80%"><img src="http://www.deal4loans.com/images/citi-bank-icon.jpg" width="42" height="12" alt="Citi bank" /></td>
          </tr>
      </table>
      </div>
      <div class="bank_logo-icon_poll">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="20%" scope="row"><input id="hdb-financial" name="preferred_bank[]" type="checkbox" value="HDBFS" /></th>
            <td width="80%"><img src="http://www.deal4loans.com/images/hdb-icon-poll.jpg" width="51" height="15" alt="HDB" /></td>
          </tr>
        </table>
      </div>
      <div class="bank_logo-icon_poll" style="width:80px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="20%" scope="row"><input id="hdfc-bank" name="preferred_bank[]" type="checkbox" value="HDFC" /></th>
            <td width="80%"><img src="http://www.deal4loans.com/images/hdfc-bank-icon.png" width="61" height="15" alt="HDFC Bank" /></td>
          </tr>
        </table>
      </div>
      <div class="bank_logo-icon_poll">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="20%" scope="row"><input id="ing-vysya" name="preferred_bank[]" type="checkbox" value="IngVysya" /></th>
            <td width="80%"><img src="http://www.deal4loans.com/images/ing-vysya-icon.png" width="49" height="14" alt="Citi bank" /></td>
          </tr>
        </table>
      </div>
      </td>
   </tr>
</table>
</div>
<div class="column4_poll"><input type="text" id="other-bank" name="other_bank" class="input-new" value="Other Bank" onFocus="if(this.value=='Other Bank'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Other Bank'; }" /></div>
<div style="clear:both;"></div>
<div id="light" class="white_content">
<a href="javascript:void(0)" onClick="closelightbox()" style="float:right"><img src="http://www.deal4loans.com/images/icon_cancel.gif" alt="" /></a>
<div class="column1_poll">
  <table width="361" border="0" cellspacing="2">
    <tr>
      <td width="122" class="body-textpoll">Full Name </td>
    <td width="229">
      <input type="text" id="full-name" name="full_name" class="input-new" value="" />
      </td>
    </tr>
    <tr>
      <td class="body-textpoll">Mobile</td>
      <td><table width="100%" border="0" cellspacing="2">
        <tr>
          <td width="12%">+91</td>
          <td width="88%"><input type="text" id="mobile" name="mobile" class="input-new" value=""  style="width:132px;"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="body-textpoll">Email</td>
      <td><input type="text" id="email" name="email" class="input-new" value="" /></td>
    </tr>
    <tr>
      <td class="body-textpoll">City</td>
      <td><input type="text" id="city" name="city" class="input-new" value="" /></td>
    </tr>
  </table>
</div>
<div style="text-align:center;"><input type="image" name="submit" src="http://www.deal4loans.com/images/submit-btn-poll.png" width="155" height="54" /></div>

</div>
<div id="fade" class="black_overlay"></div>
<p><a href="javascript:void(0)" onClick="checkFormPollOne();"><img src="http://www.deal4loans.com/images/poll-and-win.jpg" width="155" height="54" alt="poll&win" border="0" /></a></p>
</form>
</div>