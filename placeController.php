<?php
    include_once("DBconnect.php");
    session_start();
    $amenitiesArr = array("Wifi", "Kitchen", "Washer", "Air conditioning", "Heating", "TV", "Hair dryer", "Iron", "Pool", "Smoking allowed");

    //user insert place
    if (isset($_POST['insert'])) {
        $host_id = $_SESSION['user_id'];
        $name = $_POST["name"];
        $summary = $_POST["summary"];
        $description = $_POST["description"];
        $notes = $_POST["notes"];
        $transit = $_POST["transit"];
        $xl_picture_url = $_POST["ImageName1"];
        $ImageName2 = $_POST["ImageName2"];
        $ImageName3 = $_POST["ImageName3"];
        $ImageName4 = $_POST["ImageName4"];
        $ImageName5 = $_POST["ImageName5"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];
        $latitude = $_POST["latitude"];
        $longtitude = $_POST["longtitude"];
        $property_type = $_POST["property_type"];
        $accommodates = $_POST["accommodates"];
        $bathrooms = $_POST["bathrooms"];
        $bedrooms = $_POST["bedrooms"];
        $beds = $_POST["beds"];
        $amenities = $_POST["amenities"];
        $price = (int)$_POST["price"];
        $cleaning_fee = (int)$_POST["cleaning_fee"];
        $calendar_updated = date("d/m/Y");
        $number_of_reviews = 0;
        $review_scores_rating = 0;
        $approve = 0;

        for($i=0; $i<sizeof($amenitiesArr); $i++){
            if(isset($_POST["ch".$i])){
                $amenities .= $_POST["ch".$i] . ", ";
            }
        }
        $amenities = rtrim($amenities, ', ');

        $sqltest = "INSERT INTO `place` (`id`, `name`, `summary`, `description`, `notes`, `transit`, `xl_picture_url`, `imgD1`, `imgD2`, `imgD3`, `imgD4`, `street`, `city`, `state`, `country`, `latitude`, `longitude`, `property_type`, `accommodates`, `bathrooms`, `bedrooms`, `beds`, `amenities`, `price`, `cleaning_fee`, `calendar_updated`, `number_of_reviews`, `review_scores_rating`, `host_id`, `approve`) VALUES 
        (NULL, '$name', '$summary', '$description', '$notes', '$transit', '$xl_picture_url', '$ImageName2', '$ImageName3', '$ImageName4', '$ImageName5', '$street', '$city', '$state', '$country', '$latitude', '$longitude', '$property_type', '$accommodates', '$bathrooms', '$bedrooms', '$beds', '$amenities', '$price', '$cleaning_fee', '$calendar_updated', '$number_of_reviews', '$review_scores_rating', '$host_id', '$approve')
        ";

        $conn->exec($sqltest);
        header('Location: manage-home.php');
        exit();
    }

    //admin approve place of user
    if (isset($_POST["approve"])) {
        try{
            if(!isset($_POST['adminId'])){
                throw new Exception("Only admin can approve user's post !!!");
            }
            else{
                $placeid = $_POST['placeId'];
                $sqlApprove = "UPDATE `place` SET `approve` = '1' WHERE `place`.`id` = $placeid";
                $conn->exec($sqlApprove);
                header('Location: admin_index.php');
            }
        }
        catch(Exception $e){
            $_SESSION['errorRole'] = $e->getMessage();
            header('Location: login.php');
        }
    }

    //admin disapprove place of user
    if (isset($_POST["disapprove"])) {
        try{
            if(!isset($_POST['adminId'])){
                throw new Exception("Only admin can approve user's post !!!");
            }
            else{
                $placeid = $_POST['placeId'];
                $sqlApprove = "UPDATE `place` SET `approve` = '0' WHERE `place`.`id` = $placeid";
                $conn->exec($sqlApprove);
                header('Location: admin_index.php');
            }
        }
        catch(Exception $e){
            $_SESSION['errorRole'] = $e->getMessage();
            header('Location: login.php');
        }
    }

    //user update name of place
    if (isset($_POST["save-title"])) {
      try {
        $name = $_POST["name"];
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `name` = '$name' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-title.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user update property type of place
    if (isset($_POST["save-property-type"])) {
      try {
        $property_type = $_POST["property_type"];
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `property_type` = '$property_type' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-property-type.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user update description & summary of place
    if (isset($_POST["save-info"])){
      try {
        $summary = $_POST["summary"];
        $description = $_POST["description"];
        $notes = $_POST["notes"];
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `summary` = '$summary', `description` = '$description', `notes` = '$notes' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-description-summary.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user update location of place
    if (isset($_POST["save-location"])){
      try {
        $latitude = (double)$_POST['latitude'];
        $longitude = (double)$_POST['longtitude'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $transit = $_POST['transit'];
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `street` = '$street', `city` = '$city', `state` = '$state', `latitude` = '$latitude', `longitude` = '$longitude', `transit` = '$transit' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-location.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user update amenities of place
    if (isset($_POST["save-amenities"])) {
      try {
        $amenitiesString = "";
        for($i = 0; $i < sizeof($amenitiesArr); $i++){
            if(isset($_POST["ch".$i])){
                $amenitiesString .= $_POST["ch".$i] . ", ";
            }
        }
        $amenitiesString = rtrim($amenitiesString, ', ');
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `amenities` = '$amenitiesString' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-amenities.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user update price of place
    if (isset($_POST["save-price"])) {
      try {
        $price = (int)$_POST["price"];
        $cleaning_fee = (int)$_POST["cleaning_fee"];
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `price` = '$price', `cleaning_fee` = '$cleaning_fee' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-price.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user update beds, bathrooms, bedrooms in place
    if (isset($_POST["save-beds"])) {
      try {
        $accommodates = (int)$_POST['accommodates'];
        $bathrooms = (int)$_POST['bathrooms'];
        $bedrooms = (int)$_POST['bedrooms'];
        $beds = (int)$_POST['beds'];
        $id = $_POST["place-id"];
        $sql = "UPDATE `place` SET `accommodates` = '$accommodates', `bathrooms` = '$bathrooms', `bedrooms` = '$bedrooms', `beds` = '$beds' WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home-edit-beds.php?id=$id");
        exit();
      } catch (\Exception $e) {

      }
    }

    //user delete place
    if (isset($_POST["delete-place"])) {
      try {
        $id = $_POST["place-id-delete"];
        $sql = "DELETE FROM `place` WHERE `place`.`id` = $id";
        $conn->exec($sql);
        header("Location: manage-home.php");
        exit();
      } catch (\Exception $e) {

      }
    }
?>
