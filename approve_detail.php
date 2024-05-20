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
      $amenitiesArr = explode(', ', $amenities);
      $approve = $home['approve'];
    }
    $host_query = "SELECT * FROM `user` WHERE `id` = $host_id;";
    foreach ($conn->query($host_query) as $user) {
      $host_name = $user['name'];
    }
    $home_address = $street . ", " . $city;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place wait to approve</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav class="navbar bg-white">
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
    <div class="row mb-3">
      <div class="col-12 text-center">
        <h2 class="fw-bold">REVIEW</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h3><?= $name ?></h3>
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
            <h5 class="card-title">Admin Controller</h5>
            <form action="notifyController.php" method="post">
              <a class="card-subtitle mb-2 fw-bold link-underline link-underline-opacity-0" data-bs-toggle="collapse" href="#messageBox" role="button" aria-expanded="false" aria-controls="messageBox" >
                Send message to Host&nbsp;&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                </svg>
              </a>
              <div class="collapse" id="messageBox">
                <div class="row mt-2">
                  <div class="col-12">
                    <textarea class="form-control" id="mess_container" name="mess_container" maxlength="100%" style="height: 200px"></textarea>
                    <input type="hidden" name="host_id" value="<?= $host_id ?>">
                    <input type="hidden" name="home_name" value="<?= $name ?>">
                    <input type="hidden" name="home_address" value="<?= $home_address ?>">
                    <input type="hidden" name="place_id" value="<?= $id ?>">
                  </div>
                  <div class="col-12 text-end mt-2">
                    <input class="btn btn-primary me-2" type="submit" name="sendMess" id="sendMess" value="Send">
                    <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#messageBox" role="button" aria-expanded="false" aria-controls="messageBox" >Cancel</a>
                  </div>
                </div>
              </div>
            </form>
            <form action="placeController.php" method="post">
              <input type="hidden" name="adminId" value="<?php echo $_SESSION['user_id'] ?>">
              <input type="hidden" name="placeId" value="<?php echo $_GET["id"] ?>">
              <hr style="border: 1px solid grey"/>
              <?php if ($approve == 0): ?>
                <input type="submit" id="approve" name="approve" class="btn btn-success fst-light py-2 mt-2" value="Approve" style="width: 100%">
              <?php else: ?>
                <input type="submit" id="disapprove" name="disapprove" class="btn btn-danger fst-light py-2 mt-2" value="Disapprove" style="width: 100%">
              <?php endif ?>
            </form>
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
