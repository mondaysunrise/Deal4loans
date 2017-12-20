<script>
function findValue(li) {
	if( li == null ) return alert("No match!");

	// if coming from an AJAX call, let's use the CityId as the value
	if( !!li.extra ) var sValue = li.extra[0];

	// otherwise, let's just display the value in the text box
	else var sValue = li.selectValue;

	//alert("The value you selected was: " + sValue);
}

function selectItem(li) {
	findValue(li);
}

function formatItem(row) {
	return row[0] + " (id: " + row[1] + ")";
}


function lookupLocal(){
	var oSuggest = $("#CityLocal")[0].autocompleter;

	oSuggest.findValue();

	return false;
}


$(document).ready(function() {
	
	$("#bank_name1").autocompleteArray(
		//alert(document.getElementById('bank_name1').value);
		[
			//$strgetbankname;
			"AbnAmro Bank","Axis Bank","Bank of Baroda","Barclays Finance","Canara Bank","Citibank","Citifinancial","Corporation Bank","HDFC Bank","Oriental Bank of Commerce","Reliance","SBI"
		],
		{

			delay:10,
			minChars:1,
			matchSubset:1,
			onItemSelect:selectItem,
			onFindValue:findValue,
			autoFill:true,
			maxItemsToShow:10
		}
	);
});
</script>
<tr>			<td>Bank Name</td>			<td><input type="text" id="bank_name1"  value="" name="bank_name1" />		</td></tr>