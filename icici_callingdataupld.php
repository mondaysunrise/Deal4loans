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
			$getdetails="select RequestID From icici_cards_calling Where (Mobile_Number='".$data[5]."')";
			list($alreadyExist,$checkavailability)=MainselectfuncNew($getdetails,$array = array());
					if($alreadyExist>0)
						{		}
						else
						{
							if((is_numeric($data[5])) && (is_numeric($data[6])) && (strlen($data[0])>2))
							{
						list($monthstr,$datestr,$year)= split('[/]',$data[2]);
						if(strlen($datestr)==1)
								{
									$date="0".$datestr;
								}
								else
								{
									$date=$datestr;
								}
						if(strlen($monthstr)==1)
						{
							$month="0".$monthstr;
						}
						else
						{
							$month=$monthstr;
						}
						$datenow = $year."-".$month."-".$date;
						$Dated = ExactServerdate();
					
						
						$dataArray = array('Name'=>addslashes($data[0]), 'Email'=>addslashes($data[1]), 'DOB'=>addslashes($datenow), 'Company_Name'=>addslashes($data[3]), 'City'=>addslashes($data[4]), 'Mobile_Number'=>addslashes($data[5]), 'Net_Salary'=>addslashes($data[6]), 'source'=>'manual upld', 'Dated'=>$Dated);
						$insert = Maininsertfunc ("icici_cards_calling", $dataArray);
						}
						
                    } 
				}
                }  while ($data = fgetcsv($handle,1000,",","'")); 
               
                //redirect 
                //header('Location: customer_feedback_verifiedview.php?success=1'); die; 
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