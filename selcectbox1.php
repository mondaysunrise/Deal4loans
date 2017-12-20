<?php

?>

<!DOCTYPE html>
<html>
<head>
<link href="css/jquery-selectbox.css" rel="stylesheet" />
<style>
.selectboxit-container .selectboxit, .selectboxit-container .selectboxit-options {
  width: 600px; /* Width of the dropdown button */
  border-radius:0;
  max-height:240px;
}

.selectboxit-options .selectboxit-option .selectboxit-option-anchor {
    white-space: normal;
    min-height: 30px;
    height: auto;
}
</style>
</head>
<body>
<section style="background-color:rgb(237.247.249);">
    <h2>Test of select menu (SelectboxIt plugin)</h2>
    <select name="select_this" id="testselectset">
        <option value="01">Option 1</option>
        <option value="02">Option 2</option>
        <option value="03">Option 3</option>
        <option value="04">Option 4</option>
        <option value="05">Option 5</option>
        <option value="06">Option 6</option>
        <option value="07">Option 7 with a really, really long text line that we shall use in order to test the wrapping of text within an option or  with a really, really long text line that we shall use in order to test the wrapping of text within an option or optgroupoptgroup</option>
        <option value="08">Option 8</option>
        <option value="09">Option 9</option>
        <option value="10">Option 10</option>
    </select>
    </section>
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
<script src="js/jquery-ui.min.js" ></script>
<script src="js/selectbox.min.js"></script>
<script>
$(function(){
    $("#testselectset").selectBoxIt({
				theme: "default",
				defaultText: "Make a selection...",
                autoWidth: false
			});			
		});
</script>
</body>
</html>
