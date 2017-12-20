<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>val demo</title>
  <style>
  p {
    color: red;
    margin: 4px;
  }
  b {
    color: blue;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 
<p></p>
 
<input type="button" id="button" name="button">
 
<script>

$(document).ready(function(){
        $('#button').click(function(){
                       alert("hello");
               //slider_value = $('#sliderfill').val();
               //alert(slider_value);
   // do whatever you want with that value...
});
});


/*function displayVals() {
  alert("dd");
}
 
//$( "select" ).change( displayVals );
displayVals();*/
</script>
 
</body>
</html>