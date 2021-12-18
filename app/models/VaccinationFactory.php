<?php  

class VaccinationFactory extends Factory{

    public function __construct() {
        parent::__construct();
    }
    
    public function get_product($id){

        $id = $this->db->safe($id);
        $sql = "SELECT * FROM vaccinations WHERE health_id = $id";
        $this->db->sql_execute($sql);
    
        $data = $this->db->result_set();
        $records = new SearchRecord($data);
    
        if($data){
            return $records;
        }
        else{
            return NULL;
        }
    }
}