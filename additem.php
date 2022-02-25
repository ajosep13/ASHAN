<?php

	include("connect.php");
	include("functions.php");
	if(logged_in())
	{
?>
<?php
	}
	else
	{
		header("location:login.php");
		exit();
	}
  if(isset($_POST['submit']) && $_POST['new']==1)
  {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(!empty($_FILES["file"]["name"]))
    {
      $allowTypes = array('jpg','png','jpeg','gif','pdf');
      if(in_array($fileType, $allowTypes))
      {
        $title = $_POST['title'];
        $category =$_REQUEST['category'];
        $fees = $_REQUEST['fees'];
        $currency = $_REQUEST['currency'];
        $date = $_REQUEST['date'];
        $time=$_REQUEST['time'];
        $end_time=$_REQUEST['e_time'];
        $short_desc=$_REQUEST['short'];
        $description=$_POST['description'];
        $findtutor=$con->query("select * from users where email='".$_SESSION['email']."'");
        $tutor = mysqli_fetch_assoc($findtutor);
        $tutorid=$tutor['userID'];
        $date=date('Y-m-d', strtotime($date));
        $link=$_REQUEST['link'];
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath))
        {
           $insert = $con->query("insert into coursetable (`title`,`fees`,`currency`,`time`,`end_time`,`Date`,`image`,`short_desc`,`description`,`tutorID`,`categoryID`,`link`) values ('$title','$fees',' $currency','$time','$end_time','$date','$fileName','$short_desc','$description','$tutorid','$category','$link')");

          if($insert)
          {
            $statusMsg = "The item added successfully.";
          }
          else
          {
            $statusMsg = "File upload failed, please try again.";
          } 
          
        }
    }
    else
    {
      $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.'; 
    }
  }
  else
  {
      $statusMsg = 'Please select a file to upload.';
  }
}
$categorylist = mysqli_query($con,"SELECT * FROM categorytable");
?>

<html>
<head>
    <title>ASHAN</title>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
  </head>
  <body>
  <header>
        <!--To set a simple logo for the website which can be seen in menubar. It is created using svg file-->
          <div class="menu_lside">
           <span class="logo"><a href="home.php"  style="color:white;text-decoration:none;"><span class="logo_letter">A</span>SH<span class="logo_letter">A</span>N</a></span>
           <span class="menu_item"> 
             <a href="calendar.php">Calendar</a>  
            <a href="attend.php">Class joined</a>
            <a href="additem.php">New class</a>
            <a href="course-completed.php">Course completed</a>
            <a href="tutorview.php">Class Tutoring</a>
           </span>
          </div>
          <div class="menu_rside">
            <form action="profile.php" method="POST" class="menu_button">
                <input type="submit" value="Profile" class="sub_btn" style="background-color:white;"/>
            </form>
            <form action="logout.php" method="POST" class="menu_button">
                <input type="submit" value="Log Out" class="sub_btn" style="background-color:tomato;"/>
            </form>
          </div>
        </header>
        <br>

  <div id="wrapper">
    <div class="logind">
      <div id="formdiv">
        <div id="error"  style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> "><?php echo $error; ?></div>
        <div class="login-head">
          <h1 id='fline'>About My Class</h1>
        </div>
        <form method="POST" action="additem.php" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1" />
            <label>Title: </label><br/>
            <input type="text" name="title" class="inputFields" required/><br/><br/>
            <label>Category: </label><br/>
            <select name="category" class="inputFields">
            <option value="" disabled selected>Select the category</option>
            <?php 
            $result = mysqli_query($con,"SELECT * FROM categorytable ORDER BY categoryName ASC");
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<option value=".$row['categoryID'].">".$row['categoryName']."</option>";
            }
            ?>
            </select><br/><br/>
            <label>Fees: </label><br/>
            <input type="text" name="fees" class="inputFields" required/><br/><br/><br/>
            <label>Currency: </label><br/>
            <select name="currency" class="inputFields" required>
              <option value="" disabled selected>Select currency</option>
              <?php 
              $result = mysqli_query($con,"SELECT * FROM currency ORDER BY currency ASC");
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<option value=".$row['code'].">".$row['currency']."(".$row['country'].")</option>";
              }
              ?>
            </select><br/><br/>
            <label for="time">Start time: </label> 
            <input type="time" name="time" id="time" class="inputFields" required/><br/><br/><br/>
            <label for="e_time">End time: </label>
            <input type="time" name="e_time" id="e_time" class="inputFields" required/><br/><br/><br/>
            <label>Date: </label><br/>
            <input type="date" name="date" class="inputFields" required/><br/><br/><br/>
            <label>Short Description: </label><br/>
            <input type="text" name="short" class="inputFields" required/><br/><br/><br/>
            <label>Paste your class link here: </label><br/>
            <input type="text" name="link" class="inputFields" required/><br/><br/><br/>
            <label>Description: </label><br/>
            <textarea name="description" rows="5" cols="50"></textarea> <br/><br/><br/>
            <label>Images: </label><br/>
            <input type="file" name="file"><br/><br/>
            <input type="submit" name="submit" class="theButtons" value="Submit"/><br/><br/>
            <br/><br/>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
