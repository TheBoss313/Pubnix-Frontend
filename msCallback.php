<?php
// ON CALLBACK
session_start();
require "vendor/autoload.php";

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;
echo Session::get("tenant_id");
echo Session::get("client_id");
echo Session::get("client_secret");
echo Session::get("redirect_uri");
echo Session::get("scopes");
echo Session::get($_REQUEST['code']);
echo Session::get("state");
$microsoft = new Auth(Session::get("tenant_id"),Session::get("client_id"),  Session::get("client_secret"), Session::get("redirect_uri"), Session::get("scopes"));
$tokens = $microsoft->getToken($_REQUEST['code'], Session::get("state"));

// Setting access token to the wrapper
$microsoft->setAccessToken($tokens->access_token);
echo "HELLO WORLD";
header("location: user.php");