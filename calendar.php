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
  if (isset($_POST['Join'])){
    $courseID=$_POST['id'];
    $userid=$con->query("select * from users where email='".$_SESSION['email']."'");
    $user = mysqli_fetch_assoc($userid);
    $id=$user['userID'];
    $insert = $con->query("insert into attendeestable (`courseID`,`id`) values ('$courseID','$id')");

          if($insert)
          {
            $statusMsg = "Course added successfully.";
          }
          else
          {
            $statusMsg = "Couldn't join the course, please try again.";
          } 
          echo "Joined for the course successfully";
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
        <br><h1 id="vishead">Your Schedule</h1><hr><br>
        <?php
          $userid=$con->query("select * from users where email='".$_SESSION['email']."'");
          $user = mysqli_fetch_assoc($userid);
          $id=$user['userID'];
          $course=$con->query("select courseID from attendeestable where id='".$id."'");
          while($c = mysqli_fetch_array($course))
          {
            $course_id=$c['courseID'];
            $result = mysqli_query($con,"SELECT * FROM coursetable where courseID='".$course_id."' ORDER BY Date");
            echo '<section class="course-display">
        <div class="container">';
        while($row = mysqli_fetch_array($result))
        {
           $df=date("F");

          if(date("Y-m-d")<=$row['Date'])
          {
          //if((date("Y-m-d")==$row['Date']) && timeparameter){}
          $findtutor=$con->query("select * from users where userID='".$row['tutorID']."'");
          $tutor = mysqli_fetch_assoc($findtutor);
          $tutorname=$tutor['firstName'];
          $courseid=$row['courseID'];
          echo '<a href="class.php?courseid='.$courseid.'">';
          echo '<div class="course-display-box">';
          echo " <div class='course-display-desc'>
          <h4>" . $row['title'] ."</h4>";
          // echo "<p class='course-price'>". $row['fees'] ." ".$row['currency']. "</p>";
          echo "<p class='course-detail'> On ".$row['Date']."</p>";
          echo "<p class='course-detail'>by <I>$tutorname</I></p>";
          // echo "<p class='hide'>".$row['description']."</p>";
          echo "<br>";
          
     
     echo "</div>
  </div></a>";
        }}
        echo "</div></section>";
      }
        ?>
      </div>
    </div>
   
  
  </body>
</html>
