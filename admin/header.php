<?php
session_start();

if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  if( $_SESSION['Dashboard'] == 0){
   
  }
} else {
	header("Location: ../../login");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    
    <meta name="description" content="Clinic,Health">
    <meta name="author" content="Jet Compayan">
    <meta name="generator" content="">
    <link rel="icon" type="image/x-icon" href="../../logo.jpg"> 
 
    <title>Candaya Health and Diagnostic Clinic</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        } 

        .navbar-brand,.custom-bg-dark { 
            background-color: #ec1f25!important; 
        }
        

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .btn-primary {
        background: #2470dc!important;
      }

 
    </style>

                
    <?php
    function getLastPathSegment($url) {
      $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
      $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
      $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

      if (substr($path, -1) !== '/') {
          array_pop($pathTokens);
      }
      return end($pathTokens); // get the last segment
    }

    $currentPage = getLastPathSegment($_SERVER['REQUEST_URI']);
 
    ?>

    
    <!-- Custom styles for this template -->
    <link href="../resource/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
 
    <header class="navbar navbar-dark sticky-top custom-bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Candaya </a>
        <!-- Health and Diagnostic Clinic -->
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
       
        <div class="navbar-nav">
            <div class="nav-item text-nowrap" style="display: flex;">
              <?php $RoleName = array('1'=> 'Admin','2'=> 'Cashier','3'=> 'Receptionist','4'=> 'Doctor') ?>
              <a class="nav-link px-3"  ><?php echo  $RoleName[$_SESSION['userrole']].': '. $_SESSION['userfullname'] ?></a> 
              <a class="nav-link px-3" href="../../logout">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
    <div class="row">

        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
            <?php if( $_SESSION['Dashboard'] == 1){?>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == "home"? "active" : ""; ?>"  href="../home">
                <span data-feather="home"></span>
                Dashboard
                </a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == "patient"? "active" : ""; ?> " aria-current="page" href="../patient">
                <span data-feather="file"></span>
                Patient  Records
                </a>
            </li>  
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == "laboratories"? "active" : ""; ?> " aria-current="page" href="../laboratories">  
                <span data-feather="shopping-cart"></span>
                  Laboratories  
                </a> 
            </li> 
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == "medicine"? "active" : ""; ?> " aria-current="page" href="../medicine">  
                <span data-feather="shopping-cart"></span>
                  Medicine  
                </a> 
            </li> 
            <li class="nav-item">
            <a class="nav-link <?php echo $currentPage == "makepatientrequest"? "active" : ""; ?> " aria-current="page" href="../makepatientrequest">
                <span data-feather="users"></span>
                Make Patient Request  
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == "requestbasemonitoring"? "active" : ""; ?> " aria-current="page" href="../requestbasemonitoring">
                <span data-feather="bar-chart-2"></span>
                  Request Status  
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == "sales-reports"? "active" : ""; ?> " aria-current="page" href="../sales-reports">
                <span data-feather="bar-chart-2"></span>
                  Sales Report
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Doctor Accounts  <span style=" color: #ec1f25; font-weight: 900;"> Coming Soon!</span>
                </a>
            </li>
          
            </ul>
            
        </div>

      
        </nav>
