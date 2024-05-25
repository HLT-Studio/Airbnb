<?php
session_start();
include_once("DBconnect.php");

$iduser = 0;
if(isset($_SESSION['user_id'])){
  $iduser = $_SESSION['user_id'];
}

$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
foreach ($conn->query($sql) as $home) {
  $xl_picture_url = $home['xl_picture_url'];
  $imgD1 = $home["imgD1"];
  $imgD2 = $home["imgD2"];
  $imgD3 = $home["imgD3"];
  $imgD4 = $home["imgD4"];
  $name = $home['name'];
  $property_type = $home['property_type'];
  $description = $home['description'];
  $notes = $home['description'];
  $summary = $home['summary'];
  $latitude = $home['latitude'];
  $longitude = $home['longitude'];
  $street = $home['street'];
  $city = $home['city'];
  $state = $home['state'];
  $country = $home['country'];
  $amenities = $home['amenities'];
  $accommodates = $home['accommodates'];
  $bedrooms = $home['bedrooms'];
  $beds = $home['beds'];
  $bathrooms = $home['bathrooms'];
  $host_id = $home['host_id'];
  $price = $home['price'];
  $cleaning_fee = $home['cleaning_fee'];
  $transit = $home['transit'];
  $notes = $home['notes'];
  $amenitiesArr = explode(', ', $amenities);
}
$host_query = "SELECT * FROM `user` WHERE `id` = $host_id;";
if($iduser != 0){
  $favorite_query = "SELECT * FROM `favouritelst` WHERE `userid` = $iduser AND `placeid` = $id;";
  foreach ($conn->query($favorite_query) as $place) {
    $favorite = $place['favourite'];
  }
}
$sql_notify = "SELECT * FROM `notify` WHERE `hostid` = $iduser;";
$records = $conn->query($sql_notify);
$total_rows = $records->rowCount();

foreach ($conn->query($host_query) as $user) {
  $host_name = $user['name'];
}

if(isset($_GET["favoritechange"])) {
  if ($host_id == $iduser) {
    echo '<script language="javascript">';
    echo 'alert("Cannot add your own place to favorites")';
    echo '</script>';
  } else {
    include_once("favorite-change.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?></title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
    <nav class="navbar bg-white">
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
            <?php else: ?>
              <li><a class="dropdown-item fw-medium" href="login.php">Sign in</a></li>
              <li><a class="dropdown-item fw-light" href="register.php">Sign up</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <hr style="border: 1px solid black"/>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-11">
          <h3><?= $name ?></h3>
        </div>
        <div class="col-12 col-md-1 text-center text-md-end">
          <a class="icon-link icon-link-hover link-dark" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="detail.php?id=<?= $id ?>&favoritechange=true">
            <?php if (isset($favorite)): ?>
              <?php if($favorite == 1): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                </svg>
              <?php else: ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg>
              <?php endif ?>
            <?php else: ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg>
            <?php endif ?>
            Save
          </a>
        </div>
      </div>
      <div class="row g-sm-2 g-md-2">
        <div class="col-12 col-md-6">
          <img src="<?= $xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="408.5rem" style="object-fit: cover;">
        </div>
        <div class="col-12 col-md-6">
          <div class="row row-cols-1 row-cols-md-2 g-sm-2 g-md-2">
            <div class="col">
              <img src="<?= $imgD1 ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="200rem" style="object-fit: cover;">
            </div>
            <div class="col">
              <img src="<?= $imgD2 ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="200rem" style="object-fit: cover;">
            </div>
            <div class="col">
              <img src="<?= $imgD3 ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="200rem" style="object-fit: cover;">
            </div>
            <div class="col">
              <img src="<?= $imgD4 ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="200rem" style="object-fit: cover;">
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12 col-md-7">
          <h4>Entire&nbsp;<?= $property_type ?>&nbsp;in&nbsp;<?= $street ?></h4>
          <p class="fw-light"><?= $accommodates ?>&nbsp;guests&nbsp;&#8226;&nbsp;<?= $bedrooms ?>&nbsp;bedrooms&nbsp;&#8226;&nbsp;<?= $beds ?>&nbsp;beds&nbsp;&#8226;&nbsp;<?= $bathrooms ?>&nbsp;baths</p>
          <hr style="border: 1px solid grey"/>
          <div class="row align-items-center">
            <div class="col-2 col-md-1">
              <img src="" onerror="this.onerror=null; this.src='assets/default-avt.png'" width="50" height="50" class="rounded-circle" style="object-fit: cover;">
            </div>
            <div class="col-10 col-md-11">
              <p class="fw-bold mb-0">Hosted&nbsp;by&nbsp;<?= $host_name ?></p>
            </div>
          </div>
          <hr style="border: 1px solid grey"/>
          <p class="fw-light text-break"><?= $summary ?>...</p>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                  Show more
                </button>
              </h2>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                  <h3 class="fw-bold">About this space</h3>
                  <p class="fw-light text-break"><?= $description ?></p>
                  <p class="fw-bold">Other things to note</p>
                  <p class="fw-light text-break"><?= $notes ?? 'nothing...' ?></p>
                </div>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid grey"/>
          <h4>What this place offers</h4>
          <?php for ($i=0; $i < sizeof($amenitiesArr) ; $i++) { ?>
            <p class="fw-light"><img src="Assets/<?= $amenitiesArr[$i] ?>.svg" width="25" height="25">&nbsp;&nbsp;&nbsp;&nbsp;<?= $amenitiesArr[$i] ?></p>
          <?php } ?>
        </div>
        <div class="col-md-1">
        </div>
        <?php if ($iduser != $host_id): ?>
          <div class="col-12 col-md-4">
            <div class="card shadow mb-5 px-2 bg-white rounded" style="width: 100%;">
              <div class="card-body">
                <h5 class="card-title">$<?= $price ?>&nbsp;<span class="fs-6 fw-light">night</span></h5>
                <form action="RentController.php" method="post">
                  <div class="row mb-2">
                    <div class="col-6 pe-1">
                      <div class="form-floating">
                        <input type="date" min="<?= $today ?>" onchange="getchk()" class="form-control" name="checkIn" id="checkIn" value="<?= $checkin ?>">
                        <label for="checkIn">CHECK-IN</label>
                      </div>
                    </div>
                    <div class="col-6 ps-1">
                      <div class="form-floating">
                        <input type="date" class="form-control" onchange="getchk()" name="checkOut" id="checkOut" value="<?= $checkout ?>">
                        <label for="checkOut">CHECKOUT</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating">
                    <select class="form-select" name="guests" id="numbGuest" aria-label="Floating label select example">
                      <?php for ($i=1; $i <= $accommodates; $i++) {?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php } ?>
                    </select>
                    <label for="numbGuest">GUESTS</label>
                  </div>
                  <div class="row mt-2">
                    <div class="col-8">
                      <p class="mt-2 fw-light text-decoration-underline">$<span id="price"><?= $price ?></span> x <span id="days"></span> <span id="night"></span></p>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-3 text-end">
                      <p class="mt-2 fw-light">$<span id="total"></span></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <p class="mt-2 fw-light text-decoration-underline">Cleaning Fee</p>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-3 text-end">
                      <p class="mt-2 fw-light">$<span id="cleaning_fee"><?= $cleaning_fee ?></span></p>
                    </div>
                  </div>
                  <input type="hidden" name="iduser" value="<?= $iduser ?>">
                  <input type="hidden" name="idplace" value="<?= $id ?>">
                  <input type="hidden" name="price" value="<?= $price ?>">
                  <input type="hidden" name="cleaningfee" value="<?= $cleaning_fee ?>">
                  <input type="submit" id="checkSubmit" name="submit" class="btn btn-danger fst-light py-2 mt-2" value="Reserve" style="width: 100%">
                </form>
                <hr style="border: 1px solid grey"/>
                <div class="row">
                  <div class="col-7">
                    <p class="fw-bold">Total before taxes</p>
                  </div>
                  <div class="col-5 text-end">
                    <p class="fw-bold">$<span id="totalbf"></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>
      <hr style="border: 1px solid grey"/>
      <h3>Where you’ll be</h3>
      <iframe src="http://maps.google.com/maps?q=<?= $latitude ?>,<?= $longitude ?>&z=15&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <p class="fw-bold mt-1"><?= $state ?>,&nbsp;<?= $city ?>,&nbsp;<?= $country ?></p>
      <p class="fw-light text-break"><?= $transit ?? 'nothing...' ?></p>
    </div>
  </body>
</html>
<script>
  function getchk(){
    if(document.getElementById("checkIn").value != "" && document.getElementById("checkOut").value != "")
    {
      var dIn = new Date(document.getElementById("checkIn").value);
      var dOut = new Date(document.getElementById("checkOut").value);
      if(dIn.getTime() > dOut.getTime())
      {
        alert("CheckOut isn't less than CheckIn");
        return;
      }
      if(dIn.getTime() == dOut.getTime())
      {
        alert("Both dates aren't same");
        return;
      }
      var diff = dOut.getTime() - dIn.getTime();
      var daydiff = diff / (1000 * 60 * 60 * 24);
      var str = "night";
      if(daydiff > 1)
      {
        str = "nights";
      }
      document.getElementById("days").innerHTML = daydiff;
      document.getElementById("night").innerHTML = str;

      var price = document.getElementById("price").textContent;
      var days = document.getElementById("days").textContent;
      document.getElementById("total").innerHTML = days * price;
      var total = document.getElementById("total").textContent;
      var cleaning_fee = document.getElementById("cleaning_fee").textContent;
      var totalbf = parseInt(total) + parseInt(cleaning_fee);
      document.getElementById("totalbf").innerHTML = totalbf;
    }
  }
  document.getElementById("checkSubmit").addEventListener('click', (e) => {
      var dIn = new Date(document.getElementById("checkIn").value);
      var dOut = new Date(document.getElementById("checkOut").value);
      if(dIn.getTime() > dOut.getTime())
      {
        alert("CheckOut isn't less than CheckIn");
        e.preventDefault();
      }
      if(dIn.getTime() == dOut.getTime())
      {
        alert("Both dates aren't same");
        e.preventDefault();
      }
    });
</script>
