<?php 


class Operator{


public function __construct()
{
    $this->db = new Database();
    $this->hospital_id = 1;           //this should be changed -> id should be gained through constructor (using session)
}

// functions for vaccination -------------------------------


public function load_citizen($id){

    $id = $this->db->safe($id);
    $sql = "SELECT * FROM citizens WHERE health_id = $id";
    $this->db->sql_execute($sql);
    $data = $this->db->get_result_row();

    if($data){
        return $data;
    }
    else{
        return false;
    }

}

public function load_vaccination($id){
    $id = $this->db->safe($id);
    $sql = "SELECT * FROM vaccinations WHERE health_id = $id";
    $this->db->sql_execute($sql);

    $data = $this->db->result_set();

    if($data){
        return $data;
    }
    else{
        return [];
    }
}

public function load_hospitals(){
    $sql = "SELECT hospital_id,name FROM hospitals";
    $this->db->sql_execute($sql);

    $hospitals = $this->db->result_set();

    return $hospitals;
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

public function health_id_exist($health_id){
    
    $health_id = $this->db->safe($health_id);
    $sql = "SELECT * FROM citizens WHERE health_id = '$health_id'";
    $this->db->sql_execute($sql);
    $data = $this->db->result_set();
    if($data){
        return true;
    }else{
        return false;
    }
}


}


