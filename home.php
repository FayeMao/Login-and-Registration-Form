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
    <title>Welcome!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container-head">
            <a href="home.php"><img src="img/Kinetic.svg" alt="Logo"></a>
        </div>

        <div class="right-links">
            <?php
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE ID=$id" );
                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_firstName = $result['FirstName'];
                    $res_lastName = $result['LastName'];
                    $res_Password = $result['Password'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_Id = $result['Id'];
                };

                echo "<a href='change-profile.php?Id=$res_Id'>Change Your Profile</a>";
            ?>

            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </header>

    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_firstName.'&nbsp;'.$res_lastName; ?></b>!</p>
                    <p><b>Username:</b> <?php echo $res_Uname; ?></p>
                    <p><b>Age:</b> <?php echo $res_Age; ?></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>