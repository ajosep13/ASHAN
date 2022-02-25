<?php
include("connect.php");
include("functions.php");
$error = "";
if(isset($_POST['submit'])){
  $New_password = $_POST['password'];
  $New_confirmPassword = $_POST['passwordConfirm'];

  if (strlen($New_password) < 5){
    $error = "Passwrod must be greater than five characters";
  }
  //compare password
  else if ($New_password !== $New_confirmPassword ){
    $error = "Password does not match!";
  }
  else {
    //$New_password = md5($New_password);
    $New_password = password_hash($New_password, PASSWORD_DEFAULT);
    //make update statement
    $email = $_SESSION['email'];
    if (mysqli_query($con, "UPDATE users SET password='$New_password' where email='$email'")){
      $error="Password changed successfully, <a href='profile.php'>Click here</a> to go to the profile";
    }
  }
}
if(logged_in())
{
 ?>

<html>
<head>
  <title>Dynamic Website</title>
  <link rel="stylesheet" href="css/style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
</head>
<body>
  <div id="wrapper">
    <div class="logind">
      <div id="formdiv">
        <div id="error"  style=" <?php  if($error !=""){ ?>  display:block; width:100%; <?php } ?> "><?php echo $error; ?></div>
        <div class="login-head">
          <form method="POST" action="changep.php">
              <label>New Password: </label><br/>
              <input type="password" name="password"/><br/><br/>
              <label>Re-enter Password: </label><br/>
              <input type="password" name="passwordConfirm"/><br/><br/>
              <button style="float:right;border-radius: 20px;padding: 14px 20px;background-color: rgb(77, 34, 34);"><a href="profile.php" style="text-decoration:none;color:Burlywood">Back to home</a></button>
              <input type="submit" name="submit" value="Save"/><br/>
            </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
}else {
  header("location: index.php");
}
?>
