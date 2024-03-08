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
    <title>Delete Request</title>
</head>

<body>
    <?php
    $delete = mysqli_query($conn, "DELETE FROM requests WHERE id='$id'");
    if ($delete) { ?>
    <script>
        alert('Request Deleted Successfully!');
        location.replace('../ngo/pending-requests.ngo.php');
    </script>
    <?php }
    ?>
</body>

</html>