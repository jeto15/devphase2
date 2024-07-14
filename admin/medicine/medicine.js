var MEDRECORDMAPSBYID = {};
var MedRecordSubmitAction = '';

$(function(){
    var medRecordId = '';
    //init 
    DisplayMedicines($,'');
 
    $('#add-new-lab-btn').click(function(){
        $('#laboratoryformModal').modal('show');
        $('#name').val('');
        $('#brand').val('');
        $('#dosageForm').val('');
        $('#strength').val('');
        $('#manufacturer').val('');
        $('#price').val('');
        $('#description').val('');
        medRecordId = '';
        MedRecordSubmitAction ='create';   
        
    });

    $('#btn-save-change').click(function(){  
        SaveChanges($,medRecordId);
        $('#laboratoryformModal').modal('hide');

    }); 
      
    $(document).on('click','.btn-edit-med', function(){
        MedRecordSubmitAction ='update'; 
        $('#laboratoryformModal').modal('show');
        medRecordId = $(this).attr('data-id');
        var recMed   = MEDRECORDMAPSBYID[medRecordId]; 
        $('#name').val(recMed.Name);
        $('#brand').val(recMed.Brand);
        $('#dosageForm').val(recMed.DosageForm);
        $('#strength').val(recMed.Strength);
        $('#manufacturer').val(recMed.Manufacturer);
        $('#price').val(recMed.Price);
        $('#description').val(recMed.Description);
    });
  
});   
 

function SaveChanges($,recordId){ 
    let action      = 'MANAGEMEDICINE';

    let input_name = $('#name').val();
    let input_brand = $('#brand').val();
    let input_dosageForm = $('#dosageForm').val();
    let input_strength = $('#strength').val();
    let input_manufaccturer = $('#manufacturer').val(); 
    let input_price = $('#price').val();
    let input_description = $('#description').val();
    let submitaction = MedRecordSubmitAction;

    let medName = input_name+' '+input_brand+' '+input_dosageForm; 

    let ajaxParamData = {
        action,
        input_name,
        input_brand,
        input_dosageForm,
        input_strength,
        input_manufaccturer, 
        input_price,
        input_description,
        submitaction,
        recordId
    };

    console.log('ajaxParamData', ajaxParamData);

    $.ajax({
        type: "POST",
        url: '../_controller/medicine_controller.php',
        data: ajaxParamData, 
        success: function(response)
        { 
           var res = JSON.parse(response);  
           $('.toast-body').html(medName); 
           $('#alertMed').toast('show');  
           DisplayMedicines($,''); 
           
       }
   }); 

}

function DisplayMedicines($,keyword){
 
    let action      = 'GETMEDICINERECORDS';

    let ajaxParamData = {
        action,
        keyword
    };

    $.ajax({
        type: "POST",
        url: '../_controller/medicine_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
           var res = JSON.parse(response);
           $('#medicineTable').html('');
           let htmlTable = '';
           for (const row_index in res.result) {
               let row = res.result[row_index]; 
               console.log(row); 


               var actionHtml = '';
               actionHtml+='  <button  class="handle-edit-record btn btn-sm btn-outline-secondary btn-edit-med" data-id="'+ row.Id +'"    > Edit </a>';
          
               htmlTable+='<tr>';
               htmlTable+='    <td>'+row.Name+'</td>';
               htmlTable+='    <td>'+row.Brand+'</td>';
               htmlTable+='    <td>'+row.DosageForm+'</td>';
               htmlTable+='    <td>'+row.Strength+'</td>';
               htmlTable+='    <td>'+row.Manufacturer+'</td>'; 
               htmlTable+='    <td>'+row.Price+'</td> ';
               htmlTable+='    <td>'+row.Description+'</td>';
               htmlTable+='    <td>'+actionHtml+'</td>';
               htmlTable+='</tr>';
               
               MEDRECORDMAPSBYID[ row.Id ] = row; 
           }  
           
    
           $('#medicineTable').html(htmlTable);

          
       }
   });



}

$(document).on('click','.btn-cancel-selected-lab-product', function(){
    let selectedId =  $(this).attr('data-labid');
    
    if(productLabExists(selectedId) ){
        removeProductLab(selectedId);  
    }
    displaySelectedLab($); 
});