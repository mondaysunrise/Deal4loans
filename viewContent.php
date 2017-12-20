<?php
require 'scripts/session_check_onlinelms.php';
$viewContent = $_REQUEST['viewContent'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php 
echo $viewContent;
?>
</body>
</html>
