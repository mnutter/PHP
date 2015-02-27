<?php
function mail_request($to,$subject,$message,$cc){
    $headers = "CC: " .  $cc;

    //Mail the request to support
    
    //Commented out due to no mail session
    //mail($to, $subject, $message,$headers);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
?>
