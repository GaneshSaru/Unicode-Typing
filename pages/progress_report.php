<?php
include_once "database_conn.php";
session_start();
$user_id =$_SESSION['user']['id'];
if (!isset($_SESSION['user'])) {
    echo "Session not started or user not logged in.";
    header("Location:login.php");
}
// Fetch data from the database
$query = ("SELECT * FROM progress WHERE user_id = '$user_id'");
$result = mysqli_query($conn, $query);

/// Initialize arrays to store data
$dates = [];
$accuracyPercentages = [];
$typingSpeeds = [];

// Process fetched data
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['created_at'];
    $accuracyPercentages[] = $row['accuracy_percentage'];
    $typingSpeeds[] = $row['typing_speed_wpm'];
}

// Close database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Typing Stats Chart</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/progress_report.css">
</head>
<body>
    <header>
    <button><a href="main.php">Back</a></button>
    </header>
   
    <canvas id="typingChart"></canvas>

    <script>
        // Get the data from PHP
        var dates = <?php echo json_encode($dates); ?>;
        var accuracyPercentages = <?php echo json_encode($accuracyPercentages); ?>;
        var typingSpeeds = <?php echo json_encode($typingSpeeds); ?>;

        // Create a Chart.js chart
        var ctx = document.getElementById('typingChart').getContext('2d');
        var typingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Accuracy Percentage',
                    data: accuracyPercentages,
                    borderColor: 'green',
                    backgroundColor: 'transparent',
                    yAxisID: 'accuracy-y-axis'
                }, {
                    label: 'Typing Speed (WPM)',
                    data: typingSpeeds,
                    borderColor: 'blue',
                    backgroundColor: 'transparent',
                    yAxisID: 'speed-y-axis'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        id: 'accuracy-y-axis',
                        type: 'linear',
                        position: 'left',
                        scaleLabel: {
                            display: true,
                            labelString: 'Accuracy Percentage',
                        }
                    }, {
                        id: 'speed-y-axis',
                        type: 'linear',
                        position: 'right',
                        scaleLabel: {
                            display: true,
                            labelString: 'Typing Speed (WPM)',
                        }
                    }]
                }
            }
        });
    </script>

</body>
</html>