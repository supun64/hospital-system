<?php 

class Users extends Controller{

    public function __construct()
    {
        $this->hos_ldr_model = $this->model('HospitalLoader');
    }

    public function index(){

        $data = $this->hos_ldr_model->get_all_hospitals();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $hospital_id = explode(',',$_POST['slct-hos'])[1];

            if(isset($_POST['login-submit'])){
    
                header('location:'.URL_ROOT.'/users/login?hospital-id='.$hospital_id);
            }
            if(isset($_POST['register-submit'])){
                header('location:'.URL_ROOT.'/users/register/hospital-id='.$hospital_id);
            }
        }
        $this->view('/users/index',$data);
    }

    public function register($params=''){
        $data = [];
        $data['email'] = "";

        if(!empty($params)){
            
            $hospital_id = (int)explode('=',$params)[1];
            $data = $this->hos_ldr_model->get_hospital($hospital_id);

            //if registered hospital try to access using url with paramas
            if($data['is_registered'] || $data == NULL){ header('location:'.URL_ROOT.'/users/index/3');}
        
        }else{header('location:'.URL_ROOT.'/users/index/4');}    //no permission without correct url

        //email verification
        if(isset($_POST['ver-submit'])){

            ini_set('display_errors',1);
            error_reporting(E_ALL);
            
            $from = "squ4doption@gmail.com";
            $to = $_POST['email'];
            $subject = "Hospital Verification Code";
            $txt = $_POST['ran-1'];
            $headers = "From: ".$from ;
            
            
            if(mail($to,$subject,$txt,$headers)){
                echo "Email sent";
            }else{
                echo "Sorry";
            }
            
        }

        //if register submitted
        if(isset($_POST['reg-submit'])){
            
            $ver_code = $_POST['verify-code'];
            $act_code = $_POST['ran-2'];
            $admin = [
                "hospital_id" => $_POST['hos-id'],
                "username" => $_POST['admin-name'],
                "email" => $_POST['admin-email'],
                "password" => $_POST['admin-pwd']
            ];

            if($ver_code == $act_code){
            
                            //checking whether an existing email
                            if ($this->hos_ldr_model->email_exist($admin['email'])) {
                                header('location:'.URL_ROOT.'/users/register/hospital-id='.$admin['hospital_id'].'?duplicate');  //redirect with error message   
                            } else {
                            //     //hash the password
                                $admin['password'] = password_hash($admin['password'], PASSWORD_DEFAULT);
                                // //add new admin
                                if ($this->hos_ldr_model->add_admin($admin)) {
                                    header('location:'.URL_ROOT.'/users/login?hospital-id='.$admin['hospital_id']);
                                }else {
                                        die('Something went wrong');
                                    
                                }
                            //header('location:'.URL_ROOT.'/users/login');
                            }


            }else{
                header('location:'.URL_ROOT.'/users/register/hospital-id='.$admin['hospital_id'].'?fail');  //redirect with error message  TODO: error mesaage
            }


        }
        
        $this->view('/users/register',$data);

    }


    public function login(){
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $is_confirmed = $this->hos_ldr_model->log_in(trim($_POST["useremail"]),trim($_POST["password"]));
            if(!$is_confirmed){ //either entered wrong password or password mismatch
                $data["user_email"] = trim($_POST["useremail"]);
                $data["password"] = trim($_POST["password"]);
                $data["errors"] = "Email or Password is wrong. Please check again.";
                $this->view('/users/login',$data);
            }else{
                header('location:'.URL_ROOT.'/pages/index');
            }
        }

        if(isset($_GET["hospital-id"]) && !empty($_GET["hospital-id"])){

        
            $hospital_id = $_GET["hospital-id"];
            $data = $this->hos_ldr_model->get_hospital($hospital_id);
            //if not registered hospital try to access using url with paramas
            if(!$data['is_registered'] || $data == NULL){ header('location:'.URL_ROOT.'/users/index');}
            $_SESSION['hospital_id'] = $hospital_id;
        
        }else{header('location:'.URL_ROOT.'/users/index');}  //no permission without correct url
        $this->view('/users/login',$data);
    }

    public function logout()
    {   
        $this->hos_ldr_model->logout();
        header('location:' . URL_ROOT . '/users/login');
    }

}