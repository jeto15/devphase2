$(function(){

    
    function updateDatePicker() {
        var interval = $('#dateInterval').val();
        $('#datePicker').datepicker('destroy'); // Destroy any previous datepicker

        switch (interval) {
            case 'daily':
                $('#datePicker').datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true
                });
                break;

            case 'weekly':
                $('#datePicker').datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true,
                    onSelect: function(dateText, inst) {
                        var date = $(this).datepicker('getDate');
                        var startDate = new Date(date.setDate(date.getDate() - date.getDay()));
                        var endDate = new Date(date.setDate(date.getDate() + 6));

                        $('#datePicker').val($.datepicker.formatDate('yy-mm-dd', startDate) + ' to ' + $.datepicker.formatDate('yy-mm-dd', endDate));
                    }
                });
                break;

            case 'monthly':
                $('#datePicker').datepicker({
                    dateFormat: 'yy-mm',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    onClose: function(dateText, inst) { 
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    }
                });
                break;

            case 'yearly':
                $('#datePicker').datepicker({
                    dateFormat: 'yy',
                    changeYear: true,
                    showButtonPanel: true,
                    onClose: function(dateText, inst) { 
                        $(this).datepicker('setDate', new Date(inst.selectedYear, 0, 1));
                    }
                });
                break;
        }
    }


    function getAllSalesByDate(salesListQuery,salesQuery){ 
        let action      = 'GETSALESBYDATE';
    
        let ajaxParamData = {
            action,
            salesListQuery,
            salesQuery
        };
    
        $.ajax({
            type: "POST",
            url: '../_controller/report_controller.php',
            data: ajaxParamData, 
            success: function(response)
            {
                var res = JSON.parse(response);
                if( res.status == '1' ){
                    $('#sales-result-amount').html(globaPesoFormatter.format(res.result.totalSales) ); 
                    $('#sales-reulst-list-table').html('');
                    let htmlRow = '';
                    for (const row_index in res.resultList) {
                        let row = res.resultList[row_index]; 
                       htmlRow+=' <tr>';
                       htmlRow+=' <td>'+ formatDateTime( new Date( row['CreatedDate'] ) ) +'</td>';
                       htmlRow+=' <td>'+ row.OrderReceiptNumber +'</td>';
                       htmlRow+=' <td>'+ globaPesoFormatter.format(row.TotalAmount) +'</td>';
                       htmlRow+=' <td>'; 
                       htmlRow +='     <a href="../makerequest?id='+row.PatientId+'&presid='+row.PrescribeId+'" class="btn btn-sm btn-outline-secondary"> View </a>';
                       htmlRow+=' </td>';  
                       htmlRow+=' </tr>';
              
                    } 
    
                    $('#sales-reulst-list-table').html(htmlRow);
                } else {
                    alert('NO Record Found!');
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

    

    globaPesoFormatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    });

    
    // Initial call to set up the date picker
    updateDatePicker();

    

    // Update date picker whenever the interval changes
    $('#dateInterval').change(function() {
        updateDatePicker();
    });

    $('#handle-run-report').click(function(){

        var interval = $('#dateInterval').val();
        let salesListQuery = '';
        switch (interval) {
            case 'daily':
                    
                var selectedDate = $('#datePicker').val();
                salesListQuery = "WHERE CreatedDate = '"+selectedDate+"' ";

                getAllSalesByDate(salesListQuery,'',interval);
                break;

            case 'weekly':
               
                var selectedDate = $('#datePicker').val().split('to');
                var startDate = selectedDate[0].trim();
                var endDate   = selectedDate[1].trim();

                salesListQuery = "WHERE DATE(CreatedDate) BETWEEN '"+startDate+"' AND '"+endDate+"'";

                getAllSalesByDate(salesListQuery,'',interval); 
                break;

            case 'monthly':

                var selectedDate = $('#datePicker').val().split('-');
                var year  = selectedDate[0].trim();
                var month = selectedDate[1].trim();

                salesListQuery = " WHERE MONTH(CreatedDate) = '"+month+"' AND YEAR(CreatedDate) = '"+year+"'";
                console.log(salesListQuery);
                getAllSalesByDate(salesListQuery,'',interval); 
                break;  

            case 'yearly':
                var selectedDate = $('#datePicker').val().trim();
                salesListQuery = " WHERE  YEAR(CreatedDate) = '"+selectedDate+"'"; 
                getAllSalesByDate(salesListQuery,'',interval); 
                break;
        }

    });


    // $startDate = $_POST['startDate'];
    // $endDate = $_POST['endDate'];
    // $filterType = $_POST['filterDay'];

});