<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=1) {
    header('Location: ../index.php');
}
$id = $_GET['id'];
$admin = $_SESSION['userName'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Request</title>
</head>

<body>
    <?php
    $update = mysqli_query($conn, "UPDATE requests SET stype='1',status='accepted',admin='$admin' WHERE id='$id'");
    if ($update) { ?>
    <script>
        alert('Request Accepted Successfully!');
        location.replace('../admin/pending-requests.admin.php');
    </script>
    <?php }
    ?>
</body>

</html>