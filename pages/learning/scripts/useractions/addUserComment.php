<?php 

$openaccess = 1;

//$requiredUserLevel = 4;

require ('../../includes/config.inc.php');	

require (BASE_URI . '/assets/scripts/login_functions.php');
     
     //place to redirect the user if not allowed access
     $location = BASE_URL . '/index.php';
 
     if (!($dbc)){
     require(DB);
     }
    
     
     require(BASE_URI . '/assets/scripts/interpretUserAccess.php');

$debug = true;

//require (BASE_URI.'/scripts/headerCreatorV2.php');

//(1);
//require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/esd/scripts/headerCreator.php');




spl_autoload_unregister ('class_loader');

//$users = new users; //must be users from GIEQs
require(BASE_URI .'/assets/scripts/classes/users.class.php');
$users = new users;

spl_autoload_register ('class_loader');

$general = new general;
$usersCommentsVideo = new usersCommentsVideo;


$data = json_decode(file_get_contents('php://input'), true);

$videoid = $data['videoid'];
$type = $data['type'];
$comment = $data['comment'];

if ($debug){
print_r($videoid);
print_r($comment);
echo '$userid is ' . $userid;
}


if ($users->matchRecord($userid)){

    $users->Load_from_key($userid); //this is checking securely against the db for the logged in user

    if ($type == 1){

        if ($debug){
            echo 'into 1';
           }

        //register like

        $usersCommentsVideo->setuser_id($userid);
        $usersCommentsVideo->setvideo_id($videoid);
        $usersCommentsVideo->setcomment($comment);
        $result = $usersCommentsVideo->prepareStatementPDO();
        if ($result > 1){

            echo 1;
        }
        
        if ($debug){
         print_r($result);
        }

    }else if ($type == 2){

        //remove like

        if ($debug){

            echo 'delete triggered';
        }

        //TODO IMPLEMENT DELETE
        //$q = "DELETE FROM `usersLikeVideo` WHERE `user_id` = '$userid'";
        /* $result = $usersLikeVideo->deleteLink($userid, $videoid);
        if ($result){
            
         echo '1'; */

        



    }else if ($type == 3){

        
        


    }

    

}else{
    if ($debug){
        echo 'Unknown user';
       }
    
    exit();
}

$users->endusers();
$usersCommentsVideo->endusersCommentsVideo();