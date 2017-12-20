<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);

$Sql = "SELECT `Dated` AS DATE_OF_CALLING, MONTHNAME(`Dated`) AS CALLING_MONTH, `City` AS CITY_NAME, `City` AS Region, `Name` AS CUSTOMER_NAME, `Mobile_Number` AS MOBILE_NO, `DOB` AS DOB, 'deal4loans' AS CAMPAIGN_NAME, '' AS SOURCE_1, `Pancard` AS PAN_NO, '' AS SOURCE_2M, '' AS PQ_LEADS, '' AS SOURCE_3, '' AS CODE, '' AS SFA_ID, 'PRODUCT' AS PRODUCT, `Landline` AS RESILANDLINENO_POSTPAIDMOBILE, `Residence_Address` AS RESIDENCE_ADDRESS, `Pincode` AS RESI_PINCODE, '' AS OFFICE_LAND_LINE_NUMBER, `Company_Name` AS COMPANY_NAME, `Office_Address` AS OFF_ADDRESS, 'OFF PINCODE' AS OFF_PINCODE, 'CO. EMAIL ID' AS CO_EMAIL_ID, 'DATE OF APPOINTMENT' AS DATE_OF_APPOINTMENT, 'APPT TIME' AS APPT_TIME, 'DOCUMENT TYPE' AS DOCUMENT_TYPE, 'APPOINTMENT PLACE' AS APPOINTMENT_PLACE, 'APPOINTMENT PINCODE' AS APPOINTMENT_PINCODE, 'PBO NAME' AS PBO_NAME, 'CM AGE' AS CM_AGE, 'SALARY' AS SALARY, 'TL NAME' AS TL_NAME, 'STATUS' AS STATUS, 'COMMENT' AS COMMENT, 'EXTRA COMMENT' AS EXTRA_COMMENT, 'AUDITOR NAME' AS AUDITOR_NAME, 'ALTERNATE MOBILE NO.' AS ALTERNATE_MOBILE_NO FROM `Req_Credit_Card` WHERE `RequestID` = 945578";
$exportData = ExecQuery($Sql);
$fields = mysql_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $exportData , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}


$output = "$header\n$result";
$csvfile = 'export.csv';

$csv_handler = fopen ($csvfile,'w');
fwrite ($csv_handler,$output);
fclose ($csv_handler);
 
//OR
//file_put_contents($outfile, $output);

sleep(5);

/*if (function_exists('system')) {
    echo "system functions are available.<br />\n";
} else {
    echo "system functions are not available.<br />\n";
}exit;*/
$password = '123456';
$outfile = $_SERVER['DOCUMENT_ROOT'].'/zipfiles/export.zip';
$infile = 'export.csv';
shell_exec("zip -qjP $password $outfile $infile");
//echo system("zip -P $password $outfile $infile");
readfile($outfile);

?>
