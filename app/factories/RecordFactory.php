<?php
class RecordFactory
{
    private $db;

    public function __construct()
    {
        $this->db = Database::get_instance();
    }

    public function get_record($recordType, $records)
    {

        if (!isset($records['date'])) $records['date'] = "";
        if (!isset($records['hospital_id'])) $records['hospital_id'] = "";
        if (!isset($records['health_id'])) $records['health_id'] = "";

        switch ($recordType) {
            case 'antigen_tests':
                return new Antigen_test(
                    $records['id'],
                    $records['health_id'],
                    $records['date'],
                    $records['status'],
                    $records['hospital_id'],
                    $records['place']
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
                    $records['status'],
                    $records['place']
                );
                break;

            case 'vaccinations':
                return new Vaccination(
                    $records['id'],
                    $records['batch_num'],
                    $records['health_id'],
                    $records['date'],
                    $records['dose'],
                    $records['vaccine_name'],
                    $records['hospital_id'],
                    $records['vaccinated_place'],
                    $records['comments']
                );
                break;

            case 'covid_patients':
                return new CovidPatient(
                    $records['admission_id'],
                    $records['health_id'],
                    $records['admission_date'],
                    $records['discharge_date'],
                    $records['status'],
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
