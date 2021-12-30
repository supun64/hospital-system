<?php 
    class CovidPatient {

        private  $admission_id;
        private  $health_id;
        private  $admission_date;
        private  $hospital_id;
        private  $discharge_date;
        private  $conditions;
    
        public function __construct($admission_id, $health_id, $admission_date, $discharge_date, $conditions, $hospital_id) {
            $this->admission_id = $admission_id;
            $this->health_id = $health_id;
            $this->admission_date = $admission_date;
            $this->discharge_date = $discharge_date;
            $this->conditions = $conditions;
            $this->hospital_id = $hospital_id;       
        }
    
        public function get_admission_id() {
            return $this->admission_id;
        }
    
        public function set_admission_id(int $admission_id) {
            $this->admission_id = $admission_id;
        }
    
        public function get_health_id() {
            return $this->health_id;
        }
    
        public function set_health_id($health_id) {
            $this->health_id = $health_id;
        }
    
        public function get_admission_date() {
            return $this->admission_date;
        }
    
        public function set_admission_date($admission_date) {
            $this->admission_date = $admission_date;
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
