<?php 
 
class MakeRequestModel{

    /**
     * 
     */
    function save_new_prescription($db, $dbName, $dbData){
        $insertID = $db->insertRow( $dbName ,$dbData);   
        return  $insertID;
    } 

    
    function get_record_prescribed_by_id( $db, $patient_id, $prescribed_id ){
        $resultArrry = array();
        $result = $db->query("SELECT * FROM prq_description_table Where patient_Id='".$patient_id."' AND patient_request_Id='". $prescribed_id ."' ");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    function save_change_patient_prescription($db, $dbName, $dbData , $dbFilter){
        $updateStatus = $db->updateRow($dbName, $dbData , $dbFilter);
        return  $updateStatus;
    }

    function get_all_laboratories($db,$key){
        $resultArrry = array();
        $queryString = 'SELECT * FROM laboratory';
        if($key != ''){
            $queryString = "SELECT * FROM laboratory  WHERE `Name` LIKE '%".$key."%' ";
        }

        $result = $db->query($queryString);

        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    function clear_selected_Labs($db,$where){
         $db->deleteRow("prq_laboratory_table",$where );
    } 

    function get_selected_labs_to_display($db, $patient_id, $prescribed_id ){
        $resultArrry = array();
        $result = $db->query("SELECT * FROM prq_laboratory_table Where patient_Id='".$patient_id."' AND patient_request_Id='". $prescribed_id ."' ORDER BY created_date DESC ");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry; 
    }

    function get_patient_request_table($db, $patient_id, $request_Id ){
        $resultArrry = array(); 
        $result = $db->query("SELECT * FROM patient_request_table Where patient_Id='".$patient_id."' AND Id='".$request_Id."'");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry; 
    }
 
 

}