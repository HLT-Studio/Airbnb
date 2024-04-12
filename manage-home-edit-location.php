<?php
include_once("DBconnect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
foreach ($conn->query($sql) as $home ) {
  $latitude = (double)$home['latitude'];
  $longitude = (double)$home['longitude'];
  $street = $home['street'];
  $city = $home['city'];
  $state = $home['state'];
  $country = $home['country'];
  $transit = $home['transit'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="placeController.php" method="post">
            <input type="hidden" name="place-id" value="<?= $id ?>">
            <div class="row">
              <div class="col-12 text-start">
                <p class="fs-3 mb-0">Where's your place located?</p>
                <p class="fw-light">Your address is only shared with guests after they’ve made a reservation.</p>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input class="form-control rounded-bottom-0" type="text" maxlength="100" name="street" id="street" placeholder="street" value="<?= $street ?>">
                  <label for="street">Street address</label>
                </div>
                <div class="form-floating">
                  <input class="form-control border border-top-0 rounded-top-0 rounded-bottom-0" type="text" maxlength="100" name="city" id="city" placeholder="city" value="<?= $city ?>">
                  <label for="city">City / town / village</label>
                </div>
                <div class="form-floating">
                  <input class="form-control border border-top-0 rounded-top-0 rounded-bottom-0" type="text" maxlength="100" name="state" id="state" placeholder="state" value="<?= $state ?>">
                  <label for="state">Province / state / territory (if applicable)</label>
                </div>
                <div class="form-floating">
                  <input class="form-control border border-top-0 rounded-top-0" type="text" maxlength="10" name="country" id="country" placeholder="country" value="<?= $country ?>">
                  <label for="country">Country</label>
                </div>
              </div>
              <div class="col-12 text-start pt-3">
                <p class="fs-3 mb-0">Geolocation</p>
                <p class="fw-light">You need to search for your location's coordinates on Google maps.</p>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input class="form-control rounded-bottom-0" type="number" step="0.00001" max="90" min="-90" name="latitude" id="latitude" placeholder="street" value="<?= $latitude ?>">
                  <label for="street">Latitude</label>
                </div>
                <div class="form-floating">
                  <input class="form-control border border-top-0 rounded-top-0" type="number" step="0.00001" max="180" min="-180" name="longtitude" id="longtitude" placeholder="longtitude" value="<?= $longitude ?>">
                  <label for="longtitude">Longtitude</label>
                </div>
              </div>
              <div class="col-12 text-start pt-3">
                <p class="fs-3 mb-0">Transit</p>
                <p class="fw-light">Things to note when moving around the living area.</p>
              </div>
              <div class="col-12 text-start">
                <div class="form-floating">
                  <input class="form-control" type="text" name="transit" id="transit" placeholder="transit" value="<?= $transit ?>">
                  <label for="transit">Transit</label>
                </div>
              </div>
            </div>
            <hr style="border: 1px solid gray"/>
            <div class="row">
              <div class="col-12 text-end">
                <input type="submit" class="btn btn-dark" name="save-location" value="Save" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
