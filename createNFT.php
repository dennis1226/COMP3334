<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolyChain | Create Your Own NFTs</title>

    <link href="css/createNFT.css" rel="stylesheet">
    <?php
    include_once 'header.php';
    // redirect to login page if the user is not logged in
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
    }
    ?>
    <script src="js/uploadNFTs.js"></script>
    <script src="js/otpModalChecker.js"></script>
</head>

<body>
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Create New NFT</h1>
                <h1 class="lead text-muted">
                    Only Images with format: jpg, jpeg and png are allowed.
                </h1>
                <a type="button" class="btn btn-outline-primary w-90" id="startBtn"
                   href="#createNFTOuterWrapper">Start</a>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light createNFTOuterWrapper" id="createNFTOuterWrapper">
        <div class="container-fluid" id="alertBanner" style="display: none">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="alert alert-warning d-flex" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                             aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <div id="alertText"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 cardWrapper justify-content-center"
                 id="uploadWrapper">
                <div class="col-xs-8 justify-content-center">
                    <h3 class="text-center fw-light imageInputHeader" id="imageInputHeader">Select Image</h3>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="nftFile" name="nftFile"
                               accept=".jpeg, .png, .jpg" required>
                    </div>

                    <h3 class="text-center fw-light priceInputHeader formHeader" id="priceInputHeader">Input NFT
                        Price</h3>
                    <div class="mb-3">
                        <input class="form-control" type="number" id="nftPrice" name="nftPrice"
                               placeholder="Input NFT Price Here." min="0" required>
                    </div>

                    <h3 class="text-center fw-light descInputHeader formHeader" id="descInputHeader">Input NFT
                        Description</h3>
                    <div class="mb-3">
                        <textarea class="form-control" id="nftDesc" rows="3" maxlength="250"
                                  placeholder="Input Description Here" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-primary w-100 submitBtn" id="submitBtn">Submit
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="otpModal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Two Step Verification</h5>
            </div>
            <div class="modal-body">
                <div class="otpWrapper">
                    <div class="row">
                        <h5 class="col text-center">We had sent an OTP to your email, please enter it below.</h5>
                    </div>
                    <br>
                    <div class="row otpContainer" id="otpContainer">
                        <div class="col"></div>
                        <div class="col">
                            <input type="number" class="form-control otpInput text-center" id="otp1" tabindex="1"
                                   pattern="\d*" maxlength="1" min="0" max="9">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control otpInput text-center" id="otp2" tabindex="2"
                                   pattern="\d*" maxlength="1" min="0" max="9">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control otpInput text-center" id="otp3" tabindex="3"
                                   pattern="\d*" maxlength="1" min="0" max="9">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control otpInput text-center" id="otp4" tabindex="4"
                                   pattern="\d*" maxlength="1" min="0" max="9">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control otpInput text-center" id="otp5" tabindex="5"
                                   pattern="\d*" maxlength="1" min="0" max="9">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control otpInput text-center" id="otp6" tabindex="6"
                                   pattern="\d*" maxlength="1" min="0" max="9">
                        </div>
                        <div class="col"></div>
                    </div>
                    <br>
                    <div class="row status"><h6 class="col text-center" id="modalStatus"></h6></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary col" id="mdDismiss" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary col" id="submitOTP">Verify</button>
            </div>
        </div>
    </div>
</div>

<footer class="text-muted py-5">
    <div class="container">
        <a class="float-end mb-1 btn btn-outline-primary" href="#">
            Back to top
        </a>
        <p class="mb-1"> &copy; PolyChain</p>
    </div>
</footer>
</body>
</html>
