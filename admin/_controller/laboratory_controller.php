<?php
session_start();
require '../.config/db.php';
include '../_model/laboratory_model.php'; 

$LabModelClass =  new LaboratoryModel();


if (isset($_POST['action'])) {

    $action = $_POST['action'];
 
    if( $action  == 'GETLABSRECORDS' ){

        $keyword = $_POST['keyword'];
        $result =   $LabModelClass->getAllLabs($db, $keyword);
        echo json_encode(array('result' => $result));

    }
 
    if( $action == 'MANAGELABS' ){

        if( $_POST['submitaction'] == 'create' ){

            $LabModelClass->CreateLabRecord($db,'laboratory' , array(
                "Name"=> $_POST["input_name"],
                "Description"=> $_POST["input_description"],
                "listprice"=> $_POST["input_price"], 
                "created_date"=> date('Y-m-d H:i:s'), 
                "lastmodifieddate" =>   date('Y-m-d H:i:s')
            ));
            echo json_encode(array('Status' => 'Created' ));    

        } else { 

            $stats = $LabModelClass->UpdateLabRecord(
                $db, 
                'laboratory',
                array(
                    "Id" =>  $_POST['recordId']     
                ),
                array(  
                "Name"=> $_POST["input_name"],
                "Description"=> $_POST["input_description"],
                "lastmodifieddate" =>   date('Y-m-d H:i:s')
                )
            ); 
            echo json_encode(array('Status' => 'Updated' ));    

        }

    }

}