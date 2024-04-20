<?php
session_start();
include_once("DBconnect.php");
if(isset($_SESSION['user_id'])){
    $tmp = $conn->prepare("Select roleid from user where id = ".$_SESSION['user_id']);
    $tmp->execute();
    $roleid = $tmp->fetchColumn();
    if($roleid != 1){
        header('Location: login.php');
    }
}
else{
    header('Location: login.php');
}

$sql_approved = "SELECT COUNT(*) FROM `place` WHERE `approve` = 1;";
$sql_not_approved = "SELECT COUNT(*) FROM `place` WHERE `approve` = 0;";

$place_approved = $conn->query($sql_approved);
$place_not_approved = $conn->query($sql_not_approved);

$numb_approved = $place_approved->fetchColumn();
$numb_not_approved = $place_not_approved->fetchColumn();

if (isset($_GET['approve'])) {
  $approve = $_GET['approve'];
  $sql = "SELECT * FROM `place` WHERE `approve` = $approve;";
} else {
  $sql = "SELECT * FROM `place` WHERE `approve` = 0;";
}
$lstplace = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar sticky-top bg-white">
      <div class="container pt-2">
        <a class="navbar-brand" href="admin_index.php">
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
        <div class="col-12">
          <h2>Welcome Admin,</h2>
        </div>
        <div class="col-12 mt-3">
          <a id="show-approved" class="btn btn-outline-dark" href="admin_index.php?approve=1">Approved (<?= $numb_approved ?>)</a>
          <a id="show-not-approved" class="btn btn-outline-dark" href="admin_index.php?approve=0">Awaiting review (<?= $numb_not_approved ?>)</a>
        </div>
      </div>
      <hr style="border: 1px solid black"/>
      <div class="row row-cols-1 row-cols-md-4 g-sm-0 g-md-5">
        <?php foreach ($lstplace as $element): ?>
          <div class="col">
            <a href="approve_detail.php?id=<?= $element['id'] ?>" class="link-dark" style="text-decoration:none">
              <img src="<?= $element['xl_picture_url'] ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="rounded" width="100%" height="auto">
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
  </body>
</html>
