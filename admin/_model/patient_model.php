<?php 
 
class PatientModel{

    /**
     * 
     */
    function save_new_patient($db, $dbName, $dbData){
        $insertID = $db->insertRow( $dbName ,$dbData);   
        return  $insertID;
    }

    function save_change_patient($db, $dbName, $dbData , $dbFilter){
        $updateStatus = $db->updateRow($dbName, $dbData , $dbFilter);
        return  $updateStatus;
    }



    function get_all_patients($db, $keyword){
        $resultArrry = array();
        $queryString = "SELECT * FROM patients ORDER BY `last_name` DESC";
        if( $keyword != '' ){
            $queryString = "SELECT * FROM patients WHERE first_name LIKE '%".$keyword."%' OR middle_name LIKE '%".$keyword."%'  OR last_name LIKE '%".$keyword."%' OR contact_number LIKE '%".$keyword."%' OR patient_number LIKE '%".$keyword."%'     ";    
        } 
         
        //var_dump($queryString); 

        //exit();
        $result = $db->query($queryString);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    function get_record_patient_by_id($db,$id){     
        $resultArrry = array();
        $result = $db->query("SELECT * FROM patients Where id='".$id."' limit 1");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry[0];
    }

    function validate_patient_number_exist($db, $keyword){
        $resultArrry = array();
 
        $queryString = "SELECT * FROM patients WHERE  LCASE(patient_number) = '".strtolower($keyword)."'  limit 1  ";    
 
        $result = $db->query($queryString);
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry; 
    }

}