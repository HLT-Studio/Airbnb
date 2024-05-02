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
          <p class="d-inline"><small>Personal info</small></p>
        </div>
        <div class="col-12">
          <h3>Personal info</h3>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-sm-12 col-md-8 px-5">
          <div class="row mb-2">
            <div class="col-12">
              <div class="row">
                <div class="col-8">
                  <p class="fw-light mb-1">Legal name</p>
                </div>
                <div class="col-4 text-end">
                  <a class="link-dark me-2 fw-bold" data-bs-toggle="collapse" href="#editName" role="button" aria-expanded="false" aria-controls="editName">Edit</a>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="fw-light text-secondary mb-0"><?= $name ?></p>
                </div>
              </div>
              <div class="collapse" id="editName">
                <form action="accountController.php" method="post">
                  <div class="row mt-2">
                    <div class="col-12">
                      <div class="form-floating">
                        <input class="form-control" type="text" maxlength="100" name="name" id="name" placeholder="name" value="<?= $name ?>" required>
                        <label for="name">Full name</label>
                      </div>
                      <input type="submit" class="btn btn-dark mt-2" name="save-user-full-name" value="Save" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid gray"/>
          <div class="row mt-3 mb-3">
            <div class="col-12">
              <div class="row">
                <div class="col-8">
                  <p class="fw-light mb-1">Email address</p>
                </div>
                <div class="col-4 text-end">
                  <a class="link-dark me-2 fw-bold" data-bs-toggle="collapse" href="#editEmail" role="button" aria-expanded="false" aria-controls="editEmail">Edit</a>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="fw-light text-secondary mb-0"><?= $email ?></p>
                </div>
              </div>
              <div class="collapse" id="editEmail">
                <form action="accountController.php" method="post">
                  <div class="row mt-2">
                    <div class="col-12">
                      <div class="form-floating">
                        <input class="form-control" type="email" maxlength="100" name="email" id="email" placeholder="email" value="<?= $email ?>" required>
                        <label for="email">Email</label>
                      </div>
                      <input type="submit" class="btn btn-dark mt-2" name="save-user-email" value="Save" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid gray"/>
          <div class="row mt-3 mb-3">
            <div class="col-12">
              <div class="row">
                <div class="col-8">
                  <p class="fw-light mb-1">Phone numbers</p>
                </div>
                <div class="col-4 text-end">
                  <a class="link-dark me-2 fw-bold" data-bs-toggle="collapse" href="#editPhone" role="button" aria-expanded="false" aria-controls="editPhone">Edit</a>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="fw-light text-secondary mb-0"><?= $phone ?></p>
                </div>
              </div>
              <div class="collapse" id="editPhone">
                <form action="accountController.php" method="post">
                  <div class="row mt-2">
                    <div class="col-12">
                      <div class="form-floating">
                        <input class="form-control" type="text" pattern="^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$" minlength="10" maxlength="10" name="phone" id="phone" placeholder="phone" value="<?= $phone ?>" required>
                        <label for="phone">Phone numbers</label>
                      </div>
                      <input type="submit" class="btn btn-dark mt-2" name="save-user-phone" value="Save" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid gray"/>
        </div>
        <div class="col-sm-12 col-md-4 border border-1 rounded p-4">
          <div class="row mx-2">
            <div class="col-12">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
              </svg>
              <h5 class="mb-3 mt-3">Why isn’t my info shown here?</h5>
              <p class="text-secondary fw-light">We’re hiding some account details to protect your identity.</p>
            </div>
            <hr style="border: 1px solid gray"/>
            <div class="col-12">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
              </svg>
              <h5 class="mb-3 mt-3">Which details can be edited?</h5>
              <p class="text-secondary fw-light">Contact info and personal details can be edited. If this info was used to verify your identity, you’ll need to get verified again the next time you book—or to continue hosting.</p>
            </div>
            <hr style="border: 1px solid gray"/>
            <div class="col-12">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205l-.014-.058-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5s-1.411-.136-2.025-.267c-.541-.115-1.093.2-1.239.735m.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a30 30 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274M3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5m-1.5.5q.001-.264.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085q.084.236.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5"/>
              </svg>
              <h5 class="mb-3 mt-3">What info is shared with others?</h5>
              <p class="text-secondary fw-light">Airbnb only releases contact information for Hosts and guests after a reservation is confirmed.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
