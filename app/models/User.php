<?php 
    class User {

        private  $user_id;
        private  $user_name;
        private  $password;
        private  $hospital_id;
        private  $user_email;
        private  $is_admin;
    
        public function __construct( $user_id,  $user_name,  $password,  $hospital_id,  $user_email,  $is_admin) {
            $this->user_id = $user_id;
            $this->user_name = $user_name;
            $this->password = $password;
            $this->hospital_id = $hospital_id;
            $this->user_email = $user_email;
            $this->is_admin = $is_admin;
        }
    
        public function get_user_id() {
            return $this->user_id;
        }
    
        public function set_user_id( $user_id) {
            $this->user_id = $user_id;
        }
    
        public function get_user_name() {
            return $this->user_name;
        }
    
        public function set_user_name( $user_name) {
            $this->user_name = $user_name;
        }
    
        public function get_password() {
            return $this->password;
        }
    
        public function set_password( $password) {
            $this->password = $password;
        }
    
        public function get_hospital_id() {
            return $this->hospital_id;
        }
    
        public function set_hospital_id( $hospital_id) {
            $this->hospital_id = $hospital_id;
        }
    
        public function get_user_email() {
            return $this->user_email;
        }
    
        public function set_user_email( $user_email) {
            $this->user_email = $user_email;
        }
    
        public function get_is_admin() {
            return $this->is_admin;
        }
    
        public function set_is_admin( $is_admin) {
            $this->is_admin = $is_admin;
        }
    }
    
?>