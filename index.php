<?php
session_start();
$url = 'https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/airbnb-listings/records?limit=100';
$json = file_get_contents($url);
$data = json_decode($json);
$list = $data->results;
$amenities = array("Wifi", "Kitchen", "Washer", "Air conditioning", "Heating", "TV", "Hair dryer", "Iron", "Pool", "Smoking allowed");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="Assets/airbnb-1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            <?php if (isset($_SESSION['idTokenString']) && !empty($_SESSION['idTokenString'])): ?>
              <li><a class="dropdown-item fw-bold fw-light" href="#">Wishlists</a></li>
              <li><a class="dropdown-item fw-bold fw-light" href="#">Airbnb your home</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="#">Account</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="logout.php">Log out</a></li>
            <?php else: ?>
              <li><a class="dropdown-item fw-bold fw-light" href="login.php">Sign in</a></li>
              <li><a class="dropdown-item fw-light" href="register.php">Sign up</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fw-light" href="">Airbnb your home</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <hr style="border: 1px solid black"/>
    <div class="container">
      <div class="row">
        <div class="col-11"></div>
        <div class="col">
          <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
            </svg>
             Filter
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                        <p class="fs-3 mb-0">Price range</p>
                        <p class="fw-light">Nightly prices before fees and taxes</p>
                      </div>
                    </div>
                    <div class="row gx-5">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-floating">
                          <input type="number" class="form-control" id="MinimumPrice" name="MinimumPrice" min="10">
                          <label for="MinimumPrice">Minimum</label>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-floating">
                          <input type="number" class="form-control" id="MaximumPrice" min="10">
                          <label for="MaximumPrice">Maximum</label>
                        </div>
                      </div>
                    </div>
                    <hr style="border: 1px solid gray"/>
                    <div class="row gy-3">
                      <div class="col-12">
                        <p class="fs-3 mb-0">Rooms and beds</p>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <select class="form-select" id="BedroomsSelect" aria-label="Floating label select example">
                            <option value="Any">Any</option>
                            <?php for ($i=1; $i <= 8; $i++) {?>
                              <?php if ($i < 8): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                              <?php else: ?>
                                <option value="<?= $i ?>"><?= $i ?> +</option>
                              <?php endif; ?>
                            <?php } ?>
                          </select>
                          <label for="BedroomsSelect">Bedrooms</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <select class="form-select" id="BedsSelect" aria-label="Floating label select example">
                            <option value="Any">Any</option>
                            <?php for ($i=1; $i <= 8; $i++) {?>
                              <?php if ($i < 8): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                              <?php else: ?>
                                <option value="<?= $i ?>"><?= $i ?> +</option>
                              <?php endif; ?>
                            <?php } ?>
                          </select>
                          <label for="BedsSelect">Beds</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <select class="form-select" id="BathroomsSelect" aria-label="Floating label select example">
                            <option value="Any">Any</option>
                            <?php for ($i=1; $i <= 8; $i++) {?>
                              <?php if ($i < 8): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                              <?php else: ?>
                                <option value="<?= $i ?>"><?= $i ?> +</option>
                              <?php endif; ?>
                            <?php } ?>
                          </select>
                          <label for="BathroomsSelect">Bathrooms</label>
                        </div>
                      </div>
                    </div>
                    <hr style="border: 1px solid gray"/>
                    <div class="row">
                      <div class="col-12">
                        <p class="fs-3">Amenities</p>
                      </div>
                    </div>
                    <div class="row row-cols-2 px-1 gy-3">
                      <?php for ($i=0; $i < sizeof($amenities); $i++) {?>
                        <div class="col">
                          <div class="form-check">
                            <input class="form-check-input mt-2" type="checkbox" value="<?= $amenities[$i] ?>" id="ch<?= $i ?>" name="ch<?= $i ?>" style="scale: 1.5">
                            <label class="form-check-label fw-light fs-5 ms-1" for="ch<?= $i ?>">
                              <?= $amenities[$i] ?>
                            </label>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-6">
                        <button type="button" class="btn btn-light" name="clearFilter">Clear all</button>
                      </div>
                      <div class="col-6 text-end">
                        <button type="button" class="btn btn-dark" name="showResult">Show</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-2 row row-cols-1 row-cols-md-4 g-sm-0 g-md-2">
        <?php foreach ($list as $element): ?>
          <div class="col">
            <a href="detail.php?id=<?= $element->id ?>" class="link-dark" style="text-decoration:none">
              <img src="<?= $element->xl_picture_url ?>" onerror="this.onerror=null; this.src='Assets/img-not-found.jpeg'" class="rounded" width="300" height="300">
              <div class="row">
                <div class="col-8">
                  <p class="mt-2 fw-bold"><?= $element->smart_location ?></p>
                </div>
                <div class="col-4 text-end">
                  <p class="mt-2 me-3 fw-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 20 20">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>&nbsp;<?= (double)(($element->review_scores_rating * 5) / 100) ?>
                  </p>
                </div>
              </div>
              <p class="text-secondary">Added&nbsp;<?= $element->calendar_updated ?></p>
              <p class="fw-light"><span class="fw-bold">$&nbsp;<?= $element->price ?></span>&nbsp;night</p>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </body>
</html>
