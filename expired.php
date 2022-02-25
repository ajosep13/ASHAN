<?php 
while($row = mysqli_fetch_array($result))
{
  if(date("Y-m-d")>$row['Date'])
  {
  //if((date("Y-m-d")==$row['Date']) && timeparameter){}
  $findtutor=$con->query("select * from users where userID='".$row['tutorID']."'");
  $tutor = mysqli_fetch_assoc($findtutor);
  $tutorname=$tutor['firstName'];
  $courseid=$row['courseID'];
  echo '<a href="class.php?courseid='.$courseid.'">';
  echo '<div class="course-display-box">';
          echo "<div class='course-display-img'><img src='uploads/".$row['image']."' style='width: 197px; height: 120px;border-radius:15px;'></div>";
  echo " <div class='course-display-desc'>";
  if($row['fees']>0.0){
  echo "<br/><br><br><span class='logo_letter'>$</span>";    
  }
  echo "<h4>" . $row['title'] ."</h4>";
  // echo "<p class='course-price'>". $row['fees'] ." ".$row['currency']. "</p>";
  echo "<p class='course-detail'> On ".$row['Date']."</p>";
  echo "<p class='course-detail'>by <I>$tutorname</I></p>";
  // echo "<p class='hide'>".$row['description']."</p>";
  echo "<br>";
  $userid=$con->query("select * from users where email='".$_SESSION['email']."'");
  $user = mysqli_fetch_assoc($userid);
  $id=$user['userID'];
  $counting=$con->query("select COUNT(*) from attendeestable where courseID='".$row['courseID']."' AND id='".$id."'");
  $c = mysqli_fetch_assoc($counting);
  $count=$c['COUNT(*)'];
  if($count==0)
  {
  echo '<form method="POST" action="class.php?courseid='.$courseid.'" enctype="multipart/form-data">';
  echo "<input name='id' type='hidden' value=" . $row['courseID'] ." />";
  echo "<input type='submit' id='More' name='More' value='More Details' style='width: 100px;background-color:black;color:white;'>";
  echo '</form>';
  }
  else
  {
    echo "<button style='width: 100px;background-color:green;color:black;'>Joined</button><br><br><br><br><br>";
  }
echo "</div>
</div></a>";
}}
?>