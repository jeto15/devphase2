let globalLabItems = {};
let globalLabSelectedItem = []; 

 $(function(){

    let CartID = '';

    const pesoFormatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    });

    let recordId = $('#hd_recordid').val();
    let hdPrescribeId = $('#hd_prescribe_id').val();

    $('#search').on('input', function() {
        const filter = $(this).val();
        getAllLaboratoriesItems($,filter,pesoFormatter); 
    });

    // renderProducts();

    getAllLaboratoriesItems($,'',pesoFormatter); 

    $(document).on('click','.btn-add-selected-lab-product', function(){
        let selectedId =  $(this).attr('data-labid');
        
        if( !productLabExists(selectedId) ){
            globalLabSelectedItem.push(globalLabItems[selectedId]);
        }
        displaySelectedLab($); 
    });

    $(document).on('click','.btn-cancel-selected-lab-product', function(){
        let selectedId =  $(this).attr('data-labid');
        
        if(productLabExists(selectedId) ){
            removeProductLab(selectedId);  
        }
        displaySelectedLab($); 
    });
     
    $('#Save-Selected-lab-items').click(function(){

        if( globalLabSelectedItem.length != 0 ){

            saveSelectLabItems(
                $,
                globalLabSelectedItem,
                hdPrescribeId,
                recordId,
                hdPrescribeId
            );  

        } else {
            alert('Sorry no record to save')
        }

    });

    $(document).on('click','.handle-click-update-item-modal-selected-lab',function(){

        $('#updateItemModal').modal('show');
        var labId  = $(this).attr('data-labid');
        var cartId = $(this).attr('data-cartitemid');
        CartID = cartId;
        getSingleLabRecord($,cartId);

    });

    $('#btn-save-lab-cart-change').click(function(){

        let updateUnitPrice =  $('#itemLabListPrice').val();
        updateCartLabItem($,
            CartID,
            updateUnitPrice,
            recordId,
            hdPrescribeId
        );


    });
    

}); 

function getAllLaboratoriesItems($,keySearch,pesoFormatter){
    let action      = 'GETALLLABORATORIES';

    let ajaxParamData = {
        action,
        keySearch 
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

           let htmlTableLab = '';

           for (const row_index in res) {
                let row = res[row_index]; 
                globalLabItems[row.Id] = res[row_index]; 
                htmlTableLab += '<tr>' ; 
                htmlTableLab += '<td>'+row.Name+'</td>' ; 
                htmlTableLab += '<td >'+pesoFormatter.format(row.listprice)+'</td>' ; 
                htmlTableLab += '<td >  <button class="btn btn-sm btn-outline-secondary btn-add-selected-lab-product" data-labid="'+row.Id+'">  Add </button>   </td>' ; 
                htmlTableLab += '</tr>' ; 
           }
  
           $('#productTable').html(htmlTableLab); 
 
       }
   }); 

}

function displaySelectedLab($){
    const selectedItems = $('#selectedItems');

    selectedItems.empty();
    console.log('globalLabSelectedItem',globalLabSelectedItem);
    let htmlSelectedLabItems = '';
    for (const row_index in globalLabSelectedItem) {
        let row = globalLabSelectedItem[row_index]; 
        htmlSelectedLabItems += '<li class="list-group-item">'+ row.Name +'   <button  class="btn btn-sm btn-outline-secondary float-end btn-cancel-selected-lab-product" data-labid="'+row.Id+'"> remove </button> </li>';
    }
    selectedItems.html(htmlSelectedLabItems);
}

function productLabExists(id) {
    return globalLabSelectedItem.some(SelectedItem => SelectedItem.Id === id);
} 

function removeProductLab(id) {
    const index = globalLabSelectedItem.findIndex(SelectedItem => SelectedItem.Id === id);
    if (index !== -1) {
        globalLabSelectedItem.splice(index, 1); 
    }  
}

function saveSelectLabItems($,items,prescribe_id,patient_id){

    let selectedItem = JSON.stringify(items);

    let action      = 'SAVESELECTEDLABIEMS';

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

function getSingleLabRecord($,recordId){
 
    let action      = 'GETSINGLEABORATORY';

    let ajaxParamData = {
        action,
        recordId 
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
           
           console.log(res);
           $('#itemLabListPrice').val(res[0].UnitPrice);
           $('#itemLabDescription').html(res[0].Name);
 
 
       }
   }); 

}

function updateCartLabItem($,recordId,NewUnitPrice,patientId,RequestId){

    let action      = 'UPDATECARTLABITEM';

    let ajaxParamData = {
        action,
        recordId,
        NewUnitPrice
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
            
           getDisplayLabSelected($,patientId,RequestId);
 
       }
   }); 

}