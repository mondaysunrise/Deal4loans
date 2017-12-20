<?php
//$upload_dir = '/var/www/uploads/';

if($_POST){
  $error = '';
  //print_r($_FILES);
  if($_FILES['file']['size'] == 0 || !is_file($_FILES['file']['tmp_name'])){
     $error .= 'Please select a file for upload!';
	 echo "yash"; die;
  } else {
	 // echo "yes"; die;
    //cl_setlimits(5, 1000, 200, 0, 10485760);
    if($malware = cl_scanfile($_FILES['file']['tmp_name'])) $error .= 'We have Malware: '.$malware.'<br>ClamAV version: ';
 echo "yesdddd"; die;
  }
  if($error == ''){
    rename($_FILES['file']['tmp_name'], $upload_dir.$_FILES['file']['name']);
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>File-Upload</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form method="post" action="" name="fileupload" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr><td><b>File Upload</b></td></tr>
  <tr><td> </td></tr>
  <?php
  if(isset($error)){
    if($error != ''){
  ?>
  <tr><td><?php echo cl_info(); ?></tr>
  <tr><td><b>Error:</b> <?php echo $error; ?></td></tr>
  <?php
    } else {
  ?>
  <tr><td><b>File <?php echo $_FILES['file']['name']; ?> has successfully been uploaded to <?php echo $upload_dir; ?>!</b></td></tr>
  <?php
    }
  }
  ?>
  <tr><td>
    <table width="500" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="126">File:</td>
        <td width="366"><input type="file" name="file" size="30" value="" maxlength="255"></td>
      </tr>
      <tr>
        <td> </td>
        <td><input name="Upload" type="submit" value="Upload"> <input name="Cancel" type="reset" value="Cancel"></td>
      </tr>
    </table>
  </td></tr>
</table>
</form>
</body>
</html>