<?php
session_start();
require_once('core/config.php');
require_once('core/session.php');
require_once('db.php');
// require_once 'vendor/autoload.php';

// $facebook = new \Facebook\Facebook([
//     'app_id'      => '1123389511940489',
//     'app_secret'     => '79533e21d10a3c3c6a4c9a9bdde52ced',
//     'default_graph_version'  => 'v2.4'
// ]);
// $facebook_output = '';

// $facebook_helper = $facebook->getRedirectLoginHelper();

// if (isset($_GET['code'])) {
//     if (isset($_SESSION['access_token'])) {
//         $access_token = $_SESSION['access_token'];
//     } else {
//         $access_token = $facebook_helper->getAccessToken();

//         $_SESSION['access_token'] = $access_token;

//         $facebook->setDefaultAccessToken($_SESSION['access_token']);
//     }

//     $_SESSION['user_id'] = '';
//     $_SESSION['user_name'] = '';
//     $_SESSION['user_email_address'] = '';
//     $_SESSION['user_image'] = '';
    
//     $graph_response = $facebook->get("/me?fields=name,email", $access_token);

//     $facebook_user_info = $graph_response->getGraphUser();

//     if (!empty($facebook_user_info['id'])) {
//         $_SESSION['user_image'] = 'http://graph.facebook.com/' . $facebook_user_info['id'] . '/picture';
//     }

//     if (!empty($facebook_user_info['name'])) {
//         $_SESSION['user_name'] = $facebook_user_info['name'];
//     }

//     if (!empty($facebook_user_info['email'])) {
//         $_SESSION['user_email_address'] = $facebook_user_info['email'];
//     }
// }


//  else {
//     // Get login url
//     $facebook_permissions = ['email']; // Optional permissions

//     $facebook_login_url = $facebook_helper->getLoginUrl('https://paraline.local:80/', $facebook_permissions);

//     // Render Facebook login button
//     $facebook_login_url = '<div align="center"><a href="' . $facebook_login_url . '">Login via Facebook</a></div>';
//     $this->render('login', ['facebook_login_url' => $facebook_login_url]);
// }


if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'admin';
    $action = 'home';
}
require_once('routes.php');
