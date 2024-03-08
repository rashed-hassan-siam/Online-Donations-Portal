<?php
session_start();
include_once '../config/connection.config.php';
if (isset($_SESSION['userType']) && $_SESSION['userType']!=NULL) {
    header('Location: ../index.php');
}
$username = strtolower(trim($_POST['username']));
$email = trim($_POST['email']);
$password = $_POST['password'];
$type = $_POST['role'];
if ($type=='2') {
    $role = 'ngo';
} elseif ($type=='3') {
    $role = 'donor';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>
    <?php
        if (strlen($password)<6) { ?>
    <script>
        alert('Password cannot be less than 6 characters!');
        location.replace('../signup.php');
    </script>
    <?php } else { ?>
    <?php
    $select = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($select)) { ?>
    <script>
        alert('Username Already Exists!');
        location.replace('../signup.php');
    </script>
    <?php } else {
        $insert = mysqli_query($conn, "INSERT INTO users(username,email,password,type,role) VALUES('$username','$email','$password','$type','$role')");
    ?>
    <script>
        alert('Account Created Successfully!');
        location.replace('../login.php');
    </script>
    <?php }
    ?>
    <?php } ?>
</body>

</html>