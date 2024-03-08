<?php
session_start();
include_once '../config/connection.config.php';
if (isset($_SESSION['userType']) && $_SESSION['userType']!=NULL) {
    header('Location: ../index.php');
}
$username = strtolower(trim($_POST['username']));
$password = trim($_POST['password']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
</head>

<body>
    <?php
    $select = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($select)) {
        $result = mysqli_fetch_assoc($select);
        $_SESSION['userId'] = $result['id'];
        $_SESSION['userName'] = $result['username'];
        $_SESSION['userEmail'] = $result['email'];
        $_SESSION['userPass'] = $result['password'];
        $_SESSION['userType'] = $result['type'];
        $_SESSION['userRole'] = $result['role'];
        $_SESSION['userApproval'] = $result['approval'];
        if ($_SESSION['userPass']==$password || $_SESSION['userPass']=='none') { ?>
    <script>
        location.replace('../index.php');
    </script>
    <?php } else {
        session_destroy();
    ?>
    <script>
        alert('Incorrect Credentials!');
        location.replace('../login.php');
    </script>
    <?php }
    ?>
    <?php } else { ?>
    <script>
        alert('Incorrect Credentials!');
        location.replace('../login.php');
    </script>
    <?php 
    }
    ?>

</body>

</html>