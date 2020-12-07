<?php
/*
 * Author: David Tate  - www.gieqs.com
 *
 * Create Date: 1-06-2020
 *
 * DJT 2019
 *
 * License: LGPL
 *
 */

//error_reporting(E_ALL);
if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
    session_start(); //do this
}

if ($_SESSION['debug'] == true){

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

}else{

error_reporting(0);
	
}


require_once 'DataBaseMysqlPDO.class.php';

Class userFunctions {

	
	private $connection;

	public function __construct(){
		$this->connection = new DataBaseMysqlPDO();
	}

    
    public function userExists($email){

        $q = "SELECT `email` FROM `users` WHERE `email` = '$email'";

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){
				return TRUE;
			}else{
				return FALSE;
			}


	}
	
	public function userExistsid($id){

        $q = "SELECT `user_id` FROM `users` WHERE `user_id` = '$id'";

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){
				return TRUE;
			}else{
				return FALSE;
			}


    }

    public function getUserFromKey($key){

        $q = "SELECT `user_id` FROM `users` WHERE `key` = '$key'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $userid = $row['user_id'];
                }

				return $userid;
			}else{
				return FALSE;
			}


	}

	public function getUserKey($userid){

        $q = "SELECT `key` FROM `users` WHERE `user_id` = '$userid'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $key = $row['key'];
                }

				return $key;
			}else{
				return FALSE;
			}


	}

	public function generateNewKey($userid){

        $q = "UPDATE `users` SET `key` = '{$this->generateRandomString(9)}' WHERE `user_id` = '$userid'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		
			if ($result){

                

				return TRUE;
			}else{
				return FALSE;
			}


	}
	
	public function getUserInitials($user_id){

        $q = "SELECT `firstname`, `surname` FROM `users` WHERE `user_id` = '$user_id'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

					$firstname = $row['firstname'];
					$surname = $row['surname'];
				}
				
				$first_letter_firstname = substr($firstname, 0, 1);
				$first_letter_surname = substr($surname, 0, 1);



				return $first_letter_firstname . $first_letter_surname;
			}else{
				return FALSE;
			}


	}
	
	public function getUserName($user_id){

        $q = "SELECT `firstname`, `surname` FROM `users` WHERE `user_id` = '$user_id'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

					$firstname = $row['firstname'];
					$surname = $row['surname'];
				}
				
				



				return $firstname . ' ' . $surname;
			}else{
				return FALSE;
			}


    }

    public function getUserFromEmail($email){

        $q = "SELECT `user_id` FROM `users` WHERE `email` = '$email'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $userid = $row['user_id'];
                }

				return $userid;
			}else{
				return FALSE;
			}


    }

    public function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function getEmailListKey ($email){

		$q = "SELECT `id` FROM `emailList` WHERE `email` = '$email'";
        //echo $q;

        $result = $this->connection->RunQuery($q);
		$nRows = $result->rowCount();
			if ($nRows == 1){

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $userid = $row['id'];
                }

				return $userid;
			}else{
				return FALSE;
			}


	}

	public function getAllEmailsFaculty(){
		$q = "Select `id`, `firstname`, `surname`, `email`, `title` from `faculty`";
				$result = $this->connection->RunQuery($q);
									$rowReturn = array();
								$x = 0;
								$nRows = $result->rowCount();
								if ($nRows > 0){
		
							while($row = $result->fetch(PDO::FETCH_ASSOC)){
					
					$rowReturn[$x]['id'] = $row["id"];
					$rowReturn[$x]['title'] = $row["title"];

					$rowReturn[$x]['firstname'] = $row["firstname"];
					$rowReturn[$x]['surname'] = $row["surname"];
					$rowReturn[$x]['email'] = $row["email"];

				$x++;		}return $rowReturn;}
		
					else{return FALSE;
					}
					
			}

			public function isSuperuser ($userid){
		
				$q = "SELECT `access_level` FROM `users` WHERE `user_id` = $userid";
				
				$result = $this->connection->RunQuery($q);

				$nRows = $result->rowCount();

				if ($nRows == 1){
				
					while($row = $result->fetch(PDO::FETCH_ASSOC)){

						$access_level = $row['access_level'];
		
		
					}

					if ($access_level == 1){

						return true;
					}else{

						return false;
					}

				}else{

					return false;
				}
				
				
				
			}

			public function isStaff ($userid){
		
				$q = "SELECT `access_level` FROM `users` WHERE `user_id` = $userid";
				
				$result = $this->connection->RunQuery($q);

				$nRows = $result->rowCount();

				if ($nRows == 1){
				
					while($row = $result->fetch(PDO::FETCH_ASSOC)){

						$access_level = $row['access_level'];
		
		
					}

					if ($access_level < 4){

						return true;
					}else{

						return false;
					}

				}else{

					return false;
				}
				
				
				
			}

	public function recentUserLogin($userid){

		//if superuser return ok

		

		//if the user has had activity within 15 minutes deny second attempt
		//unless logged out (logout in sessionid)

		$date = new DateTime('now', new DateTimeZone('UTC'));

		//15 mins ago

		$date->sub(new DateInterval('PT15M'));


		$sqltimestamp = date_format($date, 'Y-m-d H:i:s');
		//15 mins ago


		//$q = "SELECT count(`id`) as `count` FROM `userActivity` WHERE `user_id` = '$userid' AND `activity_time` > '$sqltimestamp' AND `session_id` <> '99'";
		$q = "SELECT count(`id`) as `count` FROM `userActivity` WHERE `user_id` = '$userid' AND `activity_time` > '$sqltimestamp'";

		//echo $q;

		$result = $this->connection->RunQuery($q);

						
			$nRows = $result->rowCount();

			while($row = $result->fetch(PDO::FETCH_ASSOC)){

				$count = $row['count'];


			}

			//echo $count;
			
			if ($count > 0){

				//$q2 = "SELECT count(`id`) as `count` FROM `userActivity` WHERE `user_id` = '$userid' AND `activity_time` > '$sqltimestamp' AND `session_id` = '99'";
				$q2 = "SELECT `session_id` FROM `userActivity` WHERE `user_id` = '$userid' AND `activity_time` > '$sqltimestamp' ORDER BY `activity_time` DESC, `id` DESC LIMIT 1";
				//echo $q2;

				$result2 = $this->connection->RunQuery($q2);

				$nRows2 = $result2->rowCount();
			
				if ($nRows2 > 0){

					while($row = $result2->fetch(PDO::FETCH_ASSOC)){

						$sessionid = $row['session_id'];


					}

					if ($this->isStaff($userid)){

						return true;  //staff yes or no
						
			
					}else if ($sessionid == 99){

						return true; //allow login due to last action logout

					}else{

						return false; //deny login
					}

				}else{

					return false; // deny login


				}

			}else{

				return true; // allow login
			}


	}

	public function resetUserLast15($userid){

		//STAFF FUNCTION TO RESET USER ACCESS
		
		//unless logged out (logout in sessionid)

		$date = new DateTime('now', new DateTimeZone('UTC'));

		//15 mins ago

		$date->sub(new DateInterval('PT15M'));


		$sqltimestamp = date_format($date, 'Y-m-d H:i:s');
		//15 mins ago


		//$q = "SELECT count(`id`) as `count` FROM `userActivity` WHERE `user_id` = '$userid' AND `activity_time` > '$sqltimestamp' AND `session_id` <> '99'";
		$q = "DELETE FROM `userActivity` WHERE `user_id` = '$userid' AND `activity_time` > '$sqltimestamp'";

		//echo $q;

		$result = $this->connection->RunQuery($q);

			
		if ($result){

			echo 'There were ' . $result->rowCount() . ' entries deleted for login.  Ask the user to try logging in again';
		}
			

	}

	//update user registrations functions

	public function checkCombinationUserProgramme($userid, $programmeid)
            {
            

            $q = "Select a.`id`
            FROM `userRegistrations` as a
            WHERE `user_id` = '$userid' AND `programme_id` = '$programmeid'
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                return true;

            } else {
                

                return false;
            }

		}
		
		public function returnCombinationUserProgramme($userid)
            {
            

            $q = "Select a.`id`, a.`programme_id`
            FROM `userRegistrations` as a
            WHERE a.`user_id` = '$userid'
            ";

            echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row;


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}
		
		

		public function returnProgrammesUser($userid)
            {
            

            $q = "Select a.`programme_id`
            FROM `userRegistrations` as a
			WHERE a.`user_id` = '$userid'
            ";

            //echo $q . '<br><br>';

			$rowReturn = [];

            $result = $this->connection->RunQuery($q);
            
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row['programme_id'];


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}

		public function generateUserRegistrationOptions()
            {
            

            $q = "Select a.`id`, a.`title`, a.`date`
            FROM `programme` as a
            ";

            //echo $q . '<br><br>';

			$rowReturn = [];

            $result = $this->connection->RunQuery($q);
            
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row;


				}

				foreach ($rowReturn as $key=>$value){

					echo "<option value='{$value['id']}'>{$value['date']} {$value['title']}</option>";

				}

            } else {
                

                return false;
            }

		}

		


		public function generateTagStructure()
            {
            

			$q = "SELECT a.`tagCategories_id` as `Category id`, a.`tagCategories_id`, a.`id`, a.`tagName` as `Tag` from `tags` as a WHERE a.`tagCategories_id` > 46 ORDER BY tagCategories_id, a.`id` ASC";


            //echo $q . '<br><br>';

			$rowReturn = [];

            $result = $this->connection->RunQuery($q);
            
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row;


				}

				foreach ($rowReturn as $key=>$value){

					echo "<option value='{$value['id']}'>{$value['tagCategories_id']} {$value['tagName']}</option>";

				}

            } else {
                

                return false;
            }

		}
		
		public function returnProgrammeDenominatorSelect2()
            {
            

				$q = "Select `id` FROM `programme`";
  
			

            //echo $q . '<br><br>';

			$rowReturn = [];

            $result = $this->connection->RunQuery($q);
            
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row['id'];


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}
		
		public function enrolmentPatternLive($userid){

			
            

				$q = "Select a.`programme_id`
				FROM `userRegistrations` as a
				WHERE a.`user_id` = '$userid'
				";
	
				//echo $q . '<br><br>';
	
				$rowReturn = [];
	
				$result = $this->connection->RunQuery($q);
				
				$x = 0;
				$nRows = $result->rowCount();
	
				if ($nRows > 0) {
	
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
	
						$rowReturn[] = $row['programme_id'];
	
	
					}
	
					return $rowReturn;
	
				} else {
					
	
					return false;
				}

		}

		public function generateUserNames()
            {
            

            $q = "Select a.`user_id`, a.`firstname`, a.`surname`
            FROM `users` as a
            ";

            //echo $q . '<br><br>';

			$rowReturn = [];

            $result = $this->connection->RunQuery($q);
            
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row;


				}

				foreach ($rowReturn as $key=>$value){

					echo "<option value='{$value['user_id']}'>{$value['firstname']} {$value['surname']}</option>";

				}

            } else {
                

                return false;
            }

		}


		public function getMailListServices()
            {
            

            $q = "SELECT `user_id` FROM `users` WHERE `emailServices` = '1' OR `emailServices` IS NULL";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row['user_id'];
					


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}

		public function getMailListAll()
            {
            

            $q = "SELECT `user_id` FROM `users`";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row['user_id'];
					


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}

		public function getMailListAlreadyMailed($email_id)
            {
            

            $q = "SELECT `user_id` FROM `user_email` WHERE `email_id` = '$email_id' GROUP BY `user_id`";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row['user_id'];
					


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}

		public function getMailListServicesLink()
            {
			
				/* 
				
				only user id with match
				SELECT b.`email_id` FROM `users` as a RIGHT OUTER JOIN `user_email` as b on a.`user_id` = b.`user_id` LIMIT 20

				only user id without match


				*/

            $q = "SELECT a.`user_id`, a.`emailServices`, b.`email_id` FROM `users` as a LEFT JOIN `user_email` as b on a.`user_id` = b.`user_id` AND b.`email_id` <> 'first_teaser' WHERE (a.`emailServices` = '1' OR a.`emailServices` IS NULL) LIMIT 20";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					$rowReturn[] = $row['user_id'];
					


				}

				return $rowReturn;

            } else {
                

                return false;
            }

		}

		public function printUserEmailsConsent1()
            {
            

            $q = "SELECT CONCAT(`email` , '; ') AS `emailString` FROM `users` WHERE `emailAccount` = '1' OR `emailAccount` IS NULL LIMIT 250";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					echo $row['emailString'] . ' ';


				}

				//return $rowReturn;

            } else {
                

                return false;
            }

		}
		public function printUserEmailsConsent2()
            {
            

            $q = "SELECT CONCAT(`email` , '; ') AS `emailString` FROM `users` WHERE `emailAccount` = '1' OR `emailAccount` IS NULL LIMIT 250, 250";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					echo $row['emailString'] . ' ';


				}

				//return $rowReturn;

            } else {
                

                return false;
            }

		}
		public function printUserEmailsConsent3()
            {
            

            $q = "SELECT CONCAT(`email` , '; ') AS `emailString` FROM `users` WHERE `emailAccount` = '1' OR `emailAccount` IS NULL LIMIT 500, 250";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while($row = $result->fetch(PDO::FETCH_ASSOC)){

					echo $row['emailString'] . ' ';


				}

				//return $rowReturn;

            } else {
                

                return false;
            }

		}

		public function select2_user_match($search)
    {
    
    $q = "Select 
    `user_id`, CONCAT(`firstname`, ' ', `surname`) as `name`
    FROM `users`
    WHERE `user_id` = '$search'";

    $result = $this->connection->RunQuery($q);
    $rowReturn = array();
    $x = 0;
    $nRows = $result->rowCount();
    if ($nRows > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

          
              //note here returning an option only
            $rowReturn = array('id' => $row['user_id'], 'text' => $row['name']);
            //print_r($row);
        }
    
        return json_encode($rowReturn);

    } else {
        

        //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
        $rowReturn['result'] = [];
        
        return json_encode($rowReturn);
    }

}

		public function select2_all_users($search)
      {
      
      $q = "Select 
      `user_id`, CONCAT(`user_id`, ' - ', `firstname`, ' ', `surname`) as `video`
      FROM `users`
      WHERE lower(CONCAT(`user_id`, ' - ', `firstname`, ' ', `surname`)) LIKE lower('%{$search}%')";

      //echo $q;

      $result = $this->connection->RunQuery($q);
      $rowReturn['results'] = array();
      $x = 0;
      $nRows = $result->rowCount();
      if ($nRows > 0) {

          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $rowReturn['results'][] = array('id' => $row['user_id'], 'text' => $row['video']);
              //print_r($row);
          }
      
          return json_encode($rowReturn);

      } else {
          

          //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
          $rowReturn['results'] = [];
          
          return json_encode($rowReturn);
      }

  }

public function sanitiseGET ($data) {

    $dataSanitised = array();

    foreach ($data as $key=>$value){

        $sanitisedValue = trim($value);
        //$sanitisedValue = addslashes($sanitisedValue);
        //$sanitisedValue = htmlspecialchars($sanitisedValue);
        //consider htmlentitydecode here, this converts back so &amp to &, special chars & to &amp 
        $dataSanitised[$key] = $sanitisedValue;

    }


    return $dataSanitised;


}


	

    /**
     * Close mysql connection
     */
	public function enduserFunctions(){
		$this->connection->CloseMysql();
	}

}