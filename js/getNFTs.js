let imgCount = 0;

function getNFTs() {
    let card = document.getElementById('nftCard0');
    let wrapper = document.getElementById('cardWrapper');
    let loader = document.getElementById('loadingWrapper');
    let outerWrapper = document.getElementById('nftOuterWrapper');
    let allNftBtn = document.getElementById('allBtn');
    let cardClone = card.cloneNode(true);
    let collectionHead = document.getElementById('collectionHead');

    card.setAttribute('style', 'display: none');

    // Get the NFTs from the database
    fetch('phpFunctions/queryNFTs.php', {
        method: 'POST'
    }).then(response => response.text()).then(response => {
        console.log(response);
        // Parse the response
        let json = JSON.parse(response);
        let nftName, nftID, nftDesc, nftImage, nftAuthor, nftCollection;

        if (Object.keys(json).length === 0) {
            collectionHead.innerText = 'Oops, there\'s no NFTs available at the moment, please check back later.';
            loader.remove();
            allNftBtn.innerText = 'No NFTs Available';
            outerWrapper.setAttribute('style', 'display: block');
        } else {
            for (let i in json) {
                // Prevent the old card from being overwritten by the new one
                // Don't ask me why this works, I don't know
                if (i > 0) {
                    let j = i - 1;
                    card = document.getElementById(`nftCard${j}`);
                    cardClone = card.cloneNode(true);
                }

                // Put the json's element into variables
                nftName = json[i].nftName;
                nftID = json[i].nftID;
                nftDesc = json[i].nftDescription;
                nftAuthor = json[i].nftAuthor;
                nftCollection = json[i].nftCollection;

                // append the image to the card independently
                getImageByID(json[i].nftID, cardClone, json.length);

                // Append the NFT card to the cardWrapper
                cardClone.setAttribute('id', 'nftCard' + i);
                cardClone.setAttribute('style', 'display: block');
                cardClone.querySelector('#nftName').innerText = nftName;
                cardClone.querySelector('#author').innerText = nftAuthor;
                cardClone.querySelector('#nftDesc').innerText = nftDesc;

                cardClone.querySelector('#viewBtn').href = `nftDetails.php?nftID=${nftID}`;
                wrapper.appendChild(cardClone);

                // if (parseInt(i) === json.length - 1) {
                //     loader.remove();
                //     allNftBtn.classList.remove('disabled');
                //     allNftBtn.innerText = 'View All NFTs';
                //     outerWrapper.setAttribute('style', 'display: block');
                // }
            }
        }
    }).catch(error => console.log(error));
}

function getImageByID(nftID, cardClone, totalImageCount) {
    let loader = document.getElementById('loadingWrapper');
    let outerWrapper = document.getElementById('nftOuterWrapper');
    let allNftBtn = document.getElementById('allBtn');
    const searchParams = new URLSearchParams();
    searchParams.append('nftID', nftID);

    // fetch only the image from the database
    fetch('phpFunctions/queryImage.php', {
        method: 'POST',
        body: searchParams
    }).then(response => response.text()).then(response => {
        // append the image to the card
        cardClone.querySelector('#nftImage').src = `data:image/png;base64,${response}`;

        // increment the image count
        imgCount++;

        // if the image count is equal to the total image count, remove the loader and enable the view all button
        if (imgCount === totalImageCount) {
            loader.remove();
            allNftBtn.classList.remove('disabled');
            allNftBtn.innerText = 'View All NFTs';
            outerWrapper.setAttribute('style', 'display: block');
        }
    }).catch(error => console.log(error));
}