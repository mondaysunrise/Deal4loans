<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require 'scripts/db_init.php';

$Sql = isset($_POST['qry']) ? $_POST['qry'] : '';
$fileName = isset($_POST['filename']) ? $_POST['filename'] : 'export.xls';

saveDbDataToXls($Sql,$fileName);

function saveDbDataToXls($Sql,$fileName){
	$result = d4l_ExecQuery($Sql);
	
	$header = '';
	$response = '';
	
	$server_path = $_SERVER['DOCUMENT_ROOT'];
	$sep = "\t";
	
	//Column Names
	$names = mysqli_fetch_fields($result) ;
	foreach($names as $name){
		$header .= $name->name . $sep;
	}
	
	//Data
	while($row = mysqli_fetch_row($result)) {
		$schema_insert = "";
		for($j=0; $j<mysqli_num_fields($result);$j++) {
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		
		$response .= trim($schema_insert)."\n";
	}

	if($response == "")
	{
		$response = "\nNo Record(s) Found!\n";                        
	}

	/* Code to download File Start */
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$fileName");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$response";
	/* Code to download File End */

	/* Code to save data in File Start 
	$output = "$header\n$response";
	$csvfile = $server_path.'/data/files/'.$fileName';
	file_put_contents($csvfile, $output);
	/* Code to save data in File End */
}

?>

