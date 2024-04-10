// Function to validate password
function validatePassword() {
    var password = document.getElementById("password").value;
    var messageBox = document.getElementById("passwordMessage");

    if (password.length == 0) {
        messageBox.innerHTML = "";
        messageBox.style.color = "initial";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../src/signup-onkeyup/pcode1-ajax.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var responseText = this.responseText.trim();
                if (responseText === "Valid!") {
                    messageBox.innerHTML = "Valid!";
                    messageBox.style.color = "green";
                    // Call validateConfirmPassword when password validation is successful
                    validateConfirmPassword();
                } else {
                    messageBox.innerHTML = responseText; // Using the response directly as it's plain text now
                    messageBox.style.color = "red";
                }
            } else {
                console.error("Server responded with status: ", this.status);
                messageBox.innerHTML = "Validation error, please try again.";
                messageBox.style.color = "red";
            }
        }
    };
    xhr.send("password=" + encodeURIComponent(password));
}