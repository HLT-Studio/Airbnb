<?php
    include_once("DBconnect.php");
    if(isset($_POST["submit"])){
        $iduser = $_POST["iduser"];
        if($iduser == 0){
            header('Location: login.php');
            exit();
        }
        $idplace = $_POST["idplace"];
        $price = $_POST["price"];
        $guests = $_POST["guests"];
        $cleanningfee = $_POST["cleaningfee"];
        $chkIn = $_POST["checkIn"];
        $chkOut = $_POST["checkOut"];
        $date1=date_create($chkIn);
        $date2=date_create($chkOut);
        $dateReq = date("d/m/Y");
        $interval = $date1->diff($date2);
        $total = ($interval->days * $price) + $cleanningfee;

        $sql = "Select * from storage where userid = $iduser and placeid = $idplace";
        $getdata = $conn->query($sql);
        if($getdata->rowCount() == 0){
            $insert = "INSERT INTO `storage` (`id`, `userid`, `placeid`, `rentReq`, `favorite`, `chkIn`, `chkOut`, `guests`, `total`, `dateReq`, `paid`) VALUES (NULL, '$iduser', '$idplace', '1', '0', '$chkIn', '$chkOut', '$guests', '$total', '$dateReq', '0')";
            $conn->exec($insert);
            header("Location: detail.php?id=$idplace");
            exit();
        }
        else{
            foreach($getdata as $obj){
                if($obj["paid"] == 1){
                    $insert2 = "INSERT INTO `storage` (`id`, `userid`, `placeid`, `rentReq`, `favorite`, `chkIn`, `chkOut`, `guests`, `total`, `dateReq`, `paid`) VALUES (NULL, '$iduser', '$idplace', '1', '0', '$chkIn', '$chkOut', '$guests', '$total', '$dateReq', '0')";
                    $conn->exec($insert2);
                    header("Location: detail.php?id=$idplace");
                    exit();
                }
                else{
                    $id = $obj["id"];
                    $update = "UPDATE `storage` SET `chkIn` = '$chkIn', `chkOut` = '$chkOut', `guests` = '$guests', `total` = '$total', `dateReq` = '$dateReq' WHERE `storage`.`id` = $id";
                    $conn->exec($update);
                    header("Location: detail.php?id=$idplace");
                    exit();
                }
            }
        }
    }
    if(isset($_POST["ResponseRequest"])){
        $response = $_POST["response"];
        $hostid = $_POST["hostid"];
        $idstorage = $_POST["idstorage"];
        if($response == "accept"){
            $sqlupdate = "UPDATE `storage` SET `paid` = '1' WHERE `storage`.`id` = $idstorage";
            $conn->exec($sqlupdate);
            $_SESSION['user_id'] = $hostid;
            header("Location: PlaceList_waitResponse.php");
            exit();
        }
        else{
            $sqldel = "DELETE FROM `storage` WHERE `storage`.`id` = $idstorage";
            $conn->exec($sqldel);
            $_SESSION['user_id'] = $hostid;
            header("Location: PlaceList_waitResponse.php");
            exit();
        }
    }
?>