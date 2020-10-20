<!DOCTYPE html>
<html lang="en">

<?php require '../../includes/config.inc.php';?>


<head>

    <?php


    error_reporting(0);

      //define user access level

      //$openaccess = 1;

      $requiredUserLevel = 6;


      require BASE_URI . '/head.php';

      $debug = false;
      error_reporting(E_ALL);
      
      $general = new general;
      $users = new users;
      $users->Load_from_key($userid);
      

      require_once(BASE_URI . '/assets/scripts/classes/assetManager.class.php');
      $assetManager = new assetManager;

      require_once(BASE_URI . '/assets/scripts/classes/subscriptions.class.php');
      $subscription = new subscriptions;
     

      ?>

    <!--Page title-->
    <title>GIEQs Online Endoscopy Trainer</title>

    <link rel="stylesheet" href="<?php echo BASE_URL;?>/assets/libs/animate.css/animate.min.css">

    

    <style>
        .gieqsGold {

            color: rgb(238, 195, 120);


        }

        .tagButton {

            cursor: pointer;

        }

        .tagCard {

background-color: #1b385d75; 



}

.tagCardHeader{

    background-color: #162e4d;

}

        

.cursor-pointer {

    cursor: pointer;

}

@media (min-width: 992px) {
    .tagCard {

            
left: -50vw;
top: -20vh;


}
}

@media (min-width: 1200px) {
        #chapterSelectorDiv{

            
                
                top:-3vh;
            

        }
        #playerContainer{

                margin-top:-20px;

        }
        #collapseExample {

            position: absolute; 
            max-width: 50vh; 
            z-index: 25;
        }

        #selectDropdown {

            
            z-index: 25;
            }

            

}
    </style>


</head>

<body>
    <header class="header header-transparent" id="header-main">

        <!-- Topbar -->

        <?php require BASE_URI . '/pages/learning/includes/topbar.php';?>

        <!-- Main navbar -->

        <?php require BASE_URI . '/pages/learning/includes/nav.php';?>

        


    </header>

    <?php
		if (isset($_GET["id"]) && is_numeric($_GET["id"])){
			$id = $_GET["id"];
		
		}else{
		
			$id = null;
		
		}
				        
                        
                        
		
        ?>
        
        <!-- load all video data -->

        <body>

<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>

<div class="main-content">
    <!-- Header (account) -->
    <section class="page-header bg-dark-dark d-flex align-items-end pt-8 mt-10" style="background-image: url('<?php echo BASE_URL;?>/assets/img/covers/resection/ssp.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;" data-offset-top="#header-main">

   
      <!-- Header container -->
      <div class="container pt-0 pt-lg-0" >
        <div class="row" >
          <div class=" col-lg-12">
            <!-- Salute + Small stats -->
            <div class="row align-items-center mb-4">
              <div class="col-auto mb-4 mb-md-0">
                <span class="h2 mb-0 text-white text-bold d-block">My Account <?php //echo $_SESSION['firstname'] . ' ' . $_SESSION['surname']?></span>
                <span class="text-white">Setup your GIEQs account.</span>
              </div>
              <!-- video -->
              <div class="col-auto flex-fill d-none d-xl-block">
              <!-- <div id="videoDisplay" class="embed-responsive embed-responsive-16by9">
                <iframe  id='videoChapter' class="embed-responsive-item"
                    src='https://player.vimeo.com/video/398791515' allow='autoplay'
                    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div> -->
            </div>
            </div>
            <!-- Account navigation -->
           
            
          </div>
        </div>
      </div>
    </section>
    <section class="slice">
      <div class="container">
        <div class="row row-grid">
          <div class="col-lg-9 order-lg-2">
            <!-- Change avatar -->
            <?php require(BASE_URI . '/pages/learning/pages/account/memberCard.php');?>

<!--Site Wide Subscriptions
            Asset User connections
            -->
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-5 col-lg-8">
                    <span class="h6">Site Wide Subscription Status</span>
                  </div>
                  <div class="col-7 col-lg-4 text-right">
                    <!-- <img alt="Image placeholder" src="../../assets/img/icons/cards/mastercard.png" width="40" class="mr-2">
                    <img alt="Image placeholder" src="../../assets/img/icons/cards/visa.png" width="40" class="mr-2">
                    <img alt="Image placeholder" src="../../assets/img/icons/cards/skrill.png" width="40"> -->
                  </div>
                </div>
              </div>
              <div>

<!-- 

know the user level
-->

<?php




?>

<!--
  get linked subscription (should have value type of 1)
there should only be 1
to become a user 4 must have a linked subscription;

get expiry

get whether expiring soon su




 -->

                <ul class="list-group list-group-flush">

                  <?php 
                  
                  if ($siteWide){

                    //use $siteWideSubscriptionid to get data from subscriptions

                    if ($debug){

                      echo $siteWideSubscriptionid . ' is $siteWideSubscriptionid';
                    }

                    $subscription->Load_from_key($siteWideSubscriptionid);

                    $expiry_date = null;

                    $expiry_date = new DateTime($subscription->getexpiry_date(), new DateTimeZone('UTC'));

                    $expiry_date->setTimezone(new DateTimeZone($users->gettimezone()));


                    ?>

                    <li class="list-group-item">
                      <div class="row align-items-center">
                        <div class="col-sm-4"><small class="h6 text-sm mb-3 mb-sm-0">Plan</small></div>
                        <div class="col-sm-5">
                          <strong><?php echo $assetManager->getAssetName($siteWideSubscriptionid);?></strong>
                          <br/>
                          Expires : <span class="expiry_date"><?php echo date_format($expiry_date,"d/m/Y");?></span>
                          <br/>
                          Renews : <span class="renewalFrequency"></span>
                        </div>
                        <div class="col-sm-3 text-sm-right">
                          <?php if ($siteWideExpiring){ ?>

                            <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0 upgrade-plan">Renew</a>
                            
                            <?php
                          }
                          ?>
<!--                           <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0">Upgrade</a>
 -->                        </div>
                      </div>
                    </li>

<?php 
                  }else{
                    ?>

                    <?php if ($users->getUserAccessLevel($userid) < 5){ ?>

                      <li class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-sm-4"><small class="h6 text-sm mb-3 mb-sm-0">Plan</small></div>
                          <div class="col-sm-5">
                            <strong>GIEQs Pro Membership Via Status</strong>
                            <br/>
                          Expires :<span class="expiry_date">Never</span>
                          <br/>
                          Renews : <span class="renewalFrequency">Not Applicable</span>
                          </div>
                          <div class="col-sm-3 text-sm-right">
  <!--                           <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0">Upgrade</a>
   -->                        </div>
                        </div>
                      </li>

                      <?php } else { ?>

                    <li class="list-group-item">
                      <div class="row align-items-center">
                        <div class="col-sm-4"><small class="h6 text-sm mb-3 mb-sm-0">Plan</small></div>
                        <div class="col-sm-5">
                          <strong>No Current Plan</strong>
                        </div>
                        <div class="col-sm-3 text-sm-right">

                          <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0 start-plan">Buy Plan</a>

<!--                           <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0">Upgrade</a>
 -->                        </div>
                      </div>
                    </li>

                    <?php } ?>
<?php

                  }
                  ?>
                  
                  
                </ul>
              </div>
            </div>



            <!-- Section title -->
            
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-5 col-lg-8">
                    <span class="h6">Subscription Status</span>
                  </div>
                  <div class="col-7 col-lg-4 text-right">
                    <!-- <img alt="Image placeholder" src="../../assets/img/icons/cards/mastercard.png" width="40" class="mr-2">
                    <img alt="Image placeholder" src="../../assets/img/icons/cards/visa.png" width="40" class="mr-2">
                    <img alt="Image placeholder" src="../../assets/img/icons/cards/skrill.png" width="40"> -->
                  </div>
                </div>
              </div>
              <div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col-sm-4"><small class="h6 text-sm mb-3 mb-sm-0">Plan</small></div>
                      <div class="col-sm-5">
                        <strong>Status</strong> benefits.
                      </div>
                      <div class="col-sm-3 text-sm-right">
                        <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0">Upgrade</a>
                      </div>
                    </div>
                  </li>
                  
                </ul>
              </div>
            </div>

            

            <!-- Payment history
            GIEQs Pro
            Then other specifics 
            Use Asset User connection
            Order desc

            

            -->
            <div class="mt-5">
              <div class="actions-toolbar py-2 mb-4">
                <h5 class="mb-1">Payment history</h5>
                <p class="text-sm text-muted mb-0">A history of your payments.</p>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-cards align-items-center">
                  <thead>
                    <th></th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Invoice Number</th>
                    <th>Decription</th>
                    <th>Amount</th>

                  </thead>
                  <tbody>

          <?php 
          
            $subscriptions = $assetManager->returnCombinationUserSubscription($userid);

            $current_date = new DateTime('now', new DateTimeZone('UTC'));

          if ($debug){
          print_r($subscriptions);
          }
          
          
          
          foreach ($subscriptions as $key=>$value){


            $start_date = null;

            $start_date = new DateTime($value['start_date'], new DateTimeZone('UTC'));

            $start_date->setTimezone(new DateTimeZone($users->gettimezone()));

            $expiry_date = null;

            $expiry_date = new DateTime($value['expiry_date'], new DateTimeZone('UTC'));

            $expiry_date->setTimezone(new DateTimeZone($users->gettimezone()));



            if ($debug){
            echo $value['id'];
            echo $value['asset_id'];
            
            echo '<br/>' . date_format($start_date,"d/m/Y H:i:s");
            echo '<br/>';
            echo $users->gettimezone();
            echo '<br/>';
            echo '<br/>';
            echo '<br/>' . date_format($start_date,"d/m/Y H:i:s");
            echo '<br/>';
            echo $value['start_date'];

            echo '<br/>' . date_format($expiry_date,"d/m/Y H:i:s");
            echo '<br/>';
            echo $users->gettimezone();
            echo '<br/>';
            echo '<br/>';
            echo '<br/>' . date_format($expiry_date,"d/m/Y H:i:s");
            echo '<br/>';
            echo $value['expiry_date'];


            echo $value['expiry_date'];
            echo $value['active'];

            echo $assetManager->subscription_expires_soon($value['id'], $debug);
            

            }

            $cost = $assetManager->getCost($value['id']);
            ?>


            
            <tr data="<?php echo $value['id'];?>">
              <th scope="row">
                <span class="badge badge-lg badge-dot">

                  <?php if ($assetManager->subscription_expires_soon($value['id'], $debug) === true){ ?>
                    <i class="bg-warning" title="Expires Soon" data-toggle="tooltip"></i>

                  
                  <?php } elseif ($assetManager->isSubscriptionActive($value['id'], $current_date, $debug) === true){ ?>
                  <i class="bg-success" title="Active" data-toggle="tooltip"></i>
                  <?php } else { ?>

                    <i class="bg-danger" title="Inactive or Unpaid" data-toggle="tooltip"></i>


                  <?php } ?>

                </span>
              </th>
              <!-- <td class="identifier" style="display:none;">
                <?php echo $value['id'];?>
              </td> -->
              <td>
                <i class="fas fa-calendar-alt mr-2"></i>
                <span class="h6 text-sm"><?php echo date_format($start_date,"d/m/Y");?></span>
              </td>
              <td>
                <i class="fas fa-calendar-alt mr-2"></i>
                <span class="h6 text-sm"><?php echo date_format($expiry_date,"d/m/Y");?></span>
              </td>
              <td>#<?php echo $value['id'];?></td>
              <td><!-- <i class="fas fa-credit-card mr-2"></i>Electronic --><?php echo $assetManager->getAssetName($value['id']);?></td>
              <td><?php echo $cost;?> EUR</td>
              <td class="text-right">
                <div class="actions">
                  <div class="dropdown">
                    <a class="action-item" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="mailto:gieqs@seauton-international.com?subject=Invoice Please for GIEQs.com Subscription ID <?php echo $value['id'];?>"><i class="fas fa-file-pdf"></i>Request invoice</a>
                     <!--  <a class="dropdown-item" href="#"><i class="fas fa-file-archive"></i>See details</a>
                      <a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i>Delete</a> -->
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="table-divider"></tr>




<?php
          }
          
          ?>

            

            
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Attach a new card -->
            
          </div>
          <?php require BASE_URI . '/pages/learning/pages/account/sidenav.php';?>
        </div>
      </div>
    </section>       

  </div>

    <?php require BASE_URI . '/footer.php';?>

    <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
    <!-- <script src="assets/js/purpose.core.js"></script> -->
    <!-- Page JS -->
    <script src="assets/libs/swiper/dist/js/swiper.min.js"></script>
    <script src="<?php echo BASE_URL;?>/assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="assets/libs/typed.js/lib/typed.min.js"></script>
    <script src="assets/libs/isotope-layout/dist/isotope.pkgd.min.js"></script>
    <script src="assets/libs/jquery-countdown/dist/jquery.countdown.min.js"></script>
    <!-- Google maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBuyKngB9VC3zgY_uEB-DKL9BKYMekbeY"></script>
    <!-- Purpose JS -->
    <script src="<?php echo BASE_URL;?>/assets/js/purpose.js"></script>
    <!-- <script src="assets/js/generaljs.js"></script> -->
    <script src="assets/js/demo.js"></script>
    <script>
    var videoPassed = $("#id").text();
                    </script>

    <script>
        var signup = $('#signup').text();

        function submitPreRegisterForm() {

            var esdLesionObject = pushDataFromFormAJAX("pre-register", "preRegister", "id", null,
            "0"); //insert new object

            esdLesionObject.done(function (data) {

                console.log(data);

                var dataTrim = data.trim();

                console.log(dataTrim);

                if (dataTrim) {

                    try {

                        dataTrim = parseInt(dataTrim);

                        if (dataTrim > 0) {

                            alert("Thank you for your details.  We will keep you updated on everything GIEQs.");
                            $("[data-dismiss=modal]").trigger({
                                type: "click"
                            });

                        }

                    } catch (error) {

                        //data not entered
                        console.log('error parsing integer');
                        $("[data-dismiss=modal]").trigger({
                            type: "click"
                        });


                    }

                    //$('#success').text("New esdLesion no "+data+" created");
                    //$('#successWrapper').show();
                    /* $("#successWrapper").fadeTo(4000, 500).slideUp(500, function() {
                      $("#successWrapper").slideUp(500);
                    });
                    edit = 1;
                    $("#id").text(data);
                    esdLesionPassed = data;
                    fillForm(data); */




                } else {

                    alert("No data inserted, try again");

                }


            });
        }

        $(document).ready(function () {

            


            /* $(document).click(function(event) { 
                $target = $(event.target);
                
                if(!$target.closest('#collapseExample').length && 
                    $('#collapseExample').is(":visible")) {
                        $('#collapseExample').collapse('hide');
                    }        
            }); */

            $(document).click(function(event) { 
                $target = $(event.target);
                
                if(!$target.closest('#selectDropdown').length && 
                    $('#selectDropdown').is(":visible")) {
                        $('#selectDropdown').collapse('hide');
                    }        
            });

            $(document).click(function(event) { 
                $target = $(event.target);
                
                if(!$target.closest('#collapseExample2').length && 
                    $('#collapseExample2').is(":visible")) {
                        $('#collapseExample2').collapse('hide');
                    }        
            });

            $(document).click(function(event) { 
                $target = $(event.target);
                
                if(!$target.closest('#collapseExample3').length && 
                    $('#collapseExample3').is(":visible")) {
                        $('#collapseExample3').collapse('hide');
                    }        
            });

            $(document).on('click', '.tagsClose', function(){

                $('#collapseExample').collapse('hide');

            })

            $('.referencelist').on('click', function (){
		
		
		//get the tag name
		
		var searchTerm = $(this).attr('data');
		
		//console.log("https://www.ncbi.nlm.nih.gov/pubmed/?term="+searchTerm);
		
		PopupCenter("https://www.ncbi.nlm.nih.gov/pubmed/?term="+searchTerm, 'PubMed Search (endoWiki)', 800, 700);

		
		
		
		
	})

	$('.referencelist').on('mouseenter', function (){

		$(this).css('color', 'rgb(238, 194, 120)');
		$(this).css('cursor', 'pointer');

	})

	$('.referencelist').on('mouseleave', function (){

		$(this).css('color', 'white');
		$(this).css('cursor', 'default');

	})


        })
    </script>
</body>

</html>