<?php

interface ReportObserver
{



    // observer pattern ???

    //make COVID_DEPARTMENT observable - serveral observers for various departments
    //make Reporter observer 
    //once a department does an update/add/delete it should notify the observer
    // then reporter will update the database


    public function update_count($status);
}
