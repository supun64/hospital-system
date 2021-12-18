<?php 
    class Covid_Deaths {

        private  $id;
        private  $health_id;
        private  $date;
        private  $hospital_id;
        private  $place;
        private  $comments;
    
        public function __construct( $id,  $health_id,  $date,  $hospital_id,  $place,  $comments) {
            $this->id = $id;
            $this->health_id = $health_id;
            $this->date = $date;
            $this->hospital_id = $hospital_id;
            $this->place = $place;
            $this->comments = $comments;
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
    
        public function set_health_id( $health_id) {
            $this->health_id = $health_id;
        }
    
        public function get_date() {
            return $this->date;
        }
    
        public function set_date( $date) {
            $this->date = $date;
        }
    
        public function get_hospital_id() {
            return $this->hospital_id;
        }
    
        public function set_hospital_id( $hospital_id) {
            $this->hospital_id = $hospital_id;
        }
    
        public function get_place() {
            return $this->place;
        }
    
        public function set_place( $place) {
            $this->place = $place;
        }
    
        public function get_comments() {
            return $this->comments;
        }
    
        public function set_comments( $comments) {
            $this->comments = $comments;
        }
    }    
    
?>