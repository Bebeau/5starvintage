<?php

require './config.php';
require './tmhOAuth.php';
require './tmhUtilities.php';
  
    /// retrive temp access token from cookie 
    $token = $_COOKIE['Temp_Token'];
    $secret = $_COOKIE['Temp_Secret'];
    $img = $_COOKIE['Img_Url'];
    $txt = $_COOKIE['Tweet_Txt'];
  
    $tmhOAuth = new tmhOAuth(array(
        'consumer_key'          => API_KEY,
        'consumer_secret'       => API_SEC,
        'user_token'            => $token,
        'user_secret'           => $secret,	
        'curl_ssl_verifypeer'   => false
    ));
  
    /// Ask Twitter for correct access token 
    $tmhOAuth->request("POST", $tmhOAuth->url("oauth/access_token", ""), array(  
        // pass the oauth_verifier received from Twitter  
        'oauth_verifier' => $_GET["oauth_verifier"]  
    )); 
	
    $response = $tmhOAuth->extract_params($tmhOAuth->response["response"]);
	$tmhOAuth->config["user_token"] = $response['oauth_token'];  
    $tmhOAuth->config["user_secret"] = $response['oauth_token_secret']; 
	 
    $img = './'.$img;
    $code = $tmhOAuth->request('POST', 'https://api.twitter.com/1.1/statuses/update_with_media.json',
    array(
        'media[]'  => "@{$img}",
        'status'   => "$txt" // Don't give up..
    ),
        true, // use auth
        true  // multipart
    );
  
    if ($code == 200){
        tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
        echo '<h1>Your image tweet has been sent successfully</h1>';
    }else{
        // display the error 
        tmhUtilities::pr($tmhOAuth->response['response']);
        return tmhUtilities;
    }
    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tweet an Image</title>
    </head>

    <body>
    </body>

</html>