<?php
session_start();
include_once 'config/connection.config.php';
if (!isset($_SESSION['userId']) || $_SESSION['userId']==NULL) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <title>Requests</title>
</head>

<body>
    <a id="top"></a>
    <div class="main">
        <div class="header">
            <a href="index.php">
                <button class="title">
                    <div class="logo-div">
                        <img class="logo" src="images/logo.png" alt="NHO" />
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
            <a href="login.php">
                <button class="logbtn">
                    <h3>Login</h3>
                </button>
            </a>
            <a href="signup.php">
                <button class="logbtn">
                    <h3>Sign Up</h3>
                </button>
            </a>
            <?php } else { ?>
            <!-- as logged in -->

            <a href="include/logout.include.php">
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
            <a href="password.php"><button class="navbtn">
                    <h3>Set/Change Password</h3>
                </button></a>
            <!-- for all (logged in) -->
            <a href="transactions.php"><button class="navbtn">
                    <h3>Transactions</h3>
                </button></a>
            <!-- for all (logged in) -->
            <a href="requests.php"><button class="navbtn">
                    <h3>Requests</h3>
                </button></a>
            <?php }
            if (isset($_SESSION['userType']) && $_SESSION['userType']==1) { ?>
            <!-- for admin -->
            <a href="admin/pending-requests.admin.php"><button class="navbtn">
                    <h3>Pending Requests</h3>
                </button></a>
            <!-- for admin -->
            <a href="admin/add-admin.admin.php"><button class="navbtn">
                    <h3>Add New Admin</h3>
                </button></a>
            <!-- for admin -->
            <a href="admin/ngo-moderation.admin.php"><button class="navbtn">
                    <h3>NGO Moderation</h3>
                </button></a>
            <?php } elseif (isset($_SESSION['userType']) && $_SESSION['userType']==2) { ?>
            <!-- for NGO -->
            <a href="ngo/create-request.ngo.php"><button class="navbtn">
                    <h3>Create a Request</h3>
                </button></a>
            <!-- for NGO -->
            <a href="ngo/accepted-requests.ngo.php"><button class="navbtn">
                    <h3>Accepted Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="ngo/pending-requests.ngo.php"><button class="navbtn">
                    <h3>Pending Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="ngo/rejected-requests.ngo.php"><button class="navbtn">
                    <h3>Rejected Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="ngo/notifications.ngo.php"><button class="navbtn">
                    <h3>Notifications</h3>
                </button></a>
            <?php } ?>
            <!-- for all -->
            <a href="tos.php"><button class="navbtn">
                    <h3>Terms of Services</h3>
                </button></a>
            <!-- for all -->
            <a href="privacy-policy.php"><button class="navbtn">
                    <h3>Privacy Policy</h3>
                </button></a>
            <!-- for all -->
            <a href="about-us.php"><button class="navbtn">
                    <h3>About Us</h3>
                </button></a>
        </div>

        <div class="content">
            <div class="card">
                <?php
                if (isset($_SESSION['userPass']) && $_SESSION['userPass']=='none' && $_SESSION['userType']==1) { ?>
                <h2 class="warning">You did not set any proper password yet. Your account is vulnerable!</h2>
                <a href="password.php"><button class="pagebtn">Set Password</button></a>
                <?php } elseif (isset($_SESSION['userApproval']) && $_SESSION['userType']==2 && $_SESSION['userApproval']==0) { ?>
                <h2 class="warning">Before you can access all of the features,<br>You have to submit your organization
                    documents first for our moderation.</h2>
                <a href="ngo/add-documents.ngo.php"><button class="pagebtn">Add Documents</button></a>
                <?php } elseif (isset($_SESSION['userApproval']) && $_SESSION['userType']==2 && $_SESSION['userApproval']==1) { ?>
                <h2 class="warning">Your organization documents are received.<br>Please wait until the moderation
                    completes.</h2>
                <?php } elseif (isset($_SESSION['userApproval']) && $_SESSION['userType']==2 && $_SESSION['userApproval']==3) { ?>
                <h2 class="warning">Your organization documents have failed to prove your authenticity.<br>You are
                    currently blocked from accessing all the features.</h2>
                <h2 class="warning">If you think it was a mistake, you can resubmit your documents again.</h2>
                <a href="ngo/add-documents.ngo.php"><button class="pagebtn">Add Documents</button></a>
                <?php } else { ?>
                <?php
                $select = mysqli_query($conn, "SELECT * FROM requests WHERE stype='1' ORDER BY time DESC");
                if (!mysqli_num_rows($select)) { ?>
                <h2>No request available</h2>
                <?php } else { ?>
                <h1>Requests</h1>
                <table class="list">
                    <tr>
                        <th>Serial No.</th>
                        <th>Details</th>
                        <th>Target (USD)</th>
                        <th>Raised (USD)</th>
                        <th>More Needed (USD)</th>
                        <th>Last Modified</th>
                        <th>NGO Member</th>
                        <?php
                            if (isset($_SESSION['userType']) && $_SESSION['userType']==1) { ?>
                        <th>Accepted By</th>
                        <?php } elseif (isset($_SESSION['userType']) && $_SESSION['userType']==3) { ?>
                        <th>Operations</th>
                        <?php }
                            ?>
                    </tr>
                    <?php
                    $i=1;
                        while ($result = mysqli_fetch_assoc($select)) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['details']; ?></td>
                        <td><?php echo $result['target']; ?></td>
                        <td><?php echo $result['raised']; ?></td>
                        <td><?php echo $result['target']-$result['raised']; ?></td>
                        <td><?php echo $result['time']; ?></td>
                        <td><?php echo $result['ngo']; ?></td>
                        <?php
                            if (isset($_SESSION['userType']) && $_SESSION['userType']==1) { ?>
                        <td><?php echo $result['admin']; ?></td>
                        <?php } elseif (isset($_SESSION['userType']) && $_SESSION['userType']==3) { ?>
                        <td><a href="donor/donate.donor.php?id=<?php echo $result['id']; ?>"><button
                                    class="pagebtn tblbtn">Donate</button></a></td>
                        <?php }
                        $i++;
                            ?>
                    </tr>
                    <?php    } ?>
                </table>
                <?php }
                ?>
                <?php } ?>
            </div>
        </div>

        <div id="show-top" class="top">
            <a href="#top">
                <img src="images/up.jpg" alt="Go to Top" title="Go to Top" /></a>
        </div>

        <div class="footer">
            <h3>&copy; <?php echo date('Y');?>, New Hope Organization, Inc.</h3>
        </div>
    </div>
    <script src="scripts/show-top.js"></script>
</body>

</html>