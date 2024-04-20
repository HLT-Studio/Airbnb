<?php
session_start();
$uid = $_SESSION['user_id'];
include_once("DBconnect.php");
$sql = "SELECT * FROM `user` WHERE `id` = $uid;";
foreach ($conn->query($sql) as $user ) {
  $name = $user['name'];
  $email = $user['email'];
  $phone = $user['phone'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <title>Personal info</title>
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
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
              <li><a class="dropdown-item fw-bold fw-light" href="wishlist.php">Wishlists</a></li>
              <li><a class="dropdown-item fw-bold fw-light" href="manage-home.php">Airbnb your home</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="logout.php">Log out</a></li>
            <?php else: ?>
              <li><a class="dropdown-item fw-bold fw-light" href="login.php">Sign in</a></li>
              <li><a class="dropdown-item fw-light" href="register.php">Sign up</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <hr style="border: 1px solid black"/>
    <div class="container">
      <div class="row mb-3">
        <div class="col-12 mb-3 mt-2">
          <a class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover me-1" href="account-setting.php"><small>Account</small></a>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
          </svg>
          <p class="d-inline"><small>Login & security</small></p>
        </div>
        <div class="col-12">
          <h3>Login & security</h3>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-sm-12 col-md-8 px-5">
          <div class="row">
            <div class="col-12">
              <h5 class="fw-bold mb-3">Login</h5>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <div class="row">
                <div class="col-8">
                  <p class="fw-light mb-1">Password</p>
                </div>
                <div class="col-4 text-end">
                  <a class="link-success me-2 fw-medium link-underline link-underline-opacity-0" data-bs-toggle="collapse" href="#editPass" role="button" aria-expanded="false" aria-controls="editPass">Update</a>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="fw-light text-secondary mb-0">Last update: ...</p>
                </div>
              </div>
              <div class="collapse" id="editPass">
                <form action="accountController.php" method="post">
                  <div class="row mt-2">
                    <div class="col-12">
                      <label for="current-password" class="fw-light">Current password</label>
                      <input class="form-control" type="text" maxlength="30" name="current-password" id="current-password" required>
                    </div>
                    <div class="col-12 my-2">
                      <label for="new-password" class="fw-light">New password</label>
                      <input class="form-control" type="text" maxlength="30" name="new-password" id="new-password" required>
                    </div>
                    <div class="col-12">
                      <label for="confirm-password" class="fw-light">Confirm password</label>
                      <input class="form-control" type="text" maxlength="30" name="confirm-password" id="confirm-password" required>
                    </div>
                    <div class="col-12">
                      <input type="submit" class="btn btn-success mt-2 fw-medium" name="change-user-password" value="Update password" />
                    </div>
                  </div>
                </form>
              </div>
              <?php if(isset($_SESSION['passChange_alert'])) { ?>
                <div class="d-flex justify-center">
                  <h3 class="<?php echo $_SESSION['text_color'] ?>"><?php echo $_SESSION['passChange_alert'] ?></h3>
                </div>
              <?php unset($_SESSION['passChange_alert']); } ?>  
            </div>
          </div>
          <hr style="border: 1px solid gray"/>
        </div>
        <div class="col-sm-12 col-md-4 border border-1 rounded p-4">
          <div class="row mx-2">
            <div class="col-12">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-shield-exclamation" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
                <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0z"/>
              </svg>
              <h5 class="mb-3 mt-3">Let's make your account more secure</h5>
              <p class="text-secondary fw-light">We’re always working on ways to increase safety in our community. That’s why we look at every account to make sure it’s as secure as possible.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
