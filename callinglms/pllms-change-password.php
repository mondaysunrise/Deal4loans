<?php
require_once("includes/application-top-inner-plcalling.php");
echo $_SESSION["BidderID"];
$qryCheck = "SELECT * FROM Bidders where leadidentifier in ('pl_alloclms_admin','pl_alloclms_subadmin') and BidderID='".$_SESSION["BidderID"]."'";
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
$rowqryCheck = $obj->fun_db_fetch_rs_object($qryCheckResult);

$BidderID = $rowqryCheck->BidderID;
if($BidderID)
{
$QryForAgent = "select BidderID,Email,PWD,Associated_Bank from Bidders where Global_Access_ID LIKE '%$BidderID%'";
$ResultAgent = $obj->fun_db_query($QryForAgent);
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
                            <p class="bodyarial11">
<?= $Msg ?>
                            </p>
                            <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
                            <table width="900" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                               <tr>
                                    <td class="head1">Agent ID</td>
                                     <td class="head1">Agent Name</td>
                                    <td class="head1">Username</td>
                                    <td class="head1">Password</td>
                                    <td class="head1">Status</td>
                               </tr>
                    <?php 
                    while($rowAgent = $obj->fun_db_fetch_rs_object($ResultAgent))
                    {
                    ?> 
                    <tr  bgcolor="<?php echo $colorvar; ?>">
                        <td class="bodyarial11"><?php echo $rowAgent->BidderID; ?></td>                              <td class="bodyarial11"><? echo $rowAgent->Associated_Bank; ?></td>
                        <td class="bodyarial11"><? echo $rowAgent->Email; ?></td>
                        <td class="bodyarial11"><? echo $rowAgent->PWD; ?></td>
                        <td class="bodyarial11"><a href="agent-change-password.php?Agent=<?php echo $rowAgent->BidderID;?>" target="_blank">Change Password</a></td>    </tr>
                               <?php }?>

                            </table>
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
