<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// SSH connection parameters
$ssh_hostname = '10.10.237.155';
$ssh_port = 33;
$ssh_username = 'root';
$ssh_password = 'Root@321';

// MySQL connection parameters
$mysql_hostname = '127.0.0.1';
$mysql_port = 3307;
$mysql_username = 'root';
$mysql_password = 'ternos';

// Create an SSH tunnel using Plink
$plink_command = "plink -ssh -L $mysql_port:$mysql_hostname:$mysql_port -P $ssh_port $ssh_username@$ssh_hostname -pw $ssh_password";
$return_value = null;
echo $plink_command;
exec($plink_command, $output, $return_value);

if ($return_value === 0) {
    echo  "<br>" . "SSH tunnel established successfully." . "<br>";
} else {
    echo "SSH tunnel failed to establish. Error code: $return_value";
    exit;
}

// $host = "127.0.0.1";
// $port = 3307;
// $user = "root";
// $password = "ternos";
// $dbname = "peas";

// $con = new mysqli($host, $user, $password, $dbname, $port)
//     or die('Could not connect to the database server' . mysqli_connect_error());

//$con->close();

$host = "localhost";
$port = 3307;
$user = "peas";
$password = "ternos";
$dbname = "peas";
try {

    $conn = new PDO("mysql:host=localhost;port=3307;dbname=peas", 'peas', 'ternos');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Your SQL query
    $query = "SELECT * FROM admin";

    // Execute the query
    $result = $conn->query($query);

    // Check if the query executed successfully
    if ($result) {
        // Fetch and display the results
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Process each row of data here
            print_r($row); // This will print the row as an associative array
        }
    } else {
        echo "Query failed.";
    }

    // Close the connection
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// Close the MySQL connection
$conn = null;
