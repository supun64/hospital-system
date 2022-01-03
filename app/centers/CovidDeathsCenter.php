<?php
class CovidDeathsCenter extends COVID_Department
{
    private $observer;

    public function __construct()
    {
        parent::__construct();
    }

    public  function add_record($record)
    {
        $data_1 = [
            "health_id" => $record[0]->get_health_id(),
            "hospital_id" => $record[0]->get_hospital_id(),
            "date" => $record[0]->get_date(),
            "place" => $record[0]->get_place(),
            "comments" => $record[0]->get_comments(),
        ];

        $data_2 = 
        //$result = $this->db->insert("covid_deaths", $data);
        //$result = $this->db->transaction(["add","update"],["table"=>"covid_deaths","fields"=>$data],["table"=>"covid_deaths","fields"]);

        if ($result) {
            $this->notifyObserver("died");
            return true;
        } else {
            return false;
        }
    }

    public  function update_record($record)
    {
        $place = $record->get_place();
        $comments = $record->get_comments();
        $id = $record->get_id();

        $params = [
            "place" => $place,
            "comments" => $comments,
            "id" => $id
        ];

        return $this->db->update("covid_deaths", "id", $params);
    }

    public  function delete_record($id)
    {
        //$this->update_citizen_liveliness($id);
        return $this->db->delete("covid_deaths", "id", $id);
    }

    public  function give_all_records()
    {
        $result_set = $this->db->findByHosID_nd_Date("covid_deaths", $this->hospital_id);

        $records = [];

        foreach ($result_set as $result) {
            $covid_death = $this->factory->get_record("covid_deaths", $result);
            array_push($records, $covid_death);
        }

        return $records;
    }

    public  function give_record($id)
    {
        $result_set = $this->db->findById("covid_deaths", "id", $id);
        return $result_set;
    }

    public function isexist_user_id($health_id)
    {
        return $this->db->find('covid_deaths', 'health_id', $health_id) ? true : false;
    }
    
    public function to_array($record_obj)
    {
        return [
            "id" => $record_obj->get_id(),
            "health_id" => $record_obj->get_health_id(),
            "date" => $record_obj->get_date(),
            "hospital_id" => $record_obj->get_hospital_id(),
            "place" => $record_obj->get_place(),
            "comments" => $record_obj->get_comments()
        ];
    }

    public function load_details_by_id($id)
    {
        $result_set = $this->db->findById('covid_deaths', 'health_id', $id);
        if ($result_set == NULL)
            return NULL;
        else
            $result_set = $result_set[0];
        $covid_death = $this->factory->get_record("covid_deaths", $result_set);
        return $covid_death;
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

    private function notifyObserver($status)
    {
        $this->observer->increment_count($status);
    }
}
