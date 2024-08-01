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
 

 
