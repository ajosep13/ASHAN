<?php
$strr = "Hello Class. Today is great day. Today is sunny day";
//print_r(explode(".", $strr));

$image = "flower.jpg";
$fileExt = explode(".", $image);
print_r($fileExt);

if ($fileExt[1] == "jpg" || $fileExt[1] == "JPG"){
  echo "it is JPG file";
}else{
  echo "it is not a JPG file!";
}

 ?>
