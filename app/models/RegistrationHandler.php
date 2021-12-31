<?php  

class RegistrationHandler{


    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }
    
    public function get_all_hospitals(){
    
        $result_set =  $this->db->find_All('hospitals');
        return $result_set;
    }

    public function get_hospital($id){


       $result = $this->db->findById('hospitals','hospital_id',(int)$id);
        return $result[0];
    }


    //function to check whether an existing email
    public function email_exist($email)
    {

        $result = $this->db->find("users","user_email",$email);
        if($result){return true;}
        return false;
    }

    // TODO: do this using sql Transactions 

        //function to add new admin
       // public function add_admin($admin)
       // {
            // $username = $this->db->safe($admin['username']);
            // $email = $this->db->safe($admin['email']);
            // $password = $this->db->safe($admin['password']);
            // $hos_id = (int)$admin['hospital_id'];
            // $is_admin = 1;
    
            // $sql = "INSERT INTO users (user_name, user_email, password, hospital_id, is_admin) VALUES ('$username','$email','$password',$hos_id,$is_admin)";
            // $result_1 = $this->db->sql_execute($sql);

            // if($result_1){
            //     $sql = "UPDATE hospitals SET is_registered = 1 WHERE hospital_id = $hos_id";
            //     $result_2 = $this->db->sql_execute($sql);

            //     if($result_2){
            //         return true;
            //     }else{
            //         $sql = "DELETE FROM users WHERE user_email='$email'";
            //         return false;
            //     }
            // }else{
            //     return false;
            // }
       // }

        public function register($id){
            $param_list = ["is_registered"=>1 , "hospital_id"=> $id];
            $result =  $this->db->update("hospitals","hospital_id",$param_list);
            if($result){
                return true;
            }else{
                return false;
            }
        }



}