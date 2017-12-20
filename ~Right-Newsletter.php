<script>
function checknewsletter_subscription(Form)
{
	if(Form.fullname.value=="" || Form.fullname.value=="Full Name")
	{
		alert("Please fill your name.");
		Form.fullname.focus();
		return false;
	}
	if(Form.email_id.value=="" || Form.email_id.value=="Email Id" )
	{
		alert("Please Enter Email.");
		Form.email_id.focus();
		return false;
	}
	var str=Form.email_id.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					Form.email_id.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					Form.email_id.focus();
					return false;
					}

}
</script>
<script type="text/javascript">
function removtxt(element)
{
  if ( element.value != '' )
  {
      element.value = '';
  }
}
</script>

<div style=" background-image: url(http://www.deal4loans.com/images/newlter-form.gif); float:right; width:240px; height:190px; background-repeat:no-repeat;">
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><form name="newsletter" action="subscribe_newsletter.php" method="POST" onSubmit="return checknewsletter_subscription(document.newsletter);">
          <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="56" align="center" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold; " >Subscribe for Newsletter</td>
            </tr>
            <tr>
              <td height="35" align="center"><input type="text" name="fullname" value="Full Name" style="width:150px;  font-size: 12px; " maxlength="30" onclick="removtxt(this);" ></td>
            </tr>
            <tr>
              <td height="35" align="center"><input type="text" name="email_id" value="Email Id" style="width:150px; font-size: 12px; " onclick="removtxt(this);" ></td>
            </tr>
            <tr>
              <td height="42" align="right" valign="bottom" style="padding-right:15px;"><input type="submit" name="submit" style="background-image: url(http://www.deal4loans.com/images/sbscrb-btn.gif); background-repeat: no-repeat; width: 107px; height: 29px; background-position: center; border:none; font-size: 0px; " value="submit"/></td>
            </tr>
          </table>
        </form></td>
    </tr>
    <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "latest-newsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "viewnewsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "newsletter-archives-main")) > 0) )
	 {	
		
   
		  $newsqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
	//		 echo "ffff".$newsqry;
			 
			  list($rowscount,$Arrrow)=MainselectfuncNew($newsqry,$array = array());
			$cntr=0;
			  $recordcount = count($Arrrow);
			  ?>
  </table>
  <table width="100%" border="0" align="center"  cellpadding="0" cellspacing="0" bgcolor="#e5f4fe">
    <tr>
      <td height="40" align="center" valign="middle"  background="/images/nwsltr-bg.gif" style="background-repeat:no-repeat;  font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold; "  > Newsletter Menu</td>
    </tr>
    <tr>
      <td style="padding-left:20px; margin-left:20px;"><ul>
          <?
		
while($cntr<count($Arrrow))
        {
			$News_Content =$Arrrow[$cntr]['News_Content'];
			$News_Subject = $Arrrow[$cntr]['News_Subject'];
			$News_Date = $Arrrow[$cntr]['News_Month'];
			$subject = substr($News_Subject, 0, 25);
		 ?>
          <li style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; text-align:left; font-weight:normal; color:#CCCCCC; line-height:18px;"><a href="javascript:ajaxpage('<? echo "/".$News_Content;?>', 'contentarea');"><? echo  $News_Date."-".$subject."...";?></a></li>
          <!--<tr>
		<td style="padding-left:10px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; text-align:left; font-weight:normal; color:#042759; line-height:18px;"> &bull; <a href="javascript:ajaxpage('<? //echo "/".$News_Content;?>', 'contentarea');"><? // echo  $News_Date."-".$subject."...";?></a> <BR/></td></tr> -->
          <?
		$cntr = $cntr +1; }
		 
		 ?>
        </ul></td>
    </tr>
    <?
		 }
		 ?>
  </table>
</div>
