<?php
session_start();
include_once("DBconnect.php");

$iduser = $_SESSION['user_id'];

if (empty($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$sql = "SELECT * FROM `favouritelst` WHERE `userid` = $iduser;";
$storage = $conn->query($sql);

$arrplaceid = array();

foreach($storage as $tmp){
  array_push($arrplaceid, $tmp['placeid']);
}

$sqlplace = "SELECT * FROM `place` WHERE id in ('". implode("' , '", $arrplaceid) . "')";
$wishplace = $conn->query($sqlplace);

$sql_notify = "SELECT * FROM `notify` WHERE `hostid` = $iduser;";
$records = $conn->query($sql_notify);
$total_rows = $records->rowCount();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlists</title>
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
              <li><a class="dropdown-item fw-medium" href="wishlist.php">Wishlists</a></li>
              <li><a class="dropdown-item fw-medium" href="PlaceList_waitResponse.php">Request list</a></li>
              <li><a class="dropdown-item fw-medium" href="BookingList.php">Booking list</a></li>
              <li><a class="dropdown-item fw-medium" href="manage-home.php">Airbnb your home</a></li>
              <?php if ($total_rows != 0): ?>
                <li><a class="dropdown-item fw-medium" href="notify.php">Notify<span class="ms-2 text-danger fw-medium">&#8226;</span></a></li>
              <?php else: ?>
                <li><a class="dropdown-item fw-medium" href="notify.php">Notify</a></li>
              <?php endif; ?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="account-setting.php">Account</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="logout.php">Log out</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <hr style="border: 1px solid black"/>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-11">
          <h3>Wishlists</h3>
        </div>
        <div class="mt-2 row row-cols-1 row-cols-md-4 g-sm-0 g-md-5">
        <?php foreach ($wishplace as $element): ?>
          <div class="col">
            <a href="detail.php?id=<?= $element['id'] ?>" class="link-dark" style="text-decoration:none">
              <img src="<?= $element['xl_picture_url'] ?>" onerror="this.onerror=null; this.src='assets/img-not-found.jpeg'" class="rounded" width="100%" height="200px" style="object-fit: cover;">
              <div class="row mb-0">
                <div class="col-8">
                  <p class="mt-2 fw-bold mb-0"><?= $element['state'] . ", " . $element['country'] ?></p>
                </div>
                <div class="col-4 text-end">
                  <p class="mt-2 fw-light mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 20 20">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>&nbsp;5
                  </p>
                </div>
              </div>
              <p class="text-secondary mt-2">Added&nbsp;<?= $element['calendar_updated'] ?></p>
              <p class="fw-light"><span class="fw-bold">$&nbsp;<?= $element['price'] ?></span>&nbsp;night</p>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      </div>
    </div>
  </body>
</html>
