<?php  

class Database{

    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_name = DB_NAME;

    private $conn;
    private $result;

    private static $instance = NULL;

    private function __construct()
    {
        $this->conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass, $this->db_name);

        if(!$this->conn){
            echo "Connection error:"  . mysqli_connect_error() . "</br>";
            die();
        }else{
            //echo "Connected to db"."<br>";
        }
    }


    public static function get_instance(){

        if(self::$instance == NULL){
            self::$instance = new Database();
        }
        return self::$instance;

    }

    //execute sql command
    function sql_execute($sql){
        if($this->result = mysqli_query($this->conn,$sql)){
            return true;
        }else{
            die( mysqli_error($this->conn));
        }
    }


    //return an array of the result
    function result_set(){
        return mysqli_fetch_all($this->result, MYSQLI_ASSOC);
    }

    //return result with one row
    function get_result_row(){
        return mysqli_fetch_assoc($this->result);
    }

    //prevent mysql injection
    function safe($var){
        return mysqli_real_escape_string($this->conn,$var);
    }
    
}