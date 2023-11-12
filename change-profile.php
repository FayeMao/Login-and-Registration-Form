<?php
    session_start();
    
    include("php/config.php");
    if (!isset($_SESSION['valid'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign Up</title>
</head>
<body>
    <header>
        <div class="container-head">
            <img src="/img/Kinetic.svg" alt="Logo">
        </div>
    </header>
    <div class="container">
        <div class="box form-box">

        <?php 
            if(isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age', FirstName='$firstName', LastName='$lastName', Password='$password' WHERE ID=$id") or die("Error Occured");

                if ($edit_query) {
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                    </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
                }
            } else {

                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_firstName = $result['FirstName'];
                    $res_lastName = $result['LastName'];
                    $res_Password = $result['Password'];
                }
            
        ?>
            <header>Change Your profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?php echo $res_Uname; ?>" id="username" required>
                </div>

                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" value="<?php echo $res_firstName; ?>" id="firstName" required>
                </div>

                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" value="<?php echo $res_lastName; ?>" id="lastName" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $res_Email; ?>" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?php echo $res_Password; ?>" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Update" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    
</body>
</html>