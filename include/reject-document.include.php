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
    <title>Reject Document</title>
</head>

<body>
    <?php
    $select = mysqli_query($conn, "SELECT * FROM documents WHERE id='$id'");
    if (mysqli_num_rows($select)) {
        $result = mysqli_fetch_assoc($select);
        $ngo = $result['ngo'];
    }
    $delete = mysqli_query($conn, "DELETE FROM documents WHERE id='$id'");
    $update = mysqli_query($conn, "UPDATE users SET approval='3' WHERE username='$ngo' AND type='2'");
    if ($delete && $update) { ?>
    <script>
        alert('Document Rejected Successfully!');
        location.replace('../admin/ngo-moderation.admin.php');
    </script>
    <?php }
    ?>
</body>

</html>