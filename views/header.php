<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .container{
                width: 100%;
                background-color: #ffffff;
            }
            .container-fluid{
                display: flex;
                width: 100%;
                justify-content: space-between;
                align-items: center;
            }
            .navbar-brand{
                padding: 0px;
            }
            .logo {
                height: 100%
            }
            
            .navbar-form.navbar-left{
                display: flex;
                justify-content: center;
                width: 50%;
            }
            .navbar.lower{
                background-color: #1b74e7;
            }
            
            .navbar.lower ul.nav a {
                color:  #ffffff;
            }
            .navbar.lower ul.nav a:hover{
                background-color:  #ffffff;
                color:  #000000;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default upper">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img class="logo" alt="Brand" src="../assets/images/HCMUT_logo.png">
                    </a>
                    <form class="navbar-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                    <ul class="nav navbar-nav">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Login</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-defalut lower">
                <div class="container-fluid">
                    
                    <ul class="nav navbar-nav right">
                        <li><a href="#">SHOP</a></li>
                        <li><a href="#">ABOUT US</a></li>
                        <li></li>
                    </ul>
                    <ul class="nav navbar-nav left">
                        <li><a href="#">FIND A PHARMACY NEAR YOU</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-earphone"></span>Contact: 0123456789</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </body>
</html>