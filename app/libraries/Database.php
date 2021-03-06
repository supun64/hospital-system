<?php

class Database
{

    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_name = DB_NAME;

    private $conn;
    private $result;

    private static $instance = NULL;

    private function __construct()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if (!$this->conn) {
            echo "Connection error:"  . mysqli_connect_error() . "</br>";
            die();
        } else {
            //echo "Connected to db"."<br>";
        }
    }


    public static function get_instance()
    {

        if (self::$instance == NULL) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    //execute sql command
    private function sql_execute($sql)
    {
        if ($this->result = mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            die(mysqli_error($this->conn));
        }
    }


    //return an array of the result
    private function result_set()
    {
        return mysqli_fetch_all($this->result, MYSQLI_ASSOC);
    }

    //return result with one row
    private function get_result_row()
    {
        return mysqli_fetch_assoc($this->result);
    }

    //prevent mysql injection
    private function safe($var)
    {
        return mysqli_real_escape_string($this->conn, $var);
    }

    //update method
    public function update($table, $primary_key, $param_list)
    {
        $sql = ' UPDATE `' . $table . '` SET ';
        foreach ($param_list as $key => $value) {
            if (is_int($value) || $this->safe($value) || $value == '') {
                if ($key !== $primary_key) {
                    $sql .=  $key . " = '" . $value . "',";
                }
            } else {
                die("You have been hacked:))");
            }
        }
        $sql = rtrim($sql, ',');
        if (is_int($param_list[$primary_key])) {
            $sql .= ' WHERE ' . $primary_key . ' = ' . $param_list[$primary_key];
        } else {
            $sql .= ' WHERE ' . $primary_key . " = '" . $param_list[$primary_key] . "'";
        }

        return $this->sql_execute($sql);
    }

    //insert method
    public function insert($table, $fields)
    {  //changed the if clause since safe method only takes strings
        $count = -1;
        $sql = 'INSERT INTO `' . $table . '`(';
        foreach ($fields as $key => $value) {
            $count++;
            if (is_int($value) || $this->safe($value) || $value == '') {
                $sql .=  $key . ',';
            } else {
                die("You have been hacked:))" . $count);
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= ') VALUES (';
        foreach ($fields as $key => $value) {
            $sql .= "'" . $value . "',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ')';
        return $this->sql_execute($sql);
    }

    //delete method 
    public function delete($table, $primary_key, $id)
    {
        if (is_int($id) || $this->safe($id)) {
            return $this->sql_execute('DELETE FROM `' . $table . '`WHERE ' . $primary_key . ' = ' . $id);
        } else {
            die("You have been hacked:)");
        }
    }

    //take all data from a table
    public function find_All($table)
    {
        $sql = "SELECT * FROM `" . $table . '`';
        $this->sql_execute($sql);
        return $this->result_set();
    }

    // find data from id
    public function findById($table, $primary_key, $value)
    {
        if (is_int($value) || $this->safe($value)) {
            if (is_int($value)) {
                $query = 'SELECT * FROM `' . $table . '`WHERE ' . $primary_key . ' =' . $value;
            } else {
                $query = 'SELECT * FROM `' . $table . '`WHERE ' . $primary_key . " ='" . $value . "'";
            }

            $query = $this->sql_execute($query);
            return $this->result_set();
        } else {
            die("Something went wrong");
        }
    }

    //find data form a given field
    public function find($table, $column, $value)
    {
        if (is_int($value) || $this->safe($value)) {
            $query = 'SELECT * FROM ' . $table . ' WHERE ' . $column . " = '" . $value . "'";

            $this->sql_execute($query);
            return $this->result_set();
        } else {
            die("Something went wrong");
        }
    }

    //find data by hospital id and date
    public function findByHosID_nd_Date($table, $hospital_id)
    {
        if (is_int($hospital_id) || $this->safe($hospital_id)) {
            $sql = "SELECT * FROM `" . $table . "` WHERE hospital_id = $hospital_id and date = CURDATE()";
            $this->sql_execute($sql);
            return $this->result_set();
        } else {
            die("Something went wrong");
        }
    }

    //find data by hospital id and addmission date
    public function findByHosID_nd_ADDate($table, $hospital_id)
    {
        if (is_int($hospital_id) || $this->safe($hospital_id)) {
            $sql = "SELECT * FROM `" . $table . "` WHERE hospital_id = $hospital_id and admission_date = CURDATE() or discharge_date = CURDATE() ";
            $this->sql_execute($sql);
            return $this->result_set();
        } else {
            die("Something went wrong");
        }
    }

    //find data by hospital id and user id
    public function findByHosID_nd_UserID($table, $hospital_id, $user_id)
    {
        if (is_int($hospital_id) || $this->safe($hospital_id)) {
            $sql = "SELECT * FROM `" . $table . "` WHERE hospital_id = $hospital_id and user_id = $user_id";
            $this->sql_execute($sql);
            return $this->result_set();
        } else {
            die("Something went wrong");
        }
    }

    //for observers - increment relevent field
    public function increment($table, $field)
    {
        $today = date("Y-m-d");
        $sql = "";
        if ($this->date_exist($today)) {
            $sql = "UPDATE $table SET $field=$field + 1 WHERE date='$today'";
        } else {
            $sql = "INSERT INTO $table (date,$field) VALUES ('$today',1)";
        }
        $output = $this->sql_execute($sql);
        return $output;
    }

    //for observers - decrement relevent field
    public function decrement($table, $field)
    {
        $today = date("Y-m-d");
        $sql = "";
        if ($this->date_exist($today)) {
            $sql = "UPDATE $table SET $field=$field - 1 WHERE date='$today'";
        }
        $output = $this->sql_execute($sql);
        return $output;
    }


    //for ChartLoader - load data according to a given range
    public function load_range($table, $key, $range)
    {

        $sql = "SELECT * FROM $table ORDER BY $key DESC LIMIT $range";
        $this->sql_execute($sql);
        $result = $this->result_set();
        return $result;
    }

    //for ChartLoader - to count total values (per field)
    public function count_rows($table, $column)
    {
        $sql = "SELECT SUM($column) FROM $table";
        $this->sql_execute($sql);
        $result = $this->result_set();
        return $result[0];
    }

    //---------------------------------------other
    private function date_exist($date)
    {
        $sql = "SELECT * FROM report WHERE date='$date'";
        $this->sql_execute($sql);
        $result = $this->result_set();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //transation for more than 1 sql execution
    public function transaction($methods, $param_list_1, $param_list_2)
    {

        // Turn autocommit off
        mysqli_autocommit($this->conn, FALSE);

        // Insert some values
        $this->func_switch($methods[0], $param_list_1);
        $this->func_switch($methods[1], $param_list_2);

        // Commit transaction
        if (!mysqli_commit($this->conn)) {
            echo "Commit transaction failed";
            return false;
        }

        mysqli_autocommit($this->conn, TRUE);
        return true;
    }
    //if update->
    //if add ->
    //if del->

    private function func_switch($method, $param_list)
    {

        switch ($method) {
            case "add":
                $this->insert($param_list['table'], $param_list['fields']);
                break;
            case "update":

                $this->update($param_list['table'], $param_list['primary_key'], $param_list['fields']);
                break;
            case "delete":
                $this->delete($param_list['table'], $param_list['primary_key'], $param_list['id']);
                break;
        }
    }
}
