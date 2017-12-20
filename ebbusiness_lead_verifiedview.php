<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

           if ($_FILES[csv][size] > 0) { 

                //get the csv file 
                $file = $_FILES[csv][tmp_name]; 
                $handle = fopen($file,"r"); 

                //loop through the csv file and insert into database 
                do { 
                    if ($data[0]) { 

			$getdetails="select custfbvdid From Req_EBBusiness_Leads Where (eb_mobile_number='".$data[2]."')";
				 list($alreadyExist,$checkavailability)=MainselectfuncNew($getdetails,$array = array());
						if($alreadyExist>0)
						{						}
						else
						{
						list($month,$date,$year)= split('[/]',$data[4]);
						$datenow = $year."-".$month."-".$date;

						$Dated = ExactServerdate();
						 
						$dataArray = array('eb_name'=>addslashes($data[0]), 'eb_email'=>addslashes($data[1]), 'eb_mobile_number'=>addslashes($data[2]), 'eb_city'=>addslashes($data[3]), 'eb_dob'=>addslashes($datenow), 'eb_company_name'=>addslashes($data[5]), 'eb_net_salary'=>addslashes($data[6]), 'eb_loan_amount'=>addslashes($data[7]), 'eb_bank_name'=>addslashes($data[8]), 'eb_roi'=>addslashes($data[9]), 'eb_tenure'=>addslashes($data[10]), 'eb_emi'=>addslashes($data[11]), 'eb_dated'=>$Dated);
						$insert = Maininsertfunc ("Req_EBBusiness_Leads", $dataArray);

                    } 
				}
                }  while ($data = fgetcsv($handle,1000,",","'")); 
               
				  //redirect 
                header('Location: ebbusiness_lead_verifiedview.php?success=1'); die; 
            } 
            ?> 
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
            <html xmlns="http://www.w3.org/1999/xhtml"> 
            <head> 
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
            <title>Import a CSV File with PHP & MySQL</title> 
            </head>
            <body> 
            
<?php 	
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";	
?>
<table align="center">
<tr><td><?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> </td></tr>
<tr><td>
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
              Choose your file: <br /> 
			  <table align="center">
			  <tr><td height="50">
              <input name="csv" type="file" id="csv" /> </td></tr>
			  <tr><td>
              <input type="submit" name="Submit" value="Submit" /> </tr>
            </form> 
</td></tr></table>
            </body> 
            </html> 