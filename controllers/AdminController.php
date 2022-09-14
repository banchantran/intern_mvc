<?php
require_once('controllers/BaseController.php');
require_once('models/AdminModel.php');
require_once('models/UploadModel.php');

class AdminController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin';
    }

    public function home()
    {
        $data = array(
            'name' => 'Sang Beo',
            'age' => 22
        );
        $this->render('home', $data);
    }

    public function search()
    {
        if (!empty($_GET['email']) && !empty($_GET['name'])) {
            $email = $_GET['email'];
            $name = $_GET['name'];
            $data = AdminModel::findByEmailAndName($name, $email);
            $this->render('search', $data);
            // require_once("views/admin/search.php");
        } else {
            $this->render('search');
        }
    }

    public function create($id = 'new')
    {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        }
        if ($id == 'new') {
            $admin = new AdminModel();
        } else {

            $admin = AdminModel::findById($id);
        }

        if (!empty($_POST)) {
            $admin->password = md5($_POST['password']);
            $admin->name = $_POST['name'];

            $admin->email = $_POST['email'];
            $admin->role_type = $_POST['role_type'];
            $admin->ins_id = '1'; // fix sau
            $admin->ins_datetime = date('Y-m-d H:i:s');
            $admin->upd_datetime = 0; // fix sau
            $admin->upd_id = 0; // fix sau
            $admin->del_flag = 0;
            $upload = new UploadModel('avatar');
            $uploadErrors = $upload->validate();

            $filePath = "assets/uploads/avatars/{$_FILES['avatar']['name']}";

            $upload->upload('D:/ParalineIntern/intern_mvc/' . $filePath);
            $admin->avatar = $filePath;

            if (isset($_POST['old_avatar']) && $_FILES['avatar']['name'] == NULL) {
                $admin->avatar = $_POST['old_avatar'];
            }
            
            if (!empty($_GET['id'])) {
                AdminModel::update($admin, ['id' => $id]);
            } else {
                $admin->insert();
            }
            $msg = ($id == 'new') ? "Create success." : "Update success";
            Session::msg($msg, 'success');
            header('location: /?controller=admin&action=search');
        } else {
            $this->role_options = [AdminModel::ADMIN_PERMISSION => 'Admin', AdminModel::SUPER_ADMIN_PERMISSION => 'Super admin'];
            $this->render('form', ['admin' => $admin]);
        }
    }

    public function delete()
    {

        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            AdminModel::update(['del_flag' => '1'], ['id' => $id]);
            Session::msg("Delete success.", 'success');
        }
        $this->render('search');
    }

}
