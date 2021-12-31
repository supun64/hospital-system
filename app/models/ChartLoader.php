<?php  


class ChartLoader{

private $db;

public function __construct()
{
    $this->db = new DataBaseWrapper();
}

public function load_last_thirty(){
    $result = $this->db->load_range('report','date',30);
    $result = array_reverse($result);
    return $result;
}

public function load_total(){
    $admit = (int)$this->db->count_rows('report','addmit')['SUM(addmit)'];
    $death = (int)$this->db->count_rows('report','death')['SUM(death)'];
    $recover = (int)$this->db->count_rows('report','discharge')['SUM(discharge)'];
    $result = ['new'=>$admit, 'death'=>$death, 'recover'=>$recover];
    return $result;
}
 

}