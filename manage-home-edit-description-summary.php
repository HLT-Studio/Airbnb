<?php
include_once("DBconnect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
foreach ($conn->query($sql) as $home ) {
  $summary = $home["summary"];
  $description = $home["description"];
  $notes = $home["notes"];
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
                <p class="fs-3 mb-0">Create your description</p>
                <p class="fw-light">Share what makes your place special.</p>
              </div>
              <div class="col-12 text-start">
                <textarea class="form-control" id="description" name="description" maxlength="500" style="height: 300px"><?= $description ?></textarea>
                <p class="mt-2 fw-light" id="count-character-desc">0/500</p>
                <script>
                  document.getElementById('description').onkeyup = function () {
                    document.getElementById('count-character-desc').innerHTML = this.value.length + "/500";
                  };
                </script>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-start">
                <p class="fs-3 mb-0">Create your Summary</p>
                <p class="fw-light">Introduce your location as well as things to keep in mind for visitors.</p>
              </div>
              <div class="col-12 text-start">
                <textarea class="form-control" id="summary" name="summary" maxlength="500" style="height: 300px"><?= $summary ?></textarea>
                <p class="mt-2 fw-light" id="count-character-summary">0/500</p>
                <script>
                  document.getElementById('summary').onkeyup = function () {
                    document.getElementById('count-character-summary').innerHTML = this.value.length + "/500";
                  };
                </script>
              </div>
              <div class="col-12 text-start mt-3">
                <div class="form-floating">
                  <input class="form-control" type="text" name="notes" id="notes" placeholder="notes" value="<?= $notes ?>">
                  <label for="notes">Other notes</label>
                </div>
              </div>
            </div>
            <hr style="border: 1px solid gray"/>
            <div class="row">
              <div class="col-12 text-end">
                <input type="submit" class="btn btn-dark" name="save-info" value="Save" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
