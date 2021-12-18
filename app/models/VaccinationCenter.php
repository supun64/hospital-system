<?php

class VaccinationCenter extends COVID_Department{

    private $vaccination_factory;

    public function __construct()
    {
        parent::__construct();
        $this->vaccination_factory = new VaccinationFactory();
    }

    public  function add_record($record){}

    public  function update_record($record){
        $place = $record->get_vaccinated_place();
        $comments = $record->get_comments();
        $id = $record->get_id();

        $params = [ "vaccinated_place"=>$place,
                    "comments"=> $comments,
                    "id"=>$id];

        return $this->db->update("vaccinations","id",$params);
    }

    public  function delete_record($id){
        return $this->db->delete("vaccinations","id",$id);
    }

    public  function give_all_records(){
        $result_set = $this->db->findByHosID_nd_Date("vaccinations",$this->hospital_id);
        $records = [];

        foreach ($result_set as $result) {
            $vaccination = $this->factory->get_record("vaccinations", $result);
            array_push($records, $vaccination);
        }

        return $records;
    }

    public function to_array($record_obj){
        return ["id"=>$record_obj->get_id(),
                "health_id"=>$record_obj->get_health_id(),
                "date"=>$record_obj->get_date(),
                "dose"=>$record_obj->get_dose(),
                "vaccine_name"=>$record_obj->get_vaccine_name(),
                "hospital_id"=>$record_obj->get_hospital_id(),
                "vaccinated_place"=>$record_obj->get_vaccinated_place(),
                "comments"=>$record_obj->get_comments()];
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////
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
    
        /*$sql = "INSERT INTO vaccinations (health_id, date, dose, vaccine_name, hospital_id, vaccinated_place, comments) VALUES ($health_id,'$vac_date',$dose ,'$vac_name', $hospital, '$vac_place', '$comment')";
        $result = $this->db->sql_execute($sql);*/

        $result = $this->db->insert("vaccinations",$data);
    
        if($result){
            return true;
        }else{
            return false;
        }
    
    }









}



