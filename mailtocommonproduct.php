<? 
require 'scripts/db_init.php';

$plcitylist="Select citylist From  product_wisecitylist Where ( product=1 )";
list($alreadyExist,$row)=Mainselectfunc($plcitylist,$array = array());

$plcityliststr = $row["citylist"];
$nstr=explode(',', trim($plcityliststr));

print_r($nstr);

if (in_array("Delhi", $nstr)) {
    echo "Got Delhj";
}
else
{
	echo "<br>fff";
}

?>