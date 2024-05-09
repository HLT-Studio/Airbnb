<?php
    if(isset($_POST["showResult"])){
        $pricemaxi = $_POST["MaximumPrice"];
        $pricemini = $_POST["MinimumPrice"];
        $bedrooms = $_POST["bedrooms"];
        $bathrooms = $_POST["bathromms"];
        $beds = $_POST["beds"];
        $ame = "";
        if($pricemaxi == "" || $pricemini == ""){
            $pricemini = "price";
            $pricemaxi = "price";
        }
        if($bedrooms == "Any"){
            $bedrooms = "bedrooms";
        }
        if($bathrooms == "Any"){
            $bathrooms = "bathrooms";
        }
        if($beds == "Any"){
            $beds = "beds";
        }
        for($i=0; $i<sizeof($amenities); $i++){
            if(isset($_POST["ch".$i])){
                $ame .= $_POST["ch".$i] . ", ";
            }  
        }
        $ame = rtrim($ame, ', ');
    $sql = "SELECT * FROM `place` WHERE price <= $pricemaxi and price >= $pricemini and bedrooms >= $bedrooms and beds >= $beds and bathrooms >= $bathrooms and amenities LIKE '%$ame%' and `approve` = 1";
    }
    else{
        $sql = "SELECT * FROM `place` WHERE `approve` = 1;";
    }
?>