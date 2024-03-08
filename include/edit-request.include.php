<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=2) {
    header('Location: ../index.php');
}
$id = $_POST['id'];
$details = mysqli_real_escape_string($conn, $_POST['details']);
$target = $_POST['target'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Request</title>
</head>

<body>
    <?php
    $update = mysqli_query($conn, "UPDATE requests SET details='$details',target='$target',stype='0',status='pending',time=NOW() WHERE id='$id'");
    if ($update) { ?>
    <script>
        alert('Request Updated Successfully!');
        location.replace('../ngo/pending-requests.ngo.php');
    </script>
    <?php }
    ?>
</body>

</html>