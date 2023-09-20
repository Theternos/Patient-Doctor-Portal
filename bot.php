<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the query from the POST request
    $query = $_POST["query"];

    // Call your Python script (bot.py) with the query and capture the response
    $command = "python ./python/bot.py " . escapeshellarg($query);
    $response = shell_exec($command);

    // Attempt to decode the JSON response
    $jsonResponse = json_decode($response, true);

    // Check if decoding was successful and response is an array
    if (is_array($jsonResponse)) {
        // Extract the first data item from the array
        $firstDataItem = reset($jsonResponse);

        // Prepare JSON response with the first data item
        $response_data = ["text" => $firstDataItem];
    } else {
        // If the response is not a valid JSON array, return an error message
        $response_data = ["text" => "Error: Invalid response from bot.py"];
    }

    // Send the response as JSON
    header("Content-type: application/json");
    echo json_encode($response_data);
}
