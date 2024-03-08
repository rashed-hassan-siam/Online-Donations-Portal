<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=1) {
    header('Location: ../index.php');
}
$username = strtolower(trim($_POST['username']));
$email = trim($_POST['email']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
</head>

<body>
    <?php
    $insert = mysqli_query($conn, "INSERT INTO users(username,email,password,type,role) VALUES('$username','$email','none','1','admin')");
    if ($insert) { ?>
    <script>
        alert('Admin added successfully!');
        location.replace('../index.php');
    </script>
    <?php }
    ?>
</body>

</html>