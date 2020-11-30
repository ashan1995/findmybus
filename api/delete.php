<?php

header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

include "../PHP/database.php";

//Creating Array for JSON response
$response = array();



// Check if we got the field from the user
if (isset($_GET['busid'])) {
    $busid = $_GET['busid'];
    
    $sql="SELECT id FROM balangoda WHERE busid='$busid'";
$result=$conn->query($sql);
$raw=$result->fetch_assoc();
$id1=$raw['id'];


$sql="SELECT id FROM beragala WHERE busid='$busid'";
$result=$conn->query($sql);
$raw=$result->fetch_assoc();
$id3=$raw['id'];

if(isset($id1)&&isset($id3)){
    

    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

    // Connecting to database
    $db = new DB_CONNECT();

    // Fire SQL query to delete weather data by id
    $result = mysql_query("DELETE FROM balangoda WHERE busid = '$busid'");

    // Check for succesfull execution of query
    if (mysql_affected_rows() > 0) {
        // successfully deleted
        $response["success"] = 1;
        $response["message"] = "Data successfully deleted";

        // Show JSON response
        echo json_encode($response);
    } else {
        // no matched id found
        $response["success"] = 0;
        $response["message"] = "No busid found by given id";

        // Echo the failed response
        echo json_encode($response);
    }
    // Fire SQL query to delete weather data by id
    $result = mysql_query("DELETE FROM beragala WHERE busid = '$busid'");

    // Check for succesfull execution of query
    if (mysql_affected_rows() > 0) {
        // successfully deleted
        $response["success"] = 1;
        $response["message"] = "Data successfully deleted";

        // Show JSON response
        echo json_encode($response);
    } else {
        // no matched id found
        $response["success"] = 0;
        $response["message"] = "No busid found by given id";

        // Echo the failed response
        echo json_encode($response);
    }
    // Fire SQL query to delete weather data by id
    $result = mysql_query("DELETE FROM pambahinna WHERE busid = '$busid'");

    // Check for succesfull execution of query
    if (mysql_affected_rows() > 0) {
        // successfully deleted
        $response["success"] = 1;
        $response["message"] = "Data successfully deleted";

        // Show JSON response
        echo json_encode($response);
    } else {
        // no matched id found
        $response["success"] = 0;
        $response["message"] = "No busid found by given id";

        // Echo the failed response
        echo json_encode($response);
    }
    
    }else{
        $response["success"] = 0;
        $response["message"] = "No matching content found by given id";

        // Echo the failed response
        echo json_encode($response);
    }
} 

else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";

    // Show JSON response
    echo json_encode($response);
}
?>
