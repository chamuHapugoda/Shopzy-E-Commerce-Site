<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="Image/icon.jfif" type="image/png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6 url('https://www.transparenttextures.com/patterns/soft-wallpaper.png');
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            position: relative;
            z-index: 10;
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
            padding: 10px 15px;
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .text-link {
            color: #4f46e5;
            font-weight: 500;
            text-decoration: none;
        }

        .text-link:hover {
            text-decoration: underline;
        }


        .alert {
            font-size: 14px;
        }

        .error-message {
            color: red;
            font-size: 14px;
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

    <div class="card">
        <h2 class="card-title">Welcome Back</h2>
        <form action="Backend/logback.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group mb-3">
                <label for="Email">Email</label>
                <input type="Email" class="form-control" id="Email" name="Email" placeholder="Enter your Email">
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password">
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

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="Submit">Login</button>
            </div>

            <div class="text-center mt-3 text-small">
                <a href="forgot_password.php" class="text-link">Forgot Password?</a>
            </div>

            <div class="text-center mt-2 text-small">
                Don’t have an account? <a href="register.php" class="text-link">Register Now</a>
            </div>
        </form>
    </div>

    <script>

        function validateForm() {
            const Email = document.getElementById('Email');
            const password = document.getElementById('password');
            const errorMessage = document.getElementById('error-message');

            if (!Email.value) {
                errorMessage.textContent = 'Email is required';
                Email.focus();
                return false;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(Email.value)) {
                errorMessage.textContent = 'Invalid email format';
                Email.focus();
                return false;
            }
            if (!password.value) {
                errorMessage.textContent = 'Password is required';
                password.focus();
                return false;
            }
            return true;
        }
        
        // Generate falling snow
        function createSnowflakes() {
            const snowflakesContainer = document.getElementById('snowflakes-container');
            for (let i = 0; i < 15; i++) {
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

        setInterval(createSnowflakes, 700); // Generate new snowflakes every 0.5s

        
    </script>
</body>

</html>
