<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();

// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");

 // Connecting to database
$db = new DB_CONNECT();

// Check if we got the field from the user
if (isset($_GET["id"])) {
    $id = $_GET['id'];

     // Fire SQL query to get details data by id
    $result = mysql_query("SELECT *FROM details WHERE id = '$id'");

	//If returned result is not empty
    if (!empty($result)) {

        // Check for succesfull execution of query and no results found
        if (mysql_num_rows($result) > 0) {

			// Storing the returned array in response
            $result = mysql_fetch_array($result);

			// busideroary user array
            $details = array();
            $details["id"] = $result["id"];
            $details["busid"] = $result["busid"];
			$details["location"] = $result["location"];

            $response["success"] = 1;

            $response["details"] = array();

			// Push all the items
            array_push($response["details"], $details);

            // Show JSON response
            echo json_encode($response);
        } else {
            // If no data is found
            $response["success"] = 0;
            $response["message"] = "No data on details found";

            // Show JSON response
            echo json_encode($response);
        }
    } else {
        // If no data is found
        $response["success"] = 0;
        $response["message"] = "No data on details found";

        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";

    // echoing JSON response
    echo json_encode($response);
}
?>
