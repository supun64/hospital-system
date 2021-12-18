<?php 
    abstract class COVID_Department{

        protected  $db;
        protected  $hospital_id;
        protected  $factory;  

        public function __construct()
        {
            $this->db = new DataBaseWrapper();
            $this->hospital_id = $_SESSION['hospital_id'];
            $this->factory = new RecordFactory();
        }

        public abstract function add_record($record);

        public abstract function update_record($record);

        public abstract function delete_record($id);

        public abstract function give_all_records();

        public abstract function to_array($record_obj);
    }
?>