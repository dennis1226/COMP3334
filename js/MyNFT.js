function showMyNFTs() {
    let card = document.getElementById('nftCard0');
    let wrapper = document.getElementById('cardWrapper');
    let loader = document.getElementById('loadingWrapper');
    let outerWrapper = document.getElementById('nftOuterWrapper');
    let allNftBtn = document.getElementById('allBtn');
    let cardClone = card.cloneNode(true);
    let collectionHead = document.getElementById('collectionHead');
    let spinner = document.getElementById('spinner');
    let loadingText = document.getElementById('loadingText');
    card.setAttribute('style', 'display: none');

    fetch('phpFunctions/queryNFTs.php', {
        method: 'POST',
    }).then(response => response.text()).then(response => {
        // Parse the response
        console.log(response);
        let json = JSON.parse(response);
        let nftName, nftDesc, nftID, nftAuthor, nftCollection;

        if (Object.keys(json).length === 0) {
            spinner.remove();
            loadingText.style.fontSize = '1.5rem';
            loadingText.classList.add('w-100');
            loadingText.classList.add('text-center');
            loadingText.innerText =
                'Oops\n\n ' +
                'it appears that you don\'t own any NFT at the moment\n\n' +
                'Perhaps acquire some from the home page?';
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
                getOwnedImageByID(json[i].nftID, cardClone, json.length);

                // Append the NFT card to the cardWrapper
                cardClone.setAttribute('id', 'nftCard' + i);
                cardClone.setAttribute('style', 'display: block');
                cardClone.querySelector('#nftName').innerText = nftName;
                cardClone.querySelector('#author').innerText = nftAuthor;
                cardClone.querySelector('#nftDesc').innerText = nftDesc;

                cardClone.querySelector('#viewBtn').href = `nftDetails.php?nftID=${nftID}`;
                wrapper.appendChild(cardClone);
            }
        }
    })
}

function getOwnedImageByID(nftID, cardClone, totalImageCount) {
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
            outerWrapper.setAttribute('style', 'display: block');
        }
    }).catch(error => console.log(error));
}