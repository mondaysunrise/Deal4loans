<?php 
$result = mail('abc@test.com', 'Test Subject', $message);
if(!$result) {   
     echo "Error";   
} else {
    echo "Success";
}
?>