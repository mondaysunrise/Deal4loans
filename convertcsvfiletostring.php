<?php
require 'scripts/session_check_online.php';

error_reporting(E_ALL);
ini_set('display_errors',1);

$csvstr = '';
if(isset($_POST['submit'])){
	$tmpName = $_FILES['file']['tmp_name'];

	if (($handle = fopen($tmpName, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			for ($c=0; $c < $num; $c++) {
				$csvstr .= $data[$c].',';
			}
			$finaldata[] = $data;
		}
		fclose($handle);
	}
	
	$csvstr = rtrim($csvstr,',');
	//echo $csvstr;
	//echo '<pre>';print_r($finaldata);
	//exit;
}
?>
<table width="70%">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

<tr>
<td width="20%">Select CSV file</td>
<td width="80%"><input type="file" name="file" id="file" /></td>
</tr>

<tr>
<td width="20%"></td>
<td width="80%"><input type="submit" name="submit" /></td>
</tr>

<tr height="20px;">
</tr>

<tr>
<td width="20%">Final Csv String</td>
<td width="80%"><textarea rows="5" cols="100" name="csvstring"><?php echo $csvstr; ?></textarea></td>
</tr>

</form>
</table>
