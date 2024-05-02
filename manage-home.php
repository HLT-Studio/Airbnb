<?php
session_start();
include_once("DBconnect.php");
include_once("pagination.php");
$id = (int)$_SESSION['user_id'];
$amenities = array("Wifi", "Kitchen", "Washer", "Air conditioning", "Heating", "TV", "Hair dryer", "Iron", "Pool", "Smoking allowed");
$result = "SELECT * FROM `place` WHERE `host_id` = $id ORDER BY `id` ASC LIMIT $position, $display;";
$index = 1;
if(isset($_GET['page'])){
  $index = $_GET['page'];
}
$next = ($index + 1) > $total_pages ? $total_pages : ($index + 1);
$previous = ($index - 1) < 1 ? 1 : ($index - 1);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Home</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <style>
    .col {position: relative;}
    .insideimg {position: absolute !important; top: 10px !important; right: 20px !important;}
  </style>
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
      <form action="placeController.php" method="post">
        <div class="row">
          <div class="col-8">
            <h3 class="mb-0">Your home</h3>
          </div>
          <div class="col-4 text-center text-md-end">
            <button type="button" name="btn-search-home" class="btn btn-light p-2 rounded-circle">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
            </button>
            <button type="button" class="btn btn-light p-2 rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
              </svg>
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Home</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Which of these best describes your place?</p>
                          <div class="mt-2 row row-cols-2 row-cols-md-3 g-2">
                            <div class="col">
                              <input type="radio" class="btn-check" name="property_type" id="house" autocomplete="off" value="House">
                              <label class="btn btn-outline-dark py-3 w-100" for="house">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                                </svg><br>
                                House
                              </label>
                            </div>
                            <div class="col">
                              <input type="radio" class="btn-check" name="property_type" id="hotel" autocomplete="off" value="Hotel">
                              <label class="btn btn-outline-dark py-3 w-100" for="hotel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-house-heart" viewBox="0 0 16 16">
                                  <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.309 8 6.982"/>
                                  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.707L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.646a.5.5 0 0 0 .708-.707L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                                </svg><br>
                                Hotel
                              </label>
                            </div>
                            <div class="col">
                              <input type="radio" class="btn-check" name="property_type" id="tent" autocomplete="off" value="Tent">
                              <label class="btn btn-outline-dark py-3 w-100" for="tent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-triangle-half" viewBox="0 0 16 16">
                                  <path d="M8.065 2.016A.13.13 0 0 0 8.002 2v11.983l6.856.017a.12.12 0 0 0 .066-.017.2.2 0 0 0 .054-.06.18.18 0 0 0-.002-.183L8.12 2.073a.15.15 0 0 0-.054-.057zm-1.043-.45a1.13 1.13 0 0 1 1.96 0l6.856 11.667c.458.778-.091 1.767-.98 1.767H1.146c-.889 0-1.437-.99-.98-1.767z"/>
                                </svg><br>
                                Tent
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Where's your place located?</p>
                          <p class="fw-light">Your address is only shared with guests after they’ve made a reservation.</p>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control rounded-bottom-0" type="text" maxlength="100" name="street" id="street" placeholder="street">
                            <label for="street">Street address</label>
                          </div>
                          <div class="form-floating">
                            <input class="form-control border border-top-0 rounded-top-0 rounded-bottom-0" type="text" maxlength="100" name="city" id="city" placeholder="city">
                            <label for="city">City / town / village</label>
                          </div>
                          <div class="form-floating">
                            <input class="form-control border border-top-0 rounded-top-0 rounded-bottom-0" type="text" maxlength="100" name="state" id="state" placeholder="state">
                            <label for="state">Province / state / territory (if applicable)</label>
                          </div>
                          <div class="form-floating">
                            <input class="form-control border border-top-0 rounded-top-0" type="text" maxlength="10" name="country" id="country" placeholder="country">
                            <label for="country">Country</label>
                          </div>
                        </div>
                        <div class="col-12 text-start pt-3">
                          <p class="fs-3 mb-0">Geolocation</p>
                          <p class="fw-light">You need to search for your location's coordinates on Google maps.</p>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control rounded-bottom-0" type="number" step="0.00001" name="latitude" id="latitude" placeholder="street">
                            <label for="street">Latitude</label>
                          </div>
                          <div class="form-floating">
                            <input class="form-control border border-top-0 rounded-top-0" type="number" step="0.00001" name="longtitude" id="longtitude" placeholder="longtitude">
                            <label for="longtitude">Longtitude</label>
                          </div>
                        </div>
                        <div class="col-12 text-start pt-3">
                          <p class="fs-3 mb-0">Transit</p>
                          <p class="fw-light">Things to note when moving around the living area.</p>
                        </div>
                        <div class="col-12 text-start">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="transit" id="transit" placeholder="transit">
                            <label for="transit">Transit</label>
                          </div>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row gy-3">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Share some basics about your place</p>
                          <p class="fw-light">You'll add more details later, like bed types</p>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="number" min="1" name="accommodates" id="accommodates" placeholder="accommodates">
                            <label for="accommodates">Guests</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="number" min="1" name="bedrooms" id="bedrooms" placeholder="bedrooms">
                            <label for="bedrooms">Bedrooms</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="number" min="1" name="beds" id="beds" placeholder="beds">
                            <label for="beds">Beds</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="number" min="1" name="bathrooms" id="bathrooms" placeholder="bathrooms">
                            <label for="bathrooms">Bathrooms</label>
                          </div>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Tell guests what your place has to offer</p>
                          <p class="fw-light">You can add more amenities after you publish your listing.</p>
                        </div>
                      </div>
                      <div class="row row-cols-2 px-1 gy-3">
                        <?php for ($i=0; $i < sizeof($amenities); $i++) {?>
                          <div class="col text-start">
                            <div class="form-check">
                              <input class="form-check-input mt-2" type="checkbox" value="<?= $amenities[$i] ?>" id="ch<?= $i ?>" name="ch<?= $i ?>" style="scale: 1.5">
                              <label class="form-check-label fw-light fs-5 ms-1" for="ch<?= $i ?>">
                                <?= $amenities[$i] ?>
                              </label>
                              <input type="hidden" id="amenities" name="amenities" value="">
                              <input type="hidden" id="getsizeamenities" value="<?php echo sizeof($amenities) ?>">

                            </div>
                          </div>
                        <?php } ?>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Add some photos of your house</p>
                          <p class="fw-light">You'll need photo to get started. You can add more or make changes later.</p>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="xl_picture_url" id="xl_picture_url" placeholder="xl_picture_url">
                            <label for="xl_picture_url">Url image</label>
                          </div>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Now, let's give your house a title</p>
                          <p class="fw-light">Short titles work best. Have fun with it—you can always change it later.</p>
                        </div>
                        <div class="col-12 text-start">
                          <textarea class="form-control" id="name" name="name" maxlength="32" style="height: 200px"></textarea>
                          <p class="mt-2 fw-light" id="count-character-name">0/32</p>
                          <script type="text/javascript">
                            document.getElementById('name').onkeyup = function () {
                              document.getElementById('count-character-name').innerHTML = this.value.length + "/32";
                            };
                          </script>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Create your description</p>
                          <p class="fw-light">Share what makes your place special.</p>
                        </div>
                        <div class="col-12 text-start">
                          <textarea class="form-control" id="description" name="description" maxlength="500" style="height: 300px"></textarea>
                          <p class="mt-2 fw-light" id="count-character-desc">0/500</p>
                          <script>
                            document.getElementById('description').onkeyup = function () {
                              document.getElementById('count-character-desc').innerHTML = this.value.length + "/500";
                            };
                          </script>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Create your Summary</p>
                          <p class="fw-light">Introduce your location as well as things to keep in mind for visitors.</p>
                        </div>
                        <div class="col-12 text-start">
                          <textarea class="form-control" id="summary" name="summary" maxlength="500" style="height: 300px"></textarea>
                          <p class="mt-2 fw-light" id="count-character-summary">0/500</p>
                          <script>
                            document.getElementById('summary').onkeyup = function () {
                              document.getElementById('count-character-summary').innerHTML = this.value.length + "/500";
                            };
                          </script>
                        </div>
                        <div class="col-12 text-start">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="notes" id="notes" placeholder="notes">
                            <label for="notes">Other notes</label>
                          </div>
                        </div>
                      </div>
                      <hr style="border: 1px solid gray"/>
                      <div class="row gy-3">
                        <div class="col-12 text-start">
                          <p class="fs-3 mb-0">Now, set your price</p>
                          <p class="fw-light">You can change it anytime.</p>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="number" min="1" name="price" id="price" placeholder="price">
                            <label for="price">Price</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating">
                            <input class="form-control" type="number" min="1" name="cleaning_fee" id="cleaning_fee" placeholder="cleaning_fee">
                            <label for="cleaning_fee">Cleaning Fee</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-6 text-start">
                          <input type="reset" class="btn btn-light" name="reset" value="Reset all" />
                        </div>
                        <div class="col-6 text-end">
                          <input type="submit" class="btn btn-dark" name="insert" value="Done" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-5 row row-cols-1 row-cols-md-3 g-sm-3 g-md-3">
          <?php foreach ($conn->query($result) as $place): ?>
            <div class="col">
              <?php if($place['approve'] == 0) {?>
                <span class="btn btn-primary insideimg">Wait to approve</span>
              <?php } ?>
              <a href="manage-home-editor.php?id=<?= $place['id'] ?>" class="link-dark waitapprove" style="text-decoration:none">
                <img src="<?= $place['xl_picture_url'] ?>" onerror="this.onerror=null; this.src='assets/img-not-found.jpeg'" class="rounded imgcontain" width="100%" height="300px" style="object-fit: cover;">
                <div class="row mt-2">
                  <div class="col-12">
                    <p class="fw-bold mb-0"><?= $place['name'] ?></p>
                  </div>
                  <div class="col-12">
                    <p class="text-secondary"><?= $place['city'] . ", " . $place['state'] ?></p>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation example">
      	  <ul class="pagination justify-content-center mt-3">
      		<li class="page-item">
      		  <a class="page-link text-black" href="<?= $page_url . "?page=" . $previous ?>">Previous</a>
      		</li>
      		<li class="page-item"><a class="page-link text-black" href="<?= $page_url . "?page=" . ($index ?? 1) ?>"><?= $index ?? 1 ?></a></li>
      		<li class="page-item">
      		  <a class="page-link text-black" href="<?= $page_url . "?page=" . $next ?>">Next</a>
      		</li>
      	  </ul>
      	</nav>
      </form>
    </div>
  </body>
</html>
