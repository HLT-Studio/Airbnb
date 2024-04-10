<?php
session_start();
$obid = htmlspecialchars($_GET["id"]);
$url = "https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/airbnb-listings/records?select=*&where=id%3D$obid&limit=1";
$json = file_get_contents($url);
$data = json_decode($json);
$objc = $data->results;

$rating = $objc[0]->review_scores_rating;
$star = (double)(($rating * 5) / 100);

$date=date_create($objc[0]->host_since);
$date_formated = date_format($date, "d/m/Y");
$amenities = $objc[0]->amenities;
$today=date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $objc[0]->name ?></title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
              <li><a class="dropdown-item fw-bold fw-light" href="wishlist.php">Wishlists</a></li>
              <li><a class="dropdown-item fw-bold fw-light" href="manage-home.php">Airbnb your home</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="#">Account</a></li>
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
        <div class="col-12 col-md-11">
          <h3><?= $objc[0]->name ?></h3>
        </div>
        <div class="col-12 col-md-1 text-center text-md-end">
          <a class="icon-link icon-link-hover link-dark" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
            </svg>
            Save
          </a>
        </div>
      </div>
      <div class="row g-sm-2 g-md-2">
        <div class="col-12 col-md-6">
          <img src="<?= $objc[0]->xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="img-fluid">
        </div>
        <div class="col-0 col-md-6">
          <div class="row row-cols-1 row-cols-md-2 g-sm-2 g-md-2">
            <div class="col">
              <img src="<?= $objc[0]->xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="img-fluid">
            </div>
            <div class="col">
              <img src="<?= $objc[0]->xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="img-fluid">
            </div>
            <div class="col">
              <img src="<?= $objc[0]->xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="img-fluid">
            </div>
            <div class="col">
              <img src="<?= $objc[0]->xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12 col-md-7">
          <h4>Entire&nbsp;<?= $objc[0]->property_type ?>&nbsp;in&nbsp;<?= $objc[0]->street ?></h4>
          <p class="fw-light"><?= $objc[0]->accommodates ?>&nbsp;guests&nbsp;&#8226;&nbsp;<?= $objc[0]->bedrooms ?>&nbsp;bedrooms&nbsp;&#8226;&nbsp;<?= $objc[0]->beds ?>&nbsp;beds&nbsp;&#8226;&nbsp;<?= $objc[0]->bathrooms ?>&nbsp;baths</p>
          <p class="fw-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 20 20">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>&nbsp;<?= $star ?>&nbsp;&#8226;&nbsp;<?= $objc[0]->number_of_reviews ?>&nbsp;reviews
          </p>
          <hr style="border: 1px solid grey"/>
          <div class="row align-items-center">
            <div class="col-2 col-md-1">
              <img src="<?= $objc[0]->host_picture_url ?>" onerror="this.onerror=null; this.src='Assets/default-avt.png'" width="50" height="50" class="rounded-circle">
            </div>
            <div class="col-10 col-md-11">
              <p class="fw-bold mb-0">Hosted&nbsp;by&nbsp;<?= $objc[0]->host_name ?></p>
              <p class="text-secondary fw-light mb-0">Joined&nbsp;in&nbsp;<?= $date_formated ?></p>
            </div>
          </div>
          <hr style="border: 1px solid grey"/>
          <p class="fw-light text-break"><?= $objc[0]->summary ?>...</p>
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
                  <p class="fw-light text-break"><?= $objc[0]->description ?></p>
                  <p class="fw-bold">The space</p>
                  <p class="fw-light text-break"><?= $objc[0]->space ?? 'nothing...' ?></p>
                  <p class="fw-bold">Guest access</p>
                  <p class="fw-light text-break"><?= $objc[0]->access ?? 'nothing...' ?></p>
                  <p class="fw-bold">Other things to note</p>
                  <p class="fw-light text-break"><?= $objc[0]->notes ?? 'nothing...' ?></p>
                </div>
              </div>
            </div>
          </div>
          <hr style="border: 1px solid grey"/>
          <h4>What this place offers</h4>
          <?php for ($i=0; $i < sizeof($amenities) ; $i++) { ?>
            <p class="fw-light"><img src="Assets/<?= $amenities[$i] ?>.svg" width="25" height="25">&nbsp;&nbsp;&nbsp;&nbsp;<?= $amenities[$i] ?></p>
          <?php } ?>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-12 col-md-4">
          <div class="card shadow mb-5 px-2 bg-white rounded" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title">$<?= $objc[0]->price ?>&nbsp;<span class="fs-6 fw-light">night</span></h5>
              <form action="" method="post">
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
                  <select class="form-select" id="numbGuest" aria-label="Floating label select example">
                    <?php for ($i=1; $i <= $objc[0]->accommodates; $i++) {?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                  </select>
                  <label for="numbGuest">GUESTS</label>
                </div>
                <div class="row mt-2">
                  <div class="col-8">
                    <p class="mt-2 fw-light text-decoration-underline">$<span id="price"><?= $objc[0]->price ?></span> x <span id="days"></span> <span id="night"></span></p>
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
                    <p class="mt-2 fw-light">$<span id="cleaning_fee"><?= $objc[0]->cleaning_fee ?></span></p>
                  </div>
                </div>
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
      </div>
      <hr style="border: 1px solid grey"/>
      <h3>Where you’ll be</h3>
      <iframe src="http://maps.google.com/maps?q=<?= $objc[0]->latitude ?>,<?= $objc[0]->longitude ?>&z=15&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <p class="fw-bold mt-1"><?= $objc[0]->state ?>,&nbsp;<?= $objc[0]->city ?>,&nbsp;<?= $objc[0]->country ?></p>
      <p class="fw-light text-break"><?= $objc[0]->transit ?? 'nothing...' ?></p>
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
