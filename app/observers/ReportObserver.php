<?php

interface ReportObserver
{



    // observer pattern ???

    //make COVID_DEPARTMENT observable - only one observer or serveral observers for various departments ????
    //make Reporter observer 
    //once a department does an update/add it should notify the observer
    // then reporter will update the database


    public function increment_count($status);
}
