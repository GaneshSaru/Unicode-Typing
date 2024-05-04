<?php
include_once "user_management.php";

if (isset($_SESSION['user'])) {
    // Get the incoming JSON data
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract the data
    $user_id = $_SESSION['user']['id'];
    $accuracyPercentage = isset($data['accuracyPercentage']) ? $data['accuracyPercentage'] : null;
    $typingSpeedWPM = isset($data['typingSpeedWPM']) ? $data['typingSpeedWPM'] : null;

    include_once "database_conn.php";

    if (!is_null($data)) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO progress (user_id, accuracy_percentage, typing_speed_wpm) VALUES (?, ?, ?)");
        $stmt->bind_param("idd", $user_id, $accuracyPercentage, $typingSpeedWPM);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "Data stored successfully";
        } else {
            echo "Error storing data: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    }
    // Close the connection
    $conn->close();
}
?>
