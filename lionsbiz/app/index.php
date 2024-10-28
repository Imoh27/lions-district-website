<?php
include "includes/config.php";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = "SELECT * FROM tbladmin WHERE username = '$username'";
    // echo $select; exit;  
    $sth = $con->query($select);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if (empty($result)) {
        echo "<script> 
        alert('Record not found')
        history.back()
        </script>";
    }else {
       session_start();
       $_SESSION['admin'] =  $result['username'];
       header('location: manage-members?admin='.$_SESSION['admin']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lions District 404A2 -- Business Networking Forum</title>
    
    <!-- Favicon -->
    <link href="../img/lions-logo.png" rel="icon">
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="logincss.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="POST">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="username" id="username" name="username" require>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" require>

        <button type="submit" name="login">Log In</button>
        
    </form>
</body>
</html>
