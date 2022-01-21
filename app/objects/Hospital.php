<?php

class Hospital{

    private $hospital_id;
    private $name;
    private $district;
    private $email;
    private $contact_num;
    private $is_registered;

    public function __construct($hospital_id, $name, $district, $email, $contact_num, $is_registered)
    {
        $this->hospital_id = $hospital_id;
        $this->name = $name;
        $this->district = $district;
        $this->email = $email;
        $this->contact_num = $contact_num;
        $this->is_registered = $is_registered;
    }

    public function get_hospital_id($hospital_id)
    {
        return $this->hospital_id;
    }

    public function get_name($name)
    {
        return $this->name;
    }

    public function get_district($district)
    {
        return $this->district;
    }
    
    public function get_email($email)
    {
        return $this->email;
    }

    public function get_contact_num($contact_num)
    {
        return $this->contact_num;
    }

    public function get_is_registered($hospital_id)
    {
        return $this->is_registered;
    }
}