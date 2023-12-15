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
    $cpassword = mysqli_real_escape_string($connect_users, $_POST['cpassword']);

    // Проверка существования логина с использованием подготовленного запроса
    $check_query = "SELECT * FROM `users` WHERE `username` = ?";
    $stmt = mysqli_prepare($connect_users, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_result) > 0) {
        // Логин уже существует
        header("Location: signup.php?error=existing_username");
        exit();
    }

    if ($password == $cpassword) {
        // Хеширование пароля
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Вставка нового пользователя с использованием подготовленного запроса
        $insert_query = "INSERT INTO `users` (`username`, `password`) VALUES (?, ?)";
        $stmt = mysqli_prepare($connect_users, $insert_query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Регистрация прошла успешно
            header("Location: login.php?success=registration_successful");
            exit();
        } else {
            // Ошибка при выполнении запроса
            header("Location: signup.php?error=registration_failed");
            exit();
        }
    } else {
        // Пароли не совпадают
        header("Location: signup.php?error=password_mismatch");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up - Retro Diner</title>
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
            <h1 id="heading" class="signup">Sign Up Form</h1><br>
            <form name="form" action="signup.php" method="POST">
                <input type="text" id="username" name="username" required placeholder="Username"><br><br>
                <input type="password" id="password" name="password" required placeholder="Password"><br><br>
                <input type="password" id="cpassword" name="cpassword" required placeholder="Repeat Password"><br><br>
                <input type="submit" id="signupBtn" value="SignUp" class="signup_button" name="submit" />
                <input type="button" id="loginBtn" value="Login" onclick="window.location='login.php'" />
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
                            <input type="text" name="subscribe" placeholder="Enter Your Email Here...">
                            <input type="submit" value="">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>