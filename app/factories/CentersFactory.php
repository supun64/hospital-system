<?php
class CentersFactory
{
    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
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

            case 'covid_patients':
                return new CovidPatientCenter();
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
