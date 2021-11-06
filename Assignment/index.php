<?php include "database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/loginBoxStyle.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="validator.js"></script>
    <title>Login Page</title>
</head>
<body>
    <form class="form" id="login" action="login_processing.php" method="post">
        <h1 id="title">Login</h1>
        <span class="form-message" id="response" href="javascript: reload()"></span>

        <div class="form-group">
            <input type="text" name="username" placeholder="Username" id="username-input" />
            <span class="form-message" id="uname"></span>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" id="password-input" />
            <span class="form-message" id="uname"></span>
        </div>

        <div id="forgotPassword">
            Forgot password?
        </div>
        <input type="submit" name="login_submit" value="Login" id="login-btn"/>
        <div id="notMember">Not a member? <a href="./register.php" id="signup-link">Sign up</a></div>
        <div class="bottom-icon">
            <button class="social-signin facebook" type="button">
                <ion-icon name="logo-facebook" size="small"></ion-icon>
            </button>
            <button class="social-signin twitter" type="button">
                <ion-icon name="logo-twitter" size="small"></ion-icon>
            </button>
            <button class="social-signin microsoft" type="button">
                <ion-icon name="logo-google" size="small"></ion-icon>
            </button>
        </div>
    </form>
<script language="JavaScript" type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#login',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#username-input', 'Username must be filled'),
                    Validator.usernameCheck('#username-input'),
                    Validator.isRequired('#password-input', 'Password must be filled'),
                    Validator.minLength('#password-input', 8, 'Password is at least 8 characters'),
                ],
            });
        });

        var baseURL = window.location.href.split("?")[0];
        var error = getParameter('error');
        var element = document.getElementById('response');
        if (error) {
            element.innerHTML = error;
            element.classList.remove("success");
            element.classList.add("error");
            window.history.pushState('name', '', baseURL);
        }
    </script>
</body>
</html>