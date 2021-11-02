<?php
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function checkUppercase($string)
{
    $strArray = str_split($string);
    foreach ($strArray as $value) {
        if (ord($value) >= ord('A') && ord($value) <= ord('Z')) {
            return false;
        }
    }
    return true;
}
function checkBlank($string)
{
    $count = 0;
    $strArray = str_split($string);
    foreach ($strArray as $value) {
        if ($value === ' ') {
            $count++;
        }
    }
    return $count >= 2;
}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>