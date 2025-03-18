<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <main>
      <div class="box">

        <div class="inner-box">
          <div class="forms-wrap">
          <form action="logback.php" method="POST" autocomplete="off" class="sign-in-form" id="form">
  <div class="logo">
    <img src="./img/logo.png" alt="easyclass" />
    <h4>Shopzy</h4>
  </div>

  <div class="heading">
    <h2>Welcome Back</h2>
    <h6>Not registered yet?</h6>
    <a href="#" class="toggle">Sign up</a>
  </div>

  <div class="actual-form">
    <div class="input-wrap">
      <input
        type="email"
        name="email"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Email</label>
    </div>

    <div class="input-wrap">
      <input
        type="password"
        name="password"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Password</label>
    </div>

    <input type="submit" value="Sign In" class="sign-btn" />

    <p class="text">
      Forgotten your password or your login details?
      <a href="#">Get help</a> signing in
    </p>
     <!-- Error/Success Messages -->
     <div class="message-container">
     <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo "<p style='color: red;'>Please fill in all fields!</p>";
            } elseif ($_GET['error'] == "emailnotfound") {
                echo "<p style='color: red;'>No account found with this email!</p>";
            } elseif ($_GET['error'] == "incorrectpassword") {
                echo "<p style='color: red;'>Incorrect password!</p>";
            }
        } elseif (isset($_GET['login']) && $_GET['login'] == "success") {
            echo "<p style='color: green;'>Login successful! Welcome back!</p>";
        }
        ?>
         </div>

  </div>
</form>


<form action="regback.php" method="POST" autocomplete="off" class="sign-up-form" enctype="multipart/form-data">
  <div class="logo">
    <img src="./img/logo.png" alt="easyclass" />
    <h4>Shopzy</h4>
  </div>

  <div class="heading">
    <h6>Already have an account?</h6>
    <a href="#" class="toggle">Sign in</a>
  </div>

  <div class="actual-form">
    <!-- First Name -->
    <div class="input-wrap">
      <input
        type="text"
        name="first_name"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>First Name</label>
    </div>

    <!-- Last Name -->
    <div class="input-wrap">
      <input
        type="text"
        name="last_name"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Last Name</label>
    </div>

    <!-- Email -->
    <div class="input-wrap">
      <input
        type="email"
        name="email"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Email</label>
    </div>

    <!-- Password -->
    <div class="input-wrap">
      <input
        type="password"
        name="password"
        minlength="4"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Password</label>
    </div>

    <!-- Confirm Password -->
    <div class="input-wrap">
      <input
        type="password"
        name="confirm_password"
        minlength="4"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Confirm Password</label>
    </div>

    <!-- Contact -->
    <div class="input-wrap">
      <input
        type="text"
        name="contact"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Contact</label>
    </div>

    <!-- Address -->
    <div class="input-wrap">
      <input
        type="text"
        name="address"
        class="input-field"
        autocomplete="off"
        required
      />
      <label>Address</label>
    </div>

    </div>

    <input type="submit" value="Sign Up" class="sign-btn" />

    <!-- Display messages -->
    <div class="message-container">
      <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "passwordmismatch") {
              echo "<p style='color: red;'>Passwords do not match!</p>";
          } elseif ($_GET['error'] == "emailalreadyexists") {
              echo "<p style='color: red;'>This email is already registered!</p>";
          } elseif ($_GET['error'] == "registrationfailed") {
              echo "<p style='color: red;'>Registration failed. Please try again later!</p>";
          }
        } elseif (isset($_GET['success']) && $_GET['success'] == "registered") {
            echo "<p style='color: green;'>Registration successful! You can now log in.</p>";
        }
      ?>
    </div>
  </div>
</form>



          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="./img/image1.png" class="image img-1 show" alt="" />
              <img src="./img/image2.png" class="image img-2" alt="" />
              <img src="./img/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Dress like you're already famous</h2>
                  <h2>Customize as you like</h2>
                  <h2>Fashion is about something that comes from within you</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="app.js"></script>
  </body>
</html>
