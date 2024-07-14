let globalMedItems = {};
let globalMedSelectedItem =  new Array(); 
$(function(){
    const pesoFormatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    });

    let recordId = $('#hd_recordid').val();
    let hdPrescribeId = $('#hd_prescribe_id').val();

    
    getAlMedicineItems($,'',pesoFormatter);


    $(document).on('click','.btn-add-selected-med-product', function(){
      
        let selectedId =  $(this).attr('data-medid') ;
        if( !productMedExists(selectedId) ){
            globalMedSelectedItem.push(globalMedItems[selectedId]);
        }

       displaySelectedMedicines($,globalMedSelectedItem);
 
    });

 
    $(document).on('click','.btn-cancel-selected-meds-product', function(){
        let selectedId =  $(this).attr('data-medid');
        
        if(productMedExists(selectedId) ){
            removeProductMed(selectedId);  
        }
        displaySelectedMedicines($,globalMedSelectedItem);
    });

    $('#Save-Selected-Med-items').click(function(){
        for (const index in globalMedSelectedItem) {
            var row = globalMedSelectedItem[index];

            var  medqty = $('#med-selected-qty-id'+row.Id).val();
            var  medunitprice = $('#med-selected-uniteprice-id'+row.Id).val();
            globalMedSelectedItem[index].Qty = medqty;
            globalMedSelectedItem[index].UnitPrice = medunitprice;
        }
        saveSelectedMedicine($,
            globalMedSelectedItem,
            hdPrescribeId,
            recordId
        );
    });
});
  

function getAlMedicineItems($,keySearch,pesoFormatter){
    let action      = 'GETALLMEDICINES';

    let ajaxParamData = { 
        action,
        keySearch 
    }; 
    $('#productMedTable').html(''); 
    $.ajax({ 
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            
            var res  =jsonData.result;
            
            let htmlTableMed= ''; 
            for (const row_index in res) {
                    let row = res[row_index]; 
                    globalMedItems[row.Id] = res[row_index];   
                    htmlTableMed += '<tr>' ; 
                    htmlTableMed += '<td>'+row.Name+'</td>' ; 
                    htmlTableMed += '<td>'+row.Brand+'</td>' ; 
                    htmlTableMed += '<td>'+row.DosageForm+'</td>' ; 
                    htmlTableMed += '<td>'+row.Strength+'</td>' ; 
                    htmlTableMed += '<td>'+row.Manufacturer+'</td>' ;  
                    htmlTableMed += '<td >'+pesoFormatter.format(row.Price)+'</td>' ; 
                    htmlTableMed += '<td >  <button class="btn btn-sm btn-outline-secondary btn-add-selected-med-product" data-medid="'+row.Id+'">  Add </button>   </td>' ; 
                    htmlTableMed += '</tr>' ; 
            }
    
            $('#productMedTable').html(htmlTableMed); 
 
       }
   }); 

}

function displaySelectedMedicines($,recordSelected){
    $('#selectedMedTable').html('');
    let htmlSelectedMed = '';
    for (const index in recordSelected) {
        var row = recordSelected[index];
        let medName = row.Name+' '+row.Brand+' '+row.DosageForm; 
        htmlSelectedMed +='<tr>';
        htmlSelectedMed += '<td>'+medName+'</td>';
        htmlSelectedMed +='<td> <input type="Number"  value="1" id="med-selected-qty-id'+row.Id+'"> </td>';
        htmlSelectedMed +='<td> <input type="text" value="'+ row.Price +'"  id="med-selected-uniteprice-id'+row.Id+'"> </td>';
        htmlSelectedMed +='<td><button  class="btn btn-sm btn-outline-secondary float-end btn-cancel-selected-meds-product" data-medid="'+row.Id+'"> remove </button></td>';
        htmlSelectedMed +='<tr>'; 
    }
    $('#selectedMedTable').html(htmlSelectedMed);
}

function productMedExists(id) {
    return globalMedSelectedItem.some(recordMed => recordMed.Id === id);
} 

function removeProductMed(id) {
    const index = globalMedSelectedItem.findIndex(SelectedItem => SelectedItem.Id === id);
    if (index !== -1) {
        globalMedSelectedItem.splice(index, 1); 
    }  
}

 
function saveSelectedMedicine($,items,prescribe_id,patient_id){

    let selectedItem = JSON.stringify(items);

    let action      = 'SAVESELECTEDMEDIEMS';

    let ajaxParamData = {
        action,
        selectedItem,
        prescribe_id,
        patient_id
    }; 
    $('#productTable').html(''); 
    $.ajax({ 
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;  

           console.log('SAVESELECTEDLABIEMS',res);
 
       }
   }); 

}