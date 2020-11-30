<?php
  include 'database.php';

  date_default_timezone_set("Asia/Colombo");

  $rootno=$_POST['rootno'];
  $userlocation=$_POST['userlocation'];
  $direction=$_POST['direction'];

  if ($direction=="Colombo") {
    $res="?town=beragala&";
    $sql="SELECT busid FROM beragala WHERE checked='1'";
    $result=$conn->query($sql);
    while($raw=$result->fetch_assoc()){
      static $i=1;
      //echo $raw['busid'];
      $res.="busid";
      $res.=$i;
      $res.="=";
      $res.=$raw['busid'];
      $res.="&";
      $i+=1;
    }
    header("Location:../Home.php{$res}");
    //echo $res;
  }
  if ($direction=="Badulla") {
    $res="?town=balangoda&";
    $sql="SELECT busid FROM balangoda WHERE checked='1'";
    $result=$conn->query($sql);
    while($raw=$result->fetch_assoc()){
      //echo $raw['busid'];
      static $i=1;
      $res.="busid";
      $res.=$i;
      $res.="=";
      $res.=$raw['busid'];
      $res.="&";
      $i+=1;
    }
    header("Location:../Home.php{$res}");
    //echo $res;
  }

  //echo $userName,$password;
  //header("Location: ../thedeck.php");
