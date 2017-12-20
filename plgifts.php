<?php
require 'scripts/db_init.php';

echo $hdfcred_email=$_REQUEST["email"];
echo $hdfcred_uniqueid = $_REQUEST["uniqueid"];
 $Dated = ExactServerdate();

if(strlen($hdfcred_email)>2 && $hdfcred_uniqueid>1)
{
$hdfcredqry = "INSERT INTO hdfcred_pixel_capture (hdfcred_email, hdfcred_uniqueid, hdfcred_date) VALUES ('".$hdfcred_email."','".$hdfcred_uniqueid."', NOW())";
$result=ExecQuery($hdfcredqry);

$dataInsert = array("hdfcred_email"=>$hdfcred_email, "hdfcred_uniqueid"=>$hdfcred_uniqueid, "hdfcred_date"=>$Dated);
$table = 'hdfcred_pixel_capture';
$insert = Maininsertfunc ($table, $dataInsert);

}
echo $hdfcredqry;

?>