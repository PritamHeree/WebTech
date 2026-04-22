<?php 

function validateUsername($username) {
    if(!$username) {
        return "Username is required";
    } else if(strlen($username) < 3) {
        return "Username must be at least 3 characters";
    }
    return "";
}

function validateEmail($email) {
    if(!$email) {
        return "Email is required";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    return "";
}

function validatePassword($password) {
    if(!$password) {
        return "Password is required";
    } else if(strlen($password) < 6) {
        return "Password must be at least 6 characters";
    }
    return "";
}

function validateConfirmPassword($password, $confirmPassword) {
    if(!$confirmPassword) {
        return "Confirm password is required";
    } else if($password !== $confirmPassword) {
        return "Passwords do not match";
    }
    return "";
}

?>