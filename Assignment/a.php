<!-- Check If User (Username And Email) Exists In MySQL Database Using Ajax, Javascript, HTML And PHP Web Program XAMPP Localhost/Server (phpMyAdmin) -->
<!-- https://mauricemuteti.info/check-if-user-username-and-email-exists-in-mysql-database-using-ajax-javascript-html-and-php-web-program-xampp-localhost-server-phpmyadmin/ -->
<!DOCTYPE html>
<html>

<head>
    <title>Check If User (Username And Email) Exists In MySQL Database Using Ajax, Javascript, HTML And PHP Web Program XAMPP Localhost/Server (phpMyAdmin)</title>
</head>

<body>
    <div id="demo">
        <h2>Database Result Will Appear Here</h2>
    </div>

    <form action="signup_handler.php" name="signupform">
        <input type="text" name="uname" id="uname" required="" onkeyup="checkUname(this.value);">
        <input type="text" name="uemail" id="uemail" required="" onkeyup="checkEmail(this.value);">
        <!-- More fields go here -->
    </form>
    <script type="text/javascript">
        //Function for checking if username already exists in the database.
        function checkUname(uname) {
            var xhttp;
            if (uname != "") {
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("demo").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "actionpage.php?uname=" + uname + "&uemail=" + '', true);
                xhttp.send();
            }
        }
        //Function for checking if email already exists in the database.
        function checkEmail(email) {

            var xhttp;
            if (email != "") {
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("demo").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "actionpage.php?uname=" + '' + "&uemail=" + email, true);
                xhttp.send();
            }
        }
    </script>
</body>

</html>


<?php 
// Check If User (Username And Email) Exists In MySQL Database Using Ajax, Javascript, HTML And PHP Web Program XAMPP Localhost/Server (phpMyAdmin)
// https://mauricemuteti.info/check-if-user-username-and-email-exists-in-mysql-database-using-ajax-javascript-html-and-php-web-program-xampp-localhost-server-phpmyadmin/
 
include 'mysqldatabaseconnection.php';
    //Declaring Variables
    $name_error = "";
    $email_error = "";  
    $username = "";
    $email = "";
    //If username is set
    if (isset($_GET['uname'])) {
        $username = $_GET['uname'];
         
        $sql_u = "SELECT * FROM tabuser WHERE username='$username'";
         
        $res_u = mysqli_query($databaseConnection, $sql_u);
        //Check number of rows returned from database. 
        //If greater than zero means that username is already submitted/saved in mysql database.
        if (mysqli_num_rows($res_u) > 0) {
            $name_error = "This ". $username ." username is already taken";     
            echo " " . $name_error;
        }
    }
    //If email is set
    if (isset($_GET['uemail']) && $_GET['uemail'] != "") {
        $email = $_GET['uemail'];
         
        $sql_e = "SELECT * FROM tabuser WHERE email='$email'";
         
        $res_e = mysqli_query($databaseConnection, $sql_e);
        //Check number of rows returned from database. 
        //If greater than zero means that email is already submitted/saved in mysql database.
        if(mysqli_num_rows($res_e) > 0){
            $email_error = "This ". $email ." email is already taken";  
            echo " " . $email_error;
             
        }
    }