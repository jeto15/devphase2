<?php
require '../.config/db.php';
include '../_model/orderreceipt_model.php'; 

$orderreceiptClass =  new OrderReceiptModel();


if (isset($_POST['action'])) {   

    $action = $_POST['action'];

     
    if( $action == 'GETALLOR' ){ 
        $keyword = $_POST['keySearch'];
        $result =   $orderreceiptClass->getAllOR($db, $keyword);
        echo json_encode(array('result' => $result));
    }

    if( $action == 'SAVENEWOR' ){
        
        $inputOR = $_POST['ornumber'];
 
        $getExisting =   $orderreceiptClass->getAllOR($db, $inputOR);
    
        if( count($getExisting) == 0 ){
            $orderreceiptClass->save_new_or($db,'orderreceipt' , array(
                "OrderReceiptNumber" => $inputOR, 
                "CreatedDate" =>  date('Y-m-d H:i:s')
            )); 
            echo json_encode(array('result' =>'Save'));
        } else {
            echo json_encode(array('result' =>'Duplicate'));
        }
     

    }

}