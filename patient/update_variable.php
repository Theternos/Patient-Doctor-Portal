<?php
$selectedValue = $_GET["selectedValue"];
$index = $_GET["index"]; // Get the unique identifier for this row

// Update the PHP variable based on the selected value
$selectedVariable = "";

// Update the PHP variable based on the selected value
if ($selectedValue === "Video Consultancy") {
    $selectedVariable = "250";
} else {
    $selectedVariable = "100";
}

$selectedVariables = array(); // Assuming you have the array of selected variables for each row
$selectedVariables[$index] = $selectedVariable; // Update the selected variable for the specific row

// Return the updated selected variable for the row
echo $selectedVariables[$index];

// Update the $mode variable with the selected value
$mode = $selectedValue;
