$(function(){

    /*
    * Init
    */
    let recordId = $('#hd_recordid').val();
    getPatientRecordById($,recordId);
    getPatientPrescribed($,recordId);

    $('#make-requet-draft').click(function(){

        if( confirm("Are you sure Make Request") ){
            makeDraftRequest(recordId);
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
            
           console.log(jsonData);
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

function getPatientPrescribed($,id){

    let action      = 'GETPATIENTPRESCRIBEBYID';

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

           let html_pressribe_table = '';
           for (const row_index in res) {
            let row = res[row_index]
            html_pressribe_table +='<tr> ';
            html_pressribe_table += '<td scope="col">'+formatDateTime( new Date(row.created_date) ) +'</td>';  
            html_pressribe_table += '<td scope="col">'+ row.Status +'</td>';  
            html_pressribe_table += '<td scope="col">';
            html_pressribe_table +='     <a href="../makerequest?id='+row.patient_Id+'&presid='+row.Id+'" class="btn btn-sm btn-outline-secondary"> Review </a>';
            html_pressribe_table +='</td> ';
            html_pressribe_table +='</tr> ';
           }
  
           $('#table-patient-prescribe-list ').html(html_pressribe_table);
 
       }
   });     
}

function formatDateTime(date) {
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const monthIndex = date.getMonth();
    const month = months[monthIndex];
    const day = date.getDate();
    const year = date.getFullYear();
    let hour = date.getHours();
    const minute = date.getMinutes();
    const period = hour >= 12 ? 'PM' : 'AM';

    // Convert hour from 24-hour format to 12-hour format
    hour = hour % 12;
    hour = hour ? hour : 12; // 0 should be treated as 12

    return `${month} ${day}, ${year} ${hour}:${minute < 10 ? '0' + minute : minute} ${period}`;
}

function makeDraftRequest(recordId){

    let action      = 'CREATEDRAFTREQUEST';

    let ajaxParamData = {
        action,
        recordId
    };

    $.ajax({
        type: "POST",
        url: '../_controller/patientprofile_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;
           var locationstr = location.origin +location.pathname.replace("patientprofile", "makerequest")+'?id='+res.patientId+'&presid='+res.patientRequestId+'';
           window.location.replace(locationstr);
 
       }
   });       

}

 
 
