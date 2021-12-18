<?php 


class Operator{

    private $db;
    private $hospital_id;
    private $user_factory;
    private $vaccination_center;
    

public function __construct()
{
    // $this->db = new Database();
    $this->hospital_id = $_SESSION['hospital_id'];           //this should be changed -> id should be gained through constructor (using session)
    $this->user_factory = new UserFactory();
    $this->vaccination_center = new VaccinationCenter();
    
}

// functions for vaccination -------------------------------


public function load_citizen($id){

    $citizen = $this->user_factory->get_product($id);
    return $citizen;

}

public function load_vaccination($id){
    $records = $this->vaccination_center->load_vaccination($id);
    return $records;
}

// public function load_hospitals(){
//     $sql = "SELECT hospital_id,name FROM hospitals WHERE is_registered=1";
//     $this->db->sql_execute($sql);

//     $hospitals = $this->db->result_set();

//     return $hospitals;
// }

public function add_vaccinated_person($data){
    
    return $this->vaccination_center->add_vaccinated_person($data);

}

public function health_id_exist($health_id){
    
    $citizen = $this->user_factory->get_product($health_id);
    if($citizen != NULL){
        return true;
    }else{
        return false;
    }
}

    public function get_hospital_id(){
        return $this->hospital_id;
    }




}


