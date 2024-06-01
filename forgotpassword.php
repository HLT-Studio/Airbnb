<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <nav class="navbar sticky-top bg-white">
      <div class="container pt-2">
        <a class="navbar-brand" href="index.php">
          <img src="Assets/airbnb.png" style="width: 100%; max-width: 100px; height: auto">
        </a>
      </div>
    </nav>
    <hr style="border: 1px solid black"/>
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Your email to change password</p>
              
              <?php
                    if(isset($_SESSION['email_alert'])){
              ?>
                    <h4 class="<?= $_SESSION["colortext"] ?>"><?= $_SESSION['email_alert'] ?></h4>
              <?php } 
                    unset($_SESSION['email_alert']);
              ?>

              <form class="mx-1 mx-md-4" action="accountController.php" method="post">

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                    <div class="form-floating flex-fill mb-0">
                        <input type="text" id="email" name="email" class="form-control" required>
                        <label class="form-label" for="email">Your Email</label>
                    </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="forgotpass" id="forgotpass" class="btn btn-primary btn-lg">Send</button>
                    </div>
            
                </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

