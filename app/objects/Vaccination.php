<?php 
    class Vaccination {

        private  $id;
        private $batch_num;
        private  $health_id;
        private  $date;
        private  $dose;
        private  $vaccine_name;
        private  $hospital_id;
        private  $vaccinated_place;
        private  $comments;
    
        public function __construct( $id, $batch_num,  $health_id,  $date,  $dose,  $vaccine_name,  $hospital_id,  $vaccinated_place,  $comments) {
            $this->id = $id;
            $this->batch_num = $batch_num;
            $this->health_id = $health_id;
            $this->date = $date;
            $this->dose = $dose;
            $this->vaccine_name = $vaccine_name;
            $this->hospital_id = $hospital_id;
            $this->vaccinated_place = $vaccinated_place;
            $this->comments = $comments;
        }
    
        public function get_id() {
            return $this->id;
        }

        public function get_batch_num() {
            return $this->batch_num;
        }
    
        public function get_health_id() {
            return $this->health_id;
        }
    
        public function get_date() {
            return $this->date;
        }
    
        public function get_dose() {
            return $this->dose;
        }
    
        public function get_vaccine_name() {
            return $this->vaccine_name;
        }
    
        public function get_hospital_id() {
            return $this->hospital_id;
        }
    
        public function get_vaccinated_place() {
            return $this->vaccinated_place;
        }
    
        public function get_comments() {
            return $this->comments;
        }
    
        public function set_id( $id) {
            $this->id = $id;
        }

        public function set_batch( $batch_num) {
            $this->batch_num = $batch_num;
        }
    
        public function set_health_id( $health_id) {
            $this->health_id = $health_id;
        }
    
        public function set_date( $date) {
            $this->date = $date;
        }
    
        public function set_dose( $dose) {
            $this->dose = $dose;
        }
    
        public function set_vaccine_name( $vaccine_name) {
            $this->vaccine_name = $vaccine_name;
        }
    
        public function set_hospital_id( $hospital_id) {
            $this->hospital_id = $hospital_id;
        }
    
        public function set_vaccinated_place( $vaccinated_place) {
            $this->vaccinated_place = $vaccinated_place;
        }
    
        public function set_comments( $comments) {
            $this->comments = $comments;
        }
    }
    
?>