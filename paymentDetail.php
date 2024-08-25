<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <style>
        /* CSS styles for payment details page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h1 {
            color: #ff6f61;
            text-align: center;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Details</h1>
        <div class="details">
            <p><strong>PG Type:</strong> <?php echo htmlspecialchars($_GET['pg']); ?></p>
            <p><strong>Total Rooms:</strong> <?php echo htmlspecialchars($_GET['totalRooms']); ?></p>
            <p><strong>Available Rooms:</strong> <?php echo htmlspecialchars($_GET['availableRooms']); ?></p>
            <!-- Add more payment details here as needed -->
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to fetch data from fetch_data.php using AJAX
            function fetchData() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            updateUI(data);
                        } else {
                            console.error('Error fetching data: ' + xhr.status);
                        }
                    }
                };
                xhr.open('GET', 'fetch_data.php', true);
                xhr.send();
            }
    
            // Function to update UI with fetched data
            function updateUI(data) {
                // Update room details for each PG type
                document.getElementById('redTotalRooms').textContent = data.pg_details.Red.total_rooms;
                document.getElementById('redAvailableRooms').textContent = data.pg_details.Red.available_rooms;
    
                document.getElementById('brownTotalRooms').textContent = data.pg_details.Brown.total_rooms;
                document.getElementById('brownAvailableRooms').textContent = data.pg_details.Brown.available_rooms;
    
                document.getElementById('blueTotalRooms').textContent = data.pg_details.Blue.total_rooms;
                document.getElementById('blueAvailableRooms').textContent = data.pg_details.Blue.available_rooms;
    
                document.getElementById('yellowTotalRooms').textContent = data.pg_details.Yellow.total_rooms;
                document.getElementById('yellowAvailableRooms').textContent = data.pg_details.Yellow.available_rooms;
    
                document.getElementById('purpleTotalRooms').textContent = data.pg_details.Purple.total_rooms;
                document.getElementById('purpleAvailableRooms').textContent = data.pg_details.Purple.available_rooms;
    
                document.getElementById('orangeTotalRooms').textContent = data.pg_details.Orange.total_rooms;
                document.getElementById('orangeAvailableRooms').textContent = data.pg_details.Orange.available_rooms;
    
                document.getElementById('whiteTotalRooms').textContent = data.pg_details.White.total_rooms;
                document.getElementById('whiteAvailableRooms').textContent = data.pg_details.White.available_rooms;
    
                document.getElementById('greenTotalRooms').textContent = data.pg_details.Green.total_rooms;
                document.getElementById('greenAvailableRooms').textContent = data.pg_details.Green.available_rooms;
    
                document.getElementById('blackTotalRooms').textContent = data.pg_details.Black.total_rooms;
                document.getElementById('blackAvailableRooms').textContent = data.pg_details.Black.available_rooms;
    
                // Update notifications
                var notificationsList = document.getElementById('notificationsList');
                notificationsList.innerHTML = ''; // Clear previous notifications
    
                if (data.notifications.length > 0) {
                    data.notifications.forEach(function(notification) {
                        var li = document.createElement('li');
                        li.textContent = notification.date + ': ' + notification.message;
                        notificationsList.appendChild(li);
                    });
                } else {
                    var li = document.createElement('li');
                    li.textContent = 'No new notifications';
                    notificationsList.appendChild(li);
                }
            }
    
            // Fetch data on page load
            fetchData();
    
            // Redirect to payment page when "Booked" button is clicked
            document.getElementById('bookedBtn').addEventListener('click', function() {
                // Assuming you have some way to get the selected PG and payment details
                var selectedPG = "Red PG"; // Replace with actual selection logic if needed
                var totalRooms = document.getElementById(selectedPG.toLowerCase() + 'TotalRooms').textContent;
                var availableRooms = document.getElementById(selectedPG.toLowerCase() + 'AvailableRooms').textContent;
    
                // Example URL redirection with query parameters
                var paymentURL = 'payment.php' +
                                 '?pg=' + encodeURIComponent(selectedPG) +
                                 '&totalRooms=' + encodeURIComponent(totalRooms) +
                                 '&availableRooms=' + encodeURIComponent(availableRooms);
    
                window.location.href = paymentURL;
            });
        });
    </script>
</body>
</html>