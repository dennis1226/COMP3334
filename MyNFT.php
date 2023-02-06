<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>PolyChain MyNFT</title>

    <script type="text/javascript" src="jslib/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="jslib/jquery.cookie.js"></script>
    <script type="text/javascript" src="jslib/jquery.blockUI.js"></script>
    <script type="text/javascript" src="jslib/jquery.table2excel.js"></script>
    <script src="js/MyNFT.js"></script>
    <script src="js/getNFTs.js"></script>

    <!-- Main CSS-->
    <?php include_once 'header.php'; ?>
    <link href="MyNFT.css" rel="stylesheet" media="all">
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-item" href="personalData.php">
                            <i class="fa-solid fa-user sidebarIcon"></i>
                            MyProfile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link active dropdown-item" aria-current="page" href="MyNFT.php">
                            <i class="fa-solid fa-book sidebarIcon"></i>
                            MyNFT
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto w-100 h-100 justify-content-center">
            <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
                <div class="wrapper wrapper--w960">
                    <div class="card card-5" id="MyNftshow">
                        <div class="card-heading">
                            <h2 class="title">My Owned NFTs</h2>
                        </div>

                        <div class="album py-5 bg-light nftOuterWrapper" style="display: none" id="nftOuterWrapper">
                            <div class="container">
                                <h1 class="text-center fw-light collectionHeader" id="collectionHead"></h1>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 cardWrapper" id="cardWrapper">
                                    <div class="col nftCard" id="nftCard0">
                                        <div class="card shadow-sm">
                                            <img src="src/NFTs/TestImage01.png" id="nftImage" width="100%" height="100%" alt="nftImage">
                                            <div class="card-body">
                                                <p class="card-text">
                                                    <div class="collectionName text-center">
                                                        <a id="nftName"></a> <br><br> By <a href="" id="author"></a>
                                                    </div>
                                                    <br>
                                                    <div class="collectionDescription text-center" id="nftDesc"></div>
                                                </p>
                                                <div class="viewButton">
                                                    <a type="button" class="btn btn-outline-secondary viewBtn w-100" id='viewBtn' href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="loadingWrapper d-flex justify-content-center" id="loadingWrapper" style="display: block">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 mx-auto">
                                    <div class="spinner-border text-primary" id="spinner" style="width: 5rem; height: 5rem;" role="status"></div>
                                    <h1 class="fw-light loadingText d-flex justify-content-center" id="loadingText">Loading...</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<script>
    showMyNFTs();
</script>

</body>