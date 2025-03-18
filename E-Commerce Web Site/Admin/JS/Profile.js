function PersonalInformationValidations() {

    // Clear previous error message
    var error = document.getElementById('ErrorPersonalInformation');
    var FullNameField = document.PersonalInformation.FullName;
    var EmailField = document.PersonalInformation.Email;
    var MobileNumberField = document.PersonalInformation.MobileNumber;
    var AddressField = document.PersonalInformation.Address;
    error.innerHTML = "";

    // Reset previous error states
    FullNameField.classList.remove('error-border');
    EmailField.classList.remove('error-border');
    MobileNumberField.classList.remove('error-border');
    AddressField.classList.remove('error-border');
    profileImage.classList.remove('error-border');


    // Validate Full Name
    if (FullNameField.value == '') {
        error.innerHTML = "Please enter your Full Name";
        FullNameField.classList.add('error-border');
        FullNameField.focus();
        return false;
    }
    // Validate Email
    if (EmailField.value == '') {
        error.innerHTML = "Please enter your Email";
        EmailField.classList.add('error-border');
        EmailField.focus();
        return false;
    }
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(EmailField.value)) {
        error.innerHTML = "Please enter a valid Email";
        EmailField.classList.add('error-border');
        EmailField.focus();
        return false;
    }
    // Validate Mobile Number
    if (MobileNumberField.value == '') {
        error.innerHTML = "Please enter your Mobile Number";
        EmailField.classList.add('error-border');
        EmailField.focus();
        return false;
    }
    // Validate Address
    if (AddressField.value == '') {
        error.innerHTML = "Please enter your Address";
        AddressField.classList.add('error-border');
        AddressField.focus();
        return false;
    }

    return true;

}

function ChangePasswordValidations() {
    // Clear previous error message
    var error = document.getElementById('ErrorChangePassword');
    var UserNameField = document.ChangePassword.UserName;
    var PasswordField = document.ChangePassword.Password;
    var ComPasswordField = document.ChangePassword.ComPassword;
    error.innerHTML = "";

    // Reset previous error states
    UserNameField.classList.remove('error-border');
    PasswordField.classList.remove('error-border');
    ComPasswordField.classList.remove('error-border');

    // Validate UserName
    if (UserNameField.value == '') {
        error.innerHTML = "Please enter your UserName";
        UserNameField.classList.add('error-border');
        UserNameField.focus();
        return false;
    }
    // Validate Password
    if (PasswordField.value == '') {
        error.innerHTML = "Please enter your Password";
        PasswordField.classList.add('error-border');
        PasswordField.focus();
        return false;
    }
    // Validate Confirm Password
    if (ComPasswordField.value == '') {
        error.innerHTML = "Please enter your Confirm Password";
        ComPasswordField.classList.add('error-border');
        ComPasswordField.focus();
        return false;
    }
    if (PasswordField.value != ComPasswordField.value) {
        error.innerHTML = "Password and Confirm Password do not match";
        ComPasswordField.classList.add('error-border');
        ComPasswordField.focus();
        return false;
    }
    return true;
}