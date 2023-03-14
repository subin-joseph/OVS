<?php


//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('896376895528-mnk6bvhgc7a4ig8nt94b8r48v4rlaj8d.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://localhost/ovs/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 