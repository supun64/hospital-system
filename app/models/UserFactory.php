<?php  

class UserFactory extends Factory{

    public function __construct() {
        parent::__construct();
    }

    public function get_product($id){
        $id = $this->db->safe($id);
        $sql = "SELECT * FROM citizens WHERE health_id = $id";
        $this->db->sql_execute($sql);
        $data = $this->db->get_result_row();
        $citizen = NULL;
        if($data){
            $citizen = new Citizen($data['health_id'],$data['name'],$data['dob'],$data['gender'],$data['province'],$data['district'],$data['contact_num'],$data['email']);
            
        }
        return $citizen;
    }



}