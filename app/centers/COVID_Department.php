<?php
abstract class COVID_Department
{

    protected  $db;
    protected  $hospital_id;
    protected  $factory;
    protected $citizen_factory;

    public function __construct()
    {
        $this->db = Database::get_instance();
        $this->hospital_id = $_SESSION['hospital_id'];
        $this->factory = Factory::getFactory("RecordFactory");
        $this->citizen_factory = Factory::getFactory("CitizenFactory");
    }

    public abstract function add_record($record);

    public abstract function update_record($record);

    public abstract function delete_record($id);

    public abstract function give_all_records();

    public abstract function to_array($record_obj);

    public function get_citizen($id)
    {
        return $this->citizen_factory->get_product($id);
    }


    public function get_hospital_id()
    {
        return $this->hospital_id;
    }
}
