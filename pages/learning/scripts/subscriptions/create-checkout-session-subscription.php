<?php
$openaccess = 1;

//$requiredUserLevel = 6;


error_reporting(E_ALL);
require_once '../../../../assets/includes/config.inc.php';

error_reporting(E_ALL);

require(BASE_URI . '/assets/scripts/interpretUserAccess.php');

$general = new general;
$users = new users;
$users->Load_from_key($userid);


error_reporting(E_ALL);

require_once(BASE_URI . '/assets/scripts/classes/assetManager.class.php');
$assetManager = new assetManager;



require_once(BASE_URI . '/assets/scripts/classes/assets_paid.class.php');
$assets_paid = new assets_paid;



require_once(BASE_URI . '/assets/scripts/classes/subscriptions.class.php');
$subscription = new subscriptions;


require_once BASE_URI . "/vendor/autoload.php";
error_reporting(E_ALL);

spl_autoload_unregister ('class_loader');
error_reporting(E_ALL);

use Stripe\Stripe;

\Stripe\Stripe::setApiKey('sk_test_51IsKqwEBnLMnXjoguHzjHquozIjRT1Wt5OuLAQqxJvkUvX6DwMebWAPwgXsWaW35r5WXk1m6CuxtkY72I6QNLpH200No1l1SwU');
error_reporting(E_ALL);

header('Content-Type: application/json');
error_reporting(E_ALL);
error_reporting(E_ALL);

$debug = false;

$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);

if (isset($data['subscription_id'])){

    $subscription_id = $data['subscription_id'];


}

if (isset($data['asset_id'])){

    $asset_id = $data['asset_id'];

    if ($debug){

        echo 'asset id set';
    }


}

//if both are set reject

if (isset($subscription_id) && isset($asset_id)){

    if ($debug){

        echo 'both subscription id and asset id set';
    }

    die();
}

if (!isset($subscription_id) && !isset($asset_id)){

    if ($debug){

        echo 'neither subscription id or asset id set';
    }

    die();
}




$YOUR_DOMAIN = BASE_URL;
//echo $YOUR_DOMAIN;
error_reporting(E_ALL);




if (isset($subscription_id)){


    //because this is a renewal
    if ($subscription->Return_row($subscription_id)){
    
        $subscription->Load_from_key($subscription_id);
    
        //if subscription exists
    
        //check the user id is the same as the logged in user
    
        $subscriptionUser = $subscription->getuser_id();
        $activeUser = $userid;
    
        if ($subscriptionUser != $activeUser){
    
            //active user is not the user that owns the subscription
    
            echo 'Permissions Error.  Active user is not the subscription owner';
            die();
    
        }
    
    
        //old subscription
        $subscription_to_return = array();
    
        $subscription_to_return['asset_name'] = $assetManager->getAssetName($subscription_id);
        $subscription_to_return['asset_type'] = $assetManager->getAssetTypeText($assetManager->getAssetType($subscription_id));
        $subscription_to_return['asset_id'] = $assetManager->getAssetid($subscription_id);
    
        $assets_paid->Load_from_key($subscription_to_return['asset_id']);
    
        $subscription_to_return['cost'] = $assets_paid->getcost();
        $subscription_to_return['description'] = $assets_paid->getdescription();
        $subscription_to_return['renew_frequency'] = $assets_paid->getrenew_frequency();
    
        $subscription_to_return['user_id'] = $subscription->getuser_id();
        $subscription_to_return['expiry_date'] = $subscription->getexpiry_date();
    
        //if the old subscription is expired make inactive
    
        $current_date = new DateTime('now', new DateTimeZone('UTC'));
    
        $active = $assetManager->isSubscriptionActive($subscription_id, $current_date, $debug);
    
        if (!$active){
    
            $subscription->setactive('0');
            $subscription->prepareStatementPDOUpdate();
    
    
        }
    
    
    
    
    
        //new subscription
        //ADD THE RENEW FREQUENCY TO THE OLD EXPIRY DATE
        //START DATE NOW
    
        $current_date = new DateTime('now', new DateTimeZone('UTC'));
    
        $current_date_sqltimestamp = date_format($current_date, 'Y-m-d H:i:s');
    
        if ($active){ // if the subscription is still active use the expiry date
    
          $end_date = new DateTime($subscription_to_return['expiry_date'], new DateTimeZone('UTC'));
    
        }else{  //otherwise use the current date
    
            $end_date = new DateTime('now', new DateTimeZone('UTC'));
    
    
        }
    
        $interval = 'P' . $subscription_to_return['renew_frequency'] . 'M';
    
        $end_date->add(new DateInterval($interval));
        
        $end_date_sqltimestamp = date_format($end_date, 'Y-m-d H:i:s');
    
    
        $subscription->New_subscriptions($userid, $subscription_to_return['asset_id'], $current_date_sqltimestamp, $end_date_sqltimestamp, '0', '0', NULL);
    
        $newSubscriptionid = $subscription->prepareStatementPDO();
    
    
        //echo json_encode($subscription_to_return);
        //echo $subscription->getexpiry_date();
    
    
        //json encode the result
    
        //need the description
        //need the cost from subtable
        //need to check that it is ending soon
        //need to set renewal date for new subscription the number of days remaining +

        $stripe_cost = intval($subscription_to_return['cost']) * 100;

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $stripe_cost,
                'product_data' => [
                  'name' => $subscription_to_return['asset_name'],
/*                   'images' => ["https://i.imgur.com/EHyR2nP.png"], */
                ],
              ],
              'quantity' => 1,
            ]],
            'metadata' => [
                'subscription_id' => $newSubscriptionid,

            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/pages/learning/scripts/subscriptions/success_stripe.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . $data['currentPage'] . '&action=register',
          ]);
          
          //print_r($checkout_session);
          
          echo json_encode(['id' => $checkout_session->id]);
    
        
    
    
    
    }else{
    
        if ($debug){
        echo 'Subscription does not exist';
        }
    }
    
    }
    
    if (isset($asset_id)){
    
    //get the required asset data
    
    //old subscription
    $subscription_to_return = array();
    
    $assets_paid->Load_from_key($asset_id);
    
    
    $subscription_to_return['asset_name'] = $assets_paid->getname();
    $subscription_to_return['asset_type'] = $assetManager->getAssetTypeText($assets_paid->getasset_type());
    $subscription_to_return['asset_id'] = $assets_paid->getid();
    
    $subscription_to_return['cost'] = $assets_paid->getcost();
    $subscription_to_return['description'] = $assets_paid->getdescription();
    $subscription_to_return['renew_frequency'] = $assets_paid->getrenew_frequency();
    
    $subscription_to_return['user_id'] = $userid;
    
    //make a new subscription
    
    //new subscription
        //ADD THE RENEW FREQUENCY TO THE DATE TODAY PLUS COURSE DATE
    
    
    
        //START DATE NOW
    
        $current_date = new DateTime('now', new DateTimeZone('UTC'));
    
        $current_date_sqltimestamp = date_format($current_date, 'Y-m-d H:i:s');
    
        if ($users->gettimezone()){
    
            $timezone = $users->gettimezone();
    
        }else{
    
            $timezone = 'UTC';
        }
    
        if (isset($_POST['course_date'])){
    
            $course_date = new DateTime($_POST['course_date'], new DateTimeZone('UTC'));
    
            //$end_start_calculate_date = new DateTime($_POST['course_date'], new DateTimeZone('UTC'));
    
            if ($current_date >= $course_date){
    
                $end_start_calculate_date = new DateTime('now', new DateTimeZone('UTC'));
    
            }else{
    
    
                $end_start_calculate_date = $course_date;
    
            }
    
        }else{
    
            $end_start_calculate_date = new DateTime('now', new DateTimeZone('UTC'));
            
        }
    
       
    
        //$end_date = new DateTime($subscription_to_return['expiry_date'], new DateTimeZone('UTC'));
    
        $interval = 'P' . $subscription_to_return['renew_frequency'] . 'M';
    
        $end_start_calculate_date->add(new DateInterval($interval));

        $trial_start_calculate_date = new DateTime('now', new DateTimeZone('UTC'));

        $trial_start_calculate_date->add(new DateInterval('P15D'));

        
        $end_date_sqltimestamp = date_format($end_start_calculate_date, 'Y-m-d H:i:s');
    
    
        $subscription->New_subscriptions($userid, $subscription_to_return['asset_id'], $current_date_sqltimestamp, $end_date_sqltimestamp, '0', '1', NULL);
    
        $newSubscriptionid = $subscription->prepareStatementPDO();


        $stripe_cost = intval($subscription_to_return['cost']) * 100;

    
    
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price' => 'price_1ItzxQEBnLMnXjogeyFdtHsd',
              'quantity' => 1,
            ]],
            'metadata' => [
                'subscription_id' => $newSubscriptionid,

            ],
            'mode' => 'subscription',
            'success_url' => $YOUR_DOMAIN . '/pages/learning/scripts/subscriptions/success_stripe.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . $data['currentPage'] . '&action=register',
            'subscription_data' => ['trial_end' => date_format($trial_start_calculate_date, 'U')],
          ]);
          
          //print_r($checkout_session);
          
          echo json_encode(['id' => $checkout_session->id]);

          //'description' => $subscription_to_return['asset_name'],


        
    
    
    }else{
    
        if ($debug){
            echo 'Asset does not exist';
            }
    }
    







 