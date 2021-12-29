<?php 
    class CovidDeathsCenter extends COVID_Department{

        public function __construct()
        {
            parent::__construct();
        }

        public  function add_record($record){}

        public  function update_record($record){
            $place = $record->get_place();
            $comments = $record->get_comments();
            $id = $record->get_id();

            $params = [ "place"=>$place,
                        "comments"=>$comments,
                        "id"=>$id];

            return $this->db->update("covid_deaths","id",$params);
        }

        public  function delete_record($id){
            return $this->db->delete("covid_deaths","id",$id);
        }

        public  function give_all_records(){
            $result_set = $this->db->findByHosID_nd_Date("covid_deaths",$this->hospital_id);

            $records = [];

            foreach ($result_set as $result) {
                $covid_death = $this->factory->get_record("covid_deaths", $result);
                array_push($records, $covid_death);
            }

            return $records;
        }

        public function to_array($record_obj){
            return ["id"=>$record_obj->get_id(),
                    "health_id"=>$record_obj->get_health_id(),
                    "date"=>$record_obj->get_date(),
                    "hospital_id"=>$record_obj->get_hospital_id(),
                    "place"=>$record_obj->get_place(),
                    "comments"=>$record_obj->get_comments()];
        }
    }
?>