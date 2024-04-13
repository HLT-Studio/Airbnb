<?php
  session_start();
  include_once("DBconnect.php");


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
      $_SESSION['alert'] = "alert-danger";
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
            $_SESSION['alert'] = "alert-danger";
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

?>
