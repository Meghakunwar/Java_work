<?php
// Database connection credentials
$servername = "localhost";  // Change as per your database setup
$username = "username";     // Change to your database username
$password = "password";     // Change to your database password
$dbname = "pg_management";  // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data from the database
function fetchData($conn) {
    $data = array();

    // Example query to fetch total and available rooms for each PG type
    $sql = "SELECT pg_type, SUM(total_rooms) AS total_rooms, SUM(available_rooms) AS available_rooms FROM pg_details GROUP BY pg_type";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pg_type = $row['pg_type'];
            $data[$pg_type]['total_rooms'] = $row['total_rooms'];
            $data[$pg_type]['available_rooms'] = $row['available_rooms'];
        }
    }

    // Example query to fetch notifications
    $sql_notifications = "SELECT date, message FROM notifications ORDER BY date DESC LIMIT 5";
    $result_notifications = $conn->query($sql_notifications);

    $notifications = array();
    if ($result_notifications->num_rows > 0) {
        while ($row = $result_notifications->fetch_assoc()) {
            $notifications[] = array(
                'date' => $row['date'],
                'message' => $row['message']
            );
        }
    }

    // Prepare final data to return
    $final_data = array(
        'pg_details' => $data,
        'notifications' => $notifications
    );

    return $final_data;
}

// Fetch data
$data = fetchData($conn);

// Close connection
$conn->close();

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>