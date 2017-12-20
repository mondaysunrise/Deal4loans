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
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-sbicclist.js"></script>
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
    color: #FFF !important;
}
#wordIncome {
    font-size: 12px;
    font-weight: normal;
    color: #FFF !important;
}


</style>
<script type="application/javascript">
function changeCityVal(evt)
{
	document.getElementById("ProfDetail").style.display="block";
}

function showhidePersonalDetails(evt)
{
	document.getElementById("PersonalDetail").style.display="block";
}
function addothercity()
{	
	var ni = document.getElementById('Othercity');
	var cit = document.creditcard_form.City.value;
	if(cit=="Others")
	{
		ni.innerHTML ='<input name="City_Other" id="City_Other" type="text" class="d4l-input"  onKeyUp="searchSuggest();" placeholder="Other City" onkeydown="validateDiv(\'othercityVal\');"  />					    <div id="othercityVal">';
	}
	else
	{
		ni.innerHTML ='';
	}
}

</script>