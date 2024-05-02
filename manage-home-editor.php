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
  $amenities = $home['amenities'];
  $price = $home['price'];
  $amenitiesArr = explode(', ', $amenities);
  $accommodates = $home['accommodates'];
  $bathrooms = $home['bathrooms'];
  $bedrooms = $home['bedrooms'];
  $beds = $home['beds'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Home</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="js/home-edit-js-controller.js"></script>
  </head>
  <body onload="loadPage()">
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
          <div class="row">
            <div class="col-8">
              <h3 class="mb-4">Home editor</h3>
            </div>
            <div class="col-4 text-end">
              <form action="placeController.php" method="post">
                <button type="button" class="btn btn-danger p-2 rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                  </svg>
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Your Home</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12">
                              <input type="hidden" id="place-id-delete" name="place-id-delete" value="<?= $id ?>">
                              <h3 class="text-start">Are you sure to delete your house?</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12 text-end">
                              <input type="submit" class="btn btn-danger" name="delete-place" id="delete-place" value="Yes" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <input type="hidden" id="place-id" value="<?= $id ?>">
          <input type="radio" class="btn-check" name="home-edit" id="edit-title" value="title" autocomplete="off" checked onclick="updateUIEditor()">
          <label class="btn shadow bg-white rounded text-start" for="edit-title" style="width: 100%;">
            <div class="card border border-0" style="width: 100%;">
              <div class="card-body">
                <p class="fw-bold mb-0">Title</p>
                <p class="card-title mb-0 text-secondary fs-3"><?= $name ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-property-type" value="property_type" autocomplete="off" onclick="updateUIEditor()">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-property-type" style="width: 100%;">
            <div class="card border border-0" style="width: 100%;">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Property type</p>
                <p class="card-text mb-0 text-secondary fw-light"><?= $property_type ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-description-summary" value="description" autocomplete="off" onclick="updateUIEditor()">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-description-summary" style="width: 100%;">
            <div class="card border border-0">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Description & Summary</p>
                <p class="card-text fw-light text-secondary text-truncate" style="max-width: 80%"><?= $description ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-location" value="location" autocomplete="off" onclick="updateUIEditor()">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-location" style="width: 100%;">
            <div class="card border border-0">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Location</p>
                <iframe class="rounded mt-2" src="http://maps.google.com/maps?q=<?= $latitude ?>,<?= $longitude ?>&z=15&output=embed" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p class="card-text fw-light text-secondary mt-2"><?= $street . ", " . $city . ", " . $state . ", " . $country ?></p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-amenities" value="amenities" autocomplete="off" onclick="updateUIEditor()">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-amenities" style="width: 100%;">
            <div class="card border border-0">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-2">Amenities</p>
                <?php if (sizeof($amenitiesArr) > 3): ?>
                  <?php for ($i=0; $i < 3; $i++):?>
                    <p class="fw-light card-text"><img src="Assets/<?= $amenitiesArr[$i] ?>.svg" width="25" height="25">&nbsp;&nbsp;&nbsp;&nbsp;<?= $amenitiesArr[$i] ?></p>
                  <?php endfor ?>
                  <p class="card-text"><small class="text-body-secondary">+ <?= sizeof($amenitiesArr) - 3 ?> more</small></p>
                <?php else: ?>
                  <?php for ($i=0; $i < sizeof($amenitiesArr); $i++):?>
                    <p class="fw-light card-text"><img src="Assets/<?= $amenitiesArr[$i] ?>.svg" width="25" height="25">&nbsp;&nbsp;&nbsp;&nbsp;<?= $amenitiesArr[$i] ?></p>
                  <?php endfor ?>
                <?php endif; ?>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-price" value="price" autocomplete="off" onclick="updateUIEditor()">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-price" style="width: 100%;">
            <div class="card border border-0">
              <div class="card-body">
                <p class="card-subtitle fw-bold mb-0">Price</p>
                <p class="card-text fw-light text-secondary"><?= $price ?>$ / night</p>
              </div>
            </div>
          </label>
          <input type="radio" class="btn-check" name="home-edit" id="edit-beds" value="beds" autocomplete="off" onclick="updateUIEditor()">
          <label class="btn shadow mt-3 bg-white rounded text-start" for="edit-beds" style="width: 100%;">
            <div class="card border border-0">
              <div class="card-body">
                <p class="card-subtitle fw-bold">Beds & more</p>
                <p class="card-text fw-light mt-2 mb-1"><img src="assets/Guets.svg" width="30" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<?= $accommodates ?> guets</p>
                <p class="card-text fw-light mb-1"><img src="assets/Bedrooms.svg" width="30" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<?= $bedrooms ?> bedrooms</p>
                <p class="card-text fw-light mb-1"><img src="assets/Bathrooms.svg" width="30" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<?= $bathrooms ?> bathrooms</p>
                <p class="card-text fw-light"><img src="assets/Beds.svg" width="30" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<?= $beds ?> beds</p>
              </div>
            </div>
          </label>
        </div>
        <div class="col-sm-12 col-md-8 mt-sm-3 mt-md-0">
          <iframe src="" width="100%" height="100%" id="edit-container"></iframe>
        </div>
      </div>
    </div>
  </body>
</html>
