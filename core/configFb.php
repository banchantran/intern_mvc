<?php
require_once('Facebook/autoload.php');

$FBObject = new \Facebook\Facebook([
    'app_id'      => '1123389511940489',
    'app_secret'     => '79533e21d10a3c3c6a4c9a9bdde52ced',
	'default_graph_version' => 'v2.10'
]);

$handler = $FBObject -> getRedirectLoginHelper();
