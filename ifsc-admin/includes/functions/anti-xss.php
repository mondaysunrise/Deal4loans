<?php 
/*=================================Filter Form Request =====================================*/

/*Below function inputs GET and POST values and make it hacker's safe data.if any hacking attwm is made.It prevents us from SQL Injection and Script Injection as well,$exclude is used if you want to exclude any particular tag/tags not to get filtred.
Example : we want $_POST['username'] as raw data from username input and we want that <p> and <a> tags dont get filtered.So we will call the function as below -
filter($_POST['username'],'<p><a>')
Try to use GET aur POST specifically insted of REQUEST.
*/
 
function filter($rawData,$exclude=''){
	$forbiddenStrings = array('.js','.php','.html','.asp','.htm','.php5','.sh','.exe','.dll','.jsp','.aspx','"');
	$replaceStrings = array('','','','','','','','','','','','');
	if($exclude!=''){
		$clean = strip_tags($rawData,$exclude);
		$clean = str_replace($forbiddenStrings,$replaceStrings,$clean);
		$clean = htmlspecialchars($clean);
		$clean = mysql_real_escape_string($clean);
		$clean = preg_replace("/[^a-zA-Z0-9&gt;&lt;]/", "$1", $clean);
	}else{	
		$clean = strip_tags($rawData);
		$clean = str_replace($forbiddenStrings,$replaceStrings,$clean);
		$clean = htmlspecialchars($clean);
		$clean = mysql_real_escape_string($clean);
		$clean = preg_replace("/[^a-zA-Z0-9 ]/", "$1", $clean);
	}
	
	return $clean;
}

/*Below function inputs GET and POST values and make it hacker's safe data.Url_snapshot is the url passed where the page will be redirected if any hacking attwm is made
*/

function filter_form_request($request,$url_snapshot=''){
	if($url_snapshot == '')
		$url_snapshot = SITE_URL;
	if(is_array($request)){
		foreach ($request as $check_url) {
		if ((eregi("<[^>]*script*\"?[^>]*>", $check_url)) || (eregi("<[^>]*object*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*iframe*\"?[^>]*>", $check_url)) || (eregi("<[^>]*applet*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*meta*\"?[^>]*>", $check_url)) || (eregi("<[^>]*style*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*form*\"?[^>]*>", $check_url)) || (eregi("\([^>]*\"?[^)]*\)", $check_url))) {
			hack_die ("Hacking or Injection Attempt",$url_snapshot);
			}
		}
	}else{
		if ((eregi("<[^>]*script*\"?[^>]*>", $request)) || (eregi("<[^>]*object*\"?[^>]*>", $request)) ||
		(eregi("<[^>]*iframe*\"?[^>]*>", $request)) || (eregi("<[^>]*applet*\"?[^>]*>", $request)) ||
		(eregi("<[^>]*meta*\"?[^>]*>", $request)) || (eregi("<[^>]*style*\"?[^>]*>", $request)) ||
		(eregi("<[^>]*form*\"?[^>]*>", $request)) || (eregi("\([^>]*\"?[^)]*\)", $request))) {
			hack_die("Hacking or Script Injection Attempt",$url_snapshot);
			}
	}
	unset($check_url);
	unset($request);
}

/*Below function inputs GET and POST values and make it hacker's safe data.Url_snapshot is the url passed where the page will be redirected if any hacking attwm is made
*/

function filter_admin_form_request($request,$url_snapshot=''){
	if($url_snapshot == '')
		$url_snapshot = SITE_URL."webadmin/admin.php";
	if(is_array($request)){
		foreach ($request as $check_url) {
		if ((eregi("<[^>]*script*\"?[^>]*>", $check_url)) || (eregi("<[^>]*object*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*iframe*\"?[^>]*>", $check_url)) || (eregi("<[^>]*applet*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*meta*\"?[^>]*>", $check_url)) || (eregi("<[^>]*style*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*form*\"?[^>]*>", $check_url)) ||
		(eregi("<[^>]*table*\"?[^>]*>", $check_url))||
		(eregi("<[^>]*td*\"?[^>]*>", $check_url))||
		(eregi("<[^>]*tr*\"?[^>]*>", $check_url))|| (eregi("\([^>]*\"?[^)]*\)", $check_url))) {
			hack_admin_die("Hacking or Injection Attempt",$url_snapshot);
			}
		}
	}else{
		if ((eregi("<[^>]*script*\"?[^>]*>", $request)) || (eregi("<[^>]*object*\"?[^>]*>", $request)) ||
		(eregi("<[^>]*iframe*\"?[^>]*>", $request)) || (eregi("<[^>]*applet*\"?[^>]*>", $request)) ||
		(eregi("<[^>]*meta*\"?[^>]*>", $request)) || (eregi("<[^>]*style*\"?[^>]*>", $request)) ||
		(eregi("<[^>]*form*\"?[^>]*>", $request)) || (eregi("\([^>]*\"?[^)]*\)", $request))) {
			hack_admin_die("Hacking or Script Injection Attempt",$url_snapshot);
			}
	}
	unset($check_url);
	unset($request);
}
/*hack_die fucntion can be used to show the alert to the hacker if any attempt is made,just pass the string you want to show and the url where you want the user to get redirected.
*/

function hack_die($string,$url_snapshot=''){
	if($url_snapshot == '')
		$url_snapshot = SITE_URL;
	$str = '<table width="70%" height="60%" border="0" align="center">
  <tr>
    <td align="center"><div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; color:#FF3300; font-weight:bold; background-color:#CCCCCC; margin:auto; position:relative;line-height:100px;">'.$string.'</div></td>
  </tr>
  <tr>
  	<td align="center"><p style="font-family:Verdana, Arial, Helvetica, sans-serif;" >Please go away from this page <a href="'.$url_snapshot.'">Click Here</a></p><br/><br/></td>
  </tr>
</table>';
die($str);
}

/*hack_die fucntion can be used to show the alert to the hacker if any attempt is made,just pass the string you want to show and the url where you want the user to get redirected.
*/

function hack_admin_die($string,$url_snapshot=''){
	if($url_snapshot == '')
		$url_snapshot = SITE_URL."webadmin/admin.php";
	$str = '<table width="70%" height="60%" border="0" align="center">
  <tr>
    <td align="center"><div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; color:#FF3300; font-weight:bold; background-color:#CCCCCC; margin:auto; position:relative;line-height:100px;">'.$string.'</div></td>
  </tr>
  <tr>
  	<td align="center"><p style="font-family:Verdana, Arial, Helvetica, sans-serif;" >Please go away from this page <a href="'.$url_snapshot.'"  target="mainFrame" >Click Here</a></p><br/><br/></td>
  </tr>
</table>';
die($str);
}
/*=================================Prevent Direct Access =====================================*/
/*
this function is used to prevent direct acess to anyfile.A url can be passed as a parameter to redirect the user to that page.
on each page use following function call
prevent_DA('index.php',$_SERVER['REQUEST_URI'],basename(__FILE__));
*/

function prevent_DA($url_snapshot,$uri,$file)
{

	if(eregi($file,$uri))
	{
		return hack_die ('This file cannot be accessed directly!',$url_snapshot);
	}
}

/*
upload_files function is used to manage the permission of the folder also validation of extension can be easily managed.Folowing are the parameters which is to be passed while using this function -
arr_allowed_extension= array of allowed file extensions
file_array = array of files
destination = destination of files uploaded
new_file_name = name of the new file which is uploaded on server.
size= maximum size of the files.
*/



function upload_files($arr_allowed_extension,$file_array,$destination,$new_file_name,$size=9097152)
{
	$ext = explode('.',$file_array['name']);//Get the extention of image 
	$ext = strtolower(end($ext));//To get the extention and change it lower case
	if($file_array['size']<$size)
	{
	//Check the size of Image
	    @chmod($destination.'/'.$name,0777);
		if(is_array($arr_allowed_extension) ? (in_array($ext,$arr_allowed_extension)) : false)
		{
			$name = $new_file_name.".$ext";
			if(move_uploaded_file($file_array['tmp_name'],$destination.'/'.$name)):
				@chmod($destination.'/'.$name,0755);
			return $name;
			else:
				return '';
			endif;
	   } 
   }
}
/*=================================Create Honey Pot =====================================*/

/*create_honeyPot function will create an invisible form object to identify
 whether its filled manually or by some robotic means */

function create_honeyPot(){
	$html ='';
	$html .='<div style="display:none;"><input type="text" name="honey" value=""></div>';
	return $html;
}

/*check_honeyPot function will check the form object created by create_honeyPot 
function and stop the process if something found suspicious.*/

function check_honeyPot(){
	if(isset($_REQUEST['honey']) && $_REQUEST['honey'] != '')
		hack_die ('This form was filled by some automated tool<br/>Hence it won\'t process further!',$url_snapshot);
}

/*=================================Changefolder and Persmission after file =====================================*/


function recursiveChmod($path, $filePerm=0644, $dirPerm=0755)
   {
      // Check if the path exists
      if(!file_exists($path))
      {
         return(FALSE);
      }
      // See whether this is a file
      if(is_file($path))
      {
         // Chmod the file with our given filepermissions
         chmod($path, $filePerm);
      // If this is a directory...
      } elseif(is_dir($path)) {
         // Then get an array of the contents
         $foldersAndFiles = scandir($path);
         // Remove "." and ".." from the list
         $entries = array_slice($foldersAndFiles, 2);
         // Parse every result...
         foreach($entries as $entry)
         {
            // And call this function again recursively, with the same permissions
            recursiveChmod($path."/".$entry, $filePerm, $dirPerm);
         }
         // When we are done with the contents of the directory, we chmod the directory itself
         chmod($path, $dirPerm);
      }
      // Everything seemed to work out well, return TRUE
      return(TRUE);
   }
?>