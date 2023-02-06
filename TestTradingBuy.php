<!doctype html>
<html lang="en">
<head>
    <?php
    include_once 'header.php';

    if (!isset($_SESSION)) {
        $email = $_SESSION["email"];
    }
    ?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/getNFTDetail.js"></script>
    <script src="js/VerifyEmailOfDetailPage.js"></script>
    <!--    <link rel="stylesheet" href="nftDetail.css">-->
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
    <script src="js/VerifyEmailOfDetailPage.js"></script>
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
                    <img src="src/NFTs/TestImage01.png" class="rounded" alt="...">

                </div>

            </div>
            <div class="col-12 col-lg-6" id="item-desc">
                <h2> Project name : <a id="nftCollection"></a> </h2>
                <h2> Code name : <a id="nftName"></a></h2>
                <h2 class="d-flex ">
                    Price : <a id="nftPrice"></a>
                    <!--php 拎data 幾多錢 -->
                </h2>
                <!-- 連去wallet page-->

                <!--<button type="button" class="btn btn-warning btn-lg" >Buy Now</button>-->

                <!-- Modal -->
                <h2>Desc : <a id="nftDesc"></a></h2>

                <?php
                if(!isset($_SESSION['email'])){
                    echo "<a class=\"btn btn-warning btn-lg\" id=\"redirectBtn\" href=\"login2.php\">Login to Buy this NFT Now</a>";
                } else {
                    echo "<button name=\"buybtn\" id=\"buybtn\" type=\"submit\" class=\"btn btn-warning btn-lg\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" value=\"Submit\">
                                  Buy
                              </button>";
                }
                ?>

                <h6 id="showMessage"></h6>>

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