<?php
  session_start();
  include 'firebaseConfig.php';
  include_once("DBconnect.php");


  //Controller xử lý khi tạo tài khoản
  if(isset($_POST['register_btn']))
  {
    $fullname = $_POST['full_name_value'];
    $email = $_POST['email_value'];
    $password = $_POST['password_value'];

    //Tạo tài khoản
    try {
      $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'password' => $password,
        'displayName' => $fullname,
      ];

      $createdUser = $auth->createUser($userProperties);

      $_SESSION['status'] = "Sign Up Success";
      $_SESSION['alert'] = "alert-success";
      header('Location: register.php');
      exit();
      //Xử lý ngoại lệ nếu tài khoản đã được tạo rồi (trùng email)
    } catch (\Kreait\Firebase\Exception\Auth\EmailExists $e)
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

  //Controller xử lý chỉnh sửa thông tin tài khoản
  if (isset($_POST['save_user_info_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    try {
      $sql = "UPDATE `user` SET `name` = '$name', `phone` = '$phone' WHERE `user`.`id` = $id";
      header('Location: account.php');
      exit();
    } catch (\Exception $e) {

    }

  }
?>
