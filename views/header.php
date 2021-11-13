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
        .search-box{
        width: 500px;
        position: relative;
        display: inline-block;
        font-size: 14px;
        }
        .search-box input[type="text"]{
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }
        .result{
            position: absolute;        
            z-index: 999;
            top: 100%;
            left: 0;
            background: #ffffff;
        }
        .search-box input[type="text"], .result{
            width: 100%;
            box-sizing: border-box;
        }

        .result form{
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }
        .result form:hover{
            background: #f2f2f2;
        }
        .result div div{
            padding: 2px 2px 2px 2px ;
        }
        </style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("../controllers/search.controller.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
    </head>
    <body>

        <div class="container">
            <nav class="navbar navbar-default upper">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./home">
                        <img class="logo" alt="Brand" src="../assets/icons/HCMUT_logo.png">
                    </a>
                    <form class="navbar-form">
                        <div class="form-group">
                            <div class="search-box">
                                <input type="text" autocomplete="off" placeholder="Search products" />
                                <div class="result"></div>
                            </div>
                        </div>
                        <!-- <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button> -->
                    </form>
                    <ul class="nav navbar-nav">
                        <li><a href="./login"> <span class="glyphicon glyphicon-user"></span> <?php if(isset($_SESSION['fullname'])) {echo $_SESSION['fullname'];} else {echo "Login";} ?></a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                        <?php 
                            if(isset($_SESSION['fullname'])){ ?>
                                <li><a href="../controllers/logout.php">Logout</a></li>
                        <?php } ?>
                        
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-defalut lower">
                <div class="container-fluid">
                    
                    <ul class="nav navbar-nav right">
                        <li><a href="./home">SHOP</a></li>
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