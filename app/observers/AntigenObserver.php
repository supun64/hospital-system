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
        } elseif ($status == "to_negative") {
            $this->db->decrement('report', 'antigen');
        } elseif ($status === "removed") {
            $this->db->decrement('report', 'antigen');
        }
    }
}
