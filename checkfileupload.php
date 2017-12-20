<?php


$UploadFile = $_FILES["uploadFile"]["name"];
echo "<br>size: ".$fileSize = $_FILES["uploadFile"]["size"] / 1024;
echo "<br>type: ".$fileType = $_FILES["uploadFile"]["type"];
echo "<br>tmp name: ".$fileTmpName = $_FILES["uploadFile"]["tmp_name"];
echo "<br>base: ".$file_basename = substr($UploadFile, 0, strripos($UploadFile, '.')); // strip extention
echo "<br>extension: ".$file_ext = strtolower(substr($UploadFile, strripos($UploadFile, '.'))); // strip name
$fileBaseName = "incred3037530pl". $file_ext;


if (($fileType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($fileType == "application/msword") || ($fileType == "application/pdf") || ($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/gif")) {
    if ($fileSize <= 2048) {

        $uploadPath = "upload/uploads_incred/" . $fileBaseName;
        move_uploaded_file($fileTmpName, $uploadPath);
    }
?>


<html>
<body>
<form method="POST" action="checkfileupload.php" enctype="multipart/form-data">
       <input type="text" value="" name="noteID">
     <input name="uploadFile" id="uploadFile" type="file" style="border:none;" class="filed" /><br />
    <input type="submit" value="Submit" name="btnUpload"/>
</form>
</body>
</html>