<?php 

class MedicineModel{

    function getAllMed($db, $keyword){
        $resultArrry = array();
        $queryString = "SELECT * FROM medicine ORDER BY `Brand` DESC limit 100";
        if( $keyword != '' ){
            $queryString = "SELECT * FROM medicine WHERE Name LIKE '%".$keyword."%' OR Brand LIKE '%".$keyword."%'  OR Manufacturer LIKE '%".$keyword."%'  Limit 100   ";    
        } 
         
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