<?php

class CovidDeathObserver implements ReportObserver
{

    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function increment_count($status)
    {
        $this->db->increment('report', 'death');
    }
}
