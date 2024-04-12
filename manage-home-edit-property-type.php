<?php
include_once("DBconnect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM `place` WHERE `id` = $id;";
foreach ($conn->query($sql) as $home ) {
  $property_type = $home['property_type'];
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
  <body onload="loadPage()">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="placeController.php" method="post">
            <input type="hidden" name="place-id" value="<?= $id ?>">
            <input type="hidden" id="home_type" value="<?= $property_type ?>">
            <div class="row">
              <div class="col-12 text-start">
                <p class="fs-3 mb-0">Which of these best describes your place?</p>
                <div class="mt-2 row row-cols-2 row-cols-md-3 g-2">
                  <div class="col">
                    <input type="radio" class="btn-check" name="property_type" id="house" autocomplete="off" value="House" on>
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
              <div class="col-12 text-end">
                <input type="submit" class="btn btn-dark" name="save-property-type" value="Save" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function loadPage() {
        switch(document.getElementById('home_type').value) {
          case "House":
            document.getElementById('house').checked = true;
            break;
          case "Hotel":
            document.getElementById('hotel').checked = true;
            break;
          case "Tent":
            document.getElementById('tent').checked = true;
            break;
        }
      }
    </script>
  </body>
</html>
