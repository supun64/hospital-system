<?php  

class RegistrationHandler{



    public function __construct()
    {
        $this->db = Database::get_instance();
    }
    
    public function get_all_hospitals(){
    
        $sql = "SELECT * FROM hospitals";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set();
        return $data;
    }

    public function get_hospital($id){

        $sql = "SELECT * FROM hospitals WHERE hospital_id = $id";
        $this->db->sql_execute($sql);
        $data = $this->db->get_result_row();
        return $data;

    }


    //function to check whether an existing email
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

    // TODO: do this using sql Transactions 

        //function to add new admin
        public function add_admin($admin)
        {
            $username = $this->db->safe($admin['username']);
            $email = $this->db->safe($admin['email']);
            $password = $this->db->safe($admin['password']);
            $hos_id = (int)$admin['hospital_id'];
            $is_admin = 1;
    
            $sql = "INSERT INTO users (user_name, user_email, password, hospital_id, is_admin) VALUES ('$username','$email','$password',$hos_id,$is_admin)";
            $result_1 = $this->db->sql_execute($sql);

            if($result_1){
                $sql = "UPDATE hospitals SET is_registered = 1 WHERE hospital_id = $hos_id";
                $result_2 = $this->db->sql_execute($sql);

                if($result_2){
                    return true;
                }else{
                    $sql = "DELETE FROM users WHERE user_email='$email'";
                    return false;
                }
            }else{
                return false;
            }
        }
}