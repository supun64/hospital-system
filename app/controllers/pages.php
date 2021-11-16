<?php  

class Pages extends Controller{

    public function __construct()
    {
        $this->admin_model = $this->model('Administrator');  //create admin object
    }

    public function user_index(){
        $this->view('/pages/user_dashboard');
    }

    public function admin_index(){
        $this->view('/pages/admin_dashboard');
    }

    public function antigen(){
        $this->view('/pages/antigen');
    }

    public function covid_deaths(){
        $this->view('/pages/covid_deaths');
    }
    
    public function covid_patients(){
        $this->view('/pages/covid_patients');
    }

    public function pcr(){
        $this->view('/pages/pcr');
    }

    public function vaccination(){
        $this->view('/pages/vaccination');
    }

    public function home(){
        $this->view('/pages/admin_home');
    }

    public function settings(){
        $this->view('/pages/admin_settings');
    }

    public function data_management(){
        $this->view('/pages/data_management');
    }

    public function user_management(){



        $data = $this->admin_model->load_deo();      //array list of users

        if(isset($_POST['nw_deo_submit'])){
            
            $hos_id = $this->admin_model->get_hospital_id();   //relevent hospital id

            $deo = [
                 "username"=>$_POST['deo_username'],
                "email"=>$_POST['deo_email'],
                "password"=>$_POST['password'],
                "hospital_id"=> $hos_id
             ];

             //checking whether an existing username
             if($this->admin_model->username_exist($deo['username'])){
                 
                 header('location:'.URL_ROOT.'/pages/user_management?duplicate');  //redirect with error message
             }else{
                //hash the password
                $deo['password'] = password_hash($deo['password'],PASSWORD_DEFAULT);
                //add new deo
                if($this->admin_model->add_deo($deo)){
                    header('location:'.URL_ROOT.'/pages/user_management');
                }else{
                    die('Something went wrong');
                }
                
                
             }



        }
        $this->view('/pages/user_management',$data);
    }

}