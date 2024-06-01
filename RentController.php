<?php
    include_once("DBconnect.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
  // use PHPMailer\PHPMailer\Exception;

  function sendMail($eemail, $nameplace, $namehst, $mailhst, $phonehst, $datepur, $chkin, $chkout, $tt){
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'airbnbHLT@gmail.com';                     //SMTP username
      $mail->Password   = 'xehetooefkfbfrtn';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('airbnbHLT@gmail.com', 'DEMO WEB');
      $mail->addAddress($eemail);     //Add a recipient
     
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Purchase complete for '.$nameplace;
      $mail->Body    = "<h2>Thank you for your choose!</h2> <br>
       <h4>Place name: <span>$nameplace</span></h4>
       <h4>CheckIn: <span>$chkin</span> - CheckOut: <p>$chkout</p></h4>
       <h4>Hosted by: <span>$namehst</span> - Email: <p>$mailhst</p></h4>
       <h4>Host phone: <span>$phonehst</span></h4>
       <h4>Date purchase: <span>$datepur</span></h4>
       <h4>Total: <span>$tt$</span></h4>
       ";
  
      $mail->send();
      return true;
  } catch (Exception $e) {
      return false;
  }
  }



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

        $sql = "Select * from requestpayment where userid = $iduser and placeid = $idplace";
        $getdata = $conn->query($sql);
        if($getdata->rowCount() == 0){
            $insert = "INSERT INTO `requestpayment` (`id`, `userid`, `placeid`, `rentReq`, `chkIn`, `chkOut`, `guests`, `total`, `dateReq`, `paid`) VALUES (NULL, '$iduser', '$idplace', '1', '$chkIn', '$chkOut', '$guests', '$total', '$dateReq', '0')";
            $conn->exec($insert);
            header("Location: detail.php?id=$idplace");
            exit();
        }
        else{
            foreach($getdata as $obj){
                if($obj["paid"] == 1){
                    $insert2 = "INSERT INTO `requestpayment` (`id`, `userid`, `placeid`, `rentReq`, `chkIn`, `chkOut`, `guests`, `total`, `dateReq`, `paid`) VALUES (NULL, '$iduser', '$idplace', '1', '$chkIn', '$chkOut', '$guests', '$total', '$dateReq', '0')";
                    $conn->exec($insert2);
                    header("Location: detail.php?id=$idplace");
                    exit();
                }
                else{
                    $id = $obj["id"];
                    $update = "UPDATE `requestpayment` SET `chkIn` = '$chkIn', `chkOut` = '$chkOut', `guests` = '$guests', `total` = '$total', `dateReq` = '$dateReq' WHERE `requestpayment`.`id` = $id";
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
            $sqlupdate = "UPDATE `requestpayment` SET `paid` = '1' WHERE `requestpayment`.`id` = $idstorage";
            $conn->exec($sqlupdate);
            $sqlpayment = "Select * from `requestpayment` Where `requestpayment`.`id` = $idstorage";
            $result = $conn->query($sqlpayment);
            foreach($result as $obj){
                $userRentid = $obj['userid'];
                $placeid = $obj['placeid'];
                $totalprice = $obj['placeid'];
                $chkin = $obj['chkIn'];
                $chkout = $obj['chkOut'];
            }
            
            $sqlfinduserent = "Select * from `user` Where `user`.`id` = $userRentid";
            $usersql = $conn->query($sqlfinduserent);
            $sqlfindplace = "Select * from `place` Where `place`.`id` = $placeid";
            $placesql = $conn->query($sqlfindplace);
            $sqlfindhost = "Select * from `user` Where `user`.`id` = $hostid";
            $hostsql = $conn->query($sqlfindhost);
            
            foreach($usersql as $obj){
                $userRentEmail = $obj['email'];
            }
            foreach($placesql as $obj){
                $placename = $obj['name'];
            }
            foreach($hostsql as $obj){
                $hostname = $obj['name'];
                $hostemail = $obj['email'];
                $hostphone = $obj['phone'];
            }
            $datePurchase = date("d/m/Y");
            sendMail($userRentEmail, $placename, $hostname, $hostemail, $hostphone, $datePurchase, $chkin, $chkout, $totalprice);
            $_SESSION['user_id'] = $hostid;
            header("Location: PlaceList_waitResponse.php");
            exit();
        }
        else{
            $sqldel = "DELETE FROM `requestpayment` WHERE `requestpayment`.`id` = $idstorage";
            $conn->exec($sqldel);
            $_SESSION['user_id'] = $hostid;
            header("Location: PlaceList_waitResponse.php");
            exit();
        }
    }
?>
