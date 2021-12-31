<?php  

require_once 'libraries/Controller.php';
require_once 'libraries/Core.php';
require_once 'libraries/Database.php';
require_once 'libraries/DatabaseWrapper.php';
require_once 'libraries/class.phpmailer.php';
require_once 'libraries/class.smtp.php';
require_once 'libraries/MailerWrapper.php';
require_once 'config/config.php';

require_once 'objects/Citizen.php';
require_once 'objects/Covid_Death.php';
require_once 'objects/Hospital.php';
require_once 'objects/Pcr_test.php';
require_once 'objects/User.php';
require_once 'objects/Vaccination.php';
require_once 'objects/Antigen_Test.php';
require_once 'objects/CovidPatient.php';

require_once 'factories/Factory.php';
require_once 'factories/CitizenFactory.php';
require_once 'factories/RecordFactory.php';
require_once 'factories/CentersFactory.php';

require_once 'centers/COVID_Department.php';
require_once 'centers/PcrTestsCenter.php';
require_once 'centers/CovidDeathsCenter.php';
require_once 'centers/AntigenTestsCenter.php';
require_once 'centers/VaccinationCenter.php';
require_once 'centers/CovidPatientCenter.php';

require_once 'observers/ReportObserver.php';
require_once 'observers/PcrObserver.php';
require_once 'observers/AntigenObserver.php';
require_once 'observers/CovidDeathObserver.php';




$init = new Core();