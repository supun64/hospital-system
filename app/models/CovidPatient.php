<?php 
    class CovidPatient {

        private  $id;
        private  $health_id;
        private  $admit_date;
        private  $hospital_id;
        private  $discharge_date;
        private  $conditions;
    
        public function __construct($id, $health_id, $admit_date, $discharge_date, $conditions, $hospital_id) {
            $this->id = $id;
            $this->health_id = $health_id;
            $this->admit_date = $admit_date;
            $this->discharge_date = $discharge_date;
            $this->conditions = $conditions;
            $this->hospital_id = $hospital_id;       
        }
    
        public function get_id() {
            return $this->id;
        }
    
        public function set_id(int $id) {
            $this->id = $id;
        }
    
        public function get_health_id() {
            return $this->health_id;
        }
    
        public function set_health_id($health_id) {
            $this->health_id = $health_id;
        }
    
        public function get_admit_date() {
            return $this->admit_date;
        }
    
        public function set_admit_date($admit_date) {
            $this->admit_date = $admit_date;
        }

        public function get_discharge_date() {
            return $this->discharge_date;
        }
    
        public function set_discharge_date($discharge_date) {
            $this->discharge_date = $discharge_date;
        }
    
        public function get_hospital_id() {
            return $this->hospital_id;
        }
    
        public function set_hospital_id($hospital_id) {
            $this->hospital_id = $hospital_id;
        }
      
        public function get_conditions() {
            return $this->conditions;
        }
    
        public function set_conditions($conditions) {
            $this->conditions = $conditions;
        }
    }
