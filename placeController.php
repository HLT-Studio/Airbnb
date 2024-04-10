<?php
    include_once("DBconnect.php");
    session_start();
    $amenitiesArr = array("Wifi", "Kitchen", "Washer", "Air conditioning", "Heating", "TV", "Hair dryer", "Iron", "Pool", "Smoking allowed");

    //Admin insert place
    if(isset($_POST['insert'])){
        $host_id = $_SESSION['user_id'];
        $name = $_POST["name"];
        $summary = $_POST["summary"];
        $description = $_POST["description"];
        $notes = $_POST["notes"];
        $transit = $_POST["transit"];
        $xl_picture_url = $_POST["xl_picture_url"];
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
        $calendar_updated = "";
        $number_of_reviews = 0;
        $review_scores_rating = 0;
        $approve = 0;

        for($i=0; $i<sizeof($amenitiesArr); $i++){
            if(isset($_POST["ch".$i])){
                $amenities .= $_POST["ch".$i] . ", ";
            }
        }
        $amenities = rtrim($amenities, ', ');

        $sqltest = "INSERT INTO `place` (`id`, `name`, `summary`, `description`, `notes`, `transit`, `xl_picture_url`, `street`, `city`, `state`, `country`, `latitude`, `longitude`, `property_type`, `accommodates`, `bathrooms`, `bedrooms`, `beds`, `amenities`, `price`, `cleaning_fee`, `calendar_updated`, `number_of_reviews`, `review_scores_rating`, `host_id`, `approve`) VALUES
        (NULL, '$name', '$summary', '$description', '$notes', '$transit', '$xl_picture_url', '$street', '$city', '$state', '$country', '$latitude', '$longtitude', '$property_type', '$accommodates', '$bathrooms', '$bedrooms', '$beds', '$amenities', '$price', '$cleaning_fee', '$calendar_updated', '$number_of_reviews', '$review_scores_rating', '$host_id', '$approve')";

        $conn->exec($sqltest);
        header('Location: manage-home.php');
        exit();
    }
?>
