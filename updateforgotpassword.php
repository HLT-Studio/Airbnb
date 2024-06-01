<?php 
    session_start(); 
    include_once("DBconnect.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <nav class="navbar sticky-top bg-white">
      <div class="container pt-2">
        <a class="navbar-brand" href="index.php">
          <img src="Assets/airbnb.png" style="width: 100%; max-width: 100px; height: auto">
        </a>
      </div>
    </nav>
    <hr style="border: 1px solid black"/>
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
              
              <?php
                if(isset($_GET["email"]) && isset($_GET["reset_token"])){
                    $email = $_GET["email"];
                    $resettoken = $_GET["reset_token"];
                    date_default_timezone_set('Asia/kolkata');
                    $date=date("Y-m-d");
                    $query = "SELECT * FROM `user` WHERE email = '$email' and resettoken = '$resettoken' and resettokenexpire = '$date'";
                    $result = $conn->query($query);
                    if($result->rowCount() > 0){
              ?> 
              <form class="mx-1 mx-md-4" action="accountController.php" method="post">
                  <input type="hidden" value="<?= $email ?>" name="email"> 
              <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-lock fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-floating flex-fill mb-0">
                    <input type="password" id="password_value" name="password_value" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute bottom-0 end-0 me-3 mb-3" id="togglePassword" style="cursor: pointer !important;"></i>
                    <label class="form-label" for="password_value">Password</label>
                  </div>
                </div>
                <p id="passvld" class="ps-5 text-danger"></p>

                <div class="d-flex flex-row align-items-center">
                  <i class="fas fa-key fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-floating flex-fill mb-0">
                    <input type="password" id="repassword_value" name="repassword_value" class="form-control" required>
                    <i class="bi bi-eye-slash position-absolute bottom-0 end-0 me-3 mb-3" id="toggleRePassword" style="cursor: pointer !important;"></i>
                    <label class="form-label" for="repassword_value">Repeat your password</label>
                  </div>
                </div>
                <p id="repassvld" class="ps-5 text-danger"></p>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="resetforgotpass" id="resetforgotpass" class="btn btn-primary btn-lg">Update password</button>
                    </div>
            
                </form>
                 <?php }
                else{
                    echo "<script> 
                        alert('Invalid or Expire link');
                        window.location.href='index.php';
                        </script>";   
                }
                }
                ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
    document.getElementById("passvld").hidden = true;
    document.getElementById("repassvld").hidden = true;

    const togglePassword = document.querySelector('#togglePassword');
    const toggleRePassword = document.querySelector('#toggleRePassword');

    const password = document.querySelector('#password_value');
    const repassword = document.querySelector('#repassword_value');

    togglePassword.addEventListener('click', () => {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      if (type == 'password') {
        document.getElementById("togglePassword").className = "bi bi-eye-slash position-absolute bottom-0 end-0 me-3 mb-3";
      } else {
        document.getElementById("togglePassword").className = "bi bi-eye position-absolute bottom-0 end-0 me-3 mb-3";
      }
    });

    toggleRePassword.addEventListener('click', () => {
      const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
      repassword.setAttribute('type', type);
      if (type == 'password') {
        document.getElementById("toggleRePassword").className = "bi bi-eye-slash position-absolute bottom-0 end-0 me-3 mb-3";
      } else {
        document.getElementById("toggleRePassword").className = "bi bi-eye position-absolute bottom-0 end-0 me-3 mb-3";
      }
    });

    document.getElementById("resetforgotpass").addEventListener('click', (e) => {
      document.getElementById("passvld").hidden = true;
      document.getElementById("repassvld").hidden = true;
        if(!validPass() || !validRepass())
        {
            e.preventDefault();
        }
    });


function validPass(){
    var regPass = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{10,}$/;
    var pass =  document.getElementById("password_value").value;
    if(!regPass.test(pass)){
        document.getElementById("passvld").hidden = false;
        document.getElementById("passvld").innerHTML = "*Tối thiểu 10 ký tự, phải có ký tự hoa, ký tự số và ký tự đặt biệt.";
        return false;
    }
    return true;
}
function validRepass(){
    var repass =  document.getElementById("repassword_value").value;
    var pass =  document.getElementById("password_value").value;
    if(repass != pass){
        document.getElementById("repassvld").hidden = false;
        document.getElementById("repassvld").innerHTML = "*Mật khẩu không trùng khớp.";
        return false;
    }
    return true;
}

</script>
