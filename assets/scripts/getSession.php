<?php

$openaccess =1;
			//$requiredUserLevel = 4;
			require ('../../assets/includes/config.inc.php');		
			
			require (BASE_URI.'/assets/scripts/headerScript.php');

            $general = new general;
            $programme = new programme;
            $programmeOrder = new programmeOrder;
            $session = new session;
            $queries = new queries;
            $sessionView = new sessionView;

             //$print_r()

             $table = 'session';

             eval('$esdLesion = new ' . $table . ';');

             $data = json_decode(file_get_contents('php://input'), true);

             //print_r($data);
 
             $sessionid = $data['sessionid'];
             

             echo $sessionarray = $session->Load_records_limit_json(500);

             //push programmeid into the sessionarray

             //$programmeid = $sessionView->getSessionProgramme($sessionid);

             //return sessionarray

             

            
             
$general->endgeneral;
$programme->endprogramme;
$session->endsession;
$queries->endqueries;
$sessionView>endsessionView;?>