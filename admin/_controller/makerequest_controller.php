<?php
session_start();
require '../.config/db.php';
include '../_model/makerequest_model.php'; 

$makeRequestModelClass =  new MakeRequestModel();


if (isset($_POST['action'])) {

    $USERID = 0;
    if(isset($_SESSION['username'])) {
        $USERID = $_SESSION['userId'];
    }


    $action = $_POST['action'];

    

    //Get Patient Record by Id 
    if( $action == 'SAVEPRESCRIPTION' ){
 
        $prescription_sc  = $_POST['prescription_sc'];
        $prescription_ap  = $_POST['prescription_ap'];
        $prescription_pt  = $_POST['prescription_pt'];
        $prescription_imp = $_POST['prescription_imp'];
        //$prescription_dlList = $_POST['prescription_dl'];
        //$isChnageAddingLab = $_POST['islaboratorieschange'];

         
        
        $isUpdate = $_POST['isUpdate'];
        $presibedId = '';
        
        $patientId        =  $_POST['id'];
        if( $isUpdate == 'update' ){
            $presibedId  = $_POST['hdPrescribeId'];
        }

    


        $date = date('Y-m-d H:i:s');
       
        if( $isUpdate == 'new' ){
            $patient_request_Id = $makeRequestModelClass->save_new_prescription($db,'patient_request_table' , array(
                "patient_Id" => $patientId,
                "created_date" => $date,
                "created_by_Id" => $USERID
            )); 
      
            if($prescription_sc != ''){
                $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                    "patient_request_Id" =>  $patient_request_Id,
                    "patient_Id" => $patientId,
                    "Description" => $prescription_sc,
                    "Type" => 'SC'
                )); 
            }
    
            if($prescription_ap != ''){
                $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                    "patient_request_Id" =>   $patient_request_Id,
                    "patient_Id" =>  $patientId,
                    "Description" => $prescription_ap,
                    "Type" => 'AP'
                ));
     
            }
    
            if($prescription_pt != ''){
                $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                    "patient_request_Id" =>   $patient_request_Id,
                    "patient_Id" =>  $patientId,
                    "Description" => $prescription_pt,
                    "Type" => 'PT'
                ));
            }
    
            if($prescription_imp != ''){
                $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                    "patient_request_Id" =>   $patient_request_Id,
                    "patient_Id" =>  $patientId,
                    "Description" => $prescription_imp,
                    "Type" => 'IMP'
                )); 
            }  
 
        } else {

            //Check If the request has prescriptions   
  
            $has_prescribed_array = array(
                "SC" => '',
                "AP"  => '',
                "PT"  => '',
                "IMP" => ''
            );

            $getResult =  $makeRequestModelClass->get_record_prescribed_by_id($db,$patientId,$presibedId);
            foreach( $getResult  as $array_variable){
                $has_prescribed_array[$array_variable['Type']] = $array_variable;
            }
            //end

 

            $makeRequestModelClass->save_change_patient_prescription(
                $db, 
                'patient_request_table',
                array(
                    "Id" => $presibedId 
                ),
                array(
                "modified_date" =>$date,
                "modified_by" => $USERID,
                "Status" =>"Saved"     
                
            ));

            if($prescription_sc != ''){

                if( $has_prescribed_array["SC"] == '' ){

                    $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                        "patient_request_Id" =>  $presibedId,
                        "patient_Id" => $patientId,
                        "Description" => $prescription_sc,
                        "Type" => 'SC',
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                        
                    )); 

                } else{

                    $resultUpdate = $makeRequestModelClass->save_change_patient_prescription(
                        $db, 
                        'prq_description_table',
                        array(
                            "Type" =>  'SC',
                            "patient_request_Id" => $presibedId,
                            "patient_Id" => $patientId  
                        ),
                        array(
                        "Description" =>  $prescription_sc,
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    ));

                }

    
            }
    
            if($prescription_ap != ''){


                if( $has_prescribed_array["AP"] == '' ){
                    $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                        "patient_request_Id" =>   $presibedId,
                        "patient_Id" =>  $patientId,
                        "Description" => $prescription_ap,
                        "Type" => 'AP',
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    ));
                } else{

                    $makeRequestModelClass->save_change_patient_prescription(
                        $db, 
                        'prq_description_table',
                        array(
                            "Type" =>  'AP',
                            "patient_request_Id" => $presibedId,
                            "patient_Id" => $patientId  
                        ),
                        array(
                        "Description" =>  $prescription_ap,
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    ));
                    
                }
      
     
            }
    
            if($prescription_pt != ''){

                if( $has_prescribed_array["PT"] == '' ){
                    $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                        "patient_request_Id" =>   $presibedId,
                        "patient_Id" =>  $patientId,
                        "Description" => $prescription_pt,
                        "Type" => 'PT',
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    ));
                } else{

                    $makeRequestModelClass->save_change_patient_prescription(
                        $db, 
                        'prq_description_table',
                        array(
                            "Type" =>  'PT' ,
                            "patient_request_Id" => $presibedId,
                            "patient_Id" => $patientId  
                        ),
                        array(
                        "Description" =>  $prescription_pt,
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    ));

                }
  
            }
    
            if($prescription_imp != ''){

                if( $has_prescribed_array["IMP"] == '' ){
                    $makeRequestModelClass->save_new_prescription($db,'prq_description_table' , array(
                        "patient_request_Id" =>   $presibedId,
                        "patient_Id" =>  $patientId,
                        "Description" => $prescription_imp,
                        "Type" => 'IMP',
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    )); 
                } else{

                    $makeRequestModelClass->save_change_patient_prescription(
                        $db, 
                        'prq_description_table',
                        array(
                            "Type" =>  'IMP',
                            "patient_request_Id" => $presibedId,
                            "patient_Id" => $patientId  
                        ),
                        array(
                        "Description" =>  $prescription_imp,
                        "modified_date" => $date,
                        "modified_by_Id" =>  $USERID
                    )); 
                    
                }
     
     
            }  

            // if($prescription_dlList != '' &&  $isChnageAddingLab == "true" ){
            //     $prescription_dlList = json_decode($prescription_dlList);
            //     //Delete Exist Prescribe labs and Other 
            //     $makeRequestModelClass->clear_selected_Labs($db,array(
            //         "patient_request_Id" =>   $presibedId,
            //         "patient_Id" =>  $patientId, 
            //     ));  
 
            //     //Inser the New one
            //     foreach ($prescription_dlList as $key => $items) {
            //         $makeRequestModelClass->save_new_prescription($db,'prq_laboratory_table' , array(
            //             "patient_Id" => $patientId,
            //             "patient_request_Id" => $presibedId,
            //             "laboratory_Id" => $items->Id, 
            //             "created_date" =>  $date 
            //         ));    
            //     } 
 
            // }

        }


        echo json_encode(array('Status' =>'Saved' ));     

    } 

    if(  $action  == 'GETALLPATIENTPRESCRIBED' ){
        
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];

  
  
        $prescribed_array = array(
            "SC" => '',
            "AP"  => '',
            "PT"  => '',
            "IMP" => ''
        );

        $getResult =  $makeRequestModelClass->get_record_prescribed_by_id($db,$patient_id,$prescribed_id);
        foreach( $getResult  as $array_variable){

          
           $prescribed_array[$array_variable['Type']] = $array_variable;

            
        }


        echo json_encode(array('result' =>$prescribed_array ));  
     
        
    }
 
    if(  $action  == 'GETALLLABORATORIES' ){
        $keyWord = $_POST['keySearch'];

        $result =   $makeRequestModelClass->get_all_laboratories($db, $keyWord);
        echo json_encode(array('result' => $result));
    }
 
    if(  $action  == 'GETDISPLAYLABSELECTED' ){


        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];

        $result =   $makeRequestModelClass->get_selected_labs_to_display($db,  $patient_id, $prescribed_id );
        echo json_encode(array('result' => $result));
    }

    if(  $action  == 'SAVESELECTEDLAB' ){

        $selectedId  = $_POST['selectedId'];
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];

      
        $makeRequestModelClass->save_new_prescription($db,'prq_laboratory_table' ,array(
            "patient_Id" => $patient_id,
            "patient_request_Id" => $prescribed_id,
            "laboratory_Id" => $selectedId ,  
            "created_date" =>   date('Y-m-d H:i:s'),
            "created_by_Id" => $USERID
        ));      
       
        echo json_encode(array('result' =>"save")); 
    }

    if(  $action  == 'SAVESELECTEDLABOTHER' ){
 
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];
        $prescribedKey  = $_POST['prescribedKey'];
        $otherType = $_POST['SelectedTypeLabType'];

      
        $makeRequestModelClass->save_new_prescription($db,'prq_laboratory_table' ,array(
            "patient_Id" => $patient_id,
            "patient_request_Id" => $prescribed_id,
            "isOther" => 1 ,
            "is_other_request" => $prescribedKey,
            "OtherType" =>  $otherType,
            "created_date" =>   date('Y-m-d H:i:s') ,
            "created_by_Id" => $USERID
        ));       
       
        echo json_encode(array('result' =>"save")); 
    }

    

    if(  $action  == 'REMOVEDSELECTEDLAB' ){

        $selectedId  = $_POST['selectedId'];
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];
        $isother  = $_POST['isothererquest'];

 
        
        if(  $isother  == "1" ){
            $makeRequestModelClass->clear_selected_Labs($db,array(
                "Id" =>  $selectedId
            ));
        } else { 
            $makeRequestModelClass->clear_selected_Labs($db,array(
                "patient_request_Id" =>   $prescribed_id,
                "patient_Id" =>  $patient_id,
                "laboratory_Id" => $selectedId 
            ));
        }
 
       
        echo json_encode(array('result' =>"save")); 
    }
    

    if(  $action  == 'LABANDMEDANDOTHERASPAID' ){

        $selectedId  = $_POST['selectedId'];
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];
        $isother  = $_POST['isothererquest'];
        $isStatusPaid = $_POST['isstatuspaid'];

        
        
        //if(  $isother  == "1" ){
            
            $StatusPayment = 'Paid';
            if( $isStatusPaid == 'Paid' ){
                $StatusPayment  = 'Unpaid';
            }
 

            $makeRequestModelClass->save_change_patient_prescription(
                $db, 
                'prq_laboratory_table',
                array(
                    "Id" => $selectedId 
                ),
                array( 
                "Status" =>  $StatusPayment     
            )); 
 


     /*   } else { 
            
            
            $makeRequestModelClass->save_change_patient_prescription(
                $db, 
                'prq_laboratory_table',
                array(
                    "patient_request_Id" => $prescribed_id,
                    "patient_Id" =>  $patient_id,
                    "laboratory_Id" => $selectedId 
                ),
                array( 
                "Status" =>"Paid"        
            ));

        }*/ 
 
       
        echo json_encode(array('result' =>"save")); 
    }
}


