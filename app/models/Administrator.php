<?php 


class Administrator{


public function __construct()
{
    $this->db = new Database();
    $this->hospital_id = 1;           //this should be changed -> id should be gained through constructor (using session)
}

//function to load all the deos
public function load_deo(){

  
    $sql = "SELECT * FROM users WHERE hospital_id = $this->hospital_id";
    $this->db->sql_execute($sql);
    $data = $this->db->result_set();
    return $data;
}

//function to check whether an existing username
public function username_exist($username){
    $sql = "SELECT * FROM users WHERE user_name = '$username'";
    $this->db->sql_execute($sql);
    $data = $this->db->result_set();
    if($data){
        return true;
    }else{
        return false;
    }
}


//function to add new deo
public function add_deo($deo){

    $username = $deo['username'];
    $email = $deo['email'];
    $password = $deo['password'];
    $hos_id = $deo['hospital_id'];

    $sql = "INSERT INTO users (user_name, user_email, password, hospital_id) VALUES ('$username','$email','$password',$hos_id)";
    $result = $this->db->sql_execute($sql);

    if($result){
        return true;
    }else{
        return false;
    }


}

//getter for hospital_id
public function get_hospital_id(){
    return $this->hospital_id;
}



}