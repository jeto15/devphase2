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

        $where =  "WHERE prq_laboratory_table.patient_id='".$patient_id."' AND prq_laboratory_table.patient_request_Id='". $prescribed_id ."' ";

        $queryStr =  $this->getLabandMedViewqueryStrinng($where);
 

       

        $result = $db->query($queryStr);
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
    
    function get_record_requestitem_by_id( $db, $recodId ){
        $resultArrry = array();

        $where =  "WHERE prq_laboratory_table.Id='".$recodId."' ";
        $queryStr =  $this->getLabandMedViewqueryStrinng($where);
        $result = $db->query( $queryStr );
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry;
    }

    
    function getLabandMedViewqueryStrinng( $where ){
        $queryStr = "
            SELECT
                prq_laboratory_table.Id
                , prq_laboratory_table.Status
                , prq_laboratory_table.medicine_Id
                , prq_laboratory_table.laboratory_Id
                , medicine.Name as medname
                , medicine.Brand 
                , medicine.DosageForm
                , medicine.Strength
                , medicine.Manufacturer
                , medicine.Price
                , laboratory.Name
                , laboratory.Description
                , laboratory.listprice
                , prq_laboratory_table.Qty
                , prq_laboratory_table.UnitPrice
                , prq_laboratory_table.assignedDocotor
                , prq_laboratory_table.patient_id
                , prq_laboratory_table.patient_request_Id
                ,prq_laboratory_table.OtherType
                ,prq_laboratory_table.AdjustUnitePrice
                ,prq_laboratory_table.AdjustQty
            FROM
                prq_laboratory_table
                LEFT JOIN laboratory 
                ON (prq_laboratory_table.laboratory_Id = laboratory.Id)
                LEFT JOIN medicine 
                ON (prq_laboratory_table.medicine_Id = medicine.Id)
            ".$where."
        ";
        return $queryStr;
    }

}