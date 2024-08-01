let gDiscountSR =0;
let gDiscountPWD = 0;
var globaPesoFormatter;
$(function(){
    globaPesoFormatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    });
    let recordId = $('#hd_recordid').val();
    let hdPrescribeId = $('#hd_prescribe_id').val();
    getDescriptioRequest($, recordId, hdPrescribeId);
    getDisplayLabSelected( $, recordId, hdPrescribeId );

});


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
            $('#p-description-request').html(res.Description); 
            gDiscountSR = res['sr-discount'];
            gDiscountPWD = res['pwd-discount'];

            if( res['sr-discount'] > 0 ){
            //    $('#discountSr').val(gDiscountSR); 
                $('#discount-sr').html('('+globaPesoFormatter.format( gDiscountSR )+')');
 
            } else {
                gDiscountSR = 0;
            } 

            if( res['pwd-discount'] > 0 ){
             
                $('#discount-pwd').html('('+globaPesoFormatter.format( gDiscountPWD )+')');
           
            } else {
                gDiscountPWD = 0;
            }
       }
   });    
}


 
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
           //Avatar Section
        //   $('.profile-avatar-name').html(res.last_name +' '+res.first_name+', '+res.middle_name);
        //   $('.profile-avatar-patientnumber').html(res.patient_number);
 
   
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
            displayLabSelected($, res, function(res){ 
                window.print();
            }); 
       }
   });    

}

function displayLabSelected( $ , SelectedItems , callback ){
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
       //     paidColor ='#FF9800';
            buttonStatusLabel = 'Paid';
            
        } 

        // htmlTableLab +='<tr>';
        // htmlTableLab +='<td> '+row.Name+'</td>'; 
        // htmlTableLab +='<td>  Laboratory</td>';  
        // htmlTableLab +='<td> <button   class="btn btn-sm btn-outline-secondary handle-click-remove-selected-lab" data-isother="0" data-labid="'+row.Id+'"  '+disableRemoveAction+'> Remove </button> </td>'; 
        // htmlTableLab +='</tr>';
   
        if( row.OtherType == 'Laboratory'  ){
            if( row.Status == 'Paid'){
                htmlTableLabFrontLab +='<tr style=" background-color: '+paidColor+'" >';
                htmlTableLabFrontLab +='<td><span data-feather="thermometer"></span> '+row.Name+'</td>'; 
               
    
                    if(  row.AdjustUnitePrice > 0 ){
                        htmlTableLabFrontLab +='<td> (<del>'+globaPesoFormatter.format(row.UnitPrice)+'</del>) '+ globaPesoFormatter.format(row.AdjustUnitePrice) +'</td>'; 
                    } else {
                        htmlTableLabFrontLab +='<td> '+globaPesoFormatter.format(row.UnitPrice)+'</td>'; 
                    }
     
                htmlTableLabFrontLab +='</tr>'; 
            }
        } 
        
        if( row.OtherType == 'Medicine' ){
 
            let medName = row.medname+' '+row.Brand+' '+row.DosageForm; 

            htmlTableLabFrontMed +='<tr style=" background-color: '+paidColor+'" >'; 
            htmlTableLabFrontMed +='<td><span data-feather="thermometer"></span>  '+medName+'</td>'; 
        
            var pricehandle = 0;
            var qityhandle = 0;
            if(  row.AdjustQty > 0 ){
                htmlTableLabFrontMed +='<td> (<del>'+ row.Qty+'</del>) '+( row.AdjustQty  >0 ? row.AdjustQty: 0 )+'</td>';
                qityhandle = row.AdjustQty;
            } else {
                htmlTableLabFrontMed +='<td> '+ row.Qty +'</td>';
                qityhandle  = row.Qty;
            }

          
            if(  row.AdjustUnitePrice > 0 ){ 
                htmlTableLabFrontMed +='<td> (<del>'+globaPesoFormatter.format(row.UnitPrice)+'</del>) '+globaPesoFormatter.format(row.AdjustUnitePrice)+' </td>'; 
                pricehandle =  row.AdjustUnitePrice;
            } else { 
                htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format(row.UnitPrice)+'</td>'; 
                pricehandle =  row.UnitPrice;
            }
  
            htmlTableLabFrontMed +='<td> '+globaPesoFormatter.format( pricehandle * qityhandle )+'</td>'; 
            htmlTableLabFrontMed +='</tr>';
        }

        if( row.OtherType == 'Custom' ){
 
            htmlTableLabFrontOther +='<tr style=" background-color: '+paidColor+'" >';
            htmlTableLabFrontOther +='<td> '+row.Description+'</td>';  
            htmlTableLabFrontOther +='<td> '+globaPesoFormatter.format( row.UnitPrice )+'</td>';  
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

      var totaldiscount =  parseFloat(gDiscountSR) + parseFloat(gDiscountPWD);
 
    $('#total-lab-amount-deducted').html(globaPesoFormatter.format( (CustomSubotal + MedSubotal + labSubotal ) - totaldiscount));
    $('#total-amount').html( globaPesoFormatter.format((CustomSubotal + MedSubotal + labSubotal )) );
    
    if( htmlTableLabFrontLab != '' ){
        $('#table-selected-lab-list-front-lab').html(htmlTableLabFrontLab);
    } else {
        $('.table-selected-lab').hide();
    }

    if( htmlTableLabFrontMed != '' ){
        $('#table-selected-lab-list-front-Med').html(htmlTableLabFrontMed);
    } else {
        $('.table-selected-med').hide();
    }

    if( htmlTableLabFrontOther != '' ){ 
        $('#table-selected-lab-list-front-Other').html(htmlTableLabFrontOther); 
    } else {
        $('.table-selected-cust').hide(); 
    }

    callback('hell');

}