<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/registerBoxStyle.css">
    <script language="JavaScript" type="text/javascript" src="validator.js"></script>
    <title>Register</title>
</head>

<body>
    <form class="form" id="form-1" action="register_processing.php" method="post">
        <h1 class="register-content">Register</h1>
        <span class="form-message" id="response" href="javascript: reload()"></span>
        <div class="account-info">
            <div class="form-group">
                <input type="text" name="username" placeholder="*Username" id="Username" class="TextField form-control" rules="required" />
                <span class="form-message" id="uname"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="*Password" id="Password" class="PasswordField form-control" rules="required|min:6" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password2" placeholder="*Re-type password" id="RetypePassword" class="PasswordField form-control" rules="required" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="text" name="firstname" placeholder="First Name" id="Firstname" class="TextField form-control" rules="required" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="text" name="lastname" placeholder="Last Name" id="Lastname" class="TextField form-control" rules="required" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Phone" id="Phone" class="TextField form-control" rules="required" />
                <span class="form-message"></span>
            </div>
        </div>
        <!-- <button id="sign-up-button" type="submit" form="form-1" value="Submit">Register</button> -->
        <input id="sign-up-button" type="submit" name="signup_submit" value="Sign me up" />
        <input id="back-to-login" onclick="location.href='./index.php';" value="Back to Login"></button>
    </form>
    <script language="JavaScript" type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-1',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#Username', 'Username must be filled'),
                    Validator.usernameCheck('#Username', 'Username must be in correct form'),
                    Validator.isRequired('#Firstname', 'Please fill your first name'),
                    Validator.isRequired('#Lastname', 'Please fill your last name'),
                    Validator.isRequired('#Phone', 'Please fill your phone number'),
                    Validator.phoneCheck('#Phone', 'Phone must be in correct form'),
                    Validator.isRequired('#Password', 'Password must be filled'),
                    Validator.minLength('#Password', 8, 'Password is at least 8 characters'),
                    Validator.isConfirmed('#RetypePassword', function() {
                        return document.querySelector('#Password').value;
                    }, 'Pasword is not match'),
                    Validator.passwordCheck('#Password')
                ],
            });
        });

        function getParameter(parameterName) {
            let parameter = new URLSearchParams(window.location.search);
            return parameter.get(parameterName);
        }

        var baseURL = window.location.href.split("?")[0];
        var success = getParameter('success');
        var error = getParameter('error');
        console.log(baseURL);
        console.log(success);
        console.log(error);
        var element = document.getElementById('response');
        if (success) {
            element.innerHTML = success;
            element.classList.remove('error');
            element.classList.add("success");
            window.history.pushState('name', '', baseURL);
        }
        if (error) {
            element.innerHTML = error;
            element.classList.remove("success");
            element.classList.add("error");
            window.history.pushState('name', '', baseURL);
        }
    </script>
</body>

</html>