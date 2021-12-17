<?php 

class Citizen{

    private $id;
    private $name;
    private $dob;
    private $gender;
    private $province;
    private $district;
    private $con_num;
    private $email;

    public function __construct($id, $name, $dob,$gender,$province,$district,$con_num,$email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dob = $dob;
        $this->gender= $gender;
        $this->province = $province;
        $this->district = $district;
        $this->con_num  = $con_num;
        $this->email = $email;
    }

    public function get_id(){
        return $this->id;
    }

    public function get_name(){
        return $this->name;
    }

    public function get_dob(){
        return $this->dob;
    }

    public function get_gender(){
        return $this->gender;
    }

    public function get_province(){
        return $this->province;
    }

    public function get_district(){
        return $this->ditrict;
    }

    public function con_num(){
        return $this->con_num;
    }

    public function get_email(){
        return $this->email;
    }





}



