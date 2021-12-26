<?php
class CentersFactory
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBaseWrapper();
    }

    public function get_center($type)
    {

        switch ($type) {

            case 'antigen_tests':
                return new AntigenTestsCenter();
                break;

            case 'pcr_tests':
                return new PcrTestsCenter();
                break;

            case 'covid_deaths':
                return new CovidDeathsCenter();
                break;

            case 'vaccinations':
                return new VaccinationCenter();
                break;

            default:
                return null;
                break;
        }
    }
}
