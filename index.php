<?php
session_start();
include_once 'config/connection.config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <title>New Hope Organization</title>
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
                if (isset($_SESSION['userType']) && $_SESSION['userType']==1) { ?>
                <h1>Greetings, <?php echo $_SESSION['userName']; ?>.</h1>
                <h1>Admin Panel</h1>
                <b>
                    <p class="paragraph">Admin Instructions:</p>
                    <ul class="paragraph">
                        <li><span class="warning">If you were added as an admin by another previous admin, you must go
                                to
                                the "Set/Change Password" page to set your password first.</span> You can change your
                            password again through the same page later.</li>
                        <li>You can see all of the past transactions through the "Transactions" page.</li>
                        <li>You can see all of the accepted NGO requests in the "Requests" page.</li>
                        <li>You can see all of the NGO requests that are waiting to be accepted or rejected in the
                            "Pending Requests" page.</li>
                        <li>You can add a new admin in the "Add New Admin" page. Please note, you cannot set the
                            password for the new admin for privacy issues. For the first time, the new admin must login
                            with their username only, keeping the password field blank. After logging in, they must set
                            their password as soon as possible.</li>
                        <li>You can check and verify NGO member documents in the "NGO Moderation" page.</li>
                        <li>You can read our terms of services in the "Terms of Services" page.</li>
                        <li>You can read our privacy policies in the "Privacy Policy" page.</li>
                        <li>You can learn about the creators of this application in the "About Us" page.</li>
                    </ul>
                </b>
                <?php } elseif (isset($_SESSION['userType']) && $_SESSION['userType']==2) { ?>
                <h1>Greetings, <?php echo $_SESSION['userName']; ?>.</h1>
                <h1>NGO Member Panel</h1>
                <b>
                    <p class="paragraph">NGO Member Instructions:</p>
                    <ul class="paragraph">
                        <li>You can change your
                            password through the "Set/Change Password" page.</li>
                        <li>You can see only your past transactions through the "Transactions" page.</li>
                        <li>You can see all of the accepted NGO requests in the "Requests" page.</li>
                        <li>You can create a request for donation in the "Create a Request" page.</li>
                        <li>You can see all of your requests that were accepted by admins in the "Accepted Requests"
                            page.</li>
                        <li>You can see all of your requests that are waiting to be accepted or rejected in the
                            "Pending Requests" page.</li>
                        <li>You can see all of your rejected requests in the "Rejected Requests" page.</li>
                        <li>You can see the notifications of your completed requests in the "Notifications" page.</li>
                        <li>You can read our terms of services in the "Terms of Services" page.</li>
                        <li>You can read our privacy policies in the "Privacy Policy" page.</li>
                        <li>You can learn about the creators of this application in the "About Us" page.</li>
                    </ul>
                </b>

                <?php } elseif (isset($_SESSION['userType']) && $_SESSION['userType']==3) { ?>
                <h1>Greetings, <?php echo $_SESSION['userName']; ?>.</h1>
                <h1>Donor Panel</h1>
                <b>
                    <p class="paragraph">Donor Instructions:</p>
                    <ul class="paragraph">
                        <li>You can change your
                            password through the "Set/Change Password" page.</li>
                        <li>You can see only your past transactions through the "Transactions" page.</li>
                        <li>You can see all of the accepted NGO requests in the "Requests" page. You can also go to the
                            Donation Panel of a specific request from that page.</li>
                        <li>You can read our terms of services in the "Terms of Services" page.</li>
                        <li>You can read our privacy policies in the "Privacy Policy" page.</li>
                        <li>You can learn about the creators of this application in the "About Us" page.</li>
                    </ul>
                </b>

                <?php } else { ?>
                <h1>Welcome to the New Hope Organization!</h1>
                <table>
                    <tr>
                        <td><img src="images/food.jpg" alt="Food" /></td>
                        <td>
                            <h2>
                                <p class="paragraph">A huge amount of poor people around the globe cannot get
                                    adequate amount of food. Your donation may be a big step to
                                    mitigate their hunger.</p>

                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>
                                <p class="paragraph">People in third world countries are deprived of their basic
                                    demands. A lot of people die in winter due to lack of blankets
                                    and clothes. Your donation may help those poor people in need.</p>

                            </h2>
                        </td>
                        <td><img src="images/clothes.jpg" alt="Clothes" /></td>
                    </tr>
                    <tr>
                        <td><img src="images/home.jpg" alt="Home" /></td>
                        <td>
                            <h2>
                                <p class="paragraph">People in many countries are homeless. They don't have any
                                    place where they can sleep peacefully, let alone live. We help
                                    them by making houses to live in, only with the help of your
                                    donations.</p>

                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>
                                <p class="paragraph">Using your donations, we are continuously helping many
                                    countries to build schools, colleges and special schools for
                                    children to ensure their proper educational rights.</p>

                            </h2>
                        </td>
                        <td><img src="images/education.jpg" alt="Education" /></td>
                    </tr>
                    <tr>
                        <td><img src="images/treatment.jpg" alt="Treatment" /></td>
                        <td>
                            <h2>
                                <p class="paragraph">Every year a lot of people die due to lack of tratement
                                    because they don't have the money to visit a doctor. We use
                                    your donations to help building hospitals and clinics for the
                                    poor people, where medical treatment is provided free of
                                    charge.</p>

                            </h2>
                        </td>
                    </tr>
                </table>
                <?php }
                ?>
                <?php }
                ?>
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