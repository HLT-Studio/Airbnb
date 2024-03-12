<?php
  session_start();
  include 'firebaseConfig.php';

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
    $email = $_POST['email'];
    $clearTextPassword = $_POST['password'];

    try
    {
      $user = $auth->getUserByEmail("$email");
      try
      {
        $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
        $idTokenString = $signInResult->idToken();
        try
        {
          $verifiedIdToken = $auth->verifyIdToken($idTokenString);
          $uid = $verifiedIdToken->claims()->get('sub');

          $_SESSION['user_id'] = $uid;
          $_SESSION['idTokenString'] = $idTokenString;

          header('Location: index.php');
          exit();

        } catch (FailedToVerifyToken $e)
        {
          echo 'The token is invalid: '.$e->getMessage();
        }
      } catch (Exception $e) //Xử lý ngoại lệ sai mật khẩu
      {
        $_SESSION['status'] = "Incorrect password";
        $_SESSION['alert'] = "alert-danger";
        header('Location: login.php');
        exit();
      }
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) //Xử lý ngoại lệ tài khoản không tồn tại
    {
      $_SESSION['status'] = "Invalid Email";
      $_SESSION['alert'] = "alert-danger";
      header('Location: login.php');
      exit();
    }
  }

?>
