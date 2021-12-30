<?php  

require_once 'libraries/Controller.php';
require_once 'libraries/Core.php';
require_once 'libraries/Database.php';
require_once 'libraries/DatabaseWrapper.php';
require_once 'config/config.php';

require_once 'models/Citizen.php';
require_once 'models/Covid_Death.php';
require_once 'models/Hospital.php';
require_once 'models/Pcr_test.php';
require_once 'models/User.php';
require_once 'models/Vaccination.php';
require_once 'models/Antigen_Test.php';

require_once 'models/Factory.php';
require_once 'models/CitizenFactory.php';
require_once 'models/RecordFactory.php';
require_once 'models/CentersFactory.php';
require_once 'models/SearchRecord.php';
require_once 'models/COVID_Department.php';
require_once 'models/PcrTestsCenter.php';
require_once 'models/CovidDeathsCenter.php';
require_once 'models/AntigenTestsCenter.php';
require_once 'models/VaccinationCenter.php';

require_once 'models/UserHandler.php';


$init = new Core();