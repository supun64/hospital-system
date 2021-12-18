<?php 
    class Pcr_test {

        private  $id;
        private  $health_id;
        private  $hospital_id;
        private  $date;
        private  $status;
    
        public function __construct( $id,  $health_id,  $hospital_id,  $date,  $status) {
            $this->id = $id;
            $this->health_id = $health_id;
            $this->hospital_id = $hospital_id;
            $this->date = $date;
            $this->status = $status;
        }
    
        public function get_id() {
            return $this->id;
        }
    
        public function get_health_id() {
            return $this->health_id;
        }
    
        public function get_hospital_id() {
            return $this->hospital_id;
        }
    
        public function get_date() {
            return $this->date;
        }
    
        public function get_status() {
            return $this->status;
        }
    
        public function set_id( $id) {
            $this->$id = $id;
        }
    
        public function set_health_id( $health_id) {
            $this->$health_id = $health_id;
        }
    
        public function set_hospital_id( $hospital_id) {
            $this->$hospital_id = $hospital_id;
        }
    
        public function set_date( $date) {
            $this->$date = $date;
        }
    
        public function set_status( $status) {
            $this->$status = $status;
        }
    }
?>