<?php 

class LaboratoryModel{

    function getAllLabs($db, $keyword){
        $resultArrry = array();
        $queryString = "SELECT * FROM laboratory ORDER BY `Name` DESC limit 100";
        if( $keyword != '' ){
            $queryString = "SELECT * FROM laboratory WHERE Name LIKE '%".$keyword."%' limit  100";    
        } 
         
        //var_dump($queryString); 

        //exit();
        $result = $db->query($queryString);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        }  
        return $resultArrry;
    }  

    function CreateLabRecord($db, $dbName, $dbData){
        $insertID = $db->insertRow( $dbName ,$dbData);   
        return  $insertID;
    }

    function UpdateLabRecord($db, $dbName, $dbData , $dbFilter){
        $updateStatus = $db->updateRow($dbName, $dbData , $dbFilter);
        return  $updateStatus;
    }

}