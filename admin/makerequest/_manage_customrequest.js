$(function(){

    let recordId = $('#hd_recordid').val();
    let hdPrescribeId = $('#hd_prescribe_id').val();

    $('#Save-Selected-Cust-items').click(function(){

        var DescriptionRequest = $('#input-customerequest').val();
        var customAmount      = $('#input-customerequest-amount').val();

      
        saveCustomRequestItems( 
            $,
            DescriptionRequest,
            customAmount,
            hdPrescribeId,
            recordId
         );
         
    });

});

function saveCustomRequestItems($,DescriptionRequest,customAmount,prescribe_id,patient_id){
 
    let action      = 'SAVEADDEDCUSTITEMS';

    let ajaxParamData = {
        action,
        DescriptionRequest,
        customAmount,
        prescribe_id,
        patient_id
    };  
    $.ajax({ 
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;  

           location.reload();

 
       }
   }); 

}
