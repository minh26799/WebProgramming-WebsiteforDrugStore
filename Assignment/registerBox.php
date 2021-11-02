<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/registerBoxStyle.css">
    <title>Register</title>
</head>

<body>
    <form class="form" id="form-1" action="" method="post">
        <h1 class="register-content">Register</h1>
        <span class="form-message" id="response" href="javascript: reload()"></span>
        <div class="account-info">
            <div class="form-group">
                <input type="text" name="username" placeholder="*Username" id="Username" class="TextField form-control" />
                <span class="form-message" id="uname"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="*Password" id="Password" class="PasswordField form-control" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password2" placeholder="*Re-type password" id="RetypePassword" class="PasswordField form-control" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="text" name="firstname" placeholder="First Name" id="Firstname" class="TextField form-control" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="text" name="lastname" placeholder="Last Name" id="Lastname" class="TextField form-control" />
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Phone" id="Phone" class="TextField form-control" />
                <span class="form-message"></span>
            </div>
        </div>
        <!-- <button id="sign-up-button" type="submit" form="form-1" value="Submit">Register</button> -->
        <input id="sign-up-button" type="submit" name="signup_submit" value="Sign me up" />
    </form>
    <script language="JavaScript" type="text/javascript" src="validator.js"></script>
    <script language="JavaScript" type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-1',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#Username', 'Username must be filled'),
                    Validator.isRequired('#Firstname', 'Please fill your first name'),
                    Validator.isRequired('#Lastname', 'Please fill your last name'),
                    Validator.isRequired('#Phone', 'Please fill your phone number'),
                    Validator.isRequired('#Password', 'Password must be filled'),
                    Validator.minLength('#Password', 8, 'Password is at least 8 characters'),
                    Validator.isConfirmed('#RetypePassword', function() {
                        return document.querySelector('#Password').value;
                    }, 'Pasword is not match')
                ],
                onSubmit: function() {
                    //Make Submission
                    var myForm = document.getElementById('form-1');
                    myForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(document.getElementById('form-1'));
                        fetch('register_processing.php', {
                            method: 'post',
                            body: formData
                        }).then(function(response) {
                            console.log(response);
                            if (response.ok) {
                                var url = new URL(response.url);
                                var success = url.searchParams.get("success");
                                var error = url.searchParams.get("error");
                                var element = document.getElementById('response');
                                if (success && error != "") {
                                    element.textContent = "Registered Sucessfully";
                                }
                                if(error ==="Username is taken")
                                {
                                    element.textContent = "Username is taken";
                                }
                            }
                        }).catch(function(error) {
                            console.log(error);
                        });
                    });
                }
            });
        });
    </script>
</body>

</html>