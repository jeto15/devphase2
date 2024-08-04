$(function(){


    //init
    
    let selectedRecordId  = $('#hd_recordid').val();
    let selectDocId = '';
    if( selectedRecordId != '' ){
        getPatientRecordById($,selectedRecordId); 
    }   

 
    $('#search').on('keyup', function() { 
        let query = $(this).val();
        if (query.length > 2) { // Fetch suggestions if input length > 2

            let action      = 'GETALLPATIENTS';
            let keyword     = query;
            let ajaxParamData = {
                action,
                keyword
            };

            $.ajax({
                type: "POST",
                url: '../_controller/patient_controller.php',
                data: ajaxParamData, 
                success: function(response) {
                 
                    var res = JSON.parse(response); 
                    let htmlRow = '';
                    $('#suggestions').html('');
                    for (const row_index in res.result) {
                        let row = res.result[row_index];
                        htmlRow +=  '<a href="#" data-recordid="'+ row.Id +'" class="list-group-item list-group-item-action suggestion-item">'+row.patient_number+' '+row.last_name+' '+row.first_name+' '+row.middle_name + '</a>';
                    } 

                    $('#suggestions').html(htmlRow);

                } 
            });
        } else {
            $('#suggestions').html('');
        }
    });


     
    $('#search-doctor').on('keyup', function() { 
        let query = $(this).val();
        if (query.length > 2) { // Fetch suggestions if input length > 2

            let action      = 'GETALLDOCTORS';
            let keyword     = query;
            let ajaxParamData = {
                action,
                keyword 
            };

            $.ajax({
                type: "POST",
                url: '../_controller/makepatientrequest_controller.php',
                data: ajaxParamData, 
                success: function(response) {
                 
                    var res = JSON.parse(response); 
                    let htmlRow = '';
                    $('#suggestions-doctor').html('');
                    for (const row_index in res.result) {
                        let row = res.result[row_index];
                        htmlRow +=  '<a href="#" data-recordid="'+ row.UserID +'" class="list-group-item list-group-item-action suggestion-item-doctor">  '+row.LastName+' '+row.FirstName+'</a>';
                    } 

                    $('#suggestions-doctor').html(htmlRow);

                } 
            });
        } else {
            $('#suggestions-doctor').html('');
        }
    });



    $(document).on('click', '.suggestion-item', function() {
        let text = $(this).text();
        $('#search').val(text);
        $('#suggestions').html('');
        selectedRecordId  = $(this).attr('data-recordid');
    });


    $(document).on('click', '.suggestion-item-doctor', function() {
        let text = $(this).text();
        $('#search-doctor').val(text);
        $('#suggestions-doctor').html(''); 
        selectDocId  = $(this).attr('data-recordid');
    });

    $('#btn-submit-request').click(function(){
        let request_description  = $('#request_description').val(); 
        makeDraftRequest(selectedRecordId,request_description,selectDocId);
    });

});
 

function makeDraftRequest(recordId,request_description,selectDocId){

    let action      = 'CREATEDRAFTREQUEST'; 
    let ajaxParamData = {
        action,
        request_description,
        recordId,
        selectDocId
    };

    $.ajax({
        type: "POST",
        url: '../_controller/patientprofile_controller.php',
        data: ajaxParamData,
        success: function(response)
        { 
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;
           var locationstr = location.origin +location.pathname.replace("makepatientrequest", "makerequest")+'?id='+res.patientId+'&presid='+res.patientRequestId+'';
           window.location.replace(locationstr);
 
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
           $('#search').val(res.patient_number+' '+res.last_name +' '+res.first_name+', '+res.middle_name); 
 
       }
   });    
}
