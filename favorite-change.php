<?php
    if($iduser == 0){
        header('Location: login.php');
        exit();
    }
    else{
        $sqltmp = "Select * from storage where userid = $iduser AND placeid = $id";
        $rslt = $conn->query($sqltmp);
        if($rslt->rowCount() == 0){
            $sqlinsert = "INSERT INTO `storage` (`id`, `userid`, `placeid`, `favorite`, `paid`) VALUES (NULL, '$iduser', '$id', '1', '')";
            $conn->exec($sqlinsert);
        }
        else{
            foreach($rslt as $tmp){
                if($tmp['favorite'] == 0){
                    $idstorage = $tmp['id'];
                    $sqledit = "UPDATE `storage` SET `favorite` = '1' WHERE `storage`.`id` = $idstorage";
                    $conn->exec($sqledit);
                }
                else{
                    $idstorage = $tmp['id'];
                    $sqledit = "UPDATE `storage` SET `favorite` = '0' WHERE `storage`.`id` = $idstorage";
                    $conn->exec($sqledit);
                }
            }
        }
    }
?>