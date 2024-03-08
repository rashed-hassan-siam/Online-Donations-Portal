<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=3) {
    header('Location: ../index.php');
}
$id = $_POST['id'];
$ngo = $_POST['ngo'];
$method = $_POST['method'];
$amount = $_POST['amount'];
$donor = $_SESSION['userName'];
if ($method=='bkash' || $method=='nagad') {
    $amount = $amount * 0.012;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Panel</title>
</head>

<body>
    <?php
    $insert = mysqli_query($conn, "INSERT INTO transactions(request,amount,donor,ngo,method,time) VALUES('$id','$amount','$donor','$ngo','$method',NOW())");
    if ($insert) {
        $select = mysqli_query($conn, "SELECT * FROM requests WHERE id='$id'");
        if (mysqli_num_rows($select)) {
            $result = mysqli_fetch_assoc($select);
            $raised = $result['raised'];
            $target = $result['target'];
        }
        $raised = $raised + $amount;
        if ($raised>=$target) {
            $stype = '3';
            $status = 'completed';
        } else {
            $stype = '1';
            $status = 'accepted';
        }
        $update = mysqli_query($conn, "UPDATE requests SET raised='$raised',stype='$stype',status='$status',notify=NOW() WHERE id='$id'");
        if ($update) { ?>
    <script>
        alert('Donation Successful!');
        location.replace('../requests.php');
    </script>
    <?php    }
    }
    ?>
</body>

</html>