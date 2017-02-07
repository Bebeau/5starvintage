<?php
// Read the form values

if($_POST['password'] == NULL ) {

	$success = false;

	$name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
	$emailaddress = filter_var($_POST['emailaddress'], FILTER_SANITIZE_EMAIL);
	$phonenumber = isset( $_POST['phonenumber'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['phonenumber'] ) : "";
	$storename = isset( $_POST['storename'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['storename'] ) : "";
	$storedescription = isset( $_POST['storedescription'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['storedescription'] ) : "";
	$paypalemail = filter_var($_POST['paypalemail'], FILTER_SANITIZE_EMAIL);

	if ( $name && $emailaddress && $phonenumber ) {

		$headers = 'From:' . $emailaddress . "\r\n";
		$headers .= 'Reply-To:' . $emailaddress . "\r\n";
		$headers .= "CC: design@kylebebeau.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$subject = "5 Star Vintage Contact Form Lead";

		$formcontent = '<html><body><center>';
			$formcontent .= '<table rules="all" style="border: 1px solid #cccccc; width: 600px;" cellpadding="10">';
			$formcontent .= '<tr style="background-color: #132531;"><td colspan="2" align="center"><img src="http://hulpje.nl/assets/img/email/email-logo.jpg" alt="5 Star Vintage"></td></tr>';
			$formcontent .= "<tr><td><strong>Name:</strong></td><td>" . $name . "</td></tr>";
			$formcontent .= "<tr><td><strong>Email:</strong></td><td>" . $emailaddress . "</td></tr>";
			$formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $phonenumber . "</td></tr>";
			$formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $storename . "</td></tr>";
			$formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $storedescription . "</td></tr>";
			$formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $paypalemail . "</td></tr>";
		$formcontent .= '</table></center></body></html>';

		$recipient = "5starvintage@gmail.com, design@kylebebeau.com";

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
