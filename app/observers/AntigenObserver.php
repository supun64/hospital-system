<?php  

class AntigenObserver implements ReportObserver{

    private $db;

    public function __construct()
    {
        $this->db = new DataBaseWrapper();
    }

    public function increment_count()
    {
        $this->db->increment('report','antigen');
    }
}