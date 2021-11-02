<?php include "database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/loginBoxStyle.css">
    <title>Login Page</title>
</head>

<body>
    <div id="login-box">
        <form action="loginFunction.php" method="post">
            <div class="left">
                <h1>Login</h1>
                <div class="error">
                    <h4 id="error-message">
                        <?php if (isset($_GET['error'])) {
                            echo "*".$_GET['error'];
                        } ?>
                    </h4>
                </div>
                <input type="text" name="username" placeholder="Username" id="username-input" />
                <input type="password" name="password" placeholder="Password" id="password-input" />
                <div id="forgotPassword">
                    Forgot password?
                </div>
                <input type="submit" name="login_submit" value="Login" id="login-btn" />
                <div id="notMember">Not a member? <a href="./registerBox.php" id="signup-link">Sign up</a></div>
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
            </div>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>