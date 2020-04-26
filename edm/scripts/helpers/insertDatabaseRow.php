
		
		
			<?php

			$openaccess = 0;
			$requiredUserLevel = 1; //superuser only script
			
			require ('../../includes/config.inc.php');		
			
			require (BASE_URI.'/scripts/headerCreatorV2.php');
		
			//(1);
			//require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/esd/scripts/headerCreator.php');
		
			$formv1 = new formGenerator;
            $general = new general;
            $helpers = new helpers;
			
			
		
		
		
		foreach ($_GET as $k=>$v){
		
			$sanitised = $general->sanitiseInput($v);
			$_GET[$k] = $sanitised;
		
		
		}
		
		if (isset($_GET["id"]) && is_numeric($_GET["id"])){
			$id = $_GET["id"];
		
		}else{
		
			$id = null;
		
		}
		
		
		
		//TERMINATE THE SCRIPT IF NOT A SUPERUSER
		
		
		
		// Page content
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>Helper for Database Entry</title>  <!-- CHANGE -->
            <style>
               
               .text-gieqsGold {

color: rgb(238, 194, 120);

               }
               .bg-gieqsGold {

background-color: rgb(238, 194, 120);

}
.pointer {

	cursor: pointer;
	display: none;
}

                    @media only screen and (max-width: 992px) {
                        
						.pointer {

							display: block;
						}

                        #sticky {

                            
								border: rgb(238, 194, 120), 1px;
							   right: 1%;
								display: none;
							
								z-index: 10;
								
								background-color: #162e4d;
								top: 25%;
								max-width: 50%;
								min-width: 50%;
							
    						

                        }

                    }
					@media only screen and (min-width: 992px) {
                        
						.pointer {

							display: none;
						}

                        #sticky {

                            
								position: fixed;
								display: block;
								top: 25%;
								
    						

                        }

                    }

               

}
            </style>
		</head>
		
		<?php
		//include($root . "/scripts/logobar.php");
		include(BASE_URI . "/includes/topbar.php");
		include(BASE_URI . "/includes/naviv2.php");
		?>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer container mb-8'>
                <p class="h5 mt-5">Script to insert new database values</p>
                <form id="">
                
                <div class="form-group">
                    <label for="nameValueListDatabase">Database Name</label>
                                                <div class="input-group mb-3">
                                                    <select id="nameValueListDatabase" type="text" data-toggle="select" class="form-control" name="nameValueListDatabase">
                                                    <option value="" selected disabled hidden>please select an option</option>
                                                    <option value="">POEM</option>
                                                    <option value=""></option>
                                                    </select>

                      
                                        </div>
                                        <label for="type">Field Type</label>
                                                <div class="input-group mb-3">
                                                    <select id="type" type="text" data-toggle="select" class="form-control" name="type">
                                                    <option value="" selected disabled hidden>please select an option</option>
                                                    <option value="">INT (11)</option>
                                                    <option value="">INT (100)</option>
                                                    <option value="">VARCHAR (11)</option>
                                                    <option value="">VARCHAR (100)</option>
                                                    <option value="">VARCHAR (800)</option>
                                                    <option value="">DATE</option>
                                                    </select>

                      
                                        </div>
                                        <label for="fieldName">Position</label>
                                        <div class="input-group mb-3">
                                            <input id="fieldName" type="text" class="form-control" name="fieldName">
                                        </div>
                                        
                                        <label for="position">Position</label>
                                        <div class="input-group mb-3">
                                            <input id="position" type="text" class="form-control" name="position">
                                        </div>
                                        <label for="order">Order</label>
            <div class="input-group mb-3">
                <input id="order" type="text" class="form-control" name="order">
            </div>
           
            <label for="field_type">Type</label>
                                                <div class="input-group mb-3">
                                                    <select id="field_type" type="text" data-toggle="select" class="form-control" name="field_type">
                                                    <option value="" selected disabled hidden>please select an option</option>
                                                    <option value="1">Value List</option>
                                                    <option value="2">Free text</option>
                                                    <option value="3">Date</option>
                                                    <option value="4">Hidden</option>
                                                    
                                                    </select>

                      
                                        </div>
            <label for="text">Text</label>
            <div class="input-group mb-3">
                <input id="text" type="text" class="form-control" name="text">
            </div>
            <label for="tooltip">ToolTip</label>
            <div class="input-group mb-3">
                <input id="tooltip" type="text" class="form-control" name="tooltip">
            </div>

</div>


            </form>


                <?php
                    //requirements
                    
                   
                $containerDatabase = "esdv1";

                $namedatabase = "POEM";
                $nameValueListDatabase = "valuesPOEM";
                $namePageLayoutDatabase = "pageLayoutPOEM";

                $databasesToBackup = [$namedatabase, $nameValueListDatabase, $namePageLayoutDatabase];

                print_r($databasesToBackup);

                //backup databases


                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $user = 'root';
                $pass = 'nevira1pine';
                $host = 'localhost';

                foreach ($databasesToBackup as $key=>$value){

                    $dir = BASE_URI . '/changes/sql/'.$containerDatabase. '_'. $value. '_backup_' .date("j_n_Y_gi"). '.sql';

                    echo "<p>Backing up database to `<code>{$dir}</code>`</p>";

                    exec("/Applications/XAMPP/xamppfiles/bin/mysqldump --user={$user} --password={$pass} --host={$host} {$containerDatabase} {$value} --result-file={$dir} 2>&1", $output);

                }
                //$containerDatabase = 'esdv1';
                
                

                //var_dump($output);

                //insert a database entry
                $databaseField = [ 'name' => 'POEM', 'type' => ''];


                //insert a matching entry in the page layout
                $pageLayout = [ 'name' => '[[from above]]', 'position' => '', 'order' => '', 'type' => '', 'text' => '', 'toolTip' => ''];


                //insert, if required a value list entry
                $valueList = [ 'name' => '[[from above]]', 'options' => [ '0' => 'option0', '' => '']];

                print_r($valueList);
                
                
                //update changelog

                

                $log = date("F j, Y, g:i a") . PHP_EOL;
                $log .= "User with ID " . $_SESSION['user_id'] . " Created a new database field in $namedatabase of {$databaseField['name']}" . PHP_EOL;

                $log .= "Created a page layout entry $namePageLayoutDatabase at position {$pageLayout['position']}, order {$pageLayout['order']} of type {$pageLayout['type']} with text {$pageLayout['text']} and tooltip {$pageLayout['toolTip']}" . PHP_EOL;
                $log .= "Created a values list entry in $valueList with headings {$valueList['name']} and {$valueList['name']}_t" . PHP_EOL;
                $log .= "Included options were" . PHP_EOL;
                foreach($valueList['options'] as $key=>$value){

                    $log .= "$key = $value,";

                }

                echo '<br/><br/>';
                print_r($log);

                print_r(BASE_URI . '/changes/databaseModifications.log');

                file_put_contents(BASE_URI . '/changes/databaseModifications.log', $log, FILE_APPEND);
                
                
                ?>

                






        </div> <!--close container-->
		</div> <!--close content-->

			
		<script>



			switch (true) {
	case winLocation('endoscopy.wiki'):

		var rootFolder = 'https://www.endoscopy.wiki/esd/';
		break;
	case winLocation('localhost'):
		var rootFolder = 'http://localhost:90/dashboard/esd/';
		break;
	default: // set whatever you want
		var rootFolder = 'https://www.endoscopy.wiki/esd/';
		break;
}



    var siteRoot = rootFolder;
		
			 
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI ."/includes/footer.php");
		
		
		
		
		    ?>
		</body>
		</html>