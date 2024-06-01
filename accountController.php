<?php
  session_start();
  include_once("DBconnect.php");

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  // use PHPMailer\PHPMailer\Exception;

  function sendMail($eemail, $rstoken){
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
      $mail->Subject = 'Password reset link from DEMO WEB';
      $mail->Body    = "We got a request from you to reset your password! <br>
       Click the link below: <br>
       <a href='http://localhost/airbnb/updateforgotpassword.php?email=$eemail&reset_token=$rstoken'>Reset password</a>
      ";
  
      $mail->send();
      return true;
  } catch (Exception $e) {
      return false;
  }
  }

  //Controller xử lý khi tạo tài khoản
  if(isset($_POST['register_btn']))
  {
    $fullname = $_POST['full_name_value'];
    $username = $_POST['username'];
    $email = $_POST['email_value'];
    $password = $_POST['password_value'];
    $phone = $_POST['phone'];

    //Tạo tài khoản
    try {
      $flag = true;
      $getAcc = "SELECT * FROM user";
      $lstuser = $conn->query($getAcc);
      foreach($lstuser as $us){
        if($us['username'] == $username || $us['email'] == $email){
          $flag = false;
        }
      }

      if($flag == true){
        $registerSQL = "INSERT INTO `user` (`id`, `username`, `password`, `name`, `phone`, `email`, `roleid`) VALUES (NULL, '$username', '$password', '$fullname', '$phone', '$email', '2')";
        $conn->exec($registerSQL);
        $_SESSION['status'] = "Sign Up Success";
        $_SESSION['alert'] = "alert-success";
        $usid = 0;
        $sql = "SELECT * FROM user";
        $users = $conn->query($sql);
        foreach($users as $ustemp){
          if($ustemp['email'] == $email){
            $usid = $ustemp['id'];
          }
        }

        $_SESSION['user_id'] = $usid;

        header('Location: index.php');
        exit();
      }
      else{
        throw new Exception("Email or Account existed !!!");
      }

      //Xử lý ngoại lệ nếu tài khoản đã được tạo rồi (trùng email)
    } catch (Exception $e)
    {
      $_SESSION['status'] = "This account already exists";
      header('Location: register.php');
      exit();
    }
  }


  //Controller xử lý đăng nhập
  if (isset($_POST['login_btn']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    try
    {

      try
      {
        $sql = "SELECT * FROM user";
        $users = $conn->query($sql);

        foreach ($users as $user) {
          if ($user['username'] == $username && $user['password'] == $password) {
            if($username == "admin"){
              $_SESSION['user_id'] = $user['id'];
              header('Location: admin_index.php');
              exit();
            }
            $_SESSION['user_id'] = $user['id'];

            header('Location: index.php');
            exit();
          } elseif ($user['username'] == $username && $user['password'] != $password) {
            $_SESSION['status'] = "Incorrect password";
            header('Location: login.php');
            exit();
          }
        }
      } catch (Exception $e)
      {

      }
    } catch (Exception $e) //Xử lý ngoại lệ tài khoản không tồn tại
    {
      $_SESSION['status'] = "Invalid Username";
      $_SESSION['alert'] = "alert-danger";
      header('Location: login.php');
      exit();
    }
  }

  //user edit full name
  if (isset($_POST['save-user-full-name'])) {

    $name = $_POST['name'];
    $id = $_SESSION['user_id'];

    try {
      $sql = "UPDATE `user` SET `name` = '$name' WHERE `user`.`id` = $id";
      $conn->exec($sql);
      header('Location: personal-info.php');
      exit();
    } catch (\Exception $e) {

    }
  }

  //user edit email
  if (isset($_POST['save-user-email'])) {

    $email = $_POST['email'];
    $id = $_SESSION['user_id'];

    try {
      $sql = "UPDATE `user` SET `email` = '$email' WHERE `user`.`id` = $id";
      $conn->exec($sql);
      header('Location: personal-info.php');
      exit();
    } catch (\Exception $e) {

    }
  }

  //user edit phone numbers
  if (isset($_POST['save-user-phone'])) {

    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    try {
      $sql = "UPDATE `user` SET `phone` = '$phone' WHERE `user`.`id` = $id";
      $conn->exec($sql);
      header('Location: personal-info.php');
      exit();
    } catch (\Exception $e) {

    }
  }


  //password's user change
  if(isset($_POST["change-user-password"])){
    $id = $_SESSION['user_id'];
    $curPass = $_POST["current-password"];

    try{
      $sql = "SELECT `password` FROM `user` WHERE `id` = $id";
      $temp = $conn->prepare($sql);
      $temp->execute();
      $getPass = $temp->fetchColumn();
      if($curPass == $getPass)
      {
        $newPass = $_POST["new-password"];
        $sqlforPass = "UPDATE `user` SET `password` = '$newPass' WHERE `user`.`id` = $id";
        $conn->exec($sqlforPass);
        $_SESSION['passChange_alert'] = "Update successfully";
        $_SESSION['text_color'] = "text-success";
        header('Location: account-security.php');
      }
      else{
        throw new Exception("Current password isn't correct !!!");
      }

    }
    catch(Exception $e){
      $_SESSION['passChange_alert'] = $e->getMessage();
      $_SESSION['text_color'] = "text-danger";
      header('Location: account-security.php');
    }
  }

  // forgot password
  if(isset($_POST["forgotpass"])){
    $emailtemp = $_POST["email"];
    $sqlfindmail = "SELECT * FROM `user` WHERE `email` = '$emailtemp'";
    try{
      $result = $conn->query($sqlfindmail);
      if($result->rowCount() > 0){
        $reset_token = bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/kolkata');
        $date=date("Y-m-d");
        $query = "UPDATE `user` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email` = '$emailtemp'";
        $conn->exec($query);
        sendMail($emailtemp, $reset_token);
        echo "<script> 
          alert('Password reset link sent to email');
          window.location.href='index.php';
        </script>";
      }
      else{
        throw new Exception("Invalid email !!!");
      }
    }
    catch(Exception $e){
      $_SESSION['email_alert'] = $e->getMessage();
      $_SESSION['colortext'] = "text-danger";
      header('Location: forgotpassword.php');
    }
  }

  if(isset($_POST["resetforgotpass"])){
    $passwordupdate = $_POST["password_value"];
    $emailResetPass = $_POST["email"];
    $updatepass = "UPDATE `user` SET `password`='$passwordupdate', `resettoken`=NULL,`resettokenexpire`=NULL WHERE email = '$emailResetPass'";
    $conn->exec($updatepass);
    echo "<script> 
    alert('Password update successfully !');
    window.location.href='login.php';
  </script>"; 
  }

?>
