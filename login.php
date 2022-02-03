<?php
require_once 'vendor/autoload.php';

$clientId = "";
$clientSecret = "";
$redirectUrl = "";

//creating client request
$client = new Google_Client();
$client->setClientId($clientId);
$client->setclientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope('profile');
$client->addScope('email');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    //Getting User Profile
    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth->userinfo->get();
    $email = $google_info->email;
    $name = $google_info->name;

    echo "Welcome " .$name." You are registerd using email: " .$email;
}else{
    echo "<a href='" .$client->createAuthUrl(). "'>Login with Google</a>";
}