<?php
class AntigenTestsCenter extends COVID_Department implements ReportObservable
{


    private $observer;

    public function __construct()
    {
        parent::__construct();
    }

    public  function add_record($record_obj)
    {
        $data = [
            "health_id" => $record_obj->get_health_id(),
            "date" => $record_obj->get_date(),
            "status" => $record_obj->get_status(),
            "hospital_id" => $record_obj->get_hospital_id(),
            "place" => $record_obj->get_place()
        ];

        $result = $this->db->insert("antigen_tests", $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public  function update_record($record)
    {
        $status = $record->get_status();
        $place = $record->get_place();
        $id = $record->get_id();


        $params = ["status" => $status, "id" => $id, "place" => $place];

        $result = $this->db->update("antigen_tests", "id", $params);
        $previous_status = $this->db->findById("pcr_tests", "id", $id)[0]['status'];

        if ($result && ($previous_status !== $status)) {
            $this->notifyObserver($status);
        }
        return $result;
    }

    public  function delete_record($id)
    {
        return $this->db->delete("antigen_tests", "id", $id);
    }

    public  function give_all_records()
    {
        $result_set = $this->db->findByHosID_nd_Date("antigen_tests", $this->hospital_id);

        $records = [];

        foreach ($result_set as $result) {
            $antigen_test = $this->factory->get_record("antigen_tests", $result);
            array_push($records, $antigen_test);
        }

        return $records;
    }

    public function to_array($record_obj)
    {
        return [
            "id" => $record_obj->get_id(),
            "health_id" => $record_obj->get_health_id(),
            "date" => $record_obj->get_date(),
            "status" => $record_obj->get_status(),
            "hospital_id" => $record_obj->get_hospital_id(),
            "place" => $record_obj->get_place()
        ];
    }


    public function load_details_by_id($id)
    {
        $records = [];
        $result_set = $this->db->findById('antigen_tests', 'health_id', $id);
        foreach ($result_set as $result) {
            $pcr_test = $this->factory->get_record("antigen_tests", $result);
            array_push($records, $pcr_test);
        }
        return $records;
    }

    public function set_observer($observer)
    {
        if ($this->observer == NULL) {
            $this->observer = $observer;
        }
    }

    public function unset_observer()
    {
        if ($this->observer != NULL) {
            $this->observer = NUll;
        }
    }

    public function notifyObserver($status)
    {
        $this->observer->increment_count($status);
    }
}
