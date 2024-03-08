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
    <title>Approve Document</title>
</head>

<body>
    <?php
    $select = mysqli_query($conn, "SELECT * FROM documents WHERE id='$id'");
    if (mysqli_num_rows($select)) {
        $result = mysqli_fetch_assoc($select);
        $ngo = $result['ngo'];
    }
    $update = mysqli_query($conn, "UPDATE documents SET approval='1' WHERE id='$id'");
    $update2 = mysqli_query($conn, "UPDATE users SET approval='2' WHERE username='$ngo' AND type='2'");
    if ($update && $update2) { ?>
    <script>
        alert('Document Approved Successfully!');
        location.replace('../admin/ngo-moderation.admin.php');
    </script>
    <?php }
    ?>
</body>

</html>