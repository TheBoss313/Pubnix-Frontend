<?php
// ON CALLBACK
session_start();
require "vendor/autoload.php";

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;
use myPHPnotes\Microsoft\Models\BetterUser;

echo "TENNANT_ID ";
echo Session::get("tenant_id");
echo "<br>CLI_ID ";
echo Session::get("client_id");
echo "<br>CLI_SEC ";
echo Session::get("client_secret");
echo "<br>RED_URI ";
echo Session::get("redirect_uri");
echo "<br>SCOPE ";
echo Session::get("scopes");
echo "<br>CODE ";
echo Session::get($_REQUEST['code']);
echo "<br>STATE ";
echo Session::get("state");
$microsoft = new Auth(Session::get("tenant_id"),Session::get("client_id"),  Session::get("client_secret"), Session::get("redirect_uri"), Session::get("scopes"));
$tokens = $microsoft->getToken($_REQUEST['code'], Session::get("state"));

// Setting access token to the wrapper
$microsoft->setAccessToken($tokens->access_token);

$user = (new User); // User get pulled only if access token was generated for scope User.Read
$betterUser = (new BetterUser);
echo "<br>";
echo $user->data->getGivenName();
echo "<br>";
echo $user->data["_propDict"];
echo "<br>";
echo $user->data->getOnPremisesImmutableId();
echo "<br>-------";
echo $betterUser->data;
// https://graph.microsoft.com/v1.0/me/memberOf

// header("location: user.php");