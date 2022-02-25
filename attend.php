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
      <div class="home_grid">
        <div class="home_grid_row_1"></div>
    <div class="home_grid_row_2">
        <br><h1 id="vishead">Classes Joined</h1><hr><br>
        <?php
          $userid=$con->query("select * from users where email='".$_SESSION['email']."'");
          $user = mysqli_fetch_assoc($userid);
          $id=$user['userID'];
          $course=$con->query("select courseID from attendeestable where id='".$id."'");
          while($c = mysqli_fetch_array($course))
          {
            $course_id=$c['courseID'];
            $result = mysqli_query($con,"SELECT * FROM coursetable where courseID='".$course_id."'");
            echo '<section class="course-display">
        <div class="container">';
        include("home_display.php");
            echo "</div></section>";
          }
          ?>
          <!-- ------------------------ -->
        </div>
      <!-- expired -->

<!-- 
      $userid=$con->query("select * from users where email='".$_SESSION['email']."'");
          $user = mysqli_fetch_assoc($userid);
          $id=$user['userID'];
          $course=$con->query("select courseID from attendeestable where id='".$id."'");
          while($c = mysqli_fetch_array($course))
          {
            $course_id=$c['courseID'];
            $result = mysqli_query($con,"SELECT * FROM coursetable where courseID='".$course_id."'"); -->
    <div class="home_grid_row_3">
    <br><h1 id="vishead">Classes Expired</h1><hr><br>
        <?php
        $course=$con->query("SELECT a.userID, a.email, b.id, b.courseID as courseID FROM users a, attendeestable b where a.email='".$_SESSION['email']."' AND b.id=a.userID LIMIT 4");
        while($c = mysqli_fetch_array($course))
        {
          $course_id=$c['courseID'];
          $result = mysqli_query($con,"SELECT * FROM coursetable where courseID='".$course_id."' ORDER BY STR_TO_DATE(Date,'%Y-%m-%d') ASC");
          echo '<section class="course-display">
      <div class="container">';
      include("expired.php");
          echo "</div></section>";
        }
        ?>
      </div>
      </div>
  </body>
</html>
