<?php 
class CapturePictureModel{

 
    function get_all_request_laboratories($db){
        $resultArrry = array();
 
        $queryString = "SELECT COUNT(`laboratory_Id`) as count_result , `laboratory_Id`  FROM `prq_laboratory_table` WHERE `Status` = 'Paid' AND `OtherType` IS NULL GROUP BY `laboratory_Id`;";
  

        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

  
 
}