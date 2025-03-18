<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="Image/icon.png" type="image/png" alt="Site Icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .login-container h1 {
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control {
            border-radius: 25px;
            padding: 10px 20px;
        }

        .form-group label {
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6f86d6, #48c6ef);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #48c6ef, #6f86d6);
        }

        .btn-secondary {
            border-radius: 25px;
        }

        .errordiv {
            margin-top: 10px;
        }

        .errordiv .alert {
            font-size: 14px;
        }

        a {
            color: #48c6ef;
            text-decoration: none;
            font-weight: 500;
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
            font-size: 16px;
            pointer-events: none;
        }

        .icon-input .form-control {
            padding-left: 45px;
            height: 45px;
            line-height: 1.5;
        }

        .error-border {
            border-color: red;
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

    <div class="login-container">
        <h1>Login Now</h1>
        <form action="Backend/logback.php" method="post" enctype="multipart/form-data" onsubmit="return validations()" name="myform">

            <div class="form-group icon-input">
                <label for="username">Username:</label>
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" aria-label="Username">
            </div>

            <div class="form-group icon-input">
                <label for="password">Password:</label>
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" aria-label="Password">
            </div>

            <div class="errordiv">
                <?php
                if (isset($_GET['LoginError'])) {
                    if ($_GET['LoginError'] == 'notvalid') {
                        echo '<div class="alert alert-danger"> Username or Password is not valid. </div>';
                    }
                    if ($_GET['LoginError'] == 'deactive') {
                        echo '<div class="alert alert-danger"> Your account is not active. </div>';
                    }
                    if ($_GET['LoginError'] == 'nouser') {
                        echo '<div class="alert alert-danger"> No user found. </div>';
                    }
                }
                ?>
                <p id="error" class="text-danger font-weight-bold"></p>
            </div>

            <a href="forgot_password.php">Forgot Password?</a>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="Submit" class="btn btn-primary flex-fill mr-2">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <button type="reset" name="reset" class="btn btn-secondary flex-fill ml-2">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>

            <div class="mt-3 text-center">
                <a href="register.php">Are you registered now?</a>
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3000);
        });

        function validations() {
            var error = document.getElementById('error');
            var usernameField = document.myform.username;
            var passwordField = document.myform.password;

            usernameField.classList.remove('error-border');
            passwordField.classList.remove('error-border');
            error.innerHTML = "";

            if (usernameField.value == '') {
                error.innerHTML = "Please enter your username";
                usernameField.classList.add('error-border');
                usernameField.focus();
                return false;
            }
            if (passwordField.value == '') {
                error.innerHTML = "Please enter your password";
                passwordField.classList.add('error-border');
                passwordField.focus();
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
