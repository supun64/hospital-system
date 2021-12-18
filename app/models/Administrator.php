<?php


class Administrator
{

    private $hospital_id;
    private $user_id;
    private $deo_handler;

    public function __construct()
    {
        $this->db = Database::get_instance();
        $this->hospital_id = $_SESSION['hospital_id']; //this should be changed -> id should be gained through constructor (using session)    
        $this->user_id = $_SESSION['userID'];
        $this->deo_handler = new OperatorHandler();
    }

    //----------------------------User Management--------------------------------

    //function to load all the deos
    public function load_deo()
    {
        $data = $this->deo_handler->load_deo($this->hospital_id);
        return $data;
    }


    //function to check whether an existing email
    public function email_exist($email)
    {

        $data = $this->deo_handler->email_exist($email);
        return $data;
        
    }


    //function to add new deo
    public function add_deo($deo)
    {

        $result = $this->deo_handler->add_deo($deo);
        return $result;


    }

    //delete existing deo

    public function remove_deo($id)
    {
        $result = $this->deo_handler->remove_deo($id);
        return $result;
        
    }


    //getter for hospital_id
    public function get_hospital_id()
    {
        return $this->hospital_id;
    }

    //----------------------------Admin Settings-----------------------------------------------------

    //load user details
    public function load_user_details()
    {
        $sql = "SELECT * FROM `users` WHERE user_id = $this->user_id and hospital_id = $this->hospital_id";
        $sql_hos = "SELECT name FROM `hospitals` WHERE hospital_id = $this->hospital_id";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set()[0];
        $this->db->sql_execute($sql_hos);
        $name = $this->db->result_set()[0];
        $data["hospital_name"] = $name["name"];
        return $data;
    }

    //update a record in a table.
    public function update_user_details($param_list)
    {
        if ($this->db->safe($param_list['name']) && $this->db->safe($param_list['email'])) {
            $sql = "UPDATE `users` SET user_name = '$param_list[name]', user_email = '$param_list[email]'
            WHERE user_id = $this->user_id";
        } else {
            die("You have been hacked:))");
        }
        return $this->db->sql_execute($sql);
    }

    public function update_password_details($param_list)
    {
        $errors = "";
        if ($this->db->safe($param_list['old_password']) && $this->db->safe($param_list['new_password']) && $this->db->safe($param_list['confirm_password'])) {
            $sql_password = "SELECT password FROM users WHERE user_id=$this->user_id";
            $this->db->sql_execute($sql_password);
            $password = $this->db->result_set()[0]["password"];
            if (password_verify($param_list['old_password'], $password)/*$param_list['old_password'] === $password*/) {
                $hash_password = password_hash($param_list['new_password'], PASSWORD_DEFAULT);
                $sql = "UPDATE `users` SET password = '$hash_password' /*'$param_list[new_password]'*/ 
                        WHERE user_id = $this->user_id";
                $this->db->sql_execute($sql);
            } else {
                $errors = "Your current password is incorrect.";
            }
        } else {
            die("You have been hacked:))");
        }
        return $errors;
    }
}
