<?php
// Read the form values

if($_POST['password'] == NULL ) {

	$success = false;

	$name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
	$emailaddress = filter_var($_POST['emailaddress'], FILTER_SANITIZE_EMAIL);
	$message = isset( $_POST['message'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['message'] ) : "";

	if ( $name && $emailaddress && $message ) {

		$headers = 'From:' . $emailaddress . "\r\n";
		$headers .= 'Reply-To:' . $emailaddress . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$subject = "5 Star Vintage Contact";

		$formcontent = '<html><body><center>';
			$formcontent .= '<table rules="all" style="border: 1px solid #cccccc; width: 600px;" cellpadding="10">';
			$formcontent .= '<tr style="background-color: #132531;"><td colspan="2" align="center"><img src="http://5starvintage.com/assets/img/email/email-logo.jpg" alt="5 Star Vintage"></td></tr>';
			$formcontent .= "<tr><td><strong>Name:</strong></td><td>" . $name . "</td></tr>";
			$formcontent .= "<tr><td><strong>Email:</strong></td><td>" . $emailaddress . "</td></tr>";
			$formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $message . "</td></tr>";
		$formcontent .= '</table></center></body></html>';

		$recipient = "5starvintage@gmail.com";

		$success = mail($recipient, $subject, $formcontent, $headers);

	}

	// Return an appropriate response to the browser
	if ( isset($_GET["ajax"]) ) {
		
		echo $success ? "success" : "error";

	} else { ?>

	<html lang="en">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	  	<head>
	    	<title>Thank You!</title>
	  	</head>
		<body>
		  <?php if ( $success ) echo "<p>Thanks for sending your message! We'll get back to you shortly.</p>" ?>
		  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
	  </body>
	</html>

	<?php } 
} 
else {
	$success = 'bot';
	// Return an appropriate response to the browser
	if ( isset($_GET["ajax"]) ) {
		
		echo $success = "bot";

	}
} ?>
