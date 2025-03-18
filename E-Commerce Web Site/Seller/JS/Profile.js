function PersonalInformationValidations() {
    const firstName = document.getElementById("FristName");
    const lastName = document.getElementById("LastName");
    const address = document.getElementById("Address");
    const mobile = document.getElementById("MobileNumber");
    const profileImage = document.getElementById("ProfileImage");

    // First Name Validation
    if (firstName.value.trim() === "") {
        document.getElementById("ErrorPersonalInformation").innerText = "First Name is required.";
        firstName.focus();
        return false;
    }

    // Last Name Validation
    if (lastName.value.trim() === "") {
        document.getElementById("ErrorPersonalInformation").innerText = "Last Name is required.";
        lastName.focus();
        return false;
    }

    // Address Validation
    if (address.value.trim() === "") {
        document.getElementById("ErrorPersonalInformation").innerText = "Address is required.";
        address.focus();
        return false;
    }

    // Mobile Number Validation
    if (mobile.value.trim() === "") {
        document.getElementById("ErrorPersonalInformation").innerText = "Mobile number is required.";
        mobile.focus();
        return false;
    }
    if (!/^\d{10}$/.test(mobile.value)) {
        document.getElementById("ErrorPersonalInformation").innerText = "Mobile number must be 10 digits.";
        mobile.focus();
        return false;
    }

    // Profile Image Validation
    if (profileImage.value && !/\.(jpg|jpeg|png|gif)$/i.test(profileImage.value)) {
        document.getElementById("ErrorPersonalInformation").innerText =
            "Only JPG, JPEG, PNG, or GIF formats are allowed for profile image.";
        profileImage.focus();
        return false;
    }

    // Clear Error Message
    document.getElementById("ErrorPersonalInformation").innerText = "";
    return true;
}

function ChangePasswordValidations() {
    const email = document.getElementById("Email");
    const password = document.getElementById("Password");
    const confirmPassword = document.getElementById("ComPassword");

    // Email Validation
    if (email.value.trim() === "") {
        document.getElementById("ErrorChangePassword").innerText = "Email is required.";
        email.focus();
        return false;
    }
    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email.value)) {
        document.getElementById("ErrorChangePassword").innerText = "Invalid email format.";
        email.focus();
        return false;
    }

    // Password Validation
    if (password.value === "") {
        document.getElementById("ErrorChangePassword").innerText = "Password is required.";
        password.focus();
        return false;
    }
    if (password.value.length < 6) {
        document.getElementById("ErrorChangePassword").innerText =
            "Password must be at least 6 characters long.";
        password.focus();
        return false;
    }

    // Confirm Password Validation
    if (password.value !== confirmPassword.value) {
        document.getElementById("ErrorChangePassword").innerText = "Passwords do not match.";
        confirmPassword.focus();
        return false;
    }

    // Clear Error Message
    document.getElementById("ErrorChangePassword").innerText = "";
    return true;
}
