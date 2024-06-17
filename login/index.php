<?php 
require '../admin/.config/db.php';
session_start();

if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    header("Location: ../admin");
 }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Clinic,Health">
    <meta name="author" content="Jet Compayan">
    <meta name="generator" content="">
    <title>Candaya Health and Diagnostic Clinic</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <link rel="icon" type="image/x-icon" href="../logo.jpg">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./login.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
    <form method="post" action="validating.php">
    <img class="mb-4" src="../logo.jpg" alt="" style="width: 40%;" >
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" style="background-color:#ec1f25;" type="submit">Sign in</button>
  </form>
  <?php if(isset($error)) { echo $error; } ?>
</main>


    
  </body>
</html>
