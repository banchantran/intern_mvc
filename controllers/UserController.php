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
        require_once './facebook_source.php';
        $this->render('login', ['loginUrl' => $loginUrl]);


    }


    public function home()
    {
        require_once './fb-callback.php';
        // UserModel::find($fbUser['email']);
        $this->render('home');
    }

    public function logout()
    {
        session_destroy();
        // header('https://paraline.local:80/?controller=user&action=login');
        header('location: /?controller=user&action=login');
    }
}
