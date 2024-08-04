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
                "modified_by" => $USERID
                
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

 
 
            $makeRequestModelClass->clear_selected_Labs($db,array(
                "Id" =>  $selectedId
            ));
      
        echo json_encode(array('result' =>"save")); 
    }
    
    if(  $action  == 'LABANDMEDANDOTHERASPAID' ){

        $selectedId  = $_POST['selectedId'];
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id']; 
        $isStatusPaid = $_POST['isstatuspaid'];
 
            
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
 
       
        echo json_encode(array('result' =>"save")); 
    }

    if( $action == 'GETDESCRIPTIONREQUEST' ){
        $patient_id  = $_POST['patient_id'];
        $request_id  = $_POST['prescribe_id'];

        $result =   $makeRequestModelClass->get_patient_request_table($db,  $patient_id, $request_id );
 
        if(  $result[0]['AssignedToId'] != null ){
            $resultDoctor =   $makeRequestModelClass->get_doctorsdetaisl_table($db, (int)$result[0]['AssignedToId']  );
        } else {
            $resultDoctor  = array();
        }
   
      // $resultDoctor = $result[0]->AssignedToId;
        echo json_encode(array('result' => $result, 'doctordetaisl' => $resultDoctor));
    }

    if( $action == 'SAVESELECTEDLABIEMS' ){  
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];
        $selectedLabItemsJson = json_decode($_POST['selectedItem'],true);
 
        foreach( $selectedLabItemsJson  as $items){ 
            $itemRecord = array(
                "patient_Id" => $patient_id,
                "patient_request_Id" => $prescribed_id,
                "laboratory_Id" => $items['Id'] ,  
                "created_date" =>   date('Y-m-d H:i:s'),
                "UnitPrice" =>  floatval( $items['listprice'] ),
                "OtherType" =>  "Laboratory",
                "created_by_Id" => $USERID
            ); 
            $makeRequestModelClass->save_new_prescription($db,'prq_laboratory_table' ,  $itemRecord);  
        }

        echo json_encode(array('result' =>"save")); 
    }


    if( $action == 'GETALLMEDICINES'){
        $keyword = $_POST['keySearch'];
        $result =   $makeRequestModelClass->getAllMed($db, $keyword);
        echo json_encode(array('result' => $result));
    }

    if(  $action == 'SAVESELECTEDMEDIEMS' ){

        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];
        $selectedLabItemsJson = json_decode($_POST['selectedItem'],true);
 
        foreach( $selectedLabItemsJson  as $items){ 
            $itemRecord = array(
                "patient_Id" => $patient_id,
                "patient_request_Id" => $prescribed_id,
                "medicine_Id" => $items['Id'] ,  
                "created_date" =>   date('Y-m-d H:i:s'),
                "UnitPrice" =>  floatval( $items['UnitPrice'] ),
                "Qty" =>    $items['Qty'],
                "OtherType" =>  "Medicine",
                "created_by_Id" => $USERID
            ); 
            $makeRequestModelClass->save_new_prescription($db,'prq_laboratory_table' ,  $itemRecord);  
        }
        
        echo json_encode(array('result' =>"save")); 

    }

    if( $action == 'GETSINGLEABORATORY')
    { 
        $keyword = $_POST['recordId'];
        $result =   $makeRequestModelClass->get_record_requestitem_by_id($db, $keyword);
        echo json_encode(array('result' => $result));
    }

    if( $action == 'UPDATECARTLABITEM' ){

        $recordId = $_POST['recordId'];
        $NewUnitPrice = $_POST['NewUnitPrice'];


        $fieldsToUpdate = array();

        if(  $_POST['typeOf'] == 'LabItem' ){
            $fieldsToUpdate = array( 
                "AdjustUnitePrice" =>  $NewUnitPrice   
            );
        }

        if( $_POST['typeOf'] == 'MedItem' ){
            $NewQty   = $_POST['NewQty']; 
            $fieldsToUpdate = array( 
                "AdjustUnitePrice" =>  $NewUnitPrice,
                "AdjustQty" =>  $NewQty   
            );
        }
        
        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'prq_laboratory_table',
            array(
                "Id" => $recordId 
            ), 
            $fieldsToUpdate 
        ); 

        echo json_encode(array('result' =>"save")); 

    }   

    if( $action == 'SAVEADDEDCUSTITEMS' ) {
        
        $patient_id  = $_POST['patient_id'];
        $prescribed_id  = $_POST['prescribe_id'];
        $customAmount  = $_POST['customAmount'];
        $DescriptionRequest  = $_POST['DescriptionRequest'];
 

        $itemRecord = array(
            "patient_Id" => $patient_id,
            "patient_request_Id" => $prescribed_id, 
            "created_date" =>   date('Y-m-d H:i:s'),
            "Description" => $DescriptionRequest,
            "UnitPrice" =>  floatval( $customAmount ),
            "OtherType" =>  "Custom",
            "created_by_Id" => $USERID
        ); 
        $makeRequestModelClass->save_new_prescription($db,'prq_laboratory_table' ,  $itemRecord);  

        echo json_encode(array('result' =>"save"));  

    }

    if( $action == 'APPLYDISCOUNT' ) {
 
        $prescribed_id  = $_POST['prescribe_id'];
        $type  = $_POST['type'];
        $discountAmount  = $_POST['amount'];

        $updateData = array();

        if(  $type == 'sr' ) {
            $updateData=  array(
                "sr-discount" =>$discountAmount, 
            );
        } else {
            $updateData=  array(
                "pwd-discount" =>$discountAmount, 
            );
        }

        $makeRequestModelClass->save_change_patient_prescription(
            $db, 
            'patient_request_table',
            array(
                "Id" => $prescribed_id 
            ), 
            $updateData
        ); 

        echo json_encode(array('result' =>"save"));  


    }
 
}


 