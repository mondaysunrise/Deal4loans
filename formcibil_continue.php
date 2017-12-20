<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$extraarray=array("apicall"=>"CibilFulfilOffer");
	$PostArray=array_merge($_POST,$extraarray);

	$jsondata=json_encode($PostArray);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Untitled 1</title>
</head>
<body>

	<table id="myTable">
		<tr>
			<td colspan="2"><div id="CibilVal">Get your <a style="cursor:pointer;color: #3671d5;" id="cibilcheck" name="cibilcheck">free Credit report</a>, while we work on cutomizing your loan offers</div></td>			
		</tr>

		<tr>
			<td colspan="2"><div id="loading"></div></td>
		</tr>
	</table>

 <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script> 
 <script>
	function displayVals() {
		//alert("hello");
		var image = "http://www.deal4loans.com/new-images/ajax-loader.gif";
		$('#loading').html("<img src='"+image+"' />");
		var JSONdata=<?php echo $jsondata; ?>;
		//alert(JSONdata);
		console.log(JSONdata);
	 //var singleValues = $( "#doc_type" ).val();
	$.ajax({
			url: 'api/v1/cibil/cibil_fulfil_offer.php',
            type:'POST',
            data :  JSONdata,      
            //dataType: 'JSON',
			success: function (response) {
				//alert(response);
				$('#CibilVal').html(response);
				$('#loading').html("").hide();
					}
					});	
	}

	$( "#cibilcheck" ).click(function(){
		displayVals();
	});
	
	
	$("#myTable").on('click', '.checkEligible', function(){
	var image = "http://www.deal4loans.com/new-images/ajax-loader.gif";
		$('#loading').html("<img src='"+image+"' />");
	var data=$('#CibilAuthenticationQuest').serialize();
	var identify="From_Form";
		$.ajax({
				type: 'POST',
				url: 'api/v1/cibil/cibil_fulfil_offer.php',
				data: {
					data,
					identify: identify,					
							
				},
				success: function (response) {		
				$('#CibilVal').html(response);
				$('#loading').html("").hide();
			}
		});	
		});

/*$( "#CibilAuthenticationQuest" ).submit(function( event ) {
  if ( $( "input:first" ).val() === "correct" ) {
    $( "span" ).text( "Validated..." ).show();
    return;
  }
 
  $( "span" ).text( "Not valid!" ).show().fadeOut( 1000 );
  event.preventDefault();
});
*/

	
	</script>
</body>
</html>
