<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $sql = "DELETE FROM inventory WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Optionally, you can redirect back to the homepage or show a message
        header("Location: homepage.php?show=table&deleted=1");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
