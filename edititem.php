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
 if (isset($_POST['submit'])){
    $course_id1=$_POST['id'];
    $tutorID = $_POST['tutorID'];
    $title = $_POST['title'];
    $categoryID = $_REQUEST['categoryID'];
    $numberOfAttendees = $_REQUEST['numberOfAttendees'];
    $image = $_REQUEST['image'];
    $shortdescription = $_REQUEST['shortdescription'];
    $description = $_REQUEST['description'];
    $link = $_REQUEST['link'];
    $fees = $_REQUEST['fees'];
    $currency = $_REQUEST['currency'];
    $starttime = $_REQUEST['starttime'];
    $endtime = $_REQUEST['endtime'];
    $date = $_REQUEST['date'];
    $update="update coursetable set title='".$title."',
    description='".$description."', time='".$starttime."',
    end_time='".$endtime."',
    Date='".$date."', short_desc='".$shortdescription."',
    currency='".$currency."', link='".$link."',
    fees='".$fees."'
    where courseID='".$course_id1."'";
       
    $query_emails = mysqli_query ($con, $update);
    }
?>
<html>
 <head>
    <title>Class Details</title>
    <link rel="stylesheet" href ="css/style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
 </head>
<body>
<button style="float:left;border-radius: 20px;padding: 14px 20px;background-color: rgb(77, 34, 34);"><a href="home.php" style="text-decoration:none;color:Burlywood">Back to home</a></button>
<div class="hot">
  <br/>
 <h1 id="vishead">Edit Class</h1>
 <br/><br/><br/><br/>
 <?php
    $result = mysqli_query($con,"SELECT * FROM coursetable where courseID='$course_id' ");
 ?>
  <div class="login-head" style="color:Black;"></div>
  <?php
   while($row = mysqli_fetch_array($result))
         {
         echo "<style> .desc{display=none;} </style> ";
         echo '<div id="formdiv">';
         echo '<form method="POST" action="edititem.php?courseid='.$course_id.' enctype="multipart/form-data">';
         echo "<input name='id' type='hidden' value=" . $row['courseID'] ." />";
         echo "<td><input  type='hidden' name='tutorID' value=" . $row['tutorID'] . "></td>";
         echo "<td><input  type='hidden' name='categoryID' value=" . $row['categoryID'] . "></td>";
         echo "<td><input  type='hidden' name='title' value=" . $row['title'] . "></td>";
         echo "<td><input  type='hidden' name='numberOfAttendees' value=" . $row['numberOfAttendees'] . "></td>";
         echo "<td><input  type='hidden' name='image' value=" . $row['image'] . "></td>";
         echo "<h3 style='font-size:40px;'> Topic -" . $row['title'] ."</h3>
                <table style='margin:auto;'>
                <tr>";
         echo "<tr>
                <th>Short Description</th>
                <td><input type='text' name='shortdescription' class='inputFields' value=" . $row['short_desc'] . "></td></tr>
                <th>Description</th>";
         echo "<td><textarea name='description' rows='5' cols='50'>". $row['description']."</textarea> </td></tr>";
         echo "<tr>
                <th>Link</th>
                <td><input type='text' name='link' class= 'profilefield' value=" . $row['link'] . "></td></tr>";
         echo "<tr>
                <th>Fees</th>
                <td><input type='text' name='fees' class= 'inputfield' value=" . $row['fees'] . "></td></tr>";
         echo "<tr>
                <th>Currency</th>
                <td><select name='currency' class= 'inputfield'>
                <option value=".$row['currency']. " selected>".$row['currency']. "</option>";
                $result = mysqli_query($con,"SELECT * FROM currency ORDER BY currency ASC");
                while($row1 = mysqli_fetch_assoc($result)){
                echo "<option value=".$row1['code'].">".$row1['currency']."(".$row1['country'].")</option>";
                }
         echo "<tr>
                <th>Start time</th>
                <td><input type='time' name='starttime' id='time' class='inputFields' value=" . $row['time'] . "></td></tr>";
         echo "<tr>
                <th>End time</th>
                <td><input type='time' name='endtime' id='time' class='inputFields' value=" . $row['end_time'] . "></td></tr>";
         echo "<tr>
                <th>Date</th>
                <td><input type='date' name='date' class='inputFields' value=" . $row['Date'] . "></td></tr>";
         echo '<input type="submit" name="submit" class="theButtons" value="Edit"><br/><br/>';
         }
        ?>
        <div class="login">
               <button style="float:left;"><a href="home.php" style="text:decoration:none;color:Burlywood">Back to home</a></button>
        </div>
  </div>
</body>
</html>
