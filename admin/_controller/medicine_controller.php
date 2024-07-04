<?php
require '../.config/db.php';
include '../_model/medicine_model.php'; 

$medicineModelClass =  new MedicineModel();


if (isset($_POST['action'])) {   

    $action = $_POST['action'];

    if( $action == 'MANAGEMEDICINE' ){
        if( $_POST['submitaction'] == 'create' ){

            $medicineModelClass->CreateMedicine($db,'medicine' , array(
                "Name"=> $_POST["input_name"],
                "Brand"=> $_POST["input_brand"],
                "DosageForm"=> $_POST["input_dosageForm"],
                "Strength"=> $_POST["input_strength"],
                "Manufacturer"=> $_POST["input_manufaccturer"], 
                "Price"=> $_POST["input_price"],
                "Description"=> $_POST["input_description"],
                "ceated_date"=> date('Y-m-d H:i:s'),
                "lastmodified_date" =>   date('Y-m-d H:i:s')
            ));
            echo json_encode(array('Status' => 'Created' ));    
        } else {

            $stats = $medicineModelClass->UpdateMedicine(
                $db, 
                'medicine',
                array(
                    "Id" =>  $_POST['recordId']     
                ),
                array(
                    "Name"=> $_POST["input_name"],
                    "Brand"=> $_POST["input_brand"],
                    "DosageForm"=> $_POST["input_dosageForm"],
                    "Strength"=> $_POST["input_strength"],
                    "Manufacturer"=> $_POST["input_manufaccturer"],  
                    "Price"=> $_POST["input_price"],
                    "Description"=> $_POST["input_description"], 
                    "lastmodified_date" =>   date('Y-m-d H:i:s')
                )
            ); 
            echo json_encode(array('Status' => 'Updated' ));    
        }
    }


    if( $action  == 'GETMEDICINERECORDS' ){

        $keyword = $_POST['keyword'];
        $result =   $medicineModelClass->getAllMed($db, $keyword);
        echo json_encode(array('result' => $result));

    }

}