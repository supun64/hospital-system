<?php

interface ReportObservable
{

    public function set_observer($observer);
    public function unset_observer();
    public function notifyObserver($status);
}
