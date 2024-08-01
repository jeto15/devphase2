$(function(){

    /*
    * Init
    */   
    getAllPatients($,'');
    let isEdit = false;
    let recordId = '';
    $('#bday-name').bootstrapBirthday({
        widget: {
        wrapper: {
            tag: 'div',
            class: 'bday-name'
        },
        wrapperYear: {
            use: true,
            tag: 'span',
            class: 'bday-name-addon'
        },
        wrapperMonth: {
            use: true,
            tag: 'span',
            class: 'bday-name-addon'
        },
        wrapperDay: {
            use: true,
            tag: 'span',
            class: 'bday-name-addon'
        },
        selectYear: {
            name: 'birthday[year]',
            class: 'form-control input-year-value input-sm'
        },
        selectMonth: {
            name: 'birthday[month]',
            class: 'form-control input-month-value input-sm'
        },
        selectDay: {
            name: 'birthday[day]',
            class: 'form-control input-day-value input-sm'
        }
        }
    });
    
    $(document).on('click','#handle-save-patient',function(){
        let patientNum      =    $('#patient-num-name').val();
        let fname           =    $('#fname-name').val();
        let lname           =    $('#lname-name').val();
        let mname           =    $('#mname-name').val();
        let age             =    $('#age-name').val(); 
        let bday            =    $('#bday-name').val();
        let address         =    $('#address-text').val();
        let sex             =    '';
        let contactNumber   = $('#contact-number-text').val();

        let action      = 'SAVEPATIENTS';

        if($("input[type='radio'].get-gender-radiobtn").is(':checked')) {
            sex = $("input[type='radio'].get-gender-radiobtn:checked").val();
        }

        let ajaxParamData = {
            action,
            isEdit,
            recordId,
            patientNum,
            fname,
            lname,
            mname, 
            age,
            sex, 
            bday,
            address,
            contactNumber
        };
 

        $.ajax({
            type: "POST",
            url: '../_controller/patient_controller.php',
            data: ajaxParamData,
            success: function(response)
            {
               var jsonData = JSON.parse(response); 
               $('#addNewPatients').modal('hide');
               $('.toast-body').html(patientNum +' '+fname+' '+mname+' '+lname+' Saved!'); 
               $('#alertMed').toast('show');  
               getAllPatients($,'');
               isEdit = false;
               recordId = '';
              
           }
        });
    });

    
    $(document).on('click','.handle-add-new', function(){
        isEdit = false;
        recordId = '';
        $('#patient-num-name').val('');
        $('#fname-name').val('');
        $('#lname-name').val('');
        $('#mname-name').val('');
        $('#age-name').val('');
        $('#sex-name').val('');
        $('#bday-name').val('');
        $('#address-text').val('');
        $('.input-year-value').val('');
        $('.input-month-value').val('');
        $('.input-day-value').val('');
        $('.get-gender-radiobtn').attr('checked', false);
        $('#contact-number-text').val('');

        //before opening the model it will clear the configs as New Record.
    });


    $(document).on('click','.handle-edit-record',function(){
        
        var id   = $(this).attr('data-id');
        isEdit   = true;
        recordId = id;
        getPatientRecordById($,id);

    });

    $('input[type="text"]').keyup(function(evt){
        var txt = $(this).val();
    
    
        // Regex taken from php.js (http://phpjs.org/functions/ucwords:569)
        $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
    });

    $('#handle-search-patient').keyup(function(evt){
        var keyword = $(this).val();
        console.log(keyword);
        getAllPatients($,keyword);
    }); 
    
    $('#addNewPatientBtn').click(function(){
        $('#patient-num-name').val("");
        $('#fname-name').val("");
        $('#lname-name').val("");
        $('#mname-name').val("");
        $('#age-name').val(""); 
        $('.input-year-value').val("");
        $('.input-month-value').val("");
        $('.input-day-value').val("");
        $('#address-text').val("");
        $('#contact-number-text').val("");
        
    }); 

    $('#patient-num-name').keyup(function(evt){
        var keyword = $(this).val(); 
        getValidatePatientNumExist($,keyword.trim());
    });

});

function getAllPatients($,keyword){ 
    let action      = 'GETALLPATIENTS';

    let ajaxParamData = {
        action,
        keyword
    };

    $.ajax({
        type: "POST",
        url: '../_controller/patient_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
           var res = JSON.parse(response);
           $('#table-patient-list').html('');
           let htmlRow = '';
           for (const row_index in res.result) {
               let row = res.result[row_index];
               console.log(row);
   
              htmlRow+=' <tr>';
              htmlRow+=' <td>'+ formatDateTime( new Date( row['Created Date'] ) ) +'</td>';
              htmlRow+=' <td>'+ row.patient_number +'</td>';
              htmlRow+=' <td>'+ row.last_name +'</td>';
              htmlRow+=' <td>'+ row.first_name +'</td>';
              htmlRow+=' <td>'+ row.middle_name +'</td>';
              htmlRow+=' <td>'+ row.contact_number+' </td>';
              htmlRow+=' <td>'; 
              htmlRow+='     <a href="#" class="handle-edit-record btn btn-sm btn-outline-secondary" data-id="'+ row.Id +'"  data-bs-toggle="modal" data-bs-target="#addNewPatients"  > <i class="fa-solid fa-pen"></i>  Edit </a>';
              htmlRow+='     <a href="../patientprofile?id='+row.Id+'" class="btn btn-sm btn-outline-secondary"> View</a>';
              htmlRow+=' </td>'; 
              htmlRow+=' </tr>';
     
           } 
    
    
           $('#table-patient-list').html(htmlRow);
       }
   });

}

function getValidatePatientNumExist($,keyword){ 
    let action      = 'GETPATIENTNUMBEREXIST';

    let ajaxParamData = {
        action,
        keyword
    };

    $.ajax({ 
        type: "POST",
        url: '../_controller/patient_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
           var res = JSON.parse(response);
           var exist_alert_html = '';
           console.log(res.result)
           if(res.result.length >= 1    ){
                exist_alert_html +=' <div  class="alert alert-danger d-flex align-items-center" role="alert">';
                exist_alert_html +='    ';
                exist_alert_html +='     <div>';
                exist_alert_html +='        This Patient Number '+keyword+' is already exiist: <a href="../patientprofile?id='+res.result[0].Id+'" class="btn btn-sm btn-outline-secondary"> View</a>';
                exist_alert_html +='     </div>';
                exist_alert_html +=' </div>';
                $('#handle-save-patient').attr("disabled", true);
           } else {
                exist_alert_html ='';
                $('#handle-save-patient').attr("disabled", false);
           }

           $('.alert-exist-patient').html(exist_alert_html);

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
        url: '../_controller/patient_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;
           
           if( res.birthday != null ){
                bdySplit = res.birthday.split('-');  
                $('.input-year-value').val(bdySplit[0]);
                $('.input-month-value').val(parseInt(bdySplit[1]).toString());
                $('.input-day-value').val(bdySplit[2]);
           }
           
           $('.get-gender-radiobtn').each(function(i){
                if(  $(this).val() == res.gender ){
                    $(this).attr('checked',true); 
                } else {
                    $(this).attr('checked',false);
                }
           });
 
           $('#patient-num-name').val(res.patient_number);
           $('#fname-name').val(res.first_name);
           $('#lname-name').val(res.last_name);
           $('#mname-name').val(res.middle_name);
           $('#age-name').val(res.age);
           $('#sex-name').val(res.gender);
           $('#bday-name').val(res.birthday);
           $('#address-text').val(res.address);
           $('#contact-number-text').val(res.contact_number);
 
   
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
