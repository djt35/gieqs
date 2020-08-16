<?php

require_once 'DataBaseMysql.class.php';



//spl_autoload_unregister ('class_loader');
		
		//require('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/autoload.php');
		//use Vimeo\Vimeo;

class navigator {


	public $connection;

	public function __construct (){
		$this->connection = new DataBaseMysql();
	}

	//!Sanitise form input and other important functions

	//array version
	public function generateNavigation($categories){

		//echo 'hello';

		//get the tags from the required categories
		$query_where = "";
		$howManyCategories = count($categories);

		$x=1;

		foreach ($categories as $key=>$value){

			$query_where .= "e.`id` = '$value'";
			
			if ($x < $howManyCategories){
			$query_where .= " OR ";
			}

			$x++;

		}

		//echo $query_where;


		$q = "SELECT a.`id`, a.`split`, b.`id` as `chapterid`, b.`timeFrom`, b.`timeTo`, b.`number`, b.`name` AS `chaptername`, b.`description`, d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` WHERE $query_where GROUP BY d.`tagName` ORDER BY d.`tagName` ASC ";

		$result = $this->connection->RunQuery($q);

		//echo $q;

		$tags = [];

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = ['id' => $row['tagid'], 'name' => $row['tagName']];


			}

			


		}

		//print_r($tags);

	}

	//single number tag version

	public function generateNavigationSingle($categories, $active='1'){ //USED TO GENERATE THE BOX AT THE TOP 

		
		
		//get the tags from the required categories
		


		$q = "SELECT a.`id`, a.`name`, b.`id` as `chapterid`, b.`timeFrom`, b.`timeTo`, b.`number`, b.`name` AS `chaptername`, b.`description`, d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` WHERE (e.`id` = '$categories') AND (a.`id` IS NOT NULL) AND (a.`active` = '$active') GROUP BY d.`tagName` ORDER BY d.`id` ASC ";

		$result = $this->connection->RunQuery($q);

		//echo $q;

		$tags = [];

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = ['id' => $row['tagid'], 'name' => $row['tagName']];


			}

			


		}

		return $tags;

	}

	public function generateNavigationSingleDisabledQuery($categories, $tagsRequired, $debug, $active='1'){ //USED TO GENERATE THE VIDEOS THAT MATCH THE SELECTED TAGS

		if ($debug){
			echo '<br/><br/>';
			echo 'Function getVideoData inputs:';
			
			echo '<br/><br/>tagsRequired : ';
			print_r($tagsRequired);
			echo '<br/><br/> Categories : ';
			print_r($categories);
			echo '<br/><br/>';
		}

		//get the tags from the required categories
		if ($tagsRequired){
			
			$howManyCategories = count($tagsRequired);

			$howManyTagCategories = count($categories);
	
			$x=1;
			$y=1;

			$query_where .= "WHERE (a.`active` = '$active') AND ";

			foreach ($categories as $key=>$value){

				if ($y == 1 AND $y == $howManyTagCategories){

					$query_where .= "(e.`id` = '$value') ";

				}
				
				else if ($y == 1 AND $y < $howManyTagCategories){

				$query_where .= "(e.`id` = '$value' OR ";

				}else if ($y == $howManyTagCategories){

					$query_where .= "e.`id` = '$value') ";
					
				}else{

					$query_where .= "e.`id` = '$value' OR ";

				}

				$y++;

			}

			$query_where .= ' AND ';
	
			foreach ($tagsRequired as $key=>$value){
	
				if ($x == 1 AND $x == $howManyCategories){

					$query_where .= "(d.`id` = '$value') ";
					

				}

				else if ($x == 1){

					$query_where .= "(d.`id` = '$value' OR ";
	
					}else if ($x == $howManyCategories){
	
						$query_where .= "d.`id` = '$value') ";
						
					}else{
	
						$query_where .= "d.`id` = '$value' OR ";
	
					}
	
					$x++;
	
			}

			$query_where .= "GROUP BY a.`id` HAVING COUNT(DISTINCT d.`id`) = $howManyCategories ORDER BY a.`created` DESC";

			//$query_where .= ')';
	
			//echo query_where;

		}else{


			$howManyTagCategories = count($categories);
	
			$y=1;

			$query_where .= "WHERE (a.`active` = '$active') AND ";

			foreach ($categories as $key=>$value){

				if ($y == 1){

				$query_where .= "(e.`id` = '$value' OR ";

				}else if ($y == $howManyTagCategories){

					$query_where .= "e.`id` = '$value') ";
					
				}else{

					$query_where .= "e.`id` = '$value' OR ";

				}

				$y++;

			}

			$query_where .= "GROUP BY a.`id` ORDER BY a.`created` DESC";

			

		}

		//currently order by most recent

		$r = "SELECT DISTINCT a.* FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` $query_where ORDER BY a.`created` DESC";

		$q = "SELECT DISTINCT
		a.*,
		d.`id` AS `tagid`,
		e.`id` AS `tagCategories_id`
			FROM
				`video` AS a
			INNER JOIN `chapter` AS b
			ON
				a.`id` = b.`video_id`
			INNER JOIN `chapterTag` AS c
			ON
				b.`id` = c.`chapter_id`
			INNER JOIN `tags` AS d
			ON
				d.`id` = c.`tags_id`
			INNER JOIN `tagCategories` AS e
			ON
				d.`tagCategories_id` = e.`id` $query_where";


		$result = $this->connection->RunQuery($q);
	
		if ($debug){
			echo $q;
			echo '<br/><br/>';
		}

		$tags = [];
		$y=0;

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[$y] = $row['id'];
				$y++;

			}

			


		}

		

		return $tags; //this gives videos matching the requested tags 
		//but we want other tags in the remaining videos

	}


	public function getVideoType ($videoid){

		$q = "SELECT d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` WHERE a.`id` = '$videoid' AND e.`id` = '62' GROUP BY d.`id` ORDER BY d.`tagName` ASC ";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		$tags = [];
		$y=1;

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$type = $row['tagName'];
				


			}

			


		}

		echo $type;


	}

	

	public function getVideoTypeid ($videoid){

		$q = "SELECT d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` WHERE a.`id` = '$videoid' AND e.`id` = '62' GROUP BY d.`id` ORDER BY d.`tagName` ASC ";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		$tags = [];
		$y=1;

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$type = $row['tagid'];
				


			}

			


		}

		echo $type;


	}

	public function getVideoTypeidv2 ($videoid){

		$q = "SELECT d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` WHERE a.`id` = '$videoid' AND e.`id` = '62' GROUP BY d.`id` ORDER BY d.`tagName` ASC ";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		$tags = [];
		$y=1;

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$type = $row['tagid'];
				


			}

			


		}

		if ($type == 255){ // endoscopic video only

			echo '<i class="fas fa-film" data-toggle="tooltip" data-placement="bottom" title="endoscopic video"></i>';
		}elseif ($type == 256){ //endoscopic video and audio narration

			echo '<i class="fas fa-film" data-toggle="tooltip" data-placement="bottom" title="endoscopic video"></i>';echo '<i class="fas fa-volume-up" data-toggle="tooltip" data-placement="bottom" title="audio narration"></i>';
		}elseif ($type == 257){ //endoscopic video room video with audio

			echo '<i class="fas fa-film" data-toggle="tooltip" data-placement="bottom" title="endoscopic video"></i>';echo '<i class="fas fa-user-md" data-toggle="tooltip" data-placement="bottom" title="room view of endoscopist"></i>';

		}elseif ($type == 258){ //lecture with audio
			echo '<i class="fas fa-chalkboard-teacher" data-toggle="tooltip" data-placement="bottom" title="lecture"></i>';echo '<i class="fas fa-volume-up" data-toggle="tooltip" data-placement="bottom" title="audio narration"></i>';

		}elseif ($type == 462){ //endoscopic video room video with audio plus trainee

			echo '<i class="fas fa-film" data-toggle="tooltip" data-placement="bottom" title="endoscopic video"></i>';echo '<i class="fas fa-user-md" data-toggle="tooltip" data-placement="bottom" title="room view of endoscopist"></i>'; echo '<i class="fas fa-chalkboard-teacher" data-toggle="tooltip" data-placement="bottom" title="with trainee"></i>';

		}


	}

	public function getVideoTagsBasedOnVideosShown($videos1, $debug){

		/* $videos1 = [];

		$x=0;

		foreach ($videos as $key=>$value){

			$videos1[$x] = $value['id'];
			$x++;

			//get all tags associated with this video


		} */

		//print_r($videos1);

		if ($debug){
			echo '<br/><br/>';
			echo 'Function getVideoTagsBasedOnVideosShown inputs:';
			
			echo '<br/><br/>videos1 : ';
			print_r($videos1);
			
			echo '<br/><br/>';
		}

		$query_where = "";
			$howManyCategories = count($videos1);
	
			$x=1;

			$query_where .= "(";
	
			foreach ($videos1 as $key=>$value){
	
				$query_where .= " a.`id` = '$value' ";
				
				if ($x < $howManyCategories){
				$query_where .= " OR ";
				}
	
				$x++;
	
			}

			$query_where .= ")";
	
			if ($debug){
				
				echo PHP_EOL;
				echo $query_where;
				echo PHP_EOL;

			}

		$q = "SELECT d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` WHERE $query_where GROUP BY d.`id` ORDER BY d.`tagName` ASC ";

		$result = $this->connection->RunQuery($q);
			if ($debug){
				echo $q;
			}

		$tags = [];
		$y=1;

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = $row['tagid'];
				


			}

			


		}

		return $tags;


		

	}

	public function getVideoData($categories, $tagsRequired, $debug, $active='1'){

		if ($debug){
			echo '<br/><br/>';
			echo 'Function getVideoData inputs:';
			
			echo '<br/><br/>tagsRequired : ';
			print_r($tagsRequired);
			echo '<br/><br/> Categories : ';
			print_r($categories);
			echo '<br/><br/>';
		}

		//get the tags from the required categories
		if ($tagsRequired){
			
			$howManyCategories = count($tagsRequired);

			$howManyTagCategories = count($categories);
	
			$x=1;
			$y=1;

			$query_where .= "WHERE (a.`active` = '$active') AND ";

			foreach ($categories as $key=>$value){

				if ($y == 1 AND $y == $howManyTagCategories){

					$query_where .= "(e.`id` = '$value') ";

				}
				
				else if ($y == 1 AND $y < $howManyTagCategories){

				$query_where .= "(e.`id` = '$value' OR ";

				}else if ($y == $howManyTagCategories){

					$query_where .= "e.`id` = '$value') ";
					
				}else{

					$query_where .= "e.`id` = '$value' OR ";

				}

				$y++;

			}

			$query_where .= ' AND ';
	
			foreach ($tagsRequired as $key=>$value){
	
				if ($x == 1 AND $x == $howManyCategories){

					$query_where .= "(d.`id` = '$value') ";
					

				}

				else if ($x == 1){

					$query_where .= "(d.`id` = '$value' OR ";
	
					}else if ($x == $howManyCategories){
	
						$query_where .= "d.`id` = '$value') ";
						
					}else{
	
						$query_where .= "d.`id` = '$value' OR ";
	
					}
	
					$x++;
	
			}

			$query_where .= "GROUP BY a.`id` HAVING COUNT(DISTINCT d.`id`) = $howManyCategories ORDER BY a.`created` DESC";

			//$query_where .= ')';
	
			//echo query_where;

		}else{


			$howManyTagCategories = count($categories);
	
			$y=1;

			$query_where .= "WHERE (a.`active` = '$active') AND ";

			foreach ($categories as $key=>$value){

				if ($y == 1){

				$query_where .= "(e.`id` = '$value' OR ";

				}else if ($y == $howManyTagCategories){

					$query_where .= "e.`id` = '$value') ";
					
				}else{

					$query_where .= "e.`id` = '$value' OR ";

				}

				$y++;

			}

			$query_where .= "GROUP BY a.`id` ORDER BY a.`created` DESC";

			

		}

		//currently order by most recent

		$r = "SELECT DISTINCT a.* FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` $query_where ORDER BY a.`created` DESC";

		$q = "SELECT DISTINCT
		a.*,
		d.`id` AS `tagid`,
		e.`id` AS `tagCategories_id`
			FROM
				`video` AS a
			INNER JOIN `chapter` AS b
			ON
				a.`id` = b.`video_id`
			INNER JOIN `chapterTag` AS c
			ON
				b.`id` = c.`chapter_id`
			INNER JOIN `tags` AS d
			ON
				d.`id` = c.`tags_id`
			INNER JOIN `tagCategories` AS e
			ON
				d.`tagCategories_id` = e.`id` $query_where";


		$result = $this->connection->RunQuery($q);
	
		if ($debug){
			echo $q;
			echo '<br/><br/>';
		}

		$tags = [];

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = $row;


			}

			


		}

		

		return $tags; //this gives videos matching the requested tags 
		//but we want other tags in the remaining videos

	}

	public function getVideoDataSimple($requiredVideos, $debug, $active='1'){

		if ($debug){
			echo '<br/><br/>';
			echo 'Function getVideoData inputs:';
			
			echo '<br/><br/>videos Required : ';
			print_r($requiredVideos);
			echo '<br/><br/> Categories : ';
			print_r($categories);
			echo '<br/><br/>';
		}

		//get the tags from the required categories
		


			$howManyTagCategories = count($requiredVideos);
	
			$y=1;

			$query_where .= "WHERE (a.`active` = '$active') AND ";

			foreach ($requiredVideos as $key=>$value){

				if ($howManyTagCategories == 1){

					$query_where .= "(a.`id` = '$value') ";
					break;

				}
				
				if ($y == 1){

				$query_where .= "(a.`id` = '$value' OR ";

				}else if ($y == $howManyTagCategories){

					$query_where .= "a.`id` = '$value') ";
					
				}else{

					$query_where .= "a.`id` = '$value' OR ";

				}

				$y++;

			}

			$queryString = implode(', ', $requiredVideos);

			$query_where .= "ORDER BY field(a.`id`, $queryString)";

			

		

		//currently order by most recent

		$r = "SELECT DISTINCT a.* FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` $query_where ORDER BY a.`created` DESC";

		$q = "SELECT
		a.*
		
			FROM
				`video` AS a
			 $query_where";


		$result = $this->connection->RunQuery($q);
	
		if ($debug){
			echo $q;
			echo '<br/><br/>';
		}

		$tags = [];

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = $row;


			}

			


		}

		

		return $tags; //this gives videos matching the requested tags 
		//but we want other tags in the remaining videos

	}

	public function getVideoDataOLD($categories, $tagsRequired, $debug){

		

		//get the tags from the required categories
		if ($tagsRequired){
			
			$howManyCategories = count($tagsRequired);
	
			$x=1;

			$query_where .= 'WHERE ';
	
			foreach ($tagsRequired as $key=>$value){
	
				$query_where .= "(e.`id` = '$categories' AND d.`id` = '$value')";
				
				if ($x < $howManyCategories){
				$query_where .= " OR ";
				}
	
				$x++;
	
			}

			//$query_where .= ')';
	
			//echo query_where;;
		}else{

			$query_where = "WHERE e.`id` = '$categories'";

		}

		//currently order by most recent

		$q = "SELECT DISTINCT a.* FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` $query_where ORDER BY a.`created` DESC";

		$result = $this->connection->RunQuery($q);
	
		if ($debug){
			echo $q;
			echo '<br/><br/>';
		}

		$tags = [];

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = $row;


			}

			


		}

		

		return $tags; //this gives videos matching the requested tags 
		//but we want other tags in the remaining videos

	}

	public function generateNavigationSingleDisabledQueryold($categories, $tagsRequired, $debug){

		if ($debug){
			echo '<br/><br/>';
			echo 'Function getVideoData inputs:';
			
			echo '<br/><br/>tagsRequired : ';
			print_r($tagsRequired);
			echo '<br/><br/> Categories : ';
			print_r($categories);
			echo '<br/><br/>';
		}

		//get the tags from the required categories
		if ($tagsRequired){
			
			$howManyCategories = count($tagsRequired);
	
			$x=1;

			$query_where .= "WHERE (a.`active` = '1') AND ";
	
			foreach ($tagsRequired as $key=>$value){
	
				$query_where .= "(e.`id` = '$categories' AND d.`id` = '$value')";
				
				if ($x < $howManyCategories){
				$query_where .= " OR ";
				}
	
				$x++;
	
			}

			//$query_where .= ')';
	
			//echo query_where;;
		}else{

			$query_where = "WHERE (a.`active` = '1') AND e.`id` = '$categories'";

		}

		$q = "SELECT a.`id` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e ON d.`tagCategories_id` = e.`id` $query_where";

		$result = $this->connection->RunQuery($q);
	
		if ($debug){
			echo $q;

		}

		$tags = [];

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				//echo '<a href="' . $roothttp . '/scripts/display/colontutor/video.php?id=' . $row['tagid'] . '">' . $row['tagName'] . '</a>';

				$tags[] = ['id' => $row['id']];


			}

			


		}

		

		return $tags; //this gives videos matching the requested tags 
		//but we want other tags in the remaining videos

	}

	
	
	public function endNavigator (){

		$this->connection->CloseMysql();


	}
	

}



?>