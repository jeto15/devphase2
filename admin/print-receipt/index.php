<?php 
session_start();

if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  if( $_SESSION['Dashboard'] == 0){
   
  }
} else {
	header("Location: ../../login");
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .receipt-container {
            max-width: 305px;
            /* margin: 0 auto; */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        h1, h2 {
            text-align: center;
        }
        .section-title {
            margin-top: 20px;
            border-bottom: 1px solid #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        .total-amount {
            text-align: right;
        }

        .receipt-container{
            font-size: 0.5em;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header-logo" style="text-align: center;">
            <img class="mb-4" src="../../logo.jpg" alt="" style=" width: 110px; "  /> 
        </div>
         <p>Contact #: 09351344335/032-437-1043</span> </p>
         <p>Email Address: CANDAYALABNEW@yahoo.com </span> </p>
         <p>Location: Unit 4 ADM Building, Poblacion Daanbantayan Cebu </span> </p>
         <p>Clinic Shedules: Monday - Saturday: 8am-5pm </span> </p>
        <hr>

        <h2>Receipt</h2>
        <p><strong>Patient Name:</strong> John Doe</p>
        <p><strong>Date:</strong> July 30, 2024</p>

        <div class="section-title table-selected-lab">
            <h3>Laboratory Tests</h3>
        </div>
        <table class="table-selected-lab">
            <thead>
                <tr>
                    <th>Test</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody id="table-selected-lab-list-front-lab" >

            </tbody> 
        </table>

        <div class="section-title table-selected-med">
            <h3>Medications</h3>
        </div>
        <table  class="table-selected-med">
             <thead>
                <tr>
                    <th>Medication</th>
                    <th>Qty.</th> 
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody id="table-selected-lab-list-front-Med" >
           
            </tbody> 
        </table>
        
        <div class="section-title table-selected-cust">
            <h3>Other Requests</h3>
        </div>
        <table  class="table-selected-cust">
            <thead>
                <tr>
                    <th>Request</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody id="table-selected-lab-list-front-Other" >

            </tbody> 
        </table>

        <hr>

        <p class="total">Total:</p>
        <p class="total-amount" id="total-amount">0.00</p>
        <p class="total">SR Discount:</p>
        <p class="total-amount" id="discount-sr">0.00</p>
        <p class="total">PWD Discount:</p>
        <p class="total-amount" id="discount-pwd">0.00</p>
        <p class="total">Amount Pay:</p>
        <p class="total-amount" id="total-lab-amount-deducted">0.00</p>
    </div>
    <input type="hidden" id="hd_recordid"  value="<?php echo  isset($_GET['id'])? $_GET['id']:''; ?>" />
    <input type="hidden" id="hd_prescribe_id"  value="<?php echo  isset($_GET['presid'])? $_GET['presid']:''; ?>" />
  
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="../resource/js/dashboard.js"></script>

<script src="print-receipt.js"></script>
</html>