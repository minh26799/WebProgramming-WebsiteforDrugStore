<?php
include "database.php";
include "function.php";

if(isset($_POST['username'])&&isset($_POST['email'])
&&isset($_POST['password'])&&isset($_POST['password2']))
{
    // Compulsory information
    $Username = validate($_POST['username']);
    $Password = validate($_POST['password']);
    $Password2 = validate($_POST['password2']);
    $Email = validate($_POST['email']);

    // Optional information
    $Firstname = isset($_POST['firstname']) ? validate($_POST['firstname']) : "NULL";
    $Lastname = isset($_POST['lastname']) ? validate($_POST['lastname']) : "NULL";
    $phone = isset($_POST['phone']) ? validate($_POST['phone']) : "NULL";

    if(preg_match("^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$",$Username))
    {

    }

}

?>