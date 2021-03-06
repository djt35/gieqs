


<nav class="mt-4 navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="videoBar"
    style="margin-top: 20px; z-index: 2 !important;">
    <div class="container">
        <a class="navbar-brand cursor-pointer" id="start_tour">
            <!-- <small class="m-0 p-0"><br/><?php //echo 'Asset Name'?> --></small>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-warning"
            aria-controls="navbar-warning" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--

Useful for PHP to JS transfer

-->
        <div id='browsing_id' data-browsing-id="<?php echo $browsing_id;?>" class="d-none"></div>
        <div id='browsing' data-browsing="<?php echo $browsing;?>" class="d-none"></div>
        <div id='browsing_array' class="d-none"><?php echo json_encode($browsing_array);?></div>



        <div class="collapse navbar-collapse" id="navbar-warning">
            <!-- <ul class="navbar-nav align-items-lg-left ml-lg-auto">

                
            </ul> -->
            <ul class="navbar-nav justify-content-sm-center ml-sm-auto">

           




                <li class="nav-item dropdown-animate dropdown-submenu bg-dark" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Navigation
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <a id="chapterNavTour" class="dropdown-item" href="#statistics">

                            GIEQs Statistics
                        </a>
                        <a class="dropdown-item cursor-pointer" href="#whats-new">New Material
                        </a>

                        <div class="dropdown-divider"></div>
                        <a id="tourTagNav" class="dropdown-item cursor-pointer"
                            href="#catchup">

                            Pick up where you left off
                        </a>
                        <div class="dropdown-divider"></div>
                        <a id="jumpComments" class="dropdown-item cursor-pointer" href="#suggested">


                            <span class="nav-link-inner--text ">Next steps</span>
                        </a>
                        <a id="jumpReferences" class="dropdown-item cursor-pointer"
                            href="#popular">

                            <span class="nav-link-inner--text">Popular</span>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown-animate dropdown-submenu bg-dark" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Show Me Around!
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item cursor-pointer showMeAround">

                            Overview Tour
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="showMeAroundLong dropdown-item cursor-pointer">Detailed Feature Tour
                        </a>



                    </div>
                </li>


                <!-- <li class="nav-item">
                    <a id="chapterNavTour" class="nav-link nav-link-icon" data-toggle="collapse" href="#selectDropdown">

                        <span class="nav-link-inner--text ">Show Chapters</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="tourTagNav" class="nav-link nav-link-icon" data-toggle="collapse" href="#collapseExample">

                        <span class="nav-link-inner--text ">Show Tags</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="jumpTimeLine" class="nav-link nav-link-icon cursor-pointer">

                        <span class="nav-link-inner--text ">Timeline</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="jumpComments" class="nav-link nav-link-icon cursor-pointer">


                        <span class="nav-link-inner--text ">Comments</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="jumpReferences" class="nav-link nav-link-icon" data-toggle="collapse"
                        href="#collapseExample2">

                        <span class="nav-link-inner--text">References</span>
                    </a>
                </li> -->


                <!-- <li class="nav-item">
                   
                   <a class="nav-link nav-link-icon"
                       >
                       <span class="badge badge-pill bg-gieqsGold text-dark badge-floating border-dark mr-2" style="z-index: -1 !important;">LEVEL 4</span>
                       <span class="nav-link-inner--text ">GIEQs Pro Member</span></a>
                     
                   
                   
                   


                          


                                <span class="nav-link-inner--text ">Complex</span>
                           
               </li> -->
                <?php
                    
                ?>
                <!-- <li class="nav-item">
                    <a class="nav-link nav-link-icon"
                        href="<?php //echo BASE_URL;?>/pages/learning/pages/live/nursing.php">

                        <span class="nav-link-inner--text ">Nursing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" target="_blank"
                        href="<?php //echo BASE_URL;?>/pages/learning/pages/live/programLive.php">

                        <span class="nav-link-inner--text ">Live Programme</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" target="_blank" href="https://facebook.com/gieqs">
                        <i class="fab fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Share</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" target="_blank" href="https://twitter.com/gieqs_symposium">
                        <i class="fab fa-twitter"></i>
                        <span class="nav-link-inner--text d-lg-none">Tweet</span>
                    </a>
                </li> -->

            </ul>

        </div>
    </div>
</nav>