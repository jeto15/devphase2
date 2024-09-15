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


    function getAllSalesByDate(salesListQuery){ 
        let action      = 'GETLABREPORDBYDATE';
    
        let ajaxParamData = {
            action,
            salesListQuery
        };
    
        $.ajax({
            type: "POST",
            url: '../_controller/report_controller.php',
            data: ajaxParamData, 
            success: function(response)
            {
                var res = JSON.parse(response);
                let htmlRow = '';
                for (const row_index in res.result) {
                    let row = res.result[row_index]; 
                    htmlRow+=' <tr>';
                    htmlRow+=' <td>'+ formatDateTime( new Date( row['created_date'] ) ) +'</td>';
                    htmlRow+=' <td>'+ row.LabCount +'</td>'; 
                    htmlRow+=' <td>'+ row.Name +'</td>';
                    htmlRow+=' </tr>';
         
                } 
                $('#sales-reulst-list-table').html(htmlRow);
              

               
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
            case 'monthly':

                var selectedDate = $('#datePicker').val().split('-');
                var year  = selectedDate[0].trim();
                var month = selectedDate[1].trim();

                salesListQuery = "  MONTH(prq_laboratory_table.created_date) = '"+month+"' AND YEAR(prq_laboratory_table.created_date) = '"+year+"'";
                console.log(salesListQuery);
                getAllSalesByDate(salesListQuery,'',interval); 
                break;  
 
            case 'yearly':
                var selectedDate = $('#datePicker').val().trim();
                salesListQuery = "  YEAR(prq_laboratory_table.created_date) = '"+selectedDate+"'"; 
                getAllSalesByDate(salesListQuery,'',interval); 
                break;
        }

    });

    // $startDate = $_POST['startDate'];
    // $endDate = $_POST['endDate'];
    // $filterType = $_POST['filterDay'];

});