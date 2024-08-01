let LabRecordSubmitAction = '';
let LABRECORDMAPSBYID = {};
 $(function(){

    var labRecordID= '';

    //init 
    DisplayMedicines($,'');

    $('#add-new-lab-btn').click(function(){
        $('#addName').val('');
        $('#addListPrice').val('');
        $('#addDescription').val('');
        LabRecordSubmitAction = 'create';
        labRecordID = '';
        $('#addModal').modal('show'); 
    }); 

    $('#btn-save-change').click(function(){
 
        SaveChanges($,labRecordID);
    });

    $(document).on('click','.btn-edit-lab',function(){
        LabRecordSubmitAction = 'update';
        var recordId = $(this).attr('data-id'); 
        //console.log('LABRECORDMAPSBYID',LABRECORDMAPSBYID[recordId]);
        labRecord = LABRECORDMAPSBYID[recordId];
        labRecordID  = recordId;

        $('#addName').val(labRecord.Name);
        $('#addListPrice').val(labRecord.listprice);
        $('#addDescription').val(labRecord.Description);
        $('#addModal').modal('show'); 
    });

    $('#searchInput').keyup(function(evt){
        var keyword = $(this).val(); 
        DisplayMedicines($,keyword); 
    }); 
    
 });

 

 function SaveChanges($,recordId){ 
    let action      = 'MANAGELABS';

    let input_name = $('#addName').val();
    let input_price = $('#addListPrice').val();
    let input_description = $('#addDescription').val(); 
    let submitaction = LabRecordSubmitAction ;

    let labName = input_name+' '+input_price+' '+input_description; 

    let ajaxParamData = {
        action,
        input_name, 
        input_price, 
        input_description, 
        submitaction,
        recordId
    }; 
    console.log(ajaxParamData);
    $.ajax({
        type: "POST",
        url: '../_controller/laboratory_controller.php',
        data: ajaxParamData, 
        success: function(response)
        { 
           var res = JSON.parse(response);  
          $('.toast-body').html(labName); 
          $('#alertMed').toast('show');  
           DisplayMedicines($,''); 
           $('#addModal').modal('hide'); 
            
       } 
   }); 
}

function DisplayMedicines($,keyword){
 
    let action      = 'GETLABSRECORDS';

    let ajaxParamData = {
        action,
        keyword
    };

    $.ajax({
        type: "POST",
        url: '../_controller/laboratory_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
           var res = JSON.parse(response);
           $('#medicineTable').html('');
           let htmlTable = '';
           for (const row_index in res.result) {
               let row = res.result[row_index]; 
             //  console.log(row); 
            

               var actionHtml = '';
               actionHtml+='  <button  class="handle-edit-record btn btn-sm btn-outline-secondary btn-edit-lab" data-id="'+ row.Id +'"    > Edit </a>';
          
               htmlTable+='<tr>';
               htmlTable+='    <td>'+row.Name+'</td>';
               htmlTable+='    <td>'+row.created_date+'</td>';               
               htmlTable+='    <td>'+row.listprice+'</td>'; 
               htmlTable+='    <td>'+((row.Description == null) ? '' :row.Description )+'</td>'; 
               htmlTable+='    <td>'+actionHtml+'</td>';
               htmlTable+='</tr>';
               
               LABRECORDMAPSBYID[ row.Id ] = row; 
           }  
           
    
           $('#labTable').html(htmlTable);

          
       }
   });



}