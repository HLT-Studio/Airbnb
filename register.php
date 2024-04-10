<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

              <form class="mx-1 mx-md-4" action="accountController.php" method="post">

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="full_name_value" name="full_name_value" class="form-control" required>
                    <label class="form-label" for="full_name_value">Your Name</label>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="text" id="username" name="username" class="form-control" required>
                    <label class="form-label" for="username">User name</label>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <i class="fa fa-phone fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="number" id="phone" name="phone" class="form-control" minlength="10" maxlength="10" required>
                    <label class="form-label" for="phone">Phone number</label>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-envelope fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="email" id="email_value" name="email_value" class="form-control" required>
                    <label class="form-label" for="email_value">Your Email</label>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-lock fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="password" id="password_value" name="password_value" class="form-control" required>
                    <label class="form-label" for="password_value">Password</label>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-key fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-outline flex-fill mb-0">
                    <input type="password" id="repassword_value" name="repassword_value" class="form-control" required>
                    <label class="form-label" for="repassword_value">Repeat your password</label>
                  </div>
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required>
                  <label class="form-check-label" for="form2Example3">
                    I agree all statements in <a href="#">Terms of service</a>
                  </label>
                </div>

                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button type="submit" name="register_btn" id="register_btn" class="btn btn-primary btn-lg">Sign up</button>
                </div>

              </form>

              <?php
                if (isset($_SESSION['status'])) {
                  echo "<h5 class='alert ".$_SESSION['alert']."'>".$_SESSION['status']."</h5>";
                  unset($_SESSION['status']);
                }
              ?>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

              <img src="Assets/bg-register.jpeg"
                class="img-fluid" alt="Sample image">

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
