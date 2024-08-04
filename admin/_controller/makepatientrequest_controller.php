<?php
session_start();
require '../.config/db.php';
include '../_model/makepatientrequest_model.php'; 

$patienrequestmodeltModelClass =  new MakePatientRequestModel();

if (isset($_POST['action'])) {
    
    $USERID = 0;
    if(isset($_SESSION['username'])) {
        $USERID = $_SESSION['userId'];
    }
   
    $action = $_POST['action'];
 
    if( $action  == 'GETALLDOCTORS' ){

        $keyword = $_POST['keyword'];
        $result =   $patienrequestmodeltModelClass->getAllDoctors($db, $keyword);
        echo json_encode(array('result' => $result));

    }



}