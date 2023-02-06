//Normal login
function doSingInVerify() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    if (email === "" || password === "") {
        $('.msg').html('please enter email and password');
    } else {
        doSingIn();
    }
}

async function doSingIn() {
    $("#loading-block").css("display", "block");
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    await fetch('phpFunctions/loginFlagding.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text()).then(response => {
        let json = JSON.parse(response);
        console.log(response);

        //Valid email and password
        if (json.isSuccess) {
            window.location.replace(json.redirectURL);
        }
        //invalid
        else {
            if (json.redirectURL === "") {
                $('.msg').html(json.msg);
            } else {
                alert(json.msg);
                window.location.replace(json.redirectURL);
            }
        }
        $("#loading-block").css("display", "none");
    }).catch(error => {
        console.log(error);
    });
}

//Google Oauth2 Login
function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var $json = {
        "userName": profile.getName(),
        "email": profile.getEmail()
    };
    //alert(profile.getEmail());
    $.ajax({
        type: 'POST',
        url: 'phpFunctions/oauth2Register.php',
        //dataType: "json",
        data: $json,
        success: function (response) {
            var json = JSON.parse(response);
            if (json.isSuccess) {
                window.location.replace(json.redirectURL);
            }//invalid
            else {
                $('.msg').html(json.msg);
            }
        }
    });
};
