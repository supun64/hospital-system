<?php 
    class DataBaseWrapper{

        private $db;

        public function __construct()
        {
            $this->db = Database::get_instance();
        }

        public function update($table,$primary_key, $param_list)
        {
            $sql = ' UPDATE `' . $table . '` SET ';
            foreach ($param_list as $key => $value) {
                if (is_int($value) || $this->db->safe($value) || $value=='') {
                    if ($key !== $primary_key) {
                    $sql .=  $key . " = '" . $value . "',";
                    
                    }
                } else {
                    die("You have been hacked:))");
                }
            }
            $sql = rtrim($sql, ',');
            $sql .= ' WHERE '.$primary_key.' = ' . $param_list[$primary_key];
            return $this->db->sql_execute($sql);
        }

        public function insert($table,$fields){          //changed the if clause since safe method only takes strings
            $count = -1;
            $sql = 'INSERT INTO `'.$table.'`(';
            foreach ($fields as $key => $value) {
                $count++;
                if (is_int($value) || $this->db->safe($value) || $value=='') {
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
            
            return $this->db->sql_execute($sql);
        }

        public function delete($table,$primary_key,$id) {
            if (is_int($id) || $this->db->safe($id)) {
                return $this->db->sql_execute('DELETE FROM `'.$table.'`WHERE '.$primary_key.' = '.$id);
            } else {
                die("You have been hacked:)");
            }
        }

        public function find_All($table){
            $sql = "SELECT * FROM `".$table.'`';
            $this->db->sql_execute($sql);
            return $this->db->result_set();
        }

        public function findById($table,$primary_key,$value) {
            if(is_int($value) || $this->db->safe($value)){
                $query = 'SELECT * FROM `' . $table . '`WHERE ' . $primary_key . ' ='.$value;
                $query = $this->db->sql_execute($query);
                return $this->db->result_set();
            }else{
                die("Something went wrong");
            }
        }

        public function find($table,$column, $value) {
            if(is_int($value) || $this->db->safe($value)){
                $query = 'SELECT * FROM ' . $table . ' WHERE ' .$column . " = '".$value."'";
                $this->db->sql_execute($query);
                return $this->db->result_set();
            }else{
                die("Something went wrong");
            }
        }

        public function findByHosID_nd_Date($table,$hospital_id) {
            if(is_int($hospital_id) || $this->db->safe($hospital_id)){
                $sql = "SELECT * FROM `".$table."` WHERE hospital_id = $hospital_id and date = CURDATE()";
                $this->db->sql_execute($sql);
                return $this->db->result_set();
                
            }else{
                die("Something went wrong");
            }
        }

        public function findByHosID_nd_UserID($table,$hospital_id,$user_id){
            if(is_int($hospital_id) || $this->db->safe($hospital_id)){
                $sql = "SELECT * FROM `".$table."` WHERE hospital_id = $hospital_id and user_id = $user_id";
                $this->db->sql_execute($sql);
                return $this->db->result_set();
                
            }else{
                die("Something went wrong");
            }
        }

        public function register($hos_id){
            $sql = "UPDATE hospitals SET is_registered = 1 WHERE hospital_id = $hos_id";
            return $this->db->sql_execute($sql);
        }

        function safe($value){
            return $this->db->safe($value);
        }
}
?>