<?php  

class Pages extends Controller{

    public function __construct()
    {
        
    }

    public function user_index(){
        $this->view('/pages/user_dashboard');
    }

    public function admin_index(){
        $this->view('/pages/admin_dashboard');
    }

    public function antigen(){
        $this->view('/pages/antigen');
    }

    public function covid_deaths(){
        $this->view('/pages/covid_deaths');
    }
    
    public function covid_patients(){
        $this->view('/pages/covid_patients');
    }

    public function pcr(){
        $this->view('/pages/pcr');
    }

    public function vaccination(){
        $this->view('/pages/vaccination');
    }

}