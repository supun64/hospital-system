<?php

class PcrObserver implements ReportObserver
{

    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function update_count($status)
    {
        if ($status == "positive") {
            $this->db->increment('report', 'pcr');
        } elseif ($status == "to_negative") {
            $this->db->decrement('report', 'pcr');
        } elseif ($status === "removed") {
            $this->db->decrement('report', 'pcr');
        }
    }
}
