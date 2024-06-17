<?php
require '../.config/db.php';
include '../_model/home_model.php'; 

$homeModelClass =  new HomeModel();
 

if (isset($_POST['action'])) {

    $action = $_POST['action'];
    //Get Patient Record by Id 
    if( $action == 'GETLABCOUNTSREPORTPIE' ){
        $result_lab    =    $homeModelClass->get_all_laboratories($db);
        $result_request =   $homeModelClass->get_all_request_laboratories($db);

        
        //Inser the New one
        $mapLabArray = array();
        foreach( $result_lab  as $array_variable){
    
            $mapLabArray[ $array_variable['Id'] ] = $array_variable['Name'];
        }
        
        $labelResult = array();
        $dataLab    = array();
        $databackgroundColor = array();
        foreach( $result_request  as $array_variable){
            if (array_key_exists($array_variable['laboratory_Id'],$mapLabArray)){
                array_push($labelResult, $mapLabArray[$array_variable['laboratory_Id']]);
                array_push($dataLab, $array_variable['count_result']);
                array_push($databackgroundColor, '#'.random_color());
               
            }
        }  

        
        $labelArrray = array('labels'=> $labelResult);
        
        $dataArrray = array('data'=> $dataLab);
        
        $dataSetPushArray =array();

        array_push($dataSetPushArray, array(
            "label"=> "Laboratories Allocated",
            "data"=> $dataLab,
             "backgroundColor" =>$databackgroundColor,
            "hoverOffset"=> "4" 
        ));
    

        $dataPieBody = array(
            "labels"=>$labelResult,
            "datasets"=> $dataSetPushArray
        );
        
        echo json_encode($dataPieBody);

    }


    if( $action == 'GETNUMBEROFPATIENTS' ){
        
        $resultgetPatients =   $homeModelClass->get_number_of_patients($db);

        foreach( $resultgetPatients  as $array_variable){
            $paitnetCounts = $array_variable['count_result'];
        }  

        echo json_encode(array('result' =>  $paitnetCounts ));    
    }

    if( $action == 'GETNUMBEROFREQUEST' ){
        
        $resultgetPatients =   $homeModelClass->get_number_of_request($db);

        foreach( $resultgetPatients  as $array_variable){
            $paitnetCounts = $array_variable['count_result'];
        }  

        echo json_encode(array('result' =>  $paitnetCounts ));    
    }

    if( $action == 'GETPATIENTREQUESTLATEST' ){
        
        $resultgetPatients =   $homeModelClass->get_all_patient_request_latest($db);

        // foreach( $resultgetPatients  as $array_variable){ 
        //  //  var_dump($array_variable);
        // }  

        echo json_encode(array('result' => $resultgetPatients  ));      
    }
}
  




function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}