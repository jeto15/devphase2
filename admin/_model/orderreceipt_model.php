<?php 

class OrderReceiptModel{

    
    function getAllOR($db, $keyword){
        $resultArrry = array();
        $queryString = "SELECT * FROM orderreceipt ORDER BY `CreatedDate` DESC limit 100";
        if( $keyword != '' ){
            $queryString = "SELECT * FROM orderreceipt WHERE OrderReceiptNumber LIKE '%".$keyword."%' ORDER BY `CreatedDate` DESC Limit 100   ";    
        } 
 
        $result = $db->query($queryString);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        }  
        return $resultArrry;
    }  

    function save_new_or($db, $dbName, $dbData){
        $insertID = $db->insertRow( $dbName ,$dbData);   
        return  $insertID;
    }

} 