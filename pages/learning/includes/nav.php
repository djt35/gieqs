<!--Main Navbar-->
<?php

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

?>

<nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-dark bg-dark" id="navbar-main">
    <div class="container px-lg-0">
        <!-- Logo -->
        <a class="navbar-brand mr-lg-5" href="<?php echo BASE_URL;?>/index.php">
            <img alt="Image placeholder" src="<?php echo BASE_URL;?>/assets/img/brand/gieqs.svg" id="navbar-logo"
                style="height: 50px;">
        </a>
        <!-- Navbar collapse trigger -->
        <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbar-main-collapse"
            aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-lg-center">
                <!-- Home - Overview  -->
                <!--<li class="nav-item active">
              <a class="nav-link" href="/index.php">Overview</a>
            </li>-->

                <!-- LIVE, moved to main page -->


                <!-- Mission -->
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo BASE_URL;?>/pages/learning/index.php">Learning Home</a>
                </li>
                <!-- Program-basic, later to add dropdown with options -->
                <!--  <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Video</a>
                    
                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">
                    <span style="color: rgb(238, 194, 120);" class="dropdown-header">Beta</span>
                    <a class="dropdown-item" href="<?php //echo BASE_URL;?>/pages/learning/navigator.php"><i class="fas fa-columns"></i>Video Explorer</a>
                    
                    <div class="dropdown-divider"></div>
                    <span style="color: rgb(238, 194, 120);" class="dropdown-header">Later</span>
                    <a class="dropdown-item" href="<?php //echo BASE_URL;?>/pages/program/faculty.php"><i class="fas fa-user"></i>Faculty</a>
                    
                    
                  </div>
                </li> -->

                <?php if ($currentUserLevel < 6){?>

                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                  
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Medical</a>

                    <div class="dropdown-menu dropdown-menu-arrow" aria-labelledby="btn-group-settings">
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Colonoscopy</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/start-concepts.php"><i
                                class="fas fa-columns"></i>Colonoscopy</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Polypectomy</span>

                        <a class="dropdown-item dropdown-toggle cursor-pointer" role="button" data-toggle="dropdown"><i
                                class="fas fa-columns"></i>Polypectomy</a>
                        <div id="polypectomy-dropdown" class="dropdown-submenu dropdown-menu-xl rounded-bottom delimiter-top p-4 bg-dark-light">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="#" class="dropdown-item"
                                        style="color: rgb(238, 194, 120);">Introduction</a>
                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/start.php"><i
                                            class="fas fa-columns"></i>Start here</a>

                                    <a href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gastroscopy-imaging.php"
                                        class="dropdown-item">Imaging at Gastroscopy
                                        <!--  <img class="w-100" alt="Boston Scientific" src="<?php echo BASE_URL . '/assets/img/brand/boston.jpg';?>"> -->
                                    </a>

                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);"></a>

                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">GI Bleeding</a>

                                    <a href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gib.php"
                                        class="dropdown-item">Gastrointestinal Bleeding</a>

                                </div>
                                <div class="col-sm-3">



                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">Upper GI
                                        Therapeutics</a>

                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/feeding-tube.php">Feeding
                                        Tube Placement</a>
                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/food-bolus.php">Food
                                        Bolus Obstruction</a>
                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/dilatation.php">Dilatation</a>

                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);"></a>


                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">Inflammatory
                                        Bowel Disease</a>

                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/ibd.php">IBD</a>



                                </div>


                            </div>
                        </div>


                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">GIEQs Everyday Endoscopy</span>
                        
                        <a class="dropdown-item dropdown-toggle cursor-pointer" role="button" data-toggle="dropdown"><i
                                class="fas fa-columns"></i>GIEQs Endoscopy Curriculum</a>
                        <div id="curriculum-dropdown" class="dropdown-submenu dropdown-menu-xl rounded-bottom delimiter-top p-4 bg-dark-light">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">Gastroscopy</a>
                                    <a href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gastroscopy.php"
                                        class="dropdown-item">Gastroscopy
                                        <!--  <img class="w-100" alt="Boston Scientific" src="<?php echo BASE_URL . '/assets/img/brand/boston.jpg';?>"> -->
                                    </a>
                                    <a href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gastroscopy-imaging.php"
                                        class="dropdown-item">Imaging at Gastroscopy
                                        <!--  <img class="w-100" alt="Boston Scientific" src="<?php echo BASE_URL . '/assets/img/brand/boston.jpg';?>"> -->
                                    </a>

                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);"></a>

                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">GI Bleeding</a>

                                    <a href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gib.php"
                                        class="dropdown-item">Gastrointestinal Bleeding</a>

                                </div>
                                <div class="col-sm-3">



                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">Upper GI
                                        Therapeutics</a>

                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/feeding-tube.php">Feeding
                                        Tube Placement</a>
                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/food-bolus.php">Food
                                        Bolus Obstruction</a>
                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/dilatation.php">Dilatation</a>

                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);"></a>


                                    <a href="#" class="dropdown-item" style="color: rgb(238, 194, 120);">Inflammatory
                                        Bowel Disease</a>

                                    <a class="dropdown-item"
                                        href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/ibd.php">IBD</a>



                                </div>


                            </div>
                        </div>
                        
                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Advanced Endoscopic
                            Resection</span>
                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/pages/learning/pages/resection/all.php"><i
                                class="fas fa-columns"></i>Advanced Endoscopic Resection</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Submucosal Endoscopy</span>
                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/pages/learning/pages/resection/all.php"><i
                                class="fas fa-columns"></i>Submucosal Endoscopy</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">ERCP</span>
                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/pages/learning/pages/ERCP/all.php"><i
                                class="fas fa-columns"></i>ERCP</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">EUS</span>
                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/pages/learning/pages/EUS/all.php"><i
                                class="fas fa-columns"></i>EUS</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/EUS-therapeutic/all.php"><i
                                class="fas fa-columns"></i>Therapeutic EUS</a>



                    </div>

                </li>

                <?php }else{?>

                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Basic Content</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Polypectomy</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/preview.php"><i
                                class="fas fa-columns"></i>Polypectomy Tutor Basic</a>

                        <!-- <div class="dropdown-divider"></div>

<span style="color: rgb(238, 194, 120);" class="dropdown-header">GIEQs Curriculum</span>
<a class="dropdown-item" href="<?php //echo BASE_URL;?>/pages/learning/pages/curriculum/start.php"><i class="fas fa-columns"></i>GIEQs Endoscopy Curriculum</a> -->



                    </div>

                </li>

                <?php } ?>
                <!-- if on main page -->

                <!--show nothing -->

                <?php
                

                if ($currentUserLevel < 6){

                    $url =  "{$_SERVER['REQUEST_URI']}";
                    $inColonTutor = preg_match (  '/colontutor/' ,  $url);
                    $inPolypectomyTutor = preg_match (  '/polyptutor/' ,  $url);
                    $inNursing = preg_match (  '/nursing/' ,  $url);
                    $inCurriculum = preg_match (  '/curriculum/' ,  $url);

                  }


                    if ($inColonTutor){?>

                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" style="color: rgb(238, 194, 120);" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Colonoscopy Tutor</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Start here</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/start-concepts.php"><i
                                class="fas fa-columns"></i>Introduction to Colonoscopy Theory</a>
                        <a class="dropdown-item" href=""><i class="fas fa-columns"></i>Simple cases</a>
                        <a class="dropdown-item" href=""><i class="fas fa-columns"></i>Introduction to managing
                            pathology</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Progress your technique</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/insertion.php"><i
                                class="fas fa-columns"></i>Insertion techniques</a>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/loops.php"><i
                                class="fas fa-columns"></i>Loop resolution</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/visualisation.php"><i
                                class="fas fa-columns"></i>Mucosal visualisation</a>
                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Learning Theory</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/concepts.php"><i
                                class="fas fa-columns"></i>Conceptual lectures</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/training.php"><i
                                class="fas fa-columns"></i>Training theory</a>
                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Pathology</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/pathology.php"><i
                                class="fas fa-columns"></i>Management of pathology</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/colontutor/all.php"><i
                                class="fas fa-columns"></i>View All Videos</a>



                    </div>
                </li>


                <!--do colontutor links here and colour menu gold-->

                <?php }elseif ($inPolypectomyTutor) {?>

                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" style="color: rgb(238, 194, 120);" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Polypectomy Tutor</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Start here</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/start.php"><i
                                class="fas fa-columns"></i>Introduction to Polypectomy Theory</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Imaging</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/imaging.php"><i
                                class="fas fa-columns"></i>Colorectal Polyp Imaging</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Techniques</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/csp.php"><i
                                class="fas fa-columns"></i>Cold Snare Polypectomy</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/pcsp.php"><i
                                class="fas fa-columns"></i>Piecemeal Cold Snare Polypectomy</a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/pedunculated.php"><i
                                class="fas fa-columns"></i>Pedunculated Polypectomy</a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/emr.php"><i
                                class="fas fa-columns"></i>Endoscopic Mucosal Resection (EMR)</a>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/emr_difficult.php"><i
                                class="fas fa-columns"></i>Difficult EMR</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/emr_defect.php"><i
                                class="fas fa-columns"></i>Defect Assessment after EMR</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Adverse Events</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/adverse.php"><i
                                class="fas fa-columns"></i>Adverse Events</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Surveillance</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/surveillance.php"><i
                                class="fas fa-columns"></i>Surveillance after Polypectomy</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/polyptutor/all.php"><i
                                class="fas fa-columns"></i>View All Videos</a>


                    </div>
                </li>




                <?php } elseif ($inNursing) {?>

                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" style="color: rgb(238, 194, 120);" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nursing Tutor</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Start here</span>

                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/pages/learning/pages/nursing/start.php"><i
                                class="fas fa-columns"></i>Introduction to Endoscopy Nursing Theory</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Nursing techniques</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/nursing/techniques.php"><i
                                class="fas fa-columns"></i>Techniques</a>

                        <div class="dropdown-divider"></div>


                        <a class="dropdown-item" href=""><i class="fas fa-columns"></i>View All Videos</a>


                    </div>
                </li>

                <?php } elseif ($inCurriculum) {?>

                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" style="color: rgb(238, 194, 120);" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">GIEQs Everyday Endoscopy</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Gastroscopy</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gastroscopy.php"><i
                                class="fas fa-columns"></i>Gastroscopy Technique</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gastroscopy-imaging.php"><i
                                class="fas fa-columns"></i>Upper GI Imaging</a>


                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">GI Bleeding</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/gib.php"><i
                                class="fas fa-columns"></i>Gastrointestinal Bleeding</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Upper GI Therapeutics</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/feeding-tube.php"><i
                                class="fas fa-columns"></i>Feeding Tube Placement</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/food-bolus.php"><i
                                class="fas fa-columns"></i>Food Bolus Obstruction</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/dilatation.php"><i
                                class="fas fa-columns"></i>Dilatation</a>


                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Inflammatory Bowel
                            Disease</span>

                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/curriculum/ibd.php"><i
                                class="fas fa-columns"></i>IBD</a>

                        <!-- <a class="dropdown-item" href=""><i class="fas fa-columns"></i>View All Videos</a>
 -->

                    </div>
                </li>




                <?php } else{?>

                <?php } ?>




                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Nursing</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Nursing Techniques</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/pages/nursing/techniques.php"><i
                                class="fas fa-columns"></i>Techniques Videos</a>



                    </div>
                </li>

                <?php
                                if (isset($_SESSION['user_id']) && ($_SESSION['siteKey'] == 'TxsvAb6KDYpmdNk') && ($_SESSION['access_level'] == '1' || $_SESSION['access_level'] == '2')){
                                  ?>
                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Creator</a>

                    <div class="dropdown-menu  dropdown-menu-arrow" aria-labelledby="btn-group-settings">
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Video</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/videoUploadForm.php"><i
                                class="fas fa-columns"></i>New Video</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/forms/videoTable.php"><i
                                class="fas fa-columns"></i>Video Table</a>

                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Tags</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/forms/tagsForm.php"><i
                                class="fas fa-columns"></i>New Tag</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/forms/tagsTable.php"><i
                                class="fas fa-columns"></i>Tag / Reference Table</a>


                        <div class="dropdown-divider"></div>

                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Tag Categories</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/forms/tagCategoriesForm.php"><i
                                class="fas fa-columns"></i>New Tag Category</a>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/forms/tagCategoriesTable.php"><i
                                class="fas fa-columns"></i>Tag Category Table</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">References</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/forms/referencesForm.php"><i
                                class="fas fa-columns"></i>New Reference</a>

                        <div class="dropdown-divider"></div>
                        <span style="color: rgb(238, 194, 120);" class="dropdown-header">Maintenance</span>
                        <a class="dropdown-item"
                            href="<?php echo BASE_URL;?>/pages/learning/scripts/getThumbnailsVideo.php"><i
                                class="fas fa-user"></i>Update / generate Thumbnails</a>


                    </div>
                </li>
                <?php
                }?>



                <!-- Backend menu for learning-->

                <?php
                
                if (isset($_SESSION['user_id']) && ($_SESSION['siteKey'] == 'TxsvAb6KDYpmdNk') && ($_SESSION['access_level'] == '1' || $_SESSION['access_level'] == '2') || $_SESSION['access_level'] == '3'){
                ?>

                <li class="nav-item">
                    <a class="nav-link text-muted"
                        href="<?php echo BASE_URL;?>/pages/backend/backend.php">Administration</a>
                </li>

                <?php
                }

            //check page we are on
/* 
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            //if contains index.html

            if (strpos($actual_link, 'index.php') !== false) {
              echo '
            <li class="nav-item active">
              <a class="nav-link" data-toggle="modal" data-target="#registerInterest">Register</a>
            </li>';
            }else{
              //otherwise
              echo '
              <li class="nav-item active">
                <a class="nav-link" href="' . BASE_URL . '/index.php?signup=2456">Register</a>
              </li>';
              

            } */

            

            



            ?>


                <!-- Pages menu -->
                <!-- <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow p-0">
                <ul class="list-group list-group-flush">
                  <li class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media d-flex align-items-center"> -->
                <!-- SVG icon -->
                <!-- <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Code_2.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure> -->
                <!-- Media body -->
                <!-- <div class="media-body ml-3">
                          <h6 class="mb-1">Landing</h6>
                          <p class="mb-0">A great point to start from.</p>
                        </div>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="pages/landing/agency.html">
                          Agency
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/app.html">
                          App
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/blog.html">
                          Blog
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/classic.html">
                          Classic
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/cloud-hosting.html">
                          Cloud hosting
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/digital.html">
                          Digital
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/event-music.html">
                          Event music
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/features.html">
                          Features
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/portfolio.html">
                          Portfolio
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/presentation.html">
                          Presentation
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/saas.html">
                          Saas
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/services.html">
                          Services
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/landing/software.html">
                          Software
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media d-flex align-items-center"> -->
                <!-- SVG icon -->
                <!-- <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Code.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure> -->
                <!-- Media body -->
                <!-- <div class="media-body ml-3">
                          <h6 class="mb-1">Secondary</h6>
                          <p class="mb-0">Examples for any scenario.</p>
                        </div>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="pages/secondary/about-classic.html">
                          About classic
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/about.html">
                          About
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/blog.html">
                          Blog
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/blog-article.html">
                          Blog article
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/blog-masonry.html">
                          Blog masonry
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/careers.html">
                          Careers
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/careers-single.html">
                          Careers single
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/contact.html">
                          Contact
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/contact-simple.html">
                          Contact simple
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/get-started.html">
                          Get started
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/portfolio.html">
                          Portfolio
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/portfolio-fullscreen.html">
                          Portfolio fullscreen
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/pricing-charts.html">
                          Pricing charts
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/pricing-comparison.html">
                          Pricing comparison
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/pricing-simple.html">
                          Pricing simple
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/services.html">
                          Services
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/secondary/team.html">
                          Team
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media d-flex align-items-center"> -->
                <!-- SVG icon -->
                <!-- <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Secure_Files.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure> -->
                <!-- Media body -->
                <!-- <div class="media-body ml-3">
                          <h6 class="mb-1">Authentication</h6>
                          <p class="mb-0">Examples for any scenario.</p>
                        </div>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="text-sm text-muted dropdown-header px-0">Basic</li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/basic-login.html">
                          Login
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/basic-register.html">
                          Register
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/basic-recover.html">
                          Recover
                        </a>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li class="text-sm text-muted dropdown-header px-0">Cover</li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/cover-login.html">
                          Login
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/cover-register.html">
                          Register
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/cover-recover.html">
                          Recover
                        </a>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li class="text-sm text-muted dropdown-header px-0">Simple</li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/simple-login.html">
                          Login
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/simple-register.html">
                          Register
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/authentication/simple-recover.html">
                          Recover
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media d-flex align-items-center"> -->
                <!-- SVG icon -->
                <!-- <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Task.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure> -->
                <!-- Media body -->
                <!-- <div class="media-body ml-3">
                          <h6 class="mb-1">Account</h6>
                          <p class="mb-0">Account management made cool.</p>
                        </div>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="text-sm text-muted dropdown-header px-0">Account</li>
                      <li>
                        <a class="dropdown-item" href="pages/account/account-billing.html">
                          Billing
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/account-notifications.html">
                          Notifications
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/account-profile.html">
                          Profile
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/account-profile-public.html">
                          Profile public
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/account-settings.html">
                          Settings
                        </a>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li class="text-sm text-muted dropdown-header px-0">Board</li>
                      <li>
                        <a class="dropdown-item" href="pages/account/board-connections.html">
                          Connections
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/board-overview.html">
                          Overview
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/board-projects.html">
                          Projects
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/board-tasks.html">
                          Tasks
                        </a>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li class="text-sm text-muted dropdown-header px-0">Listing</li>
                      <li>
                        <a class="dropdown-item" href="pages/account/listing-orders.html">
                          Orders
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/listing-projects.html">
                          Projects
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/account/listing-users.html">
                          Users
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media d-flex align-items-center"> -->
                <!-- SVG icon -->
                <!-- <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Cart_Add_2.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure> -->
                <!-- Media body -->
                <!-- <div class="media-body ml-3">
                          <h6 class="mb-1">Shop</h6>
                          <p class="mb-0">Complete flow for online shops.</p>
                        </div>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="text-sm text-muted dropdown-header px-0">Shop</li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/shop-landing.html">
                          Landing
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/shop-products.html">
                          Products
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/shop-product.html">
                          Product
                        </a>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li class="text-sm text-muted dropdown-header px-0">Checkout</li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/checkout-cart.html">
                          Cart
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/checkout-cart-empty.html">
                          Cart empty
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/checkout-customer.html">
                          Customer
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/checkout-payment.html">
                          Payment
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/shop/checkout-shipping.html">
                          Shipping
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media d-flex align-items-center">-->
                <!-- SVG icon -->
                <!-- <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Cog_Wheels.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure> -->
                <!-- Media body -->
                <!-- <div class="media-body ml-3">
                          <h6 class="mb-1">Utility</h6>
                          <p class="mb-0">Error pages and everything else.</p>
                        </div>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="pages/utility/coming-soon.html">
                          Coming soon
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/utility/error-404.html">
                          Error 404
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/utility/faq.html">
                          Faq
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/utility/support.html">
                          Support
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/utility/topic.html">
                          Topic
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages/utility/topic-simple.html">
                          Topic simple
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </li> -->
                <!-- Sections menu -->
                <!-- <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sections</a>
              <div class="dropdown-menu dropdown-menu-xl dropdown-menu-arrow p-0">
                <ul class="list-group list-group-flush">
                  <li>
                    <a href="sections.html" class="list-group-item list-group-item-action" role="button">
                      <div class="media d-flex align-items-center">
                        <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Apps.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure>
                        <div class="media-body ml-3">
                          <h6 class="mb-1">Explore all sections</h6>
                          <p class="mb-0">Awesome section examples for any scenario.</p>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
                <div class="dropdown-menu-links rounded-bottom delimiter-top p-4">
                  <div class="row">
                    <div class="col-sm-4">
                      <a href="sections.html#headers" class="dropdown-item">Headers</a>
                      <a href="sections.html#footers" class="dropdown-item">Footers</a>
                      <a href="sections.html#blog" class="dropdown-item">Blog</a>
                      <a href="sections.html#call-to-action" class="dropdown-item">Call to action</a>
                      <a href="sections.html#clients" class="dropdown-item">Clients</a>
                      <a href="sections.html#collapse" class="dropdown-item">Collapse</a>
                    </div>
                    <div class="col-sm-4">
                      <a href="sections.html#covers" class="dropdown-item">Covers</a>
                      <a href="sections.html#features" class="dropdown-item">Features</a>
                      <a href="sections.html#milestone" class="dropdown-item">Milestone</a>
                      <a href="sections.html#pricing" class="dropdown-item">Pricing</a>
                      <a href="sections.html#projects" class="dropdown-item">Projects</a>
                      <a href="sections.html#subscribe" class="dropdown-item">Subscribe</a>
                    </div>
                    <div class="col-sm-4">
                      <a href="sections.html#swiper" class="dropdown-item">Swiper</a>
                      <a href="sections.html#tables" class="dropdown-item">Tables</a>
                      <a href="sections.html#team" class="dropdown-item">Team</a>
                      <a href="sections.html#testimonials" class="dropdown-item">Testimonials</a>
                      <a href="sections.html#video" class="dropdown-item">Video</a>
                    </div>
                  </div>
                </div>
                <div class="delimiter-top py-3 px-4">
                  <span class="badge badge-soft-success">Yaass!</span>
                  <p class="mt-2 mb-0">
                    Explore, switch, customize any component, section or page and make your website rich its full potential.
                  </p>
                </div>
              </div>
            </li>
          </ul> -->
                <!--
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Docs</a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                <ul class="list-group list-group-flush">
                  <li>
                    <a href="docs/index.php" class="list-group-item list-group-item-action" role="button">
                      <div class="media d-flex align-items-center">-->
                <!-- SVG icon -->
                <!--<figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/DOC_File.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure>-->
                <!-- Media body -->
                <!--
                        <div class="media-body ml-3">
                          <h6 class="mb-1">Documentation</h6>
                          <p class="mb-0">Awesome section examples for any scenario.</p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="docs/components/index.php" class="list-group-item list-group-item-action" role="button">
                      <div class="media d-flex align-items-center">-->
                <!-- SVG icon -->
                <!--
                        <figure style="width: 50px;">
                          <img alt="Image placeholder" src="assets/img/icons/essential/detailed/Mobile_UI.svg" class="svg-inject img-fluid" style="height: 50px;">
                        </figure>-->
                <!-- Media body -->
                <!--
                        <div class="media-body ml-3">
                          <h6 class="mb-1">Components</h6>
                          <p class="mb-0">Awesome section examples for any scenario.</p>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
                <div class="dropdown-menu-links rounded-bottom delimiter-top p-4">
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="docs/getting-started/installation.html" class="dropdown-item">Installation</a>
                      <a href="docs/getting-started/file-structure.html" class="dropdown-item">File structure</a>
                      <a href="docs/getting-started/build-tools.html" class="dropdown-item">Build tools</a>
                      <a href="docs/getting-started/customization.html" class="dropdown-item">Customization</a>
                    </div>
                    <div class="col-sm-6">
                      <a href="docs/getting-started/plugins.html" class="dropdown-item">Using plugins</a>
                      <a href="docs/components/index.php" class="dropdown-item">Components</a>
                      <a href="docs/plugins/animate.html" class="dropdown-item">Plugins</a>
                      <a href="docs/support.html" class="dropdown-item">Support</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item d-lg-none d-xl-block">
              <a class="nav-link" href="docs/changelog.html" target="_blank">What's new</a>
            </li>
            <li class="nav-item mr-0">
              <a href="https://themes.getbootstrap.com/product/purpose-website-ui-kit/" target="_blank" class="nav-link d-lg-none">Purchase now</a>
              <a href="https://themes.getbootstrap.com/product/purpose-website-ui-kit/" target="_blank" class="btn btn-sm btn-white rounded-pill btn-icon rounded-pill d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="left" title="Go to Bootstrap Themes">
                <span class="btn-inner--icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="btn-inner--text">Purchase now</span>
              </a>
            </li>-->
            </ul>
        </div>
    </div>
</nav>