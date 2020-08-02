<?php

function honeypot_validate ($req) {
           
   if (!empty($req)) {

       $honeypot_fields = [
           "name",
           "email"
       ];

       foreach ($honeypot_fields as $field) {
           if (isset($req[$field]) && !empty($req[$field])) {
               return false;
           }
       }
   }

   return true;
}

//check spm
if (honeypot_validate($_POST)) {
   // The honeypot fields are clean, go on
   $is_spammer = false;
} else {
   // A spammer filled a honeypot field
   $is_spammer = true;
}

if ($is_spammer) {
   return false;
}

// Check for empty fields
if(empty($_POST['na_me'])  		||
   empty($_POST['em_ail']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['em_ail'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = htmlspecialchars(stripslashes(trim($_POST['na_me'])));
$email_address = htmlspecialchars(stripslashes(trim($_POST['em_ail'])));
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