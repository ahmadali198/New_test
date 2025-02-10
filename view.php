<?php
include 'db_conn.php';

// Fetch records from database
$sql = "SELECT * FROM tickets";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .back-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: 0.3s;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}

.back-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

        .print-btn {
            background-color: green;
            color: white;
            border: none;
        }
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booked Tickets</h2>
        <table>
            <tr>
                <th>PAX Name</th>
                <th>Ticket Number</th>
                <th>Airline</th>
                <th>Basic Fare</th>
                <th>Other Taxes</th>
                <th>Total Selling</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['pax_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['ticket_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['airline']); ?></td>
                    <td><?php echo htmlspecialchars($row['basic_fare']); ?></td>
                    <td><?php echo htmlspecialchars($row['other_taxes']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_selling']); ?></td>
                    <td>
                        <!-- Print Button (Opens print.php with ticket ID) -->
                        <a href="print.php?id=<?php echo $row['id']; ?>" target="_blank">
                            <button class="btn print-btn">Print</button>
                        </a>

                        <!-- Delete Button (Deletes ticket) -->
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this ticket?');">
                            <button class="btn delete-btn">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="index.php" class="back-btn">Back to Booking</a>

    </div>
</body>
</html>
