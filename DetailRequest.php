<?php
session_start();
include_once("DBconnect.php");

if(isset($_POST["BookingDetail"])){
  $userid = $_POST["userid"];
  $placeid = $_POST["placeid"];
  $idstorage = $_POST["idstorage"];
}

$sql = "SELECT * FROM `place` WHERE `id` = $placeid;";
foreach ($conn->query($sql) as $home) {
  $xl_picture_url = $home['xl_picture_url'];
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
  $amenitiesArr = explode(', ', $amenities);
}

$sqlstorage = "Select * from requestpayment where id = $idstorage";

foreach ($conn->query($sqlstorage) as $obj) {
  $checkin = $obj['chkIn'];
  $checkout = $obj['chkOut'];
  $total = $obj['total'];
  $paid = $obj['paid'];
  $guests = $obj['guests'];
  $dateReq = $obj['dateReq'];
}

$sql_notify = "SELECT * FROM `notify` WHERE `hostid` = $host_id;";
$records = $conn->query($sql_notify);
$total_rows = $records->rowCount();

$sqlhost = "Select * from user where id = $host_id";

foreach ($conn->query($sqlhost) as $user) {
  $host_name = $user['name'];
}

$sqluser = "Select * from user where id = $userid";

foreach ($conn->query($sqluser) as $user) {
  $nameuser = $user['name'];
  $phoneuser = $user['phone'];
  $email = $user['email'];
}

$status = "Unpaid";
$classhidden = "";
$colorStatus = "text-danger";
if($paid == 1){
    $status = "Paid";
    $classhidden = "d-none";
    $colorStatus = "text-success";
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
        <div class="col-12 col-md-6">
          <h3><?= $name ?></h3>
        </div>
        <div class="col-12 col-md-6 text-center text-md-end">
          <h3><span class="fw-bold">Date requested: </span><?= $dateReq ?></h3>
        </div>
      </div>
      <div class="row g-sm-2 g-md-2">
        <div class="col-12 col-md-6">
          <img src="<?= $xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="100%">
        </div>
        <div class="col-0 col-md-6">
          <div class="row row-cols-1 row-cols-md-2 g-sm-2 g-md-2">
            <div class="col">
              <img src="<?= $xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="100%">
            </div>
            <div class="col">
              <img src="<?= $xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="100%">
            </div>
            <div class="col">
              <img src="<?= $xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="100%">
            </div>
            <div class="col">
              <img src="<?= $xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" width="100%" height="100%">
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12 col-md-7">
          <h4>Entire&nbsp;<?= $property_type ?>&nbsp;in&nbsp;<?= $street ?></h4>
          <p class="fw-light"><?= $accommodates ?>&nbsp;guests&nbsp;&#8226;&nbsp;<?= $bedrooms ?>&nbsp;bedrooms&nbsp;&#8226;&nbsp;<?= $beds ?>&nbsp;beds&nbsp;&#8226;&nbsp;<?= $bathrooms ?>&nbsp;baths</p>
          <p class="fw-bold">
           <h3>Contact information of the requester</h3>
          </p>
          <hr style="border: 1px solid grey"/>
          <div class="row align-items-center">
            <div class="col-12">
                <p><span class="fw-bold">Full name: </span><?= $nameuser ?></p>
                <p><span class="fw-bold">Phone: </span><?= $phoneuser ?></p>
                <p><span class="fw-bold">Email: </span><?= $email ?></p>
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
                  <p class="fw-light text-break"><?= $objc[0]->notes ?? 'nothing...' ?></p>
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
        <div class="col-12 col-md-4">
          <div class="card shadow mb-5 px-2 bg-white rounded" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title">$<?= number_format($price) ?>&nbsp;<span class="fs-6 fw-light">night</span></h5>
              <form action="RentController.php" method="post">
                <input type="hidden" name="hostid" value="<?= $host_id ?>">
                <input type="hidden" name="idstorage" value="<?= $idstorage ?>">
                <div class="row mb-2">
                  <div class="col-6 pe-1">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="checkIn" id="checkIn" value="<?= $checkin ?>" readonly>
                      <label for="checkIn">CHECK-IN</label>
                    </div>
                  </div>
                  <div class="col-6 ps-1">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="checkOut" id="checkOut" value="<?= $checkout ?>" readonly>
                      <label for="checkOut">CHECKOUT</label>
                    </div>
                  </div>
                </div>
                <div class="form-floating">
                <input type="text" class="form-control" name="guests" id="numbGuest" value="<?= $guests ?>" readonly>
                  <label for="numbGuest">GUESTS</label>
                </div>
                <div class="row mt-2">
                  <div class="col-6">
                    <p class="mt-2 fw-light text-decoration-underline">total</p>
                  </div>
                  <div class="col-6 text-end">
                    <p class="mt-2 fw-light">$<?= number_format($total) ?></p>
                  </div>
                </div>
                <div class="form-check <?= $classhidden ?>">
                    <input class="form-check-input" type="radio" name="response" id="accept" value="accept">
                    <label class="form-check-label text-success" for="accept">
                        Accept
                    </label>
                </div>
                <div class="form-check <?= $classhidden ?>">
                    <input class="form-check-input" type="radio" name="response" id="reject" value="reject">
                    <label class="form-check-label text-danger" for="reject">
                        Reject
                    </label>
                </div>
                <input type="submit" id="checkSubmit" name="ResponseRequest" class="btn btn-danger fst-light py-2 mt-2 <?= $classhidden ?>" value="Response" style="width: 100%">
              </form>
              <hr style="border: 1px solid grey"/>
              <div class="row">
                <div class="col-7">
                  <p class="fw-bold">Status</p>
                </div>
                <div class="col-5 text-end">
                  <p class="fw-bold <?= $colorStatus ?>"><?= $status ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  document.getElementById("checkSubmit").addEventListener('click', (e) => {
      var yes = document.getElementById("accept");
      var no = document.getElementById("reject");
      if(!yes.checked && !no.checked)
      {
        alert("Have to choose Accept or Reject booking request");
        e.preventDefault();
      }
    });
</script>
