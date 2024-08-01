<?php
session_start();
require '../.config/db.php';
include '../_model/makerequest_model.php'; 
//    echo "<pre>".   ."</pre>";
$makeRequestModelClass =  new MakeRequestModel();


if (isset($_POST['action'])) {

    $USERID = 0;
    if(isset($_SESSION['username'])) {
        $USERID = $_SESSION['userId'];
    }
    $date = date('Y-m-d H:i:s');
    $action = $_POST['action'];
 
    if(  $action  == 'UPDATEREQUESTSTATUS' ){

        $patientId        =  $_POST['prescribe_id'];
        $statusType        =  $_POST['statusType'];

        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'patient_request_table',
            array(
                "Id" => $patientId 
            ),
            array(
            "modified_date" =>$date,
            "modified_by" => $USERID,
            "Status" => $statusType     
            
        ));

        echo json_encode(array('Status' =>'Saved' ));     
    }
  
 
}


 