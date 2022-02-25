<?php $course_id= $_GET['courseid']; ?>
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
    $crs=$con->query("select * from coursetable where courseID='".$courseID."'");
    $cour = mysqli_fetch_assoc($crs);
    $number=$cour['numberOfAttendees']+1;
    $q2=$userid=$con->query("select COUNT(*) from attendeestable where courseID='".$courseID."' AND id='".$id."'");
    $c = mysqli_fetch_assoc($q2);
    $count=$c['COUNT(*)'];
    if($count==0){
    $update = $con->query("update coursetable set numberOfAttendees='".$number."' where courseID='".$courseID."'");
    $insert = $con->query("insert into attendeestable (`courseID`,`id`) values ('$courseID','$id')");

          if($insert)
          {
            $statusMsg = "Course added successfully.";
          }
          else
          {
            $statusMsg = "Couldn't join the course, please try again.";
          } 
          $error= "Joined for the course successfully";
  }}
  if (isset($_POST['one'])){
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

    <!-- Grid start-->
    <!-- <div id="grid">

      <div class="grid_row_1"> -->
        <div style="margin:auto;">
        <br><h1 id="vishead">About this course</h1><br>
        <?php
        $result = mysqli_query($con,"SELECT * FROM coursetable where courseID='$course_id' ");
        $row = mysqli_fetch_array($result);         
        $findtutor=$con->query("select * from users where userID='".$row['tutorID']."'");
        $tutor = mysqli_fetch_assoc($findtutor);
        $tutorname=$tutor['firstName'];
        $courseid=$row['courseID']; 
	    	echo "<img src='uploads/".$row['image']."' style='width: 50%; height:auto;border-radius:15px;'>";
        echo "<div style='float:right;width:40%'>";
        if($row['fees']>0.0){
        echo "<br/><br><br><span class='logo_letter' style='font-size:20px;'>Paid Course</span>";    
        }
          echo "<h3 style='font-size:40px;'> Topic -" . $row['title'] ."</h3>";
          echo "<p class='course-price' style='font-size:40px;'>Fees -". $row['fees'] ." ".$row['currency']. "</p>";
          echo "<p class='course-detail'> Date -".$row['Date']."</p>";
          echo "<p class='course-detail'> Time - ".$row['time']." to ".$row['end_time']."</p>";
          echo "<p class='course-detail'>Class by -$tutorname</p>";          
          echo "<br>";
          $userid=$con->query("select * from users where email='".$_SESSION['email']."'");
          $user = mysqli_fetch_assoc($userid);
          $id=$user['userID'];
          $counting=$con->query("select COUNT(*), attended from attendeestable where courseID='".$row['courseID']."' AND id='".$id."'");
          $c = mysqli_fetch_assoc($counting);
          $count=$c['COUNT(*)'];
          $attended=$c["attended"];
          if($row['tutorID']==$id)
          {
            echo "<a href='attendance.php?courseid=".$courseid."'><button class='single_course_btn'style='background-color:black;color:white;'>Mark Attendance</button></a>";
             echo "<a href='edititem.php?courseid=".$courseid."'><button class='single_course_btn' style='background-color:tomato;color:black;'>Edit</button></a>";
          }
          elseif($attended==1)
          {
            echo '<form method="POST" action="certificate.php" enctype="multipart/form-data">';
          echo "<input name='id' type='hidden' value=" . $row['courseID'] ." />";
          echo "<input type='submit' id='pdf' name='pdf' value='Certificate' class='single_course_btn' style='background-color:black;color:white;'>";
          echo '</form>';
          // One on One

          echo '<form method="POST" action="oneonone.php" enctype="multipart/form-data">';
          echo "<input name='id' type='hidden' value=" . $row['courseID'] ." />
                <input name='tid' type='hidden' value='".$row['tutorID']."' />";
          echo "<input type='submit' id='one' name='one' value='Ask for help' class='single_course_btn' style='background-color:black;color:white;'>";
          echo '</form>';
          }
          else if($row['courseID']!=$id && $count==0)
          {
          echo '<form method="POST" action="class.php?courseid='.$courseid.'" enctype="multipart/form-data">';
          echo "<input name='id' type='hidden' value=" . $row['courseID'] ." />";
          echo "<input type='submit' id='Join' name='Join' value='Join Now' class='single_course_btn' style='background-color:black;color:white;'>";
          echo '</form>';
          }
          else if(date("Y-m-d")<=$row['Date'])
          {
          $link = $row['link'];
            echo "<button class='single_course_btn'style='background-color:black;color:white;'><a href='$link 'target='_blank' style='text-decoration:none;color:white;'>Attend</a></button>";
            echo "<a href='home.php' style='text-decoration:none;'><button class='single_course_btn' style='background-color:tomato;color:black;'>Cancel</button></a>";
          }
          echo "</div><br>";
          echo "<h4>Description about ".$row['title']." </h4><p class='hide'>".$row['description']."</p>";
        

        ?>
      <!-- </div>
  </div> -->
  <!-- Grid end -->
        </div>
  </body>
      
</html>
