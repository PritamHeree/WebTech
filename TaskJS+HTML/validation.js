let wrongCount = 0;

document.getElementById("loginForm").addEventListener("submit", function(event) {

    event.preventDefault(); 

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let errorMessage = "";

    
    if (!email.includes("@")) {
        errorMessage = "Email must contain '@'.";
    }
    
    else if (password.length < 6) {
        errorMessage = "Password must be at least 6 characters long.";
    }
    
    else if (!password.includes("#")) {
        errorMessage = "Password must contain '#'.";
    }

    if (errorMessage !== "") {
        wrongCount++;
        document.getElementById("error").innerHTML = errorMessage;
        document.getElementById("attemptCount").innerHTML =
            "Wrong submission count: " + wrongCount;
    } else {
        document.getElementById("error").innerHTML = "Login Successful!";
        document.getElementById("error").style.color = "green";
    }

});