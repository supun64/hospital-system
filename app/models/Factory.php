<?php  


abstract class Factory{

    protected $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public abstract function get_product($id);

}