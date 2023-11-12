<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>Login</title>
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
    <div class="container">
        <?php 

            include("php/config.php");
            if(isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);      
                
                $result = mysqli_query($con, "SELECT * FROM users WHERE EMAIL='$email' AND Password='$password'") or die("An error occured");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['firstName'] = $row['FirstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
                } else {
                    echo "<div class='message-alert'>
                    <p>Wrong username and/or password</p>
                    </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Go Back</button>";
                }
                if (isset($_SESSION['valid'])) {
                    header("Location: home.php");
                }
            } else {

        ?>
        <div class="box form-box">
            <h1>Login</h1>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    
</body>
</html>