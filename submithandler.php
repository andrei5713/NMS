<?php
session_start();
include("connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the form data
    $nameofuser = mysqli_real_escape_string($conn, $_POST['nameofuser']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $desig = mysqli_real_escape_string($conn, $_POST['desig']);
    $employmentstatus = mysqli_real_escape_string($conn, $_POST['employmentstatus']);
    $accountable = mysqli_real_escape_string($conn, $_POST['accountable']);
    $ipaddress = mysqli_real_escape_string($conn, $_POST['ipaddress']);
    $macaddress = mysqli_real_escape_string($conn, $_POST['macaddress']);
    $typeofdevice = mysqli_real_escape_string($conn, $_POST['typeofdevice']);
    $computername = mysqli_real_escape_string($conn, $_POST['computername']);
    $operatingsystem = mysqli_real_escape_string($conn, $_POST['operatingsystem']);
    $ssid = mysqli_real_escape_string($conn, $_POST['ssid']);
    $ppsk = mysqli_real_escape_string($conn, $_POST['ppsk']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $domain = mysqli_real_escape_string($conn, $_POST['domain']);
    $property = mysqli_real_escape_string($conn, $_POST['property']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $serial = mysqli_real_escape_string($conn, $_POST['serial']);
    $endpoint = mysqli_real_escape_string($conn, $_POST['endpoint']);
    $microsoftoffice = mysqli_real_escape_string($conn, $_POST['microsoftoffice']);

    // Optional: Validate required fields
    if (
        empty($nameofuser) || empty($department) || empty($desig) || empty($employmentstatus) ||
        empty($accountable) || empty($ipaddress) || empty($macaddress) || empty($typeofdevice) ||
        empty($computername) || empty($operatingsystem) || empty($ssid) || empty($ppsk) ||
        empty($pass) || empty($domain) || empty($property) || empty($brand) ||
        empty($model) || empty($serial) || empty($endpoint) || empty($microsoftoffice)
    ) {
        echo "All fields are required!";
        exit;
    }

    // Insert into DB
    $query = "INSERT INTO inventory 
        (nameofuser, department, desig, employmentstatus, accountable, ipaddress, macaddress, typeofdevice, computername, operatingsystem, ssid, ppsk, pass, domain, property, brand, model, serial, endpoint, microsoftoffice)
        VALUES
        ('$nameofuser', '$department', '$desig', '$employmentstatus', '$accountable', '$ipaddress', '$macaddress', '$typeofdevice', '$computername', '$operatingsystem', '$ssid', '$ppsk', '$pass', '$domain', '$property', '$brand', '$model', '$serial', '$endpoint', '$microsoftoffice')";

    if (mysqli_query($conn, $query)) {
        // ✅ Redirect to homepage with form showing and "saved" flag
        header("Location: homepage.php?show=form&saved=1");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}


if ($insertSuccess) { // <-- Your condition for successful insert
    header("Location: homepage.php?insert=success");
    exit();
}

?>
