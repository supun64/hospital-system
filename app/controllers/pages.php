<?php  

class Pages extends Controller{

    public function __construct()
    {
        $this->admin_model = $this->model('Administrator');  //create admin object

        $this->operator_model = $this->model('Operator'); // Create Operator object
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

        
    
        if(isset($_POST["vaccine-search"])){

            $id = $_POST["vaccine-search-bar-input"]; // TO get the search input

            $data = $this->operator_model->load_citizen($id);      //array list of users

            $data["vaccinations"] = $this->operator_model->load_vaccination($id);

            $data["hospitals"] = $this->operator_model->load_hospitals();

            if(!$data){
                die("Data not found");
            }


        }

        $this->view('/pages/vaccination', $data);
    }

    public function home(){
        $this->view('/pages/admin_home');
    }

    public function settings(){
        $this->view('/pages/admin_settings');
    }

    public function data_management_update(){
        $record_type = $_GET['record_type'];
        $id = $_GET['id'];
        
        $this->view('/pages/data_management_update');
    }
    public function data_management(){
        $records = [];
        $rows = ["antigen_tests"=>["HealthID", "Test status"],
                 "covid_deaths"=>["HealthID","Place","Comments"],
                 "pcr_tests"=>["HealthID","Test Status"],
                 "vaccinations"=>["HealthID","Dose","Name of Vaccine","Conducted Place","Allergies / Disorders"]];

        if(isset($_POST['newrecord'])){
            $this->admin_model->update_record($_GET['record_type'],$_POST['newrecord']);
        }
        if(isset($_GET['record_type']) && $_GET['record_type']){

            $type = $_GET['record_type'];
            $records = $this->admin_model->load_by_type($type);
            $records["type"] = $rows[$type];
            array_push($records,$type);
            $this->view('/pages/data_management',$records);
            return;

        }

        $this->view('/pages/data_management');
    }

    public function data_delete(){
        $type = $_GET['record_type'];
        if($this->admin_model->delete_by_id($type,$_POST['id'])){
            header('location:'.URL_ROOT."/pages/data_management?record_type=$type");
        }else{
            die('Something went wrong');
        }
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