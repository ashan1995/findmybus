<?php

return $conn = mysqli_connect('localhost','id3789153_findmybus','findmybus12345','id3789153_findmybus');

if (!$conn) {
  die("Connection Failed : " . mysqli_connect_error());
}
