<?php 
class HomeModel{

 
    function get_all_request_laboratories($db){
        $resultArrry = array();
 
        $queryString = "SELECT COUNT(`laboratory_Id`) as count_result , `laboratory_Id`  FROM `prq_laboratory_table` WHERE `Status` = 'Paid' AND `OtherType` IS NULL GROUP BY `laboratory_Id`;";
  

        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    function get_all_laboratories($db){
        $resultArrry = array();
 
        $queryString = "SELECT Id, Name FROM `laboratory` ";
  

        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

  

    function get_number_of_patients($db){
        $resultArrry = array();
 
        $queryString = "SELECT COUNT(`Id`) as count_result   FROM patients ";
  
 
        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }
 

    function get_number_of_request($db){
        $resultArrry = array();
 
        $queryString = "SELECT COUNT(`Id`) as count_result   FROM patient_request_table ";
  
 
        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    
    function get_all_patient_request_latest($db){
        $resultArrry = array();
 
        $queryString = "
            SELECT
                patients.first_name
                , patients.last_name
                , patients.middle_name
                , patients.patient_number
                , patient_request_table.Id as request_id
                , patient_request_table.created_date
                , patient_request_table.created_by_Id
                , patients.Id
            FROM
                u285821606_candayahdc_sb.patient_request_table
                LEFT JOIN u285821606_candayahdc_sb.patients 
                    ON (patient_request_table.patient_Id = patients.Id)
            WHERE  patients.Id IS NOT NULL AND  DATE(patient_request_table.created_date) = CURDATE() ORDER BY  patient_request_table.created_date DESC ;
        ";
   
        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }
}