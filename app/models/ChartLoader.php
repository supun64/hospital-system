<?php  


class ChartLoader{

private $db;

public function __construct()
{
    $this->db = new DataBaseWrapper();
}

public function load_monthly_result(){
    $result = $this->db->give_monthly_result();
    return $result;
}







}