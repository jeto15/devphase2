 $fileName = '';
$(function(){
   
    let recordId = $('#hd_recordid').val();
    let hdPrescribeId = $('#hd_prescribe_id').val();

    getPatientRecordById($,recordId);
    getAllPrescriptions($,recordId,hdPrescribeId);
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

           console.log(res); 
           $('#patient-fullname').html(res.first_name+' '+res.middle_name+' '+res.last_name);

           $fileName = res.first_name+' '+res.middle_name+' '+res.last_name+'rxp'+id;
 
           $('#age-name').html(res.age);
           $('#sex-name').html(res.gender);
  
       }
   });    
} 


function getAllPrescriptions($,patient_id,prescribe_id){
    
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
                    
                    if( row.Type.toLowerCase() == 'pt' ){ 
                        $('.patient-prescribed').html(row.Description);
                    }
                }

            
                
                
           }


           setTimeout(() => {
            
                     var element = document.body;
                     var opt = { 
                       filename:     $fileName+'.pdf',
                       image:        { type: 'jpeg', quality: 0.98 },
                       html2canvas:  { scale: 2 },
                       jsPDF:        { unit: 'in', orientation: 'landscape' }
                     };
                     
                     // New Promise-based usage:
                     html2pdf().set(opt).from(element).save();
                     
                     // Old monolithic-style usage:
                     html2pdf(element, opt);

 
           }, 2000);
       }
   });    
}