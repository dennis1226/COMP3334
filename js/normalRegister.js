isRobot = true;

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
            console.log(response);
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

function verifyRobot(){
    if (!isRobot){
        postRegisterData();
    }else{
        alert("Please click 'I am not a robot'")
    }
}
async function postRegisterData() {
    $("#loading-block").css("display", "block");
    let userName = document.getElementById("userName").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    const formData = new FormData();
    formData.append('userName', userName);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('confirmPassword', confirmPassword);
    await fetch('phpFunctions/normalRegister.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text()).then( response=>{
        console.log(response);
        let json = JSON.parse(response);

        if (json.isSuccess){
            window.location.replace('verifyOTP.php?_ijt=ti0r8r9j9hmlmjkao1ddjearj9&_ij_reload=RELOAD_ON_SAVE');
        }else{
            $('#userNameMsg').html(json.userNameMsg);
            $('#emailMsg').html(json.emailMsg);
            $('#passwordMsg').html(json.passwordMsg);
            $('#confirmPasswordMsg').html(json.confirmPasswordMsg);
        }
        $("#loading-block").css("display", "none");
    }).catch(error => {
        console.log(error);
    });
}

//check i am not a robot is clicked
function recaptchaCallback() {
    isRobot = false;
};