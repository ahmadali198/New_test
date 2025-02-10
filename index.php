<?php
include 'db_conn.php';

$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $paxName = isset($_POST['paxName']) ? $_POST['paxName'] : "";
    $ticketNumber = isset($_POST['ticketNumber']) ? $_POST['ticketNumber'] : "";
    $airline = isset($_POST['airline']) ? $_POST['airline'] : "";
    $basicFare = isset($_POST['basicFare']) ? $_POST['basicFare'] : 0;
    $otherTaxes = isset($_POST['otherTaxes']) ? $_POST['otherTaxes'] : 0;
    $totalSelling = isset($_POST['totalSelling']) ? $_POST['totalSelling'] : 0;

    $sql = "INSERT INTO tickets (phone, pax_name, ticket_number, airline, basic_fare, other_taxes, total_selling) VALUES ('$phone', '$paxName', '$ticketNumber', '$airline', '$basicFare', '$otherTaxes', '$totalSelling')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "Booking registered successfully 😊";
    } else {
        $successMessage = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking Form</title>
    <style>
        body {
            font-size: 1.2em;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #333;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
        }
        label {
            display: block;
            font-weight: bold;
            text-align: left;
            margin-top: 10px;
        }
        input {
            width: calc(50% - 10px);
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .full-width {
            width: 50%;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Ticket Booking Form</h2>
    <form method="POST">
        <div class="form-row">
            <div>
                <label>Phone Number:</label>
                <input type="text" name="phone" required>
            </div>
            <div>
                <label>PAX Name:</label>
                <input type="text" name="paxName" required>
            </div>
        </div>
        <div class="form-row">
            <div>
                <label>Ticket Number:</label>
                <input type="text" name="ticketNumber" id="ticketNumber" oninput="checkAirline()" required>
            </div>
            <div>
                <label>Airline:</label>
                <input type="text" name="airline" id="airline" readonly>
            </div>
        </div>
        <div class="form-row">
            <div>
                <label>Basic Fare (PKR):</label>
                <input type="number" name="basicFare" id="basicFare" required oninput="calculateTotal()">
            </div>
            <div>
                <label>Other Taxes (PKR):</label>
                <input type="number" name="otherTaxes" id="otherTaxes" required oninput="calculateTotal()">
            </div>
        </div>
        <label>PKR Total Selling:</label>
        <input type="number" name="totalSelling" id="totalSelling" class="full-width" readonly>
        <button type="submit">Submit</button>
    </form>
    <a href="view.php" class="view-btn">
        <button>View Records</button>
    </a>
</div>



    <?php if (!empty($successMessage)): ?>
        <div class="popup-overlay" id="popupOverlay">
            <div class="popup">
                <p><?php echo $successMessage; ?></p>
                <button onclick="closePopup()">OK</button>
            </div>
        </div>
        <script>
            document.getElementById("popupOverlay").style.visibility = "visible";
        </script>
    <?php endif; ?>

    <script>
        function checkAirline() {
            let ticketNumber = document.getElementById("ticketNumber").value;
            let airlineField = document.getElementById("airline");

            if (ticketNumber.startsWith("214")) {
                airlineField.value = "PIA Airline";
            } else if (ticketNumber.startsWith("157")) {
                airlineField.value = "Qatar Airways";
            } else {
                airlineField.value = "NULL";
            }
        }

        function calculateTotal() {
            let basicFare = parseFloat(document.getElementById("basicFare").value) || 0;
            let otherTaxes = parseFloat(document.getElementById("otherTaxes").value) || 0;
            document.getElementById("totalSelling").value = basicFare + otherTaxes;
        }

        function closePopup() {
            document.getElementById("popupOverlay").style.visibility = "hidden";
        }
    </script>
</body>
</html>
