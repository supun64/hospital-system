<?php


class Administrator
{


    public function __construct()
    {
        $this->db = new Database();
        $this->hospital_id = 1; //this should be changed -> id should be gained through constructor (using session)    
        $this->user_id = 1;
    }

    //----------------------------User Management--------------------------------

    //function to load all the deos
    public function load_deo()
    {


        $sql = "SELECT * FROM users WHERE hospital_id = $this->hospital_id";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set();
        return $data;
    }


    //function to check whether an existing username
    public function username_exist($username)
    {

        $username = $this->db->safe($username);
        $sql = "SELECT * FROM users WHERE user_name = '$username'";
        $this->db->sql_execute($sql);
        $data = $this->db->result_set();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }


    //function to add new deo
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

    //delete existing deo

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


    //getter for hospital_id
    public function get_hospital_id()
    {
        return $this->hospital_id;
    }


    //----------------------------Data Management-----------------------------------------------------

    //load all the records edited or inserted today in the selected record type
    public function load_by_type($record_type)
    {
        $sql = "SELECT * FROM `$record_type` WHERE hospital_id = $this->hospital_id and date = CURDATE()";
        $this->db->sql_execute($sql);
        return $this->db->result_set();
    }

    //delete the selected record
    public function delete_by_id($record_type, $id)
    {
        if ($this->db->safe($id)) {
            return $this->db->sql_execute("DELETE FROM  `$record_type` WHERE id = $id");
        } else {
            die("You have been hacked:)");
        }
    }

    //update a record in a table.
    public function update_record($record_type, $param_list)
    {
        $sql = ' UPDATE `' . $record_type . '` SET ';
        foreach ($param_list as $key => $value) {
            if ($this->db->safe($value)) {
                if ($key !== 'id') {
                    $sql .=  $key . " = '" . $value . "',";
                }
            } else {
                die("You have been hacked:))");
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE id  = ' . $param_list['id'];
        return $this->db->sql_execute($sql);
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
        var_dump($param_list);
        $errors = "";

        if ($this->db->safe($param_list['old_password']) && $this->db->safe($param_list['new_password']) && $this->db->safe($param_list['confirm_password'])) {
            if ($param_list['new_password'] === $param_list['confirm_password']) {
                if ($param_list['new_password'] !== $param_list['old_password']) {
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
                    $errors = "Your new password can not be same as your recent passwords.";
                }
            } else {
                $errors = "Please make sure your passwords match.";
            }
            $_POST['passwords'] = [];
        } else {
            die("You have been hacked:))");
        }

        return $errors;
    }
}
