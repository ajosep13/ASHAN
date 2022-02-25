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
  if (isset($_POST['submit_button'])){
    $attendee_array = $_POST['attendee'];
    foreach($attendee_array as $name=>$val){
      //$val needs to be 0 or 1.
      $val = ($val == "1")?1:0;
      $insert = $con->query("update attendeestable set attended='1' where attendeeID='".$name."'");
    }
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
        <br><h1 id="vishead">Attendance</h1><hr><br>
        <?php
        $result = mysqli_query($con,"SELECT * FROM attendeestable where courseID='$course_id' ");
        echo "<form action='attendance.php?courseid=".$course_id."' method='post'>";
        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Attendance</th>
                </tr>";
        while($row = mysqli_fetch_array($result))
        {       
        $findatt=$con->query("select * from users where userID='".$row['id']."'");
        $att = mysqli_fetch_assoc($findatt);
        $f_name=$att['firstName'];
        $l_name=$att['lastName'];
        echo "<tr>
                <td>$f_name $l_name</td>
                <td><input type='checkbox' name='attendee[".$row['attendeeID']."] value='1''/></td>
              </tr>";
        }

        
        echo "<tr><td></td><td><input type='submit' value='Submit' name='submit_button' style='background-color:black;color:white;' /></td> </tr>";
        echo "</form>";
        echo "</table>";
        ?>
      <!-- </div>
  </div> -->
  <!-- Grid end -->
        </div>
  </body>
      
</html>
