<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName = trim($_POST['fName']);
    $lastName = trim($_POST['lName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($firstName) || empty($lastName) || empty($email) || empty($password)){
        header("Location: index.php?error=" . urlencode("All fields are required!"));
        exit();
    } else {
        $password = md5($password);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            header("Location: index.php?error=" . urlencode("Email Address Already Exists!"));
            exit();
        } else {
            $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
            if($stmt->execute()){
                $stmt->close();
                header("Location: index.php?success=" . urlencode("Registration successful! Please sign in."));
                exit();
            } else {
                $stmt->close();
                header("Location: index.php?error=" . urlencode("Error: " . $conn->error));
                exit();
            }
        }
    }
}

if (isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' and password='$password' ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: homepage.php");
        exit();
    }
    else{
        header("Location: index.php?error=" . urlencode("Not Found, Incorrect Email or Password"));
        exit();
    }
}
?>