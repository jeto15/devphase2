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

        $prescribeId        =  $_POST['prescribe_id'];
        $statusType        =  $_POST['statusType'];



        if( $statusType == 'Billing Competed' ){

            $ORResult =   $makeRequestModelClass->get_latestORNumber($db);

            if( count( $ORResult ) != 0 ){
                
                $prescribed_id = $_POST['prescribe_id'];
                $patient_id    = $_POST['patient_id'];
                $totalAmount   = $_POST['totalAmount'];

                $orNumber = $ORResult[0]['OrderReceiptNumber'];

                $itemRecord = array(
                    "OrderReceiptNumber" => $orNumber,
                    "PatientId" => $patient_id,
                    "PrescribeId" => $prescribed_id ,  
                    "TotalAmount" => $totalAmount,
                    "CreatedDate" => date('Y-m-d H:i:s'),
                    "CreatedBY" =>  $USERID,
                    "Status" => "Final"
                ); 


                $makeRequestModelClass->save_new_prescription($db,'finalbilling' ,  $itemRecord);  


                $makeRequestModelClass->save_change_patient_prescription(
                    $db, 
                    'patient_request_table',
                    array(
                        "Id" => $prescribeId 
                    ),
                    array(
                    "modified_date" =>$date,
                    "modified_by" => $USERID,
                    "Status" => $statusType     
    
                ));
 
                $makeRequestModelClass->save_change_patient_prescription(
                    $db, 
                    'orderreceipt',
                    array(
                        "Id" =>$ORResult[0]['Id'] 
                    ),
                    array( 
                    "Status" => 'Used'
                ));

            }

          
        } else {
            $makeRequestModelClass->save_change_patient_prescription(
                $db, 
                'patient_request_table',
                array(
                    "Id" => $prescribeId 
                ),
                array(
                "modified_date" =>$date,
                "modified_by" => $USERID,
                "Status" => $statusType     

            ));
        }

        echo json_encode(array('Status' =>'Saved' ));     
    }

    if(  $action  == 'GETFINALBILLING' ){

        $prescribed_id = $_POST['prescribe_id']; 
        $patient_id    = $_POST['patient_id'];
        $ORResult =   $makeRequestModelClass->get_FinalBillingRecord($db,$patient_id,$prescribed_id);

        echo json_encode(array('result' => $ORResult));

    }  
  
    if( $action  == 'UPDATEREQUESTTOVOID' ){

        $prescribed_id = $_POST['prescribe_id'];
        $patient_id    = $_POST['patient_id'];
        $reason    = $_POST['input_reason'];

        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'patient_request_table',
            array(
                "Id" => $prescribed_id,
                "patient_Id" =>  $patient_id
            ),
            array(
            "modified_date" =>$date,
            "modified_by" => $USERID,
            "Status" => "Void",  
            "Reason" => $reason       
        ));

        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'finalbilling',
            array( 
                "PrescribeId" => $prescribed_id,
                "PatientId" =>  $patient_id
            ),
            array(
            "modified_date" =>$date,
            "modified_by" => $USERID,
            "Status" => "Void"    
        ));

        
        echo json_encode(array('Status' =>'Saved' ));    
    }
 
    if( $action  == 'UPDATEREQUESTTOREFUND' ){

        $prescribed_id = $_POST['prescribe_id'];
        $patient_id    = $_POST['patient_id'];
        $reason    = $_POST['input_reason'];

        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'patient_request_table',
            array(
                "Id" => $prescribed_id,
                "patient_Id" =>  $patient_id
            ),
            array(
            "modified_date" =>$date,
            "modified_by" => $USERID,
            "Status" => "Refunded",  
            "Reason" => $reason       
        ));

        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'finalbilling',
            array( 
                "PrescribeId" => $prescribed_id,
                "PatientId" =>  $patient_id
            ),
            array(
            "modified_date" =>$date,
            "modified_by" => $USERID,
            "Status" => "Refunded"    
        ));

        
        echo json_encode(array('Status' =>'Saved' ));    
    }
}


 