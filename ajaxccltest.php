<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="scripts/jquery.js"></script>
<Script Language="JavaScript">


/*function newcomplete_div()
{
	var get_RequestID = document.getElementById('RequestID').value;
	var get_proid = 3;
						
	var queryString = "?get_RequestID=" + get_RequestID +"&get_proid=" + get_proid;

  $('#complete_div').load("vrimob.php" + queryString);
  
}*/
	
	function onclick_proceedVal()
    {
          jQuery.post(
                    "vrimob.php",

                    {RequestID: document.getElementById('RequestID').value , get_proid: 3},

                    function(data){
						if(data=="yes")
						{
								alert("Data Loaded:yes " + data);
						}
						else
						{
							alert("Data Loaded: no" + data);
						}
   
 }
        );
    }
</script>
</head>
<body> 
<form><input type="hidden" name="RequestID" id="RequestID"  value="124569" >
<a onclick="onclick_proceedVal();" style="cursor:pointer;">check</a>
<!--<input name="submit" type="button" style="width:200px; background-color: #D02037; color:#FFFFFF; font-weight:700" value="Click After Dialing" onclick="newcomplete_div();"/>-->
<div style=" float:left;" id="complete_div">
</div>
</form>
</body>
</html>

