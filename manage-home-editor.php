<?php
session_start();
include_once("DBconnect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
foreach ($conn->query($sql) as $home ) {
  $name = $home['name'];
  $property_type = $home['property_type'];
  $description = $home['description'];
  $latitude = $home['latitude'];
  $longitude = $home['longitude'];
  $street = $home['street'];
  $city = $home['city'];
  $state = $home['state'];
  $country = $home['country'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Home</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
              <li><a class="dropdown-item fw-bold fw-light" href="manageHome.php">Airbnb your home</a></li>
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
        <div class="col-sm-12 col-md-4 border-end">
          <h3 class="mb-4">Home editor</h3>
          <input type="radio" class="btn-check" name="home-edit" id="edit-title" autocomplete="off">
          <label class="btn shadow bg-white rounded text-start" for="edit-title" style="width: 100%;">
            <div class="card border border-0" style="width: 100%;">
              <div class="card-body">
                <p class="fw-bold mb-0">Title</p>
                <p class="card-title mb-0 text-secondary fs-3"><?= $name ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-property-type" autocomplete="off">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-property-type" style="width: 100%;">
            <div class="card border border-0" style="width: 100%;">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Property type</p>
                <p class="card-text mb-0 text-secondary fw-light"><?= $property_type ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-description-summary" autocomplete="off">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-description-summary" style="width: 100%;">
            <div class="card border border-0">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Description & Summary</p>
                <p class="card-text fw-light text-secondary text-truncate" style="max-width: 80%"><?= $description ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-location" autocomplete="off">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-location" style="width: 100%;">
            <div class="card border border-0" style="width: 100%;">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Location</p>
                <iframe class="rounded" src="http://maps.google.com/maps?q=<?= $latitude ?>,<?= $longitude ?>&z=15&output=embed" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p class="card-text mb-0 text-secondary fw-light"><?= $ ?></p>
              </div>
            </div>
        </div>
        <div class="col-sm-0 col-md-8">

        </div>
      </div>
    </div>
  </body>
</html>
