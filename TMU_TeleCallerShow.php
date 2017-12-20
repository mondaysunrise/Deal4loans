<?php
	//require 'scripts/session_checkTM.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/session_checkTM.php';

//print_r ($_SESSION);


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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

		
	
	<?php
	
			
			$ResultSql = "select * from Telecaller_Mgmt_User  where  TCallerFlag =1 ";
			
			list($NumRows,$getrow)=MainselectfuncNew($ResultSql,$array = array());
			$cntr=0;

			//$Result = ExecQuery($ResultSql);
			//$NumRows = mysql_num_rows($Result);
			
	?>
		    <table  cellpadding="4" cellspacing="1" class="blueborder" width="60%">
           
              <tr> 
                <td class="head1">Name</td>
                <td class="head1">Code</td>
              </tr>
			  <?php 
			  	while($cntr<count($getrow))
        			{
			  ?>
              <tr> 
                <td class="bodyarial11"><?php echo $getrow[$cntr]['TMU_Name']; ?></td>
                <td class="bodyarial11"><?php echo $getrow[$cntr]['TCaller_Code']; ?></td>
              </tr>
              <?php $cntr = $cntr+1;}?>
            </table>
		 <br>
 
 <br>

    </div>
 </td></tr></table>
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
