<?php
    session_start();
    include_once("DBconnect.php");
    if(isset($_SESSION['user_id'])){
        $tmp = $conn->prepare("Select roleid from user where id = ".$_SESSION['user_id']);
        $tmp->execute();
        $roleid = $tmp->fetchColumn();
        if($roleid != 1){
            header('Location: login.php');
        }
    }
    else{
        header('Location: login.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place wait to approve</title>
    <link rel="icon" type="image/svg+xml" sizes="any" href="assets/airbnb-1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<form action="placeController.php" method="post">
    <input type="hidden" name="adminId" value="<?php echo $_SESSION['user_id'] ?>">
    <input type="hidden" name="placeId" value="<?php echo $_GET["id"] ?>">
    <button name="approve" class="btn btn-success" type="submit">Approve</button>
</form>
</body>
</html>
