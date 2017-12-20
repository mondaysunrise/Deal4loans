<?php

$output= '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><submitApplicationResponse xmlns="http://tempuri.org/"><submitApplicationResult><status><success>true</success><failure>false</failure></status><successResponse><approved>false</approved><decline>true</decline><pending>false</pending><cancelled>false</cancelled><successResponseMessage /><declineReason><duplicate>false</duplicate><invalidcity>false</invalidcity><lessincome>false</lessincome><gnadecline>false</gnadecline><invalidpincode>true</invalidpincode></declineReason></successResponse><failureResponse><authenticationFailure>false</authenticationFailure><dataValidationFailure>false</dataValidationFailure><unhandledException>false</unhandledException><validationError><errorDesc /></validationError></failureResponse><objStatus xsi:type="clsstatus"><success>true</success><failure>false</failure></objStatus><objSuccessResponse xsi:type="clssuccessResponse"><approved>false</approved><decline>true</decline><pending>false</pending><cancelled>false</cancelled><successResponseMessage /><declineReason><duplicate>false</duplicate><invalidcity>false</invalidcity><lessincome>false</lessincome><gnadecline>false</gnadecline><invalidpincode>true</invalidpincode></declineReason></objSuccessResponse><objFailureResponse xsi:type="clsfailureResponse"><authenticationFailure>false</authenticationFailure><dataValidationFailure>false</dataValidationFailure><unhandledException>false</unhandledException><validationError><errorDesc /></validationError></objFailureResponse><recordId xsi:nil="true" /></submitApplicationResult></submitApplicationResponse></soap:Body></soap:Envelope>';


$output = str_replace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><submitApplicationResponse xmlns="http://tempuri.org/">', '', $output);

$output = str_replace('</submitApplicationResponse></soap:Body></soap:Envelope>', '', $output);

$xml = new SimpleXMLElement($output);
echo "<pre>";
print_r($xml);
echo "<br>*****************************************************<br>";
echo $status = $xml->status->success;
echo "<br>";
echo "<br>*****************************************************<br>";
$successResponse = $xml->successResponse;
print_r($successResponse);


/*
** Connect to database:
Database Name: Deal4Loans
User ID: sa
Password: PlanetZone99
Server IP: 182.75.121.202
Table name: Emp_Info
Database: SQL Server 2005

*/
 
// $connection = mssql_connect('182.75.121.202:1434','sa','PlanetZone99');
//if (!$connection) {  die('Not connected : ' . mssql_get_last_message());} 

// Connect to the database (host, username, password)
//$con = mssql_connect('182.75.121.202','sa','PlanetZone99') or die('Could not connect to the server!');
 
 /*
// Select a database:
mssql_select_db('Deal4Loans') or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
$SQL = "SELECT TOP 10 * FROM Emp_Info ORDER BY Emp_ID ASC";
 
// Execute query:
$result = mssql_query($SQL) or die('A error occured: ' . mssql_error());
 
// Get result count:
$Count = mssql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";
 
// Fetch rows:
while ($Row = mssql_fetch_assoc($result)) {
 
    print $Row['Emp_FirstName'] . "\n";
 
}
 
mssql_close($con);
*/
?>
<?php

/*
** Connect to database:
Database Name: Deal4Loans
User ID: sa
Password: PlanetZone99
Server IP: 182.75.121.202
Table name: Emp_Info
Database: SQL Server 2005

*/
/*

$serverName = "182.75.121.202";
$usr="sa";
$pwd="PlanetZone99";
$db="Deal4Loans";



//Connection to Database
$connectionInfo = array("UID" => $usr, "PWD" => $pwd, "Database" => $db);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn )
{
     echo "Connection to database established.\n";

}
else
{
     echo "Connection could not be established.\n";
     die( print_r( sqlsrv_errors(), true));
}

//-----------------------------------------------
// Perform operations with connection.
//-----------------------------------------------

$sql = "SELECT TOP 10 * FROM Emp_Info ORDER BY Emp_ID ASC";


/* Close the connection. */

?>