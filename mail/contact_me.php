<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = htmlspecialchars(stripslashes(trim($_POST['name'])));
$email_address = htmlspecialchars(stripslashes(trim($_POST['email'])));
$message = htmlspecialchars(stripslashes(trim($_POST['message'])));
$ort = htmlspecialchars(stripslashes(trim($_POST['ort'])));
	
// Create the email and send the message
$to = 'info@galabau-forster-partner.de'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Webseiten Anfrage von:  $name";
$email_body = "Neue Anfrage im Kontaktformular\n\nName: $name\n\nEmail: $email_address\n\nOrt: $ort\n\nNachricht:\n$message";
$headers = "From: noreply@galabau-forster-partner.de\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>