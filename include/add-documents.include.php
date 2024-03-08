<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=2) {
    header('Location: ../index.php');
}
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$orgname = trim($_POST['orgname']);
$orgphone = trim($_POST['orgphone']);
$ngo = $_SESSION['userName'];
$pdfname = $_FILES['document']['name'];
$pdftemp = $_FILES['document']['tmp_name'];
$part = explode('.', $pdfname);
$pdfext = strtolower(end($part));
$destination = "../documents/".$ngo.".".$pdfext;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Documents</title>
</head>

<body>
    <?php
    if ($pdfext != 'pdf') { ?>
    <script>
        alert('Only PDF documents are allowed!');
        location.replace('../ngo/add-documents.ngo.php');
    </script>
    <?php } else {
        move_uploaded_file($pdftemp, $destination);
        $insert = mysqli_query($conn, "INSERT INTO documents(document,name,phone,orgname,orgphone,ngo) VALUES('$destination','$name','$phone','$orgname','$orgphone','$ngo')");
        $update = mysqli_query($conn, "UPDATE users SET approval='1' WHERE username='$ngo'");
        $_SESSION['userApproval'] = 1;
        if ($insert && $update) { ?>
    <script>
        alert('Documents Submitted Successfully');
        location.replace('../ngo/add-documents.ngo.php');
    </script>
    <?php }
        
    }
        ?>
</body>

</html>