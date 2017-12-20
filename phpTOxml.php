<?php 
$link = mysql_connect('localhost','mf','mataji') or die('Cannot connect to the DB');
	mysql_select_db('d4l',$link) or die('Cannot select the DB');
/*if(!$dbconnect = mysql_connect('localhost', 'mf', 'mataji')) {
   echo "Connection failed to the host 'localhost'.";
   exit;
} // if
if (!mysql_select_db('d4l')) {
   echo "Cannot connect to database 'test'";
   exit;
} // if*/

$table_id = 'Req_Loan_Home';
$query = "SELECT Name AS Cust_Name,Email AS Cust_Email,Mobile_Number AS Cust_Mobile,DOB AS Cust_DOB,City AS Cust_City,City_Other AS Cust_OtherCity,Pincode AS Cust_Pincode,Employment_Status AS Cust_Occupation, Net_Salary AS Cust_Income,Loan_Amount AS Cust_LoanAmt,Property_Value AS Cust_PropertyValue Where $table_id";
$dbresult = mysql_query($query, $link);
// create a new XML document
$doc = new DomDocument('1.0');
// create root node
$root = $doc->createElement('root');
$root = $doc->appendChild($root);
// process one row at a time
while($row = mysql_fetch_assoc($dbresult)) {
 // add node for each row
  $occ = $doc->createElement($table_id);
  $occ = $root->appendChild($occ);
 // add a child node for each field
  foreach ($row as $fieldname => $fieldvalue) {
  $child = $doc->createElement($fieldname);
    $child = $occ->appendChild($child);
 $value = $doc->createTextNode($fieldvalue);
    $value = $child->appendChild($value);  } // foreach
} // while
// get completed xml document
$xml_string = $doc->saveXML();
echo $xml_string;
?> 
