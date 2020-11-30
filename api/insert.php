<?php

date_default_timezone_set("Asia/Colombo");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();

// Check if we got the field from the user
if (isset($_GET['busid']) && isset($_GET['town'])) {

    $busid = $_GET['busid'];
    $town = $_GET['town'];

    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");


    // Connecting to database
    $db = new DB_CONNECT();

    // Fire SQL query to insert data in weather
    $t=date("H:i:sa");
    $result = mysql_query("INSERT INTO $town(busid,chtime,checked) VALUES('$busid','$t','1')");

    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted
        $response["success"] = 1;
        $response["message"] = "record successfully created.";

        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";

        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";

    // Show JSON response
    echo json_encode($response);
}
?>
