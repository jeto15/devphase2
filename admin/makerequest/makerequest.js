'use strict'

var LABORATORIESITEMS = {};
var LABORATORIESITEMSCOLLECTED = {}; 
var ISLABPRESCRIBEUPDATED = false;
var disablePaidAndUndpaidStatus = '0';
var globaPesoFormatter;
var gDiscountSR = 0;
var gDiscountPWD = 0;
var gDiscountOther =0;
var gGrantTotalAmount = 0;
var gRequestStatus = '';
var gIsLostStatus = '';
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

    $('#handle-submitforbilling').hide();
    $('#handle-submitforcancel').hide();
    $('#handle-submitforcomplete').hide();
    $('#handle-print-receipt').hide();
    $('#handle-submitforvoid').hide();
    $('#handle-submitforrefund').hide();
    

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
            savePrescriptions($,recordId.trim(),  hdPrescribeId, isUpdate);     
        }, 2000);
  
    });
 
    $( "#handle-save-prescribe" ).on( "click", function() { 
       loadingStart($(this))

    } );
 

    $(document).on('click','.handle-click-remove-selected-lab',function(){
        var selectLabItemId = $(this).attr('data-labid');   
        loadingStart($(this));
        removeLabItems($,recordId,hdPrescribeId,selectLabItemId, $(this)); 
    }); 
 
    $(document).on('click','.handle-click-as-paid-selected-lab',function(){
        var selectLabItemId = $(this).attr('data-labid');   
        var isstatuspaid =   $(this).attr('data-paid-status');  
        loadingStart($(this));
        changeAsPaid($,recordId,hdPrescribeId,selectLabItemId,isstatuspaid,$(this)); 
    });  
    
    $('.discountSr').hide();
    $('.discountPWD').hide();
    $('.discountOther').hide();
    $("#flexCheckSr,#flexCheckPWD,#flexCheckOther").change(function() {
        if($(this).prop('checked')) {

            $('.'+$(this).attr('data-relatedinput')).show();
 
        } else {
      
            if( $(this).attr('data-relatedinput') == 'discountSr'  ){
                applyDiscount(
                    $,
                    'sr',
                    parseFloat(0),
                    recordId,
                    hdPrescribeId
                );
    
            }
            if( $(this).attr('data-relatedinput') == 'discountPWD'  ){

            
                applyDiscount(
                    $,
                    'pwd',
                    parseFloat(0),
                    recordId,
                    hdPrescribeId
                );
    
            }

            if( $(this).attr('data-relatedinput') == 'discountOther'  ){

            
                applyDiscount(
                    $,
                    'other',
                    parseFloat(0),
                    recordId,
                    hdPrescribeId
                );
    
            }

            $('.'+$(this).attr('data-relatedinput')).hide();
            
          
        }
    });
    

    $('#btn-discountSr').click(function(){

        let srDisValue = $('#discountSr').val();

        if(parseFloat(srDisValue) > 0) {

            applyDiscount(
                $,
                'sr',
                parseFloat(srDisValue),
                recordId,
                hdPrescribeId
            );

        } else {
            alert('Atleast set discount Amount.');
        }

    });

    $('#btn-discountPWD').click(function(){

        let srDisValue = $('#discountPWD').val();

        if(parseFloat(srDisValue) > 0) {

            applyDiscount(
                $,
                'pwd',
                parseFloat(srDisValue),
                recordId,
                hdPrescribeId
            );

        } else {
            alert('Atleast set discount Amount.');
        }

    });

    
    $('#btn-discountOther').click(function(){

        let srDisValue = $('#discountOther').val();

        if(parseFloat(srDisValue) > 0) {

            applyDiscount(
                $,
                'other',
                parseFloat(srDisValue),
                recordId,
                hdPrescribeId
            );

        } else {
            alert('Atleast set discount Amount.');
        }

    });


    $('#handle-submitforbilling').click(function(){

        updateRequestStatus( $, 'To Billing', hdPrescribeId, recordId, 0 );

    }); 

    $('#handle-submitforcancel').click(function(){

        updateRequestStatus( $, 'Cancel', hdPrescribeId, recordId, 0 );

    }); 

    $('#handle-submitforcomplete').click(function(){

        updateRequestStatus( $, 'Billing Competed', hdPrescribeId, recordId, gGrantTotalAmount );

    }); 
    
    
    $('#handle-submitforvoid').click(function(){
        gIsLostStatus = 'Void';
        $('#VoidOrRefundFormModal').modal('show');
        $('#VoidOrRefundForm').html('Void Request');
    });

    $('#handle-submitforrefund').click(function(){
        gIsLostStatus = 'Refund';
        $('#VoidOrRefundFormModal').modal('show');
        $('#VoidOrRefundForm').html('Refund Request');
    });

    

    $('#hand-save-void-or-refund-requests').click(function(){
        if( confirm('Are you sure would like to proceed to '+gIsLostStatus+'?') ){
            if( gIsLostStatus == 'Void' ){
                updateRequestStatusToVoid($,recordId,hdPrescribeId);
            } 
            else if( gIsLostStatus == 'Refund' ) { 
                updateRequestStatusToRefund($,recordId,hdPrescribeId);
            }
        } 
       
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

function getDisplayLabSelected( $, patient_id,prescribe_id){
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
            paidColor ='#d1e7dd';
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
            
            if( gRequestStatus == 'Draft' ){
                updastatusHtml = '';
            }
            
            htmlTableLabFrontLab +='<tr style=" background-color: '+paidColor+'" >';
            htmlTableLabFrontLab +='<td><span data-feather="thermometer"></span> '+row.Name+'</td>'; 
           

                if(  row.AdjustUnitePrice > 0 ){
                    htmlTableLabFrontLab +='<td> <del>'+globaPesoFormatter.format(row.UnitPrice)+'</del></td>'; 
                } else {
                    htmlTableLabFrontLab +='<td> '+globaPesoFormatter.format(row.UnitPrice)+'</td>'; 
                }

            htmlTableLabFrontLab +='<td> '+globaPesoFormatter.format(row.AdjustUnitePrice)+'</td>'; 
                
           
            if( gRequestStatus == 'Billing Competed' || gRequestStatus == 'Void' || gRequestStatus == 'Cancel' ){
                htmlTableLabFrontLab +='<td > <p>'+ buttonStatusLabel +'</p> </td>';  
            } else {
                htmlTableLabFrontLab +='<td > <div class="btn-group float-end " role="group" > '+updateItemBtnHtml+''+ updastatusHtml +' '+removeBtnHtml+' </div> </td>';  
            }

            htmlTableLabFrontLab +='</tr>';
        } 
        
        if( row.OtherType == 'Medicine' ){
            var updateItemBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-update-item-modal-selected-med"  data-medid="'+row.medicine_Id+'" data-cartitemid="'+row.Id+'"  '+disableRemoveAction+'> Update Items </button>';
            var removeBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab"   data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button>';
            var updastatusHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-as-paid-selected-lab" data-isother="0" data-paid-status="'+buttonStatusLabel+'" data-labid="'+row.Id+'" '+isPaidActionDisable+'> '+buttonStatusLabel+' </button> ';
            
            if( gRequestStatus == 'Draft' ){
                updastatusHtml = '';
            }

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
 
            if(  row.AdjustUnitePrice > 0 ){ 
                htmlTableLabFrontMed +='<td> <del>'+globaPesoFormatter.format(row.UnitPrice)+'</del></td>'; 
                pricehandle =  row.AdjustUnitePrice;
            } else { 
                htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format(row.UnitPrice)+'</td>'; 
                pricehandle =  row.UnitPrice;
            }
 
            htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format(row.AdjustUnitePrice)+'</td>';
            htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format( pricehandle * qityhandle )+'</td>'; 
          
           
            
            if( gRequestStatus == 'Billing Competed' || gRequestStatus == 'Void' || gRequestStatus == 'Cancel' ){
                htmlTableLabFrontMed +='<td > <p>'+ buttonStatusLabel +'</p> </td>';  
            } else {
                htmlTableLabFrontMed +='<td   ><div  class="btn-group float-end "role="group" >  '+updateItemBtnHtml+''+ updastatusHtml +' '+removeBtnHtml+' </div> </td>';  
            }

            htmlTableLabFrontMed +='</tr>';
        }

        if( row.OtherType == 'Custom' ){

            var removeBtnHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab"   data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button>';
            var updastatusHtml = '<button   class="btn btn-sm btn-outline-secondary handle-click-as-paid-selected-lab"   data-paid-status="'+buttonStatusLabel+'" data-labid="'+row.Id+'" '+isPaidActionDisable+'> '+buttonStatusLabel+' </button> ';
            
            if( gRequestStatus == 'Draft' ){
                updastatusHtml = '';
            }

            htmlTableLabFrontOther +='<tr style=" background-color: '+paidColor+'" >';
            htmlTableLabFrontOther +='<td> '+row.Description+'</td>';  
            htmlTableLabFrontOther +='<td> '+globaPesoFormatter.format( row.UnitPrice )+'</td>';  
          
            if( gRequestStatus == 'Billing Competed' || gRequestStatus == 'Void' || gRequestStatus == 'Cancel' ){
                htmlTableLabFrontOther +='<td > <p>'+ buttonStatusLabel +'</p> </td>';  
            } else {
                htmlTableLabFrontOther +='<td > <div class="btn-group float-end " role="group" >  '+ updastatusHtml +' '+removeBtnHtml+' </div> </td>';  
            }
 
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

 
    var totaldiscount =  parseFloat( getTotalToDeduct(labSubotal,gDiscountSR) ) + parseFloat(getTotalToDeduct(labSubotal,gDiscountPWD));
 
    htmlTableLabFrontLab +='<tr>';
    htmlTableLabFrontLab +='<td> <span class="font-weight-bold">Subtotal: '+globaPesoFormatter.format(labSubotal)+'</span> </td>'; 
    htmlTableLabFrontLab +='</tr>';

    htmlTableLabFrontMed +='<tr>'; 
    htmlTableLabFrontMed +='<td >  <span class="font-weight-bold">Subtotal: '+globaPesoFormatter.format( MedSubotal )+'</span> </td>'; 
    htmlTableLabFrontMed +='</tr>';

    htmlTableLabFrontOther +='<tr>'; 
    htmlTableLabFrontOther +='<td >  <span class="font-weight-bold">Subtotal: '+globaPesoFormatter.format( CustomSubotal )+'</span> </td>'; 
    htmlTableLabFrontOther +='</tr>';
   
    let labGrandtotal = 0;
    if( (labSubotal - totaldiscount) > 0 ){
        labGrandtotal = labSubotal - totaldiscount;
        console.log(labGrandtotal); 
        labGrandtotal =  labGrandtotal - gDiscountOther;
    }  

    if( (CustomSubotal + MedSubotal + labGrandtotal) > 0 ){
        $('#handle-submitforcancel').prop('disabled', false);
        $('#handle-submitforcomplete').prop('disabled', false);
    } else {
        $('#handle-submitforcancel').prop('disabled', false);
        $('#handle-submitforcomplete').prop('disabled', true);
    }

    gGrantTotalAmount = (CustomSubotal + MedSubotal + labGrandtotal );
    $('#total-lab-amount-deducted').html(globaPesoFormatter.format( labGrandtotal ));
    $('#total-amount-to-pay').html( globaPesoFormatter.format(gGrantTotalAmount) );
    $('#table-selected-lab-list-front-lab').html(htmlTableLabFrontLab);
    $('#table-selected-lab-list-front-Med').html(htmlTableLabFrontMed);
    $('#table-selected-lab-list-front-Other').html(htmlTableLabFrontOther);  

 
}

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

    $(".discountPWD,#flexCheckPWD").prop("disabled", false);
    $(".discountSr ,#flexCheckSr").prop("disabled", false);
    $(".discountOther ,#flexCheckOther").prop("disabled", false);


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
            var docRes =jsonData.doctordetaisl[0];   
            $('#p-description-request').html(res.Description); 
            gDiscountSR = res['sr-discount'];
            gDiscountPWD = res['pwd-discount'];
            gDiscountOther = res['otherdiscount'];
            
            gRequestStatus = res['Status'];

            if( res['Status'] == 'Draft' ){
                
                $('#handle-submitforbilling').show();
                $('#handle-submitforcancel').show();

                $('#alert-card').removeClass( 'alert-primary' );
                $('#alert-card').removeClass( 'alert-danger' );
                $('#alert-card').removeClass( 'alert-success' );
                $('#alert-card').addClass( 'alert-info' );
                
                 
 
            } else  if( res['Status'] == 'To Billing' ){
                $('#handle-submitforcancel').show();
                $('#handle-submitforcomplete').show();

                $('#alert-card').removeClass( 'alert-info' );
                $('#alert-card').removeClass( 'alert-danger' );
                $('#alert-card').removeClass( 'alert-success' );
                $('#alert-card').addClass( 'alert-primary' );
                $('.discount-container').show(); 

            } else if( res['Status'] == 'Billing Competed'  ){
                $('#handle-print-receipt').show();
         

                $('#alert-card').removeClass( 'alert-info' );
                $('#alert-card').removeClass( 'alert-danger' );
                $('#alert-card').removeClass( 'alert-primary' );
                $('#alert-card').addClass( 'alert-success' );

                $('.discount-container').show(); 
                $(".discountPWD,#flexCheckPWD").prop("disabled", true);
                $(".discountSr ,#flexCheckSr").prop("disabled", true);
                $(".discountOther ,#flexCheckOther").prop("disabled", true);
 
                $('.hide-when-is-complete').hide();
                $('#handle-submitforvoid').show();
                $('#handle-submitforrefund').show();

                getFinaBilllingRecord($,patient_id,prescribe_id);
            } else {
                $('#alert-card').removeClass( 'alert-info' );
                $('#alert-card').removeClass( 'alert-success' );
                $('#alert-card').removeClass( 'alert-primary' );
                $('#alert-card').addClass( 'alert-danger' );

                $(".discountPWD,#flexCheckPWD").prop("disabled", true);
                $(".discountSr ,#flexCheckSr").prop("disabled", true);
                $(".discountOther ,#flexCheckOther").prop("disabled", true);
 
                $('.hide-when-is-complete').hide();
                getFinaBilllingRecord($,patient_id,prescribe_id);
              

            }
   
            if( res['sr-discount'] > 0 ){
                $('#discountSr').val(gDiscountSR); 
                $('.discountSr').show();
                $("#flexCheckSr").prop("checked", true);
            } else {
                gDiscountSR = 0;
            } 

            if( res['pwd-discount'] > 0 ){
                $('#discountPWD').val(gDiscountPWD);
                $('.discountPWD').show();
                $("#flexCheckPWD").prop("checked", true);
            } else {
                gDiscountPWD = 0;
            } 

            if( res['otherdiscount'] > 0 ){
                $('#discountOther').val(gDiscountOther);
                $('.discountOther').show();
                $("#flexCheckOther").prop("checked", true);
            } else {
                gDiscountOther = 0;
            } 

            if( jsonData.doctordetaisl != 0 ){ 
                $('#doctors-name').html(docRes.FirstName+' '+docRes.LastName);
            } else {
                $('#doctors-details').hide();
            }
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

function applyDiscount( $, type, amount, patient_id,prescribe_id) {

    let action      = 'APPLYDISCOUNT'; 
    let ajaxParamData = { 
        action,
        patient_id,
        prescribe_id,
        type,
        amount
    }; 
 
    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response); 
           var res  =jsonData.result[0];  
           location.reload();
       }
   });    

}

function updateRequestStatus($,statusType,prescribe_id,patient_id,totalAmount){

    let action      = 'UPDATEREQUESTSTATUS'; 
    let ajaxParamData = { 
        action, 
        prescribe_id,
        statusType,
        patient_id,
        totalAmount
    }; 
 
    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_ext_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);  
           location.reload();
       }
   });    
    
}

function getTotalToDeduct(labTotalAmount,percentDiscount){

    let deduction = (labTotalAmount * percentDiscount) / 100;
    //let final_amount = labTotalAmount - deduction;

    return deduction;

}

function getFinaBilllingRecord( $, patient_id,prescribe_id){
    let action      = 'GETFINALBILLING';

    let ajaxParamData = {
        action,
        patient_id,
        prescribe_id
    };

    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_ext_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
            var jsonData = JSON.parse(response);        
            var res  =jsonData.result;    
            $('#or-number').html(res[0].OrderReceiptNumber);
 
       }
   });    

}

function updateRequestStatusToVoid($, patient_id,prescribe_id){
    let action      = 'UPDATEREQUESTTOVOID';
    var input_reason = $('#description').val();
    let ajaxParamData = {
        action,
        patient_id,
        prescribe_id,
        input_reason
    };

    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_ext_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
            var jsonData = JSON.parse(response);        
            var res  =jsonData.result;     
            location.reload();
       } 
   });    
 
}


function updateRequestStatusToRefund($, patient_id,prescribe_id){
    let action      = 'UPDATEREQUESTTOREFUND';
    var input_reason = $('#description').val();
    let ajaxParamData = {
        action,
        patient_id,
        prescribe_id,
        input_reason
    };

    $.ajax({
        type: "POST",
        url: '../_controller/makerequest_ext_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
            var jsonData = JSON.parse(response);        
            var res  =jsonData.result;     
            location.reload();
       } 
   });    
 
}