$(function(){

    $('#add-new-lab-btn').click(function(){
        $('#laboratoryformModal').modal('show');
    });

    $('#btn-save-change').click(function(){
        getAllPatients($);
    });

});  


function getAllPatients($){ 
    let action      = 'MANAGEMEDICINE';

    let input_name = $('#name').val();
    let input_brand = $('#brand').val();
    let input_dosageForm = $('#dosageForm').val();
    let input_strength = $('#strength').val();
    let input_manufaccturer = $('#manufacturer').val();
    let input_expiryDate = $('#expiryDate').val();
    let input_price = $('#price').val();
    let input_description = $('#description').val();

    let ajaxParamData = {
        action,
        input_name,
        input_brand,
        input_dosageForm,
        input_strength,
        input_manufaccturer,
        input_expiryDate,
        input_price,
        input_description
    };

    console.log('ajaxParamData', ajaxParamData);

//     $.ajax({
//         type: "POST",
//         url: '../_controller/patient_controller.php',
//         data: ajaxParamData, 
//         success: function(response)
//         {
//            var res = JSON.parse(response); 
             
     
//        }
//    });

}
