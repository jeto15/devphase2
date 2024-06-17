<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print RX</title>

    <style>

        .prescription-rx-container span svg { 
            width: 13px;
            height: 11px;
        }

    </style>
</head>
<body>
    <div class="prescription-rx-container" style="width: 430px;border: 1px dotted #dedede;;padding: 40px;font-family: sans-serif;" >
        <div class="prescription-rx-header" style="text-align: center;padding-bottom: 19px;">
            <!-- <table >
                <tr>
                    <td>   <img class="mb-4" src="../../logo.jpg" alt="" style=" width: 66px; "  ></td>
                    <td>  
                        <p>Phone #: 09351344335/032-437-1043</p>
                        <p>Email: CANDAYALABNEW@yahoo.com </p>
                        <p>Address: Unit 4 ADM Building, Poblacion Daanbantayan Cebu </p>
                        <p>Clinic Hours: Monday - Saturday: 8am-5pm
                    </td>
                </tr>
            </table> -->
            <img class="mb-4" src="../../logo.jpg" alt="" style=" width: 100px; "  />
            <p style="margin-top: 0;font-size: 9px;"> 
                <span><span data-feather="phone"></span>: 09351344335/032-437-1043</span> </br>
                <span><span data-feather="at-sign"></span>: CANDAYALABNEW@yahoo.com </span> </br>
                <span><span data-feather="map"></span>: Unit 4 ADM Building, Poblacion Daanbantayan Cebu </span> </br>
                <span><span data-feather="clock"></span>: Monday - Saturday: 8am-5pm </span>
            </p>
        </div>
        <div class="prescription-rx-body">
       
            <div class="patient-details">
                <table>
                    <tr>
                        <td>NAME: </td>
                        <td> <span id="patient-fullname"></span> </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>AGE/SEX: </td>
                        <td>  <span id="age-name"></span> /  <span id="sex-name"></span>  </td>
                        <td style=" padding-left: 58px; "> DATE: </td>
                        <td> <?php echo date('Y-m-d H:i:s'); ?></td>
                    </tr>
                </table> 
            </div>
            <img class="mb-4" src="../../rxpng.png" alt="" style=" width: 66px; "  >
            <div class="patient-prescribed">
                <ul >
                  
                </ul>  
            </div>
        </div>
        <div class="prescription-rx-body">
            <table>
                <tr>
                    <td style="  width: 151px; ">FOLLOW-UP: </td>
                    <td>DR._______________________ </td>
                </tr>
                <tr>
                    <td>  </td>
                    <td>LICENSE #:________________ </td>
                </tr>
            </table>
        </div>
    </div>
    <input type="hidden" id="hd_recordid"  value="<?php echo $_GET['id'];?>" />
    <input type="hidden" id="hd_prescribe_id"  value="<?php echo  isset($_GET['presid'])? $_GET['presid']:''; ?>" />
 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="../resource/js/dashboard.js"></script>
    <script src="printprescription.js"></script>
</body> 
</html>
 