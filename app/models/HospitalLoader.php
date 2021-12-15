<?php  

class HospitalLoader{



    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function get_all_hospitals(){
    
        $sql = "SELECT * FROM hospitals";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set();
        return $data;
    }





















}