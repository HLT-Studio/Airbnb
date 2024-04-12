<?php
include_once("DBconnect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
$amenities = array("Wifi", "Kitchen", "Washer", "Air conditioning", "Heating", "TV", "Hair dryer", "Iron", "Pool", "Smoking allowed");
foreach ($conn->query($sql) as $home ) {
  $amenitiesString = $home['amenities'];
}
$amenitiesMyHome = explode(', ', $amenitiesString);
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
                <p class="fs-3 mb-0">Tell guests what your place has to offer</p>
                <p class="fw-light">You can add more amenities after you publish your listing.</p>
              </div>
            </div>
            <div class="row row-cols-2 px-1 gy-3">
              <?php for ($i = 0; $i < sizeof($amenities); $i++): ?>
                <?php $status = false; ?>
                <?php for ($j = 0; $j < sizeof($amenitiesMyHome); $j++): ?>
                  <?php if ($amenitiesMyHome[$j] == $amenities[$i]): ?>
                    <div class="col text-start">
                      <div class="form-check">
                        <input class="form-check-input mt-2" type="checkbox" value="<?= $amenities[$i] ?>" id="ch<?= $i ?>" name="ch<?= $i ?>" style="scale: 1.5" checked>
                        <label class="form-check-label fw-light fs-5 ms-1" for="ch<?= $i ?>">
                          <?= $amenities[$i] ?>
                        </label>
                      </div>
                    </div>
                    <?php array_splice($amenitiesMyHome, $j, 1); $status = true; break; ?>
                  <?php endif ?>
                <?php endfor ?>
                <?php if ($status == false): ?>
                  <div class="col text-start">
                    <div class="form-check">
                      <input class="form-check-input mt-2" type="checkbox" value="<?= $amenities[$i] ?>" id="ch<?= $i ?>" name="ch<?= $i ?>" style="scale: 1.5">
                      <label class="form-check-label fw-light fs-5 ms-1" for="ch<?= $i ?>">
                        <?= $amenities[$i] ?>
                      </label>
                    </div>
                  </div>
                <?php endif ?>
              <?php endfor ?>
            </div>
            <hr style="border: 1px solid gray"/>
            <div class="row">
              <div class="col-12 text-end">
                <input type="submit" class="btn btn-dark" name="save-amenities" value="Save" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
