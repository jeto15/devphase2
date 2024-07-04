<?php 

class MedicineModel{

    function getAllMed($db, $keyword){
        $resultArrry = array();
        $queryString = "SELECT * FROM medicine ORDER BY `Brand` DESC";
        // if( $keyword != '' ){
        //     $queryString = "SELECT * FROM patients WHERE first_name LIKE '%".$keyword."%' OR middle_name LIKE '%".$keyword."%'  OR last_name LIKE '%".$keyword."%' OR contact_number LIKE '%".$keyword."%' OR patient_number LIKE '%".$keyword."%'     ";    
        // } 
         
        //var_dump($queryString); 

        //exit();
        $result = $db->query($queryString);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        }  
        return $resultArrry;
    }  

    function CreateMedicine($db, $dbName, $dbData){
        $insertID = $db->insertRow( $dbName ,$dbData);   
        return  $insertID;
    }

    function UpdateMedicine($db, $dbName, $dbData , $dbFilter){
        $updateStatus = $db->updateRow($dbName, $dbData , $dbFilter);
        return  $updateStatus;
    }

}