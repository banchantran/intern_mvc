<?php
require_once('controllers/BaseController.php');
require_once('models/UserModel.php');

class UserController extends BaseController
{
    function __construct()
    {
        $this->folder = 'user';
    }


    public function login()
    {
        // $facebook = new \Facebook\Facebook([
        //     'app_id'      => '1123389511940489',
        //     'app_secret'     => '79533e21d10a3c3c6a4c9a9bdde52ced',
        //     'default_graph_version'  => 'v2.10'
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
        // } else {
        //     // Get login url
        //     // var_dump('222');
        //     // exit();
        //     $facebook_permissions = ['email']; // Optional permissions

        //     $facebook_login_url = $facebook_helper->getLoginUrl('https://paraline.local:80/', $facebook_permissions);

        //     // Render Facebook login button
        //     $facebook_login_url = '<div align="center"><a href="' . $facebook_login_url . '">Login via Facebook</a></div>';
        //     $this->render('login', ['facebook_login_url' => $facebook_login_url]);
        // }
        require_once('core/configFb.php');

        if (isset($_SESSION['access_token'])) {
            header("Location: index.php");
            exit();
        }


        $redirectTo = "https://paraline.local:80/?controller=user&action=callback";
        $data = ['email'];
        $fullURL = $handler->getLoginUrl($redirectTo, $data);
        $this->render('login', ['fullURL' => $fullURL]);
    }

    public function home()
    {
        $this->render('home');
    }

    public function logout()
    {
        session_destroy();
        // header('https://paraline.local:80/?controller=user&action=login');
        header('location: /?controller=user&action=login');
    }

    public function callback()
    {
        require_once("config.php");

        try {
            $accessToken = $handler->getAccessToken();
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            echo "Response Exception: " . $e->getMessage();
            exit();
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            echo "SDK Exception: " . $e->getMessage();
            exit();
        }

        if (!$accessToken) {
            header('Location: ?controller=user&action=login');
            exit();
        }

        $oAuth2Client = $FBObject->getOAuth2Client();
        if (!$accessToken->isLongLived())
            $accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);

        $response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
        $userData = $response->getGraphNode()->asArray();
        $_SESSION['userData'] = $userData;
        $_SESSION['access_token'] = (string) $accessToken;
        header('Location: ?controller=user&action=home');
        exit();
    }
}
