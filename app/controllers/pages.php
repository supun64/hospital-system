<?php


class Pages extends Controller
{

    public function __construct()
    {
        $this->hospital_loader_model =  $this->model('RegistrationHandler');
        $this->record_factory = Factory::getFactory("RecordFactory");
        $this->center_factory = Factory::getFactory("CentersFactory");
        $this->citizen_factory = Factory::getFactory("CitizenFactory");
        $this->user_handler = $this->model('UserHandler');
        $this->chart_loader = $this->model('ChartLoader');
        $this->mail = new MailerWrapper();


        //if someone tries to access the pages without logging in, they will be redirected to the users/index page
        if (!$this->user_handler->is_logged_in())
            header('location:' . URL_ROOT . '/users/index');
    }

    public function index()
    {
        $this->find_citizen_id();
        $data['monthly_result'] = $this->chart_loader->load_last_thirty();
        $data['total'] = $this->chart_loader->load_total();


        $this->view('/pages/index', $data);
    }


    public function antigen()
    {
        $this->find_citizen_id();

        $data['personal'] = [];
        $data['antigen_tests'] = [];
        $data['hospital_id'] = NULL;
        $data['notification'] = [];

        $center = $this->center_factory->get_center('antigen_tests');
        $center->set_observer(new AntigenObserver());
        // code to search a vaccination

        if (isset($_POST["antigen-search"])) {

            $id = $_POST["antigen-search-bar-input"]; // TO get the search input
            $citizen = $center->get_citizen($id);
            if ($citizen != NULL) {

                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'is_alive' => $citizen->get_is_alive()];    //array list of users
            }

            $search_records = $center->load_details_by_id($id);
            if ($search_records != NULL) {
                foreach ($search_records as $result) {
                    array_push($data["antigen_tests"], $center->to_array($result));
                }
            }

            $data['hospital_id'] = $center->get_hospital_id();

            if (!$data['personal']) {
                header('location:' . URL_ROOT . '/pages/antigen?not-user');
            }
        }

        //This is the code to check whether user click submit button
        if (isset($_POST["add-patient-submit"])) {

            $hospital_id = $center->get_hospital_id();

            $antigen_detail = [
                "id" => NULL,
                "health_id" => $_POST["add-patient-health-id"],
                "hospital_id" => $hospital_id,
                "date" => $_POST["add-patient-antigen-date"],
                "status" => "pending",
                "place" => $_POST["add-patient-antigen-place"]
            ];

            $new_antigen = $this->record_factory->get_record('antigen_tests', $antigen_detail);
            // not checking health id exists since we already in a existing health id and the field is auto filled

            if ($center->add_record($new_antigen)) {
                header('location:' . URL_ROOT . '/pages/antigen?success');
            } else {
                die("Something went wrong");
            }
        }


        // This is the code to check whether user click update button
        if (isset($_POST["update-patient-submit"])) {

            $hospital_id = $center->get_hospital_id();
            $antigen_detail = [
                "id" => $_POST['final-id'],
                "health_id" => $_POST["final-htid"],
                "hospital_id" => $hospital_id,
                "date" => $_POST["final-date"],
                "status" => $_POST['final-status'],
                "place" => $_POST["final-place"]
            ];


            $new_antigen = $this->record_factory->get_record('antigen_tests', $antigen_detail);
            if ($center->update_record($new_antigen)) {



                $antigen_id = (string)$new_antigen->get_id();
                header('location:' . URL_ROOT . '/pages/antigen?updated=' . $antigen_detail['health_id'] . "-" . $antigen_id);
            } else {
                die("Something went wrong");
            }
        }

        //after updating
        if (isset($_GET['updated'])) {
            $health_id = explode("-", $_GET['updated'])[0];
            $antigen_id = (int)explode("-", $_GET['updated'])[1];

            $citizen = $center->get_citizen($health_id);

            if ($citizen != NULL) {

                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'is_alive' => $citizen->get_is_alive()];    //array list of users
            }
            $updated_record = NULL;
            $search_records = $center->load_details_by_id($health_id);
            if ($search_records != NULL) {
                foreach ($search_records as $result) {
                    array_push($data["antigen_tests"], $center->to_array($result));
                    if ($result->get_id() == $antigen_id) {
                        $updated_record = $result;
                    }
                }
            }

            $data['hospital_id'] = $center->get_hospital_id();

            $data['email'] = $citizen->get_email();
            $id = $citizen->get_id();
            $name = $citizen->get_name();

            if ($data['email'] && $updated_record) {
                $data['subject'] = "Antigen Test result by " . $_SESSION['hospitalname'];
                $data['content'] = "Patient ID: " . $id . "\n" . "Patient name: " . $name . "\n" . "Tested Date:" . $updated_record->get_date() . "\n" . "Antigen ID: " . $updated_record->get_id() . "\n" . "Test Result: " . $updated_record->get_status();
                $data['content']  = nl2br($data['content']);
                $data['notification'] = $this->mail;
            }
        }
        $_SESSION["is_admin"] ? header('location:' . URL_ROOT . '/pages/index') : $this->view('/pages/antigen', $data);
    }



    public function covid_deaths()
    {
        $this->find_citizen_id();

        $death_center = $this->center_factory->get_center('covid_deaths');
        $patient_center = $this->center_factory->get_center('covid_patients');

        $death_center->set_observer(new CovidDeathObserver());
        $data = [];
        if (isset($_POST["death-search-bar-input"]) || isset($_GET['updated'])) {
            $data['hospital_id'] = $death_center->get_hospital_id();
            if (isset($_GET['updated'])) {
                $id = $_GET['updated'];
            } else {
                $id = $_POST["death-search-bar-input"]; // TO get the search input
            }

            $citizen = $death_center->get_citizen($id);
            if ($citizen != NULL) {

                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'gender' => $citizen->get_gender()];    //array list of user details
            }
            $death_records = $death_center->load_details_by_id($id);
            if ($death_records != NULL) {
                $data['death'] =   ['date' => $death_records->get_date(), 'place' => $death_records->get_place(), 'comments' => $death_records->get_comments()];    //array list of user details
            }

            if (isset($data['personal'])) {
                $this->view('/pages/covid_deaths', $data);
                return;
            } else {
                header('location:' . URL_ROOT . '/pages/covid_deaths?not-user');
            }
            $this->view('/pages/covid_deaths', $data);
        }

        if (isset($_POST["add-death-submit"])) {

            $hospital_id = $death_center->get_hospital_id();
            $data['hospital_id'] = $hospital_id;

            $death_details = [
                "id" => NULL,
                "health_id" => $_POST["add-death-health-id"],
                "hospital_id" => $hospital_id,
                "date" => $_POST["add-death-date"],
                "place" => $_POST["add-death-place"],
                "comments" => $_POST["add-death-comments"]
            ];
            $health_id = $death_details['health_id'];
            $citizen = $death_center->get_citizen($health_id);

            if ($citizen && !$death_center->isexist_user_id($health_id)) {
                if ($patient_center->isexist_user_id($health_id) &&  $patient_center->load_last_record($health_id)["status"] == "Admitted") {
                    $last_record = $patient_center->load_last_record($health_id);
                    $last_record["status"] = "Died";
                    $last_record["discharge_date"] = $_POST["add-death-date"];
                    $new_patient = $this->record_factory->get_record('covid_patients', $last_record);
                    if ($patient_center->update_record($new_patient)) {
                    } else {
                        die("Something went wrong :(");
                    }
                }
                $new_death = $this->record_factory->get_record('covid_deaths', $death_details);

                if ($death_center->add_record($new_death) && $citizen->get_is_alive()) {

                    header('location:' . URL_ROOT . '/pages/covid_deaths?updated=' . $_POST["add-death-health-id"]);
                } else {
                    die("Something went wrong");
                }
            } else {
                $data['error'] = !$citizen ? "Invalid UserID" : "Overriding an existing record is prohibited.";
                $this->view('/pages/covid_deaths', $data);
                return;
            }
        }
        $_SESSION["is_admin"] ? header('location:' . URL_ROOT . '/pages/index') : $this->view('/pages/covid_deaths');
    }

    public function covid_patients()
    {
        $this->find_citizen_id();

        $data['personal'] = [];
        $data['patient_history'] = [];
        $data['hospital_id'] = NULL;
        $data['final_record'] = [];

        $center = $this->center_factory->get_center('covid_patients');
        $center->set_observer(new CovidPatientObserver());
        $covid_death_center = $this->center_factory->get_center('covid_deaths');
        $covid_death_center->set_observer(new CovidDeathObserver());
        // code to search 
        if (isset($_POST["patient-search"])) {

            $id = $_POST["patient-search-bar-input"]; // To get the search input(health ID)
            $citizen = $center->get_citizen($id);
            if ($citizen != NULL) {
                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'gender' => $citizen->get_gender()];    //array list of users
            }

            $admission_records = $center->load_details_by_id($id);
            if ($admission_records != NULL) {
                foreach ($admission_records as $result) {
                    array_push($data["patient_history"], $center->to_array($result));
                }
                $data['final_record'] = ['status' => end($admission_records)->get_status(), 'hospital_id' => end($admission_records)->get_hospital_id()];
            } else {
                $data['final_record'] = ['status' => "", 'hospital_id' => ""];
            }

            if (!$data['personal']) {
                header('location:' . URL_ROOT . '/pages/covid_patients?not-user');
            }
        }

        // This is the code to check whether user click submit button
        if (isset($_POST["add-patient-submit"])) {

            $hospital_id = $center->get_hospital_id();

            $patient_detail = [
                "admission_id" => NULL,
                "health_id" => $_POST["add-patient-health-id"],
                "hospital_id" => $hospital_id,
                "admission_date" => $_POST["add-patient-admission-date"],
                "discharge_date" => "",
                "status" =>  "Admitted",
                "conditions" => $_POST["add-patient-conditions"]
            ];

            $new_patient = $this->record_factory->get_record('covid_patients', $patient_detail);
            // not checking health id exists since we already in a existing health id and the field is auto filled

            if ($center->add_record($new_patient)) {
                header('location:' . URL_ROOT . '/pages/covid_patients?success');
            } else {
                die("Something went wrong");
            }
        }

        // This is the code to check whether user click update button
        if (isset($_POST["update-patient-submit"])) {
            $id = $_POST["final-health-id"];
            if ($id) {
                $citizen = $center->get_citizen($id);
                if ($citizen != NULL) {
                    $last_record = $center->load_last_record($id);
                    $last_record["status"] = $_POST["final-status"];
                    $last_record["discharge_date"] = $_POST["final-discharge-date"];
                    $hospital_id = $center->get_hospital_id();
                    $new_patient = $this->record_factory->get_record('covid_patients', $last_record);

                    if ($_POST["final-status"] == "Died") {
                        $death_details = [
                            "id" => NULL,
                            "health_id" => $_POST["final-health-id"],
                            "hospital_id" => $hospital_id,
                            "date" => $_POST["final-discharge-date"],
                            "place" => $_SESSION["hospitalname"],
                            "comments" => "Died at the hospital - " . $_SESSION["hospitalname"]
                        ];

                        $is_citizen = $covid_death_center->get_citizen($id);
                        if ($is_citizen && !$covid_death_center->isexist_user_id($id) && $citizen->get_is_alive()) {
                            $new_death = $this->record_factory->get_record('covid_deaths', $death_details);
                            $result1 = $covid_death_center->add_record($new_death);
                        }
                    }
                    $data['final_record'] = ['status' => $_POST["final-status"], 'hospital_id' => $last_record["hospital_id"]];

                    $result2 = $center->update_record($new_patient);
                    if ($result1 || $result2) {
                        $health_id = (string)$new_patient->get_health_id();
                        header('location:' . URL_ROOT . '/pages/covid_patients?updated=' . $health_id);
                    } else {
                        die("Something went wrong");
                    }
                }
            }
        }

        if (isset($_GET["updated"])) {
            $health_id = $_GET["updated"];
            $citizen = $center->get_citizen($health_id);
            if ($citizen != NULL) {
                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'gender' => $citizen->get_gender()];    //array list of users
            }

            $admission_records = $center->load_details_by_id($health_id);
            if ($admission_records != NULL) {
                foreach ($admission_records as $result) {
                    array_push($data["patient_history"], $center->to_array($result));
                }
                $data['final_record'] = ['status' => end($admission_records)->get_status(), 'hospital_id' => end($admission_records)->get_hospital_id()];
            } else {
                $data['final_record'] = ['status' => "", 'hospital_id' => ""];
            }
            $data['hospital_id'] = $center->get_hospital_id();
        }

        $_SESSION["is_admin"] ? header('location:' . URL_ROOT . '/pages/index') : $this->view('/pages/covid_patients', $data);
    }



    public function pcr()
    {
        $this->find_citizen_id();

        $data['personal'] = [];
        $data['pcr_tests'] = [];
        $data['hospital_id'] = NULL;
        $data['notification'] = [];

        $center = $this->center_factory->get_center('pcr_tests');
        $center->set_observer(new PcrObserver());
        // code to search a vaccination

        if (isset($_POST["pcr-search"])) {

            $id = $_POST["pcr-search-bar-input"]; // TO get the search input
            $citizen = $center->get_citizen($id);
            if ($citizen != NULL) {
                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'is_alive' => $citizen->get_is_alive()];    //array list of users
            }

            $search_records = $center->load_details_by_id($id);
            if ($search_records != NULL) {
                foreach ($search_records as $result) {
                    array_push($data["pcr_tests"], $center->to_array($result));
                }
            }

            $data['hospital_id'] = $center->get_hospital_id();


            if (!$data['personal']) {
                header('location:' . URL_ROOT . '/pages/pcr?not-user');
            }
        }

        // This is the code to check whether user click submit button
        if (isset($_POST["add-patient-submit"])) {

            // $hospital_id = (int)explode(" - ", $_POST["add-patient-hospital-name"]);
            $hospital_id = $center->get_hospital_id();

            $pcr_detail = [
                "id" => NULL,
                "health_id" => $_POST["add-patient-health-id"],
                "hospital_id" => $hospital_id,
                "date" => $_POST["add-patient-pcr-date"],
                "status" => "pending",
                "place" => $_POST["add-patient-pcr-place"]
            ];

            $new_pcr = $this->record_factory->get_record('pcr_tests', $pcr_detail);
            // not checking health id exists since we already in a existing health id and the field is auto filled

            if ($center->add_record($new_pcr)) {
                header('location:' . URL_ROOT . '/pages/pcr?success');
            } else {
                die("Something went wrong");
            }
        }


        // This is the code to check whether user click update button
        if (isset($_POST["update-patient-submit"])) {

            $hospital_id = $center->get_hospital_id();
            $pcr_detail = [
                "id" => $_POST['final-id'],
                "health_id" => $_POST["final-htid"],
                "hospital_id" => $hospital_id,
                "date" => $_POST["final-date"],
                "status" => $_POST['final-status'],
                "place" => $_POST["final-place"]
            ];

            $new_pcr = $this->record_factory->get_record('pcr_tests', $pcr_detail);
            if ($center->update_record($new_pcr)) {
                $pcr_id = (string)$new_pcr->get_id();
                header('location:' . URL_ROOT . '/pages/pcr?updated=' . $pcr_detail['health_id'] . "-" . $pcr_id);
            } else {
                die("Something went wrong");
            }
        }

        //after updating
        if (isset($_GET['updated'])) {
            $health_id = explode("-", $_GET['updated'])[0];
            $pcr_id = (int)explode("-", $_GET['updated'])[1];

            $citizen = $center->get_citizen($health_id);

            if ($citizen != NULL) {

                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'is_alive' => $citizen->get_is_alive()];    //array list of users
            }
            $updated_record = NULL;
            $search_records = $center->load_details_by_id($health_id);
            if ($search_records != NULL) {
                foreach ($search_records as $result) {
                    array_push($data["pcr_tests"], $center->to_array($result));
                    if ($result->get_id() == $pcr_id) {
                        $updated_record = $result;
                    }
                }
            }

            $data['hospital_id'] = $center->get_hospital_id();

            $data['email'] = $citizen->get_email();
            $id = $citizen->get_id();
            $name = $citizen->get_name();

            if ($data['email'] && $updated_record) {
                $data["subject"] = "PCR Test result by " . $_SESSION['hospitalname'];
                $data['content'] = "Patient ID: " . $id . "\n" . "Patient name: " . $name . "\n" . "Tested Date:" . $updated_record->get_date() . "\n" . "PCR ID: " . $updated_record->get_id() . "\n" . "Test Result: " . $updated_record->get_status();
                $data['content'] = nl2br($data['content']);
                $data['notification'] = $this->mail;
            }
        }



        $_SESSION["is_admin"] ? header('location:' . URL_ROOT . '/pages/index') : $this->view('/pages/pcr', $data);
    }

    public function vaccination()
    {
        $this->find_citizen_id();

        if (!isset($_SESSION['vac_count'])) {
            $_SESSION['vac_count'] = 1;
        }

        $data['personal'] = [];
        $data['vaccinations'] = [];
        $data['hospital_id'] = NULL;

        $data['loaded'] = false;


        $center = $this->center_factory->get_center('vaccinations');

        // code to search a vaccination

        if (isset($_POST["vaccine-search"])) {


            $id = $_POST["vaccine-search-bar-input"]; // TO get the search input
            $citizen = $center->get_citizen($id);
            if ($citizen != NULL) {
                $data['personal'] =   ['health_id' => $citizen->get_id(), 'name' => $citizen->get_name(), 'dob' => $citizen->get_dob(), 'is_alive' => $citizen->get_is_alive()];    //array list of users
            }

            $search_records = $center->load_details_by_id($id);
            if ($search_records != NULL) {
                foreach ($search_records as $result) {
                    array_push($data["vaccinations"], $center->to_array($result));
                }
            }

            $data['hospital_id'] = $center->get_hospital_id();


            if (!$data['personal']) {
                header('location:' . URL_ROOT . '/pages/vaccination?not-user');
            }

            $data['loaded'] = true;
        }


        // This is the code to check whether user click submit button
        if (isset($_POST["add-patient-submit"])) {

            // $hospital_id = (int)explode(" - ", $_POST["add-patient-hospital-name"]);
            $hospital_id = $center->get_hospital_id();


            $vaccine_detail = [
                "id" => NULL,
                "batch_num" => $_POST["add-patient-batch-num"],
                "health_id" => $_POST["add-patient-health-id"],
                "date" => $_POST["add-patient-vaccinated-date"],
                "dose" => $_POST["add-patient-dose"],
                "vaccine_name" => $_POST["add-patient-vaccination-name"],
                "hospital_id" => $hospital_id,
                "vaccinated_place" => $_POST["add-patient-vaccinated-place"],
                "comments" => $_POST["add-patient-comment"]
            ];

            $new_vaccine = $this->record_factory->get_record('vaccinations', $vaccine_detail);
            // not checking health id exists since we already in a existing health id and the field is auto filled

            if ($center->add_record($new_vaccine)) {
                header('location:' . URL_ROOT . '/pages/vaccination?success');
            } else {
                die("Something went wrong");
            }
        }

        $_SESSION["is_admin"] ? header('location:' . URL_ROOT . '/pages/index') : $this->view('/pages/vaccination', $data);
    }

    //to change or view user details
    public function settings()
    {
        $this->find_citizen_id();

        //Retrieve details from the database
        $records = $this->user_handler->load_loggedin_user();
        $error1 = "";
        $error2 = "";
        //Check whether users array is updated
        if (isset($_POST["users"])) {
            // if yes, update database
            $error1 = $this->user_handler->update_user_details($_POST["users"]);
            if (strlen($error1) !== 0) {
                header('location:' . URL_ROOT . '/pages/settings?error1');
            } else {
                header('location:' . URL_ROOT . '/pages/settings?success');
            }
        } //Check whether passwords array is updated
        else if (isset($_POST['password-changed'])) {
            // if yes, take the errors
            $error2 = $this->user_handler->update_password_details($_POST["passwords"]);
            if (strlen($error2) !== 0) {
                header('location:' . URL_ROOT . '/pages/settings?error2');
            } else {
                header('location:' . URL_ROOT . '/pages/settings?success');
            }
        }

        $this->view('/pages/settings', $records);
    }

    public function data_management()
    {
        $records = [];
        $rows = [
            "antigen_tests" => ["HealthID", "Test status", "place"],
            "covid_deaths" => ["HealthID", "Place", "Comments"],
            "pcr_tests" => ["HealthID", "Test Status", "Place"],
            "vaccinations" => ["Batch Number", "HealthID", "Dose", "Name of Vaccine", "Conducted Place", "Comments"],
            "covid_patients" => ["HealthID", "Admission date", "Discharge date", "Hospital name", "Conditions", "status"]
        ];

        $type = $_GET['record_type'];
        $center = $this->center_factory->get_center($type);

        //set the observer accordingly
        switch ($type) {
            case "pcr_tests":
                $center->set_observer(new PcrObserver());
                break;

            case "antigen_tests":
                $center->set_observer(new AntigenObserver());
                break;

            case "covid_deaths":
                $center->set_observer(new CovidDeathObserver());
                break;

            case "covid_patients":
                $center->set_observer(new CovidPatientObserver());
                break;
        }

        if (isset($_POST['delete_submitted'])) {
            if ($center->delete_record($_POST['id'])) {
                header('location:' . URL_ROOT . "/pages/data_management?record_type=$type");
            } else {
                die('Something went wrong::');
            }
        }

        if (isset($_POST['newrecord'])) {
            $record = $this->record_factory->get_record($type, $_POST['newrecord']);
            $center->update_record($record);
        }
        if (isset($_GET['record_type']) && $_GET['record_type']) {
            $results_set = $center->give_all_records();

            foreach ($results_set as $result) {
                array_push($records, $center->to_array($result));
            }

            $records["type"] = $rows[$type];
            array_push($records, $type);

            $this->view('/pages/data_management', $records);
            return;
        }

        $_SESSION["is_admin"] ? $this->view('/pages/data_management') : header('location:' . URL_ROOT . '/pages/index');
    }

    public function user_management()
    {
        $hos_id = $_SESSION['hospital_id'];  //relevent hospital id
        $data['notification'] = [];
        $data['users'] = $this->user_handler->find_All_Users($hos_id);      //array list of users

        //add new deo
        if (isset($_POST['nw_deo_submit'])) {

            $deo = new User(NULL, $_POST['deo_username'], $_POST['password'], $hos_id, $_POST['deo_email'], 0);

            //checking whether an existing email
            if ($this->user_handler->email_exist($deo->get_user_email())) {

                header('location:' . URL_ROOT . '/pages/user_management?duplicate');  //redirect with error message
            } else {
                //hash the password
                $deo->set_password(password_hash($deo->get_password(), PASSWORD_DEFAULT));
                //add new deo
                if ($this->user_handler->add_user($deo)) {
                    //send password via email 
                    //email objects is sent as a parameter and will be called in the frontend
                    $data['email'] = $deo->get_user_email();
                    $data['subject'] = "Data Entry Operator Registration";
                    $data['content'] =  "Please use your email address to login to our system.\nHospital ID: " . $_SESSION['hospital_id'] . "\nHospital Name: " . $_SESSION['hospitalname'] . "\nTemporary Password: " . $_POST['password'];
                    $data['content'] = nl2br($data['content']);
                    $data['notification'] = $this->mail;


                    $data['users'] = $this->user_handler->find_All_Users($hos_id);

                    $this->view('/pages/user_management', $data);
                } else {
                    die('Something went wrong');
                }
            }
        }

        //remove deo
        if (isset($_POST['rm_submit'])) {
            $id = $_POST["deo_id_record"];
            if ($this->user_handler->remove_user($id)) {
                header('location:' . URL_ROOT . '/pages/user_management');
            } else {
                die('Something went wrong');
            }
        }



        $_SESSION["is_admin"] ? $this->view('/pages/user_management', $data) : header('location:' . URL_ROOT . '/pages/index');
    }

    public function logout()
    {
        $this->user_handler->logout();
        header('location:' . URL_ROOT . '/users/login');
    }

    public function find_citizen_id()
    {
        $data['forget_id_det'] = [];
        if (isset($_POST['forget-id-value'])) {

            //$page = substr($_POST['page'], 16);
            $controller_arr = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
            $page_arr = explode('?', $controller_arr[3]);
            $page = "/" . $controller_arr[2] . "/" . $page_arr[0];
            $type = $_POST['forget-id-type'];
            switch ($type) {
                case "Contact Number":
                    $type = "contact_num";
                    break;
                case "Email":
                    $type = "email";
                    break;
                case "NIC":
                    $type = "nic";
                    break;
            }
            $value = $_POST['forget-id-value'];

            $data['forget_id_det'] = $this->citizen_factory->get_health_id($type, $value);
            //find correct id for given data with relevent type
            !$_SESSION["is_admin"] ? $this->view($page, $data) : header('location:' . URL_ROOT . '/pages/index');
            return;
        }
    }
}
