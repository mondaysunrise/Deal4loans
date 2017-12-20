<?php
	//require 'scripts/session_checkTM.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/session_checkTM.php';

//print_r ($_SESSION);

if(isset($_POST['Submit']))
{
	
	$TCaller_Name = $_POST['TCaller_Name'];
	$TCaller_Code = "TCC".$_POST['TCaller_Code'];

	//  $InsertSql = "INSERT INTO `Telecaller_Mgmt_User` ( `TMU_Name` ,  `TCaller_Code`, `TCallerFlag` ) VALUES ( '".$TCaller_Name."', '".$TCaller_Code."', 1)";
	 
	 $dataInsert = array("TMU_Name"=>$TCaller_Name , "TCaller_Code"=>$TCaller_Code , "TCallerFlag"=>1);
		$table = 'Telecaller_Mgmt_User';
		$insert = Maininsertfunc ($table, $dataInsert);
	 
	 // $Query = ExecQuery($InsertSql);
	  $ID = mysql_insert_id();
	  $msg = "Value Insert";

}

?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" >
function containsalph(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
		{
			return true;
		}
	}
	return false;
}
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}
function poptastic(url)
{
	newwindow=window.open(url,'name','height=100,width=500');
	if (window.focus) {newwindow.focus()}
}
   

function checkEmptyForAuth(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if(Form.TCaller_Name.value=="")
	{
		alert("Kindly fill in your Name!");
		Form.TCaller_Name.focus();
		return false;
	}
	else if(containsdigit(Form.TCaller_Name.value)==true)
	{
		alert("Name contains numbers!");
		Form.TCaller_Name.focus();
		return false;
	}
    for (var i = 0; i < Form.TCaller_Name.value.length; i++) 
	{
		if (iChars.indexOf(Form.TCaller_Name.value.charAt(i)) != -1) 
		{
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.TCaller_Name.focus();
			return false;
	  	}
    }
	
	if(Form.TCaller_Code.value=="")
	{
		alert("Kindly fill in TeleCaller Code!");
		Form.TCaller_Code.focus();
		return false;
	}
	
	
}

	</script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~TopTM.php';?>


  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

 <br>
 <br>
  <table width="712" border="0">
 <tr><td align="center" width="100%">
 <div align="center">

<!--  <p class="bodyarial11"><?=$Msg?></p> -->
<FORM NAME="frmTMEntry" action="TMU_TeleCallerName.php" method="post" onSubmit="return checkEmptyForAuth(document.frmTMEntry);">
			<TABLE ALIGN="center" WIDTH="50%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD>
						<FIELDSET CLASS="textfield">
							
                    <LEGEND> <FONT SIZE="2" TYPE="Comic Sans"><I>TeleCaller Details:</I></FONT> 
                    </LEGEND>

								
                    <TABLE WIDTH="50%" ALIGN="center" CELLPADDING="1" CELLSPACING="1" BGCOLOR="#FFFFFF" BORDER="0">
                      <TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF"> 
                        <TD WIDTH="10" NOWRAP></TD>
                        <TD WIDTH="86" NOWRAP> <DIV ALIGN="right" CLASS="NormalText"> 
                            TeleCaller Name:&nbsp;</DIV></TD>
                        <TD WIDTH="285" NOWRAP> <INPUT NAME="TCaller_Name" TYPE="text" CLASS="textfield" TABINDEX="1" >
                          * </TD>
                      </TR>
                      <TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF"> 
                        <TD NOWRAP></TD>
                        <TD NOWRAP> <DIV ALIGN="right" CLASS="NormalText">TeleCaller 
                            Code:&nbsp;&nbsp;</DIV></TD>
                        <TD NOWRAP> <INPUT NAME="TCaller_Code" TYPE="text" CLASS="textfield" TABINDEX="4">
                          * </TD>
                      </TR>
                      <TR> 
                        <TD COLSPAN="3" NOWRAP> <DIV ALIGN="right"> 
                            <INPUT NAME="Submit" TYPE="submit" CLASS="btnStyle" VALUE="Save" TABINDEX="5">
                            <INPUT NAME="Reset" TYPE="reset" CLASS="btnStyle" VALUE="Cancel"  TABINDEX="6">
                          </DIV></TD>
                      </TR>
                    </TABLE>
						</FIELDSET>
					</TD>
				</TR>

				<TR>
					<TD ALIGN="center">
						<DIV ID="2" ALIGN="top"></DIV>
					</TD>
				</TR>
			</TABLE>
		</FORM>
	<?php
		if(isset($msg))
		{
			
			$ResultSql = "select * from Telecaller_Mgmt_User  where  TMU_ID ='".$ID."' ";
			list($recordcount,$getrow)=MainselectfuncNew($ResultSql,$array = array());
			$cntr=0;
			
			//$Result = ExecQuery($ResultSql);
			//$NumRows = mysql_num_rows($Result);
			 $Update_ID = $getrow[$cntr]['TMU_ID'];
			
	?>
		    <table  cellpadding="4" cellspacing="1" class="blueborder" width="60%">
              <tr> 
                <td colspan="4" align="center"><strong><?php echo $msg; ?></strong></td>
              </tr>
              <tr> 
                <td class="head1">Name</td>
                <td class="head1">Code</td>
              </tr>
              <tr> 
                <td class="bodyarial11"><?php echo $getrow[$cntr]['TMU_Name']; ?></td>
                <td class="bodyarial11"><?php echo $getrow[$cntr]['TCaller_Code']; ?></td>
              </tr>
              
            </table>
		<?php
		}
		?>
 <br>
 
 <br>

 <h3 class="bodyarial11">

    </div>
 </td></tr></table>
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
