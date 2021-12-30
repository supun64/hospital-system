<?php 
    class CovidPatientCenter extends COVID_Department{

        public function __construct()
        {
            parent::__construct();
        }

        public function add_record($record){
            //return $this->db->add_record("patients","id",$params);
        }

        public  function update_record($record){
            $health_id = $record->get_health_id();
            $admit_date = $record->get_admit_date();
            $conditions = $record->get_conditions();
            $discharge_date = $record->get_discharge();
            $id = $record->get_id();

            $params = [ "health_id"=>$health_id,
                        "conditions"=>$conditions,
                        "admit_date"=>$admit_date,
                        "discharge_date"=>$discharge_date,
                        "id"=>$id,];

            return $this->db->update("patients","id",$params);
        }

        public  function delete_record($id){
            return $this->db->delete("patients","id",$id);
        }

        public  function give_all_records(){
            $result_set = $this->db->findByHosID_nd_Date("patients",$this->hospital_id);

            $records = [];

            foreach ($result_set as $result) {
                $covid_patients = $this->factory->get_record("patients", $result);
                array_push($records, $covid_patients);
            }

            return $records;
        }

        public function to_array($record_obj){
            return ["id"=>$record_obj->get_id(),
                    "health_id"=>$record_obj->get_health_id(),
                    "admit_date"=>$record_obj->get_admit_date(),
                    "hospital_id"=>$record_obj->get_hospital_id(),
                    "conditions"=>$record_obj->get_conditions(),
                    "discharge_date"=>$record_obj->get_discharge_date()];
        }
    }
?>