<?php

class VaccinationCenter{

    private $vaccination_factory;
    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
        $this->vaccination_factory = new VaccinationFactory();
    }

    public function load_vaccination($id){
        $records = $this->vaccination_factory->get_product($id);
        return $records;
    }

    public function add_vaccinated_person($data){
        $health_id = $data["health_id"];
        $vac_name = $this->db->safe($data["vac_name"]);
        $vac_date = $this->db->safe($data["vac_date"]);
        $hospital = $data["hospital"];
        $vac_place = $this->db->safe($data["vac_place"]);
        $dose = $data["dose"];
        $comment = $this->db->safe($data["comment"]);
    
        $sql = "INSERT INTO vaccinations (health_id, date, dose, vaccine_name, hospital_id, vaccinated_place, comments) VALUES ($health_id,'$vac_date',$dose ,'$vac_name', $hospital, '$vac_place', '$comment')";
        $result = $this->db->sql_execute($sql);
    
        if($result){
            return true;
        }else{
            return false;
        }
    
    }









}



