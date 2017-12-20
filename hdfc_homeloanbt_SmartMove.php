<? 
require 'scripts/functions.php';
require 'scripts/db_init.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$txtName = $_POST["txtName"];
	$txtmobileno = $_POST["txtmobileno"];
	$txtresidence = $_POST["txtresidence"]; 
	$txtloan = $_POST["txtloan"];
	

	if(strlen($txtName)>0 && strlen($txtmobileno)>9 && strlen($txtresidence)>1 &&  strlen($txtloan)>1)
	{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

		$getdetails="select hdfchlbt_id From HDFC_homeloanBT Where ( hdfchlbt_mobile not in (9971396361,9811215138,9811555306,9999570210) and hdfchlbt_mobile='".$txtmobileno."' and hdfchlbt_date between '".$days30datetime."' and '".$currentdatetime."') order by hdfchlbt_id DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());

	if($alreadyExist>0)
	{

	}
	else
	{
		
		$Dated = ExactServerdate();
		$data = array("hdfchlbt_name"=>$txtName , "hdfchlbt_mobile"=>$txtmobileno , "hdfchlbt_city"=>$txtresidence ,  "hdfchlbt_outstandingloan"=>$txtloan ,  "hdfchlbt_date"=>$Dated );
		$insert = Maininsertfunc ('HDFC_homeloanBT', $data);
	}
		
	}
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>HDFC Smart Move</title>
    <script type="text/javascript">
    function validation()
    {
        if(document.getElementById('txtName').value=="")
        {
            alert("Please enter name");
            return false;
        }
        
        if(document.getElementById('txtmobileno').value=="")
        {
            alert("Please enter mobile no");
             return false;
        }
        		
        if(document.getElementById('txtresidence').selectedIndex==0)
        {
             alert("Please select city of residence");
              return false;
        }
        
        if(document.getElementById('txtloan').value=="")
        {
            alert("Please enter outstanding load amount");
             return false;
        }
        return true;
    }
    
    function keyRestrict(e, validchars)
    {
    debugger;
	    var key='', keychar='';
	    key = getKeyCode(e);
	    if (key == null) return true;
	    keychar = String.fromCharCode(key);
	    keychar = keychar.toLowerCase();
	    validchars = validchars.toLowerCase();
	    if (validchars.indexOf(keychar) != -1)
		    return true;
	    if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
		    return true;
	    return false;
	 }
	 
	 function getKeyCode(e)
	 {
	    if (window.event)
	       return window.event.keyCode;
	    else if (e)
	       return e.which;
	    else
	       return null;
	}
    
    </script>

    <style type="text/css">
        body
        {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            font-size: 12px;
            background-color: #333333;
        }
        .tabform
        {
            background-color: #FFF;
            padding-left: 35px;
            padding-bottom: 20px;
        }
        .nametext
        {
            width: 500px;
            border: solid 1px #CCC;
        }
        .mobileno
        {
            border: solid 1px #CCC;
            width: 215px;
        }
        .cityofresidence
        {
            border: solid 1px #CCC;
            width: 154px;
        }
        .loanamount
        {
            border: solid 1px #CCC;
            width: 123px;
        }
    </style>
</head>
<body>
    
    <div>
        <table width="650px" border="0" cellspacing="0" cellpadding="0" align="center" class="tabform">
            <tr>
                <td valign="top" style="padding-top: 34px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="75%" style="padding-top: 32px;">
							<? if(strlen($txtName)>0 && strlen($txtmobileno)>9 && strlen($txtresidence)>1 &&  strlen($txtloan)>1)
			{
			 ?>
			 <img src="/emailer/images/hdfchlbt_make-smart-move2.jpg" width="250" height="33" alt="" />
			 <? } else 
			 { ?>
                                <img src="/emailer/images/hdfchlbt_make-smart-move.jpg" width="250" height="45" alt="" />
								<? 
			 } ?>
                            </td>
                            <td width="25%" valign="middle">
                                <img src="/emailer/images/hdfchlbt-logo.jpg" width="106" height="52" alt="" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
			<? if(strlen($txtName)>0 && strlen($txtmobileno)>9 && strlen($txtresidence)>1 &&  strlen($txtloan)>1)
			{
			 ?>
			 <tr>
			 <td height="50" valign="middle">
				<div style="color: #EE1C25; font-family:Arial, Helvetica, sans-serif; font-weight:800;" align="center">Thank you , you will receive call  shortly.</div>
				</td></tr>
			 <? }
			else 
			{ ?>
            <tr>
                <td valign="top" style="padding-top: 33px;">
				<form id="hdfcBT" name="hdfcBT" method="post" onSubmit="return validation(); " action="<? echo $_SERVER['PHP_SELF'] ?>">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2" align="left" valign="top" style="height: 34px;">
                                Name
                                <input tyep="text" ID="txtName" name="txtName" onkeypress="return keyRestrict(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ '+String.fromCharCode(241))" CssClass="nametext">
                            </td>
                        </tr>
                        <tr>
                            <td width="47%" valign="top" style="padding-top: 10px;">
                                Mobile No.
                                <input tyep="text" ID="txtmobileno"  name="txtmobileno" onkeypress="return keyRestrict(event,'0123456789'+String.fromCharCode(241))"
                                    MaxLength="12" CssClass="mobileno">
                            </td>
                            <td width="53%" valign="top" style="padding-top: 10px;">
                                City of residence
                                <label for="residence">
                                </label>
								<select name="txtresidence" id="txtresidence" CssClass="cityofresidence" tabindex="7">
                            <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select>
                               <!--<input tyep="text" ID="txtresidence" runat="server" onkeypress="return keyRestrict(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ '+String.fromCharCode(241))" CssClass="cityofresidence"> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" valign="top" style="padding-top: 24px;">
                                Outstanding loan amount<img src="/emailer/images/hdfchlbt_rupee-symbol.jpg" width="6" height="9" alt=""
                                    style="padding-left: 5px;" />
                                <input tyep="text" ID="txtloan" name="txtloan" onkeypress="return keyRestrict(event,'0123456789.'+String.fromCharCode(241))"
                                    MaxLength="12" CssClass="loanamount">
                            </td>
                        </tr>
						<tr>
                <td style="padding-top: 36px;" colspan="2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="76%">&nbsp;
                                
                            </td>
                            <td width="24%">
							<input type="image" name="Submit"  src="/emailer/images/hdfchlbt_submit-btn.jpg" ID="imgbtnSubmit" style="width:96px; height:29px; border:none; " />
                              
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>            
                    </table> </form>
                </td>
            </tr>
			<? } ?>
        </table>
    </div>
   
</body>
</html>
