<?php 
    class UserHandler{

        private $db;
        private $hos_handler;
        
        public function __construct()
        {
            $this->db = Database::get_instance();
            $this->hos_handler = new RegistrationHandler();
        }

        public function add_user($user){
            $data = [
                'user_name'=> $user->get_user_name(),
                'user_email'=> $user->get_user_email(),
                'password'=> $user->get_password(),
                'hospital_id' => $user->get_hospital_id(),
                'is_admin' => $user->get_is_admin()
            ];
             return $this->db->insert('users',$data);
        } 

        public function remove_user($id){
            $result = $this->db->delete('users','user_id',$id);
            if($result){return true;}
            return false;
        }

        public function email_exist($email){
            $result = $this->db->find("users","user_email",$email);
            if($result){return true;}
            return false;
        }


        public function find_All_Users($hos_id){

            $result_set =  $this->db->find('users','hospital_id',$hos_id);
            $count = 0;
            while($count < sizeof($result_set)){
                if($result_set[$count]['is_admin']== 1){unset($result_set[$count]);break;}
                $count++;
            }
            return $result_set;
        }

        public function load_loggedin_user(){
            $hospital_id = $_SESSION['hospital_id'];
            $user_id = $_SESSION['userID'];
           
            $user_details = $this->db->findByHosID_nd_UserID("users",$hospital_id,$user_id)[0];
            $hos_details =  $this->hos_handler->get_hospital($hospital_id);
            $user_details["hospital_name"] = $hos_details["name"];
            return $user_details;
        }

        public function update_user_details($param_list){
            $data = [];
            $data['user_name'] = $param_list['name'];
            $data['user_email'] = $param_list['email'];
            $data['user_id'] = $_SESSION['userID'];
            if($this->db->update('users','user_id',$data)){
                $_SESSION['username'] = $data['user_name'];
                return true;
            }else{
                return false;
            }    
        }

        public function update_password_details($param_list){
            $errors = "";
            $data = [];
        
            $password = $this->db->findById("users",'user_id',$_SESSION['userID'])[0]["password"];
            if (password_verify($param_list['old_password'], $password)) {
                $data['password'] = password_hash($param_list['new_password'], PASSWORD_DEFAULT);
                $data['user_id'] = $_SESSION['userID'];
            } else {
                $errors = "Your current password is incorrect.";
            }

            return $errors;
        }

        private function findByMail($email){
            $loggedin_user = $this->db->find("users","user_email",$email);
            return $loggedin_user?$loggedin_user[0]:false;
        }

        //save the log-in info in a session(only if the login stat are correct)
        public function log_in($useremail,$password){
            $loggedin_user = $this->findByMail($useremail);
            if($loggedin_user && password_verify($password,$loggedin_user["password"]) && $loggedin_user['hospital_id']==$_SESSION['hospital_id']){
                session_regenerate_id();
                $_SESSION["is_admin"] = $loggedin_user["is_admin"];
                $_SESSION["useremail"] = $loggedin_user["user_email"];
                $_SESSION["password"] = $loggedin_user["password"];
                $_SESSION["userID"] = $loggedin_user["user_id"];
                $_SESSION['username'] = $loggedin_user['user_name'];
                return true;
            }else{
                return false;
            }
        }

        //to check whether the user is still logged in
        public function is_logged_in(){
            if(empty($_SESSION["useremail"])) return false;
            else{
                $user = $this->findByMail($_SESSION["useremail"]);
                return !empty($user) && ($user["password"]=== $_SESSION['password']);
            }
        }

        //logout---> unset the session fields
        public function logout(){
            unset($_SESSION['userID']);
            unset($_SESSION["is_admin"]);
            unset($_SESSION['userID']);
            unset($_SESSION["password"]);
            unset($_SESSION['logged_out']);
            unset($_SESSION['username']);
            unset($_SESSION["useremail"]);
            session_destroy();
        }
    }
?>