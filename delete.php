<?php
include 'db_conn.php';

if (!isset($_GET['id'])) {
    die("Invalid request. No ticket selected.");
}

$ticket_id = $_GET['id'];
$sql = "DELETE FROM tickets WHERE id = $ticket_id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Ticket deleted successfully!'); window.location.href='view.php';</script>";
} else {
    echo "Error deleting ticket: " . $conn->error;
}
?>
