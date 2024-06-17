<?php 
 
class PatientProfileModel{

    /**
     * 
     */
    function get_record_patient_by_id($db,$id){     
        $resultArrry = array();
        $result = $db->query("SELECT * FROM patients Where id='".$id."' limit 1");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry[0];
    }

    function get_record_patient_avatar_by_id($db,$id){     
        $resultArrry = array();
        $result = $db->query("SELECT * FROM patient_file_library Where patient_id='".$id."' AND isavatar='Yes'  ORDER BY created_date DESC limit 1");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        }   
        return $resultArrry[0] ?? null;
    }


    function get_record_prescribed_by_id( $db, $id ){
        $resultArrry = array();
        $result = $db->query("SELECT * FROM patient_request_table Where patient_Id='".$id."' ORDER BY created_date DESC");
        while($row = $db->fetchAssoc($result)) {
            array_push($resultArrry, $row);
        } 
        return $resultArrry; 
    }

}