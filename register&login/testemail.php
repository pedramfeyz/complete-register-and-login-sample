<?php

$to = "pedram_feyz@yahoo.com";
$subject = "My subject";
$register_data['fname']='aaaaa';
$register_data['email']='bbbbbbb';
$register_data['email_code']='cccccccc';
echo $register_data['email_code'];
$txt = "Hello" .$register_data['fname']. "\n\n You wwwwwwwwww need to active your account,so please use the link below:\n\n  http://pedram-feyz.com/Register%20&%20Login%20codecourse%20alex/activate.php?email=" .$register_data['email']. " email_code=" .$register_data['email_code']. "  \n\n";
$headers = "From: webmaster@example.com";

mail($to,$subject,$txt,"From: webmaster@example.com");
?>
wwwwww