<?php 

class Users extends Controller{

public function __construct()
{
    
}

public function index(){
    $this->view('/users/index');
}

public function register(){
    $this->view('/users/register');
}

public function login(){
    $this->view('/users/login');
}

}