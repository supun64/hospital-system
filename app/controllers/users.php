<?php 

class Users extends Controller{

public function __construct()
{
    $this->hos_ldr_model = $this->model('HospitalLoader');
}

public function index(){

    $data = $this->hos_ldr_model->get_all_hospitals();

    if(isset($_POST['login-submit'])){
        header('location:'.URL_ROOT.'/users/login');
    }
    if(isset($_POST['register-submit'])){
        header('location:'.URL_ROOT.'/users/register');
    }

    $this->view('/users/index',$data);
}

public function register(){
    $this->view('/users/register');
}

public function login(){
    $this->view('/users/login');
}

}