<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();

// Check if we got the field from the user
if (isset($_GET['busid']) && isset($_GET['town']) && isset($_GET['checked'])) {

    $busid = $_GET['busid'];
    $town= $_GET['town'];
    $checked= $_GET['checked'];


    // Include data base connect class
	$filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

	// Connecting to database
    $db = new DB_CONNECT();

	// Fire SQL query to update details data by id
    $result = mysql_query("UPDATE $town SET checked= $checked WHERE busid = '$busid'");

    // Check for succesfull execution of query and no results found
    if ($result) {
        // successfully updation of busid (temperature)
        $response["success"] = 1;
        $response["message"] = "checked successfully updatedto 0";

        // Show JSON response
        echo json_encode($response);
    } else {

    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";

    // Show JSON response
    echo json_encode($response);
}
?>
