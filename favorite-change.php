<?php
    if($iduser == 0){
        header('Location: login.php');
        exit();
    }
    else {
        $sqltmp = "SELECT * FROM `favouritelst` WHERE `userid` = $iduser AND `placeid` = $id;";
        $rslt = $conn->query($sqltmp);
        if($rslt->rowCount() == 0){
            $sqlinsert = "INSERT INTO `favouritelst` (`id`, `userid`, `placeid`, `favourite`) VALUES (NULL, '$iduser', '$id', '1')";
            $conn->exec($sqlinsert);
            header("Location: detail.php?id=$id");
            exit();
        }
        else {
          $sqldrop = "DELETE FROM `favouritelst` WHERE `favouritelst`.`userid` = $iduser AND `favouritelst`.`placeid` = $id;";
          $conn->exec($sqldrop);
          header("Location: detail.php?id=$id");
          exit();
        }
    }
?>
