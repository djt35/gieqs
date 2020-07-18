<?php

$openaccess = 1;
//$requiredUserLevel = 4;

require '../includes/config.inc.php';

$debug = FALSE;

require (BASE_URI . '/assets/scripts/login_functions.php');
     
     //place to redirect the user if not allowed access
     $location = BASE_URL . '/index.php';
 
     if (!($dbc)){
     require(DB);
     }
    
     
     require(BASE_URI . '/assets/scripts/interpretUserAccess.php');


//require (BASE_URI.'/scripts/headerCreatorV2.php');

//(1);
//require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/esd/scripts/headerCreator.php');

function array_not_unique($a = array())
{
    return array_diff_key($a, array_unique($a));
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$general = new general;

$navigator = new navigator;

$user = new users;

$usersLikeVideo = new usersLikeVideo;
$usersFavouriteVideo = new usersFavouriteVideo;

$data = json_decode(file_get_contents('php://input'), true);

$tagsToMatch = $data['tags'];

$loaded = $data['loaded'];

$loadedRequired = $data['loadedRequired'];

$active = $data['active'];

$loadedRequiredProduct = 10 * $loadedRequired;

if ($debug) {
    
    print_r($tagsToMatch);
}

$numberOfTagsToMatch = count($tagsToMatch);

if ($numberOfTagsToMatch < 1) {

    $tagsToMatch = null;

}

if ($debug) {
    print_r('number of tags to match' . $numberOfTagsToMatch);
}


?>


<?php

        //CHANGE ME FOR NEW PAGES

$requiredTagCategories = $data['requiredTagCategories'];

//$requiredTagCategories = ['39', '40', '41', '42'];

?>

<?php

$videos = [];
$x = 0;

$data2 = $navigator->getVideoData($requiredTagCategories, $tagsToMatch, $debug, $active);



$videos = $data2;

if ($debug) {
    echo PHP_EOL . 'html build array contains:::' . PHP_EOL;
    print_r($videos);

    echo json_encode($videos);
}


?>


                <?php

                //new script

                //using data2

                $a = 1;

                $b = count($videos);

                if ($b == 0){

                    ?>

                    <div class="d-flex flex-row flex-wrap align-items-stretch mt-1 pt-0 px-0 text-white">
                        <span class=" mt-3 mb-6 h6">No videos match your criteria.  Please reset your filters above.</span>
                </div>
<?php
                }

                foreach ($videos as $key=>$value){

                    

                    //make the html for the cards (in groups of +10)

                    if ($a == 1){

                        ?>

                        <div class="d-flex flex-row flex-wrap align-items-stretch mt-1 pt-0 px-0 text-white">
                    <?php }
                    if ($a < $loadedRequiredProduct){

                    
                    
?>          
                
                <div class="card mr-md-4 individualVideo flex-even">
                <div class="card-header" style="height:175px;">
                    <div class="row align-items-right my-0">
                        <div class="col-12 my-0 pr-0">
                            <div class="actions text-right">
                                <a class="action-item action-favorite" data-toggle="tooltip" data-original-title="Mark as favorite" data="<?php echo $value['id'];?>">
                                    <i class="fas fa-heart <?php if ($usersFavouriteVideo->matchRecord2way($userid, $value['id']) === true){echo 'gieqsGold';}else{echo 'text-muted';}?>"></i>
                                </a>
                               
                            
                                <a class="action-item action-like active" data-toggle="tooltip" data-original-title="Like" data="<?php echo $value['id'];?>">
                                    <i class="fas fa-thumbs-up <?php if ($usersLikeVideo->matchRecord2way($userid, $value['id']) === true){echo 'gieqsGold';}else{echo 'text-muted';}?>"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center text-break">
                        <div class="col-12 text-break">
                            <h5 class="card-title mb-0 w-100"><?php echo $value['name']; ?></h5>
                            <p class=" text-muted text-sm mt-1 mb-0 align-self-baseline">Author : <a class="text-muted" target="_blank" href="<?php echo BASE_URL;?>/pages/learning/pages/account/public-profile.php?id=<?php echo $value['author'];?>"><?php echo $user->getUserName($value['author']); ?></a></p>
                            <div class="d-flex flex-row-reverse">
                            <span class="badge bg-info p-1"><?php echo $navigator->getVideoType($value['id']);?></span>
                    </div>

                        </div>
                    </div>
                    
                </div>
                <a href="<?php echo BASE_URL . '/pages/learning/viewer.php?id=' . $value['id'] . '&referid=' . $data['referringUrl']; ?>">
                <img alt="video image" src="<?php echo $value['thumbnail']; ?>" class="img-fluid mt-2">
            </a>

                <div class="card-body">
                    <p class="card-text"><?php echo $value['description']; ?></p>
                </div>
                <div class="card-footer">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <a href="<?php echo BASE_URL . '/pages/learning/viewer.php?id=' . $value['id'] . '&referid=' . $data['referringUrl']; ?>" class="btn btn-sm text-white gieqsGoldBackground">View</a>
                        </div>
                        <div class="col-6 text-right">
                            <span class="text-muted text-sm"><?php echo time_elapsed_string($value['created']);?></span>
                        </div>
                    </div>
                </div>
                </div>
                   






<?php
                    }

                    if ($a % 3 == 0){
                        ?>
                        </div>
                        <div class="d-flex flex-row flex-wrap align-items-stretch mt-1 pt-0 px-0 text-white">

                        <?php
                    }

                    $a++;

                }

                if ($b > $loadedRequiredProduct - 1){

                    ?>

                </div>
                <div class="d-flex flex-row-reverse flex-wrap mt-1 pb-6 pt-0 px-0 text-white">

                            <button class="align-self-end btn btn-sm text-white gieqsGoldBackground" id="loadMore">Load more videos..</button>


                    <?php

                }

                if ($b == 1){

                    ?>
                    <div class="d-flex flex-row flex-wrap card-placeholder align-items-stretch mt-1 pt-0 px-0 text-white">
                    </div>
                    <div class="d-flex flex-row flex-wrap card-placeholder align-items-stretch mt-1 pt-0 px-0 text-white">
                    </div>
                    <?php

                }

                if ($b == 2){

                    ?>
                    <div class="d-flex flex-row flex-wrap card-placeholder align-items-stretch mt-1 pt-0 px-0 text-white">
                    </div>
                    <?php

                }

?>
