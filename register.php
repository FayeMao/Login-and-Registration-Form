<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <title>Sign Up</title>
</head>
<body>
    <header>
        <div class="container-head">
            <a href="home.php"><img src="img/Kinetic.svg" alt="Logo"></a>
        </div>

        <div class="right-links">
            <a href="index.php">Login</a>
            <a href="register.php"><button class="btn">Sign Up</button></a>
        </div>
    </header>
    <div class="container-login">
        <div class="box form-box">
            <?php
            include("php/config.php");
            
            if(isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];
                $repassword = $_POST['repassword']; // Add this line
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                
                // Verify the unique email
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                    <p>This email is already in use, please enter a unique email</p>
                    </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {
                    // Check if the password and re-entered password match
                    if ($password === $repassword) { // Passwords match
                        mysqli_query($con, "INSERT INTO users(Username, Email, Age, Password, FirstName, LastName) VALUES('$username', '$email', '$age', '$password', '$firstName', '$lastName')") or die("Error Occurred");
                        echo "<div class='message'>
                        <p>Registration Successful!</p>
                        </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button>";
                    } else { // Passwords do not match
                        echo "<div class='message-alert'>
                        <p>Passwords do not match. Please re-enter the same password.</p>
                        </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    }
                }
            } else {
            ?>
            <h1>Sign Up</h1>
            <form action="" method="post">

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" required>
                </div>

                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field input">
                    <label for="repassword">Re-enter Password</label>
                    <input type="password" name="repassword" id="repassword" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Sign Up" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Login instead</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
