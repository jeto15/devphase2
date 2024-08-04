<?php 

class MakePatientRequestModel{

    function getAllDoctors($db, $keyword){
        $resultArrry = array(); 
        if( $keyword != '' ){
            $queryString = "SELECT * FROM users WHERE FirstName LIKE '%".$keyword."%' OR LastName LIKE '%".$keyword."%' AND Role = 4 limit  100";    
        } 
         
        //var_dump($queryString); 

        //exit(); 
        $result = $db->query($queryString);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        }  
        return $resultArrry;
    }  

 
 
}