<?php 
    class DataBaseWrapper{

        private $db;

        public function __construct()
        {
            $this->db = Database::get_instance();
        }

        public function update($table,$primary_key, $param_list){
            return $this->db->update($table,$primary_key, $param_list);
        }

        public function insert($table,$fields){
            return $this->db->insert($table,$fields);
        }

        public function delete($table,$primary_key,$id){
            return $this->db->delete($table,$primary_key,$id);
        }

        public function find_All($table){
            return $this->db->find_All($table);
        }

        public function findById($table,$primary_key,$value){
            return $this->db->findById($table,$primary_key,$value);
        }

        public function find($table,$column, $value){
            return $this->db->find($table,$column, $value);
        }

        public function findByHosID_nd_Date($table,$hospital_id){
            return $this->db->findByHosID_nd_Date($table,$hospital_id);
        }

        function safe($var){
            return $this->db->safe($var);
        }

        public function register($hos_id){
           return $this->db->register($hos_id);
           
        }
    }
?>