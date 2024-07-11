<?php
session_start();
require '../.config/db.php';
include '../_model/patient_profile_model.php'; 
include '../_model/makerequest_model.php'; 

$patientProfileModelClass =  new PatientProfileModel();
$makeRequestModelClass =  new MakeRequestModel();


if (isset($_POST['action'])) {

    $USERID = 0;
    if(isset($_SESSION['username'])) {
        $USERID = $_SESSION['userId'];
    }


    $action = $_POST['action'];

    //Get Patient Record by Id 
    if( $action == 'GETPATIENTRECORDBYID' ){

        $id = $_POST['id'];
        $result = $patientProfileModelClass->get_record_patient_by_id($db,$id);
        $result_haveAvatar = $patientProfileModelClass->get_record_patient_avatar_by_id($db,$id);
        if( is_null($result_haveAvatar) ){
            echo json_encode(array('result' => $result, 'avatarpic'=> null)); 
        } else {
            echo json_encode(array('result' => $result, 'avatarpic'=> $result_haveAvatar));
        }
        

    } 

    //Get Prescribe Record by Id 
    if( $action == 'GETPATIENTPRESCRIBEBYID' ){

        $id = $_POST['id'];
        $result = $patientProfileModelClass->get_record_prescribed_by_id($db,$id);
        echo json_encode(array('result' => $result));

    } 

    if( $action == 'CREATEDRAFTREQUEST' ){
        $patientId        =  $_POST['recordId'];
        $description      =  $_POST['request_description'];

        $patient_request_Id = $makeRequestModelClass->save_new_prescription($db,'patient_request_table' , array(
            "patient_Id" => $patientId, 
            "Description" => $description,
            "created_date" => date('Y-m-d H:i:s'),
            "created_by_Id" => $USERID 
        ));   
 
        $result = array(
            "patientId" =>  $patientId,
            "patientRequestId" =>  $patient_request_Id 
        );

        echo json_encode(array('result' => $result));
    }

    
}
 