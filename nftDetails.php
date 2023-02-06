<!doctype html>
<html lang="en">
<head>
    <?php
    include_once 'header.php';

    if (!isset($_SESSION)) {
        $email = $_SESSION["email"];
    }

//    if(!isset($_GET ['nftID'])){
//        echo "<meta http-equiv=REFRESH CONTENT=0;url=".$_SERVER['DOCUMENT_ROOT']."/3334_Secruity_Project/NFTshowcase.php>";
//    }

    ?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/getNFTDetail.js"></script>
    <script src="js/VerifyEmailOfDetailPage.js"></script>
<!--    <script src="js/TestBuy.js"></script>-->
    <style>


        #item .item{
            font-family: "Courier New";*/

        }
        img{
            max-width: 75%;
            height: auto;
            vertical-align: middle;
        }

        #item-desc{
            margin: 5px;
            padding: 5px;
        }


    </style>
<!--    <script src="js/VerifyEmailOfDetailPage.js"></script>-->
    <title>Detail</title>
</head>

<body>
<section id='item' style="margin-top: 10%; background-color: whitesmoke;" >
    <!--left block to describle , include NFT image-->
    <div class="item">
        <div class='container'">
        <div class="row" >
            <div class="col-12 col-lg-5">
                <div class="item-info text-center">
                    <div class="spinner-border text-primary loader" id='loader' style="width: 5rem; height: 5rem; margin-top: 5rem;" role="status"></div>
                    <img src="" class="rounded" id="nftImage" alt="..." style="display:none;">
                </div>

            </div>
            <div class="col-12 col-lg-6" id="item-desc">
                <h2> Project name : <a id="nftCollection">Retrieving...</a> </h2>
                <h2> Code name : <a id="nftName">Retrieving...</a></h2>
                <h2 class="d-flex "> Price : <a id="nftPrice">Retrieving...</a> </h2>
                <h2>Description : <a id="nftDesc">Retrieving...</a></h2>

                <!--php 拎data 幾多錢 -->

                <!-- 連去wallet page-->

                <!--<button type="button" class="btn btn-warning btn-lg" >Buy Now</button>-->

                <!-- Modal -->

                <?php
                include_once ('dbConnection.php');

                if(!isset($_SESSION['email'])){
                    echo "<a class=\"btn btn-warning btn-lg\" id=\"redirectBtn\" href=\"login2.php\">Login to Buy This NFT</a>";
                } else {

                    $nftKey = $_GET['nftID'];

                    $conn = getConnection();
                    $stmt = "Select * from nft where nftKey = '$nftKey'";
                    $result = $conn->query($stmt);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $ownerID = $row['ownerID'];
                        }
                    }

                    $email = $_SESSION['email'];
                    $stmt = "Select * from users where email = '$email'";
                    $result = $conn->query($stmt);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $userID = $row['userID'];
                        }
                    }
                    if ($ownerID != $userID) {
                        echo "<button name=\"buybtn\" id=\"buybtn\" type=\"submit\" class=\"btn btn-warning btn-lg\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" value=\"Submit\">
                                  Buy Now
                              </button>";
                    } else {
                        echo "<a class=\"btn btn-warning btn-lg\" id=\"redirectBtn\" href=\"MyNFT.php\">You already owned this NFT, Click here to go to your profile.</a>";
                    }
                }
                ?>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Select Your Payment Method</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="btn-group-vertical">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="btnradio1"> Metamask </label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio2"> Coinbase </label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio3"> WalletConnect</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle2" id="SaveChange" onclick="buy()" data-bs-toggle="modal" data-bs-dismiss="modal">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="MessageBanner" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                <?php
                include_once ('dbConnection.php');
                include_once ("PHPMailer/MailService.php");
                include_once ("UUID.php");

                    $cookieUserEmail = $_SESSION['email'] ?? NULL;
                    $Useremail = $cookieUserEmail;
                    $price = "";
                    $balance = "";

                    extract($_POST);
                    $conn = getConnection();
                    $stmt = $conn->prepare("Select * from users where email = ?");
                    $stmt->bind_param("s", $Useremail);
                    $stmt->execute();
                    $rs = $stmt->get_result();
                    $rc = mysqli_fetch_assoc($rs);

                    $UserID = $rc['userID'] ?? NULL;
                    $Useremail = $rc['email'] ?? NULL;
                    $UserName = $rc['userName'] ?? NULL;
                    $balance = $rc['balance'] ?? NULL;

                    mysqli_free_result($rs);


                    $stmt = "Select * from nft where nftKey = '$nftKey'";
                    $result = $conn->query($stmt);

                     if ($result->num_rows > 0) {
                        // output data of each row
                         while($row = $result->fetch_assoc()) {
                             $ownerID = $row['ownerID'];
                             $price = $row['price'];
                         }
                     }

                    if ($balance < $price) {
                        $status = '0';
                        echo '<h5 class="modal-title" id="MessageBanner" >Message</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<h6 type="text" id="ConfirmMessage"> Not enough balance </h6>';
                        echo '</div>';
                        echo "<button name=\"ConfirmBtn\" id=\"ConfirmBtn\" type=\"submit\" class=\"btn btn-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" value=\"Submit\">
                                 Confirm
                              </button>";

                    } else if ($balance >= $price) {
                        $balance = $balance - $price;

                        $tradingID = UUID::v4();
                        $sellID = $ownerID;
                        $buyerID = $UserID;
                        $status = '1';
                        $tradingDate = date("Y-m-d h:i:s");
                        $price = $price;
                        $stmt = "INSERT INTO tradingrecord (tradingID, sellerID, buyerID, nftKey, status, tradeDate ,price) VALUES ('$tradingID', $sellID, $buyerID, '$nftKey', '$status', '$tradingDate', '$price')";
//                        $stmt->bind_param("isissss", $tradingID, $sellID, $buyerID, $nftkey, $status, $tradingDate, $price);
                        $conn->query($stmt);
                        //set parameters

                        $stmt = "UPDATE users SET balance = $balance WHERE userID = '$UserID'";
                        $conn->query($stmt);

                        $stmt = $conn->prepare("UPDATE nft SET ownerID = ? WHERE nftKey = ?");
                        $stmt->bind_param("ss", $UserID, $nftKey);
                        $stmt->execute();
                        $stmt->close();


                        echo '<h5 class="modal-title" id="MessageBanner" >Message</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<h6 type="text" id="ConfirmMessage"> Buy successful, you now own this NFT. </h6>';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo "<a class=\"btn btn-primary\" id=\"ConfirmBtn\" href=\"MyNFT.php\">Confirm</a>";

                    }
                    ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Right block of detail name and price-->

</section>
<footer class="text-muted py-5">
    <div class="container">
        <a class="float-end mb-1 btn btn-outline-primary" href="#">
            Back to top
        </a>
        <p class="mb-1"> &copy; PolyChain</p>
    </div>
</footer>


<script>
    getNFTDetail();
</script>

</body>
</html>