<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>PolyChain | MyNFTs</title>

    <!-- JQuery and custom JS -->
    <script type="text/javascript" src="jslib/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="jslib/jquery.cookie.js"></script>
    <script type="text/javascript" src="jslib/jquery.blockUI.js"></script>
    <script type="text/javascript" src="jslib/jquery.table2excel.js"></script>
    <script type="text/javascript" src="personalData.js"></script>

    <!-- Main CSS-->
    <?php include_once 'header.php'; ?>
    <link href="personalData.css" rel="stylesheet" media="all">
</head>


<?php
include_once ("dbConnection.php");

$cookieUserEmail = $_SESSION['email'] ?? NULL;
$UserID = "";
$useremail = "";
$UserName = "";

extract($_POST);
$conn= getConnection();
//$sql ="Select * from users where email = '$cookieUserEmail'";
$stmt = $conn->prepare("Select * from users where email = ?");
$stmt->bind_param("s", $mails);
$mails = $cookieUserEmail;
$stmt->execute();
$rs = $stmt->get_result();
$rc = mysqli_fetch_assoc($rs);

$UserID = $rc['userID'] ?? NULL;
$useremail = $rc['email'] ?? NULL;
$UserName = $rc['userName'] ?? NULL;

mysqli_free_result($rs);

if(isset($_POST['Update'])){
    $stmt = $conn->prepare("UPDATE users SET userID=?, email=?, password=?, userName=? WHERE email=?");
    $stmt->bind_param("sssss", $ID, $mail, $pass, $name, $mails);
    // set parameters and execute
    $ID = $UserID;
    $mail = $useremail;
    $name = $UserName;
    $mails = $cookieUserEmail;

    //Check Password Rex
    $valid = true;
    $passwordss = $userPassword;
    $uppercase = preg_match('#[A-Z]#', $passwordss);
    $lowercase = preg_match('#[a-z]#', $passwordss);
    $number = preg_match('#[0-9]#', $passwordss);
    $special = preg_match('#[\W]#', $passwordss);
    if (!$uppercase || !$lowercase || !$number || !$special || strlen($passwordss) < 8 || strlen($passwordss) >16 ) {
        $valid = false;
    }
    if ($valid) {
        $pass= password_hash($passwordss,PASSWORD_DEFAULT);
        $name = $UserName;
        $mails = $cookieUserEmail;
        $stmt->execute();
        $stmt->close();
        echo '<script type ="text/JavaScript">';
        echo 'alert("successful")';
        echo '</script>';
        header("Location: phpFunctions/oauth2SingOut.php");
    } else {
        echo "<script> alert('Please set the password according to the password regulations:\\nat least one major\\nat least 8 characters\\nat least one symbol ')</script>";
    }
}
?>

<body>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link active dropdown-item" href="personalData.php">
                            <i class="fa-solid fa-user sidebarIcon"></i>
                            MyProfile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-item" aria-current="page" href="MyNFT.php">
                            <i class="fa-solid fa-book sidebarIcon"></i>
                            MyNFT
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
            <div class="wrapper wrapper--w960 infoWrapper">
                <div class="card card-5">
                    <div class="card-heading">
                        <h2 class="title">Personal Information</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-row">
                                <div class="name">UserID</div>
                                <div class="value">
                                    <div class="row row-space">
                                        <input id="UserID" class="input--style-5" type="text" name="UserID" readonly="readonly" value="<?php echo $UserID; ?>" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">User Name</div>
                                <div class="value">
                                    <div class="row row-space">
                                        <input id="UserName" class="input--style-5" type="text" name="UserName" readonly="readonly" value="<?php echo $UserName; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Email</div>
                                <div class="value">
                                    <div class="row row-space">
                                        <input id="useremail" class="input--style-5" type="email" name="useremail" readonly="readonly" value="<?php echo $useremail; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-b-55">
                                <div class="name">Password</div>
                                <div class="value">
                                    <div class="row row-space">

                                            <div class="row row-space">
                                                <input id="userPassword" class="input--style-5" type="text" name="userPassword">
                                            </div>

                                    </div>

                                </div>
                                <div style="color: red; padding-left: 15%" >If you want to change your password, please remember your password carefully</div>
                            </div>

                            <div>
                                <button class="btn btn--radius-2 btn--red" type="submit" name="Update" id="Update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</div>

    <!-- Main JS-->
    <script src="personalData.js"></script>

</body>

</html>