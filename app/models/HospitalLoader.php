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

    public function find($useremail){
        $this->db->sql_execute("SELECT * FROM `users` WHERE user_email = '$useremail'");
        return $this->db->result_set()[0];
    }
    
    //save the log-in info in a session(only if the login stat are correct)
    public function log_in($useremail,$password){
        $useremail = $this->db->safe($useremail);
        $password = $this->db->safe($password);
        $loggedin_user = $this->find($useremail);

        if(!empty($loggedin_user) && password_verify($password,$loggedin_user["password"])){
            session_regenerate_id();
            $_SESSION["is_admin"] = $loggedin_user["is_admin"];
            $_SESSION["useremail"] = $loggedin_user["user_email"];
            $_SESSION["password"] = $loggedin_user["password"];
            $_SESSION["userID"] = $loggedin_user["user_id"];
            return true;
        }else{
            return false;
        }
    }


    //to check whether the user is still logged in
    public function is_logged_in(){
        if(empty($_SESSION["useremail"])) return false;
        else{
            $user = $this->find($_SESSION["useremail"]);
            return !empty($user) && ($user["password"]=== $_SESSION['password']);
        }
    }

    //logout---> unset the session fields
    public function logout(){
        unset($_SESSION['userID']);
        unset($_SESSION["is_admin"]);
        unset($_SESSION['userID']);
        unset($_SESSION["password"]);
        session_destroy();
    }
}