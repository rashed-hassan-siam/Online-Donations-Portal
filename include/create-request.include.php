<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=2) {
    header('Location: ../index.php');
}
$details = mysqli_real_escape_string($conn, $_POST['details']);
$target = $_POST['target'];
$ngo = $_SESSION['userName'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Request</title>
</head>

<body>
    <?php
    $insert = mysqli_query($conn, "INSERT INTO requests(details,target,raised,stype,status,time,ngo,notify) VALUES('$details','$target','0','0','pending',NOW(),'$ngo',NOW())");
    if ($insert) { ?>
    <script>
        alert('Request Submitted Successfully');
        location.replace('../ngo/pending-requests.ngo.php');
    </script>
    <?php }
    ?>
</body>

</html>