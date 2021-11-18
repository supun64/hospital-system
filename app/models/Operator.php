<?php 


class Operator{


public function __construct()
{
    $this->db = new Database();
    $this->hospital_id = 1;           //this should be changed -> id should be gained through constructor (using session)
}

//function to load all the deos
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
}


