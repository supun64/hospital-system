<?php
class CovidPatientCenter extends COVID_Department
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_record($record)
    {
        $data = [
            "admission_id" => $record->get_admission_id(),
            "health_id" => $record->get_health_id(),
            "admission_date" => $record->get_admission_date(),
            "hospital_id" => $record->get_hospital_id(),
            "conditions" => $record->get_conditions(),
            "discharge_date" => $record->get_discharge_date()
        ]; //"hospital_name" => $this->get_hospital_name_by_id($record->get_hospital_id()),

        $result = $this->db->insert("patients", $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public  function update_record($record)
    {
        $health_id = $record->get_health_id();
        $admission_date = $record->get_admission_date();
        $conditions = $record->get_conditions();
        $discharge_date = $record->get_discharge_date();
        $admission_id = $record->get_admission_id();

        $params = [
            "health_id" => $health_id,
            "conditions" => $conditions,
            "admission_date" => $admission_date,
            "discharge_date" => $discharge_date,
            "admission_id" => $admission_id,
        ];

        return $this->db->update("patients", "admission_id", $params);
    }

    public  function delete_record($admission_id)
    {
        return $this->db->delete("patients", "admission_id", $admission_id);
    }

    public  function give_all_records()
    {
        $result_set = $this->db->findByHosID_nd_Date("patients", $this->hospital_id);

        $records = [];

        foreach ($result_set as $result) {
            $covid_patients = $this->factory->get_record("patients", $result);
            array_push($records, $covid_patients);
        }

        return $records;
    }

    public function to_array($record_obj)
    {
        return [
            "admission_id" => $record_obj->get_admission_id(),
            "health_id" => $record_obj->get_health_id(),
            "admission_date" => $record_obj->get_admission_date(),
            "hospital_id" => $record_obj->get_hospital_id(),
            "hospital_name" => $this->get_hospital_name_by_id($record_obj->get_hospital_id()),
            "conditions" => $record_obj->get_conditions(),
            "discharge_date" => $record_obj->get_discharge_date()
        ];
    }

    public function load_details_by_id($admission_id)
    {
        $records = [];
        $result_set = $this->db->findById('patients', 'health_id', $admission_id);
        foreach ($result_set as $result) {
            $admission = $this->factory->get_record('covid_patient', $result);
            array_push($records, $admission);
        }
        return $records;
    }

    public function get_hospital_name_by_id($hospital_id)
    {
        $result = $this->db->findById('hospitals', 'hospital_id', $hospital_id);
        return $result[0];
    }
}