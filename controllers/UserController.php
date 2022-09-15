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
        require_once './facebookSource.php';
        $this->render('login', ['loginUrl' => $loginUrl]);
    }

    public function home()
    {
        require_once './fbCallback.php';
       
        $fbUser['avatar'] = $fbUser['picture']['url'];
        $fbUser['facebook_id'] = $fbUser['id'];
     
        unset($fbUser['id']);
        unset($fbUser['picture']);
        $user = UserModel::findByEmail($fbUser['email']);
        if (empty($user)) {
            UserModel::insert($fbUser);
            $user = UserModel::findByEmail($fbUser['email']);
        } else {
            $_SESSION['current_user'] = $fbUser;
        }

        $this->render('home',['user'=> $user[0]]);
    }

    public function logout()
    {
        session_destroy();
        header('location: /?controller=user&action=login');
    }

}
