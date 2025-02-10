<?php
include 'db_conn.php';

if (!isset($_GET['id'])) {
    die("Invalid request. No ticket selected.");
}

$ticket_id = $_GET['id'];
$sql = "SELECT * FROM tickets WHERE id = $ticket_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    die("No ticket found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 60%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .buttons {
            margin-bottom: 20px;
        }
        .buttons button {
            padding: 10px 15px;
            font-size: 1em;
            border: none;
            cursor: pointer;
            margin: 10px;
            border-radius: 5px;
            background-color: black;
            color: white;
        }

        /* Print Styles */
        @media print {
            body {
                font-size: 16px;
            }
            th {
                background-color: #000 !important;
                color: white !important;
            }
            td {
                background-color: #f9f9f9 !important;
                color: black !important;
            }
            .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h2>Ticket Details</h2>

    <div class="buttons">
        <button onclick="window.print()">Print</button>
    </div>

    <table>
        <tr><th>PAX Name</th><td><?php echo htmlspecialchars($row['pax_name']); ?></td></tr>
        <tr><th>Ticket Number</th><td><?php echo htmlspecialchars($row['ticket_number']); ?></td></tr>
        <tr><th>Airline</th><td><?php echo htmlspecialchars($row['airline']); ?></td></tr>
        <tr><th>Basic Fare</th><td><?php echo htmlspecialchars($row['basic_fare']); ?></td></tr>
        <tr><th>Other Taxes</th><td><?php echo htmlspecialchars($row['other_taxes']); ?></td></tr>
        <tr><th>Total Selling</th><td><?php echo htmlspecialchars($row['total_selling']); ?></td></tr>
    </table>

</body>
</html>
