$(function(){
    getPatientRequestLatestList($);
});

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
                let classbdgeColor ='bg-danger';
                if(row.Status =='Draft' ){
                    classbdgeColor ='bg-info text-dark';
                } 
                else if(row.Status =='To Billing' ){
                    classbdgeColor ='bg-primary';
                }   
                else if(row.Status =='Billing Competed' ){
                    classbdgeColor ='bg-success';
                } 

               htmlRow+=' <tr>';
               htmlRow+=' <td>'+ row.patient_number +'</td>';
               htmlRow+=' <td>'+ row.last_name +' '+row.first_name+' '+row.middle_name+'</td>';
               htmlRow+=' <td>'+ formatDateTime( new Date(row.created_date) )+' </td>';
               htmlRow+=' <td><h5> <span class="badge '+classbdgeColor+'">'+row.Status+'</span> </h5> </td>';
               
               htmlRow+=' <td>'; 
               htmlRow +='     <a href="../makerequest?id='+row.Id+'&presid='+row.request_id+'&stafrequestmode=1" class="btn btn-sm btn-outline-secondary"> View </a>';
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
