<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=2) {
    header('Location: ../index.php');
}
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
</head>

<body>
    <?php
    $update = mysqli_query($conn, "UPDATE requests SET stype='4',status='withdrawn' WHERE id='$id'");
    if ($update) { ?>
    <script>
        alert('Donation Withdraw Successful!');
        location.replace('../ngo/notifications.ngo.php');
    </script>
    <?php }
    ?>
</body>

</html>