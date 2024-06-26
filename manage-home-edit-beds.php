<?php
include_once("DBconnect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
foreach ($conn->query($sql) as $home ) {
  $accommodates = (int)$home['accommodates'];
  $bathrooms = (int)$home['bathrooms'];
  $bedrooms = (int)$home['bedrooms'];
  $beds = (int)$home['beds'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="placeController.php" method="post">
            <input type="hidden" name="place-id" value="<?= $id ?>">
            <div class="row gy-3">
              <div class="col-12 text-start">
                <p class="fs-3 mb-0">Share some basics about your place</p>
                <p class="fw-light">You'll add more details later, like bed types</p>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input class="form-control" type="number" min="1" name="accommodates" id="accommodates" placeholder="accommodates" value="<?= $accommodates ?>">
                  <label for="accommodates">Guests</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input class="form-control" type="number" min="1" name="bedrooms" id="bedrooms" placeholder="bedrooms" value="<?= $bedrooms ?>">
                  <label for="bedrooms">Bedrooms</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input class="form-control" type="number" min="1" name="beds" id="beds" placeholder="beds" value="<?= $beds ?>">
                  <label for="beds">Beds</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input class="form-control" type="number" min="1" name="bathrooms" id="bathrooms" placeholder="bathrooms" value="<?= $bathrooms ?>">
                  <label for="bathrooms">Bathrooms</label>
                </div>
              </div>
            </div>
            <hr style="border: 1px solid gray"/>
            <div class="row">
              <div class="col-12 text-end">
                <input type="submit" class="btn btn-dark" name="save-beds" value="Save" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
