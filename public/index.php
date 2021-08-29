<?php  

require_once '../app/require.php';

// rename the folder to -> hosptal-system
// path should be htdocs->hospital-system

// url -> localhost/hospital-system -> first page should appear
//url ->  localhost/hospital-system/users/login   ->login page
//url -> localhost/hospital-system/pages   -> dashboard
//url -> localhost/hospital-system/pages/pcr  ->pcr


//your phpmyAdmin configs should be edited | app->config->config.php | under Databse detials

// includes should be added to all the files in views->pages, views->users before editting
//      ex: (inside php tag)
//          require APP_ROOT.'/views/includes/header.php'; */
