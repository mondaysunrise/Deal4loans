<?php
if($_REQUEST['cmbfeedback']=='OTP Done - OK')
{
?>
<select name="bankFeedback">
<option value="">Select bank Feedback</option>
    <option value="Not Eligible">Not Eligible</option>
    <option value="Not Interested - Direct">Not Interested - Direct</option>
    <option value="Not Interested - Offer">Not Interested - Offer</option>
    <option value="Post Login Reject">Post Login Reject</option>
    </select>
    <?php }else {?>
 <select name="bankFeedback" id="bankFeedback" class="demoInputBox">
            <option value="">Select bank Feedback</option>
        </select>
    <?php }?>