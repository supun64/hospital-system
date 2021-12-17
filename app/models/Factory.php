<?php  


abstract class Factory{

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public abstract function get_product($id);

}