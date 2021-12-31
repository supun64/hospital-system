<?php  

class CitizenFactory{

    private $db;


    public function __construct() {
        $this->db = Database::get_instance();
    }

    public function get_product($id){

        $data = $this->db->findById('citizens','health_id',$id);
        $citizen = NULL;
        if($data){
            $citizen = new Citizen($data[0]['health_id'],$data[0]['name'],$data[0]['dob'],$data[0]['gender'],$data[0]['province'],$data[0]['district'],$data[0]['contact_num'],$data[0]['email']);
            
        }
        return $citizen;
    }



}