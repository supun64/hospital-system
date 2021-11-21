<?php

class Pages extends Controller
{

    public function __construct()
    {
        $this->admin_model = $this->model('Administrator');  //create admin object

        $this->operator_model = $this->model('Operator'); // Create Operator object
    }

    public function user_index()
    {
        $this->view('/pages/user_dashboard');
    }

    public function admin_index()
    {
        $this->view('/pages/admin_dashboard');
    }

    public function antigen()
    {
        $this->view('/pages/antigen');
    }

    public function covid_deaths()
    {
        $this->view('/pages/covid_deaths');
    }

    public function covid_patients()
    {
        $this->view('/pages/covid_patients');
    }

    public function pcr()
    {
        $this->view('/pages/pcr');
    }

    public function vaccination(){


        $data = [];
        $data['vaccinations'] = [];
        
        
        
    
        if(isset($_POST["vaccine-search"])){

            $id = $_POST["vaccine-search-bar-input"]; // TO get the search input

            $data = $this->operator_model->load_citizen($id);      //array list of users

            $data["vaccinations"] = $this->operator_model->load_vaccination($id);

            

            if(!$data){
                die("Data not found");
            }


        }


        if(isset($_POST["add-patient-submit"])){
            
            $hospital_id = (int)explode(" - ", $_POST["add-patient-hospital-name"]);
            

            // TODO: need to validate hospital validate
            $vaccine_detail = ["health_id"=>$_POST["add-patient-health-id"],
             "vac_name"=> $_POST["add-patient-vaccination-name"],
             "vac_date"=> $_POST["add-patient-vaccinated-date"], 
             "hospital"=> $hospital_id, 
             "vac_place"=> $_POST["add-patient-vaccinated-place"] , 
             "dose" => $_POST["add-patient-dose"], 
             "comment" => $_POST["add-patient-comment"]];

             if($this->operator_model->health_id_exist($vaccine_detail["health_id"])){
                if($this->operator_model->add_vaccinated_person($vaccine_detail)){
                    header('location:'.URL_ROOT.'/pages/vaccination');
                } 
                else{
                    die("Something went wrong");
                }
             }
             else{
                 die("Health ID Not Found");
             }
        }

        $data["hospitals"] = $this->operator_model->load_hospitals();
        $this->view('/pages/vaccination', $data);
    }

    public function home()
    {
        $this->view('/pages/admin_home');
    }

    //to change or view user details
    public function settings()
    {
        $errors = "";
        //Check whether users array is updated
        if (isset($_POST["users"])) {
            // if yes, update database
            $this->admin_model->update_user_details($_POST["users"]);
        } //Check whether passwords array is updated
        else if (isset($_POST['password-changed'])) {
            // if yes, update database
            $errors = $this->admin_model->update_password_details($_POST["passwords"]);
        }
        //Retrieve details from the database
        $records = $this->admin_model->load_user_details();

        if (strlen($errors) !== 0) {
            $records['errors'] = $errors;
        }
        //Retrieved data will be shown in the settings page
        $this->view('/pages/admin_settings', $records);
    }

    public function data_management_update()
    {
        $record_type = $_GET['record_type'];
        $id = $_GET['id'];

        $this->view('/pages/data_management_update');
    }
    public function data_management()
    {
        $records = [];
        $rows = [
            "antigen_tests" => ["HealthID", "Test status"],
            "covid_deaths" => ["HealthID", "Place", "Comments"],
            "pcr_tests" => ["HealthID", "Test Status"],
            "vaccinations" => ["HealthID", "Dose", "Name of Vaccine", "Conducted Place", "Allergies / Disorders"]
        ];

        if (isset($_POST['newrecord'])) {
            $this->admin_model->update_record($_GET['record_type'], $_POST['newrecord']);
        }
        if (isset($_GET['record_type']) && $_GET['record_type']) {

            $type = $_GET['record_type'];
            $records = $this->admin_model->load_by_type($type);
            $records["type"] = $rows[$type];
            array_push($records, $type);
            $this->view('/pages/data_management', $records);
            return;
        }

        $this->view('/pages/data_management');
    }

    public function data_delete()
    {
        $type = $_GET['record_type'];
        if ($this->admin_model->delete_by_id($type, $_POST['id'])) {
            header('location:' . URL_ROOT . "/pages/data_management?record_type=$type");
        } else {
            die('Something went wrong');
        }
    }

    public function user_management()
    {

        $data = $this->admin_model->load_deo();      //array list of users

        //add new deo
        if (isset($_POST['nw_deo_submit'])) {

            $hos_id = $this->admin_model->get_hospital_id();   //relevent hospital id

            $deo = [
                "username" => $_POST['deo_username'],
                "email" => $_POST['deo_email'],
                "password" => $_POST['password'],
                "hospital_id" => $hos_id
            ];

            //checking whether an existing username
            if ($this->admin_model->username_exist($deo['username'])) {

                header('location:' . URL_ROOT . '/pages/user_management?duplicate');  //redirect with error message
            } else {
                //hash the password
                $deo['password'] = password_hash($deo['password'], PASSWORD_DEFAULT);
                //add new deo
                if ($this->admin_model->add_deo($deo)) {
                    header('location:' . URL_ROOT . '/pages/user_management');
                } else {
                    die('Something went wrong');
                }
            }
        }

        //remove deo
        if (isset($_POST['rm_submit'])) {
            $id = $_POST["deo_id_record"];
            if ($this->admin_model->remove_deo($id)) {
                header('location:' . URL_ROOT . '/pages/user_management');
            } else {
                die('Something went wrong');
            }
        }



        $this->view('/pages/user_management', $data);
    }
}
