<?php
session_start();
require '../.config/db.php';
include '../_model/patient_model.php'; 

$patientModelClass =  new PatientModel();

if (isset($_POST['action'])) {
    
    $USERID = 0;
    if(isset($_SESSION['username'])) {
        $USERID = $_SESSION['userId'];
    }

    
    
    $action = $_POST['action'];

    //Save New Patient Record
    if( $action == 'SAVEPATIENTS' ){

       

        if( $_POST['isEdit'] == 'true' ){ 
            $stats = $patientModelClass->save_change_patient(
                $db, 
                'patients',
                array(
                    "Id" =>  $_POST['recordId']     
                ),
                array(
                "first_name" =>  $_POST['fname'],
                "last_name" => $_POST['lname'],
                "middle_name" => $_POST['mname'],
                "age" => $_POST['age'],
                "address" => $_POST['address'],
                "birthday" => $_POST['bday'],
                "gender" => $_POST['sex'], 
                "patient_number" => $_POST['patientNum'],
                "contact_number" => $_POST['contactNumber'],
                "modifiedby" => $USERID,

            ));
            $patientId ='Updated '.$stats;
  
        } else {
            $patientModelClass->save_new_patient($db,'patients' , array(
                "first_name" =>  $_POST['fname'],
                "last_name" => $_POST['lname'],
                "middle_name" => $_POST['mname'],
                "age" => $_POST['age'],
                "address" => $_POST['address'], 
                "birthday" => $_POST['bday'],
                "gender" => $_POST['sex'], 
                "patient_number" => $_POST['patientNum'],
                "contact_number" => $_POST['contactNumber'],
                "createdby" =>  $USERID, 
                "Created Date" =>  date('Y-m-d H:i:s')
               
            ));

            $patientId ='Created';
        }

 
        echo json_encode(array('Status' => $patientId ));    
    } 

    //Save Changes Patient Record 

    //View Patient Record

    //Retrieve All Patients Record 
    if( $action == 'GETALLPATIENTS' ){
        $keyword = $_POST['keyword'];
 
        $result =   $patientModelClass->get_all_patients($db, $keyword);
        echo json_encode(array('result' => $result));
    }

    //Get Patient Record by Id 
    if( $action == 'GETPATIENTRECORDBYID' ){

        $id = $_POST['id'];
        $result = $patientModelClass->get_record_patient_by_id($db,$id);
        echo json_encode(array('result' => $result));

    }
 
    if( $action == 'GETPATIENTNUMBEREXIST' ){

        $keyword = $_POST['keyword'];
 
        $result =   $patientModelClass->validate_patient_number_exist($db, $keyword);
        echo json_encode(array('result' => $result));
         
    }
   
  
} else {
    echo json_encode(array('success' => 0));
}


$db->close();