<?php
function email_exists($email, $con)
{
  $rsEmails = mysqli_query($con, "Select * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($rsEmails) == 1){
      return true;
    }else {
      return false;
    }
}

function logged_in()
{
  if(isset($_SESSION['email'])){
    return true;
  }
  else{
    return false;
  }
}
?>
