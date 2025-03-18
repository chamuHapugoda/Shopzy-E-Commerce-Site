<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="icon" href="Image/icon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Include Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6f86d6, #48c6ef);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 25px;
            padding: 15px;
            font-size: 16px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6f86d6, #48c6ef);
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #48c6ef, #6f86d6);
        }

        .btn-secondary {
            border-radius: 25px;
            font-size: 16px;
        }

        .errordiv {
            margin-top: 15px;
        }

        .errordiv .alert {
            font-size: 14px;
        }

        a {
            color: #48c6ef;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        .icon-input {
            position: relative;
        }

        .icon-input i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .icon-input .form-control {
            padding-left: 45px;
        }

        .error-border {
            border-color: red !important;
        }

        #error {
            font-size: 14px;
            color: red;
            margin-top: 10px;
        }

        /* Falling Snow Effect */
        .snowflake {
            color: #fff;
            font-size: 1em;
            position: fixed;
            top: -10px;
            z-index: 5;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0.5;
            }
        }
    </style>
</head>

<body>

<!-- Snowflakes -->
<div id="snowflakes-container"></div>

    <div class="login-container mt-5">
        <h1 class="text-center mb-4">Register Now</h1>
        <form action="Backend/registerback.php" method="post" enctype="multipart/form-data" onsubmit="return validations()" name="myform">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="Position" value="Admin">
                    <div class="form-group icon-input">
                        <label for="name">First Name:</label>
                        <i class="fas fa-user"></i>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name">
                    </div>

                    <div class="form-group icon-input">
                        <label for="email">Email:</label>
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                    </div>

                    <div class="form-group icon-input">
                        <label for="phone">Phone:</label>
                        <i class="fas fa-phone-alt"></i>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group icon-input">
                        <label for="username">Username:</label>
                        <i class="fas fa-user-circle"></i>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>

                    <div class="form-group icon-input">
                        <label for="password">Password:</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>

                    <div class="form-group icon-input">
                        <label for="compassword">Confirm Password:</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="compassword" name="compassword" placeholder="Confirm Password">
                    </div>
                </div>
            </div>

            <div class="errordiv">
                <?php
                if (isset($_REQUEST["RegisterError"])) {
                    echo "<p id='error' class='text-danger font-weight-bold'>" . "Username already exists. Please choose a different username." . "</p>";
                }
                ?>
                <p id="error" class="text-danger"></p>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <input type="submit" name="Submit" value="Register" class="btn btn-primary flex-fill mr-2">
                <input type="reset" name="reset" value="Reset" class="btn btn-secondary flex-fill ml-2">
            </div>

            <div class="text-center mt-3">
                <a href="index.php">Already have an account? Login now</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validations() {
            var error = document.getElementById('error');
            var nameField = document.myform.name;
            var emailField = document.myform.email;
            var phoneField = document.myform.phone;
            var usernameField = document.myform.username;
            var passwordField = document.myform.password;
            var confirmPasswordField = document.myform.compassword;

            // Reset previous error states
            nameField.classList.remove('error-border');
            emailField.classList.remove('error-border');
            phoneField.classList.remove('error-border');
            usernameField.classList.remove('error-border');
            passwordField.classList.remove('error-border');
            confirmPasswordField.classList.remove('error-border');
            error.innerHTML = "";

            // Validate name
            if (nameField.value == '') {
                error.innerHTML = "Please enter your Name";
                nameField.classList.add('error-border');
                nameField.focus();
                return false;
            }

            // Validate email
            if (emailField.value == '') {
                error.innerHTML = "Please enter your Email";
                emailField.classList.add('error-border');
                emailField.focus();
                return false;
            }
            // Validate email format
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailField.value)) {
                error.innerHTML = "Please enter a valid Email";
                emailField.classList.add('error-border');
                emailField.focus();
                return false;
            }

            // Validate phone
            if (phoneField.value == '') {
                error.innerHTML = "Please enter your Phone";
                phoneField.classList.add('error-border');
                phoneField.focus();
                return false;
            }
            // Validate phone format
            var phonePattern = /^\+?[0-9]{1,3}?[-. ]?\(?[0-9]{1,4}\)?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}$/;
            if (!phonePattern.test(phoneField.value)) {
                error.innerHTML = "Please enter a valid Phone";
                phoneField.classList.add('error-border');
                phoneField.focus();
                return false;
            }

            // Validate username
            if (usernameField.value == '') {
                error.innerHTML = "Please enter your Username";
                usernameField.classList.add('error-border');
                usernameField.focus();
                return false;
            }

            // Validate password
            if (passwordField.value == '') {
                error.innerHTML = "Please enter your Password";
                passwordField.classList.add('error-border');
                passwordField.focus();
                return false;
            }

            // Validate confirm password
            if (confirmPasswordField.value == '') {
                error.innerHTML = "Please enter your Confirm Password";
                confirmPasswordField.classList.add('error-border');
                confirmPasswordField.focus();
                return false;
            }

            // Validate that password and confirm password match
            if (passwordField.value != confirmPasswordField.value) {
                error.innerHTML = "Password and Confirm Password must be the same";
                confirmPasswordField.classList.add('error-border');
                confirmPasswordField.focus();
                return false;
            }

            return true;
        }

        // Generate falling snow
        function createSnowflakes() {
            const snowflakesContainer = document.getElementById('snowflakes-container');
            for (let i = 0; i < 10; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.animationDuration = `${Math.random() * 3 + 2}s`;
                snowflake.style.fontSize = `${Math.random() * 10 + 10}px`;
                snowflake.textContent = '❄';
                snowflakesContainer.appendChild(snowflake);

                setTimeout(() => {
                    snowflake.remove();
                }, 5000); // Remove snowflakes after animation
            }
        }

        setInterval(createSnowflakes, 1500); // Generate new snowflakes every 0.5s
    </script>
</body>

</html>
