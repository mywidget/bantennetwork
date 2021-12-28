<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '527145062514-21nc4gbubb83ckqnij6vl3b3i63mfhe3.apps.googleusercontent.com';
$config['google']['client_secret']    = '9DUj8Av1C_YLfilNFH54y9d2';
// $config['google']['redirect_uri']     = 'https://example.com/project_folder_name/user_authentication/';
$config['google']['redirect_uri'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['google']['redirect_uri'] .= "://" . $_SERVER['HTTP_HOST']."/user_authentication/";
// $config['google']['redirect_uri'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

$config['google']['application_name'] = 'Login to CodexWorld.com';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();