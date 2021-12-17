<?php 

class SearchRecord{

    private $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function get_records(){
        return $this->records;
    }


}