<?php
require_once("includes/application-top-inner-plcalling.php");
$BidderID = $_SESSION["BidderID"];
$AgentID = $_REQUEST['Agent'];
$QryForAgent = "select BidderID,Email,PWD,Associated_Bank from Bidders where BidderID='".$AgentID."' AND Global_Access_ID LIKE '%$BidderID%'";
$resCountCheck = $objAdmin->fun_get_num_rows($QryForAgent);
$ResultAgent = $obj->fun_db_query($QryForAgent);
$rowAgent = $obj->fun_db_fetch_rs_object($ResultAgent);

if(isset($_REQUEST['Submit']))
{
  $oldPassword = $_REQUEST['oldPassword'];
  $NewPassword = $_REQUEST['NewPassword'];
  $ReNewPassword = $_REQUEST['ReNewPassword'];
  if($NewPassword==$ReNewPassword)
  {
    $QuryUpdate = "UPDATE Bidders SET PWD = '".$NewPassword."' WHERE BidderID = $AgentID";
    $ResultAgent = $obj->fun_db_query($QuryUpdate);
  if($ResultAgent)
  {
    $URLS = "http://www.deal4loans.com/callinglms/agent-change-password.php?Agent=".$AgentID."&st=y";
      redirectURL($URLS);
      $Msg = "Password has been changed";
    } 
  }
  else{
        $URLS = "http://www.deal4loans.com/callinglms/agent-change-password.php?Agent=".$AgentID."&st=n";
        redirectURL($URLS);  
  }
    
    
  }



?>
<html>
    <head>

        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Login</title>
        <script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
        <style>
            /* Pagination*/

            div.pagination {
                padding: 3px;
                margin: 3px;
            }
            div.pagination a {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #AAAADD;
                text-decoration: none; /* no underline */
                color: #000099;
            }
            div.pagination a:hover, div.pagination a:active {
                border: 1px solid #000099;
                color: #000;
            }
            div.pagination span.current {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #000099;
                font-weight: bold;
                background-color: #2b62b5;
                color: #FFF;
            }
            div.pagination span.disabled {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #CCC;
                color: #CCC;
            }
        </style>

    </head>
    <?php 
    if($resCountCheck>0){
    ?>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout2.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
            <div style="background:#F00; width:110px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="plallocation_consolidated.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Search Dashboard</a></div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both; height:15px;"></div>
        <div> 
            <table width="98%" border="0">
                <tr><td align="right" style="font-size:10px; font-weight:bold;"><?php echo $_SESSION['Bidder_Name']; ?></td></tr>
                <tr><td align="center" style="font-size:22px; font-weight:bold;">Supervisory Change Password</td></tr>
                <tr>
                    <td align="right"></td>
                </tr>
                <tr>
                    <td align="center" width="100%"><div align="center">

                            <p>&nbsp;</p>
                          
                            <p><span id="name_status" style="color:#F00; font-weight:bold; text-align: center"></span> </p>
                            <form name="agentChangePass" action="" method="post">
                            <table width="900" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                            <tr>      
                                <td class="bodyarial11" colspan="2" style="text-align: center"><strong>
                                        <span style="color:green"><?php if($_REQUEST['st']=='y') { echo "Password has been changed";}?></span>
                                        <span style="color:red"><?php if($_REQUEST['st']=='n') { echo "New Password and Retype New Password is not Match";}?></span>
                                    </strong></td>
                            </tr>
                                
                                <tr>
                                    <td class="bodyarial11"><strong>Old Password</strong></td>
                                    <td class="bodyarial11"><input type="text" name="oldPassword" value="<?php echo $rowAgent->PWD;?>" readonly="readonly" /></td>
                                </tr>
                                <tr>      
                                    <td class="bodyarial11"><strong>New Password</strong></td>
                                    <td class="bodyarial11"><input type="password" name="NewPassword" /></td>
                                </tr>
                                <tr>
                                    <td class="bodyarial11"><strong>Retype New Password</strong></td>
                                    <td class="bodyarial11"><input type="password" name="ReNewPassword" /></td>
                                </tr>
                                <tr>
                                    <td class="bodyarial11">&nbsp;</td>
                                    <td class="bodyarial11"><input type="submit" name="Submit" value="Change Password" /></td>
                                </tr>
                         </table>
                                </form>
                        </div></td>
                </tr>

            </table>
        </div>

    </body>
    <?php 
    }else {
        echo "Access Denied";
        
        
    }
    ?>
</html>
