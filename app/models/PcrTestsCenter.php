<?php 
    class PcrTestsCenter extends COVID_Department{

        public function __construct()
        {
            parent::__construct();
        }

        public  function add_record($record_obj){
            $data = ["health_id"=>$record_obj->get_health_id(),
            "hospital_id"=>$record_obj->get_hospital_id(),
            "date"=>$record_obj->get_date(),
            "status"=>$record_obj->get_status(),
            "place"=>$record_obj->get_place()];
         
            $result = $this->db->insert("pcr_tests",$data);
        
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public  function update_record($record){
            $status = $record->get_status();
            $place = $record->get_place();
            $id = $record->get_id();
            
            $params = ["status"=>$status , "id"=>$id, "place"=>$place];

            return $this->db->update("pcr_tests","id",$params);
        }

        public  function delete_record($id){
            return $this->db->delete("pcr_tests","id",$id);
        }


        public  function give_all_records(){
            $result_set = $this->db->findByHosID_nd_Date("pcr_tests",$this->hospital_id);

            $records = [];
            foreach ($result_set as $result) {
                $pcr_tests = $this->factory->get_record("pcr_tests", $result);
                array_push($records, $pcr_tests);
            }
            
            return $records;
        }

        public function to_array($record_obj){
            return ["id"=>$record_obj->get_id(),
                    "health_id"=>$record_obj->get_health_id(),
                    "hospital_id"=>$record_obj->get_hospital_id(),
                    "date"=>$record_obj->get_date(),
                    "status"=>$record_obj->get_status(),
                    "place"=> $record_obj->get_place()];
        }

        public function load_details_by_id($id){
            $records = [];
            $result_set = $this->db->findById('pcr_tests','health_id',$id);
            foreach ($result_set as $result) {
                $pcr_test = $this->factory->get_record("pcr_tests", $result);
                array_push($records, $pcr_test);
            }
            return $records;
        }


    }
?>