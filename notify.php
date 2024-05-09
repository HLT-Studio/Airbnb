<?php
session_start();
include_once("DBconnect.php");
$iduser = 0;
if(isset($_SESSION['user_id'])){
  $iduser = $_SESSION['user_id'];
}
$sql = "SELECT * FROM `notify` WHERE `hostid` = $iduser;";
$records = $conn->query($sql);
$total_rows = $records->rowCount();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notify center</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <nav class="navbar sticky-top bg-white">
      <div class="container pt-2">
        <a class="navbar-brand" href="index.php">
          <img src="assets/airbnb.png" style="width: 100%; max-width: 100px; height: auto">
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
              <li><a class="dropdown-item fw-medium" href="wishlist.php">Wishlists</a></li>
              <li><a class="dropdown-item fw-medium" href="manage-home.php">Airbnb your home</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="account-setting.php">Account</a></li>
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
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
          <div class="card" style="width: 100%;">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <?php if ($total_rows != 0): ?>
                    <h5 class="card-title">Notification center <span class="ms-2 badge text-bg-danger"><?= $total_rows ?></span></h5>
                  <?php else: ?>
                    <h5 class="card-title">Notification center</h5>
                  <?php endif; ?>
                </div>
                <div class="col-6 text-end">
                  <form action="notifyController.php" method="post">
                    <input type="hidden" name="id-user" id="id-user" value="<?= $iduser ?>">
                    <button type="submit" class="btn btn-link link-offset-2 link-underline link-underline-opacity-0" name="clear-all-mess" id="clear-all-mess">Clear all</button>
                  </form>
                </div>
              </div>
              <div class="row row-cols-1 g-2">
                <?php foreach ($conn->query($sql) as $element): ?>
                  <div class="col">
                    <div class="row">
                      <div class="col-10">
                        <p class="fw-bold mb-2"><?= $element['home_name'] ?> - <span class="fst-italic"><?= $element['home_address'] ?></span></p>
                      </div>
                      <div class="col-2 text-end">
                        <form action="notifyController.php" method="post">
                          <input type="hidden" name="id-mess" id="id-mess" value="<?= $element['id'] ?>">
                          <button type="submit" class="btn btn-link link-danger" name="del-mess" id="del-mess">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                              <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                            </svg>
                          </button>
                        </form>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <p class="text-break mb-1"><?= $element['mess_container'] ?></p>
                      </div>
                      <div class="col-12">
                        <p class="fst-italic text-secondary-emphasis"><small><?= $element['time'] ?></small></p>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </body>
</html>
