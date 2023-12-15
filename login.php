<?php
    session_start();
    require_once 'connect.php';

    if (isset($_SESSION['username'])) {
        header("Location: index.html");
        exit();
    }

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($connect_users, $_POST['username']);
        $password = mysqli_real_escape_string($connect_users, $_POST['password']);

        $query = "SELECT * FROM `users` WHERE `username` = ?";
        $stmt = mysqli_prepare($connect_users, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            // Проверка хеша пароля
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                header("Location: account.php");
                exit();
            } else {
                // Обработка случая, когда пароль неверен
                // Логирование ошибки может быть полезным
                error_log("Invalid login attempt for username: $username");
                header("Location: login.php");
                exit();
            }
        } else {
            // Обработка случая, когда пользователь с указанным логином не найден
            // Логирование ошибки может быть полезным
            error_log("User not found for username: $username");
            header("Location: login.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In - Retro Diner</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id='main'>
        <div id="header">
            <div>
                <a href="index.html"><img class="logo" src="images/logo.png" width="513" height="84" alt=""
                        title=""></a>
                <a href="index.html"><img src="images/waitress.png" width="332" height="205" alt="" title=""></a>
                <ul class="navigation">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="burger.php">Menu</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a class="active" href="account.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="form">
            <h1 id="heading" class="login" >Login Form</h1>
            <form name="form" action="login.php" method="POST">
                <input type="text" id="username" name="username" placeholder="Username"></br></br>
                <input type="password" id="password" name="password" required placeholder="Password"></br></br>
                <input type="submit" id="loginBtn" value="Login" class="login_button" name="submit" />
                <input type="button" id="signupBtn" value="SignUp" onclick="window.location='signup.php'" />
            </form>
        </div>

        <div id="footer">
            <div>
                <ul>
                    <li class="first">
                        <h2>Delivery Hotline</h2>
                        <h3>Call 0-123-456-789</h3>
                        <ul>
                            <li>
                                <a href="http://www.facebook.com" class="facebook"></a>
                            </li>
                            <li>
                                <a href="http://www.twitter.com" class="twitter"></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><img class="logo" src="images/logo-footer.png" alt=""></a>
                        <ul class="navigation">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="about.html">About Us</a>
                            </li>
                            <li>
                                <a href="burger.php">Menu</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact Us</a>
                            </li>
                        </ul>
                        <span>&copy; 2023 RetroDiner.com. All Rights Reserved</span>
                    </li>
                    <li class="last">
                        <h2>Follow Us By Email</h2>
                        <form action="index.html">
                            <input type="text" name="subscribe" value="Enter Your Email Here...">
                            <input type="submit" value="">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>