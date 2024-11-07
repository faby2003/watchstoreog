<?php
session_start(); 

$con = mysqli_connect("localhost", "root", "", "watch_store");
if (!$con) {
    die("DB not Connected: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `login` WHERE email='$email' AND password='$password'";
    $login_data = mysqli_query($con, $sql);

    if ($login_data) {
        if (mysqli_num_rows($login_data) > 0) {
            $user_sql = "SELECT UserID FROM `users` WHERE Email='$email'";
            $user_data = mysqli_query($con, $user_sql);

        
                $user_value = mysqli_fetch_assoc($user_data);
                $_SESSION['userid'] = $user_value['UserID']; 

                $login_value = mysqli_fetch_assoc($login_data);

                if ($login_value['usertype'] == 1) {
                    header('Location: userhome.html');
                    exit();
                    } elseif ($login_value['usertype'] == 2) {
                        header('Location: staffhome.html'); 
                    }
                 else {
                    header('Location: adminhome.html');
                    exit();
                }

        } else {
            echo "<script>alert('Invalid login credentials')</script>";
        }
    } else {
        echo "<script>alert('Query error')</script>";
    }
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Watch Store</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <header>
        <nav>
            <h2>WS</h2>
            <div class="nav-links">
                <a href="home.html">Home</a>
            </div>
        </nav>
    </header>

    <main class="login-main">
        <div class="login-container">
            <form action="login.php" class="login-form" method="post">
                <h1>Welcome to Watch Store</h1>
                <div class="input-group">
                    <input class="login-input" type="email" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="input-group">
                    <input class="login-input" type="password" name="password" placeholder="Enter Password" required>
                </div>
                <input class="login-button" type="submit" name="submit" value="Login">
                <p>Don’t have an account? <a class="signup-link" href="register.php">Sign up</a></p> 
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Watch Store. All rights reserved.</p>
    </footer>
</body>
</html>
