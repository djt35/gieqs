<?php
/*
 * Author: David Tate  - www.endoscopy.wiki
 *
 * Create Date: 26-01-2020
 *
 * DJT 2020
 *
 * License: LGPL
 *
 * programme reports joiner
 * 
 */
require_once 'DataBaseMysqlPDO.class.php';

class programmeReports
{

    

    public function __construct()
    {
        $this->connection = new DataBaseMysqlPDO();
    }

    
    /**
     * 
     * further queries below here
     * 
     */

     /**
      * generate the session View

      */

//TODO get day of week from date

      public function generateReportJSON($facultyid)
            {
            
            $q = "Select a.`id` as `programmeid`, a.`date`, 
            c.`id` as `sessionid`, c.`timeFrom`, c.`timeTo`, c.`title` as `sessionTitle`, c.`subtitle` as `sessionSubtitle`, c.`description` as `sessionDescription`, 
            e.`id` as `sessionItemid`, e.`title` as `sessionItemTitle`, e.`description` as `sessionItemDescription`, e.`faculty`, e.`live` 
            from `programme` as a 
            INNER JOIN `programmeOrder` as b on a.`id` = b.`programmeid` 
            INNER JOIN `session` as c on b.`sessionid` = c.`id` 
            INNER JOIN `sessionOrder` as d on c.`id` = d.`sessionid` 
            INNER JOIN `sessionItem` as e on d.`sessionItemid` = e.`id` 
            INNER JOIN `sessionModerator` as f on c.`id` = f. `sessionid` 
            WHERE e.`faculty` = $facultyid 
            GROUP BY c.`id` 
            ORDER BY a.`date` ASC, c.`timeFrom` ASC
            ";



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $rowReturn['data'][] = array_map('utf8_encode', $row);
                }
            
                return json_encode($rowReturn);

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn['data'] = [];
                
                return json_encode($rowReturn);
            }

        }

        public function generateReport($facultyid)
            {
            
                //report card per faculty
                $q = "Select a.`id` as `programmeid`, a.`date`, 
                c.`timeFrom`, c.`timeTo`, c.`title` as `sessionTitle`,
                e.`title` as `sessionItemTitle`, e.`description` as `sessionItemDescription`, e.`timeFrom` as `sessiontimeFrom`, e.`timeTo` as `sessiontimeTo`, e.`live` 
                from `programme` as a 
                INNER JOIN `programmeOrder` as b on a.`id` = b.`programmeid` 
                INNER JOIN `session` as c on b.`sessionid` = c.`id` 
                INNER JOIN `sessionOrder` as d on c.`id` = d.`sessionid` 
                INNER JOIN `sessionItem` as e on d.`sessionItemid` = e.`id` 
                INNER JOIN `sessionModerator` as f on c.`id` = f. `sessionid` 
                WHERE e.`faculty` = $facultyid 
                GROUP BY c.`id` 
                ORDER BY a.`date` ASC, c.`timeFrom` ASC";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $rowReturn[] = array_map('utf8_encode', $row);
                }
            
                return $rowReturn;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function generateModeratorsForSession($sessionid)
            {
            
                
                $q = "Select c.`title`, c.`firstname`, c.`surname`
            from `session` as a 
            INNER JOIN `sessionModerator` as b on a.`id` = b.`sessionid` 
            INNER JOIN `faculty` as c on b.`facultyid` = c.`id`
            WHERE a.`id` = $sessionid 
            ORDER BY c.`surname` ASC
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $rowReturn[] = array_map('utf8_encode', $row);
                }
            
                return $rowReturn;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function generateSpeakersForSessionAll($sessionid)
            {
            
                
                $q = "Select d.`title`, d.`firstname`, d.`surname`
                from `session` as a 
                INNER JOIN `sessionOrder` as b on a.`id` = b.`sessionid` 
                INNER JOIN `sessionItem` as c on b.`sessionItemid` = c.`id` 
                INNER JOIN `faculty` as d on c.`faculty` = d.`id`
                WHERE a.`id` = $sessionid
                ORDER BY d.`surname` ASC
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $rowReturn[] = array_map('utf8_encode', $row);
                }
            
                return $rowReturn;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function generateSpeakersForSessionLive($sessionid)
            {
            
                
                $q = "Select d.`title`, d.`firstname`, d.`surname`
                from `session` as a 
                INNER JOIN `sessionOrder` as b on a.`id` = b.`sessionid` 
                INNER JOIN `sessionItem` as c on b.`sessionItemid` = c.`id` 
                INNER JOIN `faculty` as d on c.`faculty` = d.`id`
                WHERE a.`id` = $sessionid AND c.`live` = 1
                ORDER BY d.`surname` ASC
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $rowReturn[] = array_map('utf8_encode', $row);
                }
            
                return $rowReturn;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function generateSpeakersForSession($sessionid)
            {
            
                
                $q = "Select d.`title`, d.`firstname`, d.`surname`
                from `session` as a 
                INNER JOIN `sessionOrder` as b on a.`id` = b.`sessionid` 
                INNER JOIN `sessionItem` as c on b.`sessionItemid` = c.`id` 
                INNER JOIN `faculty` as d on c.`faculty` = d.`id`
                WHERE a.`id` = $sessionid AND c.`live` <> 1
                ORDER BY d.`surname` ASC
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $rowReturn[] = array_map('utf8_encode', $row);
                }
            
                return $rowReturn;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }
        public function generateLectureCount($facultyid)
            {
            
                
                $q = "Select COUNT(c.`id`) as lectureCount
                from `session` as a 
                INNER JOIN `sessionOrder` as b on a.`id` = b.`sessionid` 
                INNER JOIN `sessionItem` as c on b.`sessionItemid` = c.`id` 
                INNER JOIN `faculty` as d on c.`faculty` = d.`id`
                WHERE d.`id` = $facultyid AND c.`live` <> 1
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $count = $row['lectureCount'];
                }
            
                return $count;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function generateLiveCount($facultyid)
            {
            
                
                $q = "Select COUNT(c.`id`) as lectureCount
                from `session` as a 
                INNER JOIN `sessionOrder` as b on a.`id` = b.`sessionid` 
                INNER JOIN `sessionItem` as c on b.`sessionItemid` = c.`id` 
                INNER JOIN `faculty` as d on c.`faculty` = d.`id`
                WHERE d.`id` = $facultyid AND c.`live` = 1
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $count = $row['lectureCount'];
                }
            
                return $count;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function generateModeratorCount($facultyid)
            {
            
                
                $q = "Select COUNT(a.`id`) as ModeratorCount
            from `session` as a 
            INNER JOIN `sessionModerator` as b on a.`id` = b.`sessionid` 
            INNER JOIN `faculty` as c on b.`facultyid` = c.`id`
            WHERE c.`id` = $facultyid 
            ";

            //echo $q . '<br><br>';



            $result = $this->connection->RunQuery($q);
            $rowReturn = array();
            $x = 0;
            $nRows = $result->rowCount();

            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $count = $row['ModeratorCount'];
                }
            
                return $count;

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn = [];
                
                return $rowReturn;
            }

        }

        public function Load_records_faculty_tasks_limit_json_datatables($y, $x = 0)
            {

                //execute the three queries

            $q = "Select * from `faculty` LIMIT $x, $y";
            $result = $this->connection->RunQuery($q);
            $rowReturn = array();

            $x = 0;
            $nRows = $result->rowCount();
            if ($nRows > 0) {

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $start = array_map('utf8_encode', $row);
                    $start['countModerator'] = $this->generateModeratorCount($row['id']);
                    $start['countLive'] = $this->generateLiveCount($row['id']);
                    $start['countLecture'] = $this->generateLectureCount($row['id']);

                    $rowReturn['data'][] = $start;
                }
            
                return json_encode($rowReturn);

            } else {
                

                //RETURN AN EMPTY ARRAY RATHER THAN AN ERROR
                $rowReturn['data'] = [];
                
                return json_encode($rowReturn);
            }

        }
        
        
        

        


    /**
     * Close mysql connection
     */
    public function endprogrammeReports()
    {
        $this->connection->CloseMysql();
    }

}