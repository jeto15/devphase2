<?php include '../header.php'; ?>

  
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>

            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary "  id="print-dashboard"  > Print </button> -->
            </div>
            </div>
        </div> 

        <div class="row" id="dashboard-chart" >
            <div class="col-md-6">
                
                <div class="row">
                    <div class="col">
                        <div class="card"  >
                            <div class="card-body">
                                <h5 class="card-title">Number Patients</h5>
                                <h1 id="Number-of-Patients" >
                                    0
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card"  >
                            <div class="card-body">
                                <h5 class="card-title">Number Of Request</h5>
                                <h1 id="Number-of-Request" >
                                    0
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="    margin-top: 3%;">
                    <div class="col">
                        <div class="card"  >
                            <div class="card-body">
                                <h5 class="card-title">Patients Request</h5>
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Patient #</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Middle Name</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-request-list">

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div>
                    <canvas id="myChartpie"></canvas>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
        // const ctx = document.getElementById('myChart');
        // const ctx1 = document.getElementById('myChart1');
 
        // new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //     datasets: [{
        //         label: '',
        //         data: [12, 19, 3, 5, 2, 3],
        //         borderWidth: 1
        //     }]
        //     },
        //     options: {
        //     scales: {
        //         y: {
        //         beginAtZero: true
        //         }
        //     }
        //     }
        // });
        
     

      



        
</script>
    </main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="home.js"></script>

 
<?php include '../footer.php'; ?> 