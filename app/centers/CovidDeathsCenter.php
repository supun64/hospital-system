<?php
class CovidDeathsCenter extends COVID_Department implements ReportObservable
{
    private $observer;

    public function __construct()
    {
        parent::__construct();
    }

    public  function add_record($record)
    {
        $param_list_1 = [
            "health_id" => $record->get_health_id(),
            "hospital_id" => $record->get_hospital_id(),
            "date" => $record->get_date(),
            "place" => $record->get_place(),
            "comments" => $record->get_comments(),
        ];

        $param_list_2 = ["is_alive" => 0, "health_id" => $record->get_health_id()];

        $result = $this->db->transaction(
            ["add", "update"],
            ["table" => "covid_deaths", "fields" => $param_list_1],
            ["table" => "citizens", "primary_key" => "health_id", "fields" => $param_list_2]
        );

        if ($result) {
            $this->notifyObserver("Died");
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
        $health_id = $this->db->findById("covid_deaths", "id", $id)[0]['health_id'];
        $param_list = ["is_alive" => 1, "health_id" => $health_id];
        if ($this->db->transaction(
            ["delete", "update"],
            ["table" => "covid_deaths", "primary_key" => "id", "id" => $id],
            ["table" => "citizens", "primary_key" => "health_id", "fields" => $param_list]
        )) {
            $this->notifyObserver("removed");
            return true;
        } else
            false;
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

    public function notifyObserver($status)
    {
        $this->observer->update_count($status);
    }
}
