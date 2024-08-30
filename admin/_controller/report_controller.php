<?php
require '../.config/db.php';
include '../_model/report_model.php'; 

$homeModelClass =  new ReportModel();
 

if (isset($_POST['action'])) {

    //

    $action = $_POST['action'];
    //Get Patient Record by Id 
    if( $action == 'GETSALESBYDATE' ){

      $salesListQuery = $_POST['salesListQuery'];
 
      $resultListSales = $homeModelClass->getSalesListByDate($db,$salesListQuery); 

      if( count($resultListSales) != 0  ){
        $resultSales =  $homeModelClass->getSalesByDate($db,  $salesListQuery );
        echo json_encode(array('status'=> '1','result' =>$resultSales, 'resultList' =>$resultListSales  ));   
      } else {
        echo json_encode(array('status'=> '0'));   
      }
    }

    if( $action == 'GETMEDREPORDBYDATE' ){

      $salesListQuery = $_POST['salesListQuery'];

      $resultListSales = $homeModelClass->getMedListCountsByDate($db,$salesListQuery); 

      echo json_encode(array('result' => $resultListSales));

    }

    if( $action == 'GETLABREPORDBYDATE' ){

      $salesListQuery = $_POST['salesListQuery'];

      $resultListSales = $homeModelClass->getLabListCountsByDate($db,$salesListQuery); 

      echo json_encode(array('result' => $resultListSales));

    }

}