<?php

class CitizenFactory
{

    private $db;


    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function get_product($id)
    {

        $data = $this->db->findById('citizens', 'health_id', $id);
        $citizen = NULL;
        if ($data) {
            $citizen = new Citizen($data[0]['health_id'], $data[0]['name'], $data[0]['dob'], $data[0]['gender'], $data[0]['province'], $data[0]['district'], $data[0]['contact_num'], $data[0]['email'], $data[0]['is_alive']);
        }
        return $citizen;
    }

    public  function update_liveliness($id)
    {
        $data = $this->db->findById('citizens', 'health_id', $id);
        $health_id = $data[0]['health_id'];
        $name =$data[0]['name'];
        $dob = $data[0]['dob'];
        $gender = $data[0]['gender'];
        $province = $data[0]['province'];
        $district = $data[0]['district']; 
        $contact_num = $data[0]['contact_num'];
        $email = $data[0]['email'];
        $is_alive = $data[0]['is_alive'];

        if ($is_alive==1){
            $is_alive = 0;
        }else{
            $is_alive = 1;
        }

        $params = [
            "health_id" => $health_id,
            "name" => $name,
            "dob" => $dob,
            "gender" => $gender,
            "province" => $province,
            "district" => $district,
            "contact_num" => $contact_num,
            "email" => $email,
            "is_alive" => $is_alive
        ];

        return $this->db->update("citizens", "health_id", $params);
    }
}
