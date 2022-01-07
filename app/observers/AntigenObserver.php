<?php

class AntigenObserver implements ReportObserver
{

    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function update_count($status)
    {
        if ($status == "positive") {
            $this->db->increment('report', 'antigen');
        }
    }
}
