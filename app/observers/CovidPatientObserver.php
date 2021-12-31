<?php

class CovidPatientObserver implements ReportObserver
{

    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function increment_count($status)
    {
        if ($status == "Admitted") {
            $this->db->increment('report', 'addmit');
        } elseif ($status == "Discharged") {
            $this->db->increment('report', 'discharge');
        }
    }
}
