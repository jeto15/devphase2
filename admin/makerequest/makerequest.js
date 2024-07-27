'use strict'

var LABORATORIESITEMS = {};
var LABORATORIESITEMSCOLLECTED = {}; 
var ISLABPRESCRIBEUPDATED = false;
var disablePaidAndUndpaidStatus = '0';
var globaPesoFormatter;
$(function(){

    /*
    * Init
    */

    globaPesoFormatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    });

    var TABARRAY = {
        'sc': {
            class: 'input-subs-complaints',
            title: 'Subjective complaints',
            inputId:'inputsubcomplaints',
            hasSession: false
        },
        'ap':
        {
            class: 'input-assesmentandphysicalexam',
            title: 'Assessment/Physical Exam',
            inputId:'inputassesmentandphysicalexam',
            hasSession: false
        },
        'pt':
        {
            class: 'input-plantandtreatment',
            title: 'Plan/Treatment',
            inputId:'inputplantandtreatment',
            hasSession: false

        },
        'dl':
        {
            class: 'input-dianostandlaboratories',
            title: 'Diagnostic/Laboratories',
            inputId:'',
            hasSession: false
        },
        'imp':
        {
            class: 'input-impression',
            title: 'Impression',
            inputId:'inputimpression',
            hasSession: false
        }
    };

    var SESSIONTAB = '';
    
    
    

  
    let recordId = $('#hd_recordid').val();
    let hdPrescribeId = $('#hd_prescribe_id').val();
    let isUpdate = false;
    var SelectedTypeLabType = 'Medicine';
    disablePaidAndUndpaidStatus = $('#hd_restric_statuspaid_action').val();
    
    getDescriptioRequest($,recordId,hdPrescribeId);

    var getTempSC = localStorage.getItem('tmpSave'+recordId+'sc'+hdPrescribeId);
    var getTempAP = localStorage.getItem('tmpSave'+recordId+'ap'+hdPrescribeId);
    var getTempPT = localStorage.getItem('tmpSave'+recordId+'pt'+hdPrescribeId);
    var getTempIMP = localStorage.getItem('tmpSave'+recordId+'imp'+hdPrescribeId); 
    if(recordId != '' && hdPrescribeId != ''){
 
       isUpdate = 'update';

       if(getTempSC !== null)
       {    
            $('#handle-save-prescribe').attr('disabled', false);
            $('#'+TABARRAY['sc'].inputId ).summernote('code',getTempSC);
            TABARRAY['sc'].hasSession = true;
            
       }  
       if(getTempAP !== null) 
       {    
            $('#handle-save-prescribe').attr('disabled', false);
            $('#'+TABARRAY['ap'].inputId ).summernote('code', getTempAP);
            TABARRAY['ap'].hasSession = true;
       }  
       if(getTempPT !== null)
       {
            $('#handle-save-prescribe').attr('disabled', false);
             $('#'+TABARRAY['pt'].inputId ).summernote('code', getTempPT);
             TABARRAY['pt'].hasSession = true;
       }  
       if(getTempIMP !== null)
       {
            $('#handle-save-prescribe').attr('disabled', false);
            $('#'+TABARRAY['imp'].inputId ).summernote('code', getTempIMP);
            TABARRAY['imp'].hasSession = true;

       }  
 
       getAllPrescriptions($,recordId,hdPrescribeId, TABARRAY);
    
 
    } else {
       isUpdate = 'new';
       if(getTempSC !== null)
       {
            $('#handle-save-prescribe').attr('disabled', false);
            $('#'+TABARRAY['sc'].inputId ).summernote('code',getTempSC);
       }  
       if(getTempAP !== null)
       {
            $('#handle-save-prescribe').attr('disabled', false);
            $('#'+TABARRAY['ap'].inputId ).summernote('code', getTempAP);
       }  
       if(getTempPT !== null)
       {
            $('#handle-save-prescribe').attr('disabled', false);    
             $('#'+TABARRAY['pt'].inputId ).summernote('code', getTempPT);
       }  
       if(getTempIMP !== null)
       {
            $('#handle-save-prescribe').attr('disabled', false);
            $('#'+TABARRAY['imp'].inputId ).summernote('code', getTempIMP);
       } 
 
    }
  
    getPatientRecordById($,recordId);
   // getAllLaboratories($,'');
    getDisplayLabSelected($,recordId,hdPrescribeId);

    
    $('.Lab-container-manage-other').hide();

    // Summernote
    $('.summernote-textarea').summernote(
        {
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
          }
    ); 

    $(document).on('click','.request-add-description', function(){
       // $(this).html('Saving..');
        loadingStart($(this))
        let tabType =  $(this).attr('data-descript-tab');
        
        var markupStr = $('#'+TABARRAY[tabType].inputId).summernote('code');
        var keyTempStore = 'tmpSave'+recordId.trim()+tabType+hdPrescribeId; 
        localStorage.setItem(keyTempStore, markupStr);

        setTimeout(() => { 
          
            loadingEnd($(this), 'Save Draft');
            $('#handle-save-prescribe').attr('disabled', false);
        }, 1000);
  
    });
 
    $( "#handle-save-prescribe" ).on( "click", function() { 
       loadingStart($(this))
       savePrescriptions($,recordId.trim(),  hdPrescribeId, isUpdate);     
    } );
 
    // $(document).on('click','.handle-click-Add-lab',function(){
    //     loadingStart($(this));
    //     var selectLabItemId = $(this).attr('data-labid'); 

    //     if( typeof LABORATORIESITEMSCOLLECTED[selectLabItemId] === 'undefined' ){
    //         saveLabItems($,recordId,hdPrescribeId,selectLabItemId,$(this)); 
    //     } else {
    //         alert("Ops! Its already in the list, Please review the Laboratories List");
    //         loadingEnd($(this),'Add');
    //     }
  
    // });

    $(document).on('click','.handle-click-remove-selected-lab',function(){
        var selectLabItemId = $(this).attr('data-labid');   
        loadingStart($(this));
        removeLabItems($,recordId,hdPrescribeId,selectLabItemId, $(this)); 
    }); 

    // $(document).on('keyup','#Handle-Search-Lab',function(){
    //     let keyWord = $(this).val(); 
    //     getAllLaboratories($,keyWord); 
    // });

    // $(document).on('click','#handle-add-other-prescription', function(){
    //     let prescribedKeyWorkd = $("#input-other-Lab").val(); 
    //     loadingStart($(this));
    //     saveOtherPrescription($,recordId,hdPrescribeId,prescribedKeyWorkd,SelectedTypeLabType, $(this));
    // }); 
 
    // $(document).on('click','.nav-lab-add',function(){
    //     $( '.lab-container' ).hide();
    //     $( '.'+$(this).attr('data-tab-container') ).show();
    //     $( '.nav-lab-add' ).removeClass('active');
    //     $(this).addClass('active');
    // }); 


    // $('.radio-as-other-type').on('change', function(e) {

    //     SelectedTypeLabType = e.target.value; 
    // });

    $(document).on('click','.handle-click-as-paid-selected-lab',function(){
        var selectLabItemId = $(this).attr('data-labid');   
        var isstatuspaid =   $(this).attr('data-paid-status');  
        loadingStart($(this));
        changeAsPaid($,recordId,hdPrescribeId,selectLabItemId,isstatuspaid,$(this)); 
    });  

   


    
 
}); 
 
function getPatientRecordById($,id){

    let action      = 'GETPATIENTRECORDBYID';
 

    let ajaxParamData = {
        action,
        id
    };

    $.ajax({
        type: "POST",
        url: '../_controller/patientprofile_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;
           var resAvatar  =jsonData.avatarpic;
          
           
           if( resAvatar != null ){
                $('#profile-avatar-image').attr('src','../uploads/pid'+resAvatar.patient_id+'/'+resAvatar.name); 
           } 
 
           $('#patient-num-name').html(res.patient_number);
           $('#fname-name').html(res.first_name);
           $('#lname-name').html(res.last_name);
           $('#mname-name').html(res.middle_name);
           $('#age-name').html(res.age);
           $('#sex-name').html(res.gender);
           $('#bday-name').html(res.birthday);
           $('#address-text').html(res.address);

           //Avatar Section
           $('.profile-avatar-name').html(res.last_name +' '+res.first_name+', '+res.middle_name);
           $('.profile-avatar-patientnumber').html(res.patient_number);
 
   
       }
   });    
} 


function savePrescriptions($,id, hdPrescribeId, isUpdate){

    var getTempSC = localStorage.getItem('tmpSave'+id+'sc'+hdPrescribeId);
    var getTempAP = localStorage.getItem('tmpSave'+id+'ap'+hdPrescribeId);
    var getTempPT = localStorage.getItem('tmpSave'+id+'pt'+hdPrescribeId);
    var getTempIMP = localStorage.getItem('tmpSave'+id+'imp'+hdPrescribeId);
 
    let prescription_sc  = '';
    let prescription_ap  = '';
    let prescription_pt  = '';
    let prescription_imp  = ''; 
   
    if(getTempSC !== null)
    {
        prescription_sc = getTempSC;
    }  
    if(getTempAP !== null)
    {
        prescription_ap = getTempAP;
    }  
    if(getTempPT !== null)
    {
        prescription_pt = getTempPT;
    }  
    if(getTempIMP !== null)
    {
        prescription_imp = getTempIMP;
    }  

    

    
    let action      = 'SAVEPRESCRIPTION';

    let ajaxParamData = {
        action,
        id,
        prescription_sc,
        prescription_ap,
        prescription_pt,
        prescription_imp, 
        hdPrescribeId,
        isUpdate
    };

    
    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            loadingEnd($('#handle-save-prescribe'), 'Save Request');
            setTimeout(() => {  
                localStorage.removeItem('tmpSave'+id+'sc'+hdPrescribeId);
                localStorage.removeItem('tmpSave'+id+'ap'+hdPrescribeId);
                localStorage.removeItem('tmpSave'+id+'pt'+hdPrescribeId);
                localStorage.removeItem('tmpSave'+id+'imp'+hdPrescribeId);
                localStorage.removeItem('tmpSave'+id+'dl'+hdPrescribeId);

               // window.location.href = "../patientprofile/?id="+id;      
            }, 2000);
   
       }
   });    

}


function getAllPrescriptions($,patient_id,prescribe_id,tabArry){
    
    let action      = 'GETALLPATIENTPRESCRIBED';
 
    let ajaxParamData = {
        action, 
        patient_id,
        prescribe_id
    }; 

    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;

           for (const row_index in res) {
            let row = res[row_index];
      
                if( typeof row.Type !== 'undefined' ){
                    
                    if( !tabArry[row.Type.toLowerCase()].hasSession ){
                        $('#'+tabArry[row.Type.toLowerCase()].inputId ).summernote('code', row.Description);
                    }
                }
               
                
           }
 
       }
   });    
}

// function getAllLaboratories($,keySearch){
//     let action      = 'GETALLLABORATORIES';

//     let ajaxParamData = {
//         action,
//         keySearch 
//     }; 

//     $.ajax({ 
//         type: "POST",
//         url: '../_controller/makerequest_controller.php',
//         data: ajaxParamData,
//         success: function(response)
//         {
//            var jsonData = JSON.parse(response);
           
//            var res  =jsonData.result;

//            let htmlTableLab = '';

//            for (const row_index in res) {
//                 let row = res[row_index]; 
//                 LABORATORIESITEMS[row.Id] = row;
//                 htmlTableLab +='<tr>';
//                  htmlTableLab +='<td>'+row.Name+'</td>'; 
//                 htmlTableLab +='<td style="text-align: right;"> <button   class="btn btn-sm btn-outline-secondary handle-click-Add-lab" data-labid="'+row.Id+'"> Add </button> </td>'; 
//                 htmlTableLab +='</tr>';
//            }
  
//            $('#tableList_of_laboratory').html(htmlTableLab);
 
//        }
//    });    

// }

function getDisplayLabSelected( $, patient_id,prescribe_id){


    console.log(globaPesoFormatter);

    var keyStorage = 'tmpSave'+patient_id+'dl'+prescribe_id;
    var collectedOtherPres = [];
    let action      = 'GETDISPLAYLABSELECTED';

    let ajaxParamData = {
        action,
        patient_id,
        prescribe_id
    };

    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
            var jsonData = JSON.parse(response);
           
            var res  =jsonData.result;   
            // var collectSelectedLabs = [];
            // for (const row_index in res) {
            //     let row = res[row_index];   
            //     if( row.isOther == "1" ){
            //         collectedOtherPres.push(row);
            //     } else {
            //         LABORATORIESITEMSCOLLECTED[row.laboratory_Id] = LABORATORIESITEMS[row.laboratory_Id];
            //         LABORATORIESITEMS[row.laboratory_Id]['Status']= row.Status ?? '';
            //         LABORATORIESITEMS[row.laboratory_Id]['labId']= row.Id;
            //         collectSelectedLabs.push(LABORATORIESITEMS[row.laboratory_Id]);
            //     }   
                
               
            // }

            displayLabSelected($, res); 
 
       }
   });    

}

function displayLabSelected( $ , SelectedItems ){

    

    var isPaidActionDisable = '';
    if(disablePaidAndUndpaidStatus == '0'){
        isPaidActionDisable = 'disabled';
    }

    var htmlTableLab = '';
    var htmlTableLabFrontLab = '';
    var htmlTableLabFrontMed = '';
    var htmlTableLabFrontOther = '';
 
    for (const row_index in SelectedItems) {
       
        let row = SelectedItems[row_index]; 
         
        var paidColor ='var(--bs-table-bg)';


        var disableRemoveAction = '';
        var buttonStatusLabel = 'Unpaid';

        if( row.Status == 'Paid'){
            paidColor ='#FF9800';
            buttonStatusLabel = 'Paid';
            disableRemoveAction = 'disabled';
        } 

        // htmlTableLab +='<tr>';
        // htmlTableLab +='<td> '+row.Name+'</td>'; 
        // htmlTableLab +='<td>  Laboratory</td>';  
        // htmlTableLab +='<td> <button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab" data-isother="0" data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button> </td>'; 
        // htmlTableLab +='</tr>';
   
        if( row.OtherType == 'Laboratory'  ){
            var updateItemBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-update-item-modal-selected-lab"  data-labid="'+row.laboratory_Id+'" data-cartitemid="'+row.Id+'"  '+disableRemoveAction+'> Update Items </button>';
            var removeBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab"   data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button>';
            var updastatusHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-as-paid-selected-lab"   data-paid-status="'+buttonStatusLabel+'" data-labid="'+row.Id+'" '+isPaidActionDisable+'> '+buttonStatusLabel+' </button> ';
            htmlTableLabFrontLab +='<tr style=" background-color: '+paidColor+'" >';
            htmlTableLabFrontLab +='<td><span data-feather="thermometer"></span> '+row.Name+'</td>'; 
           

                if(  row.AdjustUnitePrice > 0 ){
                    htmlTableLabFrontLab +='<td> <del>'+globaPesoFormatter.format(row.UnitPrice)+'</del></td>'; 
                } else {
                    htmlTableLabFrontLab +='<td> '+globaPesoFormatter.format(row.UnitPrice)+'</td>'; 
                }

            htmlTableLabFrontLab +='<td> '+globaPesoFormatter.format(row.AdjustUnitePrice)+'</td>'; 
            htmlTableLabFrontLab +='<td > <div class="btn-group float-end " role="group" > '+updateItemBtnHtml+''+ updastatusHtml +' '+removeBtnHtml+' </div> </td>';  
            htmlTableLabFrontLab +='</tr>';
        } 
        
        if( row.OtherType == 'Medicine' ){
            var updateItemBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-update-item-modal-selected-med"  data-medid="'+row.medicine_Id+'" data-cartitemid="'+row.Id+'"  '+disableRemoveAction+'> Update Items </button>';
            var removeBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab"   data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button>';
            var updastatusHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-as-paid-selected-lab" data-isother="0" data-paid-status="'+buttonStatusLabel+'" data-labid="'+row.Id+'" '+isPaidActionDisable+'> '+buttonStatusLabel+' </button> ';
            
            let medName = row.medname+' '+row.Brand+' '+row.DosageForm; 

            htmlTableLabFrontMed +='<tr style=" background-color: '+paidColor+'" >'; 
            htmlTableLabFrontMed +='<td><span data-feather="thermometer"></span>  '+medName+'</td>'; 
        
            var pricehandle = 0;
            var qityhandle = 0;
            if(  row.AdjustQty > 0 ){
                htmlTableLabFrontMed +='<td> <del>'+ row.Qty+'</del></td>';
                qityhandle = row.AdjustQty;
            } else {
                htmlTableLabFrontMed +='<td> '+ row.Qty +'</td>';
                qityhandle  = row.Qty;
            }

            htmlTableLabFrontMed +='<td> '+ ( row.AdjustQty  >0 ? row.AdjustQty: 0 ) +'</td>';
            console.log(row.AdjustUnitePrice > 0);
            if(  row.AdjustUnitePrice > 0 ){
                console.log('solod');
                htmlTableLabFrontMed +='<td> <del>'+globaPesoFormatter.format(row.UnitPrice)+'</del></td>'; 
                pricehandle =  row.AdjustUnitePrice;
            } else {
                console.log('solod');
                htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format(row.UnitPrice)+'</td>'; 
                pricehandle =  row.UnitPrice;
            }
 
            htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format(row.AdjustUnitePrice)+'</td>';
            htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format( pricehandle * qityhandle )+'</td>'; 
            htmlTableLabFrontMed +='<td   ><div  class="btn-group float-end "role="group" >  '+updateItemBtnHtml+''+ updastatusHtml +' '+removeBtnHtml+' </div> </td>';  
            htmlTableLabFrontMed +='</tr>';
        }

        if( row.OtherType == 'Custom' ){

            var removeBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab"   data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button>';
            var updastatusHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-as-paid-selected-lab"   data-paid-status="'+buttonStatusLabel+'" data-labid="'+row.Id+'" '+isPaidActionDisable+'> '+buttonStatusLabel+' </button> ';
           

            htmlTableLabFrontOther +='<tr style=" background-color: '+paidColor+'" >';
            htmlTableLabFrontOther +='<td> '+row.Description+'</td>';  
            htmlTableLabFrontOther +='<td> '+globaPesoFormatter.format( row.UnitPrice )+'</td>';  
            htmlTableLabFrontOther +='<td > <div class="btn-group float-end " role="group" >  '+ updastatusHtml +' '+removeBtnHtml+' </div> </td>';  
            htmlTableLabFrontOther +='</tr>';
        }

   }


   let labSubotal = 0;
   let MedSubotal = 0;
   let CustomSubotal = 0;
   for (const row_index in SelectedItems) {
        let row = SelectedItems[row_index]; 
     
        if( row.Status == 'Paid'){
            if( row.OtherType == 'Laboratory'  ){
            
                let unitPrice =0;
                if(   row.AdjustUnitePrice > 0 ){
                     unitPrice = parseFloat( row.AdjustUnitePrice );
                } else {
                     unitPrice = parseFloat(row.UnitPrice);
                }

              
                labSubotal  += unitPrice;
            }
    
            if( row.OtherType == 'Medicine' ){

                var pricehandle = 0;
                var qityhandle = 0;
                if( row.AdjustQty > 0 ){
                    qityhandle = row.AdjustQty;
                } else {
                    qityhandle  = row.Qty;
                }
         
                if( row.AdjustUnitePrice > 0 ){ 
                    pricehandle =  row.AdjustUnitePrice;
                } else {
                    pricehandle =  row.UnitPrice;
                }

                let unitPrice = parseFloat(pricehandle * qityhandle);
                MedSubotal  += unitPrice;
            }

            if( row.OtherType == 'Custom' ){
                CustomSubotal  += parseFloat(row.UnitPrice);
            }
        }

   }

   
    htmlTableLabFrontLab +='<tr>';
    htmlTableLabFrontLab +='<td> <span class="font-weight-bold">Subtotal: '+globaPesoFormatter.format(labSubotal)+'</span> </td>'; 
    htmlTableLabFrontLab +='</tr>';

    htmlTableLabFrontMed +='<tr>'; 
    htmlTableLabFrontMed +='<td >  <span class="font-weight-bold">Subtotal: '+globaPesoFormatter.format( MedSubotal )+'</span> </td>'; 
    htmlTableLabFrontMed +='</tr>';

    htmlTableLabFrontOther +='<tr>'; 
    htmlTableLabFrontOther +='<td >  <span class="font-weight-bold">Subtotal: '+globaPesoFormatter.format( CustomSubotal )+'</span> </td>'; 
    htmlTableLabFrontOther +='</tr>';
    
 

   




  $('#total-amount-to-pay').html( globaPesoFormatter.format((CustomSubotal + MedSubotal + labSubotal )) );
   $('#table-selected-lab-list-front-lab').html(htmlTableLabFrontLab);
   $('#table-selected-lab-list-front-Med').html(htmlTableLabFrontMed);
   $('#table-selected-lab-list-front-Other').html(htmlTableLabFrontOther);

}



// function saveLabItems($, patient_id,prescribe_id,selectedId,thisElement){
        
//     let action      = 'SAVESELECTEDLAB';
 

//     let ajaxParamData = {
//         action,
//         patient_id,
//         prescribe_id,
//         selectedId
//     };

//     $.ajax({
//         type: "POST",
//         url: '../_controller/makerequest_controller.php',
//         data: ajaxParamData,
//         success: function(response)
//         {
//            var jsonData = JSON.parse(response);
           
//            var res  =jsonData.result;

//            getDisplayLabSelected($,patient_id,prescribe_id);

//            loadingEnd(thisElement,'Add');

//        } 
//    });    
// }

// function saveOtherPrescription($, patient_id,prescribe_id,prescribedKey, SelectedTypeLabType, thisElement){
//     let action      = 'SAVESELECTEDLABOTHER';
 

//     let ajaxParamData = {
//         action,
//         patient_id,
//         prescribe_id,  
//         prescribedKey,
//         SelectedTypeLabType
//     };

//     $.ajax({
//         type: "POST", 
//         url: '../_controller/makerequest_controller.php',
//         data: ajaxParamData,
//         success: function(response)
//         {
//            var jsonData = JSON.parse(response);
           
//            var res  =jsonData.result;

//            getDisplayLabSelected($,patient_id,prescribe_id);
//            loadingEnd(thisElement,'Add Other');

//        }
//    });   
// }

function removeLabItems($, patient_id,prescribe_id,selectedId,thisElement){
        
    let action      = 'REMOVEDSELECTEDLAB';
 

    let ajaxParamData = {
        action, 
        patient_id,
        prescribe_id,
        selectedId 
    };

    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;

           getDisplayLabSelected($,patient_id,prescribe_id);
           loadingEnd(thisElement,'Remove');

       }
   });    
}

function changeAsPaid($, patient_id,prescribe_id,selectedId, isstatuspaid, thisElement){
        
    let action      = 'LABANDMEDANDOTHERASPAID';
 
    let ajaxParamData = {
        action, 
        patient_id,
        prescribe_id,
        selectedId, 
        isstatuspaid
    };

    
    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;

           getDisplayLabSelected($,patient_id,prescribe_id);
           loadingEnd(thisElement,'...');

       }
   });    
}

function getDescriptioRequest($,patient_id,prescribe_id){
            
    let action      = 'GETDESCRIPTIONREQUEST'; 
    let ajaxParamData = { 
        action,
        patient_id,
        prescribe_id
    };
 
    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response); 
           var res  =jsonData.result[0]; 
           console.log('res',res);
           $('#p-description-request').html(res.Description); 
 
       }
   });    
}

function loadingStart( thisElement ){
    thisElement.html(
    '<div class="spinner-border text-danger" role="status">'+
        '<span class="visually-hidden">Loading...</span>'+
    '</div>'
     )
    thisElement.prop(
        "disabled",
        true
    );
}

function loadingEnd( thisElement, origButtonName ){
    thisElement.prop(
        "disabled",
        false
    );
    thisElement.html(
        origButtonName
    )
}


 


