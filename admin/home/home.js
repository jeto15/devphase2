$(function(){
    $('#print-dashboard').click(function(){
        html2pdf(document.body);
    });

    const ctxPie = document.getElementById('myChartpie');


    getLaboratoriesPieReport(function(res){
        const dataPie = res;
        config = {
            type: 'pie',
            data: dataPie,
        }; 
        new Chart(ctxPie, config);
    });

    getNumberOfPatients($);
    getNumberOfRequest($);
    getPatientRequestLatestList($);
});    

function getLaboratoriesPieReport(callback){
    let action      = 'GETLABCOUNTSREPORTPIE';

    let ajaxParamData = {
        action 
    };

    $.ajax({
        type: "POST",
        url: '../_controller/home_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
           var res = JSON.parse(response); 
           callback(res);
       }
   });

}


function getNumberOfPatients($){
    let action      = 'GETNUMBEROFPATIENTS';

    let ajaxParamData = {
        action 
    };

    $.ajax({
        type: "POST",
        url: '../_controller/home_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
            var res = JSON.parse(response);
            $('#Number-of-Patients').html(res.result);
        }
    }); 
}


function getNumberOfRequest($){
    let action      = 'GETNUMBEROFREQUEST';

    let ajaxParamData = {
        action 
    };

    $.ajax({
        type: "POST",
        url: '../_controller/home_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
            var res = JSON.parse(response);
            console.log(res);
            $('#Number-of-Request').html(res.result);
        }
    }); 

     
}
 

function getPatientRequestLatestList($){
    let action      = 'GETPATIENTREQUESTLATEST';

    let ajaxParamData = {
        action 
    };

    $.ajax({
        type: "POST",
        url: '../_controller/home_controller.php',
        data: ajaxParamData, 
        success: function(response)
        {
            var res = JSON.parse(response); 
  

            let htmlRow = '';
            for (const row_index in res.result) {
                let row = res.result[row_index];
    
               htmlRow+=' <tr>';
               htmlRow+=' <td>'+ row.patient_number +'</td>';
               htmlRow+=' <td>'+ row.last_name +'</td>';
               htmlRow+=' <td>'+ row.first_name +'</td>';
               htmlRow+=' <td>'+ row.middle_name +'</td>';
               htmlRow+=' <td>'+ formatDateTime( new Date(row.created_date) )+' </td>';
               htmlRow+=' <td>'; 
               htmlRow +='     <a href="../makerequest?id='+row.Id+'&presid='+row.request_id+'" class="btn btn-sm btn-outline-secondary"> Review </a>';
               htmlRow+=' </td>';  
               htmlRow+=' </tr>';
       
            } 

            $('#table-request-list').html(htmlRow);
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
