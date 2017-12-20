<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';
$Sql = "SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY, City_Other AS Cust_OtherCity, Pincode AS CUST_PINCODE, Employment_Status AS CUST_OCCUPATION, TRUNCATE( Net_Salary, 0 ) AS CUST_INCOME, TRUNCATE( Loan_Amount, 0 ) AS CUST_LOANAMT, TRUNCATE( Property_Value, 0 ) AS CUST_PROPERTYVALUE, Company_Name AS CUST_EMPLOYER, Property_Loc AS CUST_PROPLOCATION
FROM Req_Feedback_Bidder_HL, Req_Loan_Home
WHERE Req_Feedback_Bidder_HL.AllRequestID = Req_Loan_Home.RequestID
AND Req_Feedback_Bidder_HL.BidderID =1329
AND (
Req_Feedback_Bidder_HL.Allocation_Date
BETWEEN '2016-12-01 00:00:00'
AND '2016-12-31 23:59:59'
)";
		$exportData = ExecQuery($Sql);
		$numRec = mysql_num_rows($Query);

               
                
                
                
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
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>
