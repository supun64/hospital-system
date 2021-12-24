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

    public function update($table,$primary_key, $param_list)
    {
        $sql = ' UPDATE `' . $table . '` SET ';
        foreach ($param_list as $key => $value) {
            if (is_int($value) || $this->safe($value) || $value=='') {
                if ($key !== $primary_key) {
                   $sql .=  $key . " = '" . $value . "',";
                   
                }
            } else {
                die("You have been hacked:))");
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE '.$primary_key.' = ' . $param_list[$primary_key];
        return $this->sql_execute($sql);
    }

    public function insert($table,$fields){          //changed the if clause since safe method only takes strings
        $count = -1;
        $sql = 'INSERT INTO `'.$table.'`(';
        foreach ($fields as $key => $value) {
            $count++;
            if (is_int($value) || $this->safe($value) || $value=='') {
                $sql .=  $key . ',';
            } else {
                die("You have been hacked:))".$count);
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

    public function delete($table,$primary_key,$id) {
        if (is_int($id) || $this->safe($id)) {
            return $this->sql_execute('DELETE FROM `'.$table.'`WHERE '.$primary_key.' = '.$id);
        } else {
            die("You have been hacked:)");
        }
    }

    public function find_All($table){
        $sql = "SELECT * FROM `".$table.'`';
        $this->sql_execute($sql);
        return $this->result_set();
    }

    public function findById($table,$primary_key,$value) {
        if(is_int($value) || $this->safe($value)){
            $query = 'SELECT * FROM `' . $table . '`WHERE ' . $primary_key . ' ='.$value;
            $query = $this->sql_execute($query);
            return $this->result_set();
        }else{
            die("Something went wrong");
        }
    }

    public function find($table,$column, $value) {
        if(is_int($value) || $this->safe($value)){
            $query = 'SELECT * FROM ' . $table . ' WHERE ' .$column . " = '".$value."'";
            $this->sql_execute($query);
            return $this->result_set();
        }else{
            die("Something went wrong");
        }
    }

    public function findByHosID_nd_Date($table,$hospital_id) {
        if(is_int($hospital_id) || $this->safe($hospital_id)){
            $sql = "SELECT * FROM `".$table."` WHERE hospital_id = $hospital_id and date = CURDATE()";
            return $this->sql_execute($sql);
            
        }else{
            die("Something went wrong");
        }
        
    }

   public function register($hos_id){
       $sql = "UPDATE hospitals SET is_registered = 1 WHERE hospital_id = $hos_id";
       return $this->sql_execute($sql);
       
   }
    
}