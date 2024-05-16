<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

              <?php if (isset($_SESSION['status'])): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mt-2" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                  </svg>
                  <div class="ms-2">
                    <?= $_SESSION['status'] ?>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['status']); ?>
              <?php endif; ?>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2 pb-2">
              <img src="Assets/bg-register.jpeg" width="100%" height="100%" style="object-fit: cover;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
