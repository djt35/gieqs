
		
		<?php
		$openaccess = 0;
		$requiredUserLevel = 4;
		
		require ('../../includes/config.inc.php');		
		
		require (BASE_URI.'/scripts/headerCreatorv2.php');
	
		//;
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		$esdLesion = new POEM;  //CHANGE
		
		
		
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>POEM Table</title> <!--//CHANGE-->
			
            <style>
               
               .text-gieqsGold {

color: rgb(238, 194, 120);

               }
               .bg-gieqsGold {

background-color: rgb(238, 194, 120);

}

                    @media only screen and (max-width: 992px) {
                        
                        #right {

                            display: none;

                        }

                    }

               

}
            </style>
			    <link rel="stylesheet" href="<?php echo BASE_URL1; ?>/assets/libs/datatables/dataTables.min.css">

		</head>
		
		<?php
		//include($root . "/scripts/logobar.php");
		include(BASE_URI . "/includes/topbar.php");
		include(BASE_URI . "/includes/naviv2.php");
		?>
		<body>
			
				
		    <div id='content' class='content container p-2'>
			    
		        
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">Table of POEMs</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    
		                </div>
		            </div>
			        
			        <div class='row'>
		                
		
						<div class='col-12'>
							<p style='text-align:left;'><?php echo "You have performed ".$esdLesion->numberOfRows()." lesions";?> </p>
							<br>
		                    <p><?php $general->makeTable("SELECT `id` AS `POEM ID`, `ProcedureDate` AS `Date of Procedure`, `Referrer` AS `Referrer` from `POEM` ORDER BY `ProcedureDate` DESC"); ?></p>  <!--CHANGE-->
		                </div>
		
		                
		            </div>
		
			        
		        
		    </div>
			<!-- Datatables -->
<script src="<?php echo BASE_URL1; ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_URL1; ?>/assets/libs/datatables/dataTables.min.js"></script>

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
		
				
			$(document).ready(function() {
		
				$("#dataTable").find("tr");
		
				$(".content").on("click", ".datarow", function(){
					
					var id = $(this).find("td:first").text();
					
					//console.log(id);
					
					window.location.href = siteRoot + 'scripts/forms/POEMFormV2.php?id=' + id;  //CHANGE
		
					
				})
				
				$('#dataTable').DataTable();
		
		
		
		    });
		
		
		
			</script>    
		    
		    
		<?php
		
		    // Include the footer file to complete the template:
		    include($root ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>
		
		