$(function(){
    getPatientRequestLatestList($);

    // $(document).on('click','.handleVoidModal', function(){
    //     $('#VoidFormModal').modal('show');
    // });
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
            
           

            let htmlRowDraft = '';
            let htmlRowToBilling = '';
            let htmlRowBillingComplete = '';
            let htmlRowCancel = '';
            for (const row_index in res.result) {
            
                let row = res.result[row_index];
             
                var htmlRow ='';
                htmlRow+=' <tr>';
                htmlRow+=' <td>'+ formatDateTime( new Date(row.created_date) )+' </td>';
                htmlRow+=' <td>'+ row.patient_number +'</td>';
                htmlRow+=' <td>'+ row.last_name +' '+row.first_name+' '+row.middle_name+'</td>';
                if( row.Status == 'Cancel' || row.Status == 'Void' || row.Status == 'Refunded' ){
                    htmlRow+=' <td>'+ row.Status +'</td>';
                    if( row.Status != 'Cancel' ){
                        htmlRow+=' <td>'+ row.Reason +'</td>';
                    } else{
                        htmlRow+=' <td> N/A </td>';
                    }
                   
                }
                htmlRow+=' <td>';  
                htmlRow +='     <a href="../makerequest?id='+row.patienID+'&presid='+row.prId+'" class="btn btn-sm btn-success"> View </a>';
                htmlRow+=' </td>';


               htmlRow+=' </tr>';

                if(row.Status =='Draft' ){
                    htmlRowDraft += htmlRow;
                } 
                else if(row.Status =='To Billing' ){
                   
                    htmlRowToBilling += htmlRow;
                }   
                else if(row.Status =='Billing Competed' ){
                  
                    htmlRowBillingComplete += htmlRow;
                } else {
                    htmlRowCancel += htmlRow;
                }
        
            } 

            $('#table-request-list-draft').html(htmlRowDraft);
            $('#table-request-list-tobill').html(htmlRowToBilling);
            $('#table-request-list-billcom').html(htmlRowBillingComplete);
            $('#table-request-list-cancel').html(htmlRowCancel);
            
        }
    }); 

    
} 


function formatDateTime(date) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Decs'];
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
