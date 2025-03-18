<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Register Page</title>
    <link rel="icon" href="Image/icon.png" type="image/png">
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
            max-width: 600px;
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

        .error-message {
            color: red;
            font-size: 14px;
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
        <h2 class="card-title">Create Your Seller Account</h2>
        <form action="Backend/registerback.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="Position" value="Seller">
                    <div class="form-group mb-3">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter your first name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter your Last Name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                    </div>

                    <div class="form-group mb-3">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password">
                    </div>
                </div>
            </div>
            <div class="errordiv">
                <?php
                if (isset($_REQUEST["RegisterError"])) {
                    echo "<p id='error' class='text-danger font-weight-bold'>" . "Email already exists. Please choose a different Email." . "</p>";
                }
                ?>
                <p id="error" class="text-danger"></p>
            </div>
            <div id="error-message" class="error-message"></div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary" name="Submit">Register</button>
            </div>

            <div class="text-center mt-3 text-small">
                Already have an account? <a href="index.php" class="text-link">Login Here</a>
            </div>
        </form>
    </div>

    <script>
        // Form validation script
        function validateForm() {
            const firstName = document.getElementById('firstName');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const errorMessage = document.getElementById('error-message');

            if (!firstName.value) {
                errorMessage.textContent = 'First Name is required';
                firstName.focus();
                return false;
            }
            if (!lastName.value) {
                errorMessage.textContent = 'Last Name is required';
                lastName.focus();
                return false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                errorMessage.textContent = 'Invalid Email Address';
                email.focus();
                return false;
            }

            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone.value)) {
                errorMessage.textContent = 'Invalid Phone Number';
                phone.focus();
                return false;
            }

            if (password.value.length < 6) {
                errorMessage.textContent = 'Password must be at least 6 characters';
                password.focus();
                return false;
            }

            if (password.value !== confirmPassword.value) {
                errorMessage.textContent = 'Passwords do not match';
                confirmPassword.focus();
                return false;
            }

            errorMessage.textContent = '';
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
