<!doctype html>
 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>jQuery UI Autocomplete - Default functionality</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script>
	$(function() {
$("#Primary_Acc").keyup(function(){
	//alert("hello");
 $.post("jquery_bankmaster.php",
  {
    Primary_Acc: $("#Primary_Acc").val()
    },
  function(data,status){
		var temp = new Array();
temp = data.split(",");
//var availableTag = [data];
  $( "#Primary_Acc" ).autocomplete({
            source: temp
        });
  });
});
});

 $(function() {
        var availableTags = [
            "hello",
            "bye",
            "how",
            "why",
            "C",
			"hello",
            "bye",
            "how",
            "why",
            "qwe",           
            "dd"
        ];
        $( "#tags_1" ).autocomplete({
            source: availableTags
        });
    });
    </script>
</head>
<body>
 
<div class="ui-widget">
    <label for="Primary_Acc">car name: </label>
    <input id="Primary_Acc"/>
</div>
<br>
<br>
<div class="ui-widget">
    <label for="tags_1">Tags 1: </label>
    <input id="tags_1" />
</div>
 
 
</body>
</html>