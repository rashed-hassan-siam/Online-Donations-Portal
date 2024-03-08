<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userId']) || $_SESSION['userId']==NULL) {
    header('Location: ../index.php');
}
$old = $_POST['old-pass'];
$new = $_POST['new-pass'];
$id = $_SESSION['userId'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set/Change Password</title>
</head>

<body>
    <?php
        if (strlen($new)<6) { ?>
    <script>
        alert('Password cannot be less than 6 characters!');
        location.replace('../password.php');
    </script>
    <?php } elseif ($_SESSION['userPass']=='none' || $_SESSION['userPass']==$old) {
        $update = mysqli_query($conn, "UPDATE users SET password='$new' WHERE id='$id'");
        $_SESSION['userPass'] = $new;
    ?>
    <script>
        alert('Password Changed Successfully!');
        location.replace('../index.php');
    </script>
    <?php } else { ?>
    <script>
        alert('Incorrect Old Password!');
        location.replace('../password.php');
    </script>
    <?php } 
    ?>
</body>

</html>