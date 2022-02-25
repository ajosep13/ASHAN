<?php

#https://www.w3schools.com/php/func_mysqli_connect.asp
$con = mysqli_connect("localhost","root","","ashan");

if(mysqli_connect_errno()){
  echo "error occured while connecting with database".mysqli_connect_errno();
}

session_start();
?>
