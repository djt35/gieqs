<?php

            $openaccess = 1;
			//$requiredUserLevel = 4;
			require ('../../../assets/includes/config.inc.php');		
			
			require (BASE_URI.'/assets/scripts/headerScript.php');

            //$general = new general;
            //$programme = new programme;
            //$emailLink = new emailLink;
            $blogContent = new blogContent;
            
            //error_reporting(E_ALL);
            $debug = FALSE;

            //$print_r()

            $data = json_decode(file_get_contents('php://input'), true);

            
            if ($debug){
            print_r($data);
            }

            $id = $data['id'];
            //$databaseName = $data['databaseName'];
            


            if ($blogContent->Return_row($id)){

                $blogContent->Load_from_key($id);
                $blogContent->Delete_row_from_key($id);


            }



            ?>





<?php
        

            
           

            
             
//$general->endgeneral();
//$programme->endprogramme();
//$userRegistrations->enduserRegistrations();
?>