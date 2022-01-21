<?php

class RegistrationHandler
{


    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function get_all_hospitals()
    {

        $result_set =  $this->db->find_All('hospitals');
        return $result_set;
    }

    public function get_hospital($id)
    {


        $result = $this->db->findById('hospitals', 'hospital_id', (int)$id);
        return $result[0];
    }


    //function to check whether an existing email
    public function email_exist($email)
    {

        $result = $this->db->find("users", "user_email", $email);
        if ($result) {
            return true;
        }
        return false;
    }

    public function register($id, $admin)
    {
        $param_list_2 = [
            'user_name' => $admin->get_user_name(),
            'user_email' => $admin->get_user_email(),
            'password' => $admin->get_password(),
            'hospital_id' => $admin->get_hospital_id(),
            'is_admin' => $admin->get_is_admin()
        ];
        $param_list_1 = ["is_registered" => 1, "hospital_id" => $id];
        //$result =  $this->db->update("hospitals", "hospital_id", $param_list_1);
        $result = $this->db->transaction(
            ["update", "add"],
            ["table" => "hospitals", "primary_key" => "hospital_id", "fields" => $param_list_1],
            ["table" => "users", "fields" => $param_list_2]
        );
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
