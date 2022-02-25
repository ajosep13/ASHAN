 <?php

include("connect.php");
include("functions.php");
$error = "";
if(isset($_POST['submit'])){
  $toemail = $_POST['mail'];  
  $subject = "change password";
  $body = "Hello $toemail,please click the link to change your password http://localhost/webproject/webproject/changepassword.php?email=$toemail";
  $headers = "From: saneesh4239@gmail.com";    
    $query_emails = mysqli_query ($con, "SELECT * FROM users WHERE email = '$toemail'");
    $numEmail = mysqli_num_rows ($query_emails);
    if($numEmail==0){
        $error= "user doesn't exist";
    }
    else if (mail($toemail, $subject, $body, $headers)){
        $error= "Email successfully sent to $toemail";
    }else{
        $error = "Email sending failed ....";
    }
}
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
            <h1 id='fline'>Forget Password</h1>
        </div>
        <form method="POST" action="forgetpassword.php" enctype="multipart/form-data">
          <label>Email: </label><br/>
          <input type="text" name="mail" class="inputFields" required/><br/><br/>
          <br/><button style="float:right;border-radius: 20px;padding: 14px 20px;background-color: rgb(77, 34, 34);"><a href="index.php" style="text-decoration:none;color:Burlywood">Back to home</a></button>
          <input type="submit" name="submit" class="theButtons" value="Submit"/><br/>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
