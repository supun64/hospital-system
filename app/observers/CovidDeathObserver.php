<?php

class CovidDeathObserver implements ReportObserver
{

    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function update_count($status)
    {
        if($status === "Died"){
            $this->db->increment('report', 'death');
        }elseif($status === "removed"){
            $this->db->decrement('report', 'death');
        }
    }
}
