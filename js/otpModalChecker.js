document.addEventListener("DOMContentLoaded", function (event) {
    let modal = document.getElementById('otpModal');
    let allOTPInputs = document.getElementsByClassName('otpInput');
    let submitOTP = document.getElementById('submitOTP');
    let hideOTPBtn = document.getElementById('mdDismiss');
    let status = document.getElementById('modalStatus');

    //focus on the first input when the modal is shown
    modal.addEventListener('shown.bs.modal', function () {
        allOTPInputs[0].focus();
    });

    //reset the modal on close
    modal.addEventListener('hidden.bs.modal', function (e) {
        for (let i = 0; i < allOTPInputs.length; i++) {
            allOTPInputs[i].value = '';
        }
        hideOTPBtn.classList.remove('disabled');
        submitOTP.classList.remove('disabled');
        status.innerText = ' ';
    });

    Array.from(allOTPInputs).forEach(function (allOTPInputs) {
        allOTPInputs.addEventListener("keydown", function (event) {
            let nextInput = allOTPInputs.parentElement.nextElementSibling.children[0];
            let prevInput = allOTPInputs.parentElement.previousElementSibling.children[0];

            if (nextInput === undefined) { // prevent user from entering more digits than the OTP length
                event.preventDefault();
            }

            if (event.keyCode === 8 && prevInput === undefined && nextInput !== undefined) { // clear the first input
                allOTPInputs.value = "";
            } else if (event.keyCode === 8 && prevInput !== undefined) { // clear the current input, then jump to previous input
                allOTPInputs.value = "";
                prevInput.value = "";
                prevInput.focus();
            }

            if (allOTPInputs.value.length === 1 && nextInput !== undefined) { // jump to next input
                nextInput.focus();
            }
        });
    })
});
