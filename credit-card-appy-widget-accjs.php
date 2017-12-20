<script src="organictabs1.jquery.js"></script>
<script>
$(function(){
// Calling the plugin
	$("#example-one").organicTabs();
	$("#example-two").organicTabs({
		"speed": 100,
		"param": "tab"
	});
});
</script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>


<link href="ccmobile/css/creditcard-lp-mobile-ui.css" type="text/css" rel="stylesheet">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="ccmobile/css/cc-bootstrap.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="ccmobile/js/validate.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script>
  $(function() {
    var availableTags = [
       'Ahmedabad','Aurangabad','Bangalore','Baroda','Bhiwadi','Bhopal','Bhubneshwar','Chandigarh','Chennai','Cochin','Coimbatore','Cuttack','Dehradun','Delhi','Faridabad','Gaziabad','Gurgaon','Guwahati','Hosur','Hyderabad','Indore','Jabalpur','Jaipur','Jamshedpur','Kanpur','Kochi','Kolkata','Lucknow','Ludhiana','Madurai','Mangalore','Mysore','Mumbai','Nagpur','Nasik','Navi Mumbai','Pune','Ranchi','Raipur','Rewari','Sahibabad','Surat','Thane','Thiruvananthapuram','Trivandrum','Trichy','Vadodara','Vishakapatanam','Vizag', 'Others',
    ];
    $( "#City" ).autocomplete({
      source: availableTags
    });
  });
  </script>
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-httpscclist.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000
}
</style>
<style type="text/css">
/* Big box with list of options */


#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 250px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 5;
}
#formatedIncome {
    font-size: 12px;
    font-weight: normal;
    color: #000 !important;
}
#wordIncome {
    font-size: 12px;
    font-weight: normal;
    color: #000 !important;
}
</style>
<script type="application/javascript">
function CharsetKeyOnly(evt)
{

		
	var charCode=(evt.which)?evt.which:event.keyCode
if((charCode>33)&&(charCode<58))
return false;
document.getElementById("CompDetail").style.display="block";
return true;
	
}

function showhidePersonalDetails(evt)
{
	document.getElementById("PersonalDetail").style.display="block";
}

</script>