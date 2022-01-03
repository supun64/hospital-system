<?php

class Users extends Controller
{


    public function __construct()
    {

        $this->reg_handler = $this->model('RegistrationHandler');
        $this->user_handler = $this->model('UserHandler');
        $this->mail = new MailerWrapper();
    }

    public function index()
    {

        $data = $this->reg_handler->get_all_hospitals();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $hospital_id = explode(',', $_POST['slct-hos'])[1];

            if (isset($_POST['login-submit'])) {

                header('location:' . URL_ROOT . '/users/login?hospital-id=' . $hospital_id);
            }
            if (isset($_POST['register-submit'])) {
                header('location:' . URL_ROOT . '/users/register/hospital-id=' . $hospital_id);
            }
        }
        $this->view('/users/index', $data);
    }

    public function register($params = '')
    {
        $data = [];
        $data['email'] = "";

        if (!empty($params)) {

            $hospital_id = (int)explode('=', $params)[1];
            $data = $this->reg_handler->get_hospital($hospital_id);

            //if registered hospital try to access using url with paramas
            if ($data['is_registered'] || $data == NULL) {
                header('location:' . URL_ROOT . '/users/index/3');
            }
        } else {
            header('location:' . URL_ROOT . '/users/index/4');
        }    //no permission without correct url

        //email verification
        if (isset($_POST['ver-submit'])) {

            $to = $_POST['email'];
            $subject = "Hospital Verification Code";
            $txt = $_POST['ran-1'];
            $txt = nl2br($txt);
            $this->mail->send_email($to, $subject, $txt);
        }

        //if register submitted
        if (isset($_POST['reg-submit'])) {

            $ver_code = $_POST['verify-code'];
            $act_code = $_POST['ran-2'];

            $admin = new User(NULL, $_POST['admin-name'], $_POST['admin-pwd'], (int)$_POST['hos-id'], $_POST['admin-email'], 1);

            if ($ver_code == $act_code) {

                //checking whether an existing email
                if ($this->reg_handler->email_exist($admin->get_user_email())) {
                    header('location:' . URL_ROOT . '/users/register/hospital-id=' . $admin->get_hospital_id() . '?duplicate');  //redirect with error message  
                    //header('location:'.URL_ROOT.'/users/index/6'); 
                } else {
                    //     //hash the password
                    $admin->set_password(password_hash($admin->get_password(), PASSWORD_DEFAULT));
                    // //add new admin
                    $result1 = $this->user_handler->add_user($admin);
                    $result2 = $this->reg_handler->register($admin->get_hospital_id());
                    if ($result1 && $result2) {
                        header('location:' . URL_ROOT . '/users/login?hospital-id=' . $admin->get_hospital_id());
                    } else {
                        die('Something went wrong');
                    }
                    //header('location:'.URL_ROOT.'/users/login');
                }
            } else {
                header('location:' . URL_ROOT . '/users/register/hospital-id=' . $admin->get_hospital_id() . '?fail');  //redirect with error message  TODO: error mesaage
            }
        }

        $this->view('/users/register', $data);
    }


    public function login()
    {
        if (!$this->user_handler->is_logged_in()) {
            $data = [];
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $is_confirmed = $this->user_handler->log_in(trim($_POST["useremail"]), trim($_POST["password"]));
                if (!$is_confirmed) { //either entered wrong password or password mismatch
                    $data["user_email"] = trim($_POST["useremail"]);
                    $data["password"] = trim($_POST["password"]);
                    $data["errors"] = "Email or Password is wrong. Please check again.";
                    $this->view('/users/login', $data);
                } else {
                    if ($is_confirmed['first_time'] && !$_SESSION['is_admin']) {
                        header('location:' . URL_ROOT . '/pages/settings?first');
                    } else {
                        header('location:' . URL_ROOT . '/pages/index');
                    }
                }
            }

            if (isset($_GET["hospital-id"]) && !empty($_GET["hospital-id"])) {


                $hospital_id = $_GET["hospital-id"];
                $data = $this->reg_handler->get_hospital($hospital_id);
                //if not registered hospital try to access using url with paramas
                if (!$data['is_registered'] || $data == NULL) {
                    header('location:' . URL_ROOT . '/users/index');
                }
                $_SESSION['hospital_id'] = $hospital_id;
                $_SESSION['hospitalname'] = $data['name'];
            } else {
                header('location:' . URL_ROOT . '/users/index');
            }  //no permission without correct url
            $this->view('/users/login', $data);
        } else {
            header('location:' . URL_ROOT . '/pages/index');
        }
    }

    public function logout()
    {
        $this->user_handler->logout();
        header('location:' . URL_ROOT . '/users/login');
    }
}
