<?php  


class OperatorHandler{

    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function load_deo($hospital_id)
    {
        $sql = "SELECT * FROM users WHERE hospital_id = $hospital_id AND is_admin=0";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set();
        return $data;
    }

    public function email_exist($email)
    {
        $email = $this->db->safe($email);
        $sql = "SELECT * FROM users WHERE user_email = '$email'";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }


    public function add_deo($deo)
    {
        $username = $this->db->safe($deo['username']);
        $email = $this->db->safe($deo['email']);
        $password = $this->db->safe($deo['password']);
        $hos_id = $deo['hospital_id'];

        $sql = "INSERT INTO users (user_name, user_email, password, hospital_id) VALUES ('$username','$email','$password',$hos_id)";
        $result = $this->db->sql_execute($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }    

    public function remove_deo($id)
    {
        $sql = "DELETE FROM users WHERE user_id = $id";
        $result = $this->db->sql_execute($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }    
}