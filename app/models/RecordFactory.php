<?php
class RecordFactory extends Factory
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_product($id)
    {
    }

    public function get_record($recordtype, $records)
    {

        if (!isset($records['date'])) $records['date'] = "";
        if (!isset($records['hospital_id'])) $records['hospital_id'] = "";
        if (!isset($records['health_id'])) $records['health_id'] = "";


        switch ($recordtype) {
            case 'antigen_tests':
                return new Antigen_test(
                    $records['id'],
                    $records['health_id'],
                    $records['date'],
                    $records['status'],
                    $records['hospital_id']
                );
                break;

            case 'covid_deaths':
                return new Covid_Deaths(
                    $records['id'],
                    $records['health_id'],
                    $records['date'],
                    $records['hospital_id'],
                    $records['place'],
                    $records['comments']
                );
                break;

            case 'pcr_tests':
                return new Pcr_test(
                    $records['id'],
                    $records['health_id'],
                    $records['hospital_id'],
                    $records['date'],
                    $records['status']
                );
                break;

            case 'vaccinations':
                return new Vaccination(
                    $records['id'],
                    $records['health_id'],
                    $records['date'],
                    $records['dose'],
                    $records['vaccine_name'],
                    $records['hospital_id'],
                    $records['vaccinated_place'],
                    $records['comments']
                );
                break;

            case 'covid_patient':
                return new CovidPatient(
                    $records['id'],
                    $records['health_id'],
                    $records['admit_date'],
                    $records['discharge_date'],
                    $records['conditions'],
                    $records['hospital_id']
                );

                break;

            default:
                return null;
                break;
        }
    }
}
