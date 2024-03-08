<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=2) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/style.css" />
    <title>Add Documents</title>
</head>

<body>
    <a id="top"></a>
    <div class="main">
        <div class="header">
            <a href="../index.php">
                <button class="title">
                    <div class="logo-div">
                        <img class="logo" src="../images/logo.png" alt="NHO" />
                    </div>
                    <div class="heading-div">
                        <h1 class="heading">New Hope Organization</h1>
                    </div>
                </button>
            </a>
        </div>

        <div class="log">
            <!-- as logged out -->
            <?php
        if (!isset($_SESSION['userId']) || $_SESSION['userId']==NULL) { ?>
            <a href="../login.php">
                <button class="logbtn">
                    <h3>Login</h3>
                </button>
            </a>
            <a href="../signup.php">
                <button class="logbtn">
                    <h3>Sign Up</h3>
                </button>
            </a>
            <?php } else { ?>
            <!-- as logged in -->

            <a href="../include/logout.include.php">
                <button class="logbtn">
                    <h3>Logout</h3>
                </button>
            </a>
            <?php }
        ?>

        </div>

        <div class="navigation">
            <?php
            if (isset($_SESSION['userId']) && $_SESSION['userId']!=NULL) { ?>
            <!-- for all (logged in) -->
            <a href="../password.php"><button class="navbtn">
                    <h3>Set/Change Password</h3>
                </button></a>
            <!-- for all (logged in) -->
            <a href="../transactions.php"><button class="navbtn">
                    <h3>Transactions</h3>
                </button></a>
            <!-- for all (logged in) -->
            <a href="../requests.php"><button class="navbtn">
                    <h3>Requests</h3>
                </button></a>
            <?php }
            if (isset($_SESSION['userType']) && $_SESSION['userType']==1) { ?>
            <!-- for admin -->
            <a href="../admin/pending-requests.admin.php"><button class="navbtn">
                    <h3>Pending Requests</h3>
                </button></a>
            <!-- for admin -->
            <a href="../admin/add-admin.admin.php"><button class="navbtn">
                    <h3>Add New Admin</h3>
                </button></a>
            <?php } elseif (isset($_SESSION['userType']) && $_SESSION['userType']==2) { ?>
            <!-- for NGO -->
            <a href="create-request.ngo.php"><button class="navbtn">
                    <h3>Create a Request</h3>
                </button></a>
            <!-- for NGO -->
            <a href="accepted-requests.ngo.php"><button class="navbtn">
                    <h3>Accepted Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="pending-requests.ngo.php"><button class="navbtn">
                    <h3>Pending Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="rejected-requests.ngo.php"><button class="navbtn">
                    <h3>Rejected Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="notifications.ngo.php"><button class="navbtn">
                    <h3>Notifications</h3>
                </button></a>
            <?php } ?>
            <!-- for all -->
            <a href="../tos.php"><button class="navbtn">
                    <h3>Terms of Services</h3>
                </button></a>
            <!-- for all -->
            <a href="../privacy-policy.php"><button class="navbtn">
                    <h3>Privacy Policy</h3>
                </button></a>
            <!-- for all -->
            <a href="../about-us.php"><button class="navbtn">
                    <h3>About Us</h3>
                </button></a>
        </div>

        <div class="content">
            <div class="card">
                <?php
                if (isset($_SESSION['userPass']) && $_SESSION['userPass']=='none' && $_SESSION['userType']==1) { ?>
                <h2 class="warning">You did not set any proper password yet. Your account is vulnerable!</h2>
                <a href="../password.php"><button class="pagebtn">Set Password</button></a>
                <?php } elseif (isset($_SESSION['userApproval']) && $_SESSION['userType']==2 && $_SESSION['userApproval']==1) { ?>
                <script>
                    alert('Your documents are under moderation!');
                    location.replace('../index.php');
                </script>
                <?php } elseif (isset($_SESSION['userApproval']) && $_SESSION['userType']==2 && $_SESSION['userApproval']==2) { ?>
                <script>
                    alert('Your documents are already approved!');
                    location.replace('../index.php');
                </script>
                <?php } else { ?>
                <h1>Add Documents</h1>
                <h5 class="warning">Please enter these necessary information so that we can verify your
                    authenticity.</h5>
                <form action="../include/add-documents.include.php" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td><label class="label" for="name">Your Full Name</label></td>
                            <td><input class="box" type="text" name="name" id="name"
                                    placeholder="Enter your full name here..." required></td>
                        </tr>
                        <tr>
                            <td><label class="label" for="phone">Your Phone Number</label></td>
                            <td><input class="box" type="text" name="phone" id="phone"
                                    placeholder="Enter your phone number here..." required></td>
                        </tr>
                        <tr>
                            <td><label class="label" for="orgname">NGO Name</label></td>
                            <td><input class="box" type="text" name="orgname" id="orgname"
                                    placeholder="Enter NGO name here..." required></td>
                        </tr>
                        <tr>
                            <td><label class="label" for="orgphone">NGO Phone Number</label></td>
                            <td><input class="box" type="text" name="orgphone" id="orgphone"
                                    placeholder="Enter NGO phone number here..." required></td>
                        </tr>
                        <tr>
                            <td><label class="label" for="document">Attested Document From NGO<br>(PDF
                                    only)</label></td>
                            <td><input type="file" accept=".pdf" name="document" id="document" required></td>
                        </tr>
                    </table>
                    <button class="pagebtn" type="submit">Submit</button>
                </form>
                <?php }
                    ?>
            </div>
        </div>

        <div id="show-top" class="top">
            <a href="#top">
                <img src="../images/up.jpg" alt="Go to Top" title="Go to Top" /></a>
        </div>

        <div class="footer">
            <h3>&copy; <?php echo date('Y');?>, New Hope Organization, Inc.</h3>
        </div>
    </div>
    <script src="../scripts/show-top.js"></script>
</body>

</html>