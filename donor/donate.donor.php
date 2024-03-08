<?php
session_start();
include_once '../config/connection.config.php';
if (!isset($_SESSION['userType']) || $_SESSION['userType']!=3) {
    header('Location: ../index.php');
}
$id = $_GET['id'];
$select = mysqli_query($conn, "SELECT * FROM requests WHERE id='$id'");
if (mysqli_num_rows($select)) {
    $result = mysqli_fetch_assoc($select);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/style.css" />
    <title>Donation Panel</title>
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
            <a href="../ngo/create-request.ngo.php"><button class="navbtn">
                    <h3>Create a Request</h3>
                </button></a>
            <!-- for NGO -->
            <a href="../ngo/accepted-requests.ngo.php"><button class="navbtn">
                    <h3>Accepted Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="../ngo/pending-requests.ngo.php"><button class="navbtn">
                    <h3>Pending Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="../ngo/rejected-requests.ngo.php"><button class="navbtn">
                    <h3>Rejected Requests</h3>
                </button></a>
            <!-- for NGO -->
            <a href="../ngo/notifications.ngo.php"><button class="navbtn">
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
            <h3>Firstly, create your account in any of these services if you haven't already</h3>
            <div class="services">
                <div class="service-div">
                    <a target="_blank" href="https://www.bkash.com/new_account">
                        <img class="logo service" src="../images/bkash.png" title="Bkash" alt="Bkash" />
                    </a>
                </div>
                <div></div>
                <div class="service-div">
                    <a target="_blank" href="https://nagad.com.bd/en/offer/mobile-to-fintech-2/">
                        <img class="logo service" src="../images/nagad.png" title="Nagad" alt="Nagad" />
                    </a>
                </div>
                <div></div>
                <div class="service-div">
                    <a target="_blank" href="https://www.paypal.com/us/signin">
                        <img class="logo service" src="../images/paypal.png" title="Paypal" alt="Paypal" />
                    </a>
                </div>
                <div></div>
                <div class="service-div">
                    <a target="_blank" href="https://www.westernunion.com/br/en/login.html">
                        <img class="logo service" src="../images/westernunion.jpg" title="Western Union"
                            alt="Western Union" />
                    </a>
                </div>
            </div>
            <div class="card">
                <h1>Donation Panel</h1>
                <?php
                if (isset($_SESSION['userPass']) && $_SESSION['userPass']=='none') { ?>
                <h2 class="warning">You did not set any password yet. Your account is vulnerable!</h2>
                <a href="../password.php"><button class="pagebtn">Set Password</button></a>
                <?php }
                ?>
                <h5 class="warning">Note: If you are using "Bkash" or "Nagad" as your donation method, please enter the
                    donation amount in BDT currency, otherwise use USD currency.</h5>
                <table class="list">
                    <tr>
                        <th>Request Details</th>
                        <th>Target (USD)</th>
                        <th>Raised (USD)</th>
                        <th>More Needed (USD)</th>
                        <th>Last Modified</th>
                        <th>NGO Member</th>
                    </tr>
                    <tr>
                        <td><?php echo $result['details']; ?></td>
                        <td><?php echo $result['target']; ?></td>
                        <td><?php echo $result['raised']; ?></td>
                        <td><?php echo $result['target']-$result['raised']; ?></td>
                        <td><?php echo $result['time']; ?></td>
                        <td><?php echo $result['ngo']; ?></td>
                    </tr>
                </table>
                <form action="../include/donate.include.php" method="POST">
                    <table>
                        <tr>
                            <td><label class="label" for="method" id="method">Donation Method</label></td>
                            <td>
                                <input type="radio" name="method" id="bkash" value="bkash" required>
                                <label class="label" for="bkash">Bkash</label>
                                <input type="radio" name="method" id="nagad" value="nagad" required>
                                <label class="label" for="nagad">Nagad</label>
                                <input type="radio" name="method" id="paypal" value="paypal" required>
                                <label class="label" for="paypal">Paypal</label>
                                <input type="radio" name="method" id="western-union" value="western-union" required>
                                <label class="label" for="western-union">Western Union</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label" for="amount" id="amount">Donation Amount</label>
                            </td>
                            <td><input class="box" type="number" name="amount" min="1"
                                    placeholder="Enter donation amount here..." required>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                    <input type="hidden" name="ngo" value="<?php echo $result['ngo']; ?>">
                    <button class="pagebtn" type="submit">Confirm</button>
                </form>
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