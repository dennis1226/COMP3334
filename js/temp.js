// sample code to call the api
document.addEventListener("DOMContentLoaded", function(event) {
    const data = new URLSearchParams();
    data.append('email', 'hello@gmail.com');

    fetch('../loginFlagding.php', {
        method: 'POST',
        body: data
    }).then(response => response.text()).then(response => {
        console.log(response);

    }).catch(error => {
        console.log(error);
    });
});