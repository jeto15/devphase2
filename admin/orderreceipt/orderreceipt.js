$(function(){

    function getAllOR(keySearch){ 
        let action      = 'GETALLOR';
    
        let ajaxParamData = {
            action,
            keySearch
        };
    
        $.ajax({
            type: "POST",
            url: '../_controller/orderreceipt_controller.php',
            data: ajaxParamData, 
            success: function(response)
            {
                var res = JSON.parse(response); 
                console.log(res);
                $('#orlisttable').html('');
                let htmlRow = '';
                for (const row_index in res.result) {
                    let row = res.result[row_index]; 
                    htmlRow+=' <tr>'; 
                    htmlRow+=' <td>'+ row.OrderReceiptNumber +'</td>';
                    htmlRow+=' <td>'+ row.Status +'</td>';
                    htmlRow+=' <td>'+ formatDateTime( new Date( row['CreatedDate'] ) )  +'</td>';   
                    htmlRow+=' </tr>';
            
                }  
                $('#orlisttable').html(htmlRow);
     

               
           } 
       });
     
    }   

    function SaveNewOR(ornumber){
        let action      = 'SAVENEWOR';
    
        let ajaxParamData = {
            action,
            ornumber 
        };
    
        $.ajax({
            type: "POST",
            url: '../_controller/orderreceipt_controller.php',
            data: ajaxParamData, 
            success: function(response)
            {
                var res = JSON.parse(response); 

                if( res.result == 'Save' ){
                    getAllOR('');
                    $('.toast-body').html('Successfully Save!'); 
                    $('#alertMed').toast('show');  
                } else if( res.result == 'Duplicate' ){
                    $('.toast-body').html('Ops! This OR #'+ornumber+' Already Exist!'); 
                    $('#alertMed').toast('show');  
                }
            
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

    getAllOR('');
 
    $('#searchInput').keyup(function(evt){
        var keyword = $(this).val();  
        getAllOR(keyword);
    }); 

    $('#handlesaveor').click(function(){

        var inputOR = $('#inputornumber').val();
        SaveNewOR(inputOR);

    });
    
});