function getNFTDetail() {
    const urlParams = new URLSearchParams(window.location.search);
    const data = new URLSearchParams();
    const nftID= urlParams.get('nftID');
    data.append('nftID', nftID);

    fetch('phpFunctions/queryNFTs.php', {
            method: 'POST',
            body: data
    }).then(response => response.text()).then( response=>{
            console.log(response);
            //  do whatever is suppose to do here
            let json = JSON.parse(response);
            let nftName,nftPrice, nftCollection, nftDescription;

            // Put the json's element into variables
            nftName = json[0].nftName;
            nftCollection = json[0].nftCollection;
            nftPrice = json[0].nftPrice;
            nftDescription = json[0].nftDescription;

            getImageByID(nftID);

            document.getElementById("nftName").innerText = nftName;
            document.getElementById("nftPrice").innerText = nftPrice + " ETH";
            document.getElementById("nftCollection").innerText = nftCollection;
            document.getElementById("nftDesc").innerText = nftDescription;
    }).catch(error => {
            console.log(error);
    });
}

function getImageByID(nftID) {
    let loader = document.getElementById("loader");
    let image = document.getElementById("nftImage");
    const searchParams = new URLSearchParams();
    searchParams.append('nftID', nftID);

    // fetch only the image from the database
    fetch('phpFunctions/queryImage.php', {
        method: 'POST',
        body: searchParams
    }).then(response => response.text()).then(response => {
        // append the image to the card
        document.getElementById("nftImage").src = `data:image/png;base64,${response}`;
        loader.style.display = "none";
        image.style.display = "block";
    }).catch(error => console.log(error));
}

