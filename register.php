<?php session_start(); ?>
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

              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

              <form class="mx-1 mx-md-4" action="accountController.php" method="post">

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-floating flex-fill mb-0">
                    <input type="text" id="full_name_value" name="full_name_value" class="form-control" required>
                    <label class="form-label" for="full_name_value">Your Name</label>
                    <span id="namevld" class="text-danger"></span>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-floating flex-fill mb-0">
                    <input type="text" id="username" name="username" class="form-control" required>
                    <label class="form-label" for="username">User name</label>
                    <span id="usernamevld" class="text-danger"></span>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                <i class="fa fa-phone fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-floating flex-fill mb-0">
                    <input type="number" id="phone" name="phone" class="form-control" minlength="10" maxlength="10" required>
                    <label class="form-label" for="phone">Phone number</label>
                    <span id="phonevld" class="text-danger"></span>
                  </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-envelope fa-lg me-3 mb-4 fa-fw"></i>
                  <div class="form-floating flex-fill mb-0">
                    <input type="email" id="email_value" name="email_value" class="form-control" required>
                    <label class="form-label" for="email_value">Your Email</label>
                    <span id="emailvld" class="text-danger"></span>
                  </div>
                </div>

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

                <div class="form-check d-flex justify-content-center mt-4 mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required>
                  <label class="form-check-label" for="form2Example3">
                    I agree all statements in <a href="#">Terms of service</a>
                  </label>
                </div>

                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button type="submit" name="register_btn" id="register_btn" class="btn btn-primary btn-lg">Sign up</button>
                </div>

              </form>

              <?php if (isset($_SESSION['status'])): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mt-2" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                  </svg>
                  <div class="ms-2">
                    <?= $_SESSION['status'] ?>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['status']); ?>
              <?php endif; ?>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2 pb-2">
              <img src="Assets/bg-register.jpeg" width="100%" height="100%" style="object-fit: cover;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
    document.getElementById("namevld").hidden = true;
    document.getElementById("usernamevld").hidden = true;
    document.getElementById("emailvld").hidden = true;
    document.getElementById("passvld").hidden = true;
    document.getElementById("repassvld").hidden = true;
    document.getElementById("phonevld").hidden = true;

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

    document.getElementById("register_btn").addEventListener('click', (e) => {
      document.getElementById("namevld").hidden = true;
      document.getElementById("usernamevld").hidden = true;
      document.getElementById("emailvld").hidden = true;
      document.getElementById("passvld").hidden = true;
      document.getElementById("repassvld").hidden = true;
      document.getElementById("phonevld").hidden = true;
        if(!validName() || !validEmail() || !validPass() || !validRepass() || !validPhone() || !validUserName())
        {
            e.preventDefault();
        }
    });

function validUserName() {
    var name = document.getElementById("username").value;
    var regName = /^[a-zA-Z0-9]+$/;
    if(name.length < 10)
    {
        document.getElementById("usernamevld").hidden = false;
        document.getElementById("usernamevld").innerHTML = "*Tối thiểu 10 ký tự";
        return false;
    }
    if(!regName.test(name))
    {
        document.getElementById("usernamevld").hidden = false;
        document.getElementById("usernamevld").innerHTML = "*Không chứa ký tự đặc biệt.";
        return false;
    }
    return true;
}

function validName() {
    var name = document.getElementById("full_name_value").value;
    var regName = /^[a-zA-Z_ÀÁÂÃÈÉÊẾÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêếìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\ ]+$/;
    if(!regName.test(name))
    {
        document.getElementById("namevld").hidden = false;
        document.getElementById("namevld").innerHTML = "*Không chứa ký tự đặc biệt.";
        return false;
    }
    return true;
}
function validEmail(){
    var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var email =  document.getElementById("email_value").value;
    if(!regEmail.test(email)){
        document.getElementById("emailvld").hidden = false;
        document.getElementById("emailvld").innerHTML = "*Email không đúng định dạng.";
        return false;
    }
    return true;
}
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
function validPhone(){
    var regPhone = /^[0-9]{10}$/;
    var phone =  document.getElementById("phone").value;
    if(!regPhone.test(phone)){
        document.getElementById("phonevld").hidden = false;
        document.getElementById("phonevld").innerHTML = "*Số điện thoại là 10 ký số.";
        return false;
    }
    return true;
}
</script>
