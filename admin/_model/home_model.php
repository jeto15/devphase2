<?php 
class HomeModel{

 
    function get_all_request_laboratories($db){
        $resultArrry = array();
 
        $queryString = "SELECT COUNT(`laboratory_Id`) as count_result , `laboratory_Id`  FROM `prq_laboratory_table` WHERE `Status` = 'Paid' AND `OtherType` = 'Laboratory' GROUP BY `laboratory_Id`;";
  

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
                 patients.Id as patienID
                ,patient_request_table.Id as prId
                ,patients.first_name
                , patients.last_name
                , patients.middle_name
                , patients.age
                , patients.gender
                , patients.patient_number
                , patient_request_table.Description
                , patient_request_table.`sr-discount` AS srdiscount
                , patient_request_table.`pwd-discount` AS pwddiscount
                , patient_request_table.`total-amount` AS totalamount
                , patient_request_table.Status
                , patient_request_table.created_date
                , patient_request_table.AssignedToId
                , users.UserID
                , users.FirstName
                , users.LastName
            FROM
                patients
                RIGHT JOIN patient_request_table 
                    ON (patients.Id = patient_request_table.patient_Id)
                LEFT JOIN users 
                    ON (users.UserID = patient_request_table.AssignedToId)
            ORDER BY  patient_request_table.created_date DESC;
        ";
   
        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }
}

